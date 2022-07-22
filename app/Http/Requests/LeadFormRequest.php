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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'nullable|sometimes',
            'lead_value' => 'required',
            'lead_source_id' => 'required',
            'lead_type_id' => 'required',
            'lead_manager_id' => 'required',
            'expected_closed_date' => 'date|nullable|sometimes',
        ];
    }
}
