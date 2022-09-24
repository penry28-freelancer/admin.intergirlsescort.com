<?php

namespace App\Repositories\Token;

use App\Repositories\EloquentRepository;

class TokenRepository extends EloquentRepository implements TokenRepositoryInterface
{

    public function model()
    {
        return \App\Models\Token::class;
    }
}
