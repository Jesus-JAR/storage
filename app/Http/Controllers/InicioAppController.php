<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use App\Rules\ValidationDni;
use App\Rules\ValidationName;
use App\Rules\ValidationPhone;
use Illuminate\Http\Request;

class InicioAppController extends Controller
{
    use PasswordValidationRules;


    public function create()
    {
        return view('users.inicio-app');
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'first_name' => [new ValidationName, 'required', 'string'],
            'last_name' => [new ValidationName, 'required', 'string'],
            'phone' => [new ValidationPhone, 'required'],
            'dni' => [new ValidationDni, 'required', 'string', 'unique:users,dni'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'cod_emp' => ['required'],
            'password' => $this->passwordRules(),
        ]);

        $user = User::create(request([
            'first_name',
            'last_name',
            'phone',
            'dni',
            'email',
            'cod_emp',
            'password',
            'work_hours'
        ]))->assignRole('Super Admin');

        auth()->login($user);
        return redirect()->to('dashboard');
    }
}
