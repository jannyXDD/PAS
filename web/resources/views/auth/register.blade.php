<x-guest-layout>

    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-center">Notes100</h1>
    </div>
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" class="text-slate-300" />
            <x-text-input
                id="name"
                class="block mt-1 w-full bg-slate-700 border-slate-600 text-slate-100
                       focus:border-indigo-500 focus:ring-indigo-500"
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
            <x-input-label for="email" :value="__('Email')" class="text-slate-300" />
            <x-text-input
                id="email"
                class="block mt-1 w-full bg-slate-700 border-slate-600 text-slate-100
                       focus:border-indigo-500 focus:ring-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-slate-300" />
            <x-text-input
                id="password"
                class="mt-1 block w-full bg-slate-700 border-slate-600 text-slate-100 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-slate-300" />
            <x-text-input
                id="password_confirmation"
                class="mt-1 block w-full bg-slate-700 border-slate-600 text-slate-100 placeholder:text-slate-400 focus:border-indigo-500 focus:ring-indigo-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end gap-3 pt-2">
            <x-primary-button type="submit"
                class="w-full justify-center bg-indigo-600 hover:bg-indigo-500">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <div>
            <a class="text-sm text-slate-400 hover:text-indigo-400 transition text-decoration underline" href="{{ route('login') }}">
                {{ __('Already registered? Click here to login.') }}
            </a>
        </div>
    </form>
</x-guest-layout>