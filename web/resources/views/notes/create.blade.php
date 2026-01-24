<x-app-sidebar-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Criar Nota</h1>
                <p class="text-sm text-gray-500">Cria uma nova nota</p>
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                {{-- Form --}}
                <form action="{{ route('notes.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    {{-- Pasta --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Pasta
                        </label>

                        <select name="folder_id"
                            class="w-full rounded-md text-gray-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">— Sem pasta —</option>

                            @foreach($folders as $folder)
                                <option value="{{ $folder->id }}"
                                    {{ old('folder_id') == $folder->id ? 'selected' : '' }}>
                                    {{ $folder->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Título --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full rounded-md text-gray-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Conteúdo --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Conteúdo</label>
                        <textarea name="content" rows="6"
                            class="w-full rounded-md text-gray-600 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('content') }}</textarea>
                    </div>

                    {{-- Fixar --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_pinned" value="1"
                            {{ old('is_pinned') ? 'checked' : '' }}
                            class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label class="text-sm text-gray-700">Fixar nota 📌</label>
                    </div>

                    {{-- Form actions --}}
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('notes.index') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            Criar Nota
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-sidebar-layout>