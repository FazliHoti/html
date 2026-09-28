<x-app-layout>
    @php($title = 'Game Hub | Play More')

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-[1.2fr_0.8fr] lg:items-center">
            <div>
                <p class="mb-4 inline-flex rounded-full border border-cyan-400/40 bg-cyan-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-cyan-300">Arcade fun</p>
                <h1 class="text-5xl font-black tracking-tight text-white sm:text-6xl">Game Hub</h1>
                <p class="mt-6 max-w-xl text-lg text-slate-300">Play fast browser games, challenge friends, climb the leaderboard, and discover your favorite categories.</p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="{{ route('games.index') }}" class="rounded-full bg-cyan-500 px-6 py-3 font-semibold text-slate-950 hover:bg-cyan-400">Play now</a>
                    <a href="{{ route('leaderboard') }}" class="rounded-full border border-slate-600 px-6 py-3 font-semibold text-white hover:border-cyan-400 hover:text-cyan-300">View leaderboard</a>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-5 shadow-2xl shadow-cyan-900/20">
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach($featuredGames as $game)
                        <div class="overflow-hidden rounded-2xl border border-slate-700 bg-slate-800">
                            <img src="{{ $game->image_url ?? 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $game->name }}" class="h-28 w-full object-cover" />
                            <div class="p-4">
                                <p class="text-xs uppercase tracking-[0.2em] text-cyan-300">{{ $game->category->name }}</p>
                                <h3 class="mt-2 text-lg font-bold text-white">{{ $game->name }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Categories</h2>
        </div>
        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach($categories as $category)
                <a href="{{ route('games.index', ['category' => $category->slug]) }}" class="rounded-2xl border border-slate-700 bg-slate-900 p-5 transition hover:border-cyan-500 hover:bg-slate-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                        <span class="rounded-full bg-slate-800 px-2 py-1 text-xs text-slate-300">{{ $category->games_count }}</span>
                    </div>
                    <p class="mt-3 text-sm text-slate-400">{{ $category->description ?? 'Explore quick and fun games in this category.' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-white">Popular games</h2>
            <a href="{{ route('games.index') }}" class="text-sm font-semibold text-cyan-300 hover:text-cyan-200">Browse all</a>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($popularGames as $game)
                <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
                    <img src="{{ $game->image_url ?? 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $game->name }}" class="h-52 w-full object-cover" />
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <span class="rounded-full bg-cyan-500/10 px-2 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">{{ $game->category->name }}</span>
                            <span class="text-sm text-slate-400">{{ $game->play_count }} plays</span>
                        </div>
                        <h3 class="mt-4 text-xl font-bold text-white">{{ $game->name }}</h3>
                        <p class="mt-2 text-sm text-slate-400">{{ \Illuminate\Support\Str::limit($game->description, 120) }}</p>
                        <a href="{{ route('games.show', $game->slug) }}" class="mt-4 inline-flex rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-slate-200">Play game</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
