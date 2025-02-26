-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Feb 2025 pada 02.08
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `harga_barang` int NOT NULL,
  `stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `stock`) VALUES
(10, 'Sabun', 5000, 34),
(11, 'Mie goreng', 2500, 85),
(12, 'Minyak goreng', 10000, 75),
(13, 'Roti', 3000, 29),
(14, 'Pasta gigi', 5000, 49),
(18, 'Pensil', 2500, 96),
(19, 'Penghapus', 2000, 86),
(20, 'Susu', 4000, 36),
(21, 'Bolpoin', 2000, 84),
(22, 'Permen', 500, 890),
(23, 'Coklat', 3000, 64),
(32, 'Gula', 17000, 24),
(39, 'Kecap', 3000, 48);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detil_penjualan`
--

CREATE TABLE `detil_penjualan` (
  `id_transaksi_detil` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_barang` int NOT NULL,
  `jml_barang` int NOT NULL,
  `harga_satuan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detil_penjualan`
--

INSERT INTO `detil_penjualan` (`id_transaksi_detil`, `id_transaksi`, `id_barang`, `jml_barang`, `harga_satuan`) VALUES
(30, 20, 12, 1, 10000),
(31, 21, 11, 1, 2500),
(32, 22, 10, 1, 5000),
(33, 23, 13, 2, 3000),
(253, 24, 22, 6, 500),
(254, 24, 13, 1, 3000),
(255, 234, 22, 1, 500),
(256, 235, 21, 12, 2000),
(257, 235, 12, 2, 10000),
(258, 236, 22, 10, 500),
(259, 236, 32, 1, 17000),
(260, 237, 32, 2, 17000),
(261, 237, 12, 2, 10000),
(262, 238, 22, 10, 500),
(263, 238, 10, 1, 5000),
(264, 239, 22, 10, 500),
(265, 239, 19, 1, 2000),
(266, 240, 39, 2, 3000),
(267, 240, 14, 1, 5000),
(268, 241, 22, 10, 500),
(269, 241, 12, 1, 10000),
(270, 242, 22, 10, 500),
(271, 242, 10, 2, 5000),
(272, 243, 32, 1, 17000),
(273, 243, 19, 1, 2000),
(274, 244, 18, 2, 2500),
(275, 244, 11, 6, 2500),
(276, 245, 21, 2, 2000),
(277, 245, 23, 4, 3000),
(278, 246, 22, 10, 500),
(279, 246, 18, 2, 2500),
(280, 247, 22, 10, 500),
(281, 247, 11, 3, 2500),
(282, 248, 32, 1, 17000),
(283, 248, 10, 3, 5000),
(284, 249, 11, 4, 2500),
(285, 249, 13, 1, 3000),
(286, 250, 22, 10, 500),
(287, 250, 10, 6, 5000),
(288, 251, 22, 10, 500),
(289, 252, 22, 12, 500),
(290, 253, 22, 4, 500),
(291, 253, 11, 2, 2500),
(292, 254, 23, 2, 3000),
(293, 254, 32, 1, 17000),
(294, 255, 10, 12, 5000),
(295, 255, 19, 2, 2000),
(296, 256, 32, 5, 17000),
(297, 257, 20, 2, 4000),
(298, 257, 22, 4, 500),
(299, 258, 21, 2, 2000),
(300, 258, 20, 2, 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `id_transaksi` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tgl_transaksi` timestamp NOT NULL,
  `id_barang` int NOT NULL,
  `jml_barang` int NOT NULL,
  `harga_satuan` int NOT NULL,
  `total_transaksi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_01_08_012510_create_produks_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int NOT NULL,
  `nama` varchar(35) NOT NULL,
  `gender` enum('P','L') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `gender`) VALUES
(40, 'Nabil', 'L'),
(41, 'Zacky', 'L'),
(42, 'Ega', 'L'),
(43, 'Ali', 'L'),
(44, 'Zidan', 'L'),
(45, 'Lintang', 'L'),
(46, 'Ian', 'L'),
(57, 'Yusuf', 'L'),
(59, 'Edo', 'L');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_transaksi` int NOT NULL,
  `id_pelanggan` int NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `total_transaksi` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_transaksi`, `id_pelanggan`, `tgl_transaksi`, `total_transaksi`) VALUES
(20, 40, '2025-01-01', 10000),
(21, 41, '2025-01-15', 2500),
(22, 42, '2025-01-05', 5000),
(23, 43, '2025-01-12', 6000),
(24, 41, '2025-02-15', 6000),
(234, 41, '2025-02-15', 500),
(235, 41, '2025-02-15', 44000),
(236, 41, '2025-02-15', 22000),
(237, 41, '2025-02-15', 54000),
(238, 42, '2025-02-15', 10000),
(239, 40, '2025-02-15', 7000),
(240, 57, '2025-02-15', 11000),
(241, 59, '2025-02-15', 15000),
(242, 42, '2025-02-18', 15000),
(243, 59, '2025-02-18', 19000),
(244, 46, '2025-02-21', 20000),
(245, 40, '2025-02-21', 16000),
(246, 40, '2025-02-22', 10000),
(247, 40, '2025-02-22', 12500),
(248, 59, '2025-02-23', 32000),
(249, 40, '2025-02-23', 13000),
(250, 46, '2025-02-24', 35000),
(251, 42, '2025-02-24', 5000),
(252, 45, '2025-02-24', 6000),
(253, 41, '2025-02-24', 7000),
(254, 43, '2025-02-24', 23000),
(255, 41, '2025-02-24', 64000),
(256, 45, '2025-02-25', 85000),
(257, 46, '2025-02-25', 10000),
(258, 40, '2025-02-25', 12000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `role` enum('admin','karyawan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`) VALUES
(123, 'Fai', '1234', 'admin'),
(135, 'Iqbal', '12345', 'karyawan'),
(137, 'Bambang', '135791', 'karyawan'),
(151, 'Faiz', '999999', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  ADD PRIMARY KEY (`id_transaksi_detil`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `detil_penjualan`
--
ALTER TABLE `detil_penjualan`
  MODIFY `id_transaksi_detil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
