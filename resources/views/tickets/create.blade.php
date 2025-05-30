@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Tiket</h1>
    <form action="{{ route('tickets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Judul</label>
        <input type="text" name="title" required>

        <label>Deskripsi</label>
        <textarea name="description" required></textarea>

        <label>Prioritas</label>
        <select name="priority" required>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>

        <label>Kategori</label>
        <select name="categories[]" multiple>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <label>Label</label>
        <select name="labels[]" multiple>
            @foreach($labels as $label)
                <option value="{{ $label->id }}">{{ $label->name }}</option>
            @endforeach
        </select>

        <label>Lampiran</label>
        <input type="file" name="attachments[]" multiple>

        <button type="submit">Kirim Tiket</button>
    </form>
</div>
@endsection
