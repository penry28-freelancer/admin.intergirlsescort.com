<?php

namespace App\Repositories\Bill;

use App\Repositories\EloquentRepository;

class BillRepository extends EloquentRepository implements BillRepositoryInterface
{

    public function model()
    {
        return \App\Models\Bill::class;
    }
}
