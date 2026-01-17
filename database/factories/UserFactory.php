<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        // user dibuat antara 90 hari lalu
        $createdAt = $this->faker->dateTimeBetween('-90 days', '-3 days');

        // user update bisa setelah dibuat (bahkan hari ini)
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => $this->faker->boolean(80) ? $createdAt : null,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role' => 'user',
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
