<x-app-sidebar-layout title="Ver Nota">

    <div class="p-6 max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold text-slate-900">
                    Show / Edit Note
                </h1>
                <p class="text-sm text-slate-500">
                    Edit the note and save changes
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('notes.index') }}"
                   class="px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition">
                    Back
                </a>

                {{-- Delete --}}
                <button type="submit"
                        form="delete-note-{{ $note->id }}"
                        class="px-4 py-2 rounded-lg bg-red-600 text-white hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>

        {{-- Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Form --}}
            <form action="{{ route('notes.update', $note) }}"
                  method="POST"
                  class="lg:col-span-2 bg-white border border-slate-200 rounded-xl shadow-sm">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-6">
                    {{-- Folder --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Pasta
                        </label>

                        <select name="folder_id"
                            class="w-full rounded-lg text-gray-600 border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">— No folder —</option>

                            @foreach($folders as $folder)
                                <option value="{{ $folder->id }}"
                                    {{ old('folder_id', $note->folder_id) == $folder->id ? 'selected' : '' }}>
                                    {{ $folder->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- Title --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Title
                        </label>
                        <input type="text"
                               name="title"
                               value="{{ old('title', $note->title) }}"
                               class="w-full rounded-lg text-gray-600 border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Content --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            Content
                        </label>
                        <textarea name="content"
                                  rows="8"
                                  class="w-full rounded-lg text-gray-600 border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $note->content) }}</textarea>
                    </div>

                    {{-- Pin --}}
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox"
                               name="is_pinned"
                               value="1"
                               {{ $note->is_pinned ? 'checked' : '' }}
                               class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                        <span class="text-sm text-slate-700">
                            Pin note 📌
                        </span>
                    </label>

                </div>

                {{-- Footer --}}
                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end rounded-b-xl">
                    <button type="submit"
                            class="px-6 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Save changes
                    </button>
                </div>
            </form>

            {{-- Details --}}
            <div class="bg-slate-100 border border-slate-200 rounded-xl shadow-sm h-fit">
                <div class="p-6 space-y-4">
                    <h2 class="text-sm font-semibold text-slate-700 uppercase tracking-wide">
                        Details
                    </h2>

                    <div class="text-sm text-slate-600">
                        <p class="font-medium text-slate-700">Created at</p>
                        <p>{{ $note->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="text-sm text-slate-600">
                        <p class="font-medium text-slate-700">Last edited</p>
                        <p>{{ $note->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- FORM DELETE --}}
    <form id="delete-note-{{ $note->id }}"
          action="{{ route('notes.destroy', $note) }}"
          method="POST"
          onsubmit="return confirm('Are you sure you want to delete this note?');"
          class="hidden">
        @csrf
        @method('DELETE')
    </form>

</x-app-sidebar-layout>