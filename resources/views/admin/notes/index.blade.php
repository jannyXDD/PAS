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

            <table class="min-w-full divide-y divide-white/10">
                <thead class="bg-sky-950/70">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-sky-100 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-sky-100 uppercase tracking-wider">Title</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-sky-100 uppercase tracking-wider">User</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-sky-100 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-sky-800/30 divide-y divide-white/10">
                    @forelse($notes as $note)
                        <tr class="hover:bg-sky-800/40 transition">
                            <td class="px-4 py-3 text-sm font-semibold text-sky-50">{{ $note->id }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-white">{{ $note->title }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-white">{{ $note->user->name }}</td>
                            <td class="px-4 py-3">
                                <div class="flex justify-end gap-3 text-sm">
                                    <a href="{{ route('notes.show', $note) }}" class="text-indigo-300 hover:underline">Show</a>
                                    <a href="{{ route('notes.edit', $note) }}" class="text-sky-100 hover:underline">Edit</a>

                                    <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:underline">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-10 text-center text-sky-200">
                                No notes yet. Create your first one 🙂
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</x-app-sidebar-layout>