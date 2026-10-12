<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredGames = Game::with('category')->where('featured', true)->where('is_active', true)->limit(6)->get();
        $categories = Category::withCount('games')->get();
        $newGameSlugs = ['flappy-finch', 'whack-a-mole', 'simon-says'];
        $popularGames = Game::with('category')
            ->where('is_active', true)
            ->whereNotIn('slug', $newGameSlugs)
            ->orderByDesc('play_count')
            ->limit(5)
            ->get()
            ->concat(Game::with('category')->where('is_active', true)->whereIn('slug', $newGameSlugs)->orderBy('name')->get());
        $totalGames = Game::where('is_active', true)->count();

        return view('home', compact('featuredGames', 'categories', 'popularGames', 'totalGames'));
    }
}
