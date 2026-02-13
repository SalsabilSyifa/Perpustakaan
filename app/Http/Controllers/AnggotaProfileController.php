<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AnggotaProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */

    public function create()
{
    return view('anggota.profile');
}

public function store(Request $request)
{
    $request->validate([
        'nama_anggota' => 'required',
        'alamat' => 'required',
        'no_hp' => 'required'
    ]);

 
    /** @var User $user */
    $user = Auth::user();

    if ($user->anggota) {
        return redirect()->route('dashboard');
    }

    $user->anggota()->create([
        'nama_anggota' => $request->nama_anggota,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp
    ]);

    return redirect()->route('dashboard');
}


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
