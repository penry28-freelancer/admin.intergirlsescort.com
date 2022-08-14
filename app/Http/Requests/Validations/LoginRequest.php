<?php

namespace App\Http\Requests\Validations;

// use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email'    => 'bail|required|email:rfc',
            'password' => 'bail|required|password_valid'
        ];
    }

    /**
     * Get the custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email'    => strtolower(trans('app.field.email')),
            'password' => strtolower(trans('app.field.password')),
        ];
    }

    /**
     * Get the error messages for the defined validators rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.password_valid' => trans('validation.password_valid')
        ];
    }
}
