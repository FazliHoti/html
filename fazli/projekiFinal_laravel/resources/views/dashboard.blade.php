<x-app-layout>
    @php($title = 'Dashboard | Game Hub')

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="mb-8">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">Player dashboard</p>
            <h1 class="mt-3 text-4xl font-black text-white">Welcome, {{ Auth::user()->name }}</h1>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-sm text-slate-400">Top score</p>
                <p class="mt-3 text-3xl font-black text-white">{{ $topScore ?? 0 }}</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-sm text-slate-400">Favorites</p>
                <p class="mt-3 text-3xl font-black text-white">{{ $favoriteCount }}</p>
            </div>
            <div class="rounded-2xl border border-slate-800 bg-slate-900 p-6">
                <p class="text-sm text-slate-400">Recent score</p>
                <p class="mt-3 text-3xl font-black text-white">{{ $recentScores->first()->score ?? 0 }}</p>
            </div>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-2">
            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-2xl font-bold text-white">Favorite games</h2>
                <div class="mt-5 space-y-3">
                    @forelse($favoriteGames as $game)
                        <a href="{{ route('games.show', $game->slug) }}" class="flex items-center justify-between rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-slate-200 hover:border-cyan-500">
                            <span>{{ $game->name }}</span>
                            <span class="text-cyan-300">Play</span>
                        </a>
                    @empty
                        <p class="text-slate-400">No favorites yet. Find a game you love and save it.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-2xl font-bold text-white">Recent scores</h2>
                <div class="mt-5 space-y-3">
                    @forelse($recentScores as $score)
                        <div class="flex items-center justify-between rounded-xl border border-slate-700 bg-slate-950 px-4 py-3">
                            <span class="text-slate-200">{{ $score->game->name }}</span>
                            <span class="font-bold text-cyan-300">{{ $score->score }}</span>
                        </div>
                    @empty
                        <p class="text-slate-400">No scores logged yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
