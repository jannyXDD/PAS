<x-app-sidebar-layout title="Notes">

    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900/30 p-4 text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif
          <div class="p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-slate-800">
                All notes
            </h1>
        </div>
            <a href="{{ route('notes.create') }}"
               class="px-4 py-2 bg-indigo-600 rounded hover:bg-indigo-700 text-white text-sm font-semibold transition shadow-sm">
                Create Note
            </a>
            </div>
                <form method="GET" action="{{ route('notes.index') }}" class="mb-4">
                    <input name="q" value="{{ request('q') }}" placeholder="Search by title..." 
                        class="w-full max-w-md rounded border px-3 py-2">
                </form>
            <p class="text-sm text-gray-400 mt-2"></p>
        {{-- Wrapper geral: grid scroll + botão fixo --}}
        <div class="flex flex-col h-[calc(100vh-170px)]">
            
        {{-- Área das notas (scroll vertical aqui) --}}
        <div class="flex-1 overflow-y-auto pr-2">
            <div class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm
            hover:shadow-md transition">
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                        
                        @forelse($notes as $note)
                            @if($note->is_pinned)
                                <a href="{{ route('notes.show', $note) }}" class="bg-white border-l-4 border-indigo-400 rounded-xl p-4 shadow-sm hover:shadow-md transition ">
                                <h3 class="text-lg text-slate-800  font-semibold mb-4 truncate flex items-center gap-2">
                                    <span title="Nota fixa">📌</span>
                                    @else
                                    <a href="{{ route('notes.show', $note) }}"
                                        class="bg-white border border-slate-200 rounded-xl p-4 shadow-sm
                                        hover:shadow-md transition ">
                                    <h3 class="text-lg text-slate-800 font-semibold mb-4 truncate flex items-center gap-2">
                                    @endif
                                    {{ $note->title }}
                                </h3>
                                <p class="text-slate-500 text-sm line-clamp-4 mb-6 break-words">
                                    {{ $note->content }}
                                </p>
   
                            </a>
                        @empty
                            <div class="col-span-full text-center text-sky-200 py-12">
                                No notes yet. Create your first one 🙂
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>


    </div>

</x-app-sidebar-layout>