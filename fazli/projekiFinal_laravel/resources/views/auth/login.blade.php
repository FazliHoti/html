<x-app-layout>
    @php($title = 'Log in | PlayForge')

    <section class="mx-auto grid max-w-5xl gap-10 px-5 py-12 sm:px-8 sm:py-16 lg:grid-cols-[0.9fr_1.1fr] lg:items-center lg:px-10">
        <div class="max-w-md">
            <p class="eyebrow">Pick up where you left off</p>
            <h1 class="mt-4 font-serif text-4xl leading-tight text-[var(--ink)] sm:text-5xl">Your next round is just around the corner.</h1>
            <p class="mt-4 leading-7 text-[var(--ink-muted)]">Sign in to keep your favorite games close and your best scores in view.</p>
        </div>
        <div class="glass-panel auth-panel">
            <h2 class="font-serif text-2xl text-[var(--ink)]">Welcome back</h2>
            <p class="mt-2 text-sm text-[var(--ink-muted)]">Good to have you here.</p>

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label for="login-email" class="form-label">Email</label>
                    <input id="login-email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required autofocus class="field" />
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="login-password" class="form-label">Password</label>
                    <input id="login-password" type="password" name="password" autocomplete="current-password" required class="field" />
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn-primary w-full">Log in</button>
            </form>
            <p class="mt-5 border-t border-[var(--line)] pt-4 text-sm text-[var(--ink-muted)]">New around here? <a href="{{ route('register') }}" class="font-semibold text-[var(--accent-strong)] underline decoration-[var(--line)] underline-offset-4 hover:decoration-[var(--clay)]">Make an account</a></p>
        </div>
    </section>
</x-app-layout>
