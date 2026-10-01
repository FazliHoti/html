<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Game;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameHubTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_hub_homepage_displays_catalog(): void
    {
        $category = Category::factory()->create(['name' => 'Action']);
        Game::factory()->create([
            'name' => 'Tetris',
            'category_id' => $category->id,
            'slug' => 'tetris',
            'description' => 'A classic falling-block puzzle game.',
            'featured' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Game Hub');
        $response->assertSee('Tetris');
    }

    public function test_game_detail_page_has_a_mount_point_for_its_mini_game(): void
    {
        $category = Category::factory()->create(['name' => 'Action']);
        $game = Game::factory()->create([
            'name' => 'Tetris',
            'category_id' => $category->id,
            'slug' => 'tetris',
        ]);

        $response = $this->get(route('games.show', $game->slug));

        $response->assertOk();
        $response->assertSee('data-game-slug="tetris"', false);
        $response->assertSee('id="game-display"', false);
    }

    public function test_database_seed_populates_open_source_games(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertDatabaseHas('games', ['name' => 'Tetris', 'slug' => 'tetris']);
        $this->assertDatabaseHas('games', ['name' => 'Snake', 'slug' => 'snake']);
        $this->assertDatabaseHas('games', ['name' => 'Pong', 'slug' => 'pong']);
        $this->assertDatabaseMissing('games', ['name' => 'Space Dodge']);
    }
}
