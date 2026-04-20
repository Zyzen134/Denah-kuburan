import { db } from '@/db';
import { blocks, graves, deceased, relatives } from '@/db/schema';
import { NextResponse } from 'next/server';
import { eq } from 'drizzle-orm';

export async function POST() {
  try {
    // Clear existing data
    await db.delete(relatives);
    await db.delete(deceased);
    await db.delete(graves);
    await db.delete(blocks);

    // Create blocks
    const blockData = [
      { name: 'Blok A', description: 'Area utama dekat pintu masuk', capacity: 50 },
      { name: 'Blok B', description: 'Area taman dengan pepohonan rindang', capacity: 40 },
      { name: 'Blok C', description: 'Area keluarga dengan fasilitas premium', capacity: 30 },
    ];

    const createdBlocks = await db.insert(blocks).values(blockData).returning();

    // Create graves for Block A
    const gravesBlockA = [];
    for (let row = 1; row <= 5; row++) {
      for (let col = 1; col <= 10; col++) {
        gravesBlockA.push({
          blockId: createdBlocks[0].id,
          plotNumber: `A-${row}${col}`,
          row,
          column: col,
          status: row <= 2 ? 'occupied' : row === 3 && col <= 5 ? 'reserved' : 'available',
        });
      }
    }

    // Create graves for Block B
    const gravesBlockB = [];
    for (let row = 1; row <= 4; row++) {
      for (let col = 1; col <= 10; col++) {
        gravesBlockB.push({
          blockId: createdBlocks[1].id,
          plotNumber: `B-${row}${col}`,
          row,
          column: col,
          status: row <= 1 ? 'occupied' : 'available',
        });
      }
    }

    // Create graves for Block C
    const gravesBlockC = [];
    for (let row = 1; row <= 3; row++) {
      for (let col = 1; col <= 10; col++) {
        gravesBlockC.push({
          blockId: createdBlocks[2].id,
          plotNumber: `C-${row}${col}`,
          row,
          column: col,
          status: row === 1 && col <= 3 ? 'occupied' : 'available',
        });
      }
    }

    const allGraves = [...gravesBlockA, ...gravesBlockB, ...gravesBlockC];
    const createdGraves = await db.insert(graves).values(allGraves).returning();

    // Create deceased records
    const deceasedData = [
      {
        graveId: createdGraves.find(g => g.plotNumber === 'A-11')!.id,
        fullName: 'Bapak Ahmad Santoso',
        birthDate: '1950-03-15',
        deathDate: '2023-11-20',
        age: 73,
        biography: 'Seorang guru yang telah mengabdi selama 40 tahun di dunia pendidikan. Beliau dikenal sebagai sosok yang sabar, bijaksana, dan sangat peduli dengan pendidikan anak-anak Indonesia. Meninggalkan warisan berupa ratusan murid yang sukses di berbagai bidang.',
        photo: null,
      },
      {
        graveId: createdGraves.find(g => g.plotNumber === 'A-12')!.id,
        fullName: 'Ibu Siti Aminah',
        birthDate: '1945-07-08',
        deathDate: '2023-09-15',
        age: 78,
        biography: 'Wanita tangguh yang mendedikasikan hidupnya untuk keluarga dan masyarakat. Aktif di berbagai kegiatan sosial dan keagamaan. Dikenal sebagai sosok ibu yang penuh kasih sayang.',
        photo: null,
      },
      {
        graveId: createdGraves.find(g => g.plotNumber === 'A-13')!.id,
        fullName: 'Bapak Dr. Hendra Wijaya, Sp.PD',
        birthDate: '1960-12-03',
        deathDate: '2024-01-10',
        age: 63,
        biography: 'Dokter spesialis penyakit dalam yang telah menolong ribuan pasien. Beliau dikenal dengan dedikasi luar biasa terhadap profesinya dan sering memberikan pelayanan gratis kepada masyarakat kurang mampu.',
        photo: null,
      },
      {
        graveId: createdGraves.find(g => g.plotNumber === 'A-21')!.id,
        fullName: 'Ibu Dewi Kusuma',
        birthDate: '1955-05-20',
        deathDate: '2023-12-05',
        age: 68,
        biography: 'Pengusaha sukses dan dermawan yang banyak membantu pendidikan anak-anak kurang mampu melalui yayasan yang didirikannya.',
        photo: null,
      },
      {
        graveId: createdGraves.find(g => g.plotNumber === 'B-11')!.id,
        fullName: 'Bapak Ir. Bambang Sutrisno',
        birthDate: '1958-09-12',
        deathDate: '2024-02-28',
        age: 65,
        biography: 'Insinyur sipil yang berkontribusi dalam pembangunan infrastruktur Indonesia. Beliau terlibat dalam berbagai proyek pembangunan jembatan dan jalan tol.',
        photo: null,
      },
      {
        graveId: createdGraves.find(g => g.plotNumber === 'C-11')!.id,
        fullName: 'Ibu Ratna Sari Dewi',
        birthDate: '1962-11-25',
        deathDate: '2024-03-15',
        age: 61,
        biography: 'Seniman dan budayawan yang aktif melestarikan kebudayaan tradisional. Beliau adalah penari dan pelatih tari yang telah mengajarkan seni tari kepada generasi muda.',
        photo: null,
      },
    ];

    const createdDeceased = await db.insert(deceased).values(deceasedData).returning();

    // Update grave status
    for (const dec of createdDeceased) {
      await db.update(graves)
        .set({ status: 'occupied' })
        .where(eq(graves.id, dec.graveId));
    }

    // Create relatives
    const relativesData = [
      {
        deceasedId: createdDeceased[0].id,
        name: 'Andi Santoso',
        relationship: 'Anak',
        phone: '081234567890',
        email: 'andi.santoso@email.com',
      },
      {
        deceasedId: createdDeceased[0].id,
        name: 'Siti Santoso',
        relationship: 'Istri',
        phone: '081234567891',
        email: null,
      },
      {
        deceasedId: createdDeceased[1].id,
        name: 'Muhammad Amin',
        relationship: 'Anak',
        phone: '081234567892',
        email: 'muhammad.amin@email.com',
      },
      {
        deceasedId: createdDeceased[2].id,
        name: 'Rina Wijaya',
        relationship: 'Istri',
        phone: '081234567893',
        email: 'rina.wijaya@email.com',
      },
    ];

    await db.insert(relatives).values(relativesData);

    return NextResponse.json({ 
      message: 'Database seeded successfully',
      blocks: createdBlocks.length,
      graves: createdGraves.length,
      deceased: createdDeceased.length,
    });
  } catch (error) {
    console.error('Error seeding database:', error);
    return NextResponse.json({ error: 'Failed to seed database' }, { status: 500 });
  }
}
