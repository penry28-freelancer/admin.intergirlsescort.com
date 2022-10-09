<?php

namespace App\Repositories\Account;

use App\Repositories\EloquentRepository;

class AccountRepository extends EloquentRepository implements AccountRepositoryInterface
{

    public function model()
    {
        return \App\Models\Account::class;
    }

    public function filterFavoritesByType($type)
    {
        // $modelName =
        $builder = $this->model;

        // $builder = $builder->where('accountable_type', $modelName);
        return $builder->get();
    }
}
