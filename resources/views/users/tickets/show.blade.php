@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $ticket->title }}</h1>

<div class="mb-6 space-y-2">
    <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
    <p><strong>Prioritas:</strong> {{ ucfirst($ticket->priority) }}</p>
    <p><strong>Kategori:</strong> {{ $ticket->category->name ?? '-' }}</p>
    <p><strong>Deskripsi:</strong></p>
    <p class="whitespace-pre-wrap border p-4 rounded bg-gray-800">{{ $ticket->description }}</p>
</div>

<h2 class="text-xl font-semibold mb-2">Komentar</h2>
<div class="mb-4 max-h-64 overflow-y-auto space-y-3 border border-gray-600 p-4 rounded bg-gray-900">
    @foreach ($ticket->comments as $comment)
    <div class="border-b border-gray-700 pb-2">
        <p><strong>{{ $comment->user->name }}</strong> <small class="text-gray-400">{{ $comment->created_at->diffForHumans() }}</small></p>
        <p>{{ $comment->content }}</p>
    </div>
    @endforeach
</div>

<form action="{{ route('user.tickets.addComment', $ticket) }}" method="POST" class="space-y-2 max-w-lg">
    @csrf
    <textarea name="content" rows="3" class="w-full border p-2 rounded" placeholder="Tambahkan komentar..." required></textarea>
    @error('content') <div class="text-red-500">{{ $message }}</div> @enderror
    <button type="submit" class="bg-pink-500 text-white px-4 py-2 rounded hover:bg-pink-600">Kirim Komentar</button>
</form>

@endsection
