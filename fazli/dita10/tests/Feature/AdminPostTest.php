<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_users_cannot_access_story_management(): void
    {
        $response = $this->actingAs(User::factory()->create())->get(route('admin.posts.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_create_update_and_delete_a_story(): void
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $attributes = Post::factory()->make()->toArray();

        $response = $this->actingAs($admin)->post(route('admin.posts.store'), $attributes);
        $post = Post::query()->firstOrFail();

        $response->assertRedirect(route('admin.posts.edit', $post));
        $this->assertDatabaseHas('posts', ['title' => $attributes['title']]);

        $response = $this->actingAs($admin)->put(route('admin.posts.update', $post), $attributes + ['title' => 'Updated title']);
        $response->assertRedirect(route('admin.posts.edit', $post));
        $this->assertDatabaseHas('posts', ['title' => 'Updated title']);

        $response = $this->actingAs($admin)->delete(route('admin.posts.destroy', $post));

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}
