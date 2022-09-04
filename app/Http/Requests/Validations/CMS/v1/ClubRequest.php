<?php

namespace App\Http\Requests\Validations\CMS\v1;

use Illuminate\Foundation\Http\FormRequest;

class ClubRequest extends FormRequest
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
            'name'               => 'required|max:255',
            'website_url'        => 'max:255',
            'club_hours.*.title' => 'max:255',
            'phone_1'            => 'max:255',
            'phone_2'            => 'max:255',
            'country_id'         => 'required',
            'city_id'            => 'required',
            'address'            => 'max:255',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'               => 'name',
            'website_url'        => 'website url',
            'club_hours.*.title' => 'office hours',
            'phone_1'            => 'phone 1',
            'phone_2'            => 'phone 2',
            'country_id'         => 'country',
            'city_id'            => 'city',
            'address'            => 'address',
        ];
    }
}
