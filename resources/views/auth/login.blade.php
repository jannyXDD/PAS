<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-emerald-300" :status="session('status')" />

    <div class="mb-6">
        <h1 class="text-2xl text-slate-100 font-semibold text-center ">Notes100</h1>
         <!-- <p class="text-sm text-slate-300 mt-1">Login</p> -->
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" class="text-slate-300" />
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-slate-700 border-slate-600 text-slate-100
                       focus:border-indigo-500 focus:ring-indigo-500"
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
                class="block mt-1 w-full bg-slate-700 border-slate-600 text-slate-100
                       focus:border-indigo-500 focus:ring-indigo-500"
                type="password"
                name="password"
                required
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between text-sm">
            <label class="inline-flex items-center gap-2 text-slate-100">
                <input type="checkbox" name="remember" class="accent-indigo-500 rounded bg-white/5 border-white/10
                       focus:ring-2 focus:ring-sky-500">
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-white-300 hover:text-sky-200">
                    Forgot password?
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center bg-indigo-600 hover:bg-indigo-500">
            Log in
        </x-primary-button>
    </form>
        <div class="flex items-center justify-between text-sm">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-slate-400 hover:text-indigo-400 text-decoration underline">
                    Don't have an account? Click here to register.
                </a>
            @endif
        </div>

</x-guest-layout>