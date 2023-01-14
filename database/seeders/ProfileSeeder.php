<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->profile()->create(
                [
                    'bio' => fake()->url(),
                    'facebook_link' => fake()->url(),
                    'phone_num1' => fake()->phoneNumber(),
                    'phone_num2' => fake()->phoneNumber(),
                ]
            );
        }
    }
}
