@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Buat Tiket Baru</h1>

<form action="{{ route('user.tickets.store') }}" method="POST" class="space-y-6 max-w-lg" enctype="multipart/form-data">
    @csrf

    <div>
        <label for="title" class="block mb-1 font-semibold">Judul</label>
        <input type="text" name="title" id="title" class="w-full border border-gray-300 p-2 rounded" value="{{ old('title') }}" required>
        @error('title')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="description" class="block mb-1 font-semibold">Deskripsi</label>
        <textarea name="description" id="description" rows="4" class="w-full border border-gray-300 p-2 rounded" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="category_id" class="block mb-1 font-semibold">Kategori</label>
        <select name="category_id" id="category_id" class="w-full border border-gray-300 p-2 rounded" required>
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="priority" class="block mb-1 font-semibold">Prioritas</label>
        <select name="priority" id="priority" class="w-full border border-gray-300 p-2 rounded" required>
            <option value="">Pilih Prioritas</option>
            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
        </select>
        @error('priority')
            <div class="text-red-500 mt-1">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="bg-pink-500 text-white px-6 py-2 rounded hover:bg-pink-600 transition">
        Buat Tiket
    </button>
</form>
@endsection
