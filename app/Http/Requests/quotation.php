<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class quotation extends FormRequest
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
            'owner'=>'required|not_in:0',
            'subject'=>'required',
            'description'=>'required',
            'lead_manager'=>'required',
            'r_lead_manager'=>'required',
            'lead'=>'required',
            'r_lead'=>'required',
            'billing_address'=>'required',
            'b_contry'=>'required|not_in:0',
            'b_state'=>'required|not_in:0',
            'b_city'=>'required|not_in:0',
            'b_postcode'=>'required|max:6|min:6',
            'shipping_address'=>'required',
            's_contry'=>'required|not_in:0',
            's_state'=>'required|not_in:0',
            's_city'=>'required|not_in:0',
            's_postcode'=>'required|max:6|min:6',
            'name.*'=>'required',
            'oldname.*'=>'required',
            'quntity.*'=>'required|min:1|numeric',
            'price.*'=>'required|numeric',
            'amount.*'=>'required|numeric',
            'subtotal'=>'required|numeric',
            'discount'=>'required|numeric',
            'tax'=>'required|numeric',
            'grandtotal'=>'required|numeric',
        ];
    }
}
