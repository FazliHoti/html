<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameHubTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_hub_homepage_displays_catalog(): void
    {
        $category = Category::factory()->create(['name' => 'Action']);
        Game::factory()->create([
            'name' => 'Space Dodge',
            'category_id' => $category->id,
            'slug' => 'space-dodge',
            'description' => 'A fast arcade survival game.',
            'featured' => true,
        ]);

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Game Hub');
        $response->assertSee('Space Dodge');
    }

    public function test_game_detail_page_has_a_mount_point_for_its_mini_game(): void
    {
        $category = Category::factory()->create(['name' => 'Action']);
        $game = Game::factory()->create([
            'name' => 'Space Dodge',
            'category_id' => $category->id,
            'slug' => 'space-dodge',
        ]);

        $response = $this->get(route('games.show', $game->slug));

        $response->assertOk();
        $response->assertSee('data-game-slug="space-dodge"', false);
        $response->assertSee('id="game-display"', false);
    }
}
