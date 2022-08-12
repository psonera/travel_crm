<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadManagerFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=> 'required|max:30|string', 
            'email'=> 'required|email', 
            'contact_number'=> 'required|digits:10|regex:/^([0-9\s\-\+\(\)]*)$', 
            'lead_source_id'=> 'required',
            'manager_image' => 'image|required|mimes:png,jpeg,gif|size:5000', /* 5 MB */ 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'contact_number.required' => 'Contact Number is required!',
            'lead_sorce_id.required' => 'Lead Source is required!'
        ];
    }
}
