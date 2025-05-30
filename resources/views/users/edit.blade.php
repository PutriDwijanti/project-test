@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Edit User</h1>

    <form action="{{ route('users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded mt-1" required>
        </div>
        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded mt-1" required>
        </div>
        <div>
            <label class="block font-medium">Password Baru (Opsional)</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded mt-1">
        </div>
        <div>
            <label class="block font-medium">Role</label>
            <select name="role" class="w-full border-gray-300 rounded mt-1" required>
                <option value="user" @selected($user->role == 'user')>User</option>
                <option value="agent" @selected($user->role == 'agent')>Agent</option>
                <option value="admin" @selected($user->role == 'admin')>Admin</option>
            </select>
        </div>
        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update</button>
    </form>
</div>
@endsection
