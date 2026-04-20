<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Taman Makam Abadi - Sistem Denah Kuburan')</title>

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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .text-shadow-soft {
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }
        
        .bg-gradient-memorial {
            background: linear-gradient(135deg, #1a1625 0%, #2d1b3d 50%, #1a1625 100%);
        }
        
        .bg-gradient-card {
            background: linear-gradient(135deg, rgba(42, 32, 52, 0.8) 0%, rgba(32, 24, 42, 0.9) 100%);
        }

        .memorial-card {
            backdrop-filter: blur(4px);
            border: 1px solid rgba(88, 28, 135, 0.3);
            border-radius: 0.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            background: linear-gradient(135deg, rgba(42, 32, 52, 0.8) 0%, rgba(32, 24, 42, 0.9) 100%);
            transition: all 0.3s duration;
        }

        .memorial-card:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-color: rgba(126, 34, 206, 0.5);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="bg-gradient-memorial border-b border-purple-900/40 shadow-2xl sticky top-0 z-50 backdrop-blur-sm">
      <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
          <a href="{{ url('/Dashboard') }}" class="flex items-center space-x-3 group">
            <div class="text-4xl transform group-hover:scale-110 transition-transform">🕊️</div>
            <div>
              <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-200 to-amber-200 text-shadow-soft">
                Taman Makam Abadi
              </h1>
              <p class="text-sm text-gray-400 italic">Mengenang dengan Kasih</p>
            </div>
          </a>

          <nav class="hidden md:flex space-x-1">
            <a href="{{ url('/Dashboard') }}" class="px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 {{ request()->is('Dashboard') ? 'bg-purple-700/50 text-white shadow-lg' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }}">
                <span>🏛️</span>
                <span class="font-medium">Beranda</span>
            </a>
            <a href="{{ url('/map') }}" class="px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 {{ request()->is('map') ? 'bg-purple-700/50 text-white shadow-lg' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }}">
                <span>🗺️</span>
                <span class="font-medium">Denah Makam</span>
            </a>
            <a href="{{ url('/deceased') }}" class="px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 {{ request()->is('deceased') ? 'bg-purple-700/50 text-white shadow-lg' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }}">
                <span>📖</span>
                <span class="font-medium">Daftar Almarhum</span>
            </a>
            <a href="{{ url('/search') }}" class="px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 {{ request()->is('search') ? 'bg-purple-700/50 text-white shadow-lg' : 'text-gray-300 hover:bg-purple-900/30 hover:text-white' }}">
                <span>🔍</span>
                <span class="font-medium">Pencarian</span>
            </a>
          </nav>

          <div class="md:hidden">
            <button class="text-gray-300 hover:text-white p-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <nav class="hidden pb-4 space-y-1">
            <!-- Mobile nav items... -->
        </nav>
      </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-memorial border-t border-purple-900/40 mt-16">
      <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h3 class="text-lg font-semibold text-purple-300 mb-4 flex items-center space-x-2">
              <span>🕊️</span>
              <span>Taman Makam Abadi</span>
            </h3>
            <p class="text-gray-400 text-sm leading-relaxed">
              Tempat peristirahatan terakhir yang tenang dan damai. 
              Kami menjaga kenangan indah yang tak terlupakan.
            </p>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-purple-300 mb-4">Kontak</h3>
            <ul class="space-y-2 text-sm text-gray-400">
              <li class="flex items-center space-x-2">
                <span>📍</span>
                <span>Jl. Kenangan Abadi No. 123</span>
              </li>
              <li class="flex items-center space-x-2">
                <span>📞</span>
                <span>(021) 1234-5678</span>
              </li>
              <li class="flex items-center space-x-2">
                <span>✉️</span>
                <span>info@tamammakamabadi.com</span>
              </li>
            </ul>
          </div>

          <div>
            <h3 class="text-lg font-semibold text-purple-300 mb-4">Jam Operasional</h3>
            <ul class="space-y-2 text-sm text-gray-400">
              <li class="flex justify-between">
                <span>Senin - Jumat</span>
                <span>08:00 - 16:00</span>
              </li>
              <li class="flex justify-between">
                <span>Sabtu - Minggu</span>
                <span>08:00 - 14:00</span>
              </li>
              <li class="flex justify-between">
                <span>Hari Libur</span>
                <span>Tutup</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="mt-8 pt-6 border-t border-purple-900/40 text-center">
          <p class="text-gray-500 text-sm">
            &copy; {{ date('Y') }} Taman Makam Abadi. Semua hak cipta dilindungi.
          </p>
          <p class="text-gray-600 text-xs mt-2 italic">
            &ldquo;Sesungguhnya kita adalah milik Allah dan kepada-Nya lah kita kembali&rdquo;
          </p>
        </div>
      </div>
    </footer>
</body>
</html>
