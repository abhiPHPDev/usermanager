-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2024 at 08:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `usermanagement`
--
CREATE DATABASE IF NOT EXISTS `usermanagement` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `usermanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_02_122714_create_user_roles', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 2),
(4, '2019_08_19_000000_create_failed_jobs_table', 2),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(6, '2014_10_12_000000_create_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `profile_photo`, `role_id`, `description`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mrs. Antonina Wisozk II', 'nfeeney@example.org', '5981691345', NULL, NULL, 'asdsadadasd', NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(2, 'Dr. Chelsie West', 'cbeier@example.org', '4601169828', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(3, 'Prof. Cole Braun', 'xroob@example.com', '5060775415', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(4, 'Emerald Hyatt', 'mpadberg@example.net', '1500367896', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(5, 'Sherwood Rau', 'daisy14@example.net', '2319513542', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(6, 'Evan Green', 'jakubowski.wendy@example.com', '7096464333', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(7, 'Cleve Yost', 'clemens.kihn@example.com', '8523781344', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(8, 'Nya Monahan', 'zsauer@example.org', '1329514031', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(9, 'Cydney Grant', 'clemens80@example.com', '1076226431', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(10, 'Bill Bernier', 'norris.wisozk@example.org', '1392590367', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(11, 'Tiara Hirthe Sr.', 'tlockman@example.com', '3734272852', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(12, 'Miss Adella Berge DVM', 'gcassin@example.net', '4493593465', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(13, 'Carson Hegmann', 'adolfo.fisher@example.org', '1265149080', NULL, NULL, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:08:50'),
(14, 'Tara Little', 'westley27@example.net', '2844965311', '1727936771-user.jpg', 7, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:56:11'),
(15, 'Camden Fadel', 'quitzon.clair@example.org', '0429379623', '', 8, NULL, NULL, '2024-10-03 00:08:50', '2024-10-03 00:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-10-03 00:43:22', '2024-10-03 00:43:22'),
(2, 'Admin2', '2024-10-03 00:43:48', '2024-10-03 00:43:48'),
(3, 'Editor', '2024-10-03 00:44:26', '2024-10-03 00:44:26'),
(4, 'subscriber', '2024-10-03 00:45:18', '2024-10-03 00:45:18'),
(5, 'Staff', '2024-10-03 00:46:13', '2024-10-03 00:46:13'),
(6, 'Manager', '2024-10-03 00:46:44', '2024-10-03 00:46:44'),
(7, 'Staff 2', '2024-10-03 00:48:55', '2024-10-03 00:48:55'),
(8, 'Office', '2024-10-03 00:49:44', '2024-10-03 00:50:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD KEY `users_name_email_mobile_role_id_index` (`name`,`email`,`mobile`,`role_id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_roles_role_unique` (`role`),
  ADD KEY `user_roles_role_index` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
