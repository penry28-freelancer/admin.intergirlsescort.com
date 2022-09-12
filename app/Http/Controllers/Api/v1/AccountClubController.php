<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\CMS\v1\AccountClubRequest;
use App\Http\Resources\CMS\v1\AccountClubResource;
use App\Repositories\AccountClub\AccountClubRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountClubController extends Controller
{
    private $_accountClubRepo;

    public function __construct(AccountClubRepository $accountClubRepo)
    {
        $this->_accountClubRepo = $accountClubRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $account_clubs = $this->_accountClubRepo->queryList($request);

            return $this->jsonTable([
                'data'  => AccountClubResource::collection($account_clubs),
                'total' => ($account_clubs->toArray())['total'],
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
    public function store(AccountClubRequest $request)
    {
        try {
            $account_club = $this->_accountClubRepo->store($request);
            if (count($request->account_club_hours)) {
                $hours = [];
                foreach ($request->account_club_hours as $value) {
                    $hours[] = [
                        'account_club_id' => $account_club['id'],
                        'title'           => $value['title'],
                        'created_at'      => Carbon::now(),
                        'updated_at'      => Carbon::now(),
                    ];
                }
                $account_club->clubHours()->createMany($hours);
            }

            return $this->jsonData(new AccountClubResource($account_club), Response::HTTP_CREATED);
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
            $account_club = $this->_accountClubRepo->findWithRelationship($id);
            if (!empty($account_club)) {
                return $this->jsonData(new AccountClubResource($account_club));
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
    public function update(AccountClubRequest $request, $id)
    {
        try {
            $account_club = $this->_accountClubRepo->update($request, $id);
                if (count($request->club_hours)) {
                    $account_club->clubHours()->delete();
                    $hours = [];
                    foreach ($request->club_hours as $value) {
                        $hours[] = [
                            'account_club_id' => $id,
                            'title'           => $value['title'],
                            'created_at'      => Carbon::now(),
                            'updated_at'      => Carbon::now(),
                        ];
                    }
                    $account_club->clubHours()->createMany($hours);
            }
            return $this->jsonData(new AccountClubResource($account_club));
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
            $account_club = $this->_accountClubRepo->find($id);
            if ($account_club) {
                if ($account_club->is_draft == config('constants.is_draft.key.is_draft')) {
                    $account_club->clubHours()->delete();
                    $this->_accountClubRepo->destroy($id);
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
