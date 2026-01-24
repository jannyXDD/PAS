<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = $request->query('q');

        $notes = Note::query()
            ->where('user_id', Auth::id())
            ->when($q, function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('title', 'like', "%{$q}%");
                });
            })
            ->orderByDesc('is_pinned')
            ->latest()
            ->paginate(50)
            ->withQueryString();

        return view('notes.index', compact('notes', 'q'));
    }

    public function indexByFolder(Request $request, Folder $folder){
        $notes = $folder->notes()
        ->when($request->q, fn($q) => $q->where('title', 'like', '%'.$request->q.'%'))
        ->orderByDesc('is_pinned')
        ->latest()
        ->get();


        return view('notes.index', compact('notes', 'folder'));
        }

    public function adminIndex()
    {
        $notes = Note::latest()->paginate(50);
        return view('notes.admin', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $folders = Folder::orderBy('name')->get();
        return view('notes.create', compact('folders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'is_pinned' => 'nullable|boolean',
            'folder_id' => 'nullable|exists:folders,id'
        ]);

        $validated['is_pinned'] = $request->has('is_pinned');

        $request->user()->notes()->create($validated);

        return redirect()
        ->route('notes.index')
        ->with('success', 'Note created successfully.');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('notes.show', [
        'note' => $note,
        'folders' => $note->user->folders,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        return view('notes.edit', [
        'note' => $note,
        'folders' => $note->user->folders,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'is_pinned' => 'nullable|boolean',
            'folder_id' => 'nullable|exists:folders,id'
        ]);
        
        $validated['is_pinned'] = $request->has('is_pinned');

        $note->update($validated);

        return redirect()->route('notes.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note deleted successfully.');
    }
}
