<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateEscortController extends Controller
{
    public function __construct()
    {

    }

    public function store(Request $request)
    {
        $tab = $request->get('tab');
        dd($tab);
    }
}
