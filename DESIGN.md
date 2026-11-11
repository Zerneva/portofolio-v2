# DESIGN.md: Portofolio Muhammad Azzam Al-Fauzie (Zerneva)

> Status: **KONSEP, menunggu review pemilik.** Belum ada perubahan di `index.html` sampai konsep ini disetujui.

## 1. Design Read

> Reading this as: **portofolio personal developer** untuk **perekrut, instansi daerah, dan pelaku UMKM**, dengan gaya **"buku kas yang rapi"** (editorial minimalis, hangat, presisi), dial **ENERGY 2 / RHYTHM 3 / MOTION 2**.

Dial: ENERGY 2 / RHYTHM 3 / MOTION 2

| Dial   | Nilai          | Alasan                                                                                                          |
| ------ | -------------- | --------------------------------------------------------------------------------------------------------------- |
| ENERGY | 2 (seimbang)   | Diminta "modern dan minimalis". Cukup tegas untuk diingat, tidak berteriak.                                     |
| RHYTHM | 3 (bervariasi) | Isinya memang beda-beda: proyek unggulan, riwayat, keahlian, galeri foto. Tiap section dapat komposisi sendiri. |
| MOTION | 2 (transisi)   | Hover, buka-tutup accordion, transisi modal, satu reveal ringan saat scroll. Tidak ada loop tanpa henti.        |

## 2. Identitas dan Kepribadian

**Ide utama: "Buku Kas".** Karya Azzam berputar di sekitar pencatatan dan keteraturan: Zenflow (catatan arus kas), PLUT KUMKM (pendataan UMKM), data analytics. Bahasa visualnya meminjam dari buku kas dan buku besar: kolom margin, garis pemisah tipis, angka urut, catatan kecil di pinggir halaman. Hasilnya tetap terasa modern karena tipografinya tegas dan ruang kosongnya lega.

Kepribadian: **teliti, membumi, hangat.** Developer yang bekerja langsung dengan orang (instansi, UMKM), bukan sekadar "tech".

**Uji tukar logo:** tanpa nama Azzam, halaman tetap terasa milik seseorang yang mengurus data dan UMKM di Lampung Barat, karena motif buku kas, warna kopi, dan catatan margin berisi fakta nyata tentang dia.

## 3. Motif Identitas (diulang di seluruh halaman)

**Kolom margin buku kas.** Setiap section punya kolom sempit di kiri (desktop) berisi:

- Nomor urut section (`01`, `02`, ...) dengan font mono kecil.
- Satu catatan fakta yang nyata (contoh: `Lampung Barat`, `2024 sampai sekarang`, `Flutter + Firebase`).

Dipisahkan dari isi dengan satu garis vertikal tipis, seperti garis margin di buku tulis. Di mobile, kolom ini pindah ke atas judul section sebagai satu baris kecil.

Garis ini **struktural** (memisahkan margin dari isi), bukan background grid. Background grid yang sekarang dihapus.

## 4. Warna

Tema bawaan **terang** (kertas). Alasan: portofolio dibaca perekrut dan instansi, sering di siang hari dan di HP; isinya teks dan foto, bukan tool developer. Tema terang juga membedakan dari portofolio developer gelap yang umum. **Toggle gelap tetap dibuat dan wajib berfungsi penuh.**

### Palet inti (2 inti + 1 aksen)

| Peran                       | Terang    | Gelap     | Alasan                                                                                       |
| --------------------------- | --------- | --------- | -------------------------------------------------------------------------------------------- |
| Kertas (background)         | `#F5F1E8` | `#15120E` | Krem kertas buku kas; versi gelap seperti kopi sangrai, bukan hitam kebiruan.                |
| Kertas 2 (permukaan)        | `#EAE4D6` | `#211D17` | Untuk kartu, input, dan blok yang perlu sedikit naik.                                        |
| Tinta (teks utama)          | `#1A1712` | `#EDE7DA` | Hitam hangat, bukan `#000`.                                                                  |
| Tinta redup (teks sekunder) | `#5C554A` | `#A89F8F` | Caption, meta, tanggal.                                                                      |
| Garis                       | `#D6CEBD` | `#3A332A` | Garis margin dan pemisah. Dekoratif, bukan teks.                                             |
| **Aksen: merah ceri kopi**  | `#A6301F` | `#F0846C` | Diambil dari buah kopi matang, komoditas utama Lampung Barat. Spesifik ke tempat asal Azzam. |
| Hijau daun (status saja)    | `#2F5A43` | `#8FC4A3` | **Hanya** untuk status nyata: "Live", "Terkirim". Tidak dipakai sebagai dekorasi.            |

### Kontras (WCAG, sudah dihitung)

