export default function Footer() {
  return (
    <footer className="bg-gradient-memorial border-t border-purple-900/40 mt-16">
      <div className="container mx-auto px-4 py-8">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          <div>
            <h3 className="text-lg font-semibold text-purple-300 mb-4 flex items-center space-x-2">
              <span>🕊️</span>
              <span>Taman Makam Abadi</span>
            </h3>
            <p className="text-gray-400 text-sm leading-relaxed">
              Tempat peristirahatan terakhir yang tenang dan damai. 
              Kami menjaga kenangan indah yang tak terlupakan.
            </p>
          </div>

          <div>
            <h3 className="text-lg font-semibold text-purple-300 mb-4">Kontak</h3>
            <ul className="space-y-2 text-sm text-gray-400">
              <li className="flex items-center space-x-2">
                <span>📍</span>
                <span>Jl. Kenangan Abadi No. 123</span>
              </li>
              <li className="flex items-center space-x-2">
                <span>📞</span>
                <span>(021) 1234-5678</span>
              </li>
              <li className="flex items-center space-x-2">
                <span>✉️</span>
                <span>info@tamammakamabadi.com</span>
              </li>
            </ul>
          </div>

          <div>
            <h3 className="text-lg font-semibold text-purple-300 mb-4">Jam Operasional</h3>
            <ul className="space-y-2 text-sm text-gray-400">
              <li className="flex justify-between">
                <span>Senin - Jumat</span>
                <span>08:00 - 16:00</span>
              </li>
              <li className="flex justify-between">
                <span>Sabtu - Minggu</span>
                <span>08:00 - 14:00</span>
              </li>
              <li className="flex justify-between">
                <span>Hari Libur</span>
                <span>Tutup</span>
              </li>
            </ul>
          </div>
        </div>

        <div className="mt-8 pt-6 border-t border-purple-900/40 text-center">
          <p className="text-gray-500 text-sm">
            &copy; {new Date().getFullYear()} Taman Makam Abadi. Semua hak cipta dilindungi.
          </p>
          <p className="text-gray-600 text-xs mt-2 italic">
            &ldquo;Sesungguhnya kita adalah milik Allah dan kepada-Nya lah kita kembali&rdquo;
          </p>
        </div>
      </div>
    </footer>
  );
}
