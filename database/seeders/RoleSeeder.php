<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => 'Kepala']);
        $orangtua = Role::create(['name' => 'Orang Tua']);
        $staff = Role::create(['name' => 'Kader']);



        $user = User::factory()->create([
            'name' => 'kepala',
            'username' => 'kepala',
            'email' => 'kepala@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($role);
        $user->givePermissionTo([
            // 'add riwayat',
            // 'edit riwayat',
            // 'delete riwayat',
            'show riwayat',
            // Balita
            // 'add balita',
            // 'edit balita',
            // 'delete balita',
            'show balita',
            // orang tua
            // 'add orangtua',
            // 'edit orangtua',
            // 'delete orangtua',
            'show orangtua',
            // jadwal
            // 'add jadwal',
            // 'edit jadwal',
            // 'delete jadwal',
            'show jadwal',
            // staff
            'add staff',
            'edit staff',
            'delete staff',
            'show staff',
            // Sertifikat
            'add sertifikat',
            'edit sertifikat',
            'delete sertifikat',
            'show sertifikat',
        ]);

    }
}
