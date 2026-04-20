import Link from 'next/link';

export default function Home() {
  const features = [
    {
      icon: '🗺️',
      title: 'Denah Interaktif',
      description: 'Lihat denah kuburan secara visual dengan grid interaktif untuk memudahkan pencarian lokasi',
    },
    {
      icon: '🔍',
      title: 'Pencarian Cepat',
      description: 'Cari data almarhum berdasarkan nama, tanggal, atau lokasi dengan sistem pencarian yang canggih',
    },
    {
      icon: '📖',
      title: 'Database Lengkap',
      description: 'Simpan informasi lengkap termasuk biografi, foto, dan data keluarga almarhum',
    },
    {
      icon: '📊',
      title: 'Manajemen Blok',
      description: 'Kelola area pemakaman dengan sistem blok yang terorganisir dan mudah dikelola',
    },
  ];

  const stats = [
    { label: 'Total Blok', value: '12', icon: '📦' },
    { label: 'Kapasitas', value: '500+', icon: '🏛️' },
    { label: 'Terisi', value: '234', icon: '✅' },
    { label: 'Tersedia', value: '266', icon: '⭕' },
  ];

  return (
    <div className="min-h-screen">
      {/* Hero Section */}
      <section className="relative py-20 overflow-hidden">
        <div className="absolute inset-0 bg-gradient-to-b from-purple-900/20 to-transparent"></div>
        <div className="container mx-auto px-4 relative z-10">
          <div className="text-center max-w-4xl mx-auto">
            <h1 className="text-5xl md:text-6xl font-bold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-purple-200 via-purple-300 to-amber-200 text-shadow-soft leading-tight">
              Taman Makam Abadi
            </h1>
            <p className="text-xl md:text-2xl text-gray-300 mb-4 leading-relaxed">
              Mengelola dan Mengenang dengan Penuh Kasih Sayang
            </p>
            <p className="text-lg text-gray-400 mb-10 italic">
              Sistem informasi digital untuk memudahkan pengelolaan dan pencarian lokasi makam
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                href="/map"
                className="px-8 py-4 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-500 hover:to-purple-600 text-white rounded-lg font-semibold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2"
              >
                <span>🗺️</span>
                <span>Lihat Denah Makam</span>
              </Link>
              <Link
                href="/search"
                className="px-8 py-4 bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-white rounded-lg font-semibold shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200 flex items-center justify-center space-x-2"
              >
                <span>🔍</span>
                <span>Cari Almarhum</span>
              </Link>
            </div>
          </div>
        </div>
      </section>

      {/* Stats Section */}
      <section className="py-12 bg-gradient-memorial">
        <div className="container mx-auto px-4">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
            {stats.map((stat, index) => (
              <div key={index} className="memorial-card p-6 text-center transform hover:scale-105 transition-transform">
                <div className="text-4xl mb-3">{stat.icon}</div>
                <div className="text-3xl font-bold text-purple-300 mb-2">{stat.value}</div>
                <div className="text-gray-400 text-sm">{stat.label}</div>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* Features Section */}
      <section className="py-16">
        <div className="container mx-auto px-4">
          <h2 className="text-4xl font-bold text-center mb-4 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
            Fitur Unggulan
          </h2>
          <p className="text-center text-gray-400 mb-12 max-w-2xl mx-auto">
            Sistem modern untuk memudahkan pengelolaan dan pencarian informasi makam
          </p>
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            {features.map((feature, index) => (
              <div key={index} className="memorial-card p-6 transform hover:scale-105 transition-all">
                <div className="text-5xl mb-4">{feature.icon}</div>
                <h3 className="text-xl font-semibold text-purple-300 mb-3">{feature.title}</h3>
                <p className="text-gray-400 leading-relaxed">{feature.description}</p>
              </div>
            ))}
          </div>
        </div>
      </section>

      {/* CTA Section */}
      <section className="py-16 bg-gradient-memorial">
        <div className="container mx-auto px-4">
          <div className="memorial-card p-12 text-center max-w-3xl mx-auto">
            <h2 className="text-3xl font-bold text-purple-300 mb-4">
              Butuh Bantuan?
            </h2>
            <p className="text-gray-300 mb-8 leading-relaxed">
              Tim kami siap membantu Anda dalam mencari informasi makam atau proses pendaftaran. 
              Hubungi kami untuk informasi lebih lanjut.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a
                href="tel:02112345678"
                className="px-6 py-3 bg-purple-700 hover:bg-purple-600 text-white rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2"
              >
                <span>📞</span>
                <span>(021) 1234-5678</span>
              </a>
              <a
                href="mailto:info@tamammakamabadi.com"
                className="px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-semibold transition-colors flex items-center justify-center space-x-2"
              >
                <span>✉️</span>
                <span>Email Kami</span>
              </a>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
}
