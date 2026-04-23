@extends('layouts.app')

@section('title', 'Taman Makam Abadi - Beranda')

@section('content')
<div class="min-h-screen">
    <!-- Hero Section -->
    <section class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-purple-900/20 to-transparent"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-200 via-purple-300 to-amber-200 text-shadow-soft leading-tight">
                    Taman Makam Abadi
                </h1>
                <p class="text-xl md:text-2xl text-gray-300 mb-4 leading-relaxed">
                    Mengelola dan Mengenang dengan Penuh Kasih Sayang
                </p>
                <p class="text-lg text-gray-400 mb-10 italic">
                    Sistem informasi digital untuk memudahkan pengelolaan dan pencarian lokasi makam
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">

                    <a href="{{ url('/search') }}" class="px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white rounded-lg font-semibold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2">
                        <span>🔍</span>
                        <span>Cari Almarhum</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 bg-gradient-memorial">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="memorial-card p-6 text-center transform hover:scale-105 transition-transform">
                    <div class="text-4xl mb-3">📦</div>
                    <div class="text-3xl font-bold text-purple-300 mb-2">12</div>
                    <div class="text-gray-400 text-sm">Total Blok</div>
                </div>
                <!-- Stat 2 -->
                <div class="memorial-card p-6 text-center transform hover:scale-105 transition-transform">
                    <div class="text-4xl mb-3">🏛️</div>
                    <div class="text-3xl font-bold text-purple-300 mb-2">500+</div>
                    <div class="text-gray-400 text-sm">Kapasitas</div>
                </div>
                <!-- Stat 3 -->
                <div class="memorial-card p-6 text-center transform hover:scale-105 transition-transform">
                    <div class="text-4xl mb-3">✅</div>
                    <div class="text-3xl font-bold text-purple-300 mb-2">234</div>
                    <div class="text-gray-400 text-sm">Terisi</div>
                </div>
                <!-- Stat 4 -->
                <div class="memorial-card p-6 text-center transform hover:scale-105 transition-transform">
                    <div class="text-4xl mb-3">⭕</div>
                    <div class="text-3xl font-bold text-purple-300 mb-2">266</div>
                    <div class="text-gray-400 text-sm">Tersedia</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
                Fitur Unggulan
            </h2>
            <p class="text-center text-gray-400 mb-12 max-w-2xl mx-auto">
                Sistem modern untuk memudahkan pengelolaan dan pencarian informasi makam
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="memorial-card p-6 transform hover:scale-105 transition-all">
                    <div class="text-5xl mb-4">🗺️</div>
                    <h3 class="text-xl font-semibold text-purple-300 mb-3">Denah Interaktif</h3>
                    <p class="text-gray-400 leading-relaxed">Lihat denah kuburan secara visual dengan grid interaktif untuk memudahkan pencarian lokasi</p>
                </div>
                <!-- Feature 2 -->
                <div class="memorial-card p-6 transform hover:scale-105 transition-all">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-purple-300 mb-3">Pencarian Cepat</h3>
                    <p class="text-gray-400 leading-relaxed">Cari data almarhum berdasarkan nama, tanggal, atau lokasi dengan sistem pencarian yang canggih</p>
                </div>
                <!-- Feature 3 -->
                <div class="memorial-card p-6 transform hover:scale-105 transition-all">
                    <div class="text-5xl mb-4">📖</div>
                    <h3 class="text-xl font-semibold text-purple-300 mb-3">Database Lengkap</h3>
                    <p class="text-gray-400 leading-relaxed">Simpan informasi lengkap termasuk biografi, foto, dan data keluarga almarhum</p>
                </div>
                <!-- Feature 4 -->
                <div class="memorial-card p-6 transform hover:scale-105 transition-all">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold text-purple-300 mb-3">Manajemen Blok</h3>
                    <p class="text-gray-400 leading-relaxed">Kelola area pemakaman dengan sistem blok yang terorganisir dan mudah dikelola</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-memorial">
        <div class="container mx-auto px-4">
            <div class="memorial-card p-12 text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-purple-300 mb-4">
                    Butuh Bantuan?
                </h2>
                <p class="text-gray-300 mb-8 leading-relaxed">
                    Tim kami siap membantu Anda dalam mencari informasi makam atau proses pendaftaran. 
                    Hubungi kami untuk informasi lebih lanjut.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="tel:02112345678" class="px-6 py-3 bg-purple-700 hover:bg-purple-600 text-white rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2">
                        <span>📞</span>
                        <span>(021) 1234-5678</span>
                    </a>
                    <a href="mailto:info@tamammakamabadi.com" class="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2">
                        <span>✉️</span>
                        <span>Email Kami</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
