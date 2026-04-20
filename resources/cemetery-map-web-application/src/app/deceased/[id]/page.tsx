import { notFound } from 'next/navigation';
import Link from 'next/link';

type DeceasedDetail = {
  id: number;
  fullName: string;
  birthDate: string | null;
  deathDate: string;
  age: number | null;
  biography: string | null;
  photo: string | null;
  plotNumber: string | null;
  blockName: string | null;
  row: number | null;
  column: number | null;
  relatives: Array<{
    id: number;
    name: string;
    relationship: string;
    phone: string | null;
    email: string | null;
  }>;
};

async function getDeceasedDetails(id: string): Promise<DeceasedDetail | null> {
  try {
    const baseUrl = process.env.NEXT_PUBLIC_BASE_URL || 'http://localhost:3000';
    const res = await fetch(`${baseUrl}/api/deceased/${id}`, {
      cache: 'no-store',
    });

    if (!res.ok) {
      return null;
    }

    return res.json();
  } catch (error) {
    console.error('Error fetching deceased details:', error);
    return null;
  }
}

export default async function DeceasedDetailPage({
  params,
}: {
  params: Promise<{ id: string }>;
}) {
  const { id } = await params;
  const deceased = await getDeceasedDetails(id);

  if (!deceased) {
    notFound();
  }

  const formatDate = (dateString: string | null) => {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    });
  };

  const calculateDaysSince = (dateString: string) => {
    const date = new Date(dateString);
    const now = new Date();
    const diff = now.getTime() - date.getTime();
    const days = Math.floor(diff / (1000 * 60 * 60 * 24));
    return days;
  };

  const daysSince = calculateDaysSince(deceased.deathDate);

  return (
    <div className="container mx-auto px-4 py-8">
      <Link
        href="/deceased"
        className="inline-flex items-center space-x-2 text-purple-400 hover:text-purple-300 mb-6 transition-colors"
      >
        <span>←</span>
        <span>Kembali ke Daftar</span>
      </Link>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main Info */}
        <div className="lg:col-span-2 space-y-6">
          {/* Header Card */}
          <div className="memorial-card p-8">
            <div className="flex items-start space-x-6">
              <div className="flex-shrink-0">
                {deceased.photo ? (
                  <img
                    src={deceased.photo}
                    alt={deceased.fullName}
                    className="w-32 h-32 rounded-lg object-cover border-2 border-purple-700"
                  />
                ) : (
                  <div className="w-32 h-32 rounded-lg bg-gradient-to-br from-purple-900/50 to-purple-800/30 flex items-center justify-center text-6xl border-2 border-purple-700">
                    🕊️
                  </div>
                )}
              </div>

              <div className="flex-grow">
                <h1 className="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-200 to-amber-200 mb-2">
                  {deceased.fullName}
                </h1>
                
                <div className="space-y-2 text-gray-300">
                  {deceased.birthDate && (
                    <div className="flex items-center space-x-2">
                      <span className="text-gray-500">🎂 Lahir:</span>
                      <span>{formatDate(deceased.birthDate)}</span>
                    </div>
                  )}
                  <div className="flex items-center space-x-2">
                    <span className="text-gray-500">🕯️ Wafat:</span>
                    <span>{formatDate(deceased.deathDate)}</span>
                  </div>
                  {deceased.age !== null && (
                    <div className="flex items-center space-x-2">
                      <span className="text-gray-500">📅 Usia:</span>
                      <span>{deceased.age} tahun</span>
                    </div>
                  )}
                  <div className="flex items-center space-x-2 text-sm text-gray-400 italic">
                    <span>⏰</span>
                    <span>{daysSince} hari yang lalu</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Biography */}
          {deceased.biography && (
            <div className="memorial-card p-6">
              <h2 className="text-2xl font-semibold text-purple-300 mb-4 flex items-center space-x-2">
                <span>📖</span>
                <span>Biografi</span>
              </h2>
              <div className="text-gray-300 leading-relaxed whitespace-pre-wrap">
                {deceased.biography}
              </div>
            </div>
          )}

          {/* Relatives */}
          {deceased.relatives && deceased.relatives.length > 0 && (
            <div className="memorial-card p-6">
              <h2 className="text-2xl font-semibold text-purple-300 mb-4 flex items-center space-x-2">
                <span>👥</span>
                <span>Keluarga</span>
              </h2>
              <div className="space-y-4">
                {deceased.relatives.map((relative) => (
                  <div key={relative.id} className="bg-gray-800/30 rounded-lg p-4 border border-purple-900/30">
                    <div className="flex items-start justify-between">
                      <div>
                        <h3 className="font-semibold text-purple-300">{relative.name}</h3>
                        <p className="text-sm text-gray-400">{relative.relationship}</p>
                      </div>
                    </div>
                    {(relative.phone || relative.email) && (
                      <div className="mt-3 pt-3 border-t border-purple-900/30 space-y-1 text-sm">
                        {relative.phone && (
                          <div className="flex items-center space-x-2 text-gray-400">
                            <span>📞</span>
                            <a href={`tel:${relative.phone}`} className="hover:text-purple-300">
                              {relative.phone}
                            </a>
                          </div>
                        )}
                        {relative.email && (
                          <div className="flex items-center space-x-2 text-gray-400">
                            <span>✉️</span>
                            <a href={`mailto:${relative.email}`} className="hover:text-purple-300">
                              {relative.email}
                            </a>
                          </div>
                        )}
                      </div>
                    )}
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>

        {/* Sidebar - Location Info */}
        <div className="lg:col-span-1">
          <div className="memorial-card p-6 sticky top-24">
            <h2 className="text-xl font-semibold text-purple-300 mb-4 flex items-center space-x-2">
              <span>📍</span>
              <span>Lokasi Makam</span>
            </h2>

            <div className="space-y-4">
              {deceased.blockName && (
                <div>
                  <div className="text-sm text-gray-500 mb-1">Blok</div>
                  <div className="text-lg font-semibold text-purple-300">{deceased.blockName}</div>
                </div>
              )}

              {deceased.plotNumber && (
                <div>
                  <div className="text-sm text-gray-500 mb-1">Nomor Plot</div>
                  <div className="text-lg font-semibold text-purple-300">{deceased.plotNumber}</div>
                </div>
              )}

              {deceased.row !== null && deceased.column !== null && (
                <div>
                  <div className="text-sm text-gray-500 mb-1">Posisi</div>
                  <div className="text-gray-300">
                    Baris {deceased.row}, Kolom {deceased.column}
                  </div>
                </div>
              )}

              <Link
                href="/map"
                className="block mt-6 px-4 py-3 bg-purple-700 hover:bg-purple-600 text-white rounded-lg text-center font-semibold transition-colors"
              >
                Lihat di Denah
              </Link>
            </div>

            {/* Prayer Section */}
            <div className="mt-6 pt-6 border-t border-purple-900/40">
              <div className="text-center">
                <div className="text-4xl mb-3">🤲</div>
                <p className="text-sm text-gray-400 italic leading-relaxed">
                  Semoga almarhum/almarhumah diterima di sisi-Nya dan diampuni segala dosanya
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
