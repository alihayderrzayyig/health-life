<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRole = Role::create(['name' => 'user']);
        $adminRole = Role::create(['name' => 'admin']);
        $writerRole = Role::create(['name' => 'writer']);


        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'write']);
        Permission::create(['name' => 'update']);
        Permission::create(['name' => 'delete']);

        User::create([
            'name'=> 'User',
            'email'=> 'user@gmail.com',
            'password' => Hash::make('00000000'),
            'email_verified_at' => now(),
            'role_id' => $userRole->id,
        ]);
        User::create([
            'name'=> 'Admin',
            'email'=> 'admin@gmail.com',
            'password' => Hash::make('00000000'),
            'email_verified_at' => now(),
            'role_id' => $adminRole->id,
        ]);
        User::create([
            'name'=> 'Writer',
            'email'=> 'writer@gmail.com',
            'password' => Hash::make('00000000'),
            'email_verified_at' => now(),
            'role_id' => $writerRole->id,
        ]);
    }
}
