<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role; // Import the Role model
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RolesAndAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRoleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userRoleId = DB::table('roles')->insertGetId([
            'name' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@localhost.com',
            'password' => Hash::make('123456'),
        ]);

        // Assign admin role to the admin user
        $admin->roles()->attach($adminRoleId);
    }
}
