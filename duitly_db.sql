-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Nov 2026 pada 06.22
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `duitly_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggaran`
--

CREATE TABLE `anggaran` (
  `id` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `jumlah_anggaran` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggaran`
--

INSERT INTO `anggaran` (`id`, `bulan`, `tahun`, `jumlah_anggaran`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 10, 2026, 1000000.00, '2026-10-30 12:30:32', '2026-10-30 12:30:32', NULL),
(2, 10, 2026, 2000000.00, '2026-10-31 13:59:35', '2026-10-31 13:59:43', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-10-30-112909', 'App\\Database\\Migrations\\CreatePengeluaranTable', 'default', 'App', 1793360088, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` decimal(12,2) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `kategori`, `keterangan`, `jumlah`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '2026-10-30', 'Makanan', 'membeli makan siang dan minum', 15000.00, '2026-10-30 11:45:28', '2026-10-30 11:53:16', NULL),
(2, '2026-10-30', 'Transportasi', 'bayar ojek', 20000.00, '2026-10-30 12:01:57', '2026-10-30 12:01:57', NULL),
(7, '2026-10-31', 'Makanan', 'Membeli makan siang dan minum', 15000.00, '2026-10-31 13:58:32', '2026-11-02 16:38:00', 1),
(8, '2026-10-31', 'Transportasi', 'Bayar ojek', 23000.00, '2026-10-31 13:59:09', '2026-10-31 13:59:09', 1),
(9, '2026-11-02', 'Kebutuhan Kuliah', 'Ngeprint makalah', 7000.00, '2026-11-02 16:38:37', '2026-11-02 16:38:37', 1),
(10, '2026-11-02', 'Belanja', 'Belanja sayur,ikan,dan bumbu', 78000.00, '2026-11-02 16:39:11', '2026-11-02 16:39:11', 1),
(11, '2026-11-02', 'Hiburan', 'Nonton Konser', 100000.00, '2026-11-02 16:39:44', '2026-11-02 16:39:44', 1),
(12, '2026-11-02', 'Lainnya', 'iuran', 80000.00, '2026-11-02 16:40:12', '2026-11-02 16:40:12', 1),
(14, '2026-11-03', 'Transportasi', '', 300000.00, '2026-11-03 13:11:50', '2026-11-03 13:11:50', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Arumia', 'arumarum7676@gmail.com', '$2y$10$QrXXRFQc7bXa0Cnu4PQ14.gxRHqeWTYqzuLxDBI.eeWNFSYOevJGu', '2026-10-30 14:12:19', '2026-10-31 14:25:53'),
(2, 'Fadya ', 'fadyafadya1212@gmail.com', '$2y$10$rjID9HVcFxjXq4W0H5TPAeJzyhw9TUvbRogSlpLwbsQflr3WWUpMW', '2026-10-30 14:19:30', '2026-10-30 14:19:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unik_user_bulan_tahun` (`user_id`,`bulan`,`tahun`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggaran`
--
ALTER TABLE `anggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
