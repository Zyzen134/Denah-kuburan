@extends('layouts.admin')

@section('title', 'Daftar Pengguna - Admin Dashboard')
@section('header_title', 'Daftar Pengguna')

@section('content')
<div class="memorial-card rounded-lg overflow-hidden">
    <div class="px-6 py-4 border-b border-purple-900/40 bg-purple-900/20 flex items-center justify-between">
        <h3 class="font-bold text-purple-100 flex items-center">
            <span class="mr-2 text-purple-400">👥</span>
            Semua Pengguna Terdaftar
        </h3>
        
        <!-- You can add a search bar or "Add User" button here later -->
    </div>
    
    <div class="overflow-x-auto p-4">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-purple-900/40 text-purple-300">
                    <th class="py-3 px-4 text-sm font-semibold">Nama</th>
                    <th class="py-3 px-4 text-sm font-semibold">Email</th>
                    <th class="py-3 px-4 text-sm font-semibold">Peran</th>
                    <th class="py-3 px-4 text-sm font-semibold">Terdaftar Pada</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-900/20">
                @forelse($users as $user)
                <tr class="hover:bg-purple-900/30 transition-colors">
                    <td class="py-3 px-4 text-sm text-purple-100 font-medium">{{ $user->name }}</td>
                    <td class="py-3 px-4 text-sm text-purple-300">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-sm">
                        @if($user->role === 'admin')
                            <span class="px-2 py-1 bg-red-900/50 text-red-200 border border-red-800 rounded-full text-xs font-semibold">Admin</span>
                        @else
                            <span class="px-2 py-1 bg-purple-900/50 text-purple-200 border border-purple-800 rounded-full text-xs font-semibold">User</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 text-sm text-purple-400">{{ $user->created_at->format('d M Y, H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-purple-400">
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
