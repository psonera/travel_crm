<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailFormRequest extends FormRequest
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
        'cc' => 'sometimes|email',
        'bcc' => 'sometimes|email',
        'subject' => 'required',
        'content' => 'required',
        'status' => 'required',
        'attachment.*' => ['nullable','mimes:png,jpg,pdf,txt','size:5000']
        ];
    }
}