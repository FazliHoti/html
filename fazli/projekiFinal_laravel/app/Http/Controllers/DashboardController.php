<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Game;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        $favoriteGames = Game::whereHas('favorites', fn ($query) => $query->where('user_id', $user->id))->get();
        $recentScores = Score::with('game')->where('user_id', $user->id)->orderByDesc('created_at')->limit(5)->get();
        $topScore = Score::where('user_id', $user->id)->max('score');
        $favoriteCount = Favorite::where('user_id', $user->id)->count();

        return view('dashboard', compact('user', 'favoriteGames', 'recentScores', 'topScore', 'favoriteCount'));
    }
}
