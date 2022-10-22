<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripFormRequest extends FormRequest
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
            'title'=> 'required|string|max:255', 
            'description'=> 'required', 
            'location'=> 'required|string|max:255', 
            'start_date'=> 'required|date', 
            'end_date'=> 'required|date', 
            'batch_size'=> 'required|numeric',
            'price'=> 'required|numeric',
            'trip_type_id'=> 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'description.required' => 'Description is required!',
            'location.required' => 'Location is required!',
            'start_date.required' => 'Start date is required',
            'end_date.required' => 'End date is required!',
            'batch_size.required' =>'Batch Size is required!',
            'price.required' => 'Price is required!',
            'trip_type_id.required' => 'Trip Type is required!'
        ];
    }
}