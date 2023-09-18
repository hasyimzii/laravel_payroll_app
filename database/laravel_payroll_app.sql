-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2023 at 04:53 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_payroll_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `birth_place` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `position` varchar(20) NOT NULL,
  `status` enum('fulltime','contract','freelance') NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `allowance` int(11) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `birth_place`, `birth_date`, `gender`, `position`, `status`, `basic_salary`, `allowance`, `start_date`) VALUES
(1, 'Mamat Surahmat', 'Jember', '1998-10-11', 'male', 'Staff Web Developer', 'fulltime', 5000000, 2000000, '2021-09-01'),
(2, 'Tati Surati', 'Bekasi', '2000-02-22', 'female', 'Staff Accountant', 'freelance', 4000000, 1000000, '2023-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_fee` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `insurances`
--

INSERT INTO `insurances` (`id`, `employee_id`, `total_fee`, `created_at`, `updated_at`) VALUES
(1, 1, 210000, '2023-08-01 01:00:00', '2023-09-18 04:54:58');

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
(1, '2014_09_16_232746_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_09_17_020319_create_employees_table', 1),
(5, '2023_09_17_021810_create_presences_table', 1),
(6, '2023_09_17_022951_create_overtimes_table', 1),
(7, '2023_09_17_023712_create_insurances_table', 1),
(8, '2023_09_17_023816_create_payrolls_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `overtimes`
--

CREATE TABLE `overtimes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hours` int(11) NOT NULL,
  `total_salary` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overtimes`
--

INSERT INTO `overtimes` (`id`, `employee_id`, `hours`, `total_salary`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 161850, '2023-08-01 01:00:00', '2023-09-18 04:54:58'),
(2, 2, 6, 184971, '2023-08-02 01:00:00', '2023-09-18 04:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `basic_salary` int(11) NOT NULL,
  `allowance` int(11) NOT NULL,
  `incentive` int(11) NOT NULL,
  `overtime` int(11) NOT NULL,
  `nwnp` int(11) NOT NULL,
  `insurance` int(11) NOT NULL,
  `status` enum('draft','approved') NOT NULL,
  `payroll_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `employee_id`, `user_id`, `basic_salary`, `allowance`, `incentive`, `overtime`, `nwnp`, `insurance`, `status`, `payroll_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5000000, 2000000, 1200000, 1000000, 50000, 150000, 'draft', '2023-07-01', '2023-09-18 04:54:58', '2023-09-18 06:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

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
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('present','leave') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `presences`
--

INSERT INTO `presences` (`id`, `employee_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'present', '2023-08-01 01:00:00', '2023-09-18 04:54:56'),
(2, 2, 'present', '2023-08-01 01:00:00', '2023-09-18 04:54:57'),
(3, 1, 'present', '2023-08-02 01:00:00', '2023-09-18 04:54:57'),
(4, 2, 'present', '2023-08-02 01:00:00', '2023-09-18 04:54:57'),
(5, 1, 'present', '2023-08-03 01:00:00', '2023-09-18 04:54:57'),
(6, 2, 'present', '2023-08-03 01:00:00', '2023-09-18 04:54:57'),
(7, 1, 'present', '2023-08-04 01:00:00', '2023-09-18 04:54:57'),
(8, 2, 'present', '2023-08-04 01:00:00', '2023-09-18 04:54:57'),
(9, 1, 'present', '2023-08-07 01:00:00', '2023-09-18 04:54:57'),
(10, 2, 'present', '2023-08-07 01:00:00', '2023-09-18 04:54:57'),
(11, 1, 'present', '2023-08-08 01:00:00', '2023-09-18 04:54:57'),
(12, 2, 'present', '2023-08-08 01:00:00', '2023-09-18 04:54:57'),
(13, 1, 'present', '2023-08-09 01:00:00', '2023-09-18 04:54:57'),
(14, 2, 'present', '2023-08-09 01:00:00', '2023-09-18 04:54:57'),
(15, 1, 'present', '2023-08-10 01:00:00', '2023-09-18 04:54:57'),
(16, 2, 'present', '2023-08-10 01:00:00', '2023-09-18 04:54:57'),
(17, 1, 'present', '2023-08-11 01:00:00', '2023-09-18 04:54:57'),
(18, 2, 'present', '2023-08-11 01:00:00', '2023-09-18 04:54:57'),
(19, 1, 'present', '2023-08-14 01:00:00', '2023-09-18 04:54:57'),
(20, 2, 'present', '2023-08-14 01:00:00', '2023-09-18 04:54:57'),
(21, 1, 'present', '2023-08-15 01:00:00', '2023-09-18 04:54:57'),
(22, 2, 'present', '2023-08-15 01:00:00', '2023-09-18 04:54:57'),
(23, 1, 'present', '2023-08-16 01:00:00', '2023-09-18 04:54:57'),
(24, 2, 'present', '2023-08-16 01:00:00', '2023-09-18 04:54:57'),
(25, 1, 'present', '2023-08-17 01:00:00', '2023-09-18 04:54:57'),
(26, 2, 'present', '2023-08-17 01:00:00', '2023-09-18 04:54:57'),
(27, 1, 'present', '2023-08-18 01:00:00', '2023-09-18 04:54:58'),
(28, 2, 'present', '2023-08-18 01:00:00', '2023-09-18 04:54:58'),
(29, 1, 'present', '2023-08-21 01:00:00', '2023-09-18 04:54:58'),
(30, 2, 'present', '2023-08-21 01:00:00', '2023-09-18 04:54:58'),
(31, 1, 'present', '2023-08-22 01:00:00', '2023-09-18 04:54:58'),
(32, 2, 'present', '2023-08-22 01:00:00', '2023-09-18 04:54:58'),
(33, 1, 'present', '2023-08-23 01:00:00', '2023-09-18 04:54:58'),
(34, 2, 'present', '2023-08-23 01:00:00', '2023-09-18 04:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'supervisor'),
(2, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'User Supervisor', 'spvpayroll', '$2y$10$qxxB8TN9r5UhgDgregJ6W.hl0uSlxB26H4LoCMZA3qDWzm1VFpCOi', 'LBNbJtxTijuyKCeZlyZrbvOqH5lZIqRIYWwPM8PB5KxuUhi7GQfAhCMw7xBJ', '2023-09-18 04:54:56', '2023-09-18 04:54:56'),
(2, 2, 'User Staff', 'stfpayroll', '$2y$10$Fwnh9x5OMZzRMzsrQvTUieLNxbOB4CGSLgnjKJrCwmPCj59d8u2zG', NULL, '2023-09-18 04:54:56', '2023-09-18 04:54:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `overtimes_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payrolls_employee_id_foreign` (`employee_id`),
  ADD KEY `payrolls_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `presences_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `overtimes`
--
ALTER TABLE `overtimes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `insurances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `overtimes`
--
ALTER TABLE `overtimes`
  ADD CONSTRAINT `overtimes_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD CONSTRAINT `payrolls_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `presences`
--
ALTER TABLE `presences`
  ADD CONSTRAINT `presences_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
