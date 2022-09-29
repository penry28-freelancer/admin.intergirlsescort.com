<?php

namespace App\Http\Requests\Validations\CMS\v1;

use Illuminate\Foundation\Http\FormRequest;

class AgencyRequest extends FormRequest
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
            'email'                => 'required',
            'country_id'           => 'required',
            'city_id'              => 'required',
            'website'              => 'max:255|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'banner_url'           => 'max:255|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'calling_country_id_1' => 'required',
            'phone_1'              => 'required',
        ];
    }
}
