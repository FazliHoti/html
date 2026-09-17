<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Field Notes') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=DM+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/pages.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="auth-page antialiased">
        <div class="top-strip"></div>
        @include('Blog.includes.navbar')

        <main class="auth-shell">
            <a class="auth-brand" href="{{ route('home') }}" aria-label="Field Notes home">
                <span class="auth-brand-mark"></span>
                <span>field notes</span>
            </a>

            <div class="auth-intro">
                <span class="auth-eyebrow">Field Notes community</span>
                <h1>{{ request()->routeIs('register') ? 'Make room for good things.' : 'Welcome back.' }}</h1>
                <p>{{ request()->routeIs('register') ? 'Create an account and keep your thoughtful reading in one place.' : 'Pick up where your curiosity left off.' }}</p>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>

            <a class="auth-home-link" href="{{ route('home') }}">Return to the journal <span>↗</span></a>
        </main>

        @include('Blog.includes.footer')
        @include('Blog.includes.script')
    </body>
</html>
