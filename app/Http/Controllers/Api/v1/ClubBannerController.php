<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\ClubBannerRequest;
use App\Http\Resources\CMS\v1\ClubBannerResource;
use App\Repositories\ClubBanner\ClubBannerRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClubBannerController extends Controller
{
    private $_clubBannerRepo;

    public function __construct(ClubBannerRepository $clubBannerRepo)
    {
        $this->_clubBannerRepo = $clubBannerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $club_banners = $this->_clubBannerRepo->queryList($request);

            return $this->jsonTable([
                'data'  => ClubBannerResource::collection($club_banners),
                'total' => ($club_banners->toArray())['total']
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClubBannerRequest $request)
    {
        try {
            $club_banner = $this->_clubBannerRepo->store($request);

            return $this->jsonData(new ClubBannerResource($club_banner), Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $club_banner = $this->_clubBannerRepo->find($id);
            if (! empty($club_banner)) {
                return $this->jsonData(new ClubBannerResource($club_banner));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClubBannerRequest $request, $id)
    {
        try {
            $club_banner = $this->_clubBannerRepo->update($request, $id);

            return $this->jsonData(new ClubBannerResource($club_banner));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $club_banner = $this->_clubBannerRepo->find($id);
            if ($club_banner) {
                if ($club_banner->is_draft == config('constants.is_draft.key.is_draft')) {
                    $this->_clubBannerRepo->destroy($id);
                    return $this->jsonMessage(trans('messages.deleted'), true);
                } else {
                    return $this->jsonMessage(trans('messages.cant_delete'), false, Response::HTTP_NOT_ACCEPTABLE);
                }
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
