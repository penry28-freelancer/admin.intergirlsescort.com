<?php

namespace App\Http\Requests\Validations;

use App\Http\Requests\BaseRequest;

class UpdateUserRequest extends BaseRequest
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
        $id = \Request::segment(count(\Request::segments()));

        return [
           'name' => 'bail|required|max:255',
           'email' =>  'email|max:255|unique:users,email,'.$id,
        ];
    }
}
