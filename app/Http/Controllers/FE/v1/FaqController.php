<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Faq\FaqRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    private $_faqRepository;

    public function __construct(
        FaqRepository $faqRepository
    )
    {
        $this->_faqRepository = $faqRepository;
    }

    public function index(Request $request)
    {
        $type = $request->get('type');

        try {
            switch ($type) {
                case 'members':
                    $resources = $this->_faqRepository->where('type', config('constants.faq_type.key.members'))->get();
                    break;
                default:
                    $resources = $this->_faqRepository->where('type', config('constants.faq_type.key.escort'))->get();
                    break;
            }
            return $this->jsonData($resources, Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
