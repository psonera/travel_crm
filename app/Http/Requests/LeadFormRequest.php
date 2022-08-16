<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadFormRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'string',
            'lead_value' => 'required',
            'traveler_count' => 'required',
            'selected_trip_date' => 'date_format:Y-m-d|date|after:today',
            'user_id' => 'required',
            'lead_manager_id' => 'required',
            'lead_source_id' => 'required',
            'lead_type_id' => 'required',
            'lead_pipeline_stage_id' => 'required',
            'trip_id' => 'required',
            'trip_type_id' => 'required',
            'accomodation_id' => 'required',
            'transport_id' => 'required',
            'expected_closed_date' => 'date|date_format:Y-m-d',
        ];

        if($this->products){
            foreach($this->products as $key => $val)
            {
                $rules['products.' . $key . '.name'] = 'required';
                $rules['products.' . $key . '.price'] = 'required';
                $rules['products.' . $key . '.quantity'] = 'required';
                $rules['products.' . $key . '.id'] = 'required';
            }
        }

        return $rules;
    }
}
