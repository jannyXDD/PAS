@props(['title' => null])
@vite(['resources/css/app.css', 'resources/js/app.js'])
@php
$folders = auth()->check() ? auth()->user()->folders()->orderBy('name')->get() : collect();
@endphp

<div class="min-h-screen bg-slate-50">
    <div class="flex">

        <!-- SIDEBAR -->
        <aside class="fixed left-0 top-0 h-screen w-80 bg-slate-800 text-slate-100">
            <!-- Logo / Title -->
            <div class="h-16 bg-slate-800 text-slate-100 flex items-center px-6 border-b border-white/10">
                <span class="font-bold tracking-wide text-xl">Notes100</span>
            </div>

            
            <!-- Search -->
            <div class="pt-4 px-3">
                <p class="px-3 text-sm uppercase tracking-wider text-slate-400">My Area</p>
            </div>

            <!-- Nav -->
            <nav class="relative z-30 px-3 pb-6 space-y-1">

                <!-- MY NOTES -->
                <a href="{{ route('notes.index') }}"
                class="mt-2 flex items-center gap-2 px-3 py-2 rounded-md text-s hover:bg-white/5 transition
                {{ request()->routeIs('notes.index') ? 'bg-white/10 text-white' : 'text-white/80' }}">
                    <span>📝</span>
                    <span>My Notes</span>
                </a>
                <!-- FOLDERS -->
                <div class="pt-4">
                    <div class="flex items-center justify-between px-3">
                        <p class="text-sm uppercase tracking-wider text-slate-400">
                            Folders
                        </p>

                        <button
                            type="button"
                            class="inline-flex h-7 w-7 items-center justify-center rounded-md
                                bg-white/10 hover:bg-white/20 transition"
                            onclick="document.getElementById('newFolderForm').classList.toggle('hidden')"
                            title="Create Folder"
                        >
                            +
                        </button>
                    </div>

                    <!-- FORM CREATE FOLDER -->
                    <div id="newFolderForm" class="hidden px-3 mt-3">
                        <form method="POST" action="{{ route('folders.store') }}" class="flex gap-2">
                            @csrf

                            <input
                                type="text"
                                name="name"
                                placeholder="Nome da folder"
                                class="w-full rounded-md bg-white/5 border border-white/10
                                    px-3 py-2 text-sm text-white
                                    placeholder:text-white/40
                                    focus:outline-none focus:ring-2 focus:ring-white/20"
                                maxlength="50"
                                required
                            >

                            <button
                                type="submit"
                                class="rounded-md bg-white/10 px-3 py-2 text-sm
                                    text-white hover:bg-white/20 transition"
                            >
                                Criar
                            </button>
                        </form>

                        @error('name')
                            <p class="mt-2 text-xs text-red-400">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- LIST OF FOLDERS -->
                    <div class="mt-3 space-y-1">
                        @forelse($folders as $folder)
                        <a href="{{ route('notes.byFolder', $folder) }}"
                        class="flex items-center gap-2 px-3 py-2 rounded-md text-s hover:bg-white/5 transition
                            {{ request()->routeIs('notes.byFolder') && request()->route('folder')?->id === $folder->id
                            ? 'bg-white/10 text-white'
                            : 'text-white/80' }}">
                            <span>📁</span>
                            <span class="truncate">{{ $folder->name }}</span>
                        </a>
                        @empty
                            <p class="px-3 py-2 text-sm text-white/50">
                                No folders yet
                            </p>
                        @endforelse
                    </div>
                </div>

                <!-- ADMIN AREA -->
                @if(auth()->check() && auth()->user()->is_admin)
                    <div class="pt-6">
                        <p class="px-3 text-sm uppercase tracking-wider text-slate-400">
                            Admin Area
                        </p>

                        <a href="{{ route('admin.users.index') }}"
                        class="mt-2 flex items-center gap-2 px-3 py-2 rounded-md text-s
                                hover:bg-white/5 transition
                                {{ request()->routeIs('admin.users.*') ? 'bg-white/10 text-white' : '' }}">
                            <span>👥</span>
                            <span>Users</span>
                        </a>

                        <a href="{{ route('admin.notes.index') }}"
                        class="mt-2 flex items-center gap-2 px-3 py-2 rounded-md text-s
                                hover:bg-white/5 transition
                                {{ request()->routeIs('admin.notes.*') ? 'bg-white/10 text-white' : '' }}">
                            <span>🗂️</span>
                            <span>All Notes</span>
                        </a>
                    </div>
                @endif
            </nav>
        </aside>

        <!-- CONTENT AREA -->
        <div class="ml-80 min-h-screen flex-1 flex flex-col">

            <!-- TOP BAR -->
            <header class="h-16 flex items-center justify-between px-6 bg-slate-700 text-white divide-y divide-white/10">
                <div class="flex items-center gap-3">
                    @if($title)
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $title }}</h1>
                    @endif
                </div>

                <!-- TOP RIGHT: User dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center text-sm font-medium text-gray-300 hover:text-white "
                    >
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.24a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div
                        x-show="open"
                        @click.outside="open = false"
                        x-transition
                        class="absolute right-0 mt-2 w-48 rounded-md border border-gray-200 dark:border-gray-700
                            bg-white dark:bg-gray-800 shadow-lg overflow-hidden z-50"
                    >
                        <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="p-6">
                {{ $slot }}
            </main>

        </div>
    </div>
</div>