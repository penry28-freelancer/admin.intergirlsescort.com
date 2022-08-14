<?php

namespace Tests;

use App\Models\User;

abstract class TestCaseApiV1 extends TestCase
{
    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user, 'api');
    }
}
