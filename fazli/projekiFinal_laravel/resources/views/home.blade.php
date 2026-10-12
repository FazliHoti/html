<x-app-layout>
    @php($title = 'PlayForge — a small arcade for good breaks')
    @php($leadGame = $featuredGames->first())

    <section class="page-shell pb-10 sm:pb-14">
        <div class="home-hero">
            <div>
                <p class="eyebrow">A little room to play</p>
                <h1 class="home-title mt-5">A good game, right on time.</h1>
                <p class="mt-6 max-w-lg text-base leading-7 text-[var(--ink-muted)] sm:text-lg">Small browser games for the space between things. Pick one up, play a round, and get back to your day.</p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('games.index') }}" class="btn-primary">Find a game</a>
                    <a href="{{ route('leaderboard') }}" class="btn-secondary">See the high scores</a>
                </div>
                <div class="mt-10 flex flex-wrap gap-x-8 gap-y-3 border-t border-[var(--line)] pt-5 text-sm text-[var(--ink-muted)]">
                    <span><strong class="font-semibold text-[var(--ink)]">{{ $totalGames }}</strong> games to play</span>
                    <span><strong class="font-semibold text-[var(--ink)]">{{ $categories->count() }}</strong> {{ \Illuminate\Support\Str::plural('category', $categories->count()) }}</span>
                    <span>No download, no fuss</span>
                </div>
            </div>

            <div class="hero-stage">
                @if($leadGame)
                    <a href="{{ route('games.show', $leadGame->slug) }}" class="group block overflow-hidden rounded-sm">
                        <div class="feature-art relative grid place-items-center overflow-hidden">
                            @if($leadGame->image_url)
                                <img src="{{ $leadGame->image_url }}" alt="{{ $leadGame->name }} game artwork" class="game-art-image absolute inset-0 h-full w-full object-cover" data-game-art="{{ $leadGame->slug }}" data-art-label="{{ $leadGame->name }} game artwork" data-fallback-mark="{{ mb_substr($leadGame->name, 0, 1) }}" />
                            @else
                                <span aria-hidden="true" class="font-serif text-8xl opacity-25">{{ mb_substr($leadGame->name, 0, 1) }}</span>
                            @endif
                            <span class="absolute bottom-4 left-4 border border-white/50 bg-[var(--paper-soft)]/90 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.12em] text-[var(--accent-strong)]">Today's pick</span>
                        </div>
                        <div class="flex flex-wrap items-end justify-between gap-4 px-2 py-5">
                            <div>
                                <p class="eyebrow">{{ $leadGame->category->name }}</p>
                                <h2 class="mt-2 font-serif text-3xl tracking-tight text-[var(--ink)] transition-colors group-hover:text-[var(--accent-strong)]">{{ $leadGame->name }}</h2>
                                <p class="mt-2 max-w-md text-sm leading-6 text-[var(--ink-muted)]">{{ \Illuminate\Support\Str::limit($leadGame->description, 110) }}</p>
                            </div>
                            <span class="border-b border-[var(--accent)] pb-1 text-sm font-semibold text-[var(--accent-strong)]">Play a round <span aria-hidden="true">↗</span></span>
                        </div>
                    </a>
                @else
                    <div class="feature-art grid place-items-center rounded-sm p-8 text-center">
                        <div>
                            <p class="eyebrow">The arcade is getting ready</p>
                            <p class="mt-3 font-serif text-3xl text-[var(--ink)]">A good little break is on its way.</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="page-shell pt-4">
        <div class="flex flex-col gap-3 border-b border-[var(--line)] pb-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow">Find your kind of fun</p>
                <h2 class="section-title mt-3">What sounds good?</h2>
            </div>
            <a href="{{ route('games.index') }}" class="text-sm font-bold text-[var(--accent-strong)] hover:text-[var(--clay)]">Explore the collection</a>
        </div>
        <div class="mt-5 grid gap-x-8 md:grid-cols-2 xl:grid-cols-4">
            @foreach($categories as $category)
                <a href="{{ route('games.index', ['category' => $category->slug]) }}" class="category-tile">
                    <div class="flex items-center justify-between gap-3">
                        <h3 class="font-serif text-xl text-[var(--ink)]">{{ $category->name }}</h3>
                        <span class="text-xs text-[var(--ink-muted)]">{{ $category->games_count }} {{ \Illuminate\Support\Str::plural('game', $category->games_count) }}</span>
                    </div>
                    <p class="mt-2 muted-copy">{{ $category->description ?? 'A few good games, all in one place.' }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="page-shell">
        <div class="flex flex-col gap-3 border-b border-[var(--line)] pb-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow">Popular around here</p>
                <h2 class="section-title mt-3">A few favorites</h2>
            </div>
            <a href="{{ route('games.index') }}" class="text-sm font-bold text-[var(--accent-strong)] hover:text-[var(--clay)]">Browse all</a>
        </div>

        <div class="mt-6 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
            @foreach($popularGames as $index => $game)
                <article class="game-card {{ $index === 0 ? 'xl:col-span-2' : '' }}">
                    @if($game->image_url)
                        <img src="{{ $game->image_url }}" alt="{{ $game->name }} game artwork" class="game-card-image game-art-image {{ $index === 0 ? 'h-60' : 'h-44' }}" data-game-art="{{ $game->slug }}" data-art-label="{{ $game->name }} game artwork" data-fallback-mark="{{ mb_substr($game->name, 0, 1) }}" />
                    @else
                        <div class="feature-art grid {{ $index === 0 ? 'h-60' : 'h-44' }} place-items-center" aria-hidden="true"><span class="font-serif text-6xl opacity-30">{{ mb_substr($game->name, 0, 1) }}</span></div>
                    @endif
                    <div class="p-5">
                        <div class="flex items-center justify-between gap-3">
                            <span class="chip">{{ $game->category->name }}</span>
                            <span class="text-xs text-[var(--ink-muted)]">{{ $game->play_count }} plays</span>
                        </div>
                        <h3 class="mt-4 font-serif text-2xl text-[var(--ink)]">{{ $game->name }}</h3>
                        <p class="mt-2 muted-copy">{{ \Illuminate\Support\Str::limit($game->description, 120) }}</p>
                        <a href="{{ route('games.show', $game->slug) }}" class="mt-5 inline-flex items-center gap-2 border-b border-[var(--line)] pb-1 text-sm font-semibold text-[var(--accent-strong)] transition-colors hover:border-[var(--clay)]">Play a round <span aria-hidden="true">→</span></a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</x-app-layout>
