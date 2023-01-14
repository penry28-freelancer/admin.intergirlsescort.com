<?php

namespace App\Repositories\Account;

use App\Repositories\EloquentRepository;

class AccountRepository extends EloquentRepository implements AccountRepositoryInterface
{
    public function model()
    {
        return \App\Models\Account::class;
    }
}
