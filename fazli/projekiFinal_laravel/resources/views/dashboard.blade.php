<x-app-layout>
    @php($title = 'My games | PlayForge')

    <section class="page-shell">
        <div class="mb-8">
            <p class="eyebrow">Your corner of the arcade</p>
            <h1 class="section-title mt-3">{{ str_replace(':name', Auth::user()->name, \App\Models\SiteSetting::text('dashboard.title', 'Good to see you, :name.')) }}</h1>
            <p class="mt-3 max-w-xl leading-7 text-[var(--ink-muted)]">Your saved games and latest scores, all in one easy place.</p>
        </div>

        <div class="grid gap-5 border-y border-[var(--line)] py-5 md:grid-cols-3">
            <div class="stat-card">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Personal best</p>
                <p class="mt-2 font-serif text-3xl tabular-nums text-[var(--ink)]">{{ $topScore ?? 0 }}</p>
            </div>
            <div class="stat-card">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Saved for later</p>
                <p class="mt-2 font-serif text-3xl tabular-nums text-[var(--ink)]">{{ $favoriteCount }}</p>
            </div>
            <div class="stat-card">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Last score</p>
                <p class="mt-2 font-serif text-3xl tabular-nums text-[var(--ink)]">{{ $recentScores->first()->score ?? '—' }}</p>
            </div>
        </div>

        <div class="mt-10 grid gap-10 lg:grid-cols-2">
            <section>
                <div class="flex items-end justify-between gap-4 border-b border-[var(--line)] pb-4">
                    <div>
                        <p class="eyebrow">Keep close</p>
                        <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Saved games</h2>
                    </div>
                    <a href="{{ route('games.index') }}" class="text-sm font-medium text-[var(--accent-strong)] hover:text-[var(--clay)]">Find more</a>
                </div>
                <div class="mt-2">
                    @forelse($favoriteGames as $game)
                        <a href="{{ route('games.show', $game->slug) }}" class="list-row flex items-center justify-between gap-4 px-3 py-4 text-[var(--ink)]">
                            <span class="font-medium">{{ $game->name }}</span>
                            <span class="text-sm text-[var(--accent-strong)]">Play <span aria-hidden="true">→</span></span>
                        </a>
                    @empty
                        <p class="py-5 text-sm leading-6 text-[var(--ink-muted)]">Nothing saved yet. Browse the shelf and keep the games you want to come back to.</p>
                        <a href="{{ route('games.index') }}" class="btn-secondary">Browse games</a>
                    @endforelse
                </div>
            </section>

            <section>
                <div class="border-b border-[var(--line)] pb-4">
                    <p class="eyebrow">Your last few rounds</p>
                    <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Recent scores</h2>
                </div>
                <div class="mt-2">
                    @forelse($recentScores as $score)
                        <a href="{{ route('games.show', $score->game->slug) }}" class="list-row flex items-center justify-between gap-4 px-3 py-4">
                            <span class="font-medium text-[var(--ink)]">{{ $score->game->name }}</span>
                            <span class="font-semibold tabular-nums text-[var(--clay)]">{{ $score->score }} <span class="text-xs font-normal text-[var(--ink-muted)]">points</span></span>
                        </a>
                    @empty
                        <p class="py-5 text-sm leading-6 text-[var(--ink-muted)]">Your first score is waiting. Pick a game and see where you land.</p>
                        <a href="{{ route('games.index') }}" class="btn-secondary">Choose a game</a>
                    @endforelse
                </div>
            </section>
        </div>
    </section>
</x-app-layout>
