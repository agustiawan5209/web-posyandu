<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\PegawaiPosyandu;
use App\Models\RiwayatImunisasi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rand = rand(1, 2);
        $org = User::factory(30)
            ->afterCreating(function (User $user) {
                $role = Role::findByName('Orang Tua'); // Replace 'user' with your actual role name
                if ($role) {
                    $user->assignRole($role); // Assign 'user' role to the user
                }
            })
            ->has(OrangTua::factory()->has(Balita::factory()->has(RiwayatImunisasi::factory()->count(3)->state(function (array $attributes, Balita $balita) {
                return [
                    'balita_id' => $balita->id,

                    'data_imunisasi' => [
                        'nama_orang_tua' => $balita->nama_orang_tua,
                        'nama_anak' => $balita->nama,
                        'usia_anak' => $balita->hitung_usia,
                        'jenis_kelamin' => $balita->jenkel,
                        'berat_badan' => fake()->numberBetween(3, 10) . 'Kg',
                        'tinggi_badan' => fake()->numberBetween(30, 100) . 'Cm',
                        'lingkar_kepala' => fake()->numberBetween(20, 50) . 'Cm',
                        'kesehatan' => fake()->randomElement(['Baik', 'Buruk']),
                    ],
                ];
            }))->count($rand))->count(1))
            ->create();
        $org = User::factory(30)
            ->afterCreating(function (User $user) {
                $role = Role::findByName('Kader'); // Replace 'user' with your actual role name
                if ($role) {
                    $user->assignRole($role); // Assign 'user' role to the user
                }
                PegawaiPosyandu::create([
                    'jabatan' => 'Kader',
                    'user_id' => $user->id,
                    'nama' => $user->name,
                    'alamat' => fake()->address(),
                    'no_telpon' => fake()->phoneNumber(),
                ]);
            })
            ->create();
    }
}
