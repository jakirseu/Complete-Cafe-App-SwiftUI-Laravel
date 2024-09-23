<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder

{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(DefaultCategorySeeder::class);

        User::factory()
        ->count(2)
        ->state(new Sequence(
            [
                'name' =>  'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' =>  'User',
                'email' => 'user@mail.com',
                'password' => Hash::make('password'),
                'role' => 'user',
            ]
        ))
        ->create();

    }
}
