<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;

class EscortGalleryRequest extends FormRequest
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
            'escort_id' => 'required|exists:escorts,id',
            'photos' => 'required',
            'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'required'
        ];
    }
}
