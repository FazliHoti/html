<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Database\Seeder;

class NewArcadeGamesSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'action' => Category::firstOrCreate(
                ['slug' => 'action'],
                ['name' => 'Action', 'description' => 'Fast paced arcade challenges.'],
            ),
            'platformer' => Category::firstOrCreate(
                ['slug' => 'platformer'],
                ['name' => 'Platformer', 'description' => 'Jump, dodge, collect, and keep moving forward.'],
            ),
            'puzzle' => Category::firstOrCreate(
                ['slug' => 'puzzle'],
                ['name' => 'Puzzle', 'description' => 'Think quickly and plan ahead.'],
            ),
        ];

        $games = [
            [
                'category_id' => $categories['platformer']->id,
                'name' => 'Flappy Finch',
                'slug' => 'flappy-finch',
                'description' => 'Guide a little finch through a row of garden gates. One tap keeps it aloft; one mistimed dip ends the flight.',
                'instructions' => 'Tap, click, or press Space to flap. Slip through the gaps and see how far you can fly.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1444464666168-49d633b86797?auto=format&fit=crop&w=1200&q=82',
            ],
            [
                'category_id' => $categories['action']->id,
                'name' => 'Whack-a-Mole',
                'slug' => 'whack-a-mole',
                'description' => 'A lively garden patch, a few cheeky moles, and thirty seconds to catch as many as you can.',
                'instructions' => 'Tap or click a mole when it pops up. You have 30 seconds to make your mark.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?auto=format&fit=crop&w=1200&q=82',
            ],
            [
                'category_id' => $categories['puzzle']->id,
                'name' => 'Simon Says',
                'slug' => 'simon-says',
                'description' => 'A small test of memory: watch the colors light up, then play the pattern back without missing a beat.',
                'instructions' => 'Watch the color sequence, then repeat it with the four pads or keys 1–4.',
                'featured' => false,
                'is_active' => true,
                'play_count' => 0,
                'image_url' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=1200&q=82',
            ],
        ];

        foreach ($games as $game) {
            Game::firstOrCreate(['slug' => $game['slug']], $game);
        }
    }
}
