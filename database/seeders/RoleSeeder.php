<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create roles if they don't exist
        $roleAdmin = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Admin']);
        $roleManager = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Manager']);
        $roleStaff = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'Staff']);
        $roleUser = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'User']);

        // Run PermissionSeeder
        $this->call(PermissionSeeder::class);

        // Create/Update Admin User
        $user = \App\Models\User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => \Illuminate\Support\Facades\Hash::make('password')]
        );
        $user->update(['role' => 'Admin']); // Force update role column
        $user->assignRole($roleAdmin);

        // Create/Update Staff User
        $staffUser = \App\Models\User::firstOrCreate(
            ['email' => 'staff@gmail.com'],
            ['name' => 'Staff User', 'password' => \Illuminate\Support\Facades\Hash::make('password')]
        );
        $staffUser->update(['role' => 'Staff']); // Force update role column
        $staffUser->assignRole($roleStaff);
    }
}
