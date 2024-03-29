<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;

class FormReportRequest extends FormRequest
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
            'nick'          => 'required',
            'name'          => 'required',
            'email'         => 'nullable|email',
            'description'   => 'required',
            'images.report' => 'required',
        ];
    }
}
