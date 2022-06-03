<?php

namespace App\Providers;

use App\Models\Bussines;
use App\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $bussines = Bussines::all()
            ->where('id', '>', 1);
        $users = User::with('id', '=', auth()->id());
        return View::share(['bussines' => $bussines,
            'users' => $users]);
    }
}
