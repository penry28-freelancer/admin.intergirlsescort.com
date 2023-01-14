<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class CreateAccountRequest extends BaseRequest
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
            'name' => 'required',
            'password' => 'required|min:8',
            'password1' => 'required|same:password|min:8',
            'email' => 'required|email:rfc|unique:accounts,email',
            'email1' => 'required|same:email',
            'condition' => 'required',
        ];
    }
}
