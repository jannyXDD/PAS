<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;


class FolderController extends Controller
{

    public function index(Request $request)
        {
            $folders = Folder::withCount('notes')
                ->when($request->q, function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->q . '%');
                })
                ->orderBy('name')
                ->get();

            return view('folders.index', compact('folders'));
        }
      public function store(Request $request)
        {
            $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $request->user()->folders()->create($validated);


        return back()->with('success', 'Folder criada com sucesso!');
        }

        public function show(Folder $folder)
        {
            return redirect()->route('notes.byFolder', $folder);
        }
}