| Pasangan                        | Rasio     | Hasil   |
| ------------------------------- | --------- | ------- |
| Tinta / kertas terang           | 15.85 : 1 | AA, AAA |
| Tinta redup / kertas terang     | 6.53 : 1  | AA      |
| Tinta redup / kertas 2 terang   | 5.81 : 1  | AA      |
| Aksen / kertas terang           | 6.08 : 1  | AA      |
| Teks putih / tombol aksen       | 6.85 : 1  | AA      |
| Hijau / kertas terang           | 6.99 : 1  | AA      |
| Tinta / kertas gelap            | 15.15 : 1 | AA, AAA |
| Tinta redup / kertas gelap      | 7.13 : 1  | AA      |
| Tinta redup / kertas 2 gelap    | 6.40 : 1  | AA      |
| Aksen gelap / kertas gelap      | 7.31 : 1  | AA      |
| Teks gelap / tombol aksen gelap | 7.31 : 1  | AA      |
| Hijau gelap / kertas gelap      | 9.42 : 1  | AA      |

### Aturan aksen

Aksen hanya muncul di **3 tempat**: tombol utama (satu per layar), kata kunci di headline hero, dan indikator item aktif (nav, tab). Link biasa memakai warna tinta + garis bawah, bukan aksen.

## 5. Tipografi

| Peran                         | Font                               | Alasan                                                                                                                        |
| ----------------------------- | ---------------------------------- | ----------------------------------------------------------------------------------------------------------------------------- |
| Display (H1, H2, nama proyek) | **Bricolage Grotesque** (600, 700) | Grotesk dengan bentuk sedikit "tangan", hangat dan khas, tapi tetap modern. Cocok untuk developer yang dekat dengan UMKM.     |
| Body                          | **IBM Plex Sans** (400, 500, 600)  | Keluarga Plex dirancang di persimpangan manusia dan mesin. Jelas dibaca di layar kecil, karakter teknis yang tenang.          |
| Data kecil                    | **IBM Plex Mono** (400, 500)       | Hanya untuk nomor urut, tanggal, nama stack di margin. **Tidak pernah** untuk judul. Satu keluarga dengan body, jadi menyatu. |

Font lama (Space Grotesk, JetBrains Mono, Instrument Serif, Plus Jakarta Sans) dihapus. Empat keluarga font jadi dua.

Skala (desktop / mobile):

- H1: 72px / 44px, line-height 0.98, tracking -0.03em
- H2: 44px / 32px
- H3: 24px / 20px
- Body: 17px / 16px, line-height 1.6
- Margin note (mono): 13px, **huruf normal, tanpa uppercase dan tanpa letter-spacing lebar**

## 6. Bentuk, Ruang, Elevasi

- **Radius:** 4px (input, tag), 10px (kartu, gambar), 999px **hanya** untuk tombol toggle tema. Tidak semua jadi pill.
- **Spasi:** skala 4 / 8 / 12 / 16 / 24 / 32 / 48 / 72 / 120. Jarak antar section bervariasi (72 sampai 120) sesuai bobot isinya.
- **Shadow:** hanya di modal dan Command Palette (keduanya benar-benar melayang di atas halaman). Kartu datar dengan garis tipis.
- **Glow, blur, glassmorphism:** tidak dipakai. Backdrop modal cukup gelap transparan tanpa blur.
- **Garis:** 1px warna `Garis`. Satu garis margin vertikal per section sebagai motif.

## 7. Struktur Halaman (urutan cerita)

Urutan mengikuti pertanyaan pengunjung: _Siapa dia? Apa yang sudah dia bangun? Bagaimana latar belakangnya? Apa saja keahliannya? Seperti apa karya visualnya? Bagaimana menghubunginya?_

| #   | Section          | Komposisi                                                                                                                                     | Catatan                                                                              |
| --- | ---------------- | --------------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| 0   | Header           | Nama teks (bukan logo baru), link section, toggle tema, tombol Ctrl+K                                                                         | Di mobile: menu ringkas. Semua link menuju section yang ada.                         |
| 1   | **Hero**         | Asimetris: kiri nama besar (H1) + satu kalimat tentang apa yang dia kerjakan + 2 tombol. Kanan: foto portrait (asli) dengan tombol ganti pose | Fokus satu: nama + kalimat. Tanpa angka statistik (lihat Pertanyaan 1).              |
| 2   | **Proyek**       | PLUT KUMKM sebagai proyek unggulan **lebar penuh** (karena live dan paling besar). Zenflow dan Galeri UMKM lebih kecil, berdampingan          | Ukuran berbeda karena bobotnya berbeda, bukan kartu kembar. Modal studi kasus tetap. |
| 3   | **Zenflow**      | Split: mockup HP dengan screenshot asli di satu sisi, catatan fitur bergaya baris buku kas di sisi lain                                       | Tombol unduh APK tetap.                                                              |
| 4   | **Riwayat**      | Tabel buku besar: kolom tahun, peran, tempat. Pendidikan, pengalaman, organisasi dalam satu alur waktu                                        | Ganti layout kotak-kotak (bento) yang sekarang.                                      |
| 5   | **Keahlian**     | Daftar bernomor yang bisa dibuka (accordion), seperti indeks buku                                                                             | Sudah ada, dirapikan sesuai tipografi baru.                                          |
| 6   | **Arsip Visual** | Tab Instagram / Pinterest, grid foto, modal preview                                                                                           | Fitur preview yang baru dibuat tetap. Grid tidak simetris: foto pertama lebih besar. |
| 7   | **Kontak**       | Email besar sebagai fokus + tombol salin, WhatsApp, form Formspree                                                                            | Footer satu baris: hak cipta + link sosial.                                          |

