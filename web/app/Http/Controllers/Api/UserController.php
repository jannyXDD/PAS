<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function me(Request $request)
    {
        return response()->json($request->user());
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        // mudar password só se vier current_password
        if ($request->filled('current_password')) {

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'Password atual incorreta'
                ], 422);
            }

            $request->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);

            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return response()->json($user);
    }
}