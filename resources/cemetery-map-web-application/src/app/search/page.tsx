'use client';

import { useState } from 'react';
import Link from 'next/link';

type SearchResult = {
  id: number;
  fullName: string;
  birthDate: string | null;
  deathDate: string;
  age: number | null;
  plotNumber: string | null;
  blockName: string | null;
};

export default function SearchPage() {
  const [searchTerm, setSearchTerm] = useState('');
  const [results, setResults] = useState<SearchResult[]>([]);
  const [hasSearched, setHasSearched] = useState(false);
  const [loading, setLoading] = useState(false);

  const handleSearch = async (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!searchTerm.trim()) return;

    setLoading(true);
    setHasSearched(true);

    try {
      const res = await fetch(`/api/deceased?search=${encodeURIComponent(searchTerm)}`);
      const data = await res.json();
      
      const filtered = data.filter((person: SearchResult) =>
        person.fullName.toLowerCase().includes(searchTerm.toLowerCase()) ||
        person.plotNumber?.toLowerCase().includes(searchTerm.toLowerCase()) ||
        person.blockName?.toLowerCase().includes(searchTerm.toLowerCase())
      );

      setResults(filtered);
    } catch (error) {
      console.error('Error searching:', error);
      setResults([]);
    } finally {
      setLoading(false);
    }
  };

  const formatDate = (dateString: string | null) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    });
  };

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="max-w-4xl mx-auto">
        <div className="text-center mb-12">
          <div className="text-6xl mb-4">🔍</div>
          <h1 className="text-4xl font-bold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
            Pencarian Almarhum
          </h1>
          <p className="text-gray-400">
            Cari informasi almarhum berdasarkan nama, nomor plot, atau lokasi blok
          </p>
        </div>

        {/* Search Form */}
        <form onSubmit={handleSearch} className="memorial-card p-8 mb-8">
          <div className="flex flex-col md:flex-row gap-4">
            <div className="flex-grow">
              <input
                type="text"
                placeholder="Masukkan nama, nomor plot, atau blok..."
                value={searchTerm}
                onChange={(e) => setSearchTerm(e.target.value)}
                className="w-full px-6 py-4 bg-gray-800/50 border border-purple-900/40 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent text-lg"
                autoFocus
              />
            </div>
            <button
              type="submit"
              disabled={loading}
              className="px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white rounded-lg font-semibold shadow-lg hover:shadow-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed"
            >
              {loading ? 'Mencari...' : 'Cari'}
            </button>
          </div>

          <div className="mt-4 text-sm text-gray-500">
            💡 Tips: Anda bisa mencari dengan nama lengkap, nama depan, nomor plot (contoh: A-12), atau nama blok
          </div>
        </form>

        {/* Search Results */}
        {loading && (
          <div className="text-center py-12">
            <div className="text-6xl mb-4">⏳</div>
            <p className="text-gray-400">Mencari data...</p>
          </div>
        )}

        {!loading && hasSearched && (
          <>
            <div className="mb-6">
              <h2 className="text-xl font-semibold text-purple-300">
                {results.length > 0 
                  ? `Ditemukan ${results.length} hasil pencarian`
                  : 'Tidak ada hasil ditemukan'
                }
              </h2>
              {results.length === 0 && (
                <p className="text-gray-500 mt-2">
                  Coba gunakan kata kunci yang berbeda atau lebih umum
                </p>
              )}
            </div>

            {results.length > 0 && (
              <div className="space-y-4">
                {results.map((person) => (
                  <Link
                    key={person.id}
                    href={`/deceased/${person.id}`}
                    className="memorial-card p-6 flex items-start space-x-6 group hover:scale-[1.01] transition-all"
                  >
                    <div className="flex-shrink-0">
                      <div className="w-16 h-16 rounded-lg bg-gradient-to-br from-purple-900/50 to-purple-800/30 flex items-center justify-center text-3xl border border-purple-700">
                        🕊️
                      </div>
                    </div>

                    <div className="flex-grow">
                      <div className="flex items-start justify-between mb-2">
                        <h3 className="text-xl font-semibold text-purple-300 group-hover:text-purple-200 transition-colors">
                          {person.fullName}
                        </h3>
                        {person.plotNumber && (
                          <div className="text-xs px-3 py-1 bg-purple-900/40 text-purple-300 rounded-full">
                            {person.plotNumber}
                          </div>
                        )}
                      </div>

                      <div className="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm text-gray-400">
                        {person.birthDate && (
                          <div className="flex items-center space-x-2">
                            <span>🎂</span>
                            <span>Lahir: {formatDate(person.birthDate)}</span>
                          </div>
                        )}
                        <div className="flex items-center space-x-2">
                          <span>🕯️</span>
                          <span>Wafat: {formatDate(person.deathDate)}</span>
                        </div>
                        {person.age !== null && (
                          <div className="flex items-center space-x-2">
                            <span>📅</span>
                            <span>Usia: {person.age} tahun</span>
                          </div>
                        )}
                        {person.blockName && (
                          <div className="flex items-center space-x-2">
                            <span>📍</span>
                            <span>Blok: {person.blockName}</span>
                          </div>
                        )}
                      </div>

                      <div className="mt-3 pt-3 border-t border-purple-900/40">
                        <div className="text-purple-400 text-sm font-medium group-hover:text-purple-300 transition-colors flex items-center space-x-2">
                          <span>Lihat Detail Lengkap</span>
                          <span className="transform group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                      </div>
                    </div>
                  </Link>
                ))}
              </div>
            )}
          </>
        )}

        {/* Quick Links */}
        {!hasSearched && (
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <Link href="/deceased" className="memorial-card p-6 text-center group hover:scale-105 transition-transform">
              <div className="text-5xl mb-4">📖</div>
              <h3 className="text-xl font-semibold text-purple-300 mb-2 group-hover:text-purple-200">
                Lihat Semua Daftar
              </h3>
              <p className="text-gray-400 text-sm">
                Jelajahi daftar lengkap almarhum yang dimakamkan di taman makam
              </p>
            </Link>

            <Link href="/map" className="memorial-card p-6 text-center group hover:scale-105 transition-transform">
              <div className="text-5xl mb-4">🗺️</div>
              <h3 className="text-xl font-semibold text-purple-300 mb-2 group-hover:text-purple-200">
                Lihat Denah Makam
              </h3>
              <p className="text-gray-400 text-sm">
                Lihat denah visual untuk menemukan lokasi makam dengan mudah
              </p>
            </Link>
          </div>
        )}
      </div>
    </div>
  );
}
