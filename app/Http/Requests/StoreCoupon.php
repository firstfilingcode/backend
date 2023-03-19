<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoupon extends FormRequest
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
			'discount' => 'required',
			'start_date' => 'required',
			'end_date' => 'required',
			];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [                                    
                'name' => 'required|max:255',
				'discount' => 'required',
				'start_date' => 'required',
				'end_date' => 'required',
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
            'discount.required' => 'Discount is required!',
            'start_date.required' => 'Start is required!',
            'end_date.required' => 'Discount is required!'
        ];
    }
}
