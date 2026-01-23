<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Mostrar TODAS as notas (de todos os utilizadores)
     */
    public function index(Request $request)
    {
        $q = $request->input('q');

        $userId = $request->query('user_id');
        
        $notes = Note::query()
            ->with('user')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {

                    $sub->where('title', 'like', "%{$q}%");
                    if (ctype_digit($q)) {
                        $sub->orWhere('id', (int) $q);
                    }
                    $sub->orWhereHas('user', function ($user) use ($q) {
                        $user->where('name', 'like', "%{$q}%")
                            ->orWhere('email', 'like', "%{$q}%");
                    });
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.notes.index', compact('notes'));
    }

    public function notes(\App\Models\User $user)
    {
        $notes = $user->notes()->latest()->paginate(20);
        return view('admin.users.notes', compact('user', 'notes'));
    }

    public function show(Note $note)
    {
        $note->load('user');
        return view('admin.notes.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('admin.notes.edit', compact('note'));
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('admin.notes.index')->with('success', 'Note deleted successfully.');
    }
}