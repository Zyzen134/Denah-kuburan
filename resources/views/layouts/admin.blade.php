<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard - Taman Makam Abadi')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            background-color: #f3f4f6; /* Lighter background for dashboard content */
            color: #1f2937;
        }

        .sidebar {
            background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        }
    </style>
</head>
<body class="antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="sidebar w-64 h-full flex flex-col text-white shadow-xl flex-shrink-0 transition-all duration-300">
        <!-- Sidebar Header -->
        <div class="h-16 flex items-center justify-center border-b border-gray-700">
            <div class="text-2xl mr-2">🕊️</div>
            <h1 class="text-lg font-bold tracking-wider uppercase text-gray-200">Admin Panel</h1>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                        <span class="mr-3 text-lg">📊</span>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                        <span class="mr-3 text-lg">👥</span>
                        <span class="font-medium">Daftar Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.deceaseds') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.deceaseds') ? 'bg-indigo-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }} transition-colors">
                        <span class="mr-3 text-lg">📖</span>
                        <span class="font-medium">Daftar Almarhum</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-gray-700">
            <div class="flex items-center mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-indigo-500 flex items-center justify-center text-white font-bold mr-3">
                    A
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded transition-colors text-sm font-medium shadow">
                    <span class="mr-2">🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- Top Navbar -->
        <header class="h-16 bg-white shadow flex items-center justify-between px-6 z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">@yield('header_title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium flex items-center">
                    <span class="mr-1">🌐</span> Lihat Website
                </a>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
