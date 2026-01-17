<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use function Symfony\Component\String\b;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'tuadi@gmail.com',
            'password' => bcrypt('tuadi123'),
            'role' => 'user',
        ]);
        // 🔥 User random dari factory
        User::factory()->count(15)->create();
    }
}
