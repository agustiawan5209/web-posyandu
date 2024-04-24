<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JadwalImunisasi>
 */
class JadwalImunisasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'usia' => fake()->randomElement(['0 - 3 Bulan', '3 - 10 bulan', '11 - 12 bulan', '4 - 6 bulan', '3 bulan - 16 bulan']),
            'tanggal' => fake()->dateTimeBetween('-3 months', '3 months')->format('Y-m-d'),
            'jenis_imunisasi' => fake()->randomElement([
                'Vitamin A - 1',
                'Vitamin A - 2',
                'Oralit',
                'BH (NOL)',
                'BCG',
                'POLIO - 1',
                'POLIO - 2',
                'POLIO - 3',
                'DPT/HB - 1',
                'DPT/HB - 2',
                'DPT/HB - 3',
                'Campak',
            ]),
            'deskripsi' => fake()->text(20),
            'penanggung_jawab' => fake()->name(),
        ];
    }
}
