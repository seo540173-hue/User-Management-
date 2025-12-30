<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Standard Permissions
        $permissions = [
            // User Management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            
            // Role Management
            'view-roles',
            'create-roles',
            'edit-roles',
            'delete-roles',
            
            // Product Management
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
            
            // Customer Management
            'view-customers',
            'create-customers',
            'edit-customers',
            'delete-customers',
            
            // Sales Management
            'view-sales',
            'create-sales',
            'edit-sales',
            'delete-sales',
            'view-invoices',
            
            // Dashboard & Reports
            'view-dashboard',
            'view-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to Admin role
        $adminRole = Role::where('name', 'Admin')->first();
        if ($adminRole) {
            $adminRole->syncPermissions(Permission::all());
        }

        // Assign permissions to Manager role
        $managerRole = Role::where('name', 'Manager')->first();
        if ($managerRole) {
            $managerRole->syncPermissions([
                'view-dashboard',
                'view-reports',
                'view-products', 'create-products', 'edit-products',
                'view-customers', 'create-customers', 'edit-customers',
                'view-sales', 'create-sales', 'edit-sales', 'view-invoices',
                'view-users', // Managers can view but not delete
            ]);
        }

        // Assign permissions to Staff role
        $staffRole = Role::where('name', 'Staff')->first();
        if ($staffRole) {
            $staffRole->syncPermissions([
                'view-dashboard',
                'view-products',
                'view-customers', 'create-customers',
                'view-sales', 'create-sales', 'view-invoices',
            ]);
        }
    }
}
