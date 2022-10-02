<?php

namespace App\Repositories\Price;



use App\Repositories\EloquentRepository;

class PriceRepository extends EloquentRepository implements PriceRepositoryInterface
{
    public function model()
    {
        return \App\Models\Price::class;
    }
}
