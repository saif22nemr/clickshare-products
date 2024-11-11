-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 15, 2024 at 10:00 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_arib`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'one', '2024-10-14 16:45:56', '2024-10-14 16:45:56'),
(4, 'two', '2024-10-14 16:50:03', '2024-10-14 16:50:03'),
(5, 'three', '2024-10-14 16:50:12', '2024-10-14 16:50:12'),
(6, 'four', '2024-10-14 16:50:26', '2024-10-14 16:50:26');

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_10_13_101532_create_tasks_table', 2),
(10, '2024_10_13_101834_create_departments_table', 3),
(11, '2024_10_13_101844_create_user_departments_table', 3),
(12, '2024_10_13_102226_add_image_to_users_table', 4),
(13, '2024_10_14_172601_change_type_to_users_table', 5),
(14, '2024_10_14_232442_add_manager_to_tasks_tablee', 6);

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
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('new','in_progress','complete','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `employee_id`, `manager_id`, `status`, `subject`, `description`, `created_at`, `updated_at`) VALUES
(1, 17, 11, 'complete', 'subject', 'description', '2024-10-14 20:40:55', '2024-10-14 21:08:15'),
(2, 16, 11, 'complete', 'Second subject', 'second description \r\nsecond description second description \r\nsecond description', '2024-10-14 20:50:59', '2024-10-15 08:49:09'),
(3, 16, 11, 'canceled', 'subject task', 'Task description', '2024-10-15 08:07:35', '2024-10-15 08:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `type` enum('employee','manager','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salary` int UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manager_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `type`, `first_name`, `last_name`, `email`, `image`, `salary`, `email_verified_at`, `password`, `manager_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, 'employee', 'saif', 'hesham', 'saif2nemr@gmail.com', 'users/t4fd1HNmaIzDCRrGGD5atFytawzbKvkpJylbEQYz.jpg', 2000, NULL, '$2y$12$/3v4YSZAchte.C88rYVKb.kg/35OoRX6smQoNUUjdhFHfsQ440Czi', NULL, NULL, '2024-10-14 07:38:39', '2024-10-14 07:38:39'),
(8, 'manager', 'Manager', 'manager', 'manager@app.test', 'users/eIhMZHDhc99tsuK4SUhiu5NdnbzSnI9WqVUWz3H7.jpg', 2000, NULL, '$2y$12$/3v4YSZAchte.C88rYVKb.kg/35OoRX6smQoNUUjdhFHfsQ440Czi', NULL, NULL, '2024-10-14 07:38:39', '2024-10-14 17:18:53'),
(9, 'admin', 'Admin', 'Account', 'admin@app.test', NULL, 2000, NULL, '$2y$12$/3v4YSZAchte.C88rYVKb.kg/35OoRX6smQoNUUjdhFHfsQ440Czi', NULL, NULL, '2024-10-14 07:38:39', '2024-10-14 07:38:39'),
(10, 'employee', 'one2', 'one', 'one@app.com', 'users/FgQNeMj5CsyjoSOaWC1NmXDMvLSsdpfcYYIM29AG.png', 1000, NULL, '$2y$12$LdGn5bJyUx4gKaOniWjNpOo7HxqSGUQ1c8QXUV0SFIbOMPQ.Ad4kO', 8, NULL, '2024-10-14 15:16:58', '2024-10-14 15:40:41'),
(11, 'manager', 'Mohamed', 'khaled', 'ahmedali@admin.com', 'users/pVsd8Qbgfpr1kUiUw4vJ6sNNdGn3tO8as8GUZwIC.jpg', NULL, NULL, '$2y$12$uXofKcFghhiOQotRx9ZU8ORDvuQO5L5PG5QTh3n8WL.px1/9X1Fdq', 9, NULL, '2024-10-14 17:12:37', '2024-10-15 08:46:03'),
(12, 'employee', 'khaled', 'ahmed', 'khaled@app.test', 'users/jzxjuVLljoCRApKB7Nu2kg5B9qHJmqez3KwO9SYp.jpg', 2030, NULL, '$2y$12$EgPMgPOqrTFyYLjs7rDI1OSOaFZN/xpbX2Cx3xmyjBGoq/BqguD2W', 8, NULL, '2024-10-14 19:22:38', '2024-10-14 19:22:38'),
(13, 'manager', 'saif', 'saif', 'saif22nemr@gmail.com', 'users/SfYeYzULxUjGyreBnBA2yIukifyL9tjaMS5CDhOM.jpg', NULL, NULL, '$2y$12$ILeIOPtODR73IhuI7LSPWu8IGruwj.IcvA0/r5ghzaLEIzrRt4cB2', 9, NULL, '2024-10-14 19:32:25', '2024-10-14 19:32:25'),
(15, 'admin', 'ahmed', 'admin', 'admin@email.com', 'users/lvG635oN4hXkQHqsjv2kkPJl7DYZfGZiLi4PqdXk.jpg', NULL, NULL, '$2y$12$/3v4YSZAchte.C88rYVKb.kg/35OoRX6smQoNUUjdhFHfsQ440Czi', 9, NULL, '2024-10-14 19:33:49', '2024-10-14 19:57:28'),
(16, 'employee', 'Khaled', 'Ahmed', 'employee@app.test', 'users/E0Yq6YqeFyaJMA4NIrtYXc3fHTolWRwZolEiGrKU.jpg', 1020, NULL, '$2y$12$sugRHi1Y4KRqUWQ/C5wGpOJArOt4Cxf9tfZu8rWH/iIVzrVqMAf0C', 11, NULL, '2024-10-14 20:06:51', '2024-10-15 08:16:29'),
(17, 'employee', 'Saif', 'Hesham', 'emp20@app.com', 'users/Dk3LovIKOSopyueY76Vt3qrYaTclhkdA7NJ1oiCr.jpg', 3400, NULL, '$2y$12$CyHmWmRK0mpEwWWJ309yiuXmiKm9jz68kEjWcWv9pu/DiCqvzx4a2', 11, NULL, '2024-10-14 20:50:26', '2024-10-14 20:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_departments`
--

CREATE TABLE `user_departments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_departments`
--

INSERT INTO `user_departments` (`id`, `user_id`, `department_id`) VALUES
(12, 11, 5),
(13, 8, 3),
(14, 8, 4),
(15, 8, 5),
(16, 8, 6),
(17, 12, 6),
(18, 16, 3),
(19, 16, 4),
(20, 17, 4),
(21, 17, 5),
(22, 17, 6),
(23, 16, 5),
(24, 16, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_employee_id_foreign` (`employee_id`),
  ADD KEY `tasks_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_manager_id_foreign` (`manager_id`);

--
-- Indexes for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_departments_user_id_foreign` (`user_id`),
  ADD KEY `user_departments_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_departments`
--
ALTER TABLE `user_departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_departments`
--
ALTER TABLE `user_departments`
  ADD CONSTRAINT `user_departments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_departments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
