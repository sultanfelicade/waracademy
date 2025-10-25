-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 25, 2025 at 02:10 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `waracademy`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kisi_kisi`
--

CREATE TABLE `kisi_kisi` (
  `id_kisi` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `topik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_soal` int NOT NULL,
  `waktu_menit` int NOT NULL,
  `jenis_soal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kisi_kisi`
--

INSERT INTO `kisi_kisi` (`id_kisi`, `level_id`, `topik`, `jumlah_soal`, `waktu_menit`, `jenis_soal`) VALUES
(1, 1, 'Bilangan Bulat', 20, 30, 'pilihan_ganda'),
(2, 2, 'Pecahan', 15, 25, 'pilihan_ganda'),
(3, 3, 'Geometri Dasar', 10, 20, 'esai');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int NOT NULL,
  `nomor_level` int NOT NULL,
  `tingkat_kesulitan` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nomor_level`, `tingkat_kesulitan`) VALUES
(1, 1, 1),
(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_10_11_062527_add_google_id_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pencapaian`
--

CREATE TABLE `pencapaian` (
  `id_pencapaian` int NOT NULL,
  `nama_pencapaian` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencapaian`
--

INSERT INTO `pencapaian` (`id_pencapaian`, `nama_pencapaian`, `deskripsi`) VALUES
(1, 'Langkah Pertama', 'Berhasil menyelesaikan level 1.');

-- --------------------------------------------------------

--
-- Table structure for table `pencapaianpengguna`
--

CREATE TABLE `pencapaianpengguna` (
  `id` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_pencapaian` int NOT NULL,
  `tanggal_didapat` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pencapaianpengguna`
--

INSERT INTO `pencapaianpengguna` (`id`, `id_pengguna`, `id_pencapaian`, `tanggal_didapat`) VALUES
(1, 1, 1, '2025-10-09 09:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('student','teacher') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'student',
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_exp` int DEFAULT '0',
  `deskripsi_profil` text COLLATE utf8mb4_general_ci,
  `avatar_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_registrasi` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `email`, `role`, `password_hash`, `google_id`, `total_exp`, `deskripsi_profil`, `avatar_url`, `tanggal_registrasi`) VALUES
(1, 'budisantoso', 'budi@email.com', 'student', 'hash12345', NULL, 100, NULL, NULL, '2025-10-09 09:28:07'),
(2, 'Ibu Retno', 'retno@guru.id', 'teacher', 'hash67890', NULL, 0, NULL, NULL, '2025-10-09 09:28:07'),
(3, 'paijo', 'paijo@gmail.com', 'student', '$2y$12$ZuFzC4YCkB.YxgOrWGF6A..DNuL96xOTshM79gvWivKMRLpA27BO6', NULL, 0, NULL, NULL, '2025-10-10 23:17:19'),
(4, 'Fajar Ali Hamzah_ MVP', 'pajarali15@gmail.com', 'student', '$2y$12$WEyJytynopwe.rC.rzku0uB0K24QA8ntaDJuBxUOoBCl/OGxYiRHi', '115700289121580866720', 0, NULL, NULL, '2025-10-10 23:34:02'),
(5, 'pa jarrr', 'pajarrr880@gmail.com', 'student', '$2y$12$bRXfQIbXN6pXoFq2lUOBOuWDGzHysgpfgLBwTXq9dUOj4V1ZBOHiu', '100178159551451873969', 0, NULL, NULL, '2025-10-11 07:21:54'),
(6, '23-040_ M. ALDI RAHMANDIKA', 'aldirahmandika2@gmail.com', 'student', '$2y$12$ok0IMF0Mz6bLs0Ea3c1c9ekiaiG5CsoDw4vpXGL73TQuP/xFtOaSi', '116026049394161582648', 0, NULL, NULL, '2025-10-25 06:40:34');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int NOT NULL,
  `id_level` int DEFAULT NULL,
  `teks_pertanyaan` text COLLATE utf8mb4_general_ci NOT NULL,
  `untuk_turnamen` tinyint(1) DEFAULT '0',
  `dibuat_oleh` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_level`, `teks_pertanyaan`, `untuk_turnamen`, `dibuat_oleh`) VALUES
(1, 1, 'Ibu kota negara Indonesia adalah...', 0, NULL),
(2, 1, 'Berapa hasil dari 5 + 7?', 0, NULL),
(3, NULL, 'Siapa yang menjahit Bendera Pusaka Merah Putih?', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesertaturnamen`
--

CREATE TABLE `pesertaturnamen` (
  `id_peserta` int NOT NULL,
  `id_turnamen` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `skor_akhir` int DEFAULT '0',
  `peringkat` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesertaturnamen`
--

INSERT INTO `pesertaturnamen` (`id_peserta`, `id_turnamen`, `id_pengguna`, `skor_akhir`, `peringkat`) VALUES
(1, 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pilihanjawaban`
--

CREATE TABLE `pilihanjawaban` (
  `id_jawaban` int NOT NULL,
  `id_pertanyaan` int NOT NULL,
  `teks_jawaban` text COLLATE utf8mb4_general_ci NOT NULL,
  `adalah_benar` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pilihanjawaban`
--

INSERT INTO `pilihanjawaban` (`id_jawaban`, `id_pertanyaan`, `teks_jawaban`, `adalah_benar`) VALUES
(1, 1, 'Bandung', 0),
(2, 1, 'Surabaya', 0),
(3, 1, 'Jakarta', 1),
(4, 1, 'Medan', 0),
(5, 2, '10', 0),
(6, 2, '12', 1),
(7, 2, '15', 0),
(8, 3, 'R.A. Kartini', 0),
(9, 3, 'Fatmawati', 1);

-- --------------------------------------------------------

--
-- Table structure for table `progreslevelpengguna`
--

CREATE TABLE `progreslevelpengguna` (
  `id_progres` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_level` int NOT NULL,
  `bintang_tertinggi` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `progreslevelpengguna`
--

INSERT INTO `progreslevelpengguna` (`id_progres`, `id_pengguna`, `id_level`, `bintang_tertinggi`) VALUES
(1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `riwayatpertandingan`
--

CREATE TABLE `riwayatpertandingan` (
  `id_pertandingan` int NOT NULL,
  `id_pengguna` int NOT NULL,
  `id_level` int DEFAULT NULL,
  `id_turnamen` int DEFAULT NULL,
  `exp_didapat` int NOT NULL,
  `bintang_didapat` int DEFAULT NULL,
  `waktu_selesai` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayatpertandingan`
--

INSERT INTO `riwayatpertandingan` (`id_pertandingan`, `id_pengguna`, `id_level`, `id_turnamen`, `exp_didapat`, `bintang_didapat`, `waktu_selesai`) VALUES
(1, 1, 1, NULL, 100, 5, '2025-10-09 09:28:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3zibE9HrRvqVWSuNo8vS2YpCGkE8uUWnVpSypWdT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZGlQV1JOdkRheW5OWTMyZDdFQUd5UHR0V3pESXA4aml3ZWpvYjdUVCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fX0=', 1760192538),
('NIL855ZqVbHzlyMZ2ABr427ND0rzslbAkYxC5o5T', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidWtMblJUdjlQSlZXblFqYlpueXA3TUNUaXpMMXlVeDVva3Q0Vk4wTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9hdXRoL2dvb2dsZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NToic3RhdGUiO3M6NDA6IklMN254YjdZamFpb01FMElta2kxalh3ZktzSTM5VHZpQlFpdTB3VnYiO30=', 1761399629),
('R8qGuK4pCWrxeDmwwNYObsrih9duygZ5DPyWRGFC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiVGlIZDFSSktIV3czNVMxUWZqdzgyaEdkWUg5TmpqeDdodGg2V0NqUSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1OiJzdGF0ZSI7czo0MDoidW80ejJiWEpHWDlZUGtoTjZlNXBCdFI4VGFQNzB1MW5nbTFBWGVUZyI7czoxMToicGVuZ2d1bmFfaWQiO2k6NTtzOjE3OiJwZW5nZ3VuYV91c2VybmFtZSI7czo4OiJwYSBqYXJyciI7czoxMzoicGVuZ2d1bmFfcm9sZSI7czo3OiJzdHVkZW50Ijt9', 1760192516),
('ruZfpkAeh8zk9X813EcTbS1ckA65FmTA3twHZANl', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiOEtEZlZobmtnWWFhcGFad2dUUG9wZThGeXJ2VXE2c0RDdVRYejlmUyI7czoxMToicGVuZ2d1bmFfaWQiO2k6NjtzOjE3OiJwZW5nZ3VuYV91c2VybmFtZSI7czoyNjoiMjMtMDQwXyBNLiBBTERJIFJBSE1BTkRJS0EiO3M6MTM6InBlbmdndW5hX3JvbGUiO3M6Nzoic3R1ZGVudCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sZXZlbC8xL3N0YXJ0Ijt9fQ==', 1761400642),
('sIJ2CLbZ4Rd3vLMU6hDE752qL4OtZadcOLhCfwkU', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoienFSNFZaWHFub1F5cE5QSTljbDY1RElyMjl6QThPSDFUVFBWejRzRiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czoxMToicGVuZ2d1bmFfaWQiO2k6MztzOjE3OiJwZW5nZ3VuYV91c2VybmFtZSI7czo1OiJwYWlqbyI7czoxMzoicGVuZ2d1bmFfcm9sZSI7czo3OiJzdHVkZW50Ijt9', 1760192533);

-- --------------------------------------------------------

--
-- Table structure for table `turnamen`
--

CREATE TABLE `turnamen` (
  `id_turnamen` int NOT NULL,
  `nama_turnamen` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `kode_room` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `dibuat_oleh` int DEFAULT NULL,
  `level_minimal` int DEFAULT '20',
  `status` enum('Menunggu','Berlangsung','Selesai') COLLATE utf8mb4_general_ci DEFAULT 'Menunggu'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `turnamen`
--

INSERT INTO `turnamen` (`id_turnamen`, `nama_turnamen`, `kode_room`, `dibuat_oleh`, `level_minimal`, `status`) VALUES
(1, 'Kuis Kemerdekaan', 'MERDEKA', 2, 1, 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'pa jarrr', 'pajarrr880@gmail.com', '100178159551451873969', NULL, '$2y$12$RB5aIWp2iqsDRhJlj/qrzO31z/Say8at7njsQVBhN5N1QlPZPmoLW', NULL, '2025-10-10 23:27:33', '2025-10-10 23:29:09'),
(2, 'Fajar Ali Hamzah_ MVP', 'pajarali15@gmail.com', '115700289121580866720', NULL, '$2y$12$OxTAKAEtATT.eM8D/XSwmep1bFjsTtk/QO4aLcSRhCm0cUTBEBFG.', NULL, '2025-10-10 23:32:38', '2025-10-10 23:32:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kisi_kisi`
--
ALTER TABLE `kisi_kisi`
  ADD PRIMARY KEY (`id_kisi`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pencapaian`
--
ALTER TABLE `pencapaian`
  ADD PRIMARY KEY (`id_pencapaian`);

--
-- Indexes for table `pencapaianpengguna`
--
ALTER TABLE `pencapaianpengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_pengguna` (`id_pengguna`,`id_pencapaian`),
  ADD KEY `id_pencapaian` (`id_pencapaian`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `google_id` (`google_id`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `pesertaturnamen`
--
ALTER TABLE `pesertaturnamen`
  ADD PRIMARY KEY (`id_peserta`),
  ADD UNIQUE KEY `id_turnamen` (`id_turnamen`,`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `pilihanjawaban`
--
ALTER TABLE `pilihanjawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `progreslevelpengguna`
--
ALTER TABLE `progreslevelpengguna`
  ADD PRIMARY KEY (`id_progres`),
  ADD UNIQUE KEY `id_pengguna` (`id_pengguna`,`id_level`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `riwayatpertandingan`
--
ALTER TABLE `riwayatpertandingan`
  ADD PRIMARY KEY (`id_pertandingan`),
  ADD KEY `id_pengguna` (`id_pengguna`),
  ADD KEY `id_level` (`id_level`),
  ADD KEY `id_turnamen` (`id_turnamen`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `turnamen`
--
ALTER TABLE `turnamen`
  ADD PRIMARY KEY (`id_turnamen`),
  ADD UNIQUE KEY `kode_room` (`kode_room`),
  ADD KEY `dibuat_oleh` (`dibuat_oleh`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kisi_kisi`
--
ALTER TABLE `kisi_kisi`
  MODIFY `id_kisi` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pencapaian`
--
ALTER TABLE `pencapaian`
  MODIFY `id_pencapaian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pencapaianpengguna`
--
ALTER TABLE `pencapaianpengguna`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pesertaturnamen`
--
ALTER TABLE `pesertaturnamen`
  MODIFY `id_peserta` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pilihanjawaban`
--
ALTER TABLE `pilihanjawaban`
  MODIFY `id_jawaban` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `progreslevelpengguna`
--
ALTER TABLE `progreslevelpengguna`
  MODIFY `id_progres` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `riwayatpertandingan`
--
ALTER TABLE `riwayatpertandingan`
  MODIFY `id_pertandingan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `turnamen`
--
ALTER TABLE `turnamen`
  MODIFY `id_turnamen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pencapaianpengguna`
--
ALTER TABLE `pencapaianpengguna`
  ADD CONSTRAINT `pencapaianpengguna_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `pencapaianpengguna_ibfk_2` FOREIGN KEY (`id_pencapaian`) REFERENCES `pencapaian` (`id_pencapaian`);

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`),
  ADD CONSTRAINT `pertanyaan_ibfk_2` FOREIGN KEY (`dibuat_oleh`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `pesertaturnamen`
--
ALTER TABLE `pesertaturnamen`
  ADD CONSTRAINT `pesertaturnamen_ibfk_1` FOREIGN KEY (`id_turnamen`) REFERENCES `turnamen` (`id_turnamen`),
  ADD CONSTRAINT `pesertaturnamen_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `pilihanjawaban`
--
ALTER TABLE `pilihanjawaban`
  ADD CONSTRAINT `pilihanjawaban_ibfk_1` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Constraints for table `progreslevelpengguna`
--
ALTER TABLE `progreslevelpengguna`
  ADD CONSTRAINT `progreslevelpengguna_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `progreslevelpengguna_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`);

--
-- Constraints for table `riwayatpertandingan`
--
ALTER TABLE `riwayatpertandingan`
  ADD CONSTRAINT `riwayatpertandingan_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`),
  ADD CONSTRAINT `riwayatpertandingan_ibfk_2` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`),
  ADD CONSTRAINT `riwayatpertandingan_ibfk_3` FOREIGN KEY (`id_turnamen`) REFERENCES `turnamen` (`id_turnamen`);

--
-- Constraints for table `turnamen`
--
ALTER TABLE `turnamen`
  ADD CONSTRAINT `turnamen_ibfk_1` FOREIGN KEY (`dibuat_oleh`) REFERENCES `pengguna` (`id_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
