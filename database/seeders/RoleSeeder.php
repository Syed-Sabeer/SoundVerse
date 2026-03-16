<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Define all roles
        $roles = ['admin', 'individual', 'company'];

        foreach ($roles as $roleName) {
            Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);
        }

        // Optionally create sample users and assign roles

        // Admin user
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'username' => 'admin',
                'password' => Hash::make('admin@gmail.com'),
            ]
        );
        $adminUser->assignRole('admin');

        // Individual user
        $individualUser = User::firstOrCreate(
            ['email' => 'individual@example.com'],
            [
                'name' => 'John Doe',
                'username' => 'john_individual',
                'password' => Hash::make('password'),
            ]
        );
        $individualUser->assignRole('individual');

        // Company user
        $companyUser = User::firstOrCreate(
            ['email' => 'company@example.com'],
            [
                'name' => 'ACME Corp',
                'username' => 'acme_company',
                'password' => Hash::make('password'),
            ]
        );
        $companyUser->assignRole('company');
    }
}
