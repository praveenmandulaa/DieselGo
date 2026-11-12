-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2026 at 11:55 AM
-- Server version: 10.11.16-MariaDB
-- PHP Version: 8.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dieselgo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_status_histories`
--

CREATE TABLE `booking_status_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fuel_booking_id` bigint(20) UNSIGNED NOT NULL,
  `changed_by` bigint(20) UNSIGNED NOT NULL,
  `old_status` varchar(255) NOT NULL,
  `new_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_status_histories`
--

INSERT INTO `booking_status_histories` (`id`, `fuel_booking_id`, `changed_by`, `old_status`, `new_status`, `created_at`) VALUES
(1, 4, 2, 'pending', 'confirmed', '2026-11-05 19:20:23'),
(2, 3, 2, 'pending', 'confirmed', '2026-11-05 19:20:26'),
(3, 2, 2, 'pending', 'confirmed', '2026-11-05 19:20:29'),
(4, 1, 2, 'pending', 'confirmed', '2026-11-05 19:20:33'),
(5, 5, 2, 'pending', 'cancelled', '2026-11-06 09:20:02'),
(6, 6, 2, 'pending', 'confirmed', '2026-11-06 12:17:04');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('dieselgo-cache-3345fa78867b25ef3222b9d97e98d357df1be726', 'i:1;', 1793967426),
('dieselgo-cache-3345fa78867b25ef3222b9d97e98d357df1be726:timer', 'i:1793967426;', 1793967426),
('dieselgo-cache-5c785c036466adea360111aa28563bfd556b5fba', 'i:1;', 1793955526),
('dieselgo-cache-5c785c036466adea360111aa28563bfd556b5fba:timer', 'i:1793955526;', 1793955526);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_bookings`
--

CREATE TABLE `fuel_bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fuel_type_id` bigint(20) UNSIGNED NOT NULL,
  `quantity_litres` decimal(10,2) NOT NULL,
  `price_per_litre` decimal(10,2) NOT NULL,
  `total_amount` decimal(12,2) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_bookings`
--

INSERT INTO `fuel_bookings` (`id`, `user_id`, `fuel_type_id`, `quantity_litres`, `price_per_litre`, `total_amount`, `delivery_address`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 100.00, 90.00, 9000.00, 'LB Nagar, Hyderabad', '9999999999', 'confirmed', '2026-11-05 13:15:54', '2026-11-05 13:50:33'),
(2, 1, 1, 50.00, 90.00, 4500.00, 'Kukatpally', '+917095409271', 'confirmed', '2026-11-05 13:25:14', '2026-11-05 13:50:29'),
(3, 1, 1, 22.00, 90.00, 1980.00, 'Kukatpally', '7095409271', 'confirmed', '2026-11-05 13:26:15', '2026-11-05 13:50:26'),
(4, 1, 1, 500.00, 90.00, 45000.00, 'Hyderabad', '+917095409271', 'confirmed', '2026-11-05 13:32:58', '2026-11-05 13:50:23'),
(5, 1, 1, 25.00, 90.00, 2250.00, 'Test', '232', 'cancelled', '2026-11-06 03:49:26', '2026-11-06 03:50:02'),
(6, 1, 1, 20.00, 90.00, 1800.00, 'Test', '+917095409271', 'confirmed', '2026-11-06 06:46:32', '2026-11-06 06:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_types`
--

