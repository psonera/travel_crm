<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadManagerFormRequest extends FormRequest
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
            'name'=> 'required',
            'email'=> 'required|email',
            'phone'=> 'required',
            'leadsource'=> 'required',
            'status'=> 'required',
        ];

        if($this->has('password')){
            $rules['password'] = "required";
        }

        return $rules;
    }


}
