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
Admin dapat mengelola kategori buku, sedangkan petugas dapat melihat daftar kategori. Kategori yang masih dipakai oleh buku tidak dapat dihapus.

### Data Buku
Admin dan petugas dapat melihat, menambah, mengubah, serta menghapus data buku. Buku yang sudah memiliki riwayat peminjaman tidak dapat dihapus.

### Data Anggota
Admin dan petugas dapat mengelola data anggota perpustakaan. Anggota yang memiliki riwayat peminjaman tidak dapat dihapus.

### Peminjaman dan Pengembalian
Admin dan petugas dapat mencatat transaksi peminjaman dan pengembalian buku.

- Setiap peminjaman mencatat petugas yang memproses, anggota peminjam, tanggal pinjam, dan detail buku yang dipinjam.
- Tanggal jatuh tempo otomatis 1 minggu setelah tanggal pinjam.
- Status awal peminjaman adalah `borrowed`, dan stok buku berkurang sesuai jumlah yang dipinjam.
- Saat pengembalian, tanggal kembali dicatat, status berubah menjadi `returned`, dan stok buku bertambah kembali.
- Proses peminjaman dan pengembalian berjalan dalam satu transaksi database.

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

Relasi antar tabel:

- Satu kategori memiliki banyak buku (`categories` → `books`).
- Satu user (petugas) mencatat banyak peminjaman (`users` → `borrowings`).
- Satu anggota memiliki banyak peminjaman (`members` → `borrowings`).
- Satu peminjaman memiliki banyak detail buku (`borrowings` → `borrowing_details`), dan setiap detail terhubung ke satu buku (`books`).

## Cara Menjalankan Project

1. Clone repository GitHub:

   ```bash
   git clone https://github.com/keysaavml/sistem-perpustakaan.git
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

6. Jalankan Apache dan MySQL di XAMPP, lalu buat database dengan nama `sistem_perpustakaan` melalui phpMyAdmin.

7. Sesuaikan konfigurasi database pada file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=sistem_perpustakaan
   DB_USERNAME=root
   DB_PASSWORD=
   ```

8. Jalankan migration dan seeder:

   ```bash
   php artisan migrate --seed
   ```

9. Jalankan aplikasi:

   ```bash
   php artisan serve
   ```

10. Buka browser dan akses:

    `http://127.0.0.1:8000`

## Akun Uji

Akun berikut dibuat otomatis oleh seeder:

| Role | Email | Password |
|---|---|---|
| Admin | admin@perpus.test | password123 |
| Petugas | petugas@perpus.test | password123 |

## Identitas Kelompok

Nama Kelompok: Kelompok 4

Mata Kuliah: Pemrograman Web Framework

Program Studi: Sistem Informasi

Universitas: Universitas Singaperbangsa Karawang

### Anggota Kelompok

1. Hanny Fadillah Septiani - 2410631250051
2. Keysa Avmalia - 2410631250013
3. Zahwa Lamini Arsyi Anjuni - 2410631250114

## Repository

https://github.com/keysaavml/sistem-perpustakaan

---

Project ini dibuat untuk memenuhi tugas akhir mata kuliah Pemrograman Web Framework.