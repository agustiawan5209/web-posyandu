<?php

namespace Database\Seeders;

use App\Models\Balita;
use App\Models\OrangTua;
use App\Models\PegawaiPosyandu;
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
        $rand = rand(1,2);
        $org = User::factory(30)
        ->afterCreating(function (User $user){
            $role = Role::findByName('Orang Tua'); // Replace 'user' with your actual role name
            if ($role) {
                $user->assignRole($role); // Assign 'user' role to the user
            }
        })
        ->has(OrangTua::factory()->has(Balita::factory()->count($rand))->count(1))
        ->create();
        $org = User::factory(30)
        ->afterCreating(function (User $user){
            $role = Role::findByName('Kader'); // Replace 'user' with your actual role name
            if ($role) {
                $user->assignRole($role); // Assign 'user' role to the user
            }
            PegawaiPosyandu::create([
                'jabatan'=> 'Kader',
                'user_id'=>$user->id,
                'nama'=> $user->name,
                'alamat'=> fake()->address(),
                'no_telpon'=> fake()->phoneNumber(),
            ]);
        })
        ->create();

    }
}
