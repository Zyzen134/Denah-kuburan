@extends('layouts.admin')

@section('title', 'Edit Data Almarhum - Admin Dashboard')
@section('header_title', 'Edit Data Almarhum')

@section('content')
<div class="bg-white rounded-lg shadow-sm overflow-hidden max-w-3xl">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
        <h3 class="font-bold text-gray-800 flex items-center">
            <span class="mr-2 text-indigo-500">✏️</span>
            Form Edit Data Almarhum
        </h3>
        
        <a href="{{ route('admin.deceaseds') }}" class="text-sm font-medium text-gray-500 hover:text-gray-700">
            Kembali
        </a>
    </div>
    
    <div class="p-6">
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm">
                <p class="font-medium mb-1">Ada kesalahan dalam pengisian form:</p>
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.deceaseds.update', $deceased->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Almarhum *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $deceased->name) }}" required 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Lokasi Makam: Blok -->
                <div>
                    <label for="block" class="block text-sm font-medium text-gray-700 mb-1">Blok Makam *</label>
                    <input type="text" name="block" id="block" value="{{ old('block', $deceased->block) }}" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                </div>

                <!-- Lokasi Makam: Nomor -->
                <div>
                    <label for="grave_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Makam *</label>
                    <input type="text" name="grave_number" id="grave_number" value="{{ old('grave_number', $deceased->grave_number) }}" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal Wafat -->
                <div>
                    <label for="death_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Wafat *</label>
                    <input type="date" name="death_date" id="death_date" value="{{ old('death_date', $deceased->death_date) }}" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                </div>

                <!-- Usia Wafat -->
                <div>
                    <label for="age_at_death" class="block text-sm font-medium text-gray-700 mb-1">Usia Saat Wafat (Tahun)</label>
                    <input type="number" name="age_at_death" id="age_at_death" value="{{ old('age_at_death', $deceased->age_at_death) }}" min="0" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tanggal Lahir -->
                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                    <input type="date" name="birth_date" id="birth_date" value="{{ old('birth_date', $deceased->birth_date) }}" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800">
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin *</label>
                    <select name="gender" id="gender" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800 bg-white">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('gender', $deceased->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $deceased->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <!-- Link Google Maps -->
            <div>
                <label for="google_maps_link" class="block text-sm font-medium text-gray-700 mb-1">Kode / Link Lokasi Google Maps (Opsional)</label>
                <textarea name="google_maps_link" id="google_maps_link" rows="3"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 text-gray-800"
                    placeholder='Contoh: <iframe src="https://www.google.com/maps/embed?..." ...></iframe>'>{{ old('google_maps_link', $deceased->google_maps_link) }}</textarea>
                <p class="text-xs text-gray-500 mt-1">Copy kode "Embed a map" (Sematkan Peta) dari Google Maps dan paste di sini.</p>
            </div>

            <!-- Upload Foto -->
            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto Baru (Opsional)</label>
                @if($deceased->photo)
                <div class="mb-3">
                    <p class="text-xs text-gray-500 mb-1">Foto saat ini:</p>
                    <img src="{{ asset('storage/' . $deceased->photo) }}" alt="Foto" class="w-20 h-20 rounded-lg object-cover border border-gray-300">
                </div>
                @endif
                <input type="file" name="photo" id="photo" accept="image/*" 
                    class="w-full text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md">
                <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, JPEG, PNG. Max: 2MB.</p>
            </div>

            <div class="pt-4 border-t border-gray-200 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-md font-medium shadow transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
