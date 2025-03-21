<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Dupont',
            'last_name' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Durand',
            'last_name' => 'Marie',
            'email' => 'marie.durand@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Lemoine',
            'last_name' => 'Pierre',
            'email' => 'pierre.lemoine@example.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);
    }
}
