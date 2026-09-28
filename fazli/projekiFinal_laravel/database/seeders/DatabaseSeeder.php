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
                'name' => 'Space Dodge',
                'slug' => 'space-dodge',
                'description' => 'Dodge incoming laser beams and survive as long as you can.',
                'instructions' => 'Use the arrow keys or swipe to move and dodge danger.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Memory Match',
                'slug' => 'memory-match',
                'description' => 'Flip pairs and clear the board before the timer runs out.',
                'instructions' => 'Tap the cards to reveal and match identical symbols.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['racing'],
                'name' => 'Turbo Track',
                'slug' => 'turbo-track',
                'description' => 'Keep your car on track and push for a higher score.',
                'instructions' => 'Use left and right keys to dodge traffic and stay alive.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'category_id' => $createdCategories['sports'],
                'name' => 'Goal Rush',
                'slug' => 'goal-rush',
                'description' => 'Tap the target at the right moment and chase a perfect streak.',
                'instructions' => 'Click the moving target to build your combo and score.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1547347298-4074fc3086f0?auto=format&fit=crop&w=900&q=80',
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
            ['game_slug' => 'space-dodge', 'user_id' => $user->id, 'score' => 3400],
            ['game_slug' => 'memory-match', 'user_id' => $user->id, 'score' => 2600],
            ['game_slug' => 'turbo-track', 'user_id' => $user->id, 'score' => 1900],
        ];

        foreach ($scores as $scoreData) {
            $user->scores()->firstOrCreate(
                ['game_id' => $createdGames[$scoreData['game_slug']]],
                ['score' => $scoreData['score']]
            );
        }
    }
}
