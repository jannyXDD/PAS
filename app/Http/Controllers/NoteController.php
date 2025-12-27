<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $notes = \App\Models\Note::query()
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('notes.index', compact('notes'));
              
    }

    public function adminIndex()
    {
        $notes = Note::latest()->paginate(10);
        return view('notes.admin', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('notes.create');
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
            'is_urgent' => 'required'
        ]);


        $request->user()->notes()->create($validated);

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');       
        dd($request->all());
        

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

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
