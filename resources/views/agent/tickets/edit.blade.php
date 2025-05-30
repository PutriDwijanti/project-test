@extends('layouts.app')

@section('content')
<div class="bg-gray-800 p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-pink-400">Edit Tiket</h2>

    <form action="{{ route('agent.tickets.update', $ticket->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block mb-1">Judul</label>
            <input type="text" name="title" id="title" value="{{ old('title', $ticket->title) }}" 
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring focus:ring-pink-400">
        </div>

        <div class="mb-4">
            <label for="description" class="block mb-1">Deskripsi</label>
            <textarea name="description" id="description" rows="5" 
                class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring focus:ring-pink-400">{{ old('description', $ticket->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="status" class="block mb-1">Status</label>
            <select name="status" id="status" class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring focus:ring-pink-400">
                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="priority" class="block mb-1">Prioritas</label>
            <select name="priority" id="priority" class="w-full px-4 py-2 rounded bg-gray-700 text-white focus:ring focus:ring-pink-400">
                <option value="low" {{ $ticket->priority == 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ $ticket->priority == 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high" {{ $ticket->priority == 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="attachments" class="block mb-1">Lampiran (opsional, max 2MB)</label>
            <input type="file" name="attachments[]" multiple class="w-full px-4 py-2 bg-gray-700 text-white rounded">
        </div>

        <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-2 rounded">
            Update Tiket
        </button>
    </form>
</div>
@endsection
