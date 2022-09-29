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
            'counter_currency_id' => 'nullable|exists:currencies,id',
            'rate_incall_30' => 'numeric|min:20|max:1017',
            'rate_outvall_30' => 'numeric|min:20|max:1017',
            'rate_incall_1' => 'numeric|min:30|max:2033',
            'rate_outvall_1' => 'numeric|min:30|max:2033',
            'rate_incall_2' => 'numeric|min:61|max:3050',
            'rate_outvall_2' => 'numeric|min:61|max:3050',
            'rate_incall_3' => 'numeric|min:91|max:4066',
            'rate_outvall_3' => 'numeric|min:91|max:4066',
            'rate_incall_6' => 'numeric|min:132|max:6100',
            'rate_outvall_6' => 'numeric|min:132|max:6100',
            'rate_incall_12' => 'numeric|min:103|max:10166',
            'rate_outvall_12' => 'numeric|min:103|max:10166',
            'rate_incall_24' => 'numeric|min:254|max:18299',
            'rate_outvall_24' => 'numeric|min:254|max:18299',
            'rate_incall_48' => 'numeric|min:305|max:30498',
            'rate_outvall_48' => 'numeric|min:305|max:30498',
            'rate_incall_24_second' => 'numeric|min:152|max:15249',
            'rate_outvall_24_second' => 'numeric|min:152|max:15249',
        ];
    }
}
