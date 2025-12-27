<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNoteController extends Controller
{
    /**
     * Mostrar TODAS as notas (de todos os utilizadores)
     */
    public function index(Request $request)
    {
        $userId = $request->query('user_id');

        $notes = Note::query()
            ->with('user')
            ->latest()
            ->paginate(10);

        return view('admin.notes.index', compact('notes'));
    }

}