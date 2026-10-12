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
            ['name' => 'Strategy', 'slug' => 'strategy', 'description' => 'Plan smarter, manage pressure, and win with timing.'],
            ['name' => 'Platformer', 'slug' => 'platformer', 'description' => 'Jump, dodge, collect, and keep moving forward.'],
        ];

        $createdCategories = [];
        foreach ($categories as $categoryData) {
            $category = Category::firstOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );

            $createdCategories[$categoryData['slug']] = $category->id;
        }

        $this->call(NewArcadeGamesSeeder::class);

        $games = [
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => '2048',
                'slug' => '2048',
                'description' => 'A classic number-merging puzzle with simple controls and endless replayability.',
                'instructions' => 'Use the arrow keys to slide tiles and match numbers to keep the board alive.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 4210,
                'image_url' => 'https://images.unsplash.com/photo-1553481187-be93c21490a9?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['action'],
                'name' => 'Snake',
                'slug' => 'snake',
                'description' => 'A timeless arcade challenge where you control a growing snake and stay out of the wall.',
                'instructions' => 'Use the keyboard arrows to guide the snake, eat the food, and keep the line alive.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 5360,
                'image_url' => 'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Tetris',
                'slug' => 'tetris',
                'description' => 'Stack shapes, clear lines, and survive the pace of the falling blocks.',
                'instructions' => 'Use your keyboard to rotate and move falling pieces into complete rows.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 3190,
                'image_url' => 'https://images.unsplash.com/photo-1605901309584-818e25960a8f?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['sports'],
                'name' => 'Pong',
                'slug' => 'pong',
                'description' => 'A legendary table-tennis classic where every rally is a test of timing and control.',
                'instructions' => 'Use the paddles to bounce the ball back and win the point before the opponent does.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 1880,
                'image_url' => 'https://images.unsplash.com/photo-1509198397868-475647b2a1e5?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['action'],
                'name' => 'Breakout',
                'slug' => 'breakout',
                'description' => 'Crack neon brick walls with tight paddle control and a fast bouncing ball.',
                'instructions' => 'Move the paddle with your keyboard and keep the ball alive until every brick is gone.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 2760,
                'image_url' => 'https://images.unsplash.com/photo-1493711662062-fa541adb3fc8?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['racing'],
                'name' => 'Neon Drift',
                'slug' => 'neon-drift',
                'description' => 'A slick racing challenge built around sharp turns, glowing tracks, and reaction speed.',
                'instructions' => 'Time each move, stay inside the lane, and chase a cleaner lap.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 2240,
                'image_url' => 'https://images.unsplash.com/photo-1511882150382-421056c89033?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Memory Match',
                'slug' => 'memory-match',
                'description' => 'Flip cards, remember patterns, and clear the board with as few guesses as possible.',
                'instructions' => 'Reveal two cards at a time and match every pair before your focus slips.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 1675,
                'image_url' => 'https://images.unsplash.com/photo-1611996575749-79a3a250f948?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['action'],
                'name' => 'Space Blaster',
                'slug' => 'space-blaster',
                'description' => 'Dodge incoming waves, fire back, and survive a glowing space arcade rush.',
                'instructions' => 'Move quickly, avoid enemy fire, and keep shooting for a bigger score.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 3910,
                'image_url' => 'https://images.unsplash.com/photo-1446776811953-b23d57bd21aa?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['sports'],
                'name' => 'Turbo Hoops',
                'slug' => 'turbo-hoops',
                'description' => 'A fast basketball shooting challenge where timing and streaks matter.',
                'instructions' => 'Line up each shot, release at the right moment, and build a hot streak.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 980,
                'image_url' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Word Sprint',
                'slug' => 'word-sprint',
                'description' => 'A quick vocabulary race where short words and fast decisions stack the score.',
                'instructions' => 'Find words quickly, avoid dead ends, and keep the timer under control.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 1210,
                'image_url' => 'https://images.unsplash.com/photo-1456513080510-7bf3a84b82f8?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['platformer'],
                'name' => 'Pixel Runner',
                'slug' => 'pixel-runner',
                'description' => 'A side-scrolling sprint through platforms, coins, and split-second jumps.',
                'instructions' => 'Jump over gaps, collect bonuses, and keep momentum through every stage.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 2860,
                'image_url' => 'https://images.unsplash.com/photo-1579373903781-fd5c0c30c4cd?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['strategy'],
                'name' => 'Tower Tactics',
                'slug' => 'tower-tactics',
                'description' => 'Place defenses, manage waves, and protect the core from a steady rush.',
                'instructions' => 'Choose tower positions carefully and upgrade before the next wave arrives.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 2035,
                'image_url' => 'https://images.unsplash.com/photo-1611996575749-79a3a250f948?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['action'],
                'name' => 'Asteroid Dash',
                'slug' => 'asteroid-dash',
                'description' => 'Pilot through asteroid lanes, dodge hazards, and collect glowing fuel cells.',
                'instructions' => 'Move with precision, avoid collisions, and keep your ship powered.',
                'featured' => true,
                'is_active' => true,
                'play_count' => 4485,
                'image_url' => 'https://images.unsplash.com/photo-1462331940025-496dfbfc7564?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['puzzle'],
                'name' => 'Minesweeper',
                'slug' => 'minesweeper',
                'description' => 'Use logic and careful guesses to clear hidden mines from the board.',
                'instructions' => 'Reveal squares, read the numbers, and flag dangerous spaces before clearing the field.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 1740,
                'image_url' => 'https://images.unsplash.com/photo-1616587226157-48e49175ee20?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['sports'],
                'name' => 'Penalty Rush',
                'slug' => 'penalty-rush',
                'description' => 'A fast penalty-kick challenge where aiming and timing decide every shot.',
                'instructions' => 'Pick your angle, time the kick, and beat the keeper with clean shots.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 1325,
                'image_url' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=85',
            ],
            [
                'category_id' => $createdCategories['racing'],
                'name' => 'Traffic Surge',
                'slug' => 'traffic-surge',
                'description' => 'Weave through traffic, collect boosts, and survive a neon highway run.',
                'instructions' => 'Change lanes quickly, avoid crashes, and use boosts when the road opens.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 2575,
                'image_url' => 'https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=1200&q=85',
            ],
        ];

        $createdGames = [];
        foreach ($games as $gameData) {
            $game = Game::updateOrCreate(
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
            ['game_slug' => 'breakout', 'user_id' => $user->id, 'score' => 3100],
            ['game_slug' => 'neon-drift', 'user_id' => $user->id, 'score' => 2250],
            ['game_slug' => 'memory-match', 'user_id' => $user->id, 'score' => 1720],
            ['game_slug' => 'space-blaster', 'user_id' => $user->id, 'score' => 4150],
            ['game_slug' => 'turbo-hoops', 'user_id' => $user->id, 'score' => 980],
            ['game_slug' => 'word-sprint', 'user_id' => $user->id, 'score' => 1550],
            ['game_slug' => 'pixel-runner', 'user_id' => $user->id, 'score' => 2860],
            ['game_slug' => 'tower-tactics', 'user_id' => $user->id, 'score' => 2035],
            ['game_slug' => 'asteroid-dash', 'user_id' => $user->id, 'score' => 4485],
            ['game_slug' => 'minesweeper', 'user_id' => $user->id, 'score' => 1740],
            ['game_slug' => 'penalty-rush', 'user_id' => $user->id, 'score' => 1325],
            ['game_slug' => 'traffic-surge', 'user_id' => $user->id, 'score' => 2575],
        ];

        foreach ($scores as $scoreData) {
            $user->scores()->firstOrCreate(
                ['game_id' => $createdGames[$scoreData['game_slug']]],
                ['score' => $scoreData['score']]
            );
        }
    }
}
