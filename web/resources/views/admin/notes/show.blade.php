<x-app-sidebar-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-800">View Note (Admin)</h1>
                    <p class="text-sm text-gray-500">Read-only</p>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('admin.notes.index') }}"
                       class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                        Back
                    </a>

                    <a href="{{ route('admin.notes.edit', $note) }}"
                       class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Edit
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 px-6 py-4 space-y-3">
                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">Title</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $note->title }}</p>
                </div>

                <div>
                    <p class="text-xs uppercase tracking-wider text-gray-400">Content</p>

                    <div class="mt-2 text-gray-700 whitespace-pre-wrap leading-relaxed">{{ $note->content }}</div>
                </div>

                <div class="flex items-center gap-2 pt-2">
                    @if($note->is_pinned)
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-rose-100 text-rose-700">
                            📌 Pinned
                        </span>
                    @else
                        <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-semibold bg-gray-100 text-gray-600">
                            Normal
                        </span>
                    @endif
                </div>

                <div class="pt-4 border-t border-gray-100 text-sm text-gray-500">
                    <span>Created at: {{ $note->created_at->format('d/m/Y H:i') }}</span>
                    <span class="mx-2">•</span>
                    <span>Last edited: {{ $note->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>

        </div>
    </div>
</x-app-sidebar-layout>