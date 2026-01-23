<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $q = $request->input('q');

        $users = User::query()
        ->withCount('notes')
        ->when ($q, function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                         ->orWhere('email', 'like', "%{$q}%")
                         ->orWhere('id', $q);
        })
        ->orderBy('name')
        ->paginate(10)
        ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

       public function notes(User $user)
    {
        $notes = $user->notes()->latest()->paginate(20);

        return view('admin.users.notes', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'is_admin' => 'nullable'
        ]);

        $request->user()->create($validated);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');       
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable|confirmed|min:8',
            'is_admin' => 'nullable'
        ]);
            $validated['is_admin'] = $request->has('is_admin');

            if ($request->filled('password')) {
                $validated['password'] = Hash::make($request->password);
            } else {
                unset($validated['password']); // <- isto evita gravar null
            }
        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
