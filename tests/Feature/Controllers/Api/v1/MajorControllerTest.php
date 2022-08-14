<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\City;
use App\Models\Major;
use App\Models\University;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCaseApiV1;

class MajorControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    /** @var array */
    private $_subject_groups;

    public function setUp(): void
    {
        parent::setUp();
        $this->_subject_groups = [
            'A00; A01; C00; D01',
            'A00; D07',
            'C00; C19; D14; D15',
            'A00; A01; B00; D01',
            'R08',
            'A00; C00; C15; D01',
            'A00; B00; C00; D01',
            'C00',
            'A00; A01; C01; D01',
            'A00; B00; D07',
            'A00; A01; D01; D03; D09',
            'B00',
            'D06',
            'V03; V04',
            'A09; C00; C20; D15'
        ];
    }

    /**
     * Test can list major
     */
    public function testListMajorSuccess()
    {
        City::factory()
            ->count(3)
            ->has(University::factory()->count(3))
            ->create();

        $majors   = Major::factory()->count(50)->create();
        $response = $this->json('GET', route('data-page.major.index', ['limit' => 25, 'page' => 1]))
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['data', 'count'])
                        ->assertJson([
                            'data'  => array_slice($majors->toArray(), 0, 25),
                            'count' => $majors->count()
                        ]);

        $this->assertTrue($response['success']);
    }

    /**
     * Test can store major
     */
    public function testStoreMajorSuccess()
    {
        City::factory()
            ->count(3)
            ->has(University::factory()->count(5))
            ->create();

        $universities_ids = University::pluck('id')->toArray();

        $formData = [
            'code'          => strtoupper(\Str::random(2)),
            'name'          => $this->faker->name(),
            'subject_group' => $this->_subject_groups[array_rand($this->_subject_groups)],
            'thpt_score'    => $this->faker->randomFloat(2, 10, 25),
            'hocba_score'   => $this->faker->randomFloat(0, 10, 30),
            'dgnl_score'    => $this->faker->randomFloat(0, 100, 600),
            'university_id' => $universities_ids[array_rand($universities_ids)]
        ];

        $response = $this->json('POST', route('data-page.major.store'), $formData)
                        ->assertStatus(Response::HTTP_CREATED)
                        ->assertJsonStructure(['data'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('data')
                                ->whereType('data', 'array')
                                ->where('data.id', 1)
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can show major
     */
    public function testShowMajorSuccess()
    {
        City::factory()
            ->count(3)
            ->has(University::factory()->count(5))
            ->create();

        $major    = Major::factory()->create();
        $response = $this->json('GET', route('data-page.major.show', $major->id))
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['data'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('data')
                                ->whereType('data', 'array')
                                ->where('data.id', $major->id)
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can update major
     */
    public function testUpdateMajorSuccess()
    {
        City::factory()
            ->count(3)
            ->has(University::factory()->count(5))
            ->create();

        $universities_ids = University::pluck('id')->toArray();

        $major    = Major::factory()->create();
        $formData = [
            'code'          => $major->code . 'update',
            'name'          => $major->nane . 'update',
            'subject_group' => $this->_subject_groups[array_rand($this->_subject_groups)],
            'thpt_score'    => $this->faker->randomFloat(2, 10, 25),
            'hocba_score'   => $this->faker->randomFloat(0, 10, 30),
            'dgnl_score'    => $this->faker->randomFloat(0, 100, 600),
            'university_id' => $universities_ids[array_rand($universities_ids)]
        ];
        $response = $this->json('PUT', route('data-page.major.update', $major->id), $formData)
                        ->assertStatus(Response::HTTP_OK)
                        ->assertJsonStructure(['data'])
                        ->assertJson(fn (AssertableJson $json) =>
                            $json->has('data')
                                ->whereType('data', 'array')
                                ->where('data.id', $major->id)
                                ->where('data.name', $formData['name'])
                                ->etc()
                        );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can destroy major
     */
    public function testDestroyMajorSuccess()
    {
        City::factory()
            ->count(3)
            ->has(University::factory()->count(5))
            ->create();

        $major    = Major::factory()->create();
        $response = $this->json('DELETE', route('data-page.major.destroy', $major->id))
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
     * Test can return error when show major does not exist
     */
    public function testCantShowMajorDoestExist()
    {
        $response = $this->json('GET', route('data-page.major.show', -1))
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
     * Test can return error when destroy major does not exist
     */
    public function testCantDestroyMajorDoestExist()
    {
        $response = $this->json('DELETE', route('data-page.major.destroy', -1))
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
