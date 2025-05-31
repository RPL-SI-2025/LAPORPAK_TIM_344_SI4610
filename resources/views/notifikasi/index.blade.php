@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Notifikasi</h1>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">
            &larr; Kembali
        </a>

        @foreach($notifications as $notification)
            <div class="card my-2">
                <div class="card-body">
                    <p>{{ $notification->data['message'] }}</p>
                    <p><small>{{ $notification->created_at->format('d M Y H:i') }}</small></p>
                </div>
            </div>
        @endforeach
    </div>
@endsection