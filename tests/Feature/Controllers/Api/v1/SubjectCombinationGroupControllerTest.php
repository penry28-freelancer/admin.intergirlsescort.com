<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\SubjectCombinationGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCaseApiV1;

class SubjectCombinationGroupControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test can list subject combination
     */
    public function testListSubjectCombinationGroupSuccess()
    {
        $subject_combination_groups = SubjectCombinationGroup::factory()->count(50)->create();

        $response = $this->json('GET', route('data-page.subject-combination-group.index'), ['limit' => 25, 'page' => 1]);
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
                        'data.0.description',
                        'data.0.created_at',
                        'data.0.updated_at'
                    ])
                    ->whereAllType(['data' => 'array', 'count' => 'integer'])
                    ->whereAll([
                        'data.0.id' => $subject_combination_groups->toArray()[0]['id'],
                        'count'     => $subject_combination_groups->count()
                    ])
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can store subjectCombinationGroup
     */
    public function testStoreSubjectCombinationGroupSuccess()
    {
        $formData = [
            'name'        => $this->faker->name(),
            'description' => $this->faker->text(300)
        ];

        $response = $this->json('POST', route('data-page.subject-combination-group.store'), $formData);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll([
                        'data',
                        'data.id',
                        'data.name',
                        'data.description',
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
     * Test can show subjectCombinationGroup
     */
    public function testShowSubjectCombinationGroupSuccess()
    {
        $subject_combination_group = SubjectCombinationGroup::factory()->create();

        $response = $this->json('GET', route('data-page.subject-combination-group.show', $subject_combination_group->id));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.description',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $subject_combination_group->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can update subjectCombinationGroup
     */
    public function testUpdateSubjectCombinationGroupSuccess()
    {
        $subject_combination_group = SubjectCombinationGroup::factory()->create();
        $formData = [
            'id' => $subject_combination_group->id,
            'name' => $this->faker->name(),
            'description' => $this->faker->text(300)
        ];

        $response = $this->json('PUT', route('data-page.subject-combination-group.update', $subject_combination_group->id), $formData);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.description',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $subject_combination_group->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can destroy subjectCombinationGroup
     */
    public function testDestroySubjectCombinationGroupSuccess()
    {
        $subject_combination_group = SubjectCombinationGroup::factory()->create();
        $response = $this->json('DELETE', route('data-page.subject-combination-group.destroy', $subject_combination_group->id));
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
     * Test can return error when show subjectCombinationGroup does not exist
     */
    public function testCantShowSubjectCombinationGroupDoestExist()
    {
        $response = $this->json('GET', route('data-page.subject-combination-group.show', -1));
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
     * Test can return error when destroy subjectCombinationGroup does not exist
     */
    public function testCantDestroySubjectCombinationGroupDoestExist()
    {
        $response = $this->json('DELETE', route('data-page.subject-combination-group.destroy', -1));
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
