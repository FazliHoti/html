<x-app-layout>
    @php($title = 'Explore Games | PlayForge')

    <section class="page-shell">
        <div class="catalog-hero">
            <div>
                <p class="eyebrow">The game shelf</p>
                <h1 class="catalog-title mt-3 font-serif text-[var(--ink)]">Find your next little obsession.</h1>
                <p class="mt-4 max-w-xl leading-7 text-[var(--ink-muted)]">Browse by mood or search for an old favorite. Everything here opens right in your browser.</p>
            </div>

            <form method="GET" class="grid w-full gap-3 sm:grid-cols-[1fr_1fr_auto] lg:w-auto lg:min-w-[34rem]">
                <div>
                    <label for="game-search" class="form-label">Search</label>
                    <input id="game-search" type="search" name="search" value="{{ request('search') }}" placeholder="A game or a mood" class="field" />
                </div>
                <div>
                    <label for="game-category" class="form-label">Category</label>
                    <select id="game-category" name="category" class="field">
                        <option value="">Every kind</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn-primary self-end">Find games</button>
            </form>
        </div>

        <div class="mt-7 flex items-center justify-between border-b border-[var(--line)] pb-3 text-sm text-[var(--ink-muted)]">
            <p>{{ $games->total() }} {{ \Illuminate\Support\Str::plural('game', $games->total()) }} in the collection</p>
            @if(request()->filled('search') || request()->filled('category'))
                <a href="{{ route('games.index') }}" class="font-medium text-[var(--accent-strong)] underline decoration-[var(--line)] underline-offset-4 hover:decoration-[var(--clay)]">Clear filters</a>
            @endif
        </div>

        <div class="mt-5 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @forelse($games as $game)
                <article class="game-card">
                    @if($game->image_url)
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }} game artwork" class="game-card-image game-art-image" data-game-art="{{ $game->slug }}" data-art-label="{{ $game->name }} game artwork" data-fallback-mark="{{ mb_substr($game->name, 0, 1) }}" />
                    @else
                        <div class="feature-art grid h-48 place-items-center" aria-hidden="true"><span class="font-serif text-6xl opacity-30">{{ mb_substr($game->name, 0, 1) }}</span></div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <span class="chip">{{ $game->category->name }}</span>
                            @if($game->featured)
                                <span class="text-xs font-medium text-[var(--clay)]">A favorite</span>
                            @endif
                        </div>
                        <h2 class="mt-4 font-serif text-2xl text-[var(--ink)]">{{ $game->name }}</h2>
                        <p class="mt-2 muted-copy">{{ \Illuminate\Support\Str::limit($game->description, 120) }}</p>
                        <div class="mt-5 flex items-center justify-between gap-3">
                            <a href="{{ route('games.show', $game->slug) }}" class="inline-flex items-center gap-2 border-b border-[var(--line)] pb-1 text-sm font-semibold text-[var(--accent-strong)] transition-colors hover:border-[var(--clay)]">Play a round <span aria-hidden="true">→</span></a>
                            <span class="text-xs text-[var(--ink-muted)]">{{ $game->play_count }} plays</span>
                        </div>
                    </div>
                </article>
            @empty
                <div class="glass-panel p-8 md:col-span-2 xl:col-span-3">
                    <p class="eyebrow">Nothing on this shelf</p>
                    <h2 class="mt-3 font-serif text-3xl text-[var(--ink)]">No games match that just yet.</h2>
                    <p class="mt-2 text-[var(--ink-muted)]">Try another title or browse the full collection instead.</p>
                    <a href="{{ route('games.index') }}" class="btn-secondary mt-5">See every game</a>
                </div>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $games->links() }}
        </div>
    </section>
</x-app-layout>
