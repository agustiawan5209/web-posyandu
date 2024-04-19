<?php

namespace Database\Seeders;

use App\Models\OrangTua;
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

        $org = User::factory(10)
        ->afterCreating(function (User $user){
            $role = Role::findByName('Orang Tua'); // Replace 'user' with your actual role name
            if ($role) {
                $user->assignRole($role); // Assign 'user' role to the user
            }
            OrangTua::create([
                'user_id'=>$user->id,
                'nama'=> $user->name,
                'alamat'=> fake()->address(),
                'no_telpon'=> fake()->phoneNumber(),
            ]);
        })
        ->create();

    }
}
