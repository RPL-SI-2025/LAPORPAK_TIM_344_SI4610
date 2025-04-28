<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    // Tampilkan halaman profil
    public function show(): View
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    // Form untuk edit profil
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    // Handle update profil
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        // Ambil data yang tervalidasi
        $data = $request->validated();

        // Cek apakah password diubah
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        // Simpan perubahan data user
        $user->update($data);

        return redirect()->route('profile.show')->with('status', 'profile-updated');
    }

    // Hapus akun user
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
