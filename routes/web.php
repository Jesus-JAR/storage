<?php


use App\Http\Controllers\InicioAppController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\CheckIn;
use App\Http\Livewire\Users;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

$users = User::all()->isEmpty();
if ($users){
    Route::get('/', [InicioAppController::class, 'create']);
    Route::post('/', [InicioAppController::class, 'store']);
}else{
    Route::get('/', function () {
        return view('welcome');
    })->name('welcome');
}


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'

])->group(callback: function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    /*
     * users
     */
    Route::get('/users', function () {
        return view('users.users');
    })->name('users');

    /*
     *  Check in
     */
    Route::get('/check-in', function () {
        return view('records.check-in');
    })->name('check');

        /*
     *  Bussines
     */
    Route::get('/bussines', function () {
        return view('bussines.bussines');
    })->name('bussines');

    /*
    *  Pdf
     */
    Route::get('download-pdf', [CheckIn::class,'downloadPDF'])->name('download-pdf');


});
