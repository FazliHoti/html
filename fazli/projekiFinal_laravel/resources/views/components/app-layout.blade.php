<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Game Hub' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">
    <header class="border-b border-slate-800 bg-slate-900/80 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-tight text-cyan-400">Game Hub</a>
            <nav class="hidden items-center gap-6 md:flex">
                <a href="{{ route('home') }}" class="text-slate-300 hover:text-white">Home</a>
                <a href="{{ route('games.index') }}" class="text-slate-300 hover:text-white">Browse Games</a>
                <a href="{{ route('leaderboard') }}" class="text-slate-300 hover:text-white">Leaderboard</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-slate-300 hover:text-white">Dashboard</a>
                @endauth
            </nav>
            <div class="flex items-center gap-3">
                @guest
                    <a href="{{ route('login') }}" class="rounded-full border border-slate-600 px-4 py-2 text-sm text-slate-200 hover:border-cyan-400 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="rounded-full bg-cyan-500 px-4 py-2 text-sm font-semibold text-slate-950 hover:bg-cyan-400">Register</a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-full border border-slate-600 px-4 py-2 text-sm text-slate-200 hover:border-rose-400 hover:text-white">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="mx-auto mt-6 max-w-7xl rounded-xl border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mx-auto mt-6 max-w-7xl rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-sm text-rose-200">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot }}
    </main>
</body>
</html>
