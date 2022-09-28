<?php

namespace App\Http\Requests\Validations\FE\v1;

use Illuminate\Foundation\Http\FormRequest;

class EscortAboutRequest extends FormRequest
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
            'name' => 'required|max:255',
            'country_id' => 'required',
            'city_id' => 'required',
            'sex' => 'required',
            'birt_year' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'ethnicity' => 'required',
            'hair_color' => 'required',
            'hair_lenght' => 'required',
            'bust_size' => 'required',
            'bust_type' => 'required',
            'provides1' => 'required',
            'nationality_counter_id' => 'required',
            'travel' => 'required',
            'languages' => 'required',
            'tattoo' => 'required',
            'piercing' => 'required',
            'smoker' => 'required',
        ];
    }
}
