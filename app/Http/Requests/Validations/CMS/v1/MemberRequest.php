<?php

namespace App\Http\Requests\Validations\CMS\v1;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
//            'name'       => 'required|max:255',
//            'email'      => 'required|email|unique:members,email',
            'country_id' => 'required',
            'city_id'    => 'required',
//            'password'   => 'max:255|min:8',
        ];
    }
}
