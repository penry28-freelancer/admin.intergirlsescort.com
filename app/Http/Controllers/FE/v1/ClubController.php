<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CMS\v1\ClubResource;
use App\Repositories\Club\ClubRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClubController extends Controller
{
    private $_clubRepo;

    public function __construct(ClubRepository $clubRepo)
    {
        $this->_clubRepo = $clubRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $clubs = $this->_clubRepo->queryListRelation($request);

            return $this->jsonTable([
                'data'  => ClubResource::collection($clubs),
                'total' => $clubs->total(),
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $club = $this->_clubRepo->findWithRelationship($id);
            if (!empty($club)) {
                return $this->jsonData(new ClubResource($club));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, ResponseAlias::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
