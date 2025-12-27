{{-- resources/views/notes/show.blade.php --}}

<x-app-sidebar-layout title="Ver Nota">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- CARD PRINCIPAL (titulo + conteúdo) --}}
            <div class="lg:col-span-8">
                <div class="bg-slate-900/60 border border-white/10 rounded-xl p-6 shadow">
                    <div class="flex items-start justify-between gap-4">
                        <h2 class="text-2xl font-semibold text-white">
                            {{ $note->title }}
                        </h2>

                        {{-- botões opcionais --}}
                        <div class="flex gap-2">
                            <a href="{{ route('notes.edit', $note) }}"
                               class="px-3 py-2 text-sm rounded-md bg-white/10 text-white hover:bg-white/15">
                                Editar
                            </a>

                            <a href="{{ route('notes.index') }}"
                               class="px-3 py-2 text-sm rounded-md bg-white/10 text-white hover:bg-white/15">
                                Voltar
                            </a>
                        </div>
                    </div>

                    <div class="mt-4 text-slate-200 leading-relaxed whitespace-pre-line">
                        {{ $note->content }}
                    </div>
                </div>
            </div>

            {{-- CARD DIREITA (datas) --}}
            <div class="lg:col-span-4">
                <div class="bg-slate-900/60 border border-white/10 rounded-xl p-6 shadow">
                    <h3 class="text-sm font-semibold text-slate-200 uppercase tracking-wider">
                        Detalhes
                    </h3>

                    <dl class="mt-4 space-y-4">
                        <div>
                            <dt class="text-xs text-slate-400">Criada em</dt>
                            <dd class="text-sm text-white mt-1">
                                {{ $note->created_at?->format('d/m/Y H:i') }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-xs text-slate-400">Última edição</dt>
                            <dd class="text-sm text-white mt-1">
                                {{ $note->updated_at?->format('d/m/Y H:i') }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

        </div>
    </div>
</x-app-sidebar-layout>