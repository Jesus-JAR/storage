<?php

namespace Database\Seeders;

use App\Models\Bussines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BussinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Admin = new Bussines();
        $Admin = DB::table('bussines')->insert(
            [
                'name' => 'Admin',
                'created_at' => now(),
            ],
        );

        $company = new Bussines();
        $company = DB::table('bussines')->insert(
            [
            'name' => 'Nintendo',
            'description' => 'Nintendo is one of the leading international interactive entertainment companies, and is focused on the development, production and sale of consoles and video games',
            'address' => '10 Rockefeller Plaza, New York, NY 10020, United States',
            'created_at' => now(),
            ],
        );
        $company2 = new Bussines();
        $company2 = DB::table('bussines')->insert(
            [
                'name' => 'Coca-cola',
                'description' => 'Company dedicated to the sale of carbonated drinks',
                'address' => 'Coca Cola Pl SE Atlanta (HQ), GA',
                'created_at' => now(),
            ]
        );

    }
}
