@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-black">Profile</h1>

        <!-- Tombol buka modal -->
    <button id="openModalBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Edit Profile
        </button>
    </div>

    <div class="bg-gray-800 text-white p-6 rounded-lg shadow-md">
        <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Phone:</strong> {{ Auth::user()->phone ?? '-' }}</p>
    </div>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden">
    <div class="bg-white w-full max-w-lg p-6 rounded-lg shadow-lg relative">
        <h2 class="text-xl font-bold mb-4 text-black">Edit Profile</h2>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label class="block mb-1 text-black">Name</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full px-3 py-2 rounded border @error('name') border-red-500 @enderror text-black">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-black">Email</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full px-3 py-2 rounded border @error('email') border-red-500 @enderror text-black">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-black">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" class="w-full px-3 py-2 rounded border @error('phone') border-red-500 @enderror text-black">
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-black">Password <small>(kosongkan jika
