<x-app-layout>
    @php($title = 'Browse Games | Game Hub')

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">Game catalog</p>
                <h1 class="mt-3 text-4xl font-black text-white">All games</h1>
            </div>

            <form method="GET" class="flex flex-col gap-3 sm:flex-row">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search games..." class="w-full rounded-full border border-slate-700 bg-slate-900 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none sm:w-72" />
                <select name="category" class="rounded-full border border-slate-700 bg-slate-900 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="rounded-full bg-cyan-500 px-5 py-3 font-semibold text-slate-950 hover:bg-cyan-400">Filter</button>
            </form>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($games as $game)
                <div class="overflow-hidden rounded-2xl border border-slate-800 bg-slate-900">
                    <img src="{{ $game->image_url ?? 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $game->name }}" class="h-52 w-full object-cover" />
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <span class="rounded-full bg-cyan-500/10 px-2 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-300">{{ $game->category->name }}</span>
                            @if($game->featured)
                                <span class="text-xs font-semibold uppercase tracking-[0.2em] text-yellow-300">Featured</span>
                            @endif
                        </div>
                        <h2 class="mt-4 text-2xl font-bold text-white">{{ $game->name }}</h2>
                        <p class="mt-2 text-sm text-slate-400">{{ \Illuminate\Support\Str::limit($game->description, 120) }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <a href="{{ route('games.show', $game->slug) }}" class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-slate-200">Open game</a>
                            <span class="text-xs text-slate-400">{{ $game->play_count }} plays</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10">
            {{ $games->links() }}
        </div>
    </section>
</x-app-layout>
