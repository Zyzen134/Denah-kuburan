# 🕊️ Taman Makam Abadi - Sistem Denah Kuburan

Aplikasi web modern untuk mengelola dan mencari informasi denah kuburan dengan tampilan elegan yang sesuai untuk orang berduka.

## ✨ Fitur Utama

### 🗺️ Denah Interaktif
- Visualisasi grid makam yang interaktif untuk setiap blok
- Kode warna untuk status makam (tersedia, terisi, dipesan)
- Klik pada plot untuk melihat detail lengkap
- Navigasi antar blok dengan mudah

### 🔍 Pencarian Cepat
- Cari almarhum berdasarkan nama, nomor plot, atau blok
- Hasil pencarian real-time dengan filter dinamis
- Interface pencarian yang user-friendly

### 📖 Database Almarhum
- Daftar lengkap almarhum dengan informasi detail
- Biografi dan riwayat hidup
- Data keluarga dan kontak person
- Informasi lokasi makam

### 📊 Manajemen Data
- Sistem blok terorganisir dengan kapasitas
- Tracking status makam (available, occupied, reserved)
- Data relasi antara almarhum, makam, dan keluarga

## 🎨 Desain

Aplikasi menggunakan skema warna yang elegan dan menenangkan:
- **Warna Utama**: Ungu gelap dan abu-abu untuk suasana khidmat
- **Aksen**: Emas/amber untuk highlight penting
- **Background**: Gradient gelap dengan efek radial halus
- **Typography**: Font yang jelas dan mudah dibaca

## 🛠️ Teknologi

- **Framework**: Next.js 16 (App Router)
- **Database**: PostgreSQL dengan Drizzle ORM
- **Styling**: Tailwind CSS
- **Type Safety**: TypeScript

## 📁 Struktur Database

### Tabel `blocks`
- Area/blok pemakaman (contoh: Blok A, Blok B)
- Informasi kapasitas dan deskripsi

### Tabel `graves`
- Plot makam individual dengan posisi (row, column)
- Status: available, occupied, reserved
- Relasi ke blok

### Tabel `deceased`
- Informasi almarhum lengkap
- Biografi, foto, tanggal lahir/wafat
- Relasi ke makam

### Tabel `relatives`
- Data keluarga/kontak person
- Informasi kontak (telepon, email)

## 🚀 Instalasi & Setup

1. **Clone repository dan install dependencies**
```bash
npm install
```

2. **Setup database**
Database PostgreSQL sudah dikonfigurasi otomatis. Schema akan diaplikasikan saat pertama kali build.

3. **Seed data sample** (opsional)
Kunjungi `/admin` dan klik tombol "Isi Database dengan Data Sample" untuk mengisi database dengan data contoh:
- 3 Blok makam (A, B, C)
- 120 plot makam
- 6 data almarhum lengkap
- Data keluarga

4. **Run development server**
```bash
npm run dev
```

5. **Build untuk production**
```bash
npm run build
npm start
```

## 📱 Halaman Utama

### Beranda (`/`)
- Hero section dengan informasi utama
- Statistik kapasitas makam
- Fitur-fitur unggulan
- Call-to-action

### Denah Makam (`/map`)
- Pilihan blok di sidebar
- Grid interaktif untuk setiap blok
- Kode warna untuk status makam
- Modal detail saat klik plot

### Daftar Almarhum (`/deceased`)
- Card grid dengan informasi ringkas
- Search bar untuk filter
- Link ke detail lengkap

### Detail Almarhum (`/deceased/[id]`)
- Informasi lengkap almarhum
- Biografi dan foto
- Data keluarga
- Lokasi makam

### Pencarian (`/search`)
- Form pencarian powerful
- Hasil real-time
- Quick links ke halaman lain

### Admin (`/admin`)
- Panel untuk seed database
- Manajemen data (bisa dikembangkan lebih lanjut)

## 🎯 API Endpoints

- `GET /api/blocks` - Mendapatkan semua blok
- `POST /api/blocks` - Membuat blok baru
- `GET /api/graves?blockId={id}` - Mendapatkan makam per blok
- `POST /api/graves` - Membuat plot makam baru
- `GET /api/deceased` - Mendapatkan semua almarhum
- `POST /api/deceased` - Menambah data almarhum
- `GET /api/deceased/[id]` - Detail almarhum
- `POST /api/seed` - Seed database dengan data sample

## 🎨 Kustomisasi

### Mengubah Warna
Edit `src/app/globals.css` untuk mengubah skema warna:
```css
@layer base {
  :root {
    --primary: 280 40% 50%;  /* Warna ungu */
    --accent: 45 90% 60%;    /* Warna emas */
    /* ... dan lainnya */
  }
}
```

### Menambah Fitur
Struktur kode yang modular memudahkan penambahan fitur:
- Komponen UI di `src/components/`
- API routes di `src/app/api/`
- Halaman di `src/app/`
- Schema database di `src/db/schema.ts`

## 📝 Cara Menggunakan

1. **Pertama kali**: Kunjungi `/admin` untuk mengisi database dengan data sample
2. **Lihat Denah**: Kunjungi `/map` untuk melihat grid makam interaktif
3. **Cari Almarhum**: Gunakan `/search` atau `/deceased` untuk mencari data
4. **Lihat Detail**: Klik pada almarhum untuk melihat informasi lengkap

## 🔒 Keamanan

- Semua input di-sanitize untuk mencegah SQL injection
- Type-safe dengan TypeScript dan Drizzle ORM
- Validasi data di level database

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan demonstrasi.

## 👥 Kontribusi

Contributions are welcome! Silakan buat pull request atau issue untuk improvement.

---

**Dibuat dengan ❤️ untuk mengenang mereka yang telah berpulang**

*"Sesungguhnya kita adalah milik Allah dan kepada-Nya lah kita kembali"*
