<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailTemplateFormRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'subject' => 'required|string|max:100',
            'content' => 'required|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'subject.required' => 'Subject is required!',
            'content.required' => 'Content is required!',

        ];
    }
}
