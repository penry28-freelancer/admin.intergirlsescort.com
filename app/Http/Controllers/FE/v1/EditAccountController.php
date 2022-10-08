<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\AgencyRequest;
use App\Http\Requests\Validations\FE\v1\ClubRequest;
use App\Http\Requests\Validations\FE\v1\EscortRequest;
use App\Http\Requests\Validations\FE\v1\MemberRequest;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Http\Resources\CMS\v1\ClubResource;
use App\Http\Resources\CMS\v1\EscortResource;
use App\Http\Resources\CMS\v1\MemberResource;
use App\Repositories\Account\AccountRepository;
use App\Repositories\Agency\AgencyRepository;
use App\Repositories\Club\ClubRepository;
use App\Repositories\Escort\EscortRepository;
use App\Repositories\Member\MemberRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EditAccountController extends Controller
{
    private $_memberRepository;
    private $_clubRepository;
    private $_escortRepository;
    private $_agencyRepository;
    private $_accountRepository;

    public function __construct(
        MemberRepository $memberRepository,
        ClubRepository $clubRepository,
        EscortRepository $escortRepository,
        AgencyRepository $agencyRepository,
        AccountRepository $accountRepository
    )
    {
        $this->_memberRepository = $memberRepository;
        $this->_clubRepository = $clubRepository;
        $this->_escortRepository = $escortRepository;
        $this->_agencyRepository = $agencyRepository;
        $this->_accountRepository = $accountRepository;
    }

    public function update(Request $request)
    {
        $profile = $request->user()->profile();
        $id = $profile->id;

        // if($request->request->has('email'))
        //     $request->request->remove('email');

        $this->_accountRepository->update($request, $request->user()->id);
        $resource = call_user_func_array([$this, $profile->getTable()], [$request, $id]);
        return $this->jsonData($resource, Response::HTTP_CREATED);
    }

    public function members(Request $request, $id)
    {
        app()->make(MemberRequest::class);
        $member = $this->_memberRepository->update($request, $id);
        return new MemberResource($member);
    }

    public function clubs(Request $request, $id)
    {
        app()->make(ClubRequest::class);
        $club = $this->_clubRepository->update($request, $id);
        return new ClubResource($club);
    }

    public function agencies(Request $request, $id)
    {
        app()->make(AgencyRequest::class);
        $agency = $this->_agencyRepository->update($request, $id);
        return new AgencyResource($agency);
    }

    public function escorts(Request $request, $id)
    {
        app()->make(EscortRequest::class);
        $escort = $this->_escortRepository->update($request, $id);
        return new EscortResource($escort);
    }
}
