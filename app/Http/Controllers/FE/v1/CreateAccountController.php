<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\CreateAccountRequest;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Http\Resources\CMS\v1\ClubResource;
use App\Http\Resources\CMS\v1\EscortResource;
use App\Http\Resources\CMS\v1\MemberResource;
use App\Jobs\VerifyCreateAccount;
use App\Repositories\Agency\AgencyRepository;
use App\Repositories\Club\ClubRepository;
use App\Repositories\Escort\EscortRepository;
use App\Repositories\Member\MemberRepository;
use App\Repositories\Token\TokenRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class CreateAccountController extends Controller
{
    private $_escortRepository;
    private $_agencyRepository;
    private $_memberRepository;
    private $_clubRepository;
    private $_tokenRepository;

    public function __construct(
        EscortRepository $escortRepository,
        AgencyRepository $agencyRepository,
        MemberRepository $memberRepository,
        ClubRepository $clubRepository,
        TokenRepository $tokenRepository
    )
    {
        $this->_escortRepository = $escortRepository;
        $this->_agencyRepository = $agencyRepository;
        $this->_memberRepository = $memberRepository;
        $this->_clubRepository = $clubRepository;
        $this->_tokenRepository = $tokenRepository;
    }

    public function store(CreateAccountRequest $request)
    {
        $type = $request->get('type');
        $request->merge([
            'password' => \Hash::make($request->password),
            'active' => 0,
            'country_id' => 1,
            'city_id' => 1,
            'token' => Str::random(60)
        ]);
        try {
            // create type of account
            $resource = call_user_func([$this, $type], $request);
            return $this->jsonData($resource, Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    protected function girl(Request $request)
    {
        $escort = $this->_escortRepository->store($request);
//        $token
        $escort->tokenable()->create([
            'token' => $request->token
        ]);

        // send email verified
        $this->dispatch(new VerifyCreateAccount($this->getDataFormEmailForm($request), 'Independent escort'));

        return new EscortResource($escort);
    }
    protected function agency(Request $request)
    {
        $agency = $this->_agencyRepository->store($request);

        $agency->tokenable()->create([
            'token' => $request->token
        ]);

        $this->dispatch(new VerifyCreateAccount($this->getDataFormEmailForm($request), 'Escort Agency'));

        return new AgencyResource($agency);
    }
    protected function user(Request $request)
    {
        $member = $this->_memberRepository->store($request);

        $member->tokenable()->create([
            'token' => $request->token
        ]);

        $this->dispatch(new VerifyCreateAccount($request, 'Member Agency'));

        return new MemberResource($member);
    }
    protected function club(Request $request)
    {
        $club = $this->_clubRepository->store($request);

        $club->tokenable()->create([
            'token' => $request->token
        ]);

        $this->dispatch(new VerifyCreateAccount($this->getDataFormEmailForm($request), 'Strip Club / Cabaret'));

        return new ClubResource($club);
    }
    public function approve(Request $request, $token)
    {
        try {
            $foundToken = $this->_tokenRepository->findBy('token', $token);
            if ($foundToken) {
                $foundToken->is_verified = 1;
                $foundToken->email_verified_at = Carbon::now();
                $foundToken->save();

                return $this->jsonMessage('ok', Response::HTTP_CREATED);
            } else {
                return $this->jsonError('Token not valid');
            }
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    private function getDataFormEmailForm(Request $request)
    {
        return $request->only(['name', 'email', 'password1', 'token']);
    }
}