CREATE TABLE `fuel_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price_per_litre` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fuel_types`
--

INSERT INTO `fuel_types` (`id`, `name`, `price_per_litre`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Diesel', 90.00, 1, '2026-11-05 13:12:38', '2026-11-05 13:12:38');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_11_05_181329_create_personal_access_tokens_table', 1),
(5, '2026_11_05_183857_create_fuel_types_table', 2),
(6, '2026_11_05_183858_create_fuel_bookings_table', 2),
(7, '2026_11_05_190445_add_is_admin_to_users_table', 3),
(8, '2026_11_05_191401_create_booking_status_histories_table', 4);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'dieselgo-mobile', '07eac78d24de91749bd1885129b2aa26fd2918804ab03a4bad1f6aa7c8e92ce0', '[\"*\"]', NULL, NULL, '2026-11-05 12:48:28', '2026-11-05 12:48:28'),
(3, 'App\\Models\\User', 1, 'dieselgo-mobile', 'd88513ef902c87058dc38b76fb923477fb17b762b8bb631d577850d8a072910f', '[\"*\"]', NULL, NULL, '2026-11-05 12:59:19', '2026-11-05 12:59:19'),
(4, 'App\\Models\\User', 1, 'dieselgo-mobile', 'bcdee4483378516fa23f543a5c1ce0c2534913ae8221268b1250c01b8836c40f', '[\"*\"]', NULL, NULL, '2026-11-05 12:59:44', '2026-11-05 12:59:44'),
(5, 'App\\Models\\User', 1, 'dieselgo-mobile', '570708e411294786ed0f1d033630d760fd6b81c69b59778d2625366ba74df6b7', '[\"*\"]', NULL, NULL, '2026-11-05 13:00:10', '2026-11-05 13:00:10'),
(6, 'App\\Models\\User', 1, 'dieselgo-mobile', '37844ee9370b05dc7a5974ed2647a85bad45ef67153da742a7b59327553e76ab', '[\"*\"]', NULL, NULL, '2026-11-05 13:00:44', '2026-11-05 13:00:44'),
(7, 'App\\Models\\User', 1, 'dieselgo-mobile', '22d82c8dc7dd8de9b66c628ad7ac549d766af58539ca4f7c62ae2286b6315524', '[\"*\"]', NULL, NULL, '2026-11-05 13:00:46', '2026-11-05 13:00:46'),
(8, 'App\\Models\\User', 1, 'dieselgo-mobile', '65ac17a2c4f6a8465d658940b6e2b76c65e2018cea1fa8497fc2b383a6df0f9a', '[\"*\"]', NULL, NULL, '2026-11-05 13:02:02', '2026-11-05 13:02:02'),
(9, 'App\\Models\\User', 1, 'dieselgo-mobile', '12746be1b1ef439668ac595576fb660fa90c96c72b0d5c007ec206c8974c3fef', '[\"*\"]', NULL, NULL, '2026-11-05 13:02:09', '2026-11-05 13:02:09'),
(10, 'App\\Models\\User', 1, 'dieselgo-mobile', '95d8b5254931fb75efd02645d727e23f6553b4938c9a2b242418ca03603c1e5a', '[\"*\"]', NULL, NULL, '2026-11-05 13:02:10', '2026-11-05 13:02:10'),
(11, 'App\\Models\\User', 1, 'dieselgo-mobile', '8b1dd21a70944e987c8ced5c52fdc898d7ffc18f7175b371bf79f520220d2c2b', '[\"*\"]', NULL, NULL, '2026-11-05 13:02:58', '2026-11-05 13:02:58'),
(12, 'App\\Models\\User', 1, 'dieselgo-mobile', '579fab2e09ae96f045bd1977115b59468a5d5d107cf36f127c47d3a31497927b', '[\"*\"]', NULL, NULL, '2026-11-05 13:05:59', '2026-11-05 13:05:59'),
(14, 'App\\Models\\User', 1, 'dieselgo-mobile', 'c0d7cb4fe7e9b0921cc02961b8db2fdfcf845d6c59e47a84f28784f8d52f593a', '[\"*\"]', '2026-11-05 13:16:53', NULL, '2026-11-05 13:13:34', '2026-11-05 13:16:53'),
(16, 'App\\Models\\User', 1, 'dieselgo-mobile', '52ad2931dd7ee2eee7787c5b1d4cbf18533bb0b4f86e86b087fdabc66850133d', '[\"*\"]', '2026-11-05 13:31:06', NULL, '2026-11-05 13:31:06', '2026-11-05 13:31:06'),
(18, 'App\\Models\\User', 1, 'dieselgo-mobile', 'c10c9b21345b765873a241a1704436f80aea7586a122f95f0fdaf164deef371c', '[\"*\"]', '2026-11-05 13:51:10', NULL, '2026-11-05 13:51:08', '2026-11-05 13:51:10'),
(19, 'App\\Models\\User', 1, 'dieselgo-mobile', 'a8b7523f694bec6ae49440cb4524ab201a815d541c9d07d5994f1a9a1f3b8b4d', '[\"*\"]', '2026-11-06 03:30:38', NULL, '2026-11-06 03:30:37', '2026-11-06 03:30:38'),
(20, 'App\\Models\\User', 1, 'dieselgo-mobile', '9e71952709a6b1d3fec8e1ed6a7c3b2321ddf45ce76d11f86d909ecbfaa5a086', '[\"*\"]', '2026-11-06 03:50:11', NULL, '2026-11-06 03:48:39', '2026-11-06 03:50:11'),
(21, 'App\\Models\\User', 1, 'dieselgo-mobile', '46c76be486ecb3175158586c42ddf7561cb8c4f238af2ecd1d9ba15b1cd6b7d8', '[\"*\"]', '2026-11-06 06:47:10', NULL, '2026-11-06 06:46:06', '2026-11-06 06:47:10');

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
('DxMESh35ekQO9Kpbyqx50nHoVk0BGiXmnlvO1JvT', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI3cEUwY0xzSDJUbVdDbXFRWnhwRmtHSzU1TnZoMVZMMWoxbktOQldRIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9hZG1pblwvYm9va2luZ3MiLCJyb3V0ZSI6ImFkbWluLmJvb2tpbmdzLmluZGV4In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInBhc3N3b3JkX2hhc2hfd2ViIjoiOGUxNmU2MTE1Y2M1NGYzMWY4ZThlODQ0MTBmMzY5MTgwNWM1YTQ2MWE3YTNlNWEzODAxYTUzZDJkOTYwY2U2NSJ9', 1793967424),
('puAI26Mdo4qHhLgaoR3lOOI05ZrNLKFcJF5911BS', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJoUUVJbG1pcDg1dUVQUWt3VXVrWjd0eklXMERtSzJSdDZFUFpiWjFZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9hZG1pblwvZGFzaGJvYXJkIiwicm91dGUiOiJhZG1pbi5kYXNoYm9hcmQifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MiwicGFzc3dvcmRfaGFzaF93ZWIiOiI4ZTE2ZTYxMTVjYzU0ZjMxZjhlOGU4NDQxMGYzNjkxODA1YzVhNDYxYTdhM2U1YTM4MDFhNTNkMmQ5NjBjZTY1In0=', 1793906437);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `is_admin`) VALUES
(1, 'DieselGo Test User', 'test@dieselgo.local', NULL, '$2y$12$wbRT7a/F0qNTrZE5HqI4r.D/EmGmuj9frXH5njYp1You8vRmS0pO.', NULL, '2026-11-05 12:48:28', '2026-11-05 12:48:28', 0),
(2, 'DieselGo Admin', 'admin@dieselgo.local', NULL, '$2y$12$njmyh3eW61pme7a4uf.1EOMVnaKRBh4SGwjIYAIrb0j4yoMlZYoB.', NULL, '2026-11-05 13:36:03', '2026-11-05 13:36:29', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_status_histories`
--
ALTER TABLE `booking_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_status_histories_changed_by_foreign` (`changed_by`),
  ADD KEY `booking_status_histories_fuel_booking_id_created_at_index` (`fuel_booking_id`,`created_at`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `fuel_bookings`
--
ALTER TABLE `fuel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_bookings_user_id_foreign` (`user_id`),
  ADD KEY `fuel_bookings_fuel_type_id_foreign` (`fuel_type_id`);

--
-- Indexes for table `fuel_types`
--
ALTER TABLE `fuel_types`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
-- AUTO_INCREMENT for table `booking_status_histories`
--
ALTER TABLE `booking_status_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_bookings`
--
ALTER TABLE `fuel_bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `fuel_types`
--
ALTER TABLE `fuel_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_status_histories`
--
ALTER TABLE `booking_status_histories`
  ADD CONSTRAINT `booking_status_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `booking_status_histories_fuel_booking_id_foreign` FOREIGN KEY (`fuel_booking_id`) REFERENCES `fuel_bookings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `fuel_bookings`
--
ALTER TABLE `fuel_bookings`
  ADD CONSTRAINT `fuel_bookings_fuel_type_id_foreign` FOREIGN KEY (`fuel_type_id`) REFERENCES `fuel_types` (`id`),
  ADD CONSTRAINT `fuel_bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
