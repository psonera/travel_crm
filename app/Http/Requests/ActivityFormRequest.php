<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityFormRequest extends FormRequest
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
            'title'=> 'required_unless:type,note',
            'type'=> 'required',
            'comment'=> 'required_if:type,note',
            'schedule_from' => 'required_unless:type,note|date',
            'schedule_to' => 'required_unless:type,note|after:schedule_from',
            'location' => 'sometimes',
            'lead_id' => 'numeric'
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'title' => 'Title is required!',
            'type' => 'Type is required!',
            'comment' => 'Comment is required!',
            'schedule_from' => 'Schedule From is required!',
            'schedule_to' => 'Schedule To is required!'
        ];

    }
}
