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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=> 'required|max:30|string',
            'type'=> 'required|boolean',
            'comment'=> 'required|max:200|string',
            'schedule_from' => 'required|date',
            'schedule_to' => 'required|after:schedule_from',
            'is_done' => 'required|boolean',
            'user_id' => 'required',
            'location'=> 'required|max:200|string', 
           
        ];
    }
    public function messages()
    {
        return [
            'title' => 'Title is required!',
            'type' => 'Type is required!',
            'comment' => 'Comment is required!',
            'schedule_from' => 'Schedule From is required!',
            'schedule_to' => 'Schedule To is required!',
            'is_done' => 'Is Done is required!',
            'user_id' => 'User ID is required!',
            'location' => 'Location is required!',
        ];
    }
}
