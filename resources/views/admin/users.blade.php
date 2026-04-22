@extends('layouts.admin')

@section('title', 'Daftar Pengguna - Admin Dashboard')
@section('header_title', 'Daftar Pengguna')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h3 class="font-bold text-gray-800 flex items-center">
            <span class="mr-2 text-indigo-500">👥</span>
            Semua Pengguna Terdaftar
        </h3>
        
        <!-- You can add a search bar or "Add User" button here later -->
    </div>
    
    <div class="overflow-x-auto p-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-200 text-gray-500">
                    <th class="py-3 px-4 text-sm font-semibold">Nama</th>
                    <th class="py-3 px-4 text-sm font-semibold">Email</th>
                    <th class="py-3 px-4 text-sm font-semibold">Peran</th>
                    <th class="py-3 px-4 text-sm font-semibold">Terdaftar Pada</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="py-3 px-4 text-sm text-gray-800 font-medium">{{ $user->name }}</td>
                    <td class="py-3 px-4 text-sm text-gray-600">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-sm">
                        @if($user->role === 'admin')
                            <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">Admin</span>
                        @else
                            <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">User</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-500">{{ $user->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <span class="text-4xl mb-2">📭</span>
                            <p>Belum ada pengguna terdaftar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
