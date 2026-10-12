<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
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
        $response->assertSee('PlayForge');
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
        $this->assertDatabaseHas('games', ['name' => 'Asteroid Dash', 'slug' => 'asteroid-dash']);
        $this->assertDatabaseHas('categories', ['name' => 'Platformer', 'slug' => 'platformer']);
        $this->assertDatabaseMissing('games', ['name' => 'Space Dodge']);
    }

    public function test_new_games_appear_on_homepage_and_open_distinct_playable_pages(): void
    {
        $this->seed(DatabaseSeeder::class);

        $newGames = [
            'flappy-finch' => [
                'name' => 'Flappy Finch',
                'file' => 'flappy-finch.html',
                'category' => 'Platformer',
                'image' => 'https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=1200&q=82',
            ],
            'whack-a-mole' => [
                'name' => 'Whack-a-Mole',
                'file' => 'whack-a-mole.html',
                'category' => 'Action',
                'image' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=82',
            ],
            'simon-says' => [
                'name' => 'Simon Says',
                'file' => 'simon-says.html',
                'category' => 'Puzzle',
                'image' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1200&q=82',
            ],
        ];

        $homeResponse = $this->get(route('home'));
        $artworkUrls = [];

        foreach ($newGames as $slug => $details) {
            $game = Game::where('slug', $slug)->firstOrFail();

            $homeResponse->assertSee($details['name']);
            $this->assertDatabaseHas('games', [
                'slug' => $slug,
                'category_id' => Category::where('name', $details['category'])->value('id'),
                'image_url' => $details['image'],
            ]);
            $this->assertFileExists(public_path('games/'.$details['file']));
            $artworkUrls[] = $game->image_url;

            $this->get(route('games.show', $slug))
                ->assertSee('data-game-url="/games/'.$details['file'].'"', false);
        }

        $this->assertCount(3, array_unique($artworkUrls));
    }

    public function test_authenticated_player_can_save_a_score_for_a_new_game(): void
    {
        $game = Game::factory()->create(['slug' => 'flappy-finch', 'play_count' => 0]);
        $player = User::factory()->create();

        $response = $this->actingAs($player)
            ->post(route('games.score', 'flappy-finch'), ['score' => 7]);

        $response->assertRedirect();
        $this->assertDatabaseHas('scores', [
            'user_id' => $player->id,
            'game_id' => $game->id,
            'score' => 7,
        ]);
        $this->assertSame(1, $game->fresh()->play_count);
    }
}
