<?php

namespace Database\Factories;

use App\Models\OrangTua;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Balita>
 */
class BalitaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->nik(),
            'nama' => fake()->firstName(),
            'tempat_lahir' => fake()->city(),
            'tgl_lahir' => fake()->dateTimeBetween('-3 years', '0 years')->format('Y-m-d'),
            'jenkel' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'org_tua_id' => OrangTua::factory(),
            'nama_orang_tua'=> OrangTua::factory(),
        ];
    }
}
