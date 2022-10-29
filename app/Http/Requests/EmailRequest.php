<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            'to' => 'required|email',
            'cc' => 'email',
            'bcc' => 'email',
            'subject' => 'required',
            'content' => 'required',
            'attachment.*' => 'mimes:png,jpg,pdf,jpeg,txt|max:5000'
        ];
    }
}
