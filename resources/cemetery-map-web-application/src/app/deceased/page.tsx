'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';

type DeceasedPerson = {
  id: number;
  fullName: string;
  birthDate: string | null;
  deathDate: string;
  age: number | null;
  plotNumber: string | null;
  blockName: string | null;
};

export default function DeceasedPage() {
  const [deceased, setDeceased] = useState<DeceasedPerson[]>([]);
  const [loading, setLoading] = useState(true);
  const [searchTerm, setSearchTerm] = useState('');

  useEffect(() => {
    fetchDeceased();
  }, []);

  const fetchDeceased = async () => {
    try {
      const res = await fetch('/api/deceased');
      const data = await res.json();
      setDeceased(data);
    } catch (error) {
      console.error('Error fetching deceased:', error);
    } finally {
      setLoading(false);
    }
  };

  const filteredDeceased = deceased.filter((person) =>
    person.fullName.toLowerCase().includes(searchTerm.toLowerCase()) ||
    person.plotNumber?.toLowerCase().includes(searchTerm.toLowerCase()) ||
    person.blockName?.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const formatDate = (dateString: string | null) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    });
  };

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="text-6xl mb-4">⏳</div>
          <p className="text-gray-400">Memuat data almarhum...</p>
        </div>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="mb-8">
        <h1 className="text-4xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
          Daftar Almarhum
        </h1>
        <p className="text-gray-400">Catatan dan kenangan mereka yang telah berpulang</p>
      </div>

      {/* Search Bar */}
      <div className="memorial-card p-6 mb-6">
        <div className="relative">
          <input
            type="text"
            placeholder="Cari berdasarkan nama, nomor plot, atau blok..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full px-4 py-3 pl-12 bg-gray-800/50 border border-purple-900/40 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
          />
          <div className="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-xl">
            🔍
          </div>
        </div>
        <p className="text-sm text-gray-500 mt-2">
          Ditemukan {filteredDeceased.length} dari {deceased.length} data
        </p>
      </div>

      {/* Deceased List */}
      {filteredDeceased.length === 0 ? (
        <div className="memorial-card p-12 text-center">
          <div className="text-6xl mb-4">📭</div>
          <h3 className="text-xl text-gray-300 mb-2">Tidak ada data ditemukan</h3>
          <p className="text-gray-500">Coba ubah kata kunci pencarian Anda</p>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredDeceased.map((person) => (
            <Link
              key={person.id}
              href={`/deceased/${person.id}`}
              className="memorial-card p-6 group"
            >
              <div className="flex items-start justify-between mb-4">
                <div className="text-5xl">🕊️</div>
                <div className="text-xs px-2 py-1 bg-purple-900/40 text-purple-300 rounded">
                  {person.plotNumber || 'N/A'}
                </div>
              </div>

              <h3 className="text-xl font-semibold text-purple-300 mb-3 group-hover:text-purple-200 transition-colors">
                {person.fullName}
              </h3>

              <div className="space-y-2 text-sm text-gray-400">
                {person.birthDate && (
                  <div className="flex items-center space-x-2">
                    <span>🎂</span>
                    <span>{formatDate(person.birthDate)}</span>
                  </div>
                )}
                <div className="flex items-center space-x-2">
                  <span>🕯️</span>
                  <span>{formatDate(person.deathDate)}</span>
                </div>
                {person.age !== null && (
                  <div className="flex items-center space-x-2">
                    <span>📅</span>
                    <span>{person.age} tahun</span>
                  </div>
                )}
                {person.blockName && (
                  <div className="flex items-center space-x-2">
                    <span>📍</span>
                    <span>{person.blockName}</span>
                  </div>
                )}
              </div>

              <div className="mt-4 pt-4 border-t border-purple-900/40">
                <div className="text-purple-400 text-sm font-medium group-hover:text-purple-300 transition-colors flex items-center space-x-2">
                  <span>Lihat Detail</span>
                  <span className="transform group-hover:translate-x-1 transition-transform">→</span>
                </div>
              </div>
            </Link>
          ))}
        </div>
      )}
    </div>
  );
}
