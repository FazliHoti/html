<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('admin123'),
            ]
        );

        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
            ]
        );

        $categories = [
            ['name' => 'Action', 'slug' => 'action', 'description' => 'Fast paced arcade challenges.'],
            ['name' => 'Puzzle', 'slug' => 'puzzle', 'description' => 'Think quickly and plan ahead.'],
            ['name' => 'Racing', 'slug' => 'racing', 'description' => 'Speed, drift, and precision.'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Competitive and reaction based fun.'],
        ];

        $createdCategories = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            $createdCategories[$categoryData['slug']] = $category->id;
        }

        $games = [
            [
                'category_id' => $createdCategories['action'],
                'name' => '2048',
                'slug' => '2048',
                'description' => 'A classic number-merging puzzle with simple controls and endless replayability.',
                'instructions' => 'Use the arrow keys to slide tiles and match numbers to keep the board alive.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Snake',
                'slug' => 'snake',
                'description' => 'A timeless arcade challenge where you control a growing snake and stay out of the wall.',
                'instructions' => 'Use the keyboard arrows to guide the snake, eat the food, and keep the line alive.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['racing'],
                'name' => 'Tetris',
                'slug' => 'tetris',
                'description' => 'Stack shapes, clear lines, and survive the pace of the falling blocks.',
                'instructions' => 'Use your keyboard to rotate and move falling pieces into complete rows.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['sports'],
                'name' => 'Pong',
                'slug' => 'pong',
                'description' => 'A legendary table-tennis classic where every rally is a test of timing and control.',
                'instructions' => 'Use the paddles to bounce the ball back and win the point before the opponent does.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        $createdGames = [];
        foreach ($games as $gameData) {
            $game = Game::firstOrCreate(
                ['slug' => $gameData['slug']],
                $gameData
            );

            $createdGames[$gameData['slug']] = $game->id;
        }

        $scores = [
            ['game_slug' => '2048', 'user_id' => $user->id, 'score' => 3400],
            ['game_slug' => 'snake', 'user_id' => $user->id, 'score' => 2600],
            ['game_slug' => 'tetris', 'user_id' => $user->id, 'score' => 1900],
            ['game_slug' => 'pong', 'user_id' => $user->id, 'score' => 1400],
        ];

        foreach ($scores as $scoreData) {
            $user->scores()->firstOrCreate(
                ['game_id' => $createdGames[$scoreData['game_slug']]],
                ['score' => $scoreData['score']]
            );
        }
    }
}
