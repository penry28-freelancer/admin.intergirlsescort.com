<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\AccountSettingRequest;
use App\Http\Resources\FE\v1\AccountFavoritesResource;
use App\Http\Resources\FE\v1\AccountResource;
use App\Repositories\Account\AccountRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AccountSettingController extends Controller
{

    private $_accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->_accountRepository = $accountRepository;
    }

    public function update(AccountSettingRequest $request)
    {
        $request->merge([
            'password' => Hash::make($request->validated()['new_password'])
        ]);

        $user = $request->user();

        try {
            $account = $this->_accountRepository->update($request, $user->id);

            return $this->jsonData(new AccountResource($account));
        } catch(Exception $ex) {
            return $this->jsonError($ex->getMessage());
        }
    }

    public function addFavorite($senderId, $receiverId)
    {
        try {
            $senderAccount = $this->_accountRepository->find($senderId);
            $receiverAccount =  $this->_accountRepository->find($receiverId);

            if ($senderAccount && $receiverAccount) {
                $senderAccount->favorites()->sync([$receiverId], false);
                return $this->jsonMessage('Added favorite escort successfully!', true, Response::HTTP_CREATED);
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }

    public function listFavorites($accountId)
    {
        try {
            $account = $this->_accountRepository->find($accountId);

            if ($account) {
                return $this->jsonData(new AccountFavoritesResource($account));
            }

            return $this->jsonMessage(trans('messages.not_found'), false, Response::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->jsonError($e);
        }
    }
}
