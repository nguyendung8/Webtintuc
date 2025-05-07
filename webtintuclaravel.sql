-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 06:45 PM
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
-- Database: `webtintuclaravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `vp_categories`
--

CREATE TABLE `vp_categories` (
  `cate_id` bigint(20) UNSIGNED NOT NULL,
  `cate_name` varchar(255) NOT NULL,
  `cate_slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vp_categories`
--

INSERT INTO `vp_categories` (`cate_id`, `cate_name`, `cate_slug`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 'Thời sự', 'thoi-su', '2025-05-07 09:21:32', '2025-05-07 09:21:32', NULL),
(33, 'Thế giới', 'the-gioi', '2025-05-07 09:21:35', '2025-05-07 09:21:35', NULL),
(34, 'Kinh doanh', 'kinh-doanh', '2025-05-07 09:21:45', '2025-05-07 09:21:45', NULL),
(35, 'Sức khỏe', 'suc-khoe', '2025-05-07 09:21:52', '2025-05-07 09:21:52', NULL),
(36, 'Thể thao', 'the-thao', '2025-05-07 09:21:56', '2025-05-07 09:21:56', NULL),
(37, 'Giải trí', 'giai-tri', '2025-05-07 09:22:01', '2025-05-07 09:22:01', NULL),
(38, 'Giáo dục', 'giao-duc', '2025-05-07 09:22:34', '2025-05-07 09:22:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vp_products`
--

CREATE TABLE `vp_products` (
  `prod_id` bigint(20) UNSIGNED NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_slug` varchar(255) NOT NULL,
  `prod_price` bigint(50) NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `prod_condition` varchar(255) NOT NULL,
  `prod_status` tinyint(4) NOT NULL,
  `prod_description` text NOT NULL,
  `prod_featured` tinyint(4) NOT NULL,
  `prod_cate` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vp_users`
--

CREATE TABLE `vp_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vp_users`
--

INSERT INTO `vp_users` (`id`, `email`, `password`, `level`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin@gmail.com', '$2y$10$LRHpw928Td0i3NMWuttwBu2qJzwMe/rN9g3CQCMZ2gsIN3MnfBu5W', 1, '2023-10-27 02:11:41', '2023-10-27 02:11:41', NULL),
(10, 'user@gmail.com', '$2y$10$wIL/6k5smFYLFTBwH1duTub4DZ0qZ02kV7Kq3e6kONubrAgcEPrku', 2, '2024-06-30 07:42:15', '2024-06-30 07:42:15', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vp_categories`
--
ALTER TABLE `vp_categories`
  ADD PRIMARY KEY (`cate_id`);

--
-- Indexes for table `vp_products`
--
ALTER TABLE `vp_products`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `vp_products_prod_cate_foreign` (`prod_cate`);

--
-- Indexes for table `vp_users`
--
ALTER TABLE `vp_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vp_categories`
--
ALTER TABLE `vp_categories`
  MODIFY `cate_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `vp_products`
--
ALTER TABLE `vp_products`
  MODIFY `prod_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `vp_users`
--
ALTER TABLE `vp_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vp_products`
--
ALTER TABLE `vp_products`
  ADD CONSTRAINT `vp_products_prod_cate_foreign` FOREIGN KEY (`prod_cate`) REFERENCES `vp_categories` (`cate_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
