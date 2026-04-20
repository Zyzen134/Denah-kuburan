'use client';

import { useEffect, useState } from 'react';
import Link from 'next/link';

type Block = {
  id: number;
  name: string;
  description: string | null;
  capacity: number;
};

type Grave = {
  id: number;
  blockId: number;
  plotNumber: string;
  row: number;
  column: number;
  status: string;
  blockName: string | null;
  deceasedName: string | null;
  deceasedId: number | null;
};

export default function MapPage() {
  const [blocks, setBlocks] = useState<Block[]>([]);
  const [selectedBlock, setSelectedBlock] = useState<Block | null>(null);
  const [graves, setGraves] = useState<Grave[]>([]);
  const [loading, setLoading] = useState(true);
  const [selectedGrave, setSelectedGrave] = useState<Grave | null>(null);

  useEffect(() => {
    fetchBlocks();
  }, []);

  useEffect(() => {
    if (selectedBlock) {
      fetchGraves(selectedBlock.id);
    }
  }, [selectedBlock]);

  const fetchBlocks = async () => {
    try {
      const res = await fetch('/api/blocks');
      const data = await res.json();
      setBlocks(data);
      if (data.length > 0) {
        setSelectedBlock(data[0]);
      }
    } catch (error) {
      console.error('Error fetching blocks:', error);
    } finally {
      setLoading(false);
    }
  };

  const fetchGraves = async (blockId: number) => {
    try {
      const res = await fetch(`/api/graves?blockId=${blockId}`);
      const data = await res.json();
      setGraves(data);
    } catch (error) {
      console.error('Error fetching graves:', error);
    }
  };

  const getGridDimensions = () => {
    if (graves.length === 0) return { maxRow: 0, maxCol: 0 };
    const maxRow = Math.max(...graves.map(g => g.row));
    const maxCol = Math.max(...graves.map(g => g.column));
    return { maxRow, maxCol };
  };

  const { maxRow, maxCol } = getGridDimensions();

  const renderGrid = () => {
    const grid = [];
    for (let row = 1; row <= maxRow; row++) {
      const rowGraves = [];
      for (let col = 1; col <= maxCol; col++) {
        const grave = graves.find(g => g.row === row && g.column === col);
        if (grave) {
          rowGraves.push(
            <div
              key={`${row}-${col}`}
              className={`grave-plot ${grave.status} aspect-square rounded flex flex-col items-center justify-center p-2 relative group`}
              onClick={() => setSelectedGrave(grave)}
            >
              <div className="text-xs font-mono text-center">{grave.plotNumber}</div>
              {grave.deceasedName && (
                <div className="text-[10px] text-center mt-1 line-clamp-2">{grave.deceasedName}</div>
              )}
              {grave.status === 'occupied' && <div className="absolute top-1 right-1">🕯️</div>}
              {grave.status === 'reserved' && <div className="absolute top-1 right-1">⏳</div>}
              
              {/* Tooltip */}
              <div className="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 px-3 py-2 bg-gray-900 text-white text-xs rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap z-10">
                {grave.plotNumber}
                {grave.deceasedName && ` - ${grave.deceasedName}`}
              </div>
            </div>
          );
        } else {
          rowGraves.push(
            <div
              key={`${row}-${col}`}
              className="aspect-square border border-dashed border-gray-700/30 rounded"
            ></div>
          );
        }
      }
      grid.push(
        <div key={row} className="grid gap-2" style={{ gridTemplateColumns: `repeat(${maxCol}, minmax(0, 1fr))` }}>
          {rowGraves}
        </div>
      );
    }
    return grid;
  };

  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="text-6xl mb-4">⏳</div>
          <p className="text-gray-400">Memuat denah makam...</p>
        </div>
      </div>
    );
  }

  return (
    <div className="container mx-auto px-4 py-8">
      <div className="mb-8">
        <h1 className="text-4xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-purple-300 to-amber-200">
          Denah Makam
        </h1>
        <p className="text-gray-400">Pilih blok untuk melihat denah makam secara detail</p>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
        {/* Sidebar - Block Selection */}
        <div className="lg:col-span-1">
          <div className="memorial-card p-4 sticky top-24">
            <h2 className="text-xl font-semibold text-purple-300 mb-4 flex items-center space-x-2">
              <span>📦</span>
              <span>Pilih Blok</span>
            </h2>
            <div className="space-y-2">
              {blocks.map((block) => (
                <button
                  key={block.id}
                  onClick={() => setSelectedBlock(block)}
                  className={`w-full text-left px-4 py-3 rounded-lg transition-all ${
                    selectedBlock?.id === block.id
                      ? 'bg-purple-700 text-white shadow-lg'
                      : 'bg-gray-800/50 text-gray-300 hover:bg-gray-700/60'
                  }`}
                >
                  <div className="font-semibold">{block.name}</div>
                  {block.description && (
                    <div className="text-xs opacity-75 mt-1">{block.description}</div>
                  )}
                  <div className="text-xs mt-2 opacity-75">Kapasitas: {block.capacity}</div>
                </button>
              ))}
            </div>

            {/* Legend */}
            <div className="mt-6 pt-6 border-t border-purple-900/40">
              <h3 className="text-sm font-semibold text-purple-300 mb-3">Keterangan:</h3>
              <div className="space-y-2 text-sm">
                <div className="flex items-center space-x-2">
                  <div className="w-4 h-4 border-2 border-gray-600 bg-gray-800/50 rounded"></div>
                  <span className="text-gray-400">Tersedia</span>
                </div>
                <div className="flex items-center space-x-2">
                  <div className="w-4 h-4 border-2 border-purple-600 bg-purple-900/30 rounded"></div>
                  <span className="text-gray-400">Terisi</span>
                </div>
                <div className="flex items-center space-x-2">
                  <div className="w-4 h-4 border-2 border-yellow-600 bg-yellow-900/20 rounded"></div>
                  <span className="text-gray-400">Dipesan</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Main Content - Grid */}
        <div className="lg:col-span-3">
          {selectedBlock && (
            <div className="memorial-card p-6">
              <div className="mb-6">
                <h2 className="text-2xl font-bold text-purple-300 mb-2">{selectedBlock.name}</h2>
                {selectedBlock.description && (
                  <p className="text-gray-400">{selectedBlock.description}</p>
                )}
              </div>

              {graves.length === 0 ? (
                <div className="text-center py-12">
                  <div className="text-6xl mb-4">📭</div>
                  <p className="text-gray-400">Belum ada data makam di blok ini</p>
                </div>
              ) : (
                <div className="space-y-2">
                  {renderGrid()}
                </div>
              )}
            </div>
          )}
        </div>
      </div>

      {/* Selected Grave Modal */}
      {selectedGrave && (
        <div
          className="fixed inset-0 bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 p-4"
          onClick={() => setSelectedGrave(null)}
        >
          <div
            className="memorial-card p-6 max-w-md w-full"
            onClick={(e) => e.stopPropagation()}
          >
            <div className="flex justify-between items-start mb-4">
              <h3 className="text-2xl font-bold text-purple-300">
                Plot {selectedGrave.plotNumber}
              </h3>
              <button
                onClick={() => setSelectedGrave(null)}
                className="text-gray-400 hover:text-white text-2xl"
              >
                ×
              </button>
            </div>

            <div className="space-y-3 text-gray-300">
              <div>
                <span className="text-gray-500">Blok:</span> {selectedGrave.blockName}
              </div>
              <div>
                <span className="text-gray-500">Posisi:</span> Baris {selectedGrave.row}, Kolom {selectedGrave.column}
              </div>
              <div>
                <span className="text-gray-500">Status:</span>{' '}
                <span className={`font-semibold ${
                  selectedGrave.status === 'occupied' ? 'text-purple-400' :
                  selectedGrave.status === 'reserved' ? 'text-yellow-400' :
                  'text-green-400'
                }`}>
                  {selectedGrave.status === 'occupied' ? 'Terisi' :
                   selectedGrave.status === 'reserved' ? 'Dipesan' : 'Tersedia'}
                </span>
              </div>

              {selectedGrave.deceasedName && (
                <>
                  <div className="pt-3 border-t border-purple-900/40">
                    <span className="text-gray-500">Almarhum/ah:</span>
                    <div className="text-lg font-semibold text-purple-300 mt-1">
                      {selectedGrave.deceasedName}
                    </div>
                  </div>
                  {selectedGrave.deceasedId && (
                    <Link
                      href={`/deceased/${selectedGrave.deceasedId}`}
                      className="block mt-4 px-4 py-2 bg-purple-700 hover:bg-purple-600 text-white rounded-lg text-center font-semibold transition-colors"
                    >
                      Lihat Detail Lengkap
                    </Link>
                  )}
                </>
              )}
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
