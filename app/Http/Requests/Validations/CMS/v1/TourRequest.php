<?php

namespace App\Http\Requests\Validations\CMS\v1;

use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
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
        // request()->merge([
        //     'start_date' => date('Y-m-d', strtotime(request()->start_date)),
        //     'end_date' => date('Y-m-d', strtotime(request()->end_date)),
        // ]);
        // dd(request()->all());
        return [
            'title'      => 'required|max:255',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date'   => 'required|date_format:Y-m-d',
            'country_id' => 'required',
            'city_id'    => 'required',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title'      => 'title',
            'start_date' => 'start date',
            'end_date'   => 'end date',
            'country_id' => 'country',
            'city_id'    => 'city',
        ];
    }
}
