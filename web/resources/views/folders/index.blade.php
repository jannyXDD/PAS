<x-app-sidebar-layout title="Folders">

    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900/30 p-4 text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="p-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-semibold text-slate-800">
                All folders
            </h1>

            <a href="{{ route('folders.create') }}"
               class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700 text-white text-sm font-semibold transition shadow-sm">
                Create Folder
            </a>
        </div>

        {{-- Search (opcional) --}}
        <form method="GET" action="{{ route('folders.index') }}" class="mb-4">
            <input name="q"
                   value="{{ request('q') }}"
                   placeholder="Search by folder name..."
                   class="w-full max-w-md rounded border px-3 py-2">
        </form>

        {{-- Wrapper --}}
        <div class="flex flex-col h-[calc(100vh-170px)]">

            {{-- Content --}}
            <div class="flex-1 overflow-y-auto pr-2">
                <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm hover:shadow-md transition">
                    <div class="p-6">

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">

                            @forelse($folders as $folder)
                                <a href="{{ route('notes.byFolder', $folder) }}"
                                class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm
                                hover:shadow-md transition flex flex-col justify-between">

                                    {{-- Folder title --}}
                                    <h3 class="text-lg text-slate-800 font-semibold mb-2 truncate flex items-center gap-2">
                                        📁 {{ $folder->name }}
                                    </h3>

                                    {{-- Extra info --}}
                                    <p class="text-sm text-slate-500">
                                        {{ $folder->notes_count ?? $folder->notes->count() }}
                                        {{ Str::plural('note', $folder->notes_count ?? $folder->notes->count()) }}
                                    </p>
                                </a>
                            @empty
                                <div class="col-span-full text-center text-slate-400 py-12">
                                    No folders yet. Create your first one 📂
                                </div>
                            @endforelse

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

</x-app-sidebar-layout>