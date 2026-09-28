<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Str;

class AdminGameController extends Controller
{
    public function index(): View
    {
        abort_unless(Auth::check() && Auth::user()->email === 'admin@example.com', 403);

        $games = Game::with('category')->orderBy('name')->get();
        $categories = Category::all();

        return view('admin.games', compact('games', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        abort_unless(Auth::check() && Auth::user()->email === 'admin@example.com', 403);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'instructions' => ['nullable', 'string'],
            'image_url' => ['nullable', 'url'],
            'featured' => ['boolean'],
        ]);

        Game::create([
            'category_id' => $validated['category_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'description' => $validated['description'],
            'instructions' => $validated['instructions'] ?? null,
            'image_url' => $validated['image_url'] ?? null,
            'featured' => $validated['featured'] ?? false,
            'is_active' => true,
        ]);

        return back()->with('success', 'Game added successfully.');
    }

    public function destroy(Game $game): RedirectResponse
    {
        abort_unless(Auth::check() && Auth::user()->email === 'admin@example.com', 403);

        $game->delete();

        return back()->with('success', 'Game removed successfully.');
    }
}
