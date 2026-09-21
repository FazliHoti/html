<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'category' => fake()->randomElement(['Places', 'Ideas', 'People']),
            'excerpt' => fake()->paragraph(),
            'body' => fake()->paragraphs(3, true),
            'author' => fake()->name(),
            'image_url' => 'https://images.unsplash.com/photo-1497250681960-ef046c08a56e?auto=format&fit=crop&w=900&q=85',
            'read_time' => fake()->numberBetween(3, 10),
            'is_featured' => false,
            'is_published' => true,
            'published_at' => now(),
            'sort_order' => fake()->numberBetween(0, 20),
        ];
    }
}
