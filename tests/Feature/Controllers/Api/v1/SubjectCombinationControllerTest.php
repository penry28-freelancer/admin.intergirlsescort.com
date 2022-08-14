<?php

namespace Tests\Feature\Controllers\Api\v1;

use App\Models\Subject;
use App\Models\SubjectCombination;
use App\Models\SubjectCombinationGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCaseApiV1;

class SubjectCombinationControllerTest extends TestCaseApiV1
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test can list subject combination
     */
    public function testListSubjectCombinationSuccess()
    {
        SubjectCombinationGroup::factory()->count(10)->create();
        $subject_combinations = SubjectCombination::factory()
                                                ->count(1)
                                                ->has(Subject::factory()->count(10))
                                                ->create();

        $response = $this->json('GET', route('data-page.subject-combination.index'), ['limit' => 25, 'page' => 1]);
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
                        'data.0.group_id',
                        'data.0.group.name',
                        'data.0.subjects.0.id',
                        'data.0.subjects.0.name',
                        'data.0.created_at',
                        'data.0.updated_at'
                    ])
                    ->whereAllType(['data' => 'array', 'count' => 'integer'])
                    ->whereAll([
                        'data.0.id' => $subject_combinations->toArray()[0]['id'],
                        'count'     => $subject_combinations->count()
                    ])
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can store subjectCombination
     */
    public function testStoreSubjectCombinationSuccess()
    {
        $group = SubjectCombinationGroup::factory()->create();
        $subjects = Subject::factory()->count(10)->create()->pluck('id')->toArray();

        $formData = [
            'name'       => $this->faker->name(),
            'group_id'   => $group->id,
            'subjects'   => $subjects
        ];

        $response = $this->json('POST', route('data-page.subject-combination.store'), $formData);
        $response
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll([
                        'data',
                        'data.id',
                        'data.name',
                        'data.group_id',
                        'data.group.name',
                        'data.subjects.0.id',
                        'data.subjects.0.name',
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
     * Test can show subjectCombination
     */
    public function testShowSubjectCombinationSuccess()
    {
        $group = SubjectCombinationGroup::factory()->create();
        $subject_combination = SubjectCombination::factory()
                                                ->state(['group_id' => $group->id])
                                                ->has(Subject::factory()->count(10))
                                                ->create();

        $response = $this->json('GET', route('data-page.subject-combination.show', $subject_combination->id));
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.group_id',
                        'data.group.name',
                        'data.subjects.0.id',
                        'data.subjects.0.name',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $subject_combination->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can update subjectCombination
     */
    public function testUpdateSubjectCombinationSuccess()
    {
        $group = SubjectCombinationGroup::factory()->create();
        $group_update = SubjectCombinationGroup::factory()->create();
        $subject_combination = SubjectCombination::factory()
                                                ->state(['group_id' => $group->id])
                                                ->has(Subject::factory()->count(10))
                                                ->create();
        $subjects = Subject::factory()->count(20)->create()->pluck('id')->toArray();

        $formData = [
            'id'       => $subject_combination->id,
            'name'     => $this->faker->name(),
            'group_id' => $group_update->id,
            'subjects' => $subjects,
        ];

        $response = $this->json('PUT', route('data-page.subject-combination.update', $subject_combination->id), $formData);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(['data'])
            ->assertJson(fn (AssertableJson $json) =>
                $json
                    ->hasAll(
                        'data',
                        'data.id',
                        'data.name',
                        'data.group_id',
                        'data.group.name',
                        'data.subjects.0.id',
                        'data.subjects.0.name',
                        'data.created_at',
                        'data.updated_at'
                    )
                    ->whereType('data', 'array')
                    ->where('data.id', $subject_combination->id)
                    ->etc()
            );

        $this->assertTrue($response['success']);
    }

    /**
     * Test can destroy subjectCombination
     */
    public function testDestroySubjectCombinationSuccess()
    {
        $group = SubjectCombinationGroup::factory()->create();
        $subject_combination = SubjectCombination::factory()
                                                ->state(['group_id' => $group->id])
                                                ->has(Subject::factory()->count(10))
                                                ->create();

        $response = $this->json('DELETE', route('data-page.subject-combination.destroy', $subject_combination->id));
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
     * Test can return error when show subjectCombination does not exist
     */
    public function testCantShowSubjectCombinationDoestExist()
    {
        $response = $this->json('GET', route('data-page.subject-combination.show', -1));
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
     * Test can return error when destroy subjectCombination does not exist
     */
    public function testCantDestroySubjectCombinationDoestExist()
    {
        $response = $this->json('DELETE', route('data-page.subject-combination.destroy', -1));
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
