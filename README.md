# Sistem Informasi Perpustakaan

## Deskripsi

Sistem Informasi Perpustakaan adalah aplikasi berbasis web yang dibuat untuk membantu proses pengelolaan perpustakaan. Melalui aplikasi ini, admin dan petugas dapat mengelola data buku, kategori, anggota, serta transaksi peminjaman dan pengembalian buku.

Aplikasi ini dikembangkan menggunakan Laravel dan database MySQL. Dalam pembuatannya, diterapkan konsep MVC, Eloquent ORM, serta sistem login dengan pembagian hak akses pengguna.

## Teknologi

- Laravel
- PHP
- MySQL
- HTML, CSS, Bootstrap
- Blade
- Visual Studio Code
- XAMPP
- Git dan GitHub

## Fitur

### Login dan Logout
Pengguna harus login terlebih dahulu untuk mengakses aplikasi. Hak akses dibedakan berdasarkan role Admin dan Petugas.

### Dashboard
Menampilkan ringkasan data perpustakaan, yaitu jumlah buku, total stok buku, jumlah anggota, dan peminjaman yang masih berlangsung.

### Data Pengguna
Admin dapat melihat, menambah, mengubah, dan menghapus akun pengguna serta menentukan role masing-masing pengguna.

### Data Kategori
Admin dapat mengelola kategori buku, sedangkan petugas dapat melihat daftar kategori.

### Data Buku
Admin dan petugas dapat melihat, menambah, mengubah, serta menghapus data buku.

### Data Anggota
Admin dan petugas dapat mengelola data anggota perpustakaan.

### Peminjaman dan Pengembalian
Admin dan petugas dapat mencatat transaksi peminjaman dan pengembalian buku. Stok buku akan berkurang saat dipinjam dan bertambah kembali setelah dikembalikan.

## Hak Akses

| Fitur | Admin | Petugas |
|---|---|---|
| Dashboard | Ya | Ya |
| Manajemen User | Ya | Tidak |
| Kategori | Kelola | Lihat |
| Buku | Kelola | Kelola |
| Anggota | Kelola | Kelola |
| Peminjaman | Kelola | Kelola |
| Pengembalian | Kelola | Kelola |

## Database

Database yang digunakan adalah MySQL dengan beberapa tabel berikut:

- users
- categories
- books
- members
- borrowings
- borrowing_details

Setiap tabel memiliki relasi sesuai dengan kebutuhan pengelolaan data perpustakaan.

## Cara Menjalankan Project

1. Clone repository GitHub:

   ```bash
   git clone [LINK_REPOSITORY]
   ```

2. Masuk ke folder project:

   ```bash
   cd sistem-perpustakaan
   ```

3. Install dependency:

   ```bash
   composer install
   ```

4. Salin file `.env.example` menjadi `.env`:

   ```bash
   copy .env.example .env
   ```

5. Buat application key:

   ```bash
   php artisan key:generate
   ```

6. Buat database dengan nama `sistem_perpustakaan` melalui phpMyAdmin.

7. Sesuaikan konfigurasi database pada file `.env`.

8. Jalankan migration:

   ```bash
   php artisan migrate
   ```

9. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

10. Buka browser dan akses:

    `http://127.0.0.1:8000`

## Identitas Kelompok

Nama Kelompok: [Nama Kelompok]

Mata Kuliah: Pemrograman Web Framework

Program Studi: Sistem Informasi

Universitas: Universitas Singaperbangsa Karawang

### Anggota Kelompok

1. [Hanny Fadillah Septiani] - [2410631250051]
2. [Keysa Avmalia] - [2410631250013]
3. [Zahwa Lamini Arsyi Anjuni] - [2410631250114]

## Repository

[https://github.com/keysaavml/sistem-perpustakaan.git]

---

Project ini dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Web Framework.