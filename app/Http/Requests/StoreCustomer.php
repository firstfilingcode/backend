<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomer extends FormRequest
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

    switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
             return [
			'name' => 'required|max:255',
            'username' => 'required|unique:customers,username,NULL,id,deleted_at,NULL',
			'mobile' => 'required|unique:customers,mobile,NULL,id,deleted_at,NULL',
			'email' => 'required|email|max:255|unique:customers,email,NULL,id,deleted_at,NULL',	
            'password' => 'min:8|required|required_with:confirmpassword|same:confirmpassword',
			];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [                    
                //'name' => 'unique:countries,country_name,'.$this->get('id').'|max:255'                
                'name' => 'required|max:255',
                'username' => 'required|unique:customers,username,NULL,id,deleted_at,NULL',
                'mobile' => 'required|unique:customers,mobile,NULL,id,deleted_at,NULL',
                'email' => 'required|email|max:255|unique:customers,email,NULL,id,deleted_at,NULL',
            ];			
        }
        default:break;
    }    
}
	
	 /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email is already exists!',
            'email.max' => 'Email is max 255 char!',
			'mobile.required' => 'Mobile is required!',
			'mobile.integer' => 'Mobile is integer!',
            'mobile.unique' => 'Mobile Number is already exists!',
            'password.required' => "Password required",
            'password.min' => "Password should be 8 character",
            "password.required_with" => "Confirm Password requrided!",
            'password.same' => 'Confirm Password not match!',
            

        ];
    }
}

