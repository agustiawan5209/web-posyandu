<?php

namespace Database\Factories;

use App\Models\Balita;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RiwayatImunisasi>
 */
class RiwayatImunisasiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $balita = Balita::factory();
        return [
            'balita_id'=> Balita::factory(),
            'data_imunisasi'=> [
                'nama_orang_tua'=> function(array $attribute){
                    return Balita::find($attribute['balita_id'])->orangTua->nama;
                },
                'nama_anak'=> function(array $attribute){
                    return $attribute['nama_anak'];
                },
                'usia_anak'=> function(array $attribute){
                    return Balita::find($attribute['balita_id'])->hitung_usia;
                },
                'jenis_kelamin'=> function(array $attribute){
                    return Balita::find($attribute['balita_id'])->jenkel;
                },
                'berat_badan'=> fake()->numberBetween(3, 10) . 'Kg',
                'tinggi_badan'=> fake()->numberBetween(30, 100) . 'Cm',
                'lingkar_kepala'=> fake()->numberBetween(20, 50) . 'Cm',
                'kesehatan'=> fake()->randomElement(['Baik','Buruk']),

            ],
            'jenis_imunisasi'=> fake()->randomElement(['campak', 'Vitamin A', 'Oralit', 'BH (NOL)', 'BCG', 'POLIO', 'DPT/HB']),
            'tanggal'=> fake()->dateTimeBetween('-3 months', '0 months')->format('Y-m-d'),
            'catatan'=> fake()->realText(200),
            'created_at'=> fake()->dateTimeBetween('-3 years','1 months')->format('Y-m-d'),
        ];
    }
}
