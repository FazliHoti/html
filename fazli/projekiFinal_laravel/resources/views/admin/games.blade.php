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
                        <label for="admin-game-slug" class="form-label">Game page slug (optional)</label>
                        <input id="admin-game-slug" type="text" name="slug" value="{{ old('slug') }}" placeholder="generated-from-name" class="field" />
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
                    <div>
                        <label for="admin-game-embed" class="form-label">Game player URL</label>
                        <input id="admin-game-embed" type="text" name="embed_url" value="{{ old('embed_url') }}" placeholder="/games/my-game.html" class="field" />
                        <p class="mt-1 text-xs text-[var(--ink-muted)]">Path to a game file under public, or an https player URL.</p>
                    </div>
                    <label class="flex items-center gap-3 text-sm font-semibold text-[var(--ink-muted)]">
                        <input type="checkbox" name="featured" value="1" @checked(old('featured')) class="h-4 w-4 rounded border-[var(--line)] accent-[var(--accent-strong)]" />
                        Feature this game
                    </label>
                    <label class="flex items-center gap-3 text-sm font-semibold text-[var(--ink-muted)]">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) class="h-4 w-4 rounded border-[var(--line)] accent-[var(--accent-strong)]" />
                        Publish on the website
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
                                <p class="mt-1 text-sm text-[var(--ink-muted)]">{{ $game->category->name }}@if($game->featured) · Featured @endif @unless($game->is_active) · Draft @endunless</p>
                            </div>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-sm border border-[#d9b8aa] px-3 py-2 text-sm font-medium text-[#7d4635] transition-colors hover:bg-[#f4e9e3]">Remove</button>
                            </form>
                        </div>
                        <details class="mb-3 rounded-sm border border-[var(--line)] bg-white/40 p-4">
                            <summary class="cursor-pointer text-sm font-semibold text-[var(--accent-strong)]">Edit {{ $game->name }}</summary>
                            <form action="{{ route('admin.games.update', $game) }}" method="POST" class="mt-4 grid gap-3 sm:grid-cols-2">
                                @csrf
                                @method('PUT')
                                <label class="form-label">Game name<input type="text" name="name" value="{{ $game->name }}" required class="field mt-1" /></label>
                                <label class="form-label">Page slug<input type="text" name="slug" value="{{ $game->slug }}" required class="field mt-1" /></label>
                                <label class="form-label">Category<select name="category_id" class="field mt-1">@foreach($categories as $category)<option value="{{ $category->id }}" @selected($game->category_id === $category->id)>{{ $category->name }}</option>@endforeach</select></label>
                                <label class="form-label">Artwork URL<input type="text" name="image_url" value="{{ $game->image_url }}" class="field mt-1" /></label>
                                <label class="form-label sm:col-span-2">Description<textarea name="description" rows="3" required class="field mt-1">{{ $game->description }}</textarea></label>
                                <label class="form-label sm:col-span-2">Instructions<textarea name="instructions" rows="2" class="field mt-1">{{ $game->instructions }}</textarea></label>
                                <label class="form-label sm:col-span-2">Game player URL<input type="text" name="embed_url" value="{{ $game->embed_url }}" placeholder="/games/my-game.html" class="field mt-1" /></label>
                                <label class="flex items-center gap-2 text-sm text-[var(--ink-muted)]"><input type="checkbox" name="featured" value="1" @checked($game->featured) /> Featured</label>
                                <label class="flex items-center gap-2 text-sm text-[var(--ink-muted)]"><input type="checkbox" name="is_active" value="1" @checked($game->is_active) /> Published</label>
                                <button type="submit" class="btn-primary sm:col-span-2">Save game changes</button>
                            </form>
                        </details>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-[0.8fr_1.2fr]">
            <div class="glass-panel auth-panel">
                <p class="eyebrow">Organize the shelf</p>
                <h2 class="mt-2 font-serif text-2xl text-[var(--ink)]">Add a category</h2>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="mt-5 space-y-4">
                    @csrf
                    <label class="form-label">Name<input type="text" name="name" required class="field mt-1" /></label>
                    <label class="form-label">Slug (optional)<input type="text" name="slug" placeholder="generated-from-name" class="field mt-1" /></label>
                    <label class="form-label">Description<textarea name="description" rows="3" class="field mt-1"></textarea></label>
                    <button type="submit" class="btn-primary w-full">Add category</button>
                </form>
            </div>
            <div class="glass-panel p-5">
                <h2 class="font-serif text-2xl text-[var(--ink)]">Manage categories</h2>
                @foreach($categories as $category)
                    <div class="mt-4 border-t border-[var(--line)] pt-4">
                        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="grid gap-3 sm:grid-cols-[1fr_1fr_2fr_auto]">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $category->name }}" aria-label="Category name" required class="field" />
                            <input type="text" name="slug" value="{{ $category->slug }}" aria-label="Category slug" required class="field" />
                            <input type="text" name="description" value="{{ $category->description }}" aria-label="Category description" class="field" />
                            <button type="submit" class="btn-secondary">Save</button>
                        </form>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="mt-2 text-right">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-xs font-semibold text-[#7d4635]">Delete empty category</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
