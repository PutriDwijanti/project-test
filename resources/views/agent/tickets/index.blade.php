@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-xl font-bold mb-4">Tiket yang Ditugaskan ke Anda</h2>

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->title }}</td>
                    <td>{{ $ticket->status }}</td>
                    <td>{{ $ticket->priority }}</td>
                    <td>
                        <a href="{{ route('agent.tickets.show', $ticket) }}" class="text-blue-600">Lihat</a> |
                        <a href="{{ route('agent.tickets.edit', $ticket) }}" class="text-yellow-600">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tickets->links() }}
</div>
@endsection
