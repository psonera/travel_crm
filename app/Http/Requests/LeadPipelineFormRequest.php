<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadPipelineFormRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'is_default' => 'required',
            'rotten_days' => 'required|numeric',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'is_default.required' => 'Default is required!',
            'rotten_days.required' => 'Expiry Days is required!',
           
        ];
    }
}
