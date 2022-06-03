<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationPhone implements Rule
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
        return ($this->isValidPhoneLandline($value) || $this->isValidPhoneMobile($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The number phone no is validate.';
    }
public function isValidPhoneLandline($phone)
{
    $nieRegEx = '/(\+34|0034|34)?[ -]*(8|9)[ -]*([0-9][ -]*){8}/';


    if (preg_match($nieRegEx, $phone)) {


        return true;
    }

    return false;
}
    public function isValidPhoneMobile($phone)
    {
        $nieRegEx = '/(\+34|0034|34)?[ -]*(6|7)[ -]*([0-9][ -]*){8}/';


        if (preg_match($nieRegEx, $phone)) {


            return true;
        }

        return false;
    }

}
