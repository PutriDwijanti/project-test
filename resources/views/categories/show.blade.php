@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Detail Kategori</h1>

    <div class="mb-4">
        <strong>ID:</strong> {{ $category->id }}
    </div>
    <div class="mb-4">
        <strong>Nama Kategori:</strong> {{ $category->name }}
    </div>

    <a href="{{ route('categories.index') }}" class="inline-block mt-4 text-blue-600 hover:underline">Kembali ke Daftar Kategori</a>
</div>
@endsection
