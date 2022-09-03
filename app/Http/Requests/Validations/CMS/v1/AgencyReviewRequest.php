<?php

namespace App\Http\Requests\Validations\CMS\v1;

use Illuminate\Foundation\Http\FormRequest;

class AgencyReviewRequest extends FormRequest
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
            'nickname' => 'required|max:255',
            'agency_id' => 'required',
            'is_verified' => 'required'
        ];
    }
}
