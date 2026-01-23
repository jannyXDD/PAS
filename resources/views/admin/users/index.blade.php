{{-- resources/views/admin/users/index.blade.php --}}
<x-app-sidebar-layout title="Users">
    <div class="p-6">
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-semibold text-slate-800">
            Users
        </h1>
        <p class="text-sm text-slate-500">
            Manage users
        </p>
    </div>

        <a href="{{ route('admin.users.create') }}"
        class="px-4 py-2 rounded bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold transition">
            New User
        </a>
    </div>
        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4">
            <input name="q" value="{{ request('q') }}" placeholder="Search by name/email..."
                   class="w-full max-w-md rounded border px-3 py-2">
        </form>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 rounded bg-red-100 text-red-800">{{ session('error') }}</div>
        @endif

        <div class="overflow-x-auto rounded border">
            <table class="w-full">
                <thead class="bg-slate-700 text-slate-100">
                    <tr>
                        <th class="text-left p-3">ID</th>
                        <th class="text-left p-3">Name</th>
                        <th class="text-left p-3">Email</th>
                        <th class="text-left p-3">Number of Notes</th>
                        <th class="text-left p-3">Admin</th>
                        <th class="text-right p-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-sm font-medium text-slate-600 ">{{ $user->id }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $user->name }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $user->email }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $user->notes_count }}</td>
                            <td class="px-4 py-3 text-sm font-semibold text-slate-800">{{ $user->is_admin ? 'Sim' : 'Não' }}</td>
                            <td class="p-3 text-right">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="bg-blue-600 text-white px-3 py-1 rounded
                                 hover:bg-blue-800 transition-colors duration-200">Edit</a>
                                <form class="inline"
                                      method="POST"
                                      action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-600 text-white px-3 py-1 rounded
                                 hover:bg-red-900 transition-colors duration-200">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-sidebar-layout>