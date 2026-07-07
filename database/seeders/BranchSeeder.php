<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample branches for your pawnshop application
        $branches = [
            [
                'name' => 'Main Headquarters',
                'location' => 'Downtown Metro',
                'status' => 'active',
                'code' => 'HQ-01',
            ],
            [
                'name' => 'Northside Branch',
                'location' => 'Uptown District',
                'status' => 'active',
                'code' => 'BR-02',
            ],
            [
                'name' => 'Eastside Branch',
                'location' => 'Suburban Square',
                'status' => 'active',
                'code' => 'BR-03',
            ],
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
