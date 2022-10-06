<?php

namespace App\Http\Controllers\FE\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Validations\FE\v1\AccountSettingRequest;
use App\Http\Resources\FE\v1\AccountResource;
use App\Repositories\Account\AccountRepository;
use Exception;
use Illuminate\Http\Request;
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
}
