<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Game>
 */
class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->sentence(),
            'instructions' => fake()->sentence(),
            'featured' => false,
            'is_active' => true,
            'play_count' => fake()->numberBetween(0, 5000),
            'image_url' => fake()->imageUrl(800, 600, 'games', true),
        ];
    }
}
