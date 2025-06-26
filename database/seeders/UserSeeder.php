<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name'     => $faker->name(),
                'email'    => $faker->unique()->safeEmail(),
                'role'     => $faker->randomElement(['admin', 'user']),
                'active'   => $faker->boolean(),
                'password' => Hash::make('password123'), // Password requirement: min 6 chars
                'active'   => true, // Default to active
                'created_at' => now(),
                'updated_at' => now(),

            ]);
        }
    }
}
