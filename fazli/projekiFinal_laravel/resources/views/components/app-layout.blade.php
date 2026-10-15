<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PlayForge — '.\App\Models\SiteSetting::text('brand.tagline', 'a small arcade for good breaks') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen antialiased">
    <header class="site-header sticky top-0 z-40">
        <div class="site-header-inner">
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 text-xl text-[var(--ink)]">
                <span class="brand-mark" aria-hidden="true">P</span>
                <span class="brand-wordmark">PlayForge</span>
            </a>
            <nav class="site-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}" class="nav-link" @if(request()->routeIs('home')) aria-current="page" @endif>{{ \App\Models\SiteSetting::text('nav.home', 'Home') }}</a>
                <a href="{{ route('games.index') }}" class="nav-link" @if(request()->routeIs('games.*')) aria-current="page" @endif>{{ \App\Models\SiteSetting::text('nav.games', 'Games') }}</a>
                <a href="{{ route('leaderboard') }}" class="nav-link" @if(request()->routeIs('leaderboard')) aria-current="page" @endif>{{ \App\Models\SiteSetting::text('nav.scores', 'Scores') }}</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link" @if(request()->routeIs('dashboard')) aria-current="page" @endif>{{ \App\Models\SiteSetting::text('nav.my_games', 'My games') }}</a>
                    @if(auth()->user()->email === 'admin@example.com')
                        <a href="{{ route('admin.dashboard') }}" class="nav-link" @if(request()->routeIs('admin.*')) aria-current="page" @endif>Admin</a>
                    @endif
                @endauth
            </nav>
            <div class="site-actions flex items-center justify-end gap-3">
                @guest
                    <a href="{{ route('login') }}" class="text-sm font-medium text-[var(--ink-muted)] transition hover:text-[var(--ink)]">{{ \App\Models\SiteSetting::text('nav.login', 'Log in') }}</a>
                    <a href="{{ route('register') }}" class="btn-primary">{{ \App\Models\SiteSetting::text('nav.join', 'Join the arcade') }}</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-secondary">{{ \App\Models\SiteSetting::text('nav.logout', 'Log out') }}</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div role="status" class="notice mx-auto mt-5 max-w-7xl px-5 py-3 text-sm font-medium sm:px-8 lg:px-10">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div role="alert" class="notice notice-error mx-auto mt-5 max-w-7xl px-5 py-3 text-sm font-medium sm:px-8 lg:px-10">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>
    <footer class="site-footer mt-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-5 py-7 text-sm text-[var(--ink-muted)] sm:flex-row sm:items-center sm:justify-between sm:px-8 lg:px-10">
            <a href="{{ route('home') }}" class="brand-wordmark text-base text-[var(--ink)]">PlayForge <span class="font-sans text-xs font-normal tracking-normal text-[var(--ink-muted)]">— {{ \App\Models\SiteSetting::text('brand.tagline', 'a small arcade for good breaks') }}</span></a>
            <div class="flex flex-wrap gap-x-5 gap-y-2">
                <a href="{{ route('games.index') }}" class="transition hover:text-[var(--accent-strong)]">{{ \App\Models\SiteSetting::text('footer.browse', 'Browse games') }}</a>
                <a href="{{ route('leaderboard') }}" class="transition hover:text-[var(--accent-strong)]">{{ \App\Models\SiteSetting::text('footer.scores', 'High scores') }}</a>
                @guest
                    <a href="{{ route('login') }}" class="transition hover:text-[var(--accent-strong)]">{{ \App\Models\SiteSetting::text('footer.signin', 'Player sign in') }}</a>
                @endguest
            </div>
        </div>
    </footer>
</body>
</html>
