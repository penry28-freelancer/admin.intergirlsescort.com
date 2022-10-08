<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;

class MemberRequest extends BaseRequest
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
        $user = request()->user();
        return [
            'name'       => 'required|max:255',
            'email'      => 'required|email|unique:accounts,email,'.$user->id,
            'country_id' => 'required',
            'city_id'    => 'required',
        ];
    }
}
