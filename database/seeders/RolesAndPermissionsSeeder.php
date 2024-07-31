<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
      
        // Create permissions
      //  Permission::create(['name' => 'send otp']);
      //  Permission::create(['name' => 'verify otp']);
      //  Permission::create(['name' => 'register user']);

        // Create roles and assign existing permissions
        $role = Role::updateOrCreate(['name' => 'customer']);
        $role = Role::updateOrCreate(['name' => 'driver']);
        // $role->givePermissionTo(['send otp', 'verify otp', 'register user']);
    }
}
