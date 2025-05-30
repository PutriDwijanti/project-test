@extends('layouts.app')

@section('content')
<h2 class="text-3xl font-bold mb-6">Dashboard Agen</h2>

<div class="bg-gray-800 p-6 rounded-lg shadow mb-6">
    <h3 class="text-2xl font-semibold text-pink-400 mb-4">Tiket Perlu Ditindaklanjuti</h3>

    @if($tickets->count())
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-300">
            <thead class="bg-gray-700 uppercase text-xs">
                <tr>
                    <th class="py-3 px-4">Judul</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Prioritas</th>
                    <th class="py-3 px-4">Dibuat Oleh</th>
                    <th class="py-3 px-4">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tickets as $ticket)
                <tr class="border-b border-gray-700 hover:bg-gray-700 transition">
                    <td class="py-3 px-4">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-pink-400 hover:underline">
                            {{ $ticket->title }}
                        </a>
                    </td>
                    <td class="py-3 px-4 capitalize">{{ $ticket->status }}</td>
                    <td class="py-3 px-4 capitalize">{{ $ticket->priority }}</td>
                    <td class="py-3 px-4">{{ $ticket->createdBy->name ?? 'Tidak Diketahui' }}</td>
                    <td class="py-3 px-4">{{ $ticket->created_at->diffForHumans() }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
    @else
    <p class="text-gray-400">Tidak ada tiket terbuka saat ini.</p>
    @endif
</div>
@endsection
