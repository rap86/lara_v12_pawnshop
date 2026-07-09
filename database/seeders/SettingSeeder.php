<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name'    => 'sms',
            'status'  => 'inactive',
            'details' => 'This is where you can get your 2fa code for login validation code.',
        ]);

        Setting::create([
            'name'    => 'email',
            'status'  => 'inactive',
            'details' => 'This is where you can get your 2fa code for login validation code.',
        ]);

        Setting::create([
            'name'    => 'telegram',
            'status'  => 'inactive',
            'details' => 'This is where you can get your 2fa code for login validation code.',
        ]);

        Setting::create([
            'name'    => 'viber',
            'status'  => 'inactive',
            'details' => 'This is where you can get your 2fa code for login validation code.',
        ]);

        Setting::create([
            'name'    => '2fa',
            'status'  => 'inactive',
            'details' => 'If active once you login if will redirect you to the page where you need to input yung authentication code, if not you will redirect to configured landing page.',
        ]);
    }
}
