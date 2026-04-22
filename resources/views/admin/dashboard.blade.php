@extends('layouts.admin')

@section('title', 'Admin Dashboard - Taman Makam Abadi')
@section('header_title', 'Dashboard Overview')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-500 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">Total Pengguna</p>
                <p class="text-3xl font-semibold text-gray-800">{{ count($users) }}</p>
            </div>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-lg shadow-sm p-6 border-l-4 border-green-500">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-500 mr-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            </div>
            <div>
                <p class="mb-2 text-sm font-medium text-gray-600">Data Almarhum</p>
                <p class="text-3xl font-semibold text-gray-800">{{ count($deceaseds) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Daftar User -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 flex items-center">
                <span class="mr-2 text-indigo-500">👥</span>
                Pengguna Terdaftar Terbaru
            </h3>
        </div>
        
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500">
                        <th class="py-3 px-2 text-sm font-semibold">Nama</th>
                        <th class="py-3 px-2 text-sm font-semibold">Email</th>
                        <th class="py-3 px-2 text-sm font-semibold">Peran</th>
                        <th class="py-3 px-2 text-sm font-semibold">Terdaftar</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($users->take(5) as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-2 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                        <td class="py-3 px-2 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="py-3 px-2 text-sm">
                            @if($user->role === 'admin')
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Admin</span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">User</span>
                            @endif
                        </td>
                        <td class="py-3 px-2 text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-4 text-center text-gray-500">Belum ada pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if(count($users) > 5)
            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-indigo-600 hover:underline font-medium">Lihat Semua Pengguna</a>
            </div>
            @endif
        </div>
    </div>

    <!-- Daftar Almarhum -->
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
            <h3 class="font-bold text-gray-800 flex items-center">
                <span class="mr-2 text-green-500">📖</span>
                Data Almarhum Terbaru
            </h3>
        </div>
        
        <div class="overflow-x-auto p-4">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-200 text-gray-500">
                        <th class="py-3 px-2 text-sm font-semibold">Nama</th>
                        <th class="py-3 px-2 text-sm font-semibold">Blok/Makam</th>
                        <th class="py-3 px-2 text-sm font-semibold">Wafat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($deceaseds->take(5) as $deceased)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-2 text-sm text-gray-800 font-medium">{{ $deceased->name }}</td>
                        <td class="py-3 px-2 text-sm text-gray-600">Blok {{ $deceased->block }} - {{ $deceased->grave_number }}</td>
                        <td class="py-3 px-2 text-sm text-gray-500">{{ \Carbon\Carbon::parse($deceased->death_date)->format('d M Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-8 text-center text-gray-500">
                            <div class="flex flex-col items-center justify-center">
                                <span class="text-4xl mb-2">📁</span>
                                <p>Belum ada data almarhum.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @if(count($deceaseds) > 5)
            <div class="mt-4 text-center">
                <a href="#" class="text-sm text-green-600 hover:underline font-medium">Lihat Semua Data</a>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
