<?php

namespace App\Http\Requests\Validations\FE\v1;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
