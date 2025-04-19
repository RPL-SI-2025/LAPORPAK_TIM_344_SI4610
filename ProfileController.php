<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function show() {
        if (Auth::check()) {
            return view ('profile');
        } else {
            return redirect('/login');
        }
     }

    public function edit(Request $request): View
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Perbarui informasi profil pengguna.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        // Perbarui data pengguna dengan data yang ada pada request
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Jika password baru diisi, enkripsi dan perbarui password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman profil dengan pesan sukses
        return redirect()->route('profile.show')->with('success', 'Profile berhasil diperbarui.');
    }

    /**
     * Hapus akun pengguna.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validasi untuk memastikan pengguna memasukkan password yang benar sebelum menghapus akun
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Ambil pengguna yang sedang login
        $user = $request->user();

        // Logout pengguna
        Auth::logout();

        // Hapus akun pengguna
        $user->delete();

        // Hapus sesi dan regenerasi token CSRF untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman utama setelah penghapusan akun
        return Redirect::to('/');
    }
}
