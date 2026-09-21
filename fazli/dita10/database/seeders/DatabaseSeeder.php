<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        Post::factory()->create([
            'title' => 'The art of growing a life, one small ritual at a time',
            'category' => 'The slow life',
            'excerpt' => 'What happens when we stop treating our days as something to get through, and start noticing what they are made of?',
            'author' => 'Maya Ellis',
            'read_time' => 6,
            'image_url' => 'https://images.unsplash.com/photo-1497250681960-ef046c08a56e?auto=format&fit=crop&w=1400&q=85',
            'is_featured' => true,
            'sort_order' => 0,
        ]);

        Post::factory()->createMany([
            [
                'category' => 'Places',
                'title' => 'In praise of taking the long way home',
                'excerpt' => 'A dispatch from the roads that give us a little more than directions.',
                'author' => 'June Park',
                'read_time' => 4,
                'image_url' => 'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429?auto=format&fit=crop&w=900&q=85',
                'sort_order' => 1,
            ],
            [
                'category' => 'Ideas',
                'title' => 'Keep a notebook, change your mind',
                'excerpt' => 'The simple, enduring practice of leaving room for new thoughts.',
                'author' => 'Theo Wright',
                'read_time' => 7,
                'image_url' => 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=900&q=85',
                'sort_order' => 2,
            ],
            [
                'category' => 'People',
                'title' => 'How small teams make meaningful work',
                'excerpt' => 'Three creative duos on trust, taste, and knowing when to stop.',
                'author' => 'Nora Bell',
                'read_time' => 5,
                'image_url' => 'https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=900&q=85',
                'sort_order' => 3,
            ],
        ]);
    }
}
