@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4 text-pink-400">{{ $ticket->title }}</h2>

    <p class="mb-2"><strong>Deskripsi:</strong></p>
    <p class="mb-4 text-gray-300">{{ $ticket->description }}</p>

    <p class="mb-2"><strong>Status:</strong> {{ $ticket->status }}</p>
    <p class="mb-2"><strong>Prioritas:</strong> {{ $ticket->priority }}</p>

    <p class="mb-2"><strong>Kategori:</strong> 
        @foreach ($ticket->categories as $category)
            <span class="bg-pink-700 text-white px-2 py-1 rounded-full text-sm">{{ $category->name }}</span>
        @endforeach
    </p>

    <p class="mb-4"><strong>Label:</strong> 
        @foreach ($ticket->labels as $label)
            <span class="bg-gray-600 text-white px-2 py-1 rounded-full text-sm">{{ $label->name }}</span>
        @endforeach
    </p>

    <p class="mb-4"><strong>Lampiran:</strong></p>
    <ul>
        @foreach ($ticket->attachments as $attachment)
            <li><a href="{{ asset('storage/' . $attachment->filepath) }}" target="_blank" class="text-pink-400 hover:underline">{{ $attachment->filename }}</a></li>
        @endforeach
    </ul>

    <div class="mt-6">
        <a href="{{ route('agent.tickets.edit', $ticket->id) }}" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">Edit Tiket</a>
    </div>
</div>
@endsection
