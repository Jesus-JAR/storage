<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $super_admin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $developer = Role::create(['name' => 'Developer']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$super_admin, $admin, $manager, $developer]);
        Permission::create(['name' => 'users.index'])->syncRoles([$super_admin, $admin, $manager]);
        Permission::create(['name' => 'users.show'])->syncRoles([$super_admin, $admin,$manager]);
        Permission::create(['name' => 'users.create'])->syncRoles($super_admin, $admin);
        //Permission::create(['name' => 'bussines.create'])->syncRoles($super_admin);
        Permission::create(['name' => 'users.store'])->syncRoles($super_admin, $admin);
        Permission::create(['name' => 'users.edit'])->syncRoles($super_admin, $admin);
        Permission::create(['name' => 'users.update'])->syncRoles($super_admin, $admin);
        Permission::create(['name' => 'users.destroy'])->syncRoles($super_admin, $admin);


    }
}
