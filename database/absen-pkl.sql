-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2024 at 05:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absen-pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `NISN` char(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `guru_pembimbing` varchar(255) DEFAULT NULL,
  `latitude_absen` varchar(255) NOT NULL,
  `longitude_absen` varchar(255) NOT NULL,
  `tanggal` varchar(255) NOT NULL,
  `jam` time NOT NULL,
  `foto_absen` blob DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `nama`, `NISN`, `kelas`, `guru_pembimbing`, `latitude_absen`, `longitude_absen`, `tanggal`, `jam`, `foto_absen`, `status`, `updated_at`, `created_at`) VALUES
(22, 'BREMBO', '234132', 'XII TKRO', 'ARIF', '-7.2500371', '109.7945541', '18 April 2024', '11:31:50', 0x36765a4c6f676c343746496a38646d62566f41532e6a7067, 'Absen', '2024-04-18 04:33:05', '2024-04-18 04:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurnals`
--

CREATE TABLE `jurnals` (
  `id` int(11) NOT NULL,
  `guru_pembimbing` varchar(250) NOT NULL,
  `kegiatan` varchar(250) DEFAULT NULL,
  `tanggal` varchar(250) NOT NULL,
  `siswa` varchar(500) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jurnals`
--

INSERT INTO `jurnals` (`id`, `guru_pembimbing`, `kegiatan`, `tanggal`, `siswa`, `updated_at`, `created_at`) VALUES
(1, 'GURU', 'dsfjhjsfd', '16 April 2024', 'BREMBO,SISWA', '2024-04-16 03:40:22', '2024-04-16 03:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `wali_kelas` varchar(30) NOT NULL,
  `NIP` char(18) NOT NULL,
  `profil` varchar(255) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `wali_kelas`, `NIP`, `profil`, `updated_at`, `created_at`) VALUES
(2, 'BDP', 'MBH', '0342704135 1324 21', 'HrBQOEFRJPEvvLb7SJiYTuE6jFNSBe24fcDIeVRb.jpg', '2024-04-02 06:35:50', '2024-04-02 06:17:41');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_presensis`
--

CREATE TABLE `lokasi_presensis` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(255) NOT NULL,
  `alamat_lokasi` varchar(255) NOT NULL,
  `guru_pembimbing` varchar(250) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `radius` int(11) NOT NULL,
  `zona_waktu` varchar(20) NOT NULL,
  `jam_masuk` time NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi_presensis`
--

INSERT INTO `lokasi_presensis` (`id`, `nama_lokasi`, `alamat_lokasi`, `guru_pembimbing`, `latitude`, `longitude`, `radius`, `zona_waktu`, `jam_masuk`, `created_at`, `updated_at`) VALUES
(2, 'AMIKOM', 'Banjarnegara', 'ARIF', '-7.364240', '109.901749', 1000, 'Asia/Jakarta', '19:20:00', '2024-04-17 07:20:38', '2024-04-17 07:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('EgSQe0KLOdZDnPylt502QJDUEpFZ9nXmXEOR9XEo', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiS2xQYVFQMUtobmkwaGpMZFFteEVqRGVsNXhieWN5dUZuQkdkd0d1NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wZGZfZ2VuZXJhdG9yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1713525215),
('G9hVPEnEEa7DRItqDrVNVZmUCsikQYW8SfPfeszn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTk2TFRFWE9HTjlKNVQ0am9DTmNVbTZFYTZ6TUdjUm5zZFlSaXJpYSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHBvcnQtcGRmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1713527128),
('GKGJ4y5KGePPVpzl8FalVoNGKfOXikpaLyK8qGig', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 Edg/123.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWHVuNlA3SjRsSUJ0MGtOUEpIa05ZMmdkRUtFYnV4ZzhyalR6bHh2cSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1713528566),
('TeLu6WlHjl1TaeKIOyTEJdrUVhoO1Jo0O9AMgMhv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOXFiNzNBU0FNODZCdkZPcE5xTHFUbEN5N3p0YVRTbmQwTXRkUTBPZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9maWx0ZXItcmVrYXA/a2VsYXM9U2VtdWEiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1713530715),
('Xo658uIuk0tHrp0tEyAlWladeUMPQzNhcoeVZtXB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRzRQQmE2YzBMaGtoUWlrbHdUbUJDbjNmc0ZkMUp0RWkwc0NYaVpBQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9leHBvcnQtcGRmIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1713527125);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `NISN` char(10) DEFAULT NULL,
  `NIP` char(25) DEFAULT NULL,
  `kelas` varchar(10) DEFAULT NULL,
  `HP` char(13) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `profil` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 3,
  `lokasi_presensi` varchar(255) DEFAULT NULL,
  `guru_pembimbing` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `NISN`, `NIP`, `kelas`, `HP`, `email`, `email_verified_at`, `password`, `profil`, `role`, `lokasi_presensi`, `guru_pembimbing`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', NULL, '2134565 2335', NULL, '98765653423', 'admin@gmail.com', NULL, '$2y$12$pevBkHXKkKUQO9ihHuIiw.eGSB9Oad4ZXoz.37DDONTlRoRfOg18e', 'TXDAIMacqd9gvrSL99NjLFwGHP0kw4Un7TmolJ2F.png', 1, NULL, '', NULL, NULL, '2024-04-01 03:09:36'),
(2, 'GURU', NULL, '0964347 43905 38 383', NULL, '09433409435', 'guru@gmail.com', NULL, '$2y$12$pevBkHXKkKUQO9ihHuIiw.eGSB9Oad4ZXoz.37DDONTlRoRfOg18e', '3YFmVC6UalJitULbHTXkiYVMsh78ZzaqU9CXeUxd.jpg', 2, '', '', NULL, NULL, '2024-04-01 03:47:39'),
(3, 'SISWA', '21326', NULL, 'XII RPL', '095609845745', 'siswa@gmail.com', NULL, '$2y$12$pevBkHXKkKUQO9ihHuIiw.eGSB9Oad4ZXoz.37DDONTlRoRfOg18e', 'bLxRQzZK7K0snFZsDY3BBFVD0N6vLn6gKZpnDoHC.jpg', 3, 'AMIKOM', 'GURU', NULL, NULL, '2024-04-01 05:36:12'),
(11, 'BREMBO', '234132', NULL, 'XII TKRO', '0868468486', 'brembo@gmail.com', NULL, '$2y$12$DVMoCLSw4hZe5smiUtMhE.i1lhmguBTrIAaIKP6UubfbwhGOOdOGm', 'Dxg0QJEV6g24xUEIfJYfBmEXosK6owMhP4lEB4DY.jpg', 3, 'AMIKOM', 'GURU', NULL, '2024-04-13 23:41:34', '2024-04-13 23:41:34'),
(14, 'BIMO', '234132', NULL, 'XII BDP', '0894967437575', 'bimo@gmail.com', NULL, '$2y$12$JmcF7P2GcSi/akFa61GNIuRypGu3WzvkIy./.wUC/6ng.sdP5/C0m', 'FFrSO4zMvgqoMzPoSDP7DP85A7cl5n07ufPZjMil.png', 3, 'AMIKOM', 'GURU', NULL, '2024-04-15 22:14:12', '2024-04-15 22:14:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `jurnals`
--
ALTER TABLE `jurnals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_presensis`
--
ALTER TABLE `lokasi_presensis`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurnals`
--
ALTER TABLE `jurnals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi_presensis`
--
ALTER TABLE `lokasi_presensis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
