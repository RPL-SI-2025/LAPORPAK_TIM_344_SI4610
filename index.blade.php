@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-2xl font-bold mb-4">Profil Saya</h2>

    @if(session('status') === 'profile-updated')
        <div class="mb-4 text-green-600">
            Profil berhasil diperbarui.
        </div>
    @endif

    <div class="space-y-2">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Telepon:</strong> {{ $user->phone ?? '-' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('profile.edit') }}"
           class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">
            Edit Profil
        </a>
    </div>
</div>
@endsection
