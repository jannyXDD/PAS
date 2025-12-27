<x-app-sidebar-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Create Note
            </h2>

            <a href="{{ route('notes.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-700 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-4">

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="rounded-md bg-red-50 dark:bg-red-900/30 p-4 text-red-800 dark:text-red-200">
                    <p class="font-semibold mb-2">Há erros no formulário:</p>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- FORM CARD --}}
            <div class="bg-sky-900/80 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('notes.store') }}" method="POST" class="space-y-6">
                        @csrf

                        {{-- TITLE --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-sky-100">
                                Title
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title') }}"
                                class="w-full rounded-md border border-white/10 bg-sky-800/50 text-white placeholder:text-sky-200
                                       focus:border-sky-300 focus:ring-sky-300"
                                placeholder="Ex: Reunião, ideias, lembretes..."
                            />

                            @error('title')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CONTENT --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-sky-100">
                                Content
                            </label>

                            <textarea
                                name="content"
                                rows="6"
                                class="w-full rounded-md border border-white/10 bg-sky-800/50 text-white placeholder:text-sky-200
                                       focus:border-sky-300 focus:ring-sky-300"
                                placeholder="Escreve aqui a tua nota..."
                            >{{ old('content') }}</textarea>

                            @error('content')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- IS URGENT --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-slate-200">
                                Is urgent?
                            </label>

                            <div class="inline-flex rounded-lg bg-slate-900/40 p-1 border border-white/10 gap-1">
                                {{-- NORMAL --}}
                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="is_urgent"
                                        value="0"
                                        class="peer sr-only"
                                        {{ old('is_urgent', '0') == '0' ? 'checked' : '' }}
                                    >
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold
                                               text-slate-200 hover:bg-white/5
                                               peer-checked:bg-sky-700 peer-checked:text-white peer-checked:border peer-checked:border-sky-400">
                                        Normal
                                    </span>
                                </label>

                                {{-- URGENT --}}
                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        name="is_urgent"
                                        value="1"
                                        class="peer sr-only"
                                        {{ old('is_urgent') == '1' ? 'checked' : '' }}
                                    >
                                    <span
                                        class="inline-flex items-center px-4 py-2 rounded-md text-sm font-semibold
                                               text-slate-200 hover:bg-white/5
                                               peer-checked:bg-red-600 peer-checked:text-white peer-checked:border peer-checked:border-red-400">
                                        Urgent
                                    </span>
                                </label>
                            </div>

                            @error('is_urgent')
                                <p class="text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ACTIONS --}}
                        <div class="flex justify-end gap-3 pt-2">
                            <a href="{{ route('notes.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-700 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                                Cancel
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
                                Save Note
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
</x-app-sidebar-layout>