<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'role' => $request->role
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Role berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->role == 'admin') {
            return back()->with('error', 'Admin tidak bisa dihapus!');
        }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }
}
