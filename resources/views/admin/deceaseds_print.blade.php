<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Data Almarhum - {{ $deceased->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .no-print {
                display: none !important;
            }
            .page-break {
                page-break-before: always;
            }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 font-sans p-8">

    <div class="max-w-3xl mx-auto bg-white p-10 border border-gray-300 shadow-sm relative">
        
        <!-- Header -->
        <div class="text-center border-b-2 border-gray-800 pb-6 mb-8">
            <h1 class="text-3xl font-bold uppercase tracking-wider mb-2">Taman Makam Abadi</h1>
            <p class="text-gray-600 text-lg">Dokumen Data Almarhum/Almarhumah</p>
        </div>

        <!-- Content -->
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <!-- Photo -->
            <div class="w-full md:w-1/3 flex flex-col items-center">
                <div class="w-48 h-48 border-4 border-gray-200 shadow-md mb-4 overflow-hidden rounded-lg bg-gray-50 flex items-center justify-center">
                    @if($deceased->photo)
                        <img src="{{ asset('storage/' . $deceased->photo) }}" alt="Foto {{ $deceased->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-gray-400 text-5xl">👤</span>
                    @endif
                </div>
                <div class="text-center w-full bg-gray-100 py-2 rounded border border-gray-200">
                    <p class="font-bold text-lg text-gray-800">No. Makam</p>
                    <p class="text-2xl font-mono text-indigo-700 tracking-widest">{{ $deceased->grave_number }}</p>
                </div>
            </div>

            <!-- Details -->
            <div class="w-full md:w-2/3">
                <h2 class="text-2xl font-bold text-gray-800 border-b border-gray-200 pb-2 mb-6">Informasi Almarhum</h2>
                
                <table class="w-full text-left border-collapse">
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600 w-1/3">Nama Lengkap</td>
                            <td class="py-3 text-gray-900 font-medium text-lg">: {{ $deceased->name }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600">Jenis Kelamin</td>
                            <td class="py-3 text-gray-900">: {{ $deceased->gender }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600">Tanggal Lahir</td>
                            <td class="py-3 text-gray-900">: {{ $deceased->birth_date ? \Carbon\Carbon::parse($deceased->birth_date)->format('d F Y') : '-' }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600">Tanggal Wafat</td>
                            <td class="py-3 text-gray-900">: {{ \Carbon\Carbon::parse($deceased->death_date)->format('d F Y') }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600">Usia saat Wafat</td>
                            <td class="py-3 text-gray-900">: {{ $deceased->age_at_death ? $deceased->age_at_death . ' Tahun' : '-' }}</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-3 pr-4 font-semibold text-gray-600">Lokasi Blok</td>
                            <td class="py-3 text-gray-900">: Blok {{ $deceased->block }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-12 text-right">
                    <p class="text-gray-500 text-sm mb-1">Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
                    <p class="text-gray-500 text-sm">Oleh: {{ Auth::user()->name ?? 'Administrator' }}</p>
                </div>
            </div>
        </div>

        <!-- Print Buttons -->
        <div class="mt-10 pt-6 border-t border-gray-200 flex justify-center space-x-4 no-print">
            <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-6 rounded shadow transition-colors flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Cetak Dokumen
            </button>
            <button onclick="window.close()" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-6 rounded shadow transition-colors">
                Tutup
            </button>
        </div>
    </div>

    <script>
        // Automatically open print dialog when page loads
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
