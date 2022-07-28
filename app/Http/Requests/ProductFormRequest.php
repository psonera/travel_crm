<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
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
            'sku'=> 'required|max:10|alpha_num', 
            'name'=> 'required|max:20|string', 
            'description'=> 'required|max:255|string', 
            'quantity'=> 'required|numeric', 
            'price'=> 'required|numeric', 
        ];
    }

    public function messages()
    {
        return [
            'sku.required' => 'Sku id required',
            'name.required' => 'Name is required!',
            'description.required' => 'Description is required',
            'quantity.required' => 'Quantity is required',
            'price.required' => 'Price is required',
        ];
    }
}


