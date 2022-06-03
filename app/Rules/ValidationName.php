<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationName implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($this->isValidname($value));
    }


    public function isValidname($name)
    {
        $nieRegEx = '/[a-zA-Z]{3,15}/';


        if (preg_match($nieRegEx, $name)) {

            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @param $name
     * @return string[]
     */

    public function message()
    {
        return[
            'first_name.required' => 'The field is required',
            'first_name.min' => 'Enter more than 2 characters',
            'first_name.max' => 'Enter less than 16 characters',

            'last_name.required' => 'The field is required',
            'last_name.min' => 'Enter more than 2 characters',
            'last_name.max' => 'Enter less than 16 characters',

        ];
    }
}
