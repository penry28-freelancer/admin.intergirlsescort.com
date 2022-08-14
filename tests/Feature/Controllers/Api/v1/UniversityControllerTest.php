<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\City;
use App\Models\University;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCaseApiV1;

class UniversityControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test Show List
     */
    public function testListUniversitySuccess()
    {
        City::factory()->count(5)->create();

        $universities = University::factory(50)->create();
        $response = $this->json('GET', route('data-page.university.index'), ['limit' => 25, 'page' => 1]);
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
                        'data.0.code',
                        'data.0.city_id',
                        'data.0.city.name',
                        'data.0.majors_count',
                        'data.0.type',
                        'data.0.address',
                        'data.0.phone',
                        'data.0.website',
                        'data.0.created_at',
                        'data.0.updated_at'
                    ])
                    ->whereAllType(['data' => 'array', 'count' => 'integer'])
                    ->whereAll([
                        'data.0.id' => $universities->toArray()[0]['id'],
                        'count'     => $universities->count()
                    ])
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Store Success
     */
    public function testStoreUniversitySuccess()
    {
        $city = City::factory()->create();

        $formData = [
            'name'    => 'New University',
            'code'    => 'NU',
            'city_id' => $city->id,
            'type'    => config('constants.university_type.key.CD'),
            'address' => $this->faker->address(),
            'phone'   => '0123456789',
            'website' => $this->faker->url(),
        ];

        $response = $this->json('POST', route('data-page.university.store'), $formData);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll([
                        'data',
                        'data.id',
                        'data.name',
                        'data.code',
                        'data.city_id',
                        'data.city.name',
                        'data.majors_count',
                        'data.type',
                        'data.address',
                        'data.phone',
                        'data.website',
                        'data.created_at',
                        'data.updated_at'
                    ])
                    ->whereType('data', 'array')
                    ->where('data.id', 1)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test Store Required Field
     */
    public function testStoreRequiredFields()
    {
        $formData = [
            'name'    => null,
            'code'    => null,
            'city_id' => null,
            'type'    => null,
            'address' => null,
            'phone'   => null,
            'website' => null,
        ];

        $response = $this->json('POST', route('data-page.university.store'), $formData);
        $response
            ->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(['errors', 'message'])
                    ->whereAllType(['errors'  => 'array', 'message' => 'string'])
                    ->missingAll(['errors.phone', 'errors.website'])
                    ->whereAll([
                        'message'        => trans('validation.data_valid'),
                        'errors.name'    => trans('validation.required', ['attribute' => 'name']),
                        'errors.code'    => trans('validation.required', ['attribute' => 'code']),
                        'errors.city_id' => trans('validation.required', ['attribute' => 'city id']),
                        'errors.type'    => trans('validation.required', ['attribute' => 'type']),
                    ])
                    ->etc()
            );
    }

    /**
     * Test Show University
     */
    public function testShowUniversitySuccess()
    {
        $city = City::factory()->create();
        $university = University::factory()
                                ->state(['city_id' => $city->id])
                                ->create();

        $response = $this->json('GET', route('data-page.university.show', $university->id));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.code',
                        'data.city_id',
                        'data.city.name',
                        'data.majors_count',
                        'data.type',
                        'data.address',
                        'data.phone',
                        'data.website',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $university->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test update university
     */
    public function testUpdateUniversitySuccess()
    {
        $city = City::factory()->create();
        $city_update = City::factory()->create();
        $university = University::factory()
                                ->state(['city_id' => $city->id])
                                ->create();

        $formData = [
            'id'      => $university->id,
            'name'    => $this->faker->name(),
            'code'    => \Str::random(2),
            'city_id' => $city_update->id,
            'type'    => config('constants.university_type.key.DH'),
            'address' => $this->faker->address(),
            'phone'   => '0123456789',
            'website' => $this->faker->url(),
        ];

        $response = $this->json('PUT', route('data-page.university.update', $university->id), $formData);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.code',
                        'data.city_id',
                        'data.city.name',
                        'data.majors_count',
                        'data.type',
                        'data.address',
                        'data.phone',
                        'data.website',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $university->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test destroy university
     */
    public function testDestroyUniversitySuccess()
    {
        $city = City::factory()->create();
        $university = University::factory()
                                ->state(['city_id' => $city->id])
                                ->create();

        $response = $this->json('DELETE', route('data-page.university.destroy', $university->id));
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
     * Test can't show university does't exist
     */
    public function testCantShowUniversityDoestExist()
    {
        $response = $this->json('GET', route('data-page.university.show', -1));
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
     * Test can't destroy university does't exist
     */
    public function testCantDestroyUniversityDoestExist()
    {
        $response = $this->json('DELETE', route('data-page.university.destroy', -1));
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
