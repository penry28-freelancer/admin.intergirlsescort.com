<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class EscortRateRequest extends BaseRequest
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
            'escort_id' => 'required|exists:escorts,id',
            'rates.rate_30' => 'numeric|min:20|max:1017',
            'rates.rate_1' => 'numeric|min:30|max:2033',
            'rates.rate_2' => 'numeric|min:61|max:3050',
            'rates.rate_3' => 'numeric|min:91|max:4066',
            'rates.rate_6' => 'numeric|min:132|max:6100',
            'rates.rate_12' => 'numeric|min:103|max:10166',
            'rates.rate_24' => 'numeric|min:254|max:18299',
            'rates.rate_48' => 'numeric|min:305|max:30498',
            'rates.rate_a24' => 'numeric|min:152|max:15249',
        ];

        if(request()->method() == 'PUT')
            unset($rules['escort_id']);

        return $rules;
    }
}
