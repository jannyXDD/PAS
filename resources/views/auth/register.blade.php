<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-200" />
            <x-text-input
                id="name"
                class="mt-1 block w-full bg-white/5 border-white/10 text-slate-100 placeholder:text-slate-400 focus:border-sky-500 focus:ring-sky-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-slate-200" />
            <x-text-input
                id="email"
                class="mt-1 block w-full bg-white/5 border-white/10 text-slate-100 placeholder:text-slate-400 focus:border-sky-500 focus:ring-sky-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-200" />
            <x-text-input
                id="password"
                class="mt-1 block w-full bg-white/5 border-white/10 text-slate-100 placeholder:text-slate-400 focus:border-sky-500 focus:ring-sky-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-200" />
            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full bg-white/5 border-white/10 text-slate-100 placeholder:text-slate-400 focus:border-sky-500 focus:ring-sky-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <a class="text-sm text-slate-300 hover:text-white transition" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit"
                class="inline-flex items-center px-5 py-2 rounded-md bg-sky-600 text-white font-semibold hover:bg-sky-500 transition">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>