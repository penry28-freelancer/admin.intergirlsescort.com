<?php

namespace App\Repositories\User;

use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function model()
    {
        return \App\Models\User::class;
    }
}
