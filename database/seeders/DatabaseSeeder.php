<?php

namespace Database\Seeders;

use App\Models\Records;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // bussines
        $this->call(BussinesSeeder::class);

        // Roles y permisos
        $this->call(RoleSeeder::class);

        // Usuarios
        //$this->call(UserSeeder::class);
        // Usuarios base

        /*
         *         User::factory(50)->create()->each(function ($user){
            $user->assignRole('Developer');
        });
        */

        // bussines
//        $this->call(Records::class);
    }
}
