<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash; 

class AccountSettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    { 
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {  
        return [
            'password' => [
                'required',
                'password_valid',
                function($attribute, $value, $fail) { 
                    $user = request()->user();  
                    $isSamePassword = Hash::check($value, $user->password);

                    if(!$isSamePassword) {
                        $fail(trans('auth.credentials_incorrect')); 
                    }
                }
            ],
            'new_password' => 'required|password_valid'
        ];
    }
}
