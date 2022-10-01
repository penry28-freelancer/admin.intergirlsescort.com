<?php

namespace App\Repositories\Transaction;

use App\Repositories\EloquentRepository;

class TransactionRepository extends EloquentRepository implements TransactionRepositoryInterface
{
    public function model()
    {
        return \App\Models\Transaction::class;
    }
}
