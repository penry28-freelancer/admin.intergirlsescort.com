<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class EscortServiceRequest extends BaseRequest
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
        //     'services.*.service_id' => 'required|exists:services,id',
        // ];

        // if(request()->method() == 'PUT')
        //     unset($rules['escort_id']);

        // return $rules;
        return [];
    }
}
