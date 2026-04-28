@extends('layouts.admin')

@section('title', 'Data Almarhum - Admin Dashboard')
@section('header_title', 'Data Almarhum')

@section('content')
<div class="memorial-card rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-purple-900/40 bg-purple-900/20 flex items-center justify-between">
        <h3 class="font-bold text-purple-100 flex items-center">
            <span class="mr-2 text-pink-400">📖</span>
            Semua Data Almarhum
        </h3>
        
        <a href="{{ route('admin.deceaseds.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors shadow-sm flex items-center">
            <span class="mr-1">+</span> Tambah Data
        </a>
    </div>
    
    <div class="overflow-x-auto p-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-purple-900/40 text-purple-300">
                    <th class="py-3 px-4 text-sm font-semibold">Almarhum/Almarhumah</th>
                    <th class="py-3 px-4 text-sm font-semibold">Lokasi Makam</th>
                    <th class="py-3 px-4 text-sm font-semibold">Wafat (Usia)</th>
                    <th class="py-3 px-4 text-sm font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-900/20">
                @forelse($deceaseds as $deceased)
                <tr class="hover:bg-purple-900/30 transition-colors">
                    <td class="py-3 px-4 text-sm text-purple-100">
                        <div class="flex items-center">
                            @if($deceased->photo)
                                <img src="{{ asset('storage/' . $deceased->photo) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover mr-3 border border-purple-500 shadow-sm">
                            @else
                                <div class="w-10 h-10 rounded-full bg-purple-900/50 text-purple-300 flex items-center justify-center font-bold mr-3 border border-purple-500/50">
                                    {{ substr($deceased->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-purple-100">{{ $deceased->name }}</p>
                                <p class="text-xs text-purple-400">{{ $deceased->gender ?? '-' }} &bull; Lahir: {{ $deceased->birth_date ? \Carbon\Carbon::parse($deceased->birth_date)->format('d/m/Y') : '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm text-purple-300">
                        <span class="font-medium">Blok {{ $deceased->block }}</span> - No. {{ $deceased->grave_number }}
                    </td>
                    <td class="py-3 px-4 text-sm text-purple-300">
                        {{ \Carbon\Carbon::parse($deceased->death_date)->format('d M Y') }}
                        @if($deceased->age_at_death)
                            <span class="text-xs text-purple-500 block">Usia: {{ $deceased->age_at_death }} tahun</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('admin.deceaseds.print', $deceased->id) }}" target="_blank" class="text-blue-400 hover:text-blue-300 font-medium" title="Cetak Dokumen">Cetak</a>
                            <span class="text-purple-900/50">|</span>
                            <a href="{{ route('admin.deceaseds.edit', $deceased->id) }}" class="text-purple-400 hover:text-purple-300 font-medium">Edit</a>
                            <span class="text-purple-900/50">|</span>
                            <form action="{{ route('admin.deceaseds.destroy', $deceased->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data almarhum ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-purple-400">
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-4xl mb-2 text-purple-500">📁</span>
                            <p>Belum ada data almarhum.</p>
                            <p class="text-sm mt-1">Klik tombol "Tambah Data" untuk memulai.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
