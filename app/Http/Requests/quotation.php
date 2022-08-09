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
<<<<<<< Updated upstream
            ''
=======
            'owner'=>'required',
            'subject'=>'required',
            'description'=>'required',
            'person'=>'required',
            'Lead'=>'required',
            'billing_address'=>'required',
            'b_contry'=>'required',
            'b_state'=>'required',
            'b_city'=>'required',
            'b_postcode'=>'required',
            'shipping_address'=>'required',
            's_contry'=>'required',
            's_state'=>'required',
            's_city'=>'required',
            's_postcode'=>'required',
            'itemname.*'=>'required',
            'itemquntity.*'=>'required',
            'itemprice.*'=>'required',
            'total.*'=>'required',
            'subtotal'=>'required',
            'discount'=>'required',
            'tax'=>'required',
            'grandtotal'=>'required',
>>>>>>> Stashed changes
        ];
    }
}
