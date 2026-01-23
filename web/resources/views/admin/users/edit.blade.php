<x-app-sidebar-layout title="Editar Utilizador">
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6">
                <h2 class="text-lg font-medium text-gray-900">Edit User</h2>
                <p class="mt-1 text-sm text-gray-600">
                    Update user information and permissions.
                </p>
            </div>

            <div class="bg-white shadow sm:rounded-lg">
                <div class="p-6 sm:p-8">

                    @if ($errors->any())
                        <div class="mb-4 rounded border border-red-200 bg-red-50 p-4 text-red-700">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   class="mt-1 block w-full max-w-xl text-gray-600 rounded-md border-gray-300 shadow-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   class="mt-1 block w-full max-w-xl text-gray-600 rounded-md border-gray-300 shadow-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                New Password
                                <span class="text-xs text-gray-500"></span>
                            </label>
                            <input type="password"
                                   name="password"
                                   class="mt-1 block w-full max-w-xl text-gray-600 rounded-md border-gray-300 shadow-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Confirm Password
                            </label>
                            <input type="password"
                                   name="password_confirmation"
                                   class="mt-1 block w-full max-w-xl text-gray-600 rounded-md border-gray-300 shadow-sm
                                          focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div class="flex items-center gap-2">
                            <input id="is_admin"
                                   name="is_admin"
                                   type="checkbox"
                                   value="1"
                                   class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                   {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                            <label for="is_admin" class="text-sm text-gray-700">
                                Administrator
                            </label>
                        </div>

                        <div class="flex items-center gap-3 pt-2">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent
                                           rounded-md font-semibold text-xs text-white uppercase tracking-widest
                                           hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900
                                           focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                                           transition">
                                Save
                            </button>

                            <a href="{{ route('admin.users.index') }}"
                               class="text-sm text-gray-600 hover:text-gray-900 underline underline-offset-4">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-sidebar-layout>