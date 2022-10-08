<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Escort\EscortRepository;
use Illuminate\Http\Request;

class UpdateEscortController extends Controller
{
    private $_escortRepository;

    public function __construct(EscortRepository $escortRepository)
    {
        $this->_escortRepository = $escortRepository;
    }

//    public function about(Escort)
//    {
//
//    }
}
