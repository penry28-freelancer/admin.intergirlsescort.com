<?php

namespace App\Http\Controllers\Api\v1\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\PasswordReset;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use App\Notifications\Auth\SendVerificationEmail;
use App\Http\Requests\Validations\ResetPasswordRequest;

class AuthController extends Controller
{
    private $_userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->_userRepo = $userRepo;
    }

    /**
     * Handle user login
     * @param App\Http\Requests\Validations\LoginRequest $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            $request->request->add([
                'username'      => $request->email,
                'password'      => $request->password,
                'client_id'     => config('services.passport.client_id'),
                'client_secret' => config('services.passport.client_secret'),
                'grant_type'    => 'password',
            ]);

            return $this->_getToken($request);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Reset the given user's password.
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request)
    {
        try {
            $email = $request->email;
            $user = $this->_userRepo->findBy('email', $email);
            if (! $user) {
                return $this->jsonError(trans('auth.password_reset_user'));
            }
            $passwordReset             = PasswordReset::firstOrNew(['email' => $email]);
            $passwordReset->email      = $email;
            $passwordReset->token      = \Str::random(60);
            $passwordReset->created_at = Carbon::now();
            $passwordReset->save();
            $url = url("/reset-password/{$passwordReset->token}");
            $user->notify(new SendVerificationEmail($url, $passwordReset->token));

            return $this->jsonMessage(trans('messages.sent_token_reset_pwd_success'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            $passwordResetBuilder = PasswordReset::where('token', $request->token);
            $passwordReset        = $passwordResetBuilder->first();
            if (
                Carbon::parse($passwordReset->created_at)->addMinutes(PasswordReset::EXPIRE_TOKEN)->isPast() ||
                !$passwordReset
            ) {
                return $this->jsonMessage(trans('validation.token_valid'), false);
            }
            $user           = $this->_userRepo->findBy('email', $passwordReset->email);
            $user->password = $request->password;
            $user->save();
            $passwordResetBuilder->delete();
            return $this->jsonMessage(trans('auth.reset_password_successfully'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Get token for user
     * @param Request $request
     * @return JsonResponse
     */
    private function _getToken($request)
    {
        $tokenRequest = $request->create(config('services.passport.login_endpoint'), 'POST');
        $response     = \Route::dispatch($tokenRequest);

        switch($response->getStatusCode()) {
            case Response::HTTP_OK:
                return $this->jsonData(json_decode($response->getContent(), true));
            case Response::HTTP_BAD_REQUEST:
                return $this->jsonMessage(trans('auth.login_fail'), false, $response->getStatusCode());
            case Response::HTTP_UNAUTHORIZED:
                return $this->jsonMessage(trans('auth.credentials_incorrect'), false, $response->getStatusCode());
            default:
                return $this->jsonMessage($response->getContent(), false, $response->getStatusCode());
        }
    }

    /**
     * Get the user auth is logged
     * @return JsonResponse
     */
    public function getUserAuth()
    {
        try {
            $user = \Auth::user();

            return $this->jsonData($user);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    /**
     * Handle logout user auth
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            \Auth::user()->token()->delete();

            return $this->jsonMessage(trans('auth.logout'));
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
