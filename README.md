<div align="center">

```
 ███████╗██████╗ ██╗  ██╗██╗     ██╗   ██╗
 ██╔════╝██╔══██╗██║ ██╔╝██║     ██║   ██║
 ███████╗██████╔╝█████╔╝ ██║     ██║   ██║
 ╚════██║██╔═══╝ ██╔═██╗ ██║     ██║   ██║
 ███████║██║     ██║  ██╗███████╗╚██████╔╝
 ╚══════╝╚═╝     ╚═╝  ╚═╝╚══════╝ ╚═════╝
```

### **Sistem Informasi Geografis**
### Pemetaan Stasiun Pengisian Kendaraan Listrik Umum (SPKLU)
### Kota Medan, Sumatera Utara — 2026

<br/>

[![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)](https://developer.mozilla.org/en-US/docs/Web/HTML)
[![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)](https://developer.mozilla.org/en-US/docs/Web/JavaScript)
[![Leaflet](https://img.shields.io/badge/Leaflet.js-199900?style=flat-square&logo=leaflet&logoColor=white)](https://leafletjs.com)
[![Supabase](https://img.shields.io/badge/Supabase-3ECF8E?style=flat-square&logo=supabase&logoColor=white)](https://supabase.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Netlify](https://img.shields.io/badge/Netlify-00C7B7?style=flat-square&logo=netlify&logoColor=white)](https://netlify.com)
[![License](https://img.shields.io/badge/License-MIT-FBBF24?style=flat-square)](#-lisensi)

<br/>

[🗺️ Lihat Demo](https://sig-spklu-medan.netlify.app) · [🐛 Laporkan Bug](https://github.com/riskakhairani/sig-spklu-medan/issues) · [💡 Usul Fitur](https://github.com/riskakhairani/sig-spklu-medan/issues)

</div>

---

## 📍 Tentang Proyek

**SIG SPKLU Medan** adalah aplikasi web berbasis Sistem Informasi Geografis (SIG) yang memetakan seluruh **Stasiun Pengisian Kendaraan Listrik Umum (SPKLU)** di wilayah Kota Medan secara interaktif dan real-time. Dibangun dengan tampilan dark-mode modern bertema amber-orange, proyek ini hadir sebagai kontribusi nyata dalam mendukung transisi energi bersih dan ekosistem kendaraan listrik di Sumatera Utara.

> *Pengembangan infrastruktur pengisian daya yang merata dan mudah diakses merupakan faktor penentu keberhasilan transisi menuju ekosistem kendaraan listrik.*
> — Konteks Penelitian GIS SPKLU Kota Medan, 2026

---

## ✨ Fitur Utama

### 🗺️ Peta Interaktif (index.html)
- **Marker SPKLU** dengan ikon kustom bergaya pin EV, dibedakan warna antara PLN (amber) dan Commercial (orange)
- **Popup detail lengkap** — nama, alamat, provider, jumlah port, tipe konektor, kapasitas kW, koordinat GPS, dan power bar visual
- **Animasi marker aktif** (pulse glow) saat stasiun dipilih
- **Fly-to animasi** saat memilih lokasi dari sidebar atau popup
- **Rekomendasi stasiun terdekat** otomatis berdasarkan jarak Euclidean
- **Dark basemap** dari CartoDB Dark All untuk tampilan peta yang konsisten
- **Tooltip nama stasiun** muncul saat hover marker

### 🔍 Pencarian & Filter
- Pencarian live berdasarkan **nama stasiun atau alamat**
- Filter berdasarkan **Provider** (PLN / Commercial / Semua)
- Filter berdasarkan **Kapasitas Daya** (High ≥100 kW · Medium 50–99 kW · AC/Slow <50 kW)
- Daftar lokasi di sidebar dengan **count realtime** hasil filter
- Highlight item aktif pada sidebar sinkron dengan marker di peta

### 📊 Statistik Real-time
- **Count-up animasi** untuk angka statistik saat halaman dimuat
- 5 kartu statistik: Total SPKLU · Total kW · Total Port · Stasiun PLN · Stasiun Komersial
- Data langsung dari Supabase REST API

### 🏠 Halaman Landing
- Hero section dengan animasi scroll (AOS)
- Section **Latar Belakang** — 4 kartu alasan pentingnya pemetaan SPKLU
- Section **Peta Interaktif** dengan legenda dan info konektor
- Section **Profil Pembuat**
- Navbar sticky dengan active-section detection via IntersectionObserver

### 🔐 Admin Dashboard (admin.html)
- **Halaman login** dengan autentikasi berbasis sessionStorage
- **Topbar dashboard** dengan info user yang sedang login dan tombol logout
- **5 kartu statistik** (Total SPKLU, PLN, Commercial, Port, Total kW)
- **Tabel data lengkap** dengan kolom: ID, Nama & Alamat, Provider, Max kW, Port, Konektor, Koordinat, Aksi
- **Sortasi kolom** (klik header untuk sort ascending/descending)
- **Pencarian + filter provider** pada tabel admin
- **Modal Tambah/Edit SPKLU** dengan validasi form lengkap
- **Map Picker interaktif** di dalam modal — klik peta untuk set koordinat otomatis
- **Sinkronisasi dua arah** koordinat: klik peta ↔ input manual latitude/longitude
- **Konfirmasi hapus** dengan dialog kustom sebelum eksekusi
- **Toast notification** untuk setiap aksi (sukses / error / info)
- **Banner RLS** otomatis muncul jika Supabase menolak operasi write

---

## 🛠️ Tech Stack

| Kategori | Teknologi | Versi |
|---|---|---|
| **Markup** | HTML5 | — |
| **Styling** | CSS3 Custom Properties + Tailwind CSS | CDN |
| **Peta** | Leaflet.js | 1.9.4 |
| **Animasi** | AOS (Animate on Scroll) | 2.3.4 |
| **Font** | Poppins + Space Mono | Google Fonts |
| **Database** | Supabase (PostgreSQL) | REST API |
| **Hosting** | Netlify (Static) | — |

---

## 📁 Struktur Proyek

```
sig-spklu-medan/
├── index.html          # Halaman utama — peta publik & statistik
├── admin.html          # Panel admin — CRUD data SPKLU
└── README.md           # Dokumentasi ini
```

---

## 🗄️ Struktur Tabel Supabase

Buat tabel `spklu` di Supabase dengan struktur berikut:

```sql
CREATE TABLE spklu (
  id        BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
  name      TEXT NOT NULL,
  address   TEXT NOT NULL,
  provider  TEXT NOT NULL CHECK (provider IN ('PLN', 'Commercial')),
  ports     INTEGER NOT NULL DEFAULT 1,
  max_kw    INTEGER NOT NULL,
  connector TEXT NOT NULL,
  lat       DOUBLE PRECISION NOT NULL,
  lng       DOUBLE PRECISION NOT NULL
);
```

---

## 🔑 Akses Admin

| Field | Value |
|---|---|
| URL | `/admin` atau `/admin.html` |
| Email | `admin@gmail.com` |
| Password | `admin123` |

> ⚠️ Disarankan untuk mengubah kredensial default sebelum deploy ke production.

---

## 📊 Data SPKLU

Data bersumber dari:
- **PLN UID Sumatera Utara** — data stasiun milik PLN
- **Google Maps 2026** — verifikasi koordinat dan alamat

Tipe konektor yang tersedia di Kota Medan:

| Standar | Tipe Pengisian | Kecepatan |
|---|---|---|
| **CCS1** | DC Fast Charging | Hingga 200 kW |
| **Type 2** | AC Charging | 7–22 kW |
| **CHAdeMO** | DC Fast Charging | Hingga 100 kW |

Persebaran SPKLU mencakup wilayah: **Medan Baru · Medan Petisah · Medan Polonia · Medan Helvetia** dan sekitarnya. Sebagian besar SPKLU PLN beroperasi **24 jam penuh**.

---

## 👩‍💻 Pembuat

<table>
  <tr>
    <td align="center">
      <strong>Riska Khairani Nasution</strong><br/>
      Mahasiswa · Teknologi Rekayasa Perangkat Lunak<br/>
      <em>GIS & Spasial · Web Development · Leaflet.js · Data Analysis · UI/UX</em><br/><br/>
      <a href="https://github.com/riskakhairani">
        <img src="https://img.shields.io/badge/GitHub-riskakhairani-181717?style=flat-square&logo=github" />
      </a>
    </td>
  </tr>
</table>

**Judul Penelitian:** Pemetaan Lokasi Stasiun Pengisian Kendaraan Listrik (SPKLU) di Kota Medan  
**Bidang Studi:** Teknologi Rekayasa Perangkat Lunak  
**Lokasi:** Kota Medan, Sumatera Utara, Indonesia  
**Tahun:** 2026

---

## 📄 Lisensi

Proyek ini menggunakan lisensi **MIT**. Bebas digunakan, dimodifikasi, dan didistribusikan dengan menyertakan atribusi kepada pembuat asli.

---

<div align="center">

Dibuat dengan ⚡ untuk mendukung transisi energi bersih Kota Medan

**[⬆ Kembali ke atas](#)**

</div>
