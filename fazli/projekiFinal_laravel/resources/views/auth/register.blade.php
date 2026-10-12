<x-app-layout>
    @php($title = 'Join PlayForge')

    <section class="mx-auto grid max-w-5xl gap-10 px-5 py-12 sm:px-8 sm:py-16 lg:grid-cols-[0.9fr_1.1fr] lg:items-center lg:px-10">
        <div class="max-w-md">
            <p class="eyebrow">A place for your high scores</p>
            <h1 class="mt-4 font-serif text-4xl leading-tight text-[var(--ink)] sm:text-5xl">Make yourself at home.</h1>
            <p class="mt-4 leading-7 text-[var(--ink-muted)]">Keep a few favorites close and save the scores you’re proud of. It only takes a moment to join.</p>
        </div>
        <div class="glass-panel auth-panel">
            <h2 class="font-serif text-2xl text-[var(--ink)]">Join the arcade</h2>
            <p class="mt-2 text-sm text-[var(--ink-muted)]">Your next good break starts here.</p>

            <form method="POST" action="{{ route('register') }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label for="register-name" class="form-label">Name</label>
                    <input id="register-name" type="text" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus class="field" />
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="register-email" class="form-label">Email</label>
                    <input id="register-email" type="email" name="email" value="{{ old('email') }}" autocomplete="email" required class="field" />
                    @error('email')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="register-password" class="form-label">Password</label>
                    <input id="register-password" type="password" name="password" autocomplete="new-password" required class="field" />
                    @error('password')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="register-password-confirmation" class="form-label">Confirm password</label>
                    <input id="register-password-confirmation" type="password" name="password_confirmation" autocomplete="new-password" required class="field" />
                </div>
                <button type="submit" class="btn-primary w-full">Create account</button>
            </form>
            <p class="mt-5 border-t border-[var(--line)] pt-4 text-sm text-[var(--ink-muted)]">Already have an account? <a href="{{ route('login') }}" class="font-semibold text-[var(--accent-strong)] underline decoration-[var(--line)] underline-offset-4 hover:decoration-[var(--clay)]">Log in</a></p>
        </div>
    </section>
</x-app-layout>
