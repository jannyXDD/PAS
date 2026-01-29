<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $folders = Folder::where('user_id', $request->user()->id)
            ->orderBy('name')
            ->get();
        return response()->json($folders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
        'name' => 'required|string|max:255',
        ]);


        $folder = Folder::create([
        'name' => $data['name'],
        'user_id' => $request->user()->id,
        ]);


        return response()->json($folder, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $data = $request->validate([
        'name' => 'required|string|max:255',
        ]);

        $folder = Folder::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $folder->update(['name' => $data['name']]);

        return response()->json($folder, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)    {
         $folder = Folder::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->firstOrFail();

        $folder->delete();

        return response()->json(['message' => 'Folder deleted'], 200);
    }
}
