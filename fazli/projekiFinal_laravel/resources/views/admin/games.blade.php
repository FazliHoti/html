<x-app-layout>
    @php($title = 'Manage games | PlayForge')

    <section class="page-shell">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="eyebrow">Behind the scenes</p>
                <h1 class="section-title mt-3">Manage the game shelf</h1>
                <p class="mt-3 text-[var(--ink-muted)]">Add a new game or tidy up the collection.</p>
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
            <div class="glass-panel auth-panel">
                <p class="eyebrow">New to the collection</p>
                <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Add a game</h2>
                <form action="{{ route('admin.games.store') }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label for="admin-game-name" class="form-label">Game name</label>
                        <input id="admin-game-name" type="text" name="name" value="{{ old('name') }}" required class="field" />
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="admin-game-category" class="form-label">Category</label>
                        <select id="admin-game-category" name="category_id" class="field">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="admin-game-description" class="form-label">Description</label>
                        <textarea id="admin-game-description" name="description" rows="4" required class="field">{{ old('description') }}</textarea>
                    </div>
                    <div>
                        <label for="admin-game-instructions" class="form-label">Instructions</label>
                        <textarea id="admin-game-instructions" name="instructions" rows="3" class="field">{{ old('instructions') }}</textarea>
                    </div>
                    <div>
                        <label for="admin-game-image" class="form-label">Image URL</label>
                        <input id="admin-game-image" type="url" name="image_url" value="{{ old('image_url') }}" class="field" />
                    </div>
                    <label class="flex items-center gap-3 text-sm font-semibold text-[var(--ink-muted)]">
                        <input type="checkbox" name="featured" value="1" @checked(old('featured')) class="h-4 w-4 rounded border-[var(--line)] accent-[var(--accent-strong)]" />
                        Feature this game
                    </label>
                    <button type="submit" class="btn-primary w-full">Save game</button>
                </form>
            </div>

            <div class="glass-panel">
                <p class="eyebrow">Already on the shelf</p>
                <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Current catalog</h2>
                <div class="mt-4">
                    @foreach($games as $game)
                        <div class="list-row flex items-center justify-between gap-4 px-3 py-4">
                            <div>
                                <p class="font-medium text-[var(--ink)]">{{ $game->name }}</p>
                                <p class="mt-1 text-sm text-[var(--ink-muted)]">{{ $game->category->name }}@if($game->featured) · Featured @endif</p>
                            </div>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-sm border border-[#d9b8aa] px-3 py-2 text-sm font-medium text-[#7d4635] transition-colors hover:bg-[#f4e9e3]">Remove</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
