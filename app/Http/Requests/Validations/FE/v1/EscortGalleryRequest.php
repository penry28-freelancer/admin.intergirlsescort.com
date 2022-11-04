<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class EscortGalleryRequest extends BaseRequest
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
            'photos' => 'required',
            // 'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'escort_id' => 'required|exists:escorts,id'
        ];

        if(request()->segment(5) == 'update-escort') {
            unset($rules['escort_id']);
        }

        return $rules;
    }
}
