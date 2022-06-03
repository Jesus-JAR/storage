<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidationDni;
use App\Rules\ValidationPhone;

class RequestUpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'min:3', 'max:15'],
            'last_name' => ['required', 'string', 'min:3', 'max:15'],
            'phone' => [new ValidationPhone, 'required',  'min:9', 'max:12'],
            'dni' => [new ValidationDni, 'required', 'string'],
            'work_hours' => 'numeric|min:6',
            'cod_emp' => 'required',

        ];
    }
    public function messages()
    {
        return  [
            'first_name.required' => 'The first name cannot be empty.',
            'first_name.min' => 'Must contain at least 3 characters.',
            'first_name.max' => 'Must contain a maximum of 16 characters.',
            'last_name.required' => 'The last name cannot be empty.',
            'last_name.min' => 'Must contain at least 3 characters.',
            'last_name.max' => 'Must contain a maximum of 16 characters.',
            'cod_emp.required' => 'Select Company',
            'phone.required' =>  'The phone cannot be empty.'
        ];
        
    }
}
