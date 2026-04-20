'use client';

import Link from 'next/link';
import { usePathname } from 'next/navigation';

export default function Header() {
  const pathname = usePathname();

  const navItems = [
    { href: '/', label: 'Beranda', icon: '🏛️' },
    { href: '/map', label: 'Denah Makam', icon: '🗺️' },
    { href: '/deceased', label: 'Daftar Almarhum', icon: '📖' },
    { href: '/search', label: 'Pencarian', icon: '🔍' },
  ];

  return (
    <header className="bg-gradient-memorial border-b border-purple-900/40 shadow-2xl sticky top-0 z-50 backdrop-blur-sm">
      <div className="container mx-auto px-4">
        <div className="flex items-center justify-between py-4">
          <Link href="/" className="flex items-center space-x-3 group">
            <div className="text-4xl transform group-hover:scale-110 transition-transform">🕊️</div>
            <div>
              <h1 className="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-300 via-purple-200 to-amber-200 text-shadow-soft">
                Taman Makam Abadi
              </h1>
              <p className="text-sm text-gray-400 italic">Mengenang dengan Kasih</p>
            </div>
          </Link>

          <nav className="hidden md:flex space-x-1">
            {navItems.map((item) => (
              <Link
                key={item.href}
                href={item.href}
                className={`px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 ${
                  pathname === item.href
                    ? 'bg-purple-700/50 text-white shadow-lg'
                    : 'text-gray-300 hover:bg-purple-900/30 hover:text-white'
                }`}
              >
                <span>{item.icon}</span>
                <span className="font-medium">{item.label}</span>
              </Link>
            ))}
          </nav>

          <div className="md:hidden">
            <button className="text-gray-300 hover:text-white p-2">
              <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </button>
          </div>
        </div>

        {/* Mobile Menu */}
        <nav className="md:hidden pb-4 space-y-1">
          {navItems.map((item) => (
            <Link
              key={item.href}
              href={item.href}
              className={`block px-4 py-2 rounded-lg transition-all duration-200 flex items-center space-x-2 ${
                pathname === item.href
                  ? 'bg-purple-700/50 text-white'
                  : 'text-gray-300 hover:bg-purple-900/30 hover:text-white'
              }`}
            >
              <span>{item.icon}</span>
              <span>{item.label}</span>
            </Link>
          ))}
        </nav>
      </div>
    </header>
  );
}
