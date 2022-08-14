<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCaseApiV1;

class SubjectControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test can list subject
     */
    public function testListSubjectSuccess()
    {
        $subjects = Subject::factory()->count(50)->create();
        $response = $this->json('GET', route('data-page.subject.index', ['limit' => 25, 'page' => 1]));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data', 'count'])
            ->assertJson([
                'data'  => array_slice($subjects->toArray(), 0, 25),
                'count' => $subjects->count()
            ]);

        $this->assertTrue($response['success']);
    }

    /**
     * Test can store subject
     */
    public function testStoreSubjectSuccess()
    {
        $formData = [
            'name' => $this->faker->name(),
            'code' => $this->faker->name(),
        ];
        $response = $this->json('POST', route('data-page.subject.store'), $formData)
                    ->assertStatus(Response::HTTP_CREATED)
                    ->assertJsonStructure(['data'])
                    ->assertJson(fn (AssertableJson $json) =>
                        $json->has('data')
                            ->whereType('data', 'array')
                            ->where('data.name', $formData['name'])
                            ->where('data.code', $formData['code'])
                            ->etc()
                    );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can show subject
     */
    public function testShowSubjectSuccess()
    {
        $subject  = Subject::factory()->create();
        $response = $this->json('GET', route('data-page.subject.show', $subject->id))
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['data'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('data')
                                ->whereType('data', 'array')
                                ->where('data.id', $subject->id)
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can update subject
     */
    public function testUpdateSubjectSuccess()
    {
        $subject  = Subject::factory()->create();
        $formData = [
            'name' => $this->faker->name(),
            'code' => $this->faker->name(),
        ];
        $response = $this->json('PUT', route('data-page.subject.update', $subject->id), $formData)
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['data'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('data')
                                ->whereType('data', 'array')
                                ->where('data.id', $subject->id)
                                ->where('data.name', $formData['name'])
                                ->where('data.code', $formData['code'])
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can destroy subject
     */
    public function testDestroySubjectSuccess()
    {
        $subject  = Subject::factory()->create();
        $response = $this->json('DELETE', route('data-page.subject.destroy', $subject->id))
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['message'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('message')
                                ->whereType('message', 'string')
                                ->where('message', trans('messages.deleted'))
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can return error when show subject does not exist
     */
    public function testCantShowSubjectDoestExist()
    {
        $response = $this->json('GET', route('data-page.subject.show', -1))
                        ->assertStatus(Response::HTTP_NOT_FOUND)
                        ->assertJsonStructure(['message'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('message')
                                ->whereType('message', 'string')
                                ->where('message', trans('messages.not_found'))
                                ->etc()
                        );

        $this->assertFalse($response['success']);
    }

    /**
     * Test can return error when destroy subject does not exist
     */
    public function testCantDestroySubjectDoestExist()
    {
        $response = $this->json('DELETE', route('data-page.subject.destroy', -1))
                        ->assertStatus(Response::HTTP_NOT_FOUND)
                        ->assertJsonStructure(['message'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('message')
                                ->whereType('message', 'string')
                                ->where('message', trans('messages.not_found'))
                                ->etc()
                        );

        $this->assertFalse($response['success']);
    }
}
