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
            'name' => 'I am the admin',
            'username' => 'ronaldo',
            'email' => 'admin@thispawnshop.com',
            'role' => 'admin',
            'password' => Hash::make('panuelos'), // Securely hashes the password
            'status' => 'active',
            'branch_id' => 1,
            // Default testing contact details
            'phone_number'        => '+639171234567',
            'chat_id_telegram'    => '123456789',
            'chat_id_viber'       => 'vbr-admin-xyz',

            // Pre-enable a couple of channels for testing the verification logic
            'two_factor_gmail'    => true,
            'two_factor_yahoo'    => true,
            'two_factor_sms'      => true,
            'two_factor_telegram' => false,
            'two_factor_viber'    => false
        ]);

        // Create a Standard/Clerk account
        User::create([
            'name' => 'I am the clerk',
            'username' => 'clerk',
            'email' => 'clerk@thispawnshop.com',
            'role' => 'clerk',
            'password' => Hash::make('iamtheclerk'),
            'status' => 'active',
            'branch_id' => 1,
            // Default testing contact details
            'phone_number'        => '+639171234567',
            'chat_id_telegram'    => '123456789',
            'chat_id_viber'       => 'vbr-admin-xyz',

            // Pre-enable a couple of channels for testing the verification logic
            'two_factor_gmail'    => true,
            'two_factor_yahoo'    => false,
            'two_factor_sms'      => true,
            'two_factor_telegram' => false,
            'two_factor_viber'    => false
        ]);

         // Create a Standard/Clerk account
        User::create([
            'name' => 'I am the admin',
            'username' => 'admin',
            'email' => 'admin@thispawnshop.com',
            'role' => 'admin',
            'password' => Hash::make('iamtheadmin'),
            'status' => 'active',
            'branch_id' => 1,
            // Default testing contact details
            'phone_number'        => '+639171234567',
            'chat_id_telegram'    => '123456789',
            'chat_id_viber'       => 'vbr-admin-xyz',

            // Pre-enable a couple of channels for testing the verification logic
            'two_factor_gmail'    => true,
            'two_factor_yahoo'    => false,
            'two_factor_sms'      => true,
            'two_factor_telegram' => false,
            'two_factor_viber'    => false
        ]);
    }
}
