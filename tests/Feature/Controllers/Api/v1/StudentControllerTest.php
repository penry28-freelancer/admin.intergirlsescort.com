<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use ListHelper;
use Tests\TestCaseApiV1;

class StudentControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    /** @var array */
    protected $__sex_keys;

    /** @var array */
    protected $__is_active_keys;

    /** @var array */
    protected $__is_draft_keys;

    public function setUp(): void
    {
        parent::setUp();
        $this->__sex_keys       = config('constants.sex.key');
        $this->__is_active_keys = config('constants.is_active.key');
        $this->__is_draft_keys  = config('constants.is_draft.key');
    }

    /**
     * Test Show List
     */
    public function testListStudentSuccess()
    {
        $students = Student::factory()->count(50)->create();
        $response = $this->json('GET', route('user.student.index'), ['limit' => 25, 'page' => 1]);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'count'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll([
                        'data',
                        'count',
                        'data.0.id',
                        'data.0.name',
                        'data.0.sex',
                        'data.0.email',
                        'data.0.phone',
                        'data.0.is_active',
                        'data.0.is_draft',
                        'data.0.created_at',
                        'data.0.updated_at',
                    ])
                    ->whereAllType(['data' => 'array', 'count' => 'integer'])
                    ->whereAll([
                        'data.0.id' => $students->toArray()[0]['id'],
                        'count'     => $students->count()
                    ])
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Store Success
     */
    public function testStoreStudentSuccess()
    {
        $formData = [
            'name'      => \Str::random(10),
            'avatar'    => ListHelper::randomAvatar(),
            'username'  => $this->faker->unique()->userName(),
            'sex'       => $this->__sex_keys[array_rand($this->__sex_keys)],
            'email'     => $this->faker->unique()->email(),
            'phone'     => $this->faker->unique()->phoneNumber(),
            'dob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y'),
            'mob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('m'),
            'yob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d'),
            'password'  => \Hash::make('@Hung12345678'),
            'is_active' => $this->__is_active_keys[array_rand($this->__is_active_keys)],
            'is_draft'  => $this->__is_draft_keys[array_rand($this->__is_draft_keys)],
        ];

        $response = $this->json('POST', route('user.student.store'), $formData);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll([
                        'data',
                        'data.id',
                        'data.name',
                        'data.sex',
                        'data.email',
                        'data.phone',
                        'data.is_active',
                        'data.is_draft',
                        'data.created_at',
                        'data.updated_at',
                    ])
                    ->whereType('data', 'array')
                    ->where('data.id', 1)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Store Required Fields
     */
    // public function testStoreRequiredFields()
    // {

    // }

    /**
     * Test Show Student
     */
    public function testShowStudentSuccess()
    {
        $student = Student::factory()->create();

        $response = $this->json('GET', route('user.student.show', $student->id));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.sex',
                        'data.email',
                        'data.phone',
                        'data.is_active',
                        'data.is_draft',
                        'data.created_at',
                        'data.updated_at',
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $student->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Update Student
     */
    public function testUpdateStudentSuccess()
    {
        $student = Student::factory()->create();

        $formData = [
            'id'        => $student->id,
            'name'      => \Str::random(10),
            'avatar'    => ListHelper::randomAvatar(),
            'username'  => $this->faker->unique()->userName(),
            'sex'       => $this->__sex_keys[array_rand($this->__sex_keys)],
            'email'     => $this->faker->unique()->email(),
            'phone'     => $this->faker->unique()->phoneNumber(),
            'dob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y'),
            'mob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('m'),
            'yob'       => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d'),
            'is_active' => $this->__is_active_keys[array_rand($this->__is_active_keys)],
            'is_draft'  => $this->__is_draft_keys[array_rand($this->__is_draft_keys)],
        ];

        $response = $this->json('PUT', route('user.student.update', $student->id), $formData);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.sex',
                        'data.email',
                        'data.phone',
                        'data.is_active',
                        'data.is_draft',
                        'data.created_at',
                        'data.updated_at',
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $student->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Destroy Student Draft
     */
    public function testDestroyStudentDraftSuccess()
    {
        $student = Student::factory()->state(['is_draft' => $this->__is_draft_keys['is_draft']])->create();
        $response = $this->json('DELETE', route('user.student.destroy', $student->id));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['success'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                ->has('message')
                ->whereType('message', 'string')
                ->where('message', trans('messages.deleted'))
                ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Destroy Student Real
     */
    public function testDestroyStudentRealSuccess()
    {
        $student = Student::factory()->state(['is_draft' => $this->__is_draft_keys['is_real']])->create();
        $response = $this->json('DELETE', route('user.student.destroy', $student->id));
        $response
            ->assertStatus(Response::HTTP_NOT_ACCEPTABLE)
            ->assertJsonStructure(['success'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                ->has('message')
                ->whereType('message', 'string')
                ->where('message', trans('messages.cant_delete'))
                ->etc()
            );

        $this->assertFalse($response['success']);
    }

    /**
     * Test Can't Show Student Does't Exist
     */
    public function testCantShowStudentDoesExist()
    {
        $response = $this->json('GET', route('user.student.show', -1));
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('message')
                    ->whereType('message', 'string')
                    ->where('message', trans('messages.not_found'))
                    ->etc()
            );

        $this->assertFalse($response['success']);
    }

    /**
     * Test Can't Destroy Student Does't Exist
     */
    public function testCantDestroyStudentDoestExist()
    {
        $response = $this->json('DELETE', route('user.student.destroy', -1));
        $response
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->has('message')
                    ->whereType('message', 'string')
                    ->where('message', trans('messages.not_found'))
                    ->etc()
            );

        $this->assertFalse($response['success']);
    }
}
