<x-app-layout>
    @php($title = 'Admin Games | Game Hub')

    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-cyan-300">Admin panel</p>
                <h1 class="mt-3 text-4xl font-black text-white">Manage games</h1>
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-2xl font-bold text-white">Add a game</h2>
                <form action="{{ route('admin.games.store') }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Game name</label>
                        <input type="text" name="name" required class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none" />
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Category</label>
                        <select name="category_id" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Description</label>
                        <textarea name="description" rows="4" required class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none"></textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Instructions</label>
                        <textarea name="instructions" rows="3" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none"></textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm text-slate-300">Image URL</label>
                        <input type="url" name="image_url" class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white focus:border-cyan-400 focus:outline-none" />
                    </div>
                    <label class="flex items-center gap-3 text-sm text-slate-300">
                        <input type="checkbox" name="featured" value="1" class="h-4 w-4 rounded border-slate-700 bg-slate-950" />
                        Feature this game
                    </label>
                    <button type="submit" class="w-full rounded-full bg-cyan-500 px-5 py-3 font-semibold text-slate-950 hover:bg-cyan-400">Save game</button>
                </form>
            </div>

            <div class="rounded-3xl border border-slate-800 bg-slate-900 p-6">
                <h2 class="text-2xl font-bold text-white">Current catalog</h2>
                <div class="mt-5 space-y-3">
                    @foreach($games as $game)
                        <div class="flex items-center justify-between gap-4 rounded-xl border border-slate-700 bg-slate-950 px-4 py-3">
                            <div>
                                <p class="font-semibold text-white">{{ $game->name }}</p>
                                <p class="text-sm text-slate-400">{{ $game->category->name }}</p>
                            </div>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-full border border-rose-500/30 bg-rose-500/10 px-4 py-2 text-sm font-semibold text-rose-200 hover:bg-rose-500/20">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
