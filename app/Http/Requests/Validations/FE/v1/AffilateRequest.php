<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class AffilateRequest extends BaseRequest
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
            'website'   => 'required|max:255|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'surname'   => 'required|max:255',
            'address'   => 'required|max:255',
            'zip'       => 'required',
            'city'      => 'required|max:255',
            'country'   => 'required|max:255',
            'phone'     => 'required|max:255',
        ];
    }
}
