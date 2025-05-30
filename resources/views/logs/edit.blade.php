@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Log Aktivitas</h1>

    <form action="{{ route('logs.update', $log->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Aktivitas</label>
            <textarea name="activity" class="w-full border rounded p-2" required>{{ old('activity', $log->activity) }}</textarea>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
