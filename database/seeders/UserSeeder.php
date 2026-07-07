<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin account
        User::create([
            'name' => 'Admin User',
            'username' => 'ronaldo',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('panuelos'), // Securely hashes the password
            'status' => 'active',
            'branch_id' => 1
        ]);

        // Create a Standard/Clerk account
        User::create([
            'name' => 'I am the clerk',
            'username' => 'clerk',
            'email' => 'clerk@example.com',
            'role' => 'clerk',
            'password' => Hash::make('iamtheclerk'),
            'status' => 'active',
            'branch_id' => 2
        ]);
    }
}
