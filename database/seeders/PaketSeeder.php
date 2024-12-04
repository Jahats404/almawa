<?php

namespace Database\Seeders;

use App\Models\Paket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Paket::create([
            'id_paket' => '1',
            'nama_paket' => 'Umroh',
            'user_id' => 1,
            'harga' => 20000000,
        ]);
        Paket::create([
            'id_paket' => '2',
            'nama_paket' => 'Umroh Plus Wisata',
            'user_id' => 1,
            'harga' => 30000000,
        ]);
        Paket::create([
            'id_paket' => '3',
            'nama_paket' => 'Haji',
            'user_id' => 1,
            'harga' => 50000000,
        ]);
        Paket::create([
            'id_paket' => '4',
            'nama_paket' => 'Haji Furoda',
            'user_id' => 1,
            'harga' => 70000000,
        ]);
    }
}