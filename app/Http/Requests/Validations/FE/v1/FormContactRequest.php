<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;

class FormContactRequest extends FormRequest
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
        $rules = [
            'name'      => 'required|max:255',
            'email'     => 'required|email:rfc',
            'message'   => 'required|max:255'
        ];

        if(request()->has('receive_id')) {
            $rules['receive_id'] = 'required|exists:accounts,id';
        }

        return $rules;
    }
}
