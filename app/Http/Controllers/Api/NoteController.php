<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $notes = Note::where('user_id', $request->user()->id)
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($notes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $user = $request->user();
           if (!$user) {
                return response()->json(['message' => 'Unauthenticated'], 401);
            }

            $data = $request->validate([
                'title' => ['required', 'string', 'max:255'],
                'content' => ['nullable', 'string'],
                'is_pinned' => ['boolean'],
         ]);

            $note = Note::create([
            'user_id' => $user->id,
            'title' => $data['title'],
            'content' => $data['content'] ?? null,
            'is_pinned' => $data['is_pinned'] ?? false,
         ]);

    return response()->json($note, 201);
    }

    /**
     * Display the specified resource.
     */
        public function show(Request $request, Note $note)
     {
        // garante que só o dono vê
        if ($note->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        return response()->json($note, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        $data = $request->validate([
            'title'     => ['sometimes', 'required', 'string', 'max:255'],
            'content'   => ['nullable', 'string'],
            'is_pinned' => ['sometimes', 'boolean'],
        ]);

        $note->update($data);

        return response()->json($note, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Request $request, Note $note)
    {
        if ($note->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Nota não encontrada'], 404);
        }

        $note->delete();

        return response()->json(['message' => 'Nota apagada'], 200);
    }
}