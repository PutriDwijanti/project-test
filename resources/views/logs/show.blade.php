@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Detail Log Aktivitas</h1>

    <div class="bg-white shadow rounded p-6">
        <p><strong>User:</strong> {{ $log->user->name ?? 'Sistem' }}</p>
        <p><strong>Aktivitas:</strong> {{ $log->activity }}</p>
        <p><strong>Waktu:</strong> {{ $log->created_at->format('d M Y, H:i') }}</p>
        <a href="{{ route('logs.index') }}" class="text-blue-600 hover:underline mt-4 inline-block">← Kembali ke daftar</a>
    </div>
</div>
@endsection
