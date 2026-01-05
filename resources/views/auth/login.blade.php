<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-emerald-300" :status="session('status')" />

    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Welcome back</h1>
        <p class="text-sm text-slate-300 mt-1">Sign in to continue</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" class="text-slate-300" />
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-white/5 border-white/10 text-slate-100
                       focus:border-sky-500 focus:ring-sky-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" class="text-slate-300" />
            <x-text-input
                id="password"
                class="block mt-1 w-full bg-white/5 border-white/10 text-slate-100
                       focus:border-sky-500 focus:ring-sky-500"
                type="password"
                name="password"
                required
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2 text-slate-300">
                <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/10">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sky-300 hover:text-sky-200">
                    Forgot password?
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-500">
            Log in
        </x-primary-button>
    </form>
</x-guest-layout>