'use client';

import { useState } from 'react';

export default function AdminPage() {
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState('');

  const handleSeed = async () => {
    if (!confirm('Apakah Anda yakin ingin mengisi database dengan data sample? Ini akan menghapus semua data yang ada.')) {
      return;
    }

    setLoading(true);
    setMessage('');

    try {
      const res = await fetch('/api/seed', {
        method: 'POST',
      });

      const data = await res.json();

      if (res.ok) {
        setMessage(`✅ Berhasil! ${data.blocks} blok, ${data.graves} makam, dan ${data.deceased} data almarhum telah dibuat.`);
      } else {
        setMessage('❌ Gagal: ' + (data.error || 'Unknown error'));
      }
    } catch (error) {
      setMessage('❌ Error: ' + (error instanceof Error ? error.message : 'Unknown error'));
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-2xl mx-auto">
        <div className="memorial-card p-8">
          <h1 className="text-3xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
            Admin Panel
          </h1>
          <p className="text-gray-400 mb-8">
            Halaman untuk mengelola database aplikasi denah kuburan
          </p>

          <div className="bg-yellow-900/20 border border-yellow-600/40 rounded-lg p-4 mb-6">
            <div className="flex items-start space-x-3">
              <div className="text-2xl">⚠️</div>
              <div>
                <h3 className="font-semibold text-yellow-300 mb-1">Peringatan</h3>
                <p className="text-sm text-yellow-200/80">
                  Mengisi database dengan data sample akan menghapus semua data yang ada saat ini.
                  Pastikan Anda telah membuat backup jika diperlukan.
                </p>
              </div>
            </div>
          </div>

          <button
            onClick={handleSeed}
            disabled={loading}
            className="w-full px-6 py-4 bg-purple-700 hover:bg-purple-600 text-white rounded-lg font-semibold transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
          >
            {loading ? 'Memproses...' : '🌱 Isi Database dengan Data Sample'}
          </button>

          {message && (
            <div className={`mt-6 p-4 rounded-lg ${
              message.startsWith('✅') 
                ? 'bg-green-900/20 border border-green-600/40 text-green-300' 
                : 'bg-red-900/20 border border-red-600/40 text-red-300'
            }`}>
              {message}
            </div>
          )}

          <div className="mt-8 pt-8 border-t border-purple-900/40">
            <h3 className="font-semibold text-purple-300 mb-3">Data Sample yang akan dibuat:</h3>
            <ul className="space-y-2 text-sm text-gray-400">
              <li>✓ 3 Blok makam (A, B, C)</li>
              <li>✓ 120 plot makam dengan berbagai status</li>
              <li>✓ 6 data almarhum lengkap dengan biografi</li>
              <li>✓ Data keluarga/kontak person</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
}
