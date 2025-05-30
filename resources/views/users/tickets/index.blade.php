@extends('layouts.app')

@se@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Tiket Saya</h1>

<form method="GET" class="mb-4 flex space-x-3">
    <select name="status" class="border rounded p-2">
        <option value="">Semua Status</option>
        <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Open</option>
        <option value="in_progress" {{ request('status')=='in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="closed" {{ request('status')=='closed' ? 'selected' : '' }}>Closed</option>
    </select>

    <select name="priority" class="border rounded p-2">
        <option value="">Semua Prioritas</option>
        <option value="low" {{ request('priority')=='low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ request('priority')=='medium' ? 'selected' : '' }}>Medium</option>
        <option value="high" {{ request('priority')=='high' ? 'selected' : '' }}>High</option>
    </select>

    <select name="category_id" class="border rounded p-2">
        <option value="">Semua Kategori</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ request('category_id')==$category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>

    <button type="submit" class="bg-pink-500 px-4 py-2 rounded text-white">Filter</button>
</form>

<a href="{{ route('user.tickets.create') }}" class="mb-4 inline-block bg-green-600 px-4 py-2 rounded text-white hover:bg-green-700">Buat Tiket Baru</a>

<table class="w-full table-auto border-collapse border border-gray-600">
    <thead>
        <tr class="bg-gray-700 text-white">
            <th class="border border-gray-600 p-2">Judul</th>
            <th class="border border-gray-600 p-2">Status</th>
            <th class="border border-gray-600 p-2">Prioritas</th>
            <th class="border border-gray-600 p-2">Kategori</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tickets as $ticket)
        <tr class="hover:bg-gray-800 cursor-pointer">
            <td class="border border-gray-600 p-2">
                <a href="{{ route('user.tickets.show', $ticket) }}" class="text-pink-400 hover:underline">
                    {{ $ticket->title }}
                </a>
            </td>
            <td class="border border-gray-600 p-2 capitalize">{{ $ticket->status }}</td>
            <td class="border border-gray-600 p-2 capitalize">{{ $ticket->priority }}</td>
            <td class="border border-gray-600 p-2">{{ $ticket->category->name ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-4 text-center">Belum ada tiket.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $tickets->links() }}
</div>
@endsection
ction('content')
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Daftar Pengguna</h1>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Tambah User</a>
    </div>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-4 rounded shadow">
        <table class="min-w-full text-sm">
            <thead>
                <tr class="border-b bg-gray-100">
                    <th class="py-2 px-3 text-left">Nama</th>
                    <th class="py-2 px-3 text-left">Email</th>
                    <th class="py-2 px-3 text-left">Role</th>
                    <th class="py-2 px-3 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b">
                        <td class="py-2 px-3">{{ $user->name }}</td>
                        <td class="py-2 px-3">{{ $user->email }}</td>
                        <td class="py-2 px-3 capitalize">{{ $user->role }}</td>
                        <td class="py-2 px-3 flex gap-2">
                            <a href="{{ route('users.show', $user) }}" class="text-blue-600 hover:underline">Lihat</a>
                            <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">Belum ada user.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
