@extends('layouts.app')

@section('title', 'Taman Makam Abadi - Register')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-purple-900/20 to-transparent"></div>
    
    <div class="max-w-md w-full space-y-8 relative z-10 memorial-card p-10">
        <div>
            <div class="text-5xl text-center mb-2">🕊️</div>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-200 to-amber-200">
                Daftar Akun Baru
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Sudah punya akun?
                <a href="{{ url('/login') }}" class="font-medium text-purple-400 hover:text-purple-300 transition-colors">
                    Masuk di sini
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ url('/register') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded-lg text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- CSRF Token will go here -->
            <div class="space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="Nama Lengkap Anda">
                </div>
                <div>
                    <label for="email-address" class="block text-sm font-medium text-gray-300 mb-1">Email (Gmail)</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="contoh@gmail.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="Minimal 8 karakter">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="Ulangi password Anda">
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-amber-600 to-amber-800 hover:from-amber-500 hover:to-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 focus:ring-offset-gray-900 shadow-lg transform hover:scale-[1.02] transition-all">
                    Daftar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
