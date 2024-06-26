<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\PegawaiPosyandu;
use App\Models\Posyandu;
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
        $org = User::factory(30)
            ->afterCreating(function (User $user) {
                $role = Role::findByName('Orang Tua'); // Replace 'user' with your actual role name
                if ($role) {
                    $user->assignRole($role); // Assign 'user' role to the user
                }
                $user->givePermissionTo([
                    'show riwayat',
                    'add balita',
                    'edit balita',
                    'delete balita',
                    'show balita',
                    'show jadwal',
                    'show sertifikat',
                    'cetak sertifikat',

                ]);
            })
            ->has(OrangTua::factory()
                ->has(Balita::factory()
                    ->has(RiwayatImunisasi::factory()
                        ->count(2)
                        ->state(function (array $attributes, Balita $balita) {
                            return [
                                'balita_id' => $balita->id,
                                'data_imunisasi' => [
                                    'nama_orang_tua' => $balita->nama_orang_tua,
                                    'nama_anak' => $balita->nama,
                                    'usia_anak' => $balita->hitung_usia,
                                    'jenis_kelamin' => $balita->jenkel,
                                    'berat_badan' => fake()->numberBetween(3, 10),
                                    'tinggi_badan' => fake()->numberBetween(30, 100),
                                    'lingkar_kepala' => fake()->numberBetween(20, 50),
                                    'kesehatan' => fake()->randomElement(['Baik', 'Buruk']),
                                ],
                            ];
                        }))
                    ->count(3))
                ->count(1))
            ->create();

        $posyandu = Posyandu::factory(3)->create();
        $org = User::factory(10)
            ->afterCreating(function (User $user) {
                $role = Role::findByName('Kader'); // Replace 'user' with your actual role name
                if ($role) {
                    $user->assignRole($role); // Assign 'user' role to the user
                    $user->givePermissionTo([
                        'add riwayat',
                        'edit riwayat',
                        'delete riwayat',
                        'show riwayat',
                        // Balita
                        'add balita',
                        'edit balita',
                        'delete balita',
                        'show balita',
                        // orang tua
                        'add orangtua',
                        'edit orangtua',
                        'delete orangtua',
                        'show orangtua',
                        // jadwal
                        'add jadwal',
                        'edit jadwal',
                        'delete jadwal',
                        'show jadwal',
                        // Sertifikat
                        'show sertifikat',

                        'show staff',
                        'reset orangtua'
                    ]);
                }

                PegawaiPosyandu::create([
                    'jabatan' => 'Kader',
                    'user_id' => $user->id,
                    'posyandus_id' => fake()->randomElement(['1','2','3']),
                    'nama' => $user->name,
                    'alamat' => fake()->address(),
                    'no_telpon' => fake()->phoneNumber(),
                ]);
            })
            ->create();
    }
}
