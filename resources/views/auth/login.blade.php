@extends('layouts.app')

@section('title', 'Taman Makam Abadi - Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-b from-purple-900/20 to-transparent"></div>
    
    <div class="max-w-md w-full space-y-8 relative z-10 memorial-card p-10">
        <div>
            <div class="text-5xl text-center mb-2">🕊️</div>
            <h2 class="mt-4 text-center text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-200 to-amber-200">
                Masuk ke Akun Anda
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Atau
                <a href="{{ url('/register') }}" class="font-medium text-purple-400 hover:text-purple-300 transition-colors">
                    daftar akun baru di sini
                </a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ url('/login') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-900/50 border border-red-500 text-red-200 px-4 py-3 rounded-lg text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- CSRF Token will go here -->
            <input type="hidden" name="remember" value="true">
            <div class="space-y-4">
                <div>
                    <label for="email-address" class="block text-sm font-medium text-gray-300 mb-1">Email (Gmail)</label>
                    <input id="email-address" name="email" type="email" autocomplete="email" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="contoh@gmail.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-1">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none relative block w-full px-3 py-3 border border-purple-900/50 bg-gray-900/50 placeholder-gray-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500 focus:z-10 sm:text-sm transition-all" placeholder="Masukkan password Anda">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-purple-900/50 rounded bg-gray-900/50">
                    <label for="remember-me" class="ml-2 block text-sm text-gray-400">
                        Ingat saya
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-purple-400 hover:text-purple-300 transition-colors">
                        Lupa password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-purple-600 to-purple-800 hover:from-purple-500 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 focus:ring-offset-gray-900 shadow-lg transform hover:scale-[1.02] transition-all">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
