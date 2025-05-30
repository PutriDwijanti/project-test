@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Tiket</h1>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if(Auth::user()->role === 'user')
        <a href="{{ route('tickets.create') }}">+ Buat Tiket Baru</a>
    @endif

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->title }}</td>
                <td>{{ $ticket->status }}</td>
                <td>{{ $ticket->priority }}</td>
                <td>
                    <a href="{{ route('tickets.show', $ticket->id) }}">Lihat</a>
                    @can('update', $ticket)
                        | <a href="{{ route('tickets.edit', $ticket->id) }}">Edit</a>
                    @endcan
                </td>
            </tr>
            @empty
            <tr><td colspan="4">Belum ada tiket</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $tickets->links() }}
</div>
@endsection
