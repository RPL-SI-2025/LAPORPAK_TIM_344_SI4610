@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-white">Profil</h1>

        <!-- Tombol untuk membuka modal -->
        <button id="openModalBtn" class="bg-blue-600 hover:bg-blue-700 text-black font-semibold py-2 px-4 rounded hidden">
            Edit Profil
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">
        <p><strong>Nama:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Telepon:</strong> {{ Auth::user()->phone ?? '-' }}</p>
    </div>
</div>

<!-- MODAL -->
<div id="editModal" class="fixed inset-0 z-50 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative text-black">
        <h2 class="text-xl font-bold mb-4">Edit Profil</h2>

        <form method="POST" action="{{ route('profile.update') }}" autocomplete="on">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block mb-1 font-medium text-gray-900">Nama</label>
                <input id="name" type="text" name="name" value="{{ old('name', Auth::user()->name) }}" autocomplete="name"
                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 font-medium text-gray-900">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email', Auth::user()->email) }}" autocomplete="email"
                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block mb-1 font-medium text-gray-900">Telepon</label>
                <input id="phone" type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" autocomplete="tel"
                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('phone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-medium text-gray-900">Password <small>(kosongkan jika tidak diubah)</small></label>
                <input id="password" type="password" name="password" autocomplete="new-password"
                    class="w-full px-3 py-2 rounded border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn" class="bg-gray-600 hover:bg-gray-700 px-4 py-2 rounded text-white">Batal</button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 px-4 py-2 rounded text-white">Simpan Perubahan</button>
            </div>
        </form>

        <button id="closeModalX" class="absolute top-2 right-3 text-black text-2xl font-bold">&times;</button>
    </div>
</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const openModalBtn = document.getElementById('openModalBtn');
        const editModal = document.getElementById('editModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const closeModalX = document.getElementById('closeModalX');

        if (openModalBtn && editModal) {
            openModalBtn.addEventListener('click', () => editModal.classList.remove('hidden'));
        }
        if (closeModalBtn && editModal) {
            closeModalBtn.addEventListener('click', () => editModal.classList.add('hidden'));
        }
        if (closeModalX && editModal) {
            closeModalX.addEventListener('click', () => editModal.classList.add('hidden'));
        }
    });
</script>
@endsection