@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $ticket->title }}</h1>
    <p>{{ $ticket->description }}</p>
    <p>Status: {{ $ticket->status }}</p>
    <p>Prioritas: {{ $ticket->priority }}</p>

    <h4>Kategori:</h4>
    <ul>
        @foreach($ticket->categories as $category)
            <li>{{ $category->name }}</li>
        @endforeach
    </ul>

    <h4>Label:</h4>
    <ul>
        @foreach($ticket->labels as $label)
            <li>{{ $label->name }}</li>
        @endforeach
    </ul>

    <h4>Lampiran:</h4>
    <ul>
        @foreach($ticket->attachments as $attachment)
            <li><a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">Lihat File</a></li>
        @endforeach
    </ul>

    <a href="{{ route('tickets.index') }}">← Kembali</a>
</div>
@endsection
