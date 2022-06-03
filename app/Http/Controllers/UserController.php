<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Requests\RequestUpdateUser;
use App\Models\Bussines;
use App\Models\User;
use App\Rules\ValidationDni;
use App\Rules\ValidationName;
use App\Rules\ValidationPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{
    use PasswordValidationRules;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('users.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $data = request()->validate([
            'first_name' => ['regex:[a-zA-Z]','required', 'string', 'min:3', 'max:15'],
            'last_name' => ['regex:[a-zA-Z]','required', 'string', 'min:3', 'max:15'],
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => [new ValidationPhone, 'required',  'min:9', 'max:12'],
            'dni' => [new ValidationDni, 'required', 'string', 'unique:users,dni'],
            'password' => $this->passwordRules(),
        ]);

        User::create([
            'first_name' => ucfirst(trans($data['first_name'])),
            'last_name' => ucfirst(trans($data['last_name'])),
            'email' => $data['email'],
            'password' => 'password',
            'cod_emp' => $data['cod_emp'],
            'dni' =>  strtoupper($data['dni']),
            'work_hours' => 8,
            'phone' => $data['phone'],
            'remember_token' => Hash::make($data['email']),
        ])->assignRole('Developer');


        session()->flash('message', 'User created successfully');
         return redirect()->route('users.list');
    }
    public function message()
    {
        return[
            'email.required' => 'The field is required',
            'email.email' => 'Must be a valid email',
        ];
    }


}
