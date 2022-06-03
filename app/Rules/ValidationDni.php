<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidationDni implements Rule
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
        return ($this->isValidNif($value) || $this->isValidNie($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The DNI is incorrect.';
    }
    public function isValidNif($nif)
    {

        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';
        if ($nif === strtolower($nif)){
            $letras = strtolower("TRWAGMYFPDXBNJZSQVHLCKE");

        }else{
            $letras ="TRWAGMYFPDXBNJZSQVHLCKE";

        }

        if (preg_match($nifRegEx, $nif)) {
            return ($letras[(substr($nif, 0, 8) % 23)] == $nif[8]);
        }
/*
 * //45311098v
 */
        return false;
    }
    public function isValidNie($nif)
    {
        $nieRegEx = '/^[KLMXYZ][0-9]{7}[A-Z]$/i';

        if ($nif === strtolower($nif)){
            $letras = strtolower("TRWAGMYFPDXBNJZSQVHLCKE");

        }else{
            $letras ="TRWAGMYFPDXBNJZSQVHLCKE";

        }

        if (preg_match($nieRegEx, $nif)) {

            $r = str_replace(['X', 'Y', 'Z'], [0, 1, 2], $nif);

            return ($letras[(substr($r, 0, 8) % 23)] == $nif[8]);
        }

        return false;
    }
}
