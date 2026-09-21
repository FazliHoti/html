<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::query()->orderByDesc('is_featured')->orderBy('sort_order')->latest()->paginate(12),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        $post = Post::create($request->validated() + [
            'published_at' => $request->boolean('is_published') ? now() : null,
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Story created.');
    }

    /**
     * Display the specified resource.
     */
    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated() + [
            'published_at' => $request->boolean('is_published') ? ($post->published_at ?? now()) : null,
        ]);

        return redirect()->route('admin.posts.edit', $post)->with('status', 'Story updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('status', 'Story deleted.');
    }
}
