<?php

namespace Database\Seeders;

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
        $role = Role::create(['name' => 'Kepala']);
        $orangtua = Role::create(['name' => 'Orang Tua']);
        $staff = Role::create(['name' => 'Staff']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $user->assignRole($role);

        $org = User::factory(10)
        ->afterCreating(function (User $user){
            $role = Role::findByName('Orang Tua'); // Replace 'user' with your actual role name
            if ($role) {
                $user->assignRole($role); // Assign 'user' role to the user
            }
        })
        ->create();

    }
}
