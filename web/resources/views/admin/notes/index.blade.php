<x-app-sidebar-layout title="Notes">

    <div class="p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-semibold text-slate-800">
                    Notes
                </h1>
                <p class="text-sm text-slate-500">
                    Manage notes
                </p>
            </div>

        </div>
            <form method="GET" action="{{ route('admin.notes.index') }}" class="mb-4">
                    <input name="q" value="{{ request('q') }}" placeholder="Search by note ID / user email / user name..."
                    class="w-full max-w-md rounded border px-3 py-2">
                </form>

        <div class="overflow-x-auto rounded border">
                <table class="w-full">
                    <thead class="bg-slate-700 text-slate-100">
                        <tr>
                            <th class="text-left p-3">ID</th>
                            <th class="text-left p-3">Title</th>
                            <th class="text-left p-3">User</th>
                            <th class="text-right p-3">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @forelse($notes as $note)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-4 py-3 text-sm font-medium text-slate-800">{{ $note->id }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $note->title }}</td>
                                <td class="px-4 py-3 text-sm text-slate-800">{{ $note->user->name }}</td>
                                <td class="p-3 text-right">
                                        <a href="{{ route('admin.notes.show', $note) }}" class="bg-emerald-600 text-white px-3 py-1 rounded
                                 hover:bg-emerald-800 transition-colors duration-200">Show</a>
                                        <a href="{{ route('admin.notes.edit', $note) }}" class="bg-blue-600 text-white px-3 py-1 rounded
                                 hover:bg-blue-800 transition-colors duration-200">Edit</a>
                                        <form class="inline"
                                        action="{{ route('admin.notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded
                                 hover:bg-red-900 transition-colors duration-200">Delete</button>
                                        </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-sky-200">
                                    No notes yet. Create your first one
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                </div>
            <div class="mt-6 flex justify-end">
                {{ $notes->links() }}
            </div>

</x-app-sidebar-layout>