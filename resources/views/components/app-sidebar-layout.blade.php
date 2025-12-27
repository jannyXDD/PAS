@props(['title' => null])
@vite(['resources/css/app.css', 'resources/js/app.js'])
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    <div class="flex">

        <!-- SIDEBAR -->
        <aside class="w-64 shrink-0 min-h-screen bg-slate-950 text-slate-200">
            <!-- Logo / Title -->
            <div class="h-16 flex items-center px-6 border-b border-white/10">
                <span class="font-bold tracking-wide">Admin Pro</span>
            </div>

            
            <!-- Search -->
            <div class="px-4 py-4">
                <input
                    type="text"
                    placeholder="Search..."
                    class="w-full rounded-md bg-white/5 border border-white/10 px-3 py-2 text-sm
                           placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-sky-500"
                >
            </div>

            <!-- Nav -->
            <nav class="px-3 pb-6 space-y-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-md text-sm
                          hover:bg-white/5 transition
                          {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : '' }}">
                    <span>🏠</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('notes.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-md text-sm
                        hover:bg-white/5 transition
                        {{ request()->routeIs('notes.*') ? 'bg-white/10 text-white' : '' }}">
                    <span>📝</span>
                    <span>My Notes</span>
                </a>

                @if(auth()->check() && auth()->user()->is_admin)
                    <a href="{{ route('admin.notes.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-md text-sm
                            hover:bg-white/5 transition
                            {{ request()->routeIs('admin.notes.*') ? 'bg-white/10 text-white' : '' }}">
                        <span>🗂️</span>
                        <span>All Notes</span>
                    </a>
                @endif

                <!-- Exemplo de secção -->
                <div class="pt-4">
                    <p class="px-3 text-xs uppercase tracking-wider text-slate-400">Extras</p>

                    <a href="#"
                       class="mt-2 flex items-center gap-2 px-3 py-2 rounded-md text-sm hover:bg-white/5 transition">
                        <span>👥</span>
                        <span>Team</span>
                    </a>

                    <a href="#"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm hover:bg-white/5 transition">
                        <span>📁</span>
                        <span>Projects</span>
                    </a>

                    <a href="#"
                       class="flex items-center gap-2 px-3 py-2 rounded-md text-sm hover:bg-white/5 transition">
                        <span>📅</span>
                        <span>Calendar</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- CONTENT AREA -->
        <div class="flex-1 min-w-0">

            <!-- TOP BAR -->
            <header class="h-16 flex items-center justify-between px-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    @if($title)
                        <h1 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $title }}</h1>
                    @endif
                </div>

                <!-- TOP RIGHT: User dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-200 hover:opacity-90"
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