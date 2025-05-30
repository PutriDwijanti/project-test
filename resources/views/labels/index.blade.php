@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Daftar Label</h1>
        <a href="{{ route('labels.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah Label</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-4">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="text-left py-2 px-3">Nama</th>
                    <th class="text-left py-2 px-3">Warna</th>
                    <th class="text-left py-2 px-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($labels as $label)
                    <tr class="border-b">
                        <td class="py-2 px-3">{{ $label->name }}</td>
                        <td class="py-2 px-3">
                            <span class="inline-block px-2 py-1 rounded" style="background-color: {{ $label->color }}">{{ $label->color }}</span>
                        </td>
                        <td class="py-2 px-3 flex gap-2">
                            <a href="{{ route('labels.show', $label) }}" class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('labels.edit', $label) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('labels.destroy', $label) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-gray-500">Belum ada label.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
