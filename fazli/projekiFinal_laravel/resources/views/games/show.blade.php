<x-app-layout>
    @php($title = $game->name . ' | PlayForge')

    <section class="play-page page-shell">
        <div class="mb-7 flex flex-col gap-6 border-b border-[var(--line)] pb-7 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <a href="{{ route('games.index') }}" class="text-sm font-medium text-[var(--accent-strong)] transition hover:text-[var(--clay)]">{{ \App\Models\SiteSetting::text('game.back', '← Back to the game shelf') }}</a>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <span class="chip">{{ $game->category->name }}</span>
                    @if($game->featured)
                        <span class="text-xs font-medium text-[var(--clay)]">A player favorite</span>
                    @endif
                </div>
                <h1 class="mt-4 font-serif text-4xl tracking-tight text-[var(--ink)] sm:text-5xl">{{ $game->name }}</h1>
                <p class="mt-3 max-w-3xl text-base leading-7 text-[var(--ink-muted)]">{{ $game->description }}</p>
            </div>

            <form action="{{ route('games.favorite', $game) }}" method="POST">
                @csrf
                <button type="submit" class="btn-secondary">{{ \App\Models\SiteSetting::text('game.favorite', 'Save to my games') }}</button>
            </form>
        </div>

        <div class="play-dock">
            <div class="play-dock-header">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.16em] text-[#b8c9bf]">Ready when you are</p>
                    <p class="mt-1 text-sm text-[#e1e5df]">{{ $game->instructions ?? 'Use your keyboard and see how far you get.' }}</p>
                </div>
                <span class="text-xs text-[#cbd4cd]">{{ $averageRating }}/5 from players</span>
            </div>

            <div id="game-display" data-game-slug="{{ $game->slug }}" data-game-name="{{ $game->name }}" data-game-url="{{ $gameEmbedUrl ?? '' }}" class="play-screen"></div>
        </div>

        <div class="score-strip">
            <div class="px-2">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Plays</p>
                <p class="mt-1 font-serif text-2xl text-[var(--ink)]">{{ $game->play_count }}</p>
            </div>
            <div class="px-2">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Rating</p>
                <p class="mt-1 font-serif text-2xl text-[var(--ink)]">{{ $averageRating }}<span class="text-sm text-[var(--ink-muted)]"> / 5</span></p>
            </div>
            <div class="px-2">
                <p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Saved by</p>
                <p class="mt-1 font-serif text-2xl text-[var(--ink)]">{{ $favoriteCount }}</p>
            </div>
            <form action="{{ route('games.score', $game->slug) }}" method="POST" class="score-form">
                @csrf
                <label for="player-score" class="sr-only">Your score</label>
                <input id="player-score" type="number" name="score" min="0" value="{{ old('score', 0) }}" inputmode="numeric" class="field" />
                @error('score')<p class="form-error sm:basis-full">{{ $message }}</p>@enderror
                <button type="submit" class="btn-primary whitespace-nowrap">{{ \App\Models\SiteSetting::text('game.score_button', 'Add your score') }}</button>
            </form>
        </div>
        <p id="score-feedback" class="score-feedback" role="status" aria-live="polite" hidden></p>

        <div class="mt-10 grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
            <section class="info-panel">
                <div class="flex items-end justify-between gap-4 border-b border-[var(--line)] pb-4">
                    <div>
                        <p class="eyebrow">A little friendly rivalry</p>
                        <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Best runs</h2>
                    </div>
                    <a href="{{ route('leaderboard') }}" class="text-xs font-medium text-[var(--accent-strong)] underline decoration-[var(--line)] underline-offset-4 hover:decoration-[var(--clay)]">All scores</a>
                </div>
                <div class="mt-2">
                    @forelse($leaderboard as $index => $entry)
                        <div class="list-row flex items-center justify-between gap-4 px-3 py-3">
                            <div>
                                <p class="text-xs text-[var(--ink-muted)]">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }} · {{ $entry->user->name ?? 'Player' }}</p>
                            </div>
                            <span class="font-semibold tabular-nums text-[var(--accent-strong)]">{{ $entry->score }}</span>
                        </div>
                    @empty
                        <p class="py-5 text-sm leading-6 text-[var(--ink-muted)]">No scores just yet. Play a round and leave the first mark.</p>
                    @endforelse
                </div>
            </section>

            <section class="info-panel">
                <div class="grid gap-6 {{ $game->image_url ? 'md:grid-cols-[0.8fr_1.2fr]' : '' }}">
                    @if($game->image_url)
                        <div class="min-h-48 overflow-hidden rounded-sm bg-[var(--paper-warm)]">
                            <img src="{{ $game->image_url }}" alt="{{ $game->name }} game artwork" class="game-art-image h-full min-h-48 w-full object-cover" data-game-art="{{ $game->slug }}" data-art-label="{{ $game->name }} game artwork" data-fallback-mark="{{ mb_substr($game->name, 0, 1) }}" />
                        </div>
                    @endif
                    <div>
                        <p class="eyebrow">After the round</p>
                        <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">{{ \App\Models\SiteSetting::text('game.review_title', 'Leave a note') }}</h2>
                        <p class="mt-2 text-sm leading-6 text-[var(--ink-muted)]">A quick rating helps the next player decide what to try.</p>
                        <form action="{{ route('games.review', $game) }}" method="POST" class="mt-5 space-y-3">
                            @csrf
                            <label for="review-rating" class="form-label">Your rating</label>
                            <select id="review-rating" name="rating" class="field">
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Okay</option>
                                <option value="2">2 - Weak</option>
                                <option value="1">1 - Bad</option>
                            </select>
                            @error('rating')<p class="form-error">{{ $message }}</p>@enderror
                            <label for="review-comment" class="form-label">Anything to add? <span class="font-normal text-[var(--ink-muted)]">(optional)</span></label>
                            <textarea id="review-comment" name="comment" rows="3" placeholder="What stood out?" class="field"></textarea>
                            @error('comment')<p class="form-error">{{ $message }}</p>@enderror
                            <button type="submit" class="btn-secondary">{{ \App\Models\SiteSetting::text('game.review_button', 'Share your note') }}</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </section>
</x-app-layout>
