@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Edit Profil</h2>

    @if(session('status') === 'profile-updated')
        <div class="mb-4 text-green-600">
            Profil berhasil diperbarui.
        </div>
    @endif

    <form action="{{ route('profile.update') }}"
          method="POST"
          class="space-y-4"
    >
        @csrf
        @method('PATCH')

        {{-- Nama --}}
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text"
                   name="name"
                   value="{{ old('name', $user->name) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('name')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block font-medium">Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email', $user->email) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('email')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Telepon --}}
        <div>
            <label class="block font-medium">Telepon</label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone', $user->phone) }}"
                   class="w-full border px-3 py-2 rounded">
            @error('phone')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div>
            <label class="block font-medium">
                Password Baru <span class="text-gray-500">(Opsional)</span>
            </label>
            <input type="password"
                   name="password"
                   class="w-full border px-3 py-2 rounded">
            @error('password')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label class="block font-medium">Konfirmasi Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="w-full border px-3 py-2 rounded">
        </div>

        {{-- Tombol Submit --}}
        <div>
            <button type="submit"
                    class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection