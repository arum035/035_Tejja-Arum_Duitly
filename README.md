&#x20;DUITLY – Aplikasi Pencatatan Pengeluaran Mahasiswa



1\. Deskripsi Aplikasi



Duitly merupakan aplikasi berbasis web yang digunakan untuk membantu mahasiswa dalam mencatat dan mengelola pengeluaran sehari-hari. Aplikasi ini menyediakan fitur pencatatan transaksi, pengelolaan anggaran bulanan, serta visualisasi pengeluaran agar pengguna dapat memantau kondisi keuangannya dengan lebih mudah.



2\. Tujuan Aplikasi



Tujuan pengembangan aplikasi Duitly adalah:

\- Membantu mahasiswa mencatat pengeluaran secara terstruktur.

\- Memudahkan pengguna memantau pengeluaran berdasarkan kategori.

\- Membantu pengguna mengatur anggaran bulanan.

\- Menyediakan informasi pengeluaran melalui dashboard dan grafik.



3\. Fitur Aplikasi



\- Login pengguna.

\- Dashboard ringkasan pengeluaran.

\- Tambah data pengeluaran.

\- Menampilkan daftar pengeluaran.

\- Edit data pengeluaran.

\- Hapus data pengeluaran.

\- Filter dan pencarian pengeluaran.

\- Grafik pengeluaran berdasarkan kategori.

\- Pengelolaan anggaran bulanan.

\- Pengelolaan profil pengguna.



4\. Teknologi yang Digunakan



\- PHP

\- CodeIgniter 4

\- MySQL/MariaDB

\- HTML, CSS, dan JavaScript

\- Chart.js

\- Composer

\- XAMPP



5\. Struktur Database



Database yang digunakan bernama `duitly\_db`, dengan tabel:

\- `users`: menyimpan data pengguna.

\- `pengeluaran`: menyimpan data transaksi pengeluaran.

\- `anggaran`: menyimpan data anggaran bulanan pengguna.



6\. Cara Instalasi



1\. Instal XAMPP dan Composer.

2\. Salin folder proyek `duitly` ke direktori `C:\\xampp\\htdocs`.

3\. Jalankan Apache dan MySQL melalui XAMPP.

4\. Buka phpMyAdmin melalui `http://localhost/phpmyadmin`.

5\. Buat database baru dengan nama `duitly\_db`.

6\. Impor file `duitly\_db.sql` ke database tersebut.

7\. Siapkan file konfigurasi `.env` berdasarkan file template `env`.

8\. Sesuaikan konfigurasi database pada `.env`.



7\. Konfigurasi Database



Sesuaikan konfigurasi database pada file `.env` dengan pengaturan MySQL lokal.



Contoh konfigurasi:



```ini

database.default.hostname = localhost

database.default.database = duitly\_db

database.default.username = root

database.default.password =

database.default.DBDriver = MySQLi

database.default.port = 3306

```



Sesuaikan username, password, dan port jika konfigurasi XAMPP berbeda.



8\. Cara Menjalankan Aplikasi



1\. Buka Command Prompt pada folder proyek.

2\. Jalankan perintah:



```bash

php spark serve

```



3\. Buka browser.

4\. Akses alamat:



`http://localhost:8080`



5\. Login menggunakan akun pengguna yang tersedia pada database.



9\. Pengembang



Nama: Tejja Arum  

NIM: 240631100035  

Program Studi: Pendidikan Informatika  

Universitas: Universitas Trunojoyo Madura

