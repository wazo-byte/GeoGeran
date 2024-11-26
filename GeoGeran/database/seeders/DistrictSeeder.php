<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $district = [
            // Johor
            ['state_id' => 1, 'name' => 'Batu Pahat', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Johor Bahru', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Kluang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Kota Tinggi', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Mersing', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Muar', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Pontian', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Segamat', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Kulai', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 1, 'name' => 'Tangkak', 'created_at' => now(), 'updated_at' => now()],
            // Kedah
            ['state_id' => 2, 'name' => 'Kota Setar', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Kubang Pasu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Padang Terap', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Langkawi', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Kuala Muda', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Yan', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Sik', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Baling', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Kulim', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Bandar Baharu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Pendang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 2, 'name' => 'Pokok Sena', 'created_at' => now(), 'updated_at' => now()],
            // Kelantan
            ['state_id' => 3, 'name' => 'Bachok', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Kota Bharu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Machang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Pasir Mas', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Pasir Puteh', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Tanah Merah', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Tumpat', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Gua Musang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Kuala Krai', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 3, 'name' => 'Jeli', 'created_at' => now(), 'updated_at' => now()],
            // Melaka
            ['state_id' => 4, 'name' => 'Melaka Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 4, 'name' => 'Jasin', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 4, 'name' => 'Alor Gajah', 'created_at' => now(), 'updated_at' => now()],
            // Negeri Sembilan
            ['state_id' => 5, 'name' => 'Jelebu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Kuala Pilah', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Port Dickson', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Rembau', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Seremban', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Tampin', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 5, 'name' => 'Jempol', 'created_at' => now(), 'updated_at' => now()],
            // Pahang
            ['state_id' => 6, 'name' => 'Bentong', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Cameron Highlands', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Jerantut', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Kuantan', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Lipis', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Pekan', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Raub', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Temerloh', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Rompin', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Maran', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 6, 'name' => 'Bera', 'created_at' => now(), 'updated_at' => now()],
            // Penang
            ['state_id' => 7, 'name' => 'Seberang Perai Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 7, 'name' => 'Seberang Perai Utara', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 7, 'name' => 'Seberang Perai Selatan', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 7, 'name' => 'Timor Laut', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 7, 'name' => 'Barat Daya', 'created_at' => now(), 'updated_at' => now()],
            // Perak
            ['state_id' => 8, 'name' => 'Batang Padang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Manjung', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Kinta', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Kerian', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Kuala Kangsar', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Larut & Matang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Hilir Perak', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Hulu Perak', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Selama', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Perak Tengah', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Kampar', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Muallim', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 8, 'name' => 'Bagan Datuk', 'created_at' => now(), 'updated_at' => now()],
            // Perlis
            ['state_id' => 9, 'name' => 'Tiada Daerah', 'created_at' => now(), 'updated_at' => now()],
            // Selangor
            ['state_id' => 10, 'name' => 'Klang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Kuala Langat', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Kuala Selangor', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Sabak Bernam', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Ulu Langat', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Ulu Selangor', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Petaling', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Gombak', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 10, 'name' => 'Sepang', 'created_at' => now(), 'updated_at' => now()],
            // Terengganu
            ['state_id' => 11, 'name' => 'Besut', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Dungun', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Kemaman', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Kuala Terengganu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Hulu Terengganu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Marang', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Setiu', 'created_at' => now(), 'updated_at' => now()],
            ['state_id' => 11, 'name' => 'Kuala Nerus', 'created_at' => now(), 'updated_at' => now()],
            // Kuala Lumpur
            ['state_id' => 12, 'name' => 'Tiada Daerah', 'created_at' => now(), 'updated_at' => now()],
            // Labuan
            ['state_id' => 13, 'name' => 'Labuan', 'created_at' => now(), 'updated_at' => now()],
            // Putrajaya
            ['state_id' => 14, 'name' => 'Putrajaya', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insert the states into the states table
        DB::table('districts')->insert($district);
    }
}
