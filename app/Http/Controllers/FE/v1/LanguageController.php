<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\FE\v1\LanguageResource;
use App\Repositories\Language\LanguageRepository;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    private $_languageRepo;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->_languageRepo = $languageRepository;
    }

    public function index()
    {
        try {
            $timezones = $this->_languageRepo->all();

            return $this->jsonData(LanguageResource::collection($timezones));
        } catch(\Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }
}
