<x-app-layout>
    @php($title = 'Admin dashboard | PlayForge')

    <section class="page-shell">
        <div class="flex flex-col justify-between gap-5 border-b border-[var(--line)] pb-6 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow">Site control room</p>
                <h1 class="section-title mt-3">Admin dashboard</h1>
                <p class="mt-3 max-w-2xl text-[var(--ink-muted)]">Manage the game catalog, categories, and the text and buttons shown across the website.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.games') }}" class="btn-primary">Manage games and categories</a>
                <a href="{{ route('admin.game-files') }}" class="btn-secondary">Edit game source</a>
            </div>
        </div>

        <div class="mt-7 grid gap-4 sm:grid-cols-3">
            <div class="stat-card"><p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">All games</p><p class="mt-2 font-serif text-3xl text-[var(--ink)]">{{ $gameCount }}</p></div>
            <div class="stat-card"><p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Published games</p><p class="mt-2 font-serif text-3xl text-[var(--ink)]">{{ $activeGameCount }}</p></div>
            <div class="stat-card"><p class="text-xs uppercase tracking-[0.12em] text-[var(--ink-muted)]">Categories</p><p class="mt-2 font-serif text-3xl text-[var(--ink)]">{{ $categoryCount }}</p></div>
        </div>

        <div class="mt-10 border-b border-[var(--line)] pb-4">
            <p class="eyebrow">Text and buttons</p>
            <h2 class="mt-2 font-serif text-3xl text-[var(--ink)]">Edit website copy</h2>
            <p class="mt-2 text-sm text-[var(--ink-muted)]">Changes apply immediately to the corresponding pages. Leave a field unchanged to keep its current wording.</p>
        </div>
        <form action="{{ route('admin.content.update') }}" method="POST" class="mt-6">
            @csrf
            @method('PUT')
            <div class="grid gap-4 md:grid-cols-2">
                @foreach($content as $key => $item)
                    <div class="glass-panel p-4">
                        <label for="content-{{ str_replace('.', '-', $key) }}" class="form-label">{{ $item['label'] }}</label>
                        <textarea id="content-{{ str_replace('.', '-', $key) }}" name="content[{{ $key }}]" rows="{{ mb_strlen($item['value']) > 90 ? 3 : 2 }}" class="field">{{ $item['value'] }}</textarea>
                        @error('content.'.$key)<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>
            <div class="sticky bottom-4 mt-6 flex justify-end">
                <button type="submit" class="btn-primary shadow-lg">Save website text</button>
            </div>
        </form>
    </section>
</x-app-layout>