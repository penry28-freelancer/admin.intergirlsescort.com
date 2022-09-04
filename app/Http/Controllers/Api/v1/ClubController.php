<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\ClubRequest;
use App\Http\Resources\CMS\v1\ClubResource;
use App\Repositories\Club\ClubRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $clubs = $this->_clubRepo->queryList($request);

            return $this->jsonTable([
                'data'  => ClubResource::collection($clubs),
                'total' => ($clubs->toArray())['total'],
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
    public function store(ClubRequest $request)
    {
        try {
            $club = $this->_clubRepo->store($request);
            if (count($request->club_hours)) {
                $hours = [];
                foreach ($request->club_hours as $value) {
                    $hours[] = [
                        'club_id'    => $club['id'],
                        'title'      => $value['title'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                $club->clubHours()->createMany($hours);
            }

            return $this->jsonData(new ClubResource($club), Response::HTTP_CREATED);
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
            $club = $this->_clubRepo->findWithRelationship($id);
            if (!empty($club)) {
                return $this->jsonData(new ClubResource($club));
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
    public function update(ClubRequest $request, $id)
    {
        try {
            $club = $this->_clubRepo->update($request, $id);
            if (count($request->club_hours)) {
                $club->clubHours()->delete();
                $hours = [];
                foreach ($request->club_hours as $value) {
                    $hours[] = [
                        'club_id'    => $id,
                        'title'      => $value['title'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ];
                }
                $club->clubHours()->createMany($hours);
            }
            return $this->jsonData(new ClubResource($club));
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
            $club = $this->_clubRepo->find($id);
            if ($club) {
                if ($club->is_draft == config('constants.is_draft.key.is_draft')) {
                    $club->clubHours()->delete();
                    $this->_clubRepo->destroy($id);
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
