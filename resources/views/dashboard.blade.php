@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
    <div class="bg-gray-800 p-6 rounded-lg shadow flex items-center space-x-4 hover:shadow-pink-500 transition-shadow duration-300">
        <div class="w-14 h-14 bg-pink-400 rounded-full flex items-center justify-center text-white text-2xl">
            🟪
        </div>
        <div>
            <p class="text-sm text-gray-400 uppercase tracking-wide">Total Tickets</p>
            <p class="text-3xl font-extrabold">{{ $total }}</p>
        </div>
    </div>
    <div class="bg-gray-800 p-6 rounded-lg shadow flex items-center space-x-4 hover:shadow-green-400 transition-shadow duration-300">
        <div class="w-14 h-14 bg-green-400 rounded-full flex items-center justify-center text-white text-2xl">
            ✅
        </div>
        <div>
            <p class="text-sm text-gray-400 uppercase tracking-wide">Tiket Terbuka</p>
            <p class="text-3xl font-extrabold text-green-300">{{ $open }}</p>
        </div>
    </div>
    <div class="bg-gray-800 p-6 rounded-lg shadow flex items-center space-x-4 hover:shadow-red-500 transition-shadow duration-300">
        <div class="w-14 h-14 bg-red-400 rounded-full flex items-center justify-center text-white text-2xl">
            ❌
        </div>
        <div>
            <p class="text-sm text-gray-400 uppercase tracking-wide">Tiket Tertutup</p>
            <p class="text-3xl font-extrabold text-red-400">{{ $closed }}</p>
        </div>
    </div>
</div>

<!-- Tiket Terbaru -->
<div class="bg-gray-800 p-6 rounded-lg shadow">
    <h3 class="text-2xl font-bold mb-6 border-b border-gray-700 pb-2">Tiket Terbaru</h3>
    <div class="overflow-x-auto">
        <table class="w-full text-left text-gray-300 text-sm">
            <thead class="bg-gray-700 uppercase text-xs tracking-wider">
                <tr>
                    <th class="py-3 px-4">Judul</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Prioritas</th>
                    <th class="py-3 px-4">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tickets as $ticket)
                <tr class="border-b border-gray-700 hover:bg-gray-700 transition-colors cursor-pointer">
                    <td class="py-3 px-4">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-pink-400 hover:underline">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td class="py-3 px-4 capitalize">{{ $ticket->status }}</td>
                    <td class="py-3 px-4 capitalize">{{ $ticket->priority }}</td>
                    <td class="py-3 px-4">{{ $ticket->created_at->diffForHumans() }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-6 text-center text-gray-500">Belum ada tiket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $tickets->links() }}
    </div>
</div>
@endsection
