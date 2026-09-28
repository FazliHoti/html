<x-app-layout>
    @php($title = 'Leaderboard | Game Hub')

    <section class="mx-auto max-w-5xl px-4 py-12 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-black text-white">Global leaderboard</h1>
        <div class="mt-8 overflow-hidden rounded-3xl border border-slate-800 bg-slate-900">
            <table class="min-w-full divide-y divide-slate-800 text-left">
                <thead class="bg-slate-950 text-sm uppercase tracking-[0.2em] text-slate-400">
                    <tr>
                        <th class="px-6 py-4">Rank</th>
                        <th class="px-6 py-4">Player</th>
                        <th class="px-6 py-4">Game</th>
                        <th class="px-6 py-4 text-right">Best score</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @foreach($players as $index => $player)
                        <tr class="text-slate-200">
                            <td class="px-6 py-4 font-bold text-cyan-300">#{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $player->user->name ?? 'Unknown player' }}</td>
                            <td class="px-6 py-4">{{ $player->game->name ?? 'Game' }}</td>
                            <td class="px-6 py-4 text-right font-bold text-white">{{ $player->best_score }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</x-app-layout>
