<x-app-layout>
    @php($title = $game->name . ' | Game Hub')

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="overflow-hidden rounded-3xl border border-slate-800 bg-slate-900">
                <img src="{{ $game->image_url ?? 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $game->name }}" class="h-80 w-full object-cover" />
                <div class="p-8">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-cyan-300">{{ $game->category->name }}</p>
                            <h1 class="mt-3 text-4xl font-black text-white">{{ $game->name }}</h1>
                        </div>
                        <form action="{{ route('games.favorite', $game) }}" method="POST">
                            @csrf
                            <button type="submit" class="rounded-full border border-slate-600 px-4 py-2 text-sm font-semibold text-white hover:border-cyan-400 hover:text-cyan-300">Save favorite</button>
                        </form>
                    </div>

                    <p class="mt-6 text-slate-300">{{ $game->description }}</p>

                    <div class="mt-8 rounded-2xl border border-slate-700 bg-slate-950 p-5">
                        <h2 class="text-xl font-bold text-white">How to play</h2>
                        <p class="mt-3 text-slate-300">{{ $game->instructions ?? 'Use your keyboard and aim for a better score.' }}</p>
                    </div>

                    <div class="mt-8 rounded-2xl border border-slate-700 bg-slate-950 p-5">
                        <div class="flex items-center justify-between">
                            <h2 class="text-xl font-bold text-white">Mini game</h2>
                            <span class="text-sm text-slate-400">{{ $averageRating }}/5 rating</span>
                        </div>
                        <div id="game-display" data-game-slug="{{ $game->slug }}" data-game-name="{{ $game->name }}" class="mt-5 rounded-2xl border border-dashed border-slate-600 bg-slate-900 text-center text-slate-200"></div>
                    </div>
                </div>
            </div>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                    <h2 class="text-xl font-bold text-white">Game stats</h2>
                    <div class="mt-5 space-y-4 text-sm text-slate-300">
                        <div class="flex items-center justify-between"><span>Favorites</span><strong class="text-white">{{ $favoriteCount }}</strong></div>
                        <div class="flex items-center justify-between"><span>Players</span><strong class="text-white">{{ $game->play_count }}</strong></div>
                        <div class="flex items-center justify-between"><span>Average rating</span><strong class="text-white">{{ $averageRating }}</strong></div>
                    </div>

                    <form action="{{ route('games.score', $game->slug) }}" method="POST" class="mt-6 space-y-3">
                        @csrf
                        <label class="block text-sm text-slate-300">Submit score</label>
                        <input type="number" name="score" min="0" value="0" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none" />
                        <button type="submit" class="w-full rounded-full bg-cyan-500 px-4 py-3 font-semibold text-slate-950 hover:bg-cyan-400">Save score</button>
                    </form>
                </div>

                <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                    <h2 class="text-xl font-bold text-white">Top players</h2>
                    <div class="mt-5 space-y-3">
                        @forelse($leaderboard as $entry)
                            <div class="flex items-center justify-between rounded-xl bg-slate-950 px-3 py-2">
                                <div>
                                    <p class="font-semibold text-white">{{ $entry->user->name ?? 'Player' }}</p>
                                    <p class="text-xs text-slate-400">{{ $entry->game->name }}</p>
                                </div>
                                <span class="font-bold text-cyan-300">{{ $entry->score }}</span>
                            </div>
                        @empty
                            <p class="text-sm text-slate-400">No scores yet. Be the first to play.</p>
                        @endforelse
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                    <h2 class="text-xl font-bold text-white">Write a review</h2>
                    <form action="{{ route('games.review', $game) }}" method="POST" class="mt-5 space-y-3">
                        @csrf
                        <select name="rating" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none">
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Good</option>
                            <option value="3">3 - Okay</option>
                            <option value="2">2 - Weak</option>
                            <option value="1">1 - Bad</option>
                        </select>
                        <textarea name="comment" rows="4" placeholder="Tell players what you thought..." class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none"></textarea>
                        <button type="submit" class="w-full rounded-full bg-white px-4 py-3 font-semibold text-slate-950 hover:bg-slate-200">Submit review</button>
                    </form>
                </div>
            </aside>
        </div>
    </section>
</x-app-layout>
