<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredGames = Game::with('category')->where('featured', true)->where('is_active', true)->limit(3)->get();
        $categories = Category::withCount('games')->get();
        $popularGames = Game::with('category')->where('is_active', true)->orderByDesc('play_count')->limit(6)->get();

        return view('home', compact('featuredGames', 'categories', 'popularGames'));
    }
}
