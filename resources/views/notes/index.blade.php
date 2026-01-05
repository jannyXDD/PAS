<x-app-sidebar-layout title="Notes">

    @if (session('success'))
        <div class="mb-4 rounded-md bg-green-50 dark:bg-green-900/30 p-4 text-green-800 dark:text-green-200">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Notes
        </h2>

        <a href="{{ route('notes.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 dark:bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 dark:hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition">
            Create Note
        </a>
    </div>

    <!-- A tua tabela cyan -->
    <div class="bg-sky-900/80 overflow-hidden shadow-sm rounded-lg">
        <div class="p-6 overflow-x-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @forelse($notes as $note)
                    <a href="{{ route('notes.show', $note) }}"
                         class="bg-sky-900/60 border border-white/10 rounded-xl p-5 shadow hover:shadow-lg transition">
                        
                        <!-- Título -->
                        <h3 class="text-lg font-semibold text-white mb-4 truncate">
                            {{ $note->title }}
                        </h3>
                        <p class="text-gray-400 line-clamp-4 mb-6 break-words">
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

</x-app-sidebar-layout>