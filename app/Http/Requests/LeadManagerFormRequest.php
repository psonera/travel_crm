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
            'email'=> 'required|email|unique:users',
            'phone'=> 'required|regex:/(91)[0-9]{10}/|max:12|min:12',
            'leadsource'=> 'required',
            'status'=> 'required',
            'profile_image'=>['sometimes','mimes:jpg,png','max:5000'],
        ];
        if($this->has('password')){
            $rules['password'] = 'required|string|confirmed';
        }
        if($this->has('manager')){
            $rules['manager'] = 'required';
            $rules['r_manager'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'password.required' => 'Password is required!',
            'r_manager.required'=>'Please Select From Result!'
        ];
    }

}
