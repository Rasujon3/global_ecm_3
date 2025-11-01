-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2025 at 09:42 AM
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
-- Database: `global_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `desc` text DEFAULT NULL,
  `img` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `desc`, `img`, `created_at`, `updated_at`) VALUES
(1, 'We Boost Our Clients’ Bottom Line by Optimizing Their Growth Potential', '<p><span style=\"color: rgb(102, 102, 102); font-family: Poppins, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Venenatis tellus in. metus vulputate eu scelerisque felis. Vel pretium lectus qua . Arpis massa. Nunc id cursus metus ididunt ut labore metus vulputate episcing.</span></p>', 'uploads/logo/logo_68eba6af6a32f8.49424164.jpg', '2025-10-12 07:01:35', '2025-10-12 07:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `brand_id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(2, 9, '<h5 class=\"banner-subtitle font-weight-normal text-dark\" style=\"box-sizing: inherit; font-weight: 400 !important; margin: 0px 0px 0.7rem; font-family: Poppins, sans-serif; line-height: 1.2; color: rgb(196, 196, 197); letter-spacing: normal; font-size: 1.8em; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Get up to<span> </span><span class=\"text-secondary font-weight-bolder text-uppercase ls-25\" style=\"box-sizing: inherit; text-transform: uppercase !important; font-weight: 700 !important; color: rgb(255, 153, 51) !important; letter-spacing: -0.025em !important;\">20% Off</span></h5>', '<h3 class=\"banner-title text-uppercase\" style=\"box-sizing: inherit; font-weight: 800; margin: 0px 0px 2rem; font-family: Poppins, sans-serif; line-height: 1.17; color: rgb(51, 51, 51); letter-spacing: normal; font-size: 2.6em; text-transform: uppercase !important; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Sports Outfits<br style=\"box-sizing: inherit;\"><span class=\"font-weight-normal                       text-capitalize\" style=\"box-sizing: inherit; text-transform: capitalize !important; font-weight: 400 !important;\">Collection</span></h3>', '<span style=\"color: rgb(102, 102, 102); font-family: Poppins, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Starting at<span> </span></span><span class=\"text-secondary                       font-weight-bolder\" style=\"box-sizing: inherit; font-weight: 700 !important; color: rgb(255, 153, 51) !important; font-family: Poppins, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">170.00 BDT</span>', 'uploads/banner/176070893211-1.jpg', '2025-10-17 07:48:52', '2025-10-19 04:00:51'),
(3, 4, '<h5 class=\"banner-subtitle font-weight-bold text-uppercase\" style=\"box-sizing: inherit; font-weight: 600 !important; margin: 0px 0px 0.8rem; font-family: Poppins, sans-serif; line-height: 1.2; color: rgb(51, 51, 51); letter-spacing: normal; font-size: 1.4em; text-transform: uppercase !important; opacity: 0.8; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Trending Now</h5>', '<h3 class=\"banner-title font-weight-bolder text-capitalize\" style=\"box-sizing: inherit; font-weight: 700 !important; margin: 0px 0px 3rem; font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(51, 51, 51); letter-spacing: normal; font-size: 2.8em; text-transform: capitalize !important; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Women\'s Lifestyle<br style=\"box-sizing: inherit;\">Collection</h3>', '<span style=\"color: rgb(102, 102, 102); font-family: Poppins, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"><span>Only from </span></span><span class=\"text-secondary                       font-weight-bolder\" style=\"box-sizing: inherit; font-weight: 700 !important; color: rgb(255, 153, 51) !important; font-family: Poppins, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">90.00 BDT</span>', 'uploads/banner/176070922213-2.jpg', '2025-10-17 07:53:42', '2025-10-19 04:00:40');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `brand_name` varchar(191) NOT NULL,
  `is_mega_menu` int(11) NOT NULL DEFAULT 1,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `user_id`, `brand_name`, `is_mega_menu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Elegant Auto Group', 1, 'uploads/brands/175974338312.png', 'Active', '2025-10-06 03:36:23', '2025-10-06 03:36:23'),
(3, 1, 'Sky Suite', 1, 'uploads/brands/175974339813.png', 'Active', '2025-10-06 03:36:38', '2025-10-06 03:36:38'),
(4, 1, 'RED', 1, 'uploads/brands/175974340714.png', 'Active', '2025-10-06 03:36:47', '2025-10-06 03:36:47'),
(5, 1, 'Green Grass', 1, 'uploads/brands/175974376615.png', 'Active', '2025-10-06 03:37:02', '2025-10-06 03:42:46'),
(9, 1, 'Anua', 1, 'uploads/brands/176136679311.png', 'Active', '2025-10-11 07:07:04', '2025-10-24 22:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `brand_category`
--

CREATE TABLE `brand_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_session_id` varchar(191) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `productvariant_id` int(11) DEFAULT NULL,
  `productvariant_ids` varchar(191) DEFAULT NULL,
  `cart_qty` int(11) NOT NULL,
  `unit_total` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cart_session_id`, `product_id`, `productvariant_id`, `productvariant_ids`, `cart_qty`, `unit_total`, `created_at`, `updated_at`) VALUES
