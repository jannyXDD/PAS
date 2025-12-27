<x-app-sidebar-layout title="Edit Note">
    <div class="min-h-[calc(100vh-8rem)] flex items-center justify-center">
        <div class="w-full max-w-3xl bg-slate-900/40 border border-white/10 rounded-2xl p-8 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-slate-100">Edit Note</h2>

                <a href="{{ route('notes.index') }}"
                   class="text-sm text-slate-300 hover:text-white transition">
                    ← Back to notes
                </a>
            </div>

            <form method="POST" action="{{ route('notes.update', $note) }}" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- TITLE --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Title</label>
                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $note->title) }}"
                        placeholder="Ex: Reunião, ideias, lembretes..."
                        class="w-full rounded-md bg-white/5 border border-white/10 px-4 py-3 text-slate-100
                               placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500"
                    >
                    @error('title')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- CONTENT --}}
                <div>
                    <label class="block text-sm font-medium text-slate-200 mb-2">Content</label>
                    <textarea
                        name="content"
                        rows="8"
                        placeholder="Escreve aqui a tua nota..."
                        class="w-full rounded-md bg-white/5 border border-white/10 px-4 py-3 text-slate-100
                               placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500"
                    >{{ old('content', $note->content) }}</textarea>

                    @error('content')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- URGENCY (FIXED) --}}
                <div class="mt-6">
                    <p class="text-sm font-medium text-slate-200 mb-2">Is urgent?</p>

                    <div class="inline-flex w-fit overflow-hidden rounded-lg border border-white/10 bg-white/5">
                        {{-- Normal --}}
                        <label class="relative cursor-pointer select-none">
                            <input
                                type="radio"
                                name="is_urgent"
                                value="0"
                                class="peer sr-only"
                                {{ old('is_urgent', (int) $note->is_urgent) === 0 ? 'checked' : '' }}
                            >
                            <span class="block px-6 py-2 text-sm font-semibold text-center text-slate-200
                                         hover:bg-white/10 transition
                                         peer-checked:bg-sky-600 peer-checked:text-white">
                                Normal
                            </span>
                        </label>

                        {{-- Urgent --}}
                        <label class="relative cursor-pointer select-none">
                            <input
                                type="radio"
                                name="is_urgent"
                                value="1"
                                class="peer sr-only"
                                {{ old('is_urgent', (int) $note->is_urgent) === 1 ? 'checked' : '' }}
                            >
                            <span class="block px-6 py-2 text-sm font-semibold text-center text-slate-200
                                         hover:bg-white/10 transition
                                         peer-checked:bg-red-600 peer-checked:text-white">
                                Urgent
                            </span>
                        </label>
                    </div>

                    @error('is_urgent')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center justify-end gap-3 pt-4">
                    <a href="{{ route('notes.index') }}"
                       class="inline-flex items-center px-5 py-2 rounded-md bg-white/10 text-slate-200
                              hover:bg-white/15 transition">
                        Cancel
                    </a>

                    <button type="submit"
                            class="inline-flex items-center px-5 py-2 rounded-md bg-indigo-600 text-white
                                   hover:bg-indigo-500 transition font-semibold">
                        Update Note
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-sidebar-layout>