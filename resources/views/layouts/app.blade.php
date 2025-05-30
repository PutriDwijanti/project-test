<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Tailwind CDN (atau gunakan build lokal Tailwind CSS di proyekmu) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-sans min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 p-6 flex flex-col">
        <h1 class="text-3xl font-extrabold tracking-tight text-pink-400 mb-10">Tickets</h1>

        <nav class="flex flex-col space-y-3 text-gray-300 mb-auto">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-pink-400 transition-colors duration-200">Dashboard</a>

                {{-- ADMIN --}}
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('tickets.index') }}" class="hover:text-pink-400 transition-colors duration-200">Semua Tiket</a>
                    <a href="{{ route('logs.index') }}" class="hover:text-pink-400 transition-colors duration-200">Ticket Logs</a>
                    <a href="{{ route('users.index') }}" class="hover:text-pink-400 transition-colors duration-200">Users</a>
                    <a href="{{ route('categories.index') }}" class="hover:text-pink-400 transition-colors duration-200">Categories</a>
                    <a href="{{ route('labels.index') }}" class="hover:text-pink-400 transition-colors duration-200">Labels</a>
                @endif

                {{-- AGENT --}}
                @if (auth()->user()->role === 'agent')
                    <a href="{{ route('agent.dashboard') }}" class="hover:text-pink-400 transition-colors duration-200">Dashboard Agen</a>
                    <a href="{{ route('agent.tickets.index') }}" class="hover:text-pink-400 transition-colors duration-200">Tiket Saya</a>
                @endif

                {{-- USER --}}
                @if (auth()->user()->role === 'user')
                    <a href="{{ route('tickets.index') }}" class="hover:text-pink-400 transition-colors duration-200">Tiket Saya</a>
                @endif
            @endauth
        </nav>

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="w-full text-left px-4 py-2 rounded bg-pink-600 hover:bg-pink-700 transition-colors text-white font-semibold">
                Logout
            </button>
        </form>
    </aside>

    <!-- Main content -->
    <div class="flex-1 p-10 overflow-auto flex flex-col">
        <!-- Header -->
        <header class="flex justify-between items-center mb-8">
            <h2 class="text-4xl font-bold tracking-wide">Dashboard</h2>
            <input 
                type="search" 
                placeholder="Search tickets..." 
                class="bg-gray-700 text-white rounded-md px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-pink-400"
            />
        </header>

        <!-- Content -->
        <main class="flex-grow overflow-auto">
            @yield('content')
        </main>
    </div>

</body>
</html>


