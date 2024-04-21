<?php

namespace Database\Seeders;

use App\Models\JadwalImunisasi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JadwalImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JadwalImunisasi::factory(10)->create();
    }
}
