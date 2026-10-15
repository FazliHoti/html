<x-app-layout>
    @php($title = 'High scores | PlayForge')

    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-5 border-b border-[var(--line)] pb-6 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="eyebrow">Every round counts</p>
                <h1 class="section-title mt-3">{{ \App\Models\SiteSetting::text('leaderboard.title', 'The high scores') }}</h1>
                <p class="mt-3 max-w-lg leading-7 text-[var(--ink-muted)]">A running list of the best games played around here. Yours could be next.</p>
            </div>
            <a href="{{ route('games.index') }}" class="btn-primary self-start sm:self-auto">{{ \App\Models\SiteSetting::text('leaderboard.button', 'Play for a place') }}</a>
        </div>
        <div class="table-panel mt-7">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-[var(--line)] text-left">
                <thead class="table-head text-xs font-medium uppercase tracking-[0.12em]">
                    <tr>
                        <th class="px-6 py-4">Rank</th>
                        <th class="px-6 py-4">Player</th>
                        <th class="px-6 py-4">Game</th>
                        <th class="px-6 py-4 text-right">Best score</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[rgba(117,98,75,0.18)]">
                    @forelse($players as $index => $player)
                        <tr class="text-[var(--ink)] transition-colors hover:bg-[rgba(54,86,75,0.045)]">
                            <td class="whitespace-nowrap px-6 py-4 font-serif text-lg text-[var(--clay)]">{{ str_pad((string) ($players->firstItem() + $index), 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $player->user->name ?? 'Unknown player' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-[var(--ink-muted)]">{{ $player->game->name ?? 'Game' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right font-semibold tabular-nums text-[var(--accent-strong)]">{{ $player->best_score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <p class="font-serif text-xl text-[var(--ink)]">The board is still open.</p>
                                <p class="mt-2 text-sm text-[var(--ink-muted)]">Play a round and set the first score.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8">
            {{ $players->links() }}
        </div>
    </section>
</x-app-layout>
