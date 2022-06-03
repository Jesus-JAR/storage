<?php

namespace App\Http\Controllers;

use App\Models\Bussines;
use Illuminate\Http\Request;

class BussinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function __invoke()
    {
        $bussines = Bussines::all();
        return view('auth.register', compact('bussines'));
    }

    public function index()
    {
        //
    }



}
