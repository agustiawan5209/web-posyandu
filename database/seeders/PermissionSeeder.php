<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Riwayat Permission
        Permission::create(['name' => 'add riwayat']);
        Permission::create(['name' => 'edit riwayat']);
        Permission::create(['name' => 'delete riwayat']);
        Permission::create(['name' => 'show riwayat']);

        // balita Permission
        Permission::create(['name' => 'add balita']);
        Permission::create(['name' => 'edit balita']);
        Permission::create(['name' => 'delete balita']);
        Permission::create(['name' => 'show balita']);

        // orangtua Permission
        Permission::create(['name' => 'add orangtua']);
        Permission::create(['name' => 'edit orangtua']);
        Permission::create(['name' => 'delete orangtua']);
        Permission::create(['name' => 'show orangtua']);
        // staff Permission
        Permission::create(['name' => 'add staff']);
        Permission::create(['name' => 'edit staff']);
        Permission::create(['name' => 'delete staff']);
        Permission::create(['name' => 'show staff']);
        // jadwal Permission
        Permission::create(['name' => 'add jadwal']);
        Permission::create(['name' => 'edit jadwal']);
        Permission::create(['name' => 'delete jadwal']);
        Permission::create(['name' => 'show jadwal']);
        // sertifikat Permission
        Permission::create(['name' => 'add sertifikat']);
        Permission::create(['name' => 'edit sertifikat']);
        Permission::create(['name' => 'delete sertifikat']);
        Permission::create(['name' => 'show sertifikat']);
        Permission::create(['name' => 'cetak sertifikat']);
    }
}
