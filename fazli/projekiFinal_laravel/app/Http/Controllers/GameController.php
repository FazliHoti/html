<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Game;
use App\Models\Review;
use App\Models\Score;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(Request $request): View
    {
        $query = Game::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($categoryQuery) => $categoryQuery->where('slug', $request->category));
        }

        if ($request->filled('search')) {
            $query->where(function ($searchQuery) use ($request) {
                $searchQuery->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('description', 'like', '%'.$request->search.'%');
            });
        }

        $games = $query->orderByDesc('featured')->orderBy('name')->paginate(9);
        $categories = Category::all();

        return view('games.index', compact('games', 'categories'));
    }

    public function show(string $slug): View
    {
        $game = Game::with(['category', 'reviews.user', 'scores.user'])->where('slug', $slug)->firstOrFail();
        $relatedGames = Game::where('category_id', $game->category_id)->where('id', '!=', $game->id)->limit(3)->get();
        $averageRating = round($game->reviews()->avg('rating') ?? 0, 1);
        $favoriteCount = $game->favorites()->count();
        $leaderboard = $game->scores()->with('user')->orderByDesc('score')->limit(5)->get();

        return view('games.show', compact('game', 'relatedGames', 'averageRating', 'favoriteCount', 'leaderboard'));
    }

    public function toggleFavorite(Game $game): RedirectResponse
    {
        if (! Auth::check()) {
            return back()->with('error', 'Please log in to save favorites.');
        }

        $favorite = Favorite::where('user_id', Auth::id())->where('game_id', $game->id)->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Removed from favorites.');
        }

        Favorite::create([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
        ]);

        return back()->with('success', 'Added to favorites.');
    }

    public function storeScore(Request $request, string $slug): RedirectResponse
    {
        $validated = $request->validate([
            'score' => ['required', 'integer', 'min:0'],
        ]);

        $game = Game::where('slug', $slug)->firstOrFail();

        $game->increment('play_count');

        Score::create([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
            'score' => $validated['score'],
        ]);

        return back()->with('success', 'Your score has been saved.');
    }

    public function storeReview(Request $request, Game $game): RedirectResponse
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'game_id' => $game->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return back()->with('success', 'Thanks for your review.');
    }

    public function leaderboard(): View
    {
        $players = Score::with('user', 'game')
            ->selectRaw('user_id, game_id, MAX(score) as best_score')
            ->groupBy('user_id', 'game_id')
            ->orderByDesc('best_score')
            ->paginate(10);

        return view('leaderboard', compact('players'));
    }
}
