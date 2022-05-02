<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HospitalRequest extends FormRequest
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
            'name'                  => 'required',
            'user_id'               => 'required',
            'address'               => 'required',
            'phone'                 => 'required',
            'facilities_services'   => 'required',
            'active_cases'          => 'required',
            'deaths'                => 'required',
            'recovered_patients'    => 'required',
        ];
    }
}
