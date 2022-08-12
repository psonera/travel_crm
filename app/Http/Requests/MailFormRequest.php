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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        'to' => 'required|email:rfc,dns,spoof',
        'cc' => 'nullable|email:rfc,dns,spoof',
        'bcc' => 'nullable |email:rfc,dns,spoof',
        'subject' => 'required|',
        'content' => 'required',
        'status' => 'required', 
        'attachment' => 'nullable|image|file'
        ];
    }
}
