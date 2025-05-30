@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Detail Label</h1>

    <div class="bg-white p-6 rounded shadow space-y-4">
        <div>
            <strong>Nama:</strong> {{ $label->name }}
        </div>
        <div>
            <strong>Warna:</strong>
            <span class="inline-block px-2 py-1 rounded" style="background-color: {{ $label->color }}">
                {{ $label->color }}
            </span>
        </div>
        <div>
            <a href="{{ route('labels.edit', $label) }}" class="text-blue-600 hover:underline">Edit</a>
            <a href="{{ route('labels.index') }}" class="ml-2 text-gray-600 hover:underline">Kembali</a>
        </div>
    </div>
</div>
@endsection
