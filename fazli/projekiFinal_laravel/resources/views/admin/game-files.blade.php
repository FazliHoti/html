<x-app-layout>
    @php($title = 'Edit game source | PlayForge')

    <section class="page-shell">
        <div class="flex flex-col justify-between gap-5 border-b border-[var(--line)] pb-6 sm:flex-row sm:items-end">
            <div>
                <p class="eyebrow">Game workshop</p>
                <h1 class="section-title mt-3">Edit game source</h1>
                <p class="mt-3 max-w-2xl text-[var(--ink-muted)]">Edit the actual HTML game files, including their on-screen text, buttons, visuals, and gameplay code.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary">Back to dashboard</a>
        </div>

        <div class="mt-7 grid gap-6 lg:grid-cols-[15rem_1fr]">
            <aside class="glass-panel p-4">
                <h2 class="font-serif text-xl text-[var(--ink)]">Game files</h2>
                <nav class="mt-3 grid gap-1" aria-label="Game source files">
                    @foreach($gameFiles as $gameFile)
                        <a href="{{ route('admin.game-files', ['file' => $gameFile]) }}" @if($selectedFile === $gameFile) aria-current="page" @endif class="rounded-sm px-3 py-2 text-sm {{ $selectedFile === $gameFile ? 'bg-[var(--accent-strong)] text-white' : 'text-[var(--ink-muted)] hover:bg-white/60' }}">{{ $gameFile }}</a>
                    @endforeach
                </nav>
            </aside>

            <div class="glass-panel p-5">
                <div class="mb-4 rounded-sm border border-amber-300 bg-amber-50 p-4 text-sm leading-6 text-amber-950">
                    This editor saves executable HTML and JavaScript directly to the site. Keep a backup before making changes; invalid code can break the selected game. Game files must be writable by the web server.
                </div>
                @if($selectedFile)
                    <form action="{{ route('admin.game-files.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="file_name" value="{{ $selectedFile }}" />
                        <label for="game-source" class="form-label">Source: {{ $selectedFile }}</label>
                        <textarea id="game-source" name="source" rows="32" spellcheck="false" class="field mt-2 font-mono text-xs leading-5">{{ $source }}</textarea>
                        @error('source')<p class="form-error">{{ $message }}</p>@enderror
                        <div class="mt-4 flex flex-wrap justify-between gap-3">
                            <a href="{{ asset('games/'.$selectedFile) }}" target="_blank" rel="noopener" class="btn-secondary">Preview current game</a>
                            <button type="submit" class="btn-primary">Save game source</button>
                        </div>
                    </form>
                @else
                    <p class="text-sm text-[var(--ink-muted)]">No HTML game files were found.</p>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>