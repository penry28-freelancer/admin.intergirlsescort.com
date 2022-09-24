<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateAccountRequest extends FormRequest
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
            'password' => 'required|password_valid',
            'password1' => 'required|password_valid',
            'email' => 'required|email:rfc',
            'email1' => 'required|same:email',
            'condition' => 'required',
            'condition1' => 'required',
        ];
    }
}