(3, '49321', 6, NULL, '[\"1\",\"1\",\"4\"]', 3, '2840.04', '2025-10-11 01:01:00', '2025-10-11 01:01:00'),
(4, '49321', 4, NULL, 'null', 2, '703.50', '2025-10-11 03:08:35', '2025-10-11 03:09:02'),
(5, '72763', 2, NULL, NULL, 1, '138.18', '2025-10-12 07:38:39', '2025-10-12 07:38:39'),
(6, '64464', 2, NULL, NULL, 1, '138.18', '2025-10-12 11:23:16', '2025-10-12 11:23:16'),
(8, '67205', 2, NULL, NULL, 1, '138.18', '2025-10-13 05:06:37', '2025-10-13 05:06:37'),
(9, '67205', 1, NULL, NULL, 2, '1907.02', '2025-10-13 05:06:42', '2025-10-13 05:06:56'),
(10, '88887', 5, NULL, NULL, 1, '111', '2025-10-13 05:10:51', '2025-10-13 05:10:51'),
(11, '88887', 7, NULL, NULL, 1, '840', '2025-10-13 05:11:00', '2025-10-13 05:11:00'),
(12, '81439', 2, NULL, NULL, 1, '138.18', '2025-10-13 05:22:07', '2025-10-13 05:22:07'),
(13, '181010', 1, NULL, NULL, 2, '1907.02', '2025-10-13 05:34:42', '2025-10-13 05:35:04'),
(14, '181010', 3, NULL, NULL, 4, '2608.00', '2025-10-13 05:34:46', '2025-10-13 05:35:04'),
(15, '123312', 2, NULL, NULL, 1, '138.18', '2025-10-14 11:44:18', '2025-10-14 11:44:18'),
(16, '372113', 2, NULL, NULL, 1, '138.18', '2025-10-17 06:43:40', '2025-10-17 06:43:40'),
(17, '372113', 4, NULL, NULL, 1, '351.75', '2025-10-17 10:37:53', '2025-10-17 10:37:53'),
(18, '372113', 8, NULL, NULL, 1, '2205', '2025-10-17 10:49:11', '2025-10-17 10:49:11'),
(19, '272216', 1, NULL, NULL, 2, '1907.02', '2025-10-17 11:05:39', '2025-10-17 11:14:20'),
(20, '121517', 2, NULL, NULL, 2, '276.36', '2025-10-17 11:19:13', '2025-10-17 11:19:43'),
(21, '775618', 1, NULL, '[\"12\",\"13\"]', 1, '953.51', '2025-10-18 00:12:30', '2025-10-18 00:12:30'),
(22, '621419', 2, NULL, NULL, 1, '138.18', '2025-10-18 03:17:31', '2025-10-18 03:17:31'),
(23, '372520', 8, NULL, NULL, 1, '2205', '2025-10-18 05:28:12', '2025-10-18 05:28:12'),
(27, '858021', 9, NULL, NULL, 1, '1000', '2025-10-19 02:26:57', '2025-10-19 02:26:57'),
(30, '241122', 9, NULL, NULL, 3, '3000', '2025-10-19 02:39:46', '2025-10-19 02:39:46'),
(31, '562323', 2, NULL, NULL, 1, '138.18', '2025-10-19 02:49:44', '2025-10-19 02:49:44'),
(32, '562323', 7, NULL, NULL, 1, '840', '2025-10-19 02:50:51', '2025-10-19 02:50:51'),
(33, '562323', 8, NULL, '[\"14\"]', 1, '2205', '2025-10-19 03:03:01', '2025-10-19 03:03:01'),
(34, '442926', 9, NULL, NULL, 1, '1000', '2025-10-19 03:48:27', '2025-10-19 03:48:27'),
(35, '749827', 8, NULL, '[\"14\"]', 1, '2205', '2025-10-19 04:32:57', '2025-10-19 04:32:57'),
(36, '132428', 11, NULL, NULL, 2, '2000', '2025-10-19 04:47:07', '2025-10-19 04:47:07'),
(37, '853729', 12, NULL, NULL, 2, '5700', '2025-10-19 15:31:24', '2025-10-19 15:31:24'),
(38, '590630', 13, NULL, NULL, 1, '3800', '2025-10-19 16:03:42', '2025-10-19 16:03:42'),
(39, '590630', 12, NULL, NULL, 1, '2850', '2025-10-19 16:03:44', '2025-10-19 16:03:44'),
(40, '590630', 10, NULL, NULL, 1, '970', '2025-10-19 16:03:47', '2025-10-19 16:03:47'),
(41, '242533', 12, NULL, NULL, 1, '2850', '2025-10-19 16:15:33', '2025-10-19 16:15:33'),
(42, '591234', 10, NULL, NULL, 1, '970', '2025-10-20 10:46:30', '2025-10-20 10:46:30'),
(43, '68f735cd0b038', 11, NULL, NULL, 1, '950', '2025-10-21 01:37:15', '2025-10-21 01:37:15'),
(44, '68f735cd0b038', 10, NULL, NULL, 1, '970', '2025-10-21 01:45:15', '2025-10-21 01:45:15'),
(45, '259837', 13, NULL, NULL, 2, '7600.00', '2025-10-21 23:37:48', '2025-10-21 23:38:06'),
(68, '879338', 7, NULL, NULL, 2, '1680.00', '2025-10-23 01:14:10', '2025-10-23 02:36:54'),
(69, '879338', 4, NULL, NULL, 2, '703.50', '2025-10-23 01:30:42', '2025-10-23 02:35:05'),
(70, '110440', 13, NULL, NULL, 1, '3800', '2025-10-23 03:10:32', '2025-10-23 03:10:32'),
(71, '110440', 12, NULL, NULL, 1, '2850', '2025-10-23 03:11:02', '2025-10-23 03:11:02'),
(72, '110440', 14, NULL, NULL, 1, '38431.68', '2025-10-23 03:18:09', '2025-10-23 03:18:09'),
(97, '786343', 11, NULL, NULL, 1, '950', '2025-10-23 06:20:46', '2025-10-23 06:20:46'),
(98, '755644', 3, NULL, NULL, 1, '652', '2025-10-28 22:55:46', '2025-10-28 22:55:46'),
(99, '755644', 2, NULL, NULL, 2, '276.36', '2025-10-29 00:13:06', '2025-10-29 00:13:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `is_top` tinyint(4) NOT NULL DEFAULT 0,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `is_homepage` tinyint(4) NOT NULL DEFAULT 0,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `image`, `is_top`, `is_featured`, `is_homepage`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sports', 'uploads/categories/17597338591category-4.jpg', 1, 1, 1, 'Active', '2025-10-06 00:57:39', '2025-10-09 01:46:22'),
(2, 1, 'Cloths', 'uploads/categories/17597338881category-1.jpg', 1, 0, 0, 'Active', '2025-10-06 00:58:08', '2025-10-06 00:58:08'),
(3, 1, 'Cameras', 'uploads/categories/17597339491category-7.jpg', 1, 1, 0, 'Active', '2025-10-06 00:59:09', '2025-10-06 00:59:09'),
(4, 1, 'Sneakers', 'uploads/categories/17597340081category-12.jpg', 1, 1, 0, 'Active', '2025-10-06 01:00:08', '2025-10-06 01:00:08'),
(5, 1, 'Watches', 'uploads/categories/17597340331category-20.jpg', 0, 1, 1, 'Active', '2025-10-06 01:00:33', '2025-10-09 01:41:44'),
(6, 1, 'Games', 'uploads/categories/17597340501category-8.jpg', 0, 1, 0, 'Active', '2025-10-06 01:00:50', '2025-10-09 01:46:14'),
(7, 1, 'Kitchen', 'uploads/categories/17597340861category-9.jpg', 1, 1, 1, 'Active', '2025-10-06 01:01:26', '2025-10-09 01:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `cosmetics`
--

CREATE TABLE `cosmetics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cosmetics`
--

INSERT INTO `cosmetics` (`id`, `brand_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(2, 4, '<h5 class=\"banner-subtitle font-weight-bold text-uppercase\" style=\"box-sizing: inherit; font-weight: 600 !important; margin: 0px 0px 0.8rem; font-family: Poppins, sans-serif; line-height: 1.2; color: rgb(51, 51, 51); letter-spacing: normal; font-size: 1.4em; text-transform: uppercase !important; opacity: 0.8; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Trending Now</h5>', '<h3 class=\"banner-title font-weight-bolder text-capitalize\" style=\"box-sizing: inherit; font-weight: 700 !important; margin: 0px 0px 3rem; font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(51, 51, 51); letter-spacing: normal; font-size: 2.8em; text-transform: capitalize !important; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Women\'s Lifestyle<br style=\"box-sizing: inherit;\">Collection</h3>', 'uploads/cosmetics/176076433013-2.jpg', '2025-10-17 23:12:10', '2025-10-18 22:12:26'),
(3, 5, '<h5 class=\"banner-subtitle font-weight-bold text-uppercase\" style=\"box-sizing: inherit; margin: 0px 0px 0.8rem; font-family: Poppins, sans-serif; line-height: 1.2; color: rgb(238, 238, 238); letter-spacing: normal; font-size: 1.4em; text-transform: uppercase !important; opacity: 0.8; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Natural Process</h5>', '<h3 class=\"banner-title font-weight-bolder text-capitalize text-white\" style=\"box-sizing: inherit; font-weight: 700 !important; margin: 0px 0px 3rem; font-family: Poppins, sans-serif; line-height: 1.1; color: rgb(255, 255, 255) !important; letter-spacing: normal; font-size: 2.8em; text-transform: capitalize !important; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; text-align: start; text-indent: 0px; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Cosmetic Makeup<br style=\"box-sizing: inherit;\">Professional</h3>', 'uploads/cosmetics/176076435713-1.jpg', '2025-10-17 23:12:37', '2025-10-19 04:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `intros`
--

CREATE TABLE `intros` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(191) DEFAULT NULL,
  `title` varchar(191) DEFAULT NULL,
  `description` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `intros`
--

INSERT INTO `intros` (`id`, `icon`, `title`, `description`, `created_at`, `updated_at`) VALUES
(2, 'w-icon-truck', 'Free Shipping & Returns', 'For all orders over 99 BDT', '2025-10-17 12:23:30', '2025-10-17 12:29:06'),
(3, 'w-icon-bag', 'Secure Payment', 'We ensure secure payment', '2025-10-17 12:30:27', '2025-10-17 12:30:27'),
(4, 'w-icon-money', 'Money Back Guarantee', 'Any back within 30 days', '2025-10-17 12:30:52', '2025-10-17 12:30:52'),
(5, 'w-icon-chat', 'Customer Support', 'Call or email us 24/7', '2025-10-17 12:31:12', '2025-10-17 12:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_10_06_044805_create_categories_table', 2),
(6, '2025_10_06_045047_create_brands_table', 2),
(7, '2025_10_06_050616_create_subcategories_table', 2),
(8, '2025_10_06_052117_create_brand_category_table', 2),
(9, '2025_10_06_052853_create_units_table', 3),
(10, '2025_10_06_053049_create_variants_table', 3),
(11, '2025_10_06_053150_create_products_table', 3),
(12, '2025_10_06_053955_create_productvariants_table', 3),
(13, '2025_10_07_085046_create_orders_table', 4),
(14, '2025_10_07_085450_create_orderdetails_table', 4),
(15, '2025_10_07_085949_create_paymentmethods_table', 4),
(16, '2025_10_07_092154_create_sliders_table', 5),
(17, '2025_10_09_081518_create_carts_table', 5),
(18, '2025_10_11_082810_create_whishlists_table', 6),
(19, '2025_10_12_061533_create_settings_table', 7),
(20, '2025_10_12_064420_add_columns_to_settings_table', 7),
(21, '2025_10_12_075254_create_about_us_table', 7),
(22, '2025_10_14_102900_add_columns_to_settings_table', 8),
(23, '2025_10_14_112726_add_columns_to_settings_table', 8),
(24, '2025_10_15_174243_create_reviews_table', 9),
(25, '2025_10_15_115814_add_columns_to_settings_table', 10),
(26, '2025_10_16_054515_add_columns_to_settings_table', 10),
(27, '2025_10_16_063006_add_columns_to_settings_table', 10),
(28, '2025_10_16_095622_create_product_imgs_table', 10),
(29, '2025_10_16_120045_add_columns_to_settings_table', 10),
(30, '2025_10_17_125221_create_banners_table', 11),
(31, '2025_10_17_175508_create_intros_table', 12),
(32, '2025_10_18_043310_create_cosmetics_table', 13),
(33, '2025_10_18_054410_create_newsletters_table', 14),
(34, '2025_10_18_152359_add_columns_to_sliders_table', 15),
(35, '2025_10_18_170541_add_columns_to_banners_table', 15),
(36, '2025_10_18_172821_add_columns_to_cosmetics_table', 15),
(37, '2025_10_19_042811_add_columns_to_products_table', 16),
(38, '2025_10_22_044344_add_columns_to_products_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'sujon.egov@gmail.com', '2025-10-18 00:01:37', '2025-10-18 00:01:37'),
(3, 'admin@gmail.com', '2025-10-19 05:23:52', '2025-10-19 05:23:52');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `paymentmethod_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `zip_code` varchar(191) DEFAULT NULL,
  `full_address` text NOT NULL,
  `screen_shot` varchar(191) DEFAULT NULL,
  `sub_total` varchar(191) NOT NULL,
  `delivery_charge` varchar(191) DEFAULT '0',
  `vat_tax` varchar(191) DEFAULT '0',
  `total` varchar(191) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(191) NOT NULL,
  `timestamp` varchar(191) NOT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `user_id`, `paymentmethod_id`, `name`, `email`, `phone`, `zip_code`, `full_address`, `screen_shot`, `sub_total`, `delivery_charge`, `vat_tax`, `total`, `date`, `time`, `timestamp`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '1361', 'East Boxanagr, Sarulia, Demra, Dhaka', NULL, '4515.02', '0', '0', '4515.02', '2025-10-13', '05:37: pm', '1760355455', 'In_Transit', '2025-10-13 11:37:35', '2025-10-13 05:39:41'),
(2, 2, 2, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '76679', 'Dhanaruha', 'uploads/order/1760464010217479054141-ebf4d8058eb9c21b73348607d6ac72f0.jpg_720x720q80.jpg', '138.18', '150', '0', '288.18', '2025-10-14', '11:46: pm', '1760464010', 'Pending', '2025-10-14 17:46:50', '2025-10-14 17:46:50'),
(3, 2, 3, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '76679', 'Dhanaruha', NULL, '2694.93', '80', '0', '2774.93', '2025-10-17', '11:00: pm', '1760720432', 'Pending', '2025-10-17 17:00:32', '2025-10-17 17:00:32'),
(4, 2, 3, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '76679', 'Dhanaruha', NULL, '1907.02', '120', '0', '2027.02', '2025-10-17', '11:15: pm', '1760721353', 'Pending', '2025-10-17 17:15:53', '2025-10-17 17:15:53'),
(5, 2, 3, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'fd', 'uploads/order/17607679982no_image.png', '953.51', '150', '0', '1103.51', '2025-10-18', '12:13: pm', '1760767998', 'Pending', '2025-10-18 06:13:18', '2025-10-18 06:13:18'),
(7, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'das', NULL, '2205', '150', '0', '2355', '2025-10-18', '05:29: pm', '1760786981', 'Pending', '2025-10-18 11:29:41', '2025-10-18 11:29:41'),
(8, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'fdsa', NULL, '1000', '150', '0', '1150', '2025-10-19', '02:27: pm', '1760862443', 'Pending', '2025-10-19 08:27:23', '2025-10-19 08:27:23'),
(9, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'das', NULL, '3000', '150', '0', '3150', '2025-10-19', '02:40: pm', '1760863219', 'Pending', '2025-10-19 08:40:19', '2025-10-19 08:40:19'),
(10, 2, 3, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'fdsa', 'uploads/order/17608673732no_image.png', '1000', '150', '0', '1150', '2025-10-19', '03:49: pm', '1760867373', 'Pending', '2025-10-19 09:49:33', '2025-10-19 09:49:33'),
(11, 1, 1, 'Admin', 'admin@gmail.com', '01754572465', NULL, 'Nsndjzb', NULL, '2205', '80', '0', '2285', '2025-10-19', '04:34: pm', '1760870043', 'Pending', '2025-10-19 10:34:03', '2025-10-19 10:34:03'),
(12, 1, 1, 'Admin', 'admin@gmail.com', '01754572465', NULL, 'Bdnzjzj', NULL, '2000', '80', '0', '2080', '2025-10-19', '04:47: pm', '1760870845', 'Pending', '2025-10-19 10:47:25', '2025-10-19 10:47:25'),
(13, 1, 1, 'Admin', 'admin@gmail.com', NULL, NULL, 'Mirpur 1', NULL, '5700', '80', '0', '5780', '2025-10-20', '03:49: am', '1760910587', 'Pending', '2025-10-19 21:49:47', '2025-10-19 21:49:47'),
(14, 1, 1, 'Admin', 'admin@gmail.com', '01754572465', NULL, 'Savar', NULL, '7620', '80', '0', '7700', '2025-10-20', '04:09: am', '1760911777', 'Pending', '2025-10-19 22:09:37', '2025-10-19 22:09:37'),
(15, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'gf', NULL, '2383.5', '150', '0', '2533.5', '2025-10-23', '02:59: pm', '1761209956', 'Pending', '2025-10-23 08:59:16', '2025-10-23 08:59:16'),
(16, 2, 1, 'Md. Ekram Hossain', 'ekramhossainekram28@gmail.com', '01799327845', '56909', 'fasd', NULL, '45081.68', '80', '0', '45161.68', '2025-10-23', '03:19: pm', '1761211165', 'Pending', '2025-10-23 09:19:25', '2025-10-23 09:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderdetail_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `varaint_id` int(11) DEFAULT NULL,
  `variants` varchar(191) DEFAULT NULL,
  `price` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT '0',
  `qty` varchar(191) NOT NULL,
  `unit_total` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `orderdetail_id`, `product_id`, `varaint_id`, `variants`, `price`, `discount`, `qty`, `unit_total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL, '953.51', '0', '2', '1907.02', '2025-10-13 11:37:35', '2025-10-13 11:37:35'),
(2, 1, 3, NULL, NULL, '652', '0', '4', '2608.00', '2025-10-13 11:37:35', '2025-10-13 11:37:35'),
(3, 2, 2, NULL, NULL, '138.18', '0', '1', '138.18', '2025-10-14 17:46:50', '2025-10-14 17:46:50'),
(4, 3, 2, NULL, NULL, '138.18', '0', '1', '138.18', '2025-10-17 17:00:32', '2025-10-17 17:00:32'),
(5, 3, 4, NULL, NULL, '351.75', '0', '1', '351.75', '2025-10-17 17:00:32', '2025-10-17 17:00:32'),
(6, 3, 8, NULL, NULL, '2205', '0', '1', '2205', '2025-10-17 17:00:32', '2025-10-17 17:00:32'),
(7, 4, 1, NULL, NULL, '953.51', '0', '2', '1907.02', '2025-10-17 17:15:53', '2025-10-17 17:15:53'),
(8, 5, 1, NULL, '[\"12\",\"13\"]', '953.51', '0', '1', '953.51', '2025-10-18 06:13:18', '2025-10-18 06:13:18'),
(9, 7, 8, NULL, NULL, '2205', '0', '1', '2205', '2025-10-18 11:29:41', '2025-10-18 11:29:41'),
(10, 8, 9, NULL, NULL, '1000', '0', '1', '1000', '2025-10-19 08:27:23', '2025-10-19 08:27:23'),
(11, 9, 9, NULL, NULL, '1000', '0', '3', '3000', '2025-10-19 08:40:19', '2025-10-19 08:40:19'),
(12, 10, 9, NULL, NULL, '1000', '0', '1', '1000', '2025-10-19 09:49:33', '2025-10-19 09:49:33'),
(13, 11, 8, NULL, '[\"14\"]', '2205', '0', '1', '2205', '2025-10-19 10:34:03', '2025-10-19 10:34:03'),
(14, 12, 11, NULL, NULL, '1000', '0', '2', '2000', '2025-10-19 10:47:25', '2025-10-19 10:47:25'),
(15, 13, 12, NULL, NULL, '2850', '0', '2', '5700', '2025-10-19 21:49:47', '2025-10-19 21:49:47'),
(16, 14, 13, NULL, NULL, '3800', '0', '1', '3800', '2025-10-19 22:09:37', '2025-10-19 22:09:37'),
(17, 14, 12, NULL, NULL, '2850', '0', '1', '2850', '2025-10-19 22:09:37', '2025-10-19 22:09:37'),
(18, 14, 10, NULL, NULL, '970', '0', '1', '970', '2025-10-19 22:09:37', '2025-10-19 22:09:37'),
(19, 15, 7, NULL, NULL, '840', '0', '2', '1680.00', '2025-10-23 08:59:16', '2025-10-23 08:59:16'),
(20, 15, 4, NULL, NULL, '351.75', '0', '2', '703.50', '2025-10-23 08:59:16', '2025-10-23 08:59:16'),
(21, 16, 13, NULL, NULL, '3800', '0', '1', '3800', '2025-10-23 09:19:25', '2025-10-23 09:19:25'),
(22, 16, 12, NULL, NULL, '2850', '0', '1', '2850', '2025-10-23 09:19:25', '2025-10-23 09:19:25'),
(23, 16, 14, NULL, NULL, '38431.68', '0', '1', '38431.68', '2025-10-23 09:19:25', '2025-10-23 09:19:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethods`
--

CREATE TABLE `paymentmethods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `api_key` varchar(191) DEFAULT NULL,
  `secret_key` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paymentmethods`
--

INSERT INTO `paymentmethods` (`id`, `user_id`, `name`, `api_key`, `secret_key`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cash On Delivery', NULL, NULL, 'Active', NULL, NULL),
(2, 1, 'Bank', NULL, NULL, 'Active', NULL, NULL),
(3, 1, 'bKash', NULL, NULL, 'Active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `unit_id` int(11) NOT NULL,
  `product_name` varchar(191) NOT NULL,
  `product_price` varchar(191) NOT NULL,
  `discount` varchar(191) DEFAULT NULL,
  `stock_qty` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `description` text NOT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_best_seller` tinyint(4) DEFAULT 0,
  `is_arrival_product` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `brand_id`, `subcategory_id`, `unit_id`, `product_name`, `product_price`, `discount`, `stock_qty`, `image`, `description`, `tag`, `status`, `created_at`, `updated_at`, `is_best_seller`, `is_arrival_product`) VALUES
(1, 1, 5, 4, NULL, 5, 'Ray Cruz', '983', '3', '946', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'New', 'Active', '2025-10-06 05:19:43', '2025-10-06 05:51:12', 0, 0),
(2, 1, 1, 3, 2, 5, 'Aiko Freeman', '141', '2', '798', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Trending', 'Active', '2025-10-06 05:20:33', '2025-10-19 05:02:29', 0, 1),
(3, 1, 7, NULL, NULL, 4, 'Elaine Morin', '652', NULL, '283', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Selling Fast', 'Active', '2025-10-06 05:21:55', '2025-10-17 09:26:13', 0, 0),
(4, 1, 7, 3, NULL, 2, 'Iliana Prince', '469', '25', '376', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Trending', 'Active', '2025-10-06 05:32:57', '2025-10-23 08:59:16', 0, 1),
(5, 1, 7, 3, 3, 2, 'Walker Knowles', '111', NULL, '619', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus mattis risus ante, id cursus arcu varius quis. In diam orci, consequat sed venenatis ut, bibendum et justo. Nulla vestibulum, ante sed lobortis tincidunt, eros mauris ornare turpis, non ultrices nibh leo nec libero. Cras porttitor faucibus felis nec vestibulum. Integer eu ligula vitae magna interdum facilisis sit amet vitae velit. Nunc interdum eros ornare, mollis turpis vitae, commodo est. Donec a dictum orci. Aliquam turpis urna, sodales sed aliquet sit amet, egestas non risus. Quisque sit amet hendrerit sem, in ornare purus. Vestibulum sed erat luctus, sagittis eros non, porta odio. Nunc molestie id odio quis sodales.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Aliquam lectus turpis, sagittis et sapien vitae, feugiat pulvinar neque. Mauris suscipit ut augue iaculis tincidunt. Vivamus sagittis, mauris ac consequat lacinia, felis risus lobortis ipsum, eget vehicula risus nisl eu dui. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus mollis auctor est, auctor pellentesque tortor faucibus eget. Nulla facilisi. Nullam ornare dictum magna. Donec aliquam, est nec maximus convallis, justo est vehicula orci, ac malesuada sem quam a diam. Vestibulum in mauris urna. In ultricies sodales orci sed lobortis. Maecenas auctor arcu a nulla fringilla, non consequat metus mollis.</p>', 'Selling Fast', 'Active', '2025-10-06 05:34:13', '2025-10-19 05:01:19', 0, 1),
(7, 1, 7, NULL, 9, 5, 'Stephanie Webster', '840', NULL, '928', '', '<p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas a commodo quam, sit amet dignissim velit. Mauris in massa nec metus varius condimentum eu et tortor. In hac habitasse platea dictumst. Vivamus tristique, lectus non pharetra vestibulum, sapien nisl faucibus orci, ut semper quam ex feugiat tortor. Nulla at urna ut ipsum luctus vestibulum sit amet vel arcu. Nullam sed lacus odio. Proin a ex lectus. Vestibulum ac finibus felis. Vivamus porta porttitor tempor. Etiam facilisis, nisi volutpat convallis dictum, ante ante mollis lectus, sed euismod nunc lorem et nisi. Nullam sed porttitor ligula.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Etiam id lacus vel eros cursus mattis eu eget turpis. Quisque quis pretium magna. Sed laoreet, nisi id gravida tincidunt, lacus ipsum luctus arcu, non venenatis nulla mauris non arcu. Praesent vel ipsum justo. Phasellus tempor diam sed varius sollicitudin. Pellentesque vel urna risus. Duis fermentum, nunc vel gravida hendrerit, ante nunc semper sem, quis dapibus nibh augue vel erat. Nullam pulvinar velit quis nisl viverra, at cursus odio fringilla.</p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: \"Open Sans\", Arial, sans-serif; font-size: 14px;\">Mauris auctor ipsum eros, quis interdum est mollis nec. Vestibulum dignissim tellus interdum, suscipit mi vel, sollicitudin elit. Mauris luctus ex in ex sodales mattis. Aliquam porttitor ipsum in purus varius, quis sollicitudin nisl sagittis. Cras elementum ligula nisl, porttitor pretium leo sodales non. Ut facilisis varius interdum. In ac vulputate orci.</p>', 'New', 'Active', '2025-10-07 04:18:33', '2025-10-23 08:59:16', 0, 1),
(8, 1, 6, 2, NULL, 4, 'Eqqualberry', '2250', '2', '0', '', '<p>Hello</p>', 'Trending', 'Active', '2025-10-11 12:19:18', '2025-10-19 10:34:03', 1, 1),
(9, 1, 6, 4, 6, 5, 'Maxine Bechtelar Sujon', '1000', '0', '5', NULL, '<p><span style=\"color: rgb(0, 0, 0); font-family: unifysans; font-size: 20px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Quick question: When was the last time you purchased something online? Yesterday? This morning? Ok, cool. So when do you think you’ll<span> </span></span><em style=\"box-sizing: border-box; margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 20px; text-size-adjust: 100%; vertical-align: baseline; background: rgb(255, 255, 255); font-style: italic; color: rgb(0, 0, 0); font-family: unifysans; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">next<span> </span></em><span style=\"color: rgb(0, 0, 0); font-family: unifysans; font-size: 20px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">purchase something online? Tomorrow? Tonight? No shame—me too.</span></p>', 'Selling Fast', 'Active', '2025-10-18 22:41:18', '2025-10-19 05:00:26', 1, 1),
(10, 1, 4, 9, NULL, 5, 'Gertrude Hahn', '1000', '3', '1', NULL, '<p>wrrrrrr</p>', 'New', 'Active', '2025-10-19 03:56:17', '2025-10-19 22:09:37', 0, 1),
(11, 1, 4, 4, 5, 4, 'Joelle Vandervortv update', '1000', '5', '5', NULL, '<p>xvcz</p>', 'Trending', 'Active', '2025-10-19 03:59:37', '2025-10-19 04:58:00', 0, 1),
(12, 1, 7, 9, 3, 4, 'Cell Fushion C Cooling Pad 70 Pads', '3000', '5', '6', NULL, '<p>Hello</p>', 'Selling Fast', 'Active', '2025-10-19 04:59:34', '2025-10-23 09:19:25', 1, 1),
(13, 1, 7, 9, 4, 5, 'Hzhs', '4000', '5', '3', NULL, '<p>Hh</p>', 'New', 'Active', '2025-10-19 05:35:21', '2025-10-23 09:19:25', 1, 1),
(14, 1, 1, 4, 2, 1, 'Marjorie Jakubowski sss', '39216', '2', '1', NULL, '<span style=\"color: rgb(15, 15, 15); font-family: Roboto, Arial, sans-serif; font-size: 14px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: start; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: pre-wrap; background-color: rgba(0, 0, 0, 0.05); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">This tapmad highlights package shows a thrilling 2nd ODI between Bangladesh and West Indies. Both teams scored an identical 213 runs, forcing a Super Over. West Indies ultimately prevailed by a single run, extending the series.</span>', 'Selling Fast', 'Active', '2025-10-21 22:59:33', '2025-10-23 09:19:25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `productvariants`
--

CREATE TABLE `productvariants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `variant_value` varchar(191) NOT NULL,
  `variant_price` varchar(191) DEFAULT NULL,
  `stock_qty` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productvariants`
--

INSERT INTO `productvariants` (`id`, `product_id`, `variant_id`, `variant_value`, `variant_price`, `stock_qty`, `image`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Red', '23', '300', 'uploads/variants/1759826819_68e4d38308299_1-1.jpg', '2025-10-07 02:46:59', '2025-10-09 00:59:17'),
(2, 6, 1, 'Yellow', '24', '350', 'uploads/variants/1759826819_68e4d38372503_1-2.jpg', '2025-10-07 02:46:59', '2025-10-07 02:47:46'),
(4, 6, 2, 'S', NULL, '23', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(5, 6, 2, 'M', NULL, '24', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(6, 6, 2, 'L', NULL, '25', NULL, '2025-10-07 02:46:59', '2025-10-07 02:46:59'),
(7, 6, 1, 'Black', '25', '65', 'uploads/variants/1759826878_68e4d3bef1250_7-2.jpg', '2025-10-07 02:47:46', '2025-10-07 02:47:58'),
(10, 6, 2, 'XL', NULL, '30', NULL, '2025-10-09 01:00:48', '2025-10-09 01:00:48'),
(11, 6, 2, 'XXL', NULL, '40', NULL, '2025-10-09 01:00:49', '2025-10-09 01:00:49'),
(12, 1, 1, 'Red', NULL, '10', NULL, '2025-10-17 11:05:01', '2025-10-17 11:05:01'),
(13, 1, 2, 'S', NULL, '1', NULL, '2025-10-17 11:05:01', '2025-10-17 11:05:01'),
(14, 8, 1, 'Red', NULL, '10', NULL, '2025-10-18 22:14:21', '2025-10-18 22:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_imgs`
--

CREATE TABLE `product_imgs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_imgs`
--

INSERT INTO `product_imgs` (`id`, `product_id`, `user_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'uploads/products/1760714710117597496331review-img-1.jpg', '2025-10-17 09:25:10', '2025-10-17 09:25:10'),
(2, 8, 1, 'uploads/products/1760714710117598323131bought-2.jpg', '2025-10-17 09:25:10', '2025-10-17 09:25:10'),
(5, 5, 1, 'uploads/products/17607147381175974958316-800x900.jpg', '2025-10-17 09:25:38', '2025-10-17 09:25:38'),
(6, 5, 1, 'uploads/products/17607147381175974971512.jpg', '2025-10-17 09:25:38', '2025-10-17 09:25:38'),
(7, 4, 1, 'uploads/products/17607147591175975037714-1.jpg', '2025-10-17 09:25:59', '2025-10-17 09:25:59'),
(8, 4, 1, 'uploads/products/17607147591175975045318.jpg', '2025-10-17 09:25:59', '2025-10-17 09:25:59'),
(9, 3, 1, 'uploads/products/176071477311760714710117597496331review-img-1.jpg', '2025-10-17 09:26:13', '2025-10-17 09:26:13'),
(10, 3, 1, 'uploads/products/176071477311760714710117598323131bought-2.jpg', '2025-10-17 09:26:13', '2025-10-17 09:26:13'),
(16, 2, 1, 'uploads/products/17607162531175974958316-800x900.jpg', '2025-10-17 09:50:53', '2025-10-17 09:50:53'),
(17, 2, 1, 'uploads/products/17607162531175974971512.jpg', '2025-10-17 09:50:53', '2025-10-17 09:50:53'),
(18, 2, 1, 'uploads/products/17607162531175975037714-1.jpg', '2025-10-17 09:50:53', '2025-10-17 09:50:53'),
(19, 7, 1, 'uploads/products/176076822513-800x900.jpg', '2025-10-18 00:17:05', '2025-10-18 00:17:05'),
(20, 7, 1, 'uploads/products/176076822514-800x900.jpg', '2025-10-18 00:17:05', '2025-10-18 00:17:05'),
(21, 1, 1, 'uploads/products/176076827611-800x900.jpg', '2025-10-18 00:17:56', '2025-10-18 00:17:56'),
(22, 1, 1, 'uploads/products/176076827612-800x900.jpg', '2025-10-18 00:17:56', '2025-10-18 00:17:56'),
(23, 9, 1, 'uploads/products/176084887811-800x900.jpg', '2025-10-18 22:41:18', '2025-10-18 22:41:18'),
(24, 9, 1, 'uploads/products/176084887812-800x900.jpg', '2025-10-18 22:41:18', '2025-10-18 22:41:18'),
(25, 10, 1, 'uploads/products/176086777711-800x900.jpg', '2025-10-19 03:56:17', '2025-10-19 03:56:17'),
(26, 10, 1, 'uploads/products/176086777712-800x900.jpg', '2025-10-19 03:56:17', '2025-10-19 03:56:17'),
(27, 11, 1, 'uploads/products/176086797713-800x900.jpg', '2025-10-19 03:59:37', '2025-10-19 03:59:37'),
(28, 11, 1, 'uploads/products/176086797714-800x900.jpg', '2025-10-19 03:59:37', '2025-10-19 03:59:37'),
(29, 12, 1, 'uploads/products/17608715741IMG_6176.jpeg', '2025-10-19 04:59:34', '2025-10-19 04:59:34'),
(30, 12, 1, 'uploads/products/17608715741IMG_6246.jpeg', '2025-10-19 04:59:34', '2025-10-19 04:59:34'),
(31, 12, 1, 'uploads/products/17608715741IMG_6247.jpeg', '2025-10-19 04:59:34', '2025-10-19 04:59:34'),
(32, 13, 1, 'uploads/products/176087372112eebef815c6b1b59d73d0226ca6d163c.jpeg', '2025-10-19 05:35:21', '2025-10-19 05:35:21'),
(33, 14, 1, 'uploads/products/176110917313-440x494.jpg', '2025-10-21 22:59:33', '2025-10-21 22:59:33'),
(34, 14, 1, 'uploads/products/176110917313-800x900.jpg', '2025-10-21 22:59:33', '2025-10-21 22:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(3) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('pending','approved') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `rating`, `description`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, 'first review', 'uploads/image/image_68efe1e51b3421.85402408.jpg', 'approved', '2025-10-15 12:03:17', '2025-10-15 12:03:17'),
(2, 2, 2, 4, 'fdsa', NULL, 'approved', '2025-10-15 12:10:54', '2025-10-15 12:10:54'),
(3, 5, 2, 5, 'Good', NULL, 'approved', '2025-10-18 00:27:16', '2025-10-18 00:27:16'),
(4, 3, 2, 5, 'dsa', NULL, 'approved', '2025-10-19 01:29:22', '2025-10-19 01:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) DEFAULT NULL,
  `favicon` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `established` varchar(191) DEFAULT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `instagram` varchar(191) DEFAULT NULL,
  `youtube` varchar(191) DEFAULT NULL,
  `pinterest` varchar(191) DEFAULT NULL,
  `contact_us_img` varchar(191) DEFAULT NULL,
  `inside_dhaka_dc` int(11) DEFAULT 80,
  `outside_dhaka_dc` int(11) DEFAULT 150,
  `sub_urban_areas_dc` int(11) DEFAULT 120,
  `acc_no` varchar(191) DEFAULT NULL,
  `routing_number` varchar(191) DEFAULT NULL,
  `branch_name` varchar(191) DEFAULT NULL,
  `bank_name` varchar(191) DEFAULT NULL,
  `no_img` varchar(191) DEFAULT NULL,
  `footer_description` varchar(191) DEFAULT NULL,
  `meta_pixel_script` longtext DEFAULT NULL,
  `footer_title` varchar(191) DEFAULT NULL,
  `copyright_msg` varchar(191) DEFAULT NULL,
  `shop_name` varchar(191) DEFAULT NULL,
  `welcome_msg` varchar(191) DEFAULT NULL,
  `bkash_no` varchar(191) DEFAULT NULL,
  `account_type` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `logo`, `favicon`, `phone`, `email`, `address`, `established`, `facebook`, `twitter`, `instagram`, `youtube`, `pinterest`, `contact_us_img`, `inside_dhaka_dc`, `outside_dhaka_dc`, `sub_urban_areas_dc`, `acc_no`, `routing_number`, `branch_name`, `bank_name`, `no_img`, `footer_description`, `meta_pixel_script`, `footer_title`, `copyright_msg`, `shop_name`, `welcome_msg`, `bkash_no`, `account_type`, `created_at`, `updated_at`) VALUES
(1, 'uploads/logo/logo_68f3171f515223.75285263.jpeg', 'uploads/logo/logo_68eba58f952aa3.56981447.jpg', '01855179222', 'admin@gmail.com', 'Gaibandha', '2019', 'https://www.facebook.com/groups/4562053240493346', 'https://www.twitter.com', 'https://www.ig.com', 'https://www.yt.com', 'https://www.pt.com', 'uploads/logo/logo_68eba58f953217.51179880.jpg', 80, 150, 120, '984533', '123456789', 'Branch Name', 'Bank Name', NULL, 'Register now to get updates on pronot get up icons & coupons ster now toon.', '1144797380466787', 'Got Question? Call us 24/7', 'Copyright © 2025 Glamours World. All Rights Reserved.', 'Glamours World', 'Welcome to Glamours World message or remove it!', NULL, NULL, '2025-10-12 06:56:47', '2025-10-17 22:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(191) NOT NULL,
  `sub_title` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `user_id`, `category_id`, `brand_id`, `title`, `sub_title`, `image`, `created_at`, `updated_at`) VALUES
(7, 1, NULL, 9, '.', '.', 'uploads/sliders/17609128911IMG_6362.jpeg', '2025-10-19 16:17:12', '2025-10-19 16:28:11'),
(8, 1, NULL, 9, 'Genabelle', '.', 'uploads/sliders/17609130481IMG_6360.jpeg', '2025-10-19 16:30:48', '2025-10-19 16:30:48'),
(9, 1, NULL, 9, '.', '.', 'uploads/sliders/17609131581IMG_6363.jpeg', '2025-10-19 16:32:38', '2025-10-19 16:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(191) NOT NULL,
  `is_mega_menu` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `user_id`, `category_id`, `subcategory_name`, `is_mega_menu`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Ross Burke', 1, NULL, 'Active', '2025-10-06 02:46:16', '2025-10-06 02:46:16'),
(2, 1, 1, 'Desirae Morin', 1, NULL, 'Active', '2025-10-06 02:46:22', '2025-10-06 02:46:22'),
(3, 1, 7, 'Clayton Bishop', 1, NULL, 'Active', '2025-10-06 02:46:28', '2025-10-06 02:46:28'),
(4, 1, 7, 'Desiree Randall', 1, NULL, 'Active', '2025-10-06 02:46:34', '2025-10-06 03:06:40'),
(5, 1, 4, 'Leilani Welch', 1, NULL, 'Active', '2025-10-06 02:46:41', '2025-10-06 02:46:41'),
(6, 1, 6, 'Derek Warner', 1, NULL, 'Active', '2025-10-06 02:46:45', '2025-10-06 03:02:41'),
(8, 1, 6, 'Emmanuel Lindsay', 1, NULL, 'Active', '2025-10-07 04:05:36', '2025-10-07 04:05:36'),
(9, 1, 7, 'Kristen Hebert', 1, NULL, 'Active', '2025-10-07 04:19:01', '2025-10-07 04:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `user_id`, `unit_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'KG', 'Active', '2025-10-06 04:02:44', '2025-10-06 04:02:44'),
(2, 1, 'Pairs', 'Active', '2025-10-06 04:02:51', '2025-10-06 04:05:02'),
(4, 1, 'gm', 'Active', '2025-10-06 04:04:52', '2025-10-06 04:04:52'),
(5, 1, 'PCS', 'Active', '2025-10-06 05:13:23', '2025-10-06 05:13:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role` varchar(191) NOT NULL DEFAULT 'user',
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT 'defaults/profile.png',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role`, `email`, `phone`, `email_verified_at`, `password`, `image`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, NULL, '$2y$10$70lTVHwKQZV/KBz70dZC3e25m5/SrpksjlD04ChPWjCXncIvLtjn2', 'defaults/profile.png', 'Active', NULL, NULL, NULL),
(2, 'Md. Ekram Hossain', 'user', 'ekramhossainekram28@gmail.com', '01799327845', NULL, '$2y$10$6IFfknWwu3OAFFyXQo9/fOUovjBhLPs3JNAX9LzIn34lkhasCY59e', 'defaults/profile.png', 'Active', NULL, '2025-10-11 02:10:31', '2025-10-11 02:10:31');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `variant_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variants`
--

INSERT INTO `variants` (`id`, `user_id`, `variant_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Color', 'Active', '2025-10-07 02:45:39', '2025-10-07 02:45:39'),
(2, 1, 'Size', 'Active', '2025-10-07 02:45:49', '2025-10-13 05:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `whishlists`
--

CREATE TABLE `whishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whishlists`
--

INSERT INTO `whishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, '2025-10-11 02:54:33', '2025-10-11 02:54:33'),
(3, 2, 5, '2025-10-11 03:09:51', '2025-10-11 03:09:51'),
(4, 1, 10, '2025-10-19 16:03:54', '2025-10-19 16:03:54'),
(5, 1, 13, '2025-10-19 16:06:57', '2025-10-19 16:06:57'),
(6, 1, 11, '2025-10-19 16:06:59', '2025-10-19 16:06:59'),
(7, 1, 9, '2025-10-19 16:07:01', '2025-10-19 16:07:01'),
(8, 2, 11, '2025-10-20 02:59:49', '2025-10-20 02:59:49'),
(9, 2, 10, '2025-10-20 02:59:49', '2025-10-20 02:59:49'),
(10, 2, 9, '2025-10-20 02:59:51', '2025-10-20 02:59:51'),
(11, 2, 7, '2025-10-20 02:59:54', '2025-10-20 02:59:54'),
(12, 2, 8, '2025-10-20 02:59:55', '2025-10-20 02:59:55'),
(13, 1, 12, '2025-10-20 03:02:27', '2025-10-20 03:02:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `banners_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_brand_name_unique` (`brand_name`);

--
-- Indexes for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_category_brand_id_foreign` (`brand_id`),
  ADD KEY `brand_category_category_id_foreign` (`category_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `cosmetics`
--
ALTER TABLE `cosmetics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cosmetics_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `intros`
--
ALTER TABLE `intros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paymentmethods_name_unique` (`name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`);

--
-- Indexes for table `productvariants`
--
ALTER TABLE `productvariants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_imgs_product_id_foreign` (`product_id`),
  ADD KEY `product_imgs_user_id_foreign` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sliders_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_subcategory_name_unique` (`subcategory_name`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_unit_name_unique` (`unit_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variants_variant_name_unique` (`variant_name`);

--
-- Indexes for table `whishlists`
--
ALTER TABLE `whishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `brand_category`
--
ALTER TABLE `brand_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cosmetics`
--
ALTER TABLE `cosmetics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `intros`
--
ALTER TABLE `intros`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `paymentmethods`
--
ALTER TABLE `paymentmethods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `productvariants`
--
ALTER TABLE `productvariants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_imgs`
--
ALTER TABLE `product_imgs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `whishlists`
--
ALTER TABLE `whishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `banners`
--
ALTER TABLE `banners`
  ADD CONSTRAINT `banners_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `brand_category`
--
ALTER TABLE `brand_category`
  ADD CONSTRAINT `brand_category_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `brand_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cosmetics`
--
ALTER TABLE `cosmetics`
  ADD CONSTRAINT `cosmetics_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_imgs`
--
ALTER TABLE `product_imgs`
  ADD CONSTRAINT `product_imgs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_imgs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sliders`
--
ALTER TABLE `sliders`
  ADD CONSTRAINT `sliders_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
