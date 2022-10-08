<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\CreateAccountRequest;
use App\Http\Requests\Validations\FE\v1\RemindPasswordRequest;
use App\Http\Requests\Validations\FE\v1\SetPasswordRequest;
use App\Http\Requests\Validations\LoginRequest;
use App\Http\Resources\CMS\v1\AgencyResource;
use App\Http\Resources\CMS\v1\ClubResource;
use App\Http\Resources\CMS\v1\EscortResource;
use App\Http\Resources\CMS\v1\MemberResource;
use App\Http\Resources\FE\v1\UserAuthResource;
use App\Jobs\RemindPassword;
use App\Jobs\VerifyCreateAccount;
use App\Repositories\Account\AccountRepository;
use App\Repositories\Agency\AgencyRepository;
use App\Repositories\Club\ClubRepository;
use App\Repositories\Escort\EscortRepository;
use App\Repositories\Member\MemberRepository;
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
    private $_accountRepository;

    public function __construct(
        EscortRepository $escortRepository,
        AgencyRepository $agencyRepository,
        MemberRepository $memberRepository,
        ClubRepository $clubRepository,
        AccountRepository $accountRepository
    )
    {
        $this->_escortRepository = $escortRepository;
        $this->_agencyRepository = $agencyRepository;
        $this->_memberRepository = $memberRepository;
        $this->_clubRepository = $clubRepository;
        $this->_accountRepository = $accountRepository;
    }

    public function store(Request $request)
    {
        $type = $request->get('type');

        app()->make(CreateAccountRequest::class);
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

    public function girl(Request $request)
    {
        $escort = $this->_escortRepository->store($request);
//        $token
        $escort->accountable()->create(
            $request->only([ 'name', 'email', 'password', 'token'])
        );

        // send email verified
        $this->dispatch(new VerifyCreateAccount($this->_getDataForFormEmail($request), 'Independent escort'));

        return new EscortResource($escort);
    }

    public function agency(Request $request)
    {
        $agency = $this->_agencyRepository->store($request);

        $agency->accountable()->create(
            $request->only([ 'name', 'email', 'password', 'token'])
        );

        $this->dispatch(new VerifyCreateAccount($this->_getDataForFormEmail($request), 'Escort Agency'));

        return new AgencyResource($agency);
    }

    public function user(Request $request)
    {
        $member = $this->_memberRepository->store($request);

        $member->accountable()->create(
            $request->only([ 'name', 'email', 'password', 'token'])
        );

        $this->dispatch(new VerifyCreateAccount($this->_getDataForFormEmail($request), 'Member Agency'));

        return new MemberResource($member);
    }

    public function club(Request $request)
    {
        $club = $this->_clubRepository->store($request);

        $club->accountable()->create(
            $request->only([ 'name', 'email', 'password', 'token'])
        );

        $this->dispatch(new VerifyCreateAccount($this->_getDataForFormEmail($request), 'Strip Club / Cabaret'));

        return new ClubResource($club);
    }

    public function approve(Request $request)
    {
        try {
            $account = $this->_accountRepository->findBy('token', $request->token);
            if ($account) {
                $account->is_verified = config('constants.verified.true');
                $account->email_verified_at = Carbon::now();
                $account->token = null;
                $account->save();

                auth()->guard('client')->login($account);
                $accessToken = $account->createToken('Personal Access Token', ['client'])->accessToken;

                return $this->jsonData([
                    'access_token' => $accessToken
                ]);
            } else {
                return $this->jsonError('Token not valid');
            }
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    private function _getDataForFormEmail(Request $request)
    {
        return $request->only(['name', 'email', 'password1', 'token']);
    }

    public function login(Request $request)
    {
        try {
            app()->make(LoginRequest::class);
            $credentials = $request->only(['email', 'password']);

            if (!auth()->guard('client')->attempt($credentials)) {
                return $this->jsonMessage('Unauthorized', false, Response::HTTP_UNAUTHORIZED);
            }

            $account = $this->_accountRepository->find(
                auth()->guard('client')->user()->id
            );

            auth()->guard('client')->login($account);

            $accessToken = $account->createToken('Personal Access Token', ['client'])->accessToken;
            return $this->jsonData([
                'access_token' => $accessToken
            ]);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function info(Request $request)
    {
        try {
            return $this->jsonData(new UserAuthResource($request->user()));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function remindPassword(RemindPasswordRequest $request)
    {
        try {
            $account = $this->_accountRepository->findBy('email', $request->email);
            if($account) {
                $account->is_verified = 0;
                $account->email_verified_at = null;
                $account->token = Str::random(60);
                $account->save();

                $this->dispatch(new RemindPassword($request->email, $account->token));
                return $this->jsonMessage(trans('messages.sent_token_reset_pwd_success'));
            } else {
                return $this->jsonMessage(trans('auth.password_reset_user'));
            }
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
    public function setPassword(SetPasswordRequest $request)
    {
        $hash = $request->get('hash');

        try {
            if ($hash) {
                $account = $this->_accountRepository->findBy('token', $hash);

                if($account) {
                    $account->is_verified = 1;
                    $account->email_verified_at = Carbon::now();
                    $account->password = \Hash::make($request->password);
                    $account->token = null;

                    $account->save();
                    return $this->jsonMessage(trans('messages.pwd_has_been_reset'));
                } else {
                    return $this->jsonMessage(trans('auth.password_reset_user'));
                }
            } else {
                return $this->jsonMessage(trans('Hash invalid'));
            }

        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function logout()
    {
        \Auth::guard('client-api')->user()->token()->delete();
        return response()->json(['message' => 'ユーザーが正常にサインアウトしました']);
    }
}
