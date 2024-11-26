<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['id' => 1, 'name' => 'Johor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Kedah', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'Kelantan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'Melaka', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 5, 'name' => 'Negeri Sembilan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 6, 'name' => 'Pahang', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 7, 'name' => 'Penang', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 8, 'name' => 'Perak', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 9, 'name' => 'Perlis', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 10, 'name' => 'Selangor', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 11, 'name' => 'Terengganu', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 12, 'name' => 'Kuala Lumpur', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 13, 'name' => 'Labuan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 14, 'name' => 'Putrajaya', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the states into the states table
        DB::table('states')->insert($states);
    }
}
