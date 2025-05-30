@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Edit Label</h1>

    <form action="{{ route('labels.update', $label) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" value="{{ $label->name }}" class="mt-1 w-full border-gray-300 rounded" required>
        </div>
        <div>
            <label class="block font-medium">Warna</label>
            <input type="color" name="color" value="{{ $label->color }}" class="mt-1 w-16 h-10 border rounded" required>
        </div>
        <div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Perbarui</button>
            <a href="{{ route('labels.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