## 8. Gerak

| Gerak                                                    | Tujuan                                               |
| -------------------------------------------------------- | ---------------------------------------------------- |
| Hover tombol dan link: warna + garis bawah bergeser      | Menunjukkan elemen bisa diklik.                      |
| Accordion keahlian: tinggi membuka 200ms                 | Menunjukkan isi yang terbuka.                        |
| Modal: fade + naik 12px, 250ms                           | Menunjukkan lapisan baru di atas halaman.            |
| Reveal sekali saat scroll (judul section saja)           | Menandai pindah bab. Tidak dipakai di setiap elemen. |
| Semua gerak berhenti di `prefers-reduced-motion: reduce` | Aksesibilitas.                                       |

Yang dihapus: marquee berjalan terus, kursor ketik berkedip terus, titik status berdenyut, efek scale pada semua kartu.

## 9. Aksesibilitas

- Semua teks lolos AA di kedua tema (tabel di bagian 4).
- Fokus keyboard: outline 2px warna aksen + offset 3px di semua elemen interaktif.
- Grid foto feed diubah dari `div` yang bisa diklik menjadi `<button>` asli.
- Tombol ikon (tutup, tema, navigasi foto) diberi `aria-label`.
- Tap target minimal 44px.
- Satu `h1`, level heading tidak lompat.

## 10. Yang Dihapus dari Desain Sekarang (dan alasannya)

| Elemen                                                   | Alasan                                                                               |
| -------------------------------------------------------- | ------------------------------------------------------------------------------------ |
| Background grid + glow ambient                           | Tekstur tanpa makna (R-07, R-01). Diganti motif garis margin.                        |
| Pemilih 4 warna aksen                                    | Identitas jadi tidak tetap, palet melebar (R-29).                                    |
| Marquee dengan ikon ✦                                    | Loop tanpa henti + ikon sparkle generik (R-19, R-04).                                |
| Chip "HUD", titik jendela, "VERIFIED IDENTITY"           | Kostum teknis tanpa fungsi (R-05, R-31).                                             |
| Label mono huruf besar (`// ROLE:`, `SECTION 05 //`)     | Tipografi "terminal" sebagai gaya saja (R-06).                                       |
| Karakter em dash di teks                                 | R-02. Diganti titik dua, koma, atau titik.                                           |
| Panah ↗ di hampir semua tombol                           | Dekorasi berulang (R-08). Panah hanya untuk link yang benar-benar keluar dari situs. |
| Kata seperti "Effortless", "Intelligent", "Architecting" | Buzzword (R-16). Diganti kalimat konkret.                                            |

## 11. Pertanyaan untuk Pemilik (perlu dijawab sebelum eksekusi)

1. **Angka di hero** (`2+ YRS`, `70% Process Acceleration`, `4+ Core Disciplines`): apakah ada sumbernya? Angka 70% juga muncul di modal PLUT ("verifikasi data 70% lebih cepat"). Kalau tidak ada data yang bisa ditunjukkan, angka ini dihapus (R-17).
2. **Loading screen** (sekitar 4 detik, bergaya telemetri): dihapus saja, atau dipertahankan dalam versi singkat di bawah 1 detik? Saran: dihapus, supaya konten langsung tampil.
3. **Bahasa teks:** sekarang campuran Inggris dan Indonesia. Pilih satu bahasa utama? Saran: Indonesia, karena audiens utamanya instansi dan UMKM lokal.
4. **Galeri Digital UMKM:** apakah ini proyek nyata yang punya link atau screenshot? Sekarang gambarnya dari Unsplash. Kalau belum ada bukti, ditandai "Dalam pengerjaan" atau dikeluarkan.
5. **Link Discord** (`discord.gg/zerneva`) dan **Facebook**: masih aktif? Kalau tidak, dihapus dari daftar sosial.
6. **Command Palette (Ctrl+K):** dipertahankan? Saran: ya, karena berfungsi dan cocok untuk developer.
