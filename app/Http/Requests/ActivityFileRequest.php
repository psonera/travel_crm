<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityFileRequest extends FormRequest
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
            'title' => 'string',
            'comment' => 'string',
            'type' => 'required',
            'lead_id' => 'numeric',
            'activity_file' => 'required|mimes:doc,docx,txt,pdf,jpg,png,jpeg,gif', 
        ];
    }

    public function messages()
    {
        return [
            'activity_file.required' => 'File is required'
        ];
    }
}
