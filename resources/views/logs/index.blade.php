@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-4">Logs Aktivitas</h1>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="py-2 px-3">User ID</th>
                        <th class="py-2 px-3">Action</th>
                        <th class="py-2 px-3">Deskripsi</th>
                        <th class="py-2 px-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($logs as $log)
                        <tr class="border-b">
                            <td class="py-2 px-3">{{ $log->user_id }}</td>
                            <td class="py-2 px-3">{{ $log->action }}</td>
                            <td class="py-2 px-3">{{ $log->description }}</td>
                            <td class="py-2 px-3">{{ $log->created_at }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">Belum ada log aktivitas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
