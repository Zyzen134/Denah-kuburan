@extends('layouts.admin')

@section('title', 'Data Almarhum - Admin Dashboard')
@section('header_title', 'Data Almarhum')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h3 class="font-bold text-gray-800 flex items-center">
            <span class="mr-2 text-green-500">📖</span>
            Semua Data Almarhum
        </h3>
        
        <a href="{{ route('admin.deceaseds.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded text-sm font-medium transition-colors shadow-sm flex items-center">
            <span class="mr-1">+</span> Tambah Data
        </a>
    </div>
    
    <div class="overflow-x-auto p-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-gray-500">
                    <th class="py-3 px-4 text-sm font-semibold">Almarhum/Almarhumah</th>
                    <th class="py-3 px-4 text-sm font-semibold">Lokasi Makam</th>
                    <th class="py-3 px-4 text-sm font-semibold">Wafat (Usia)</th>
                    <th class="py-3 px-4 text-sm font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($deceaseds as $deceased)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 text-sm text-gray-800">
                        <div class="flex items-center">
                            @if($deceased->photo)
                                <img src="{{ asset('storage/' . $deceased->photo) }}" alt="Foto" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200 shadow-sm">
                            @else
                                <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-500 flex items-center justify-center font-bold mr-3 border border-indigo-200">
                                    {{ substr($deceased->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <p class="font-medium text-gray-800">{{ $deceased->name }}</p>
                                <p class="text-xs text-gray-500">{{ $deceased->gender ?? '-' }} &bull; Lahir: {{ $deceased->birth_date ? \Carbon\Carbon::parse($deceased->birth_date)->format('d/m/Y') : '-' }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">
                        <span class="font-medium">Blok {{ $deceased->block }}</span> - No. {{ $deceased->grave_number }}
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">
                        {{ \Carbon\Carbon::parse($deceased->death_date)->format('d M Y') }}
                        @if($deceased->age_at_death)
                            <span class="text-xs text-gray-400 block">Usia: {{ $deceased->age_at_death }} tahun</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm text-right">
                        <div class="flex justify-end items-center space-x-2">
                            <a href="{{ route('admin.deceaseds.edit', $deceased->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                            
                            <form action="{{ route('admin.deceaseds.destroy', $deceased->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data almarhum ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-4xl mb-2">📁</span>
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
