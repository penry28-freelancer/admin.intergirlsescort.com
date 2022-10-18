<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class EscortAboutBannerRequest extends BaseRequest
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
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'escort_id' => 'required|exists:escorts,id'
        ];

        if(request()->segment(5) == 'update-escort') {
            unset($rules['escort_id']);
        }

        return $rules;
    }
}
