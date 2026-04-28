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
            background-color: #0f0d14;
            color: #e5e7eb;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(88, 28, 135, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(45, 27, 61, 0.1) 0%, transparent 50%);
            background-attachment: fixed;
        }

        .sidebar {
            background: linear-gradient(180deg, #1a1625 0%, #2d1b3d 100%);
            border-right: 1px solid rgba(88, 28, 135, 0.3);
        }
        
        .admin-header {
            background: linear-gradient(135deg, rgba(26, 22, 37, 0.9) 0%, rgba(45, 27, 61, 0.9) 100%);
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(88, 28, 135, 0.3);
        }
    </style>
</head>
<body class="antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="sidebar w-64 h-full flex flex-col text-white shadow-2xl flex-shrink-0 transition-all duration-300">
        <!-- Sidebar Header -->
        <div class="h-16 flex items-center justify-center border-b border-purple-900/40">
            <div class="text-2xl mr-2">🕊️</div>
            <h1 class="text-lg font-bold tracking-wider text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-200 to-amber-200 uppercase">Admin Panel</h1>
        </div>

        <!-- Sidebar Navigation -->
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-900/50 text-white border-r-4 border-purple-400' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }} transition-all">
                        <span class="mr-3 text-lg">📊</span>
                        <span class="font-medium">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.users') ? 'bg-purple-900/50 text-white border-r-4 border-purple-400' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }} transition-all">
                        <span class="mr-3 text-lg">👥</span>
                        <span class="font-medium">Daftar Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.deceaseds') }}" class="flex items-center px-6 py-3 {{ request()->routeIs('admin.deceaseds') ? 'bg-purple-900/50 text-white border-r-4 border-purple-400' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }} transition-all">
                        <span class="mr-3 text-lg">📖</span>
                        <span class="font-medium">Daftar Almarhum</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-purple-900/40">
            <div class="flex items-center mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-purple-600 flex items-center justify-center text-white font-bold mr-3 shadow-[0_0_10px_rgba(147,51,234,0.5)]">
                    A
                </div>
                <div>
                    <p class="text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-purple-300">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-4 py-2 bg-red-900/60 hover:bg-red-800/80 text-red-200 border border-red-800/50 rounded transition-colors text-sm font-medium shadow">
                    <span class="mr-2">🚪</span>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- Top Navbar -->
        <header class="h-16 admin-header shadow-lg flex items-center justify-between px-6 z-10 flex-shrink-0">
            <div>
                <h2 class="text-xl font-semibold text-purple-100">@yield('header_title', 'Dashboard')</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="{{ url('/') }}" target="_blank" class="text-sm text-purple-300 hover:text-purple-100 font-medium flex items-center transition-colors">
                    <span class="mr-1">🌐</span> Lihat Website
                </a>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6" style="background: transparent;">
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
