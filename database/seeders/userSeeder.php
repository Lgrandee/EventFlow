<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'JohnDoe@test.com'],
            [
                'name' => 'John Doe',
                'role' => 'Organizator',
                'password' => bcrypt('password'),
            ]
        );
        User::updateOrCreate(
            ['email' => 'Admin@test.com'],
            [
                'name' => 'Admin',
                'role' => 'Admin',
                'password' => bcrypt('password'),
            ]
        );
         User::updateOrCreate(
            ['email' => 'Lisa@test.com'],
            [
                'name' => 'Lisa',
                'role' => 'user',
                'password' => bcrypt('password'),
            ]
        );
    }
}
