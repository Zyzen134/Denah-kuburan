@extends('layouts.app')

@section('title', 'Pencarian Makam - Taman Makam Abadi')

@section('content')
<div class="container mx-auto px-4 py-12 flex flex-col items-center">
    
    <!-- Header -->
    <div class="text-center mb-10 max-w-2xl w-full">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
            Pencarian Makam
        </h1>
        <p class="text-gray-400 text-lg">
            Temukan lokasi peristirahatan terakhir keluarga atau kerabat Anda dengan memasukkan nama lengkap mereka.
        </p>
    </div>

    <!-- Search Form -->
    <div class="w-full max-w-3xl mb-12">
        <form action="{{ route('search') }}" method="GET" class="relative">
            <div class="flex items-center bg-gray-900/80 border border-purple-500/50 rounded-full overflow-hidden shadow-2xl focus-within:ring-2 focus-within:ring-purple-400 focus-within:border-transparent transition-all duration-300">
                <div class="pl-6 text-purple-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="q" value="{{ $query }}" placeholder="Ketik nama almarhum atau nomor makam..." 
                    class="w-full py-4 px-4 bg-transparent text-white placeholder-gray-500 focus:outline-none text-lg">
                <button type="submit" class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-medium py-4 px-8 transition-colors duration-300">
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Results Area -->
    <div class="w-full max-w-5xl">
        @if(isset($query) && $query != '')
            <div class="mb-6 flex justify-between items-center border-b border-purple-900/50 pb-4">
                <h2 class="text-xl text-gray-300">
                    Hasil pencarian untuk: <span class="text-amber-300 font-semibold">"{{ $query }}"</span>
                </h2>
                <span class="text-gray-500 text-sm bg-gray-900/50 px-3 py-1 rounded-full">{{ $results->count() }} data ditemukan</span>
            </div>

            @if($results->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($results as $deceased)
                        <div class="memorial-card p-6 flex flex-col sm:flex-row items-center sm:items-start gap-6 hover:-translate-y-1 transition-transform duration-300">
                            <!-- Avatar -->
                            <div class="flex-shrink-0">
                                @if($deceased->photo)
                                    <img src="{{ asset('storage/' . $deceased->photo) }}" alt="Foto" class="w-24 h-24 rounded-full object-cover border-2 border-purple-500/50 shadow-lg">
                                @else
                                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-indigo-900 to-purple-900 flex items-center justify-center border-2 border-purple-500/30 shadow-lg">
                                        <span class="text-3xl font-bold text-purple-300">{{ substr($deceased->name, 0, 1) }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h3 class="text-2xl font-bold text-white mb-1">{{ $deceased->name }}</h3>
                                
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 mb-4 text-sm">
                                    @if($deceased->gender)
                                        <span class="px-2 py-1 bg-gray-800/80 text-gray-300 rounded text-xs border border-gray-700">{{ $deceased->gender }}</span>
                                    @endif
                                    @if($deceased->age_at_death)
                                        <span class="px-2 py-1 bg-gray-800/80 text-gray-300 rounded text-xs border border-gray-700">Usia: {{ $deceased->age_at_death }} Tahun</span>
                                    @endif
                                </div>

                                <div class="space-y-2 mb-4">
                                    <!-- Tanggal Wafat -->
                                    <div class="flex items-center text-gray-400 justify-center sm:justify-start">
                                        <span class="mr-2">🕊️</span>
                                        <span>Wafat: {{ \Carbon\Carbon::parse($deceased->death_date)->format('d F Y') }}</span>
                                    </div>
                                    
                                    <!-- Lokasi Makam -->
                                    <div class="flex items-center text-amber-200/90 justify-center sm:justify-start bg-amber-900/20 py-2 px-3 rounded-lg border border-amber-900/30 inline-flex mt-2">
                                        <span class="mr-2">📍</span>
                                        <span class="font-medium mr-2">Lokasi: Blok {{ $deceased->block }}, Nomor {{ $deceased->grave_number }}</span>
                                        @if($deceased->google_maps_link)
                                        <button type="button" onclick="document.getElementById('map-{{$deceased->id}}').classList.toggle('hidden')" class="text-amber-300 hover:text-white transition-colors bg-amber-800/40 p-1.5 rounded-md hover:bg-amber-700/60" title="Lihat Peta">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>
                                </div>

                                @if($deceased->google_maps_link)
                                <div id="map-{{$deceased->id}}" class="mt-4 w-full hidden transition-all duration-300">
                                    <h4 class="text-sm font-semibold text-gray-400 mb-2 text-left">Peta Lokasi Makam:</h4>
                                    @if(str_starts_with(trim($deceased->google_maps_link), '<iframe'))
                                        <div class="rounded-lg overflow-hidden border border-purple-500/30 w-full" style="height: 250px;">
                                            {!! str_replace('<iframe ', '<iframe style="width:100%; height:100%;" ', $deceased->google_maps_link) !!}
                                        </div>
                                    @else
                                        <a href="{{ $deceased->google_maps_link }}" target="_blank" class="block rounded-lg overflow-hidden border border-purple-500/30 w-full relative group hover:border-purple-400 transition-colors" style="height: 250px;">
                                            <div class="absolute inset-0 bg-gradient-to-br from-gray-800 to-gray-900 flex flex-col items-center justify-center">
                                                <div class="bg-gray-900/50 p-6 rounded-full mb-4 group-hover:scale-110 group-hover:bg-purple-900/30 transition-all duration-300">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-purple-400" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <span class="text-white font-medium px-6 py-2 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-full shadow-lg group-hover:from-purple-500 group-hover:to-indigo-500 transition-all">
                                                    Buka di Google Maps
                                                </span>
                                            </div>
                                        </a>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Results -->
                <div class="bg-gray-900/40 border border-purple-900/30 rounded-2xl p-12 text-center">
                    <div class="text-6xl mb-4">📭</div>
                    <h3 class="text-2xl font-bold text-gray-300 mb-2">Data Tidak Ditemukan</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Kami tidak dapat menemukan almarhum dengan nama tersebut. Pastikan ejaan nama sudah benar.</p>
                </div>
            @endif
        @else
            <!-- Initial State (No search performed yet) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8 opacity-70">
                <div class="bg-gray-900/30 border border-gray-800 rounded-xl p-6 text-center">
                    <div class="text-3xl mb-3">🔍</div>
                    <h4 class="text-white font-medium mb-2">Pencarian Cepat</h4>
                    <p class="text-sm text-gray-500">Cukup ketik nama atau sebagian nama untuk mulai mencari.</p>
                </div>
                <div class="bg-gray-900/30 border border-gray-800 rounded-xl p-6 text-center">
                    <div class="text-3xl mb-3">📍</div>
                    <h4 class="text-white font-medium mb-2">Lokasi Akurat</h4>
                    <p class="text-sm text-gray-500">Dapatkan informasi blok dan nomor makam dengan tepat.</p>
                </div>
                <div class="bg-gray-900/30 border border-gray-800 rounded-xl p-6 text-center">
                    <div class="text-3xl mb-3">📱</div>
                    <h4 class="text-white font-medium mb-2">Mudah Diakses</h4>
                    <p class="text-sm text-gray-500">Bisa digunakan langsung dari ponsel saat Anda berkunjung.</p>
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
