<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;

class EscortWorkingRequest extends FormRequest
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
        // $rules = [
        //     'escort_id' => 'required|exists:escorts,id',
        //     'days.*.day_id' => 'required|exists:days,id',
        // ];

        // if(request()->method() == 'PUT')
        //     unset($rules['escort_id']);

        // return $rules;
        return [];
    }
}
