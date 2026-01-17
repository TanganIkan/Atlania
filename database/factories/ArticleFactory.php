<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-60 days', '-1 days');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');

        $title = $this->faker->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'content' => $this->faker->paragraphs(4, true),
            'image' => null, // aman dengan accessor kamu
            'user_id' => User::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),
            'likes_count' => $this->faker->numberBetween(0, 200),
            'comments_count' => $this->faker->numberBetween(0, 50),
            'save_count' => $this->faker->numberBetween(0, 100),
            'is_featured' => $this->faker->boolean(20),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
