<x-app-layout>
    @php($title = 'Login | Game Hub')

    <section class="mx-auto max-w-md px-4 py-16 sm:px-6 lg:px-8">
        <div class="rounded-3xl border border-slate-800 bg-slate-900 p-8">
            <h1 class="text-3xl font-black text-white">Welcome back</h1>
            <p class="mt-2 text-sm text-slate-400">Continue your arcade journey.</p>

            <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Email</label>
                    <input type="email" name="email" required class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none" />
                </div>
                <div>
                    <label class="mb-2 block text-sm text-slate-300">Password</label>
                    <input type="password" name="password" required class="w-full rounded-xl border border-slate-700 bg-slate-950 px-4 py-3 text-white placeholder:text-slate-500 focus:border-cyan-400 focus:outline-none" />
                </div>
                <button type="submit" class="w-full rounded-full bg-cyan-500 px-5 py-3 font-semibold text-slate-950 hover:bg-cyan-400">Login</button>
            </form>
        </div>
    </section>
</x-app-layout>
