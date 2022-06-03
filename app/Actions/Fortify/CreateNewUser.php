<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Rules\ValidationDni;
use App\Rules\ValidationName;
use App\Rules\ValidationPhone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */


    public function create(array $input)
    {
        Validator::make($input, [
            'first_name' => [new ValidationName, 'required', 'string'],
            'last_name' => [new ValidationName, 'required', 'string'],
            'phone' => [new ValidationPhone, 'required'],
            'dni' => [new ValidationDni, 'required', 'string', 'unique:users,dni'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'bussines' => ['required'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();


        return User::create([
            'first_name' => ucfirst(trans($input['first_name'])),
            'last_name' => ucfirst(trans($input['last_name'])),
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'cod_emp' => $input['bussines'],
            'dni' => strtoupper($input['dni']),
            'work_hours' => 8,
            'phone' => $input['phone'],
        ])->assignRole('Developer');

    }


}
