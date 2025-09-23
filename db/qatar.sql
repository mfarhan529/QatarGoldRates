-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Sep 23, 2025 at 08:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qatar`
--

-- --------------------------------------------------------

--
-- Table structure for table `14k_gold`
--

CREATE TABLE `14k_gold` (
  `id` int(11) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Currencies` varchar(10) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `14k_gold`
--

INSERT INTO `14k_gold` (`id`, `Weight`, `Currencies`, `Prices`, `created_at`) VALUES
(1, '10 Grams', 'QAR', 367.00, '2025-09-21 02:30:30'),
(2, '10 Grams', 'USD', 234.00, '2025-09-21 02:30:30'),
(3, '10 Grams', 'INR', 111.00, '2025-09-21 02:30:30'),
(4, '1 Ounce', 'QAR', 222.00, '2025-09-10 21:45:00'),
(5, '1 Ounce', 'USD', 333.00, '2025-09-10 21:45:00'),
(6, '1 Ounce', 'INR', 111.00, '2025-09-10 21:45:00'),
(7, '1 Gram', 'QAR', 145.00, '2025-09-10 21:45:00'),
(8, '1 Gram', 'USD', 643.00, '2025-09-10 21:45:00'),
(9, '1 Gram', 'INR', 246.00, '2025-09-10 21:45:00'),
(10, '1 Tola', 'QAR', 245.00, '2025-09-10 21:45:00'),
(11, '1 Tola', 'USD', 356.00, '2025-09-10 21:45:00'),
(12, '1 Tola', 'INR', 247.00, '2025-09-10 21:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `18k_gold`
--

CREATE TABLE `18k_gold` (
  `id` int(11) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Currencies` varchar(10) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `18k_gold`
--

INSERT INTO `18k_gold` (`id`, `Weight`, `Currencies`, `Prices`, `created_at`) VALUES
(7, '1 Tola', 'QAR', 124.00, '2025-09-10 21:45:00'),
(8, '1 Tola', 'USD', 356.00, '2025-09-10 21:45:00'),
(9, '1 Tola', 'INR', 135.00, '2025-09-10 21:45:00'),
(10, '1 Gram', 'QAR', 179.00, '2025-09-10 21:45:00'),
(11, '1 Gram', 'USD', 474.00, '2025-09-10 21:45:00'),
(12, '1 Gram', 'INR', 257.00, '2025-09-10 21:45:00'),
(22, '1 Ounce', 'QAR', 367.00, '2025-09-10 21:45:00'),
(23, '1 Ounce', 'USD', 335.00, '2025-09-10 21:45:00'),
(24, '1 Ounce', 'INR', 322.00, '2025-09-10 21:45:00'),
(25, '1 Tola', 'QAR', 363.00, '2025-09-21 00:46:18'),
(26, '1 Tola', 'USD', 367.00, '2025-09-21 00:46:18'),
(27, '1 Tola', 'INR', 364.00, '2025-09-21 00:46:18'),
(28, '10 Grams', 'QAR', 332.00, '2025-09-21 00:46:32'),
(29, '10 Grams', 'USD', 578.00, '2025-09-21 00:46:32'),
(30, '10 Grams', 'INR', 237.00, '2025-09-21 00:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `21k_gold`
--

CREATE TABLE `21k_gold` (
  `id` int(11) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Currencies` varchar(10) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `21k_gold`
--

INSERT INTO `21k_gold` (`id`, `Weight`, `Currencies`, `Prices`, `created_at`) VALUES
(4, '1 Ounce', 'QAR', 145.00, '2025-09-10 21:45:00'),
(5, '1 Ounce', 'USD', 246.00, '2025-09-10 21:45:00'),
(6, '1 Ounce', 'INR', 790.00, '2025-09-10 21:45:00'),
(7, '1 Gram', 'QAR', 467.00, '2025-09-10 21:45:00'),
(8, '1 Gram', 'USD', 247.00, '2025-09-10 21:45:00'),
(9, '1 Gram', 'INR', 274.00, '2025-09-10 21:45:00'),
(10, '1 Tola', 'QAR', 157.00, '2025-09-10 21:45:00'),
(11, '1 Tola', 'USD', 236.00, '2025-09-10 21:45:00'),
(12, '1 Tola', 'INR', 368.00, '2025-09-10 21:45:00'),
(13, '10 Grams', 'QAR', 145.00, '2025-09-20 22:51:32'),
(14, '10 Grams', 'USD', 321.00, '2025-09-20 22:51:32'),
(15, '10 Grams', 'INR', 136.00, '2025-09-20 22:51:32'),
(16, '1 Tola', 'QAR', 111.00, '2025-09-20 22:52:46'),
(17, '1 Tola', 'USD', 234.00, '2025-09-20 22:52:46'),
(18, '1 Tola', 'INR', 351.00, '2025-09-20 22:52:46'),
(19, '1 Ounce', 'QAR', 256.00, '2025-09-20 22:53:09'),
(20, '1 Ounce', 'USD', 268.00, '2025-09-20 22:53:09'),
(21, '1 Ounce', 'INR', 111.00, '2025-09-20 22:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `22k_gold`
--

CREATE TABLE `22k_gold` (
  `id` int(11) NOT NULL,
  `Weight` varchar(50) NOT NULL,
  `Currencies` varchar(10) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `22k_gold`
--

INSERT INTO `22k_gold` (`id`, `Weight`, `Currencies`, `Prices`, `created_at`) VALUES
(4, '1 Tola', 'QAR', 111.00, '2025-09-10 21:45:00'),
(5, '1 Tola', 'USD', 222.00, '2025-09-10 21:45:00'),
(6, '1 Tola', 'INR', 333.00, '2025-09-10 21:45:00'),
(7, '1 Gram', 'QAR', 444.00, '2025-09-10 21:45:00'),
(8, '1 Gram', 'USD', 555.00, '2025-09-10 21:45:00'),
(9, '1 Gram', 'INR', 666.00, '2025-09-10 21:45:00'),
(10, '1 Ounce', 'QAR', 77.00, '2025-09-10 21:45:00'),
(11, '1 Ounce', 'USD', 876.00, '2025-09-10 21:45:00'),
(12, '1 Ounce', 'INR', 578.00, '2025-09-10 21:45:00'),
(13, '10 Grams', 'QAR', 456.00, '2025-09-20 20:26:27'),
(14, '10 Grams', 'USD', 743.00, '2025-09-20 20:26:27'),
(15, '10 Grams', 'INR', 257.00, '2025-09-20 20:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `24k_gold`
--

CREATE TABLE `24k_gold` (
  `id` int(25) NOT NULL,
  `currency_id` int(25) NOT NULL,
  `Purity` varchar(255) NOT NULL,
  `Weight` varchar(255) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `24k_gold`
--

INSERT INTO `24k_gold` (`id`, `currency_id`, `Purity`, `Weight`, `Prices`, `created_at`, `updated_at`) VALUES
(3, 1, '24K Gold', '1 Gram', 440.50, '2025-09-23 03:32:10', '2025-09-23 03:32:10'),
(4, 2, '24K Gold', '1 Gram', 118.59, '2025-09-23 03:32:41', '2025-09-23 03:32:41'),
(5, 3, '24K Gold', '1 Gram', 11215.00, '2025-09-23 03:33:22', '2025-09-23 03:33:22'),
(6, 4, '24K Gold', '1 Gram', 33042.40, '2025-09-23 03:34:11', '2025-09-23 03:34:11'),
(7, 1, '24K Gold', '10 Grams', 4405.00, '2025-09-23 04:51:26', '2025-09-23 04:51:26'),
(8, 2, '24K Gold', '10 Grams', 1201.53, '2025-09-23 04:52:14', '2025-09-23 04:52:14'),
(9, 3, '24K Gold', '10 Grams', 119957.00, '2025-09-23 04:52:54', '2025-09-23 04:52:54'),
(10, 4, '24K Gold', '10 Grams', 332400.00, '2025-09-23 04:54:58', '2025-09-23 04:54:58'),
(11, 1, '24K Gold', '1 Tola', 5301.00, '2025-09-23 04:55:54', '2025-09-23 04:55:54'),
(12, 2, '24K Gold', '1 Tola', 1410.25, '2025-09-23 04:57:14', '2025-09-23 04:57:14'),
(13, 3, '24K Gold', '1 Tola', 133678.00, '2025-09-23 04:58:08', '2025-09-23 04:58:08'),
(14, 4, '24K Gold', '1 Tola', 384200.00, '2025-09-23 04:58:41', '2025-09-23 04:58:41'),
(15, 1, '24K Gold', '1 Ounce', 82626.23, '2025-09-23 05:00:05', '2025-09-23 05:00:05'),
(16, 2, '24K Gold', '1 Ounce', 3738.06, '2025-09-23 05:00:49', '2025-09-23 05:00:49'),
(17, 3, '24K Gold', '1 Ounce', 318053.00, '2025-09-23 05:01:27', '2025-09-23 05:01:27'),
(18, 4, '24K Gold', '1 Ounce', 1024550.00, '2025-09-23 05:02:03', '2025-09-23 05:02:03');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `Symbol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `Symbol`) VALUES
(1, 'QAR'),
(2, 'USD'),
(3, 'INR'),
(4, 'PKR');

-- --------------------------------------------------------

--
-- Table structure for table `diamond_prices`
--

CREATE TABLE `diamond_prices` (
  `id` int(11) NOT NULL,
  `Gemstone` varchar(50) NOT NULL,
  `Weight` varchar(10) NOT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diamond_prices`
--

INSERT INTO `diamond_prices` (`id`, `Gemstone`, `Weight`, `Currency`, `Price`, `created_at`) VALUES
(8, 'Lab Grown Diamond', '1 carat', 'QAR', 123.00, '2025-09-18 01:08:12'),
(9, 'Natural Diamond', '1 carat', 'INR', 563.00, '2025-09-16 01:08:58'),
(10, 'Fancy Color Diamond', '1 carat', 'INR', 345.00, '2025-09-18 05:19:13'),
(11, 'Natural Diamond', '1 carat', 'INR', 356.00, '2025-09-18 10:18:07'),
(12, 'Fancy Color Diamond', '2 carat', 'USD', 246.00, '2025-09-18 10:18:28'),
(17, 'Lab Grown Diamond', '2 carat', 'QAR', 111.00, '2025-09-20 01:12:09'),
(19, 'Fancy Color Diamond', '2 carat', 'QAR', 903.00, '2025-09-20 09:23:38');

-- --------------------------------------------------------

--
-- Table structure for table `emerald_prices`
--

CREATE TABLE `emerald_prices` (
  `id` int(11) NOT NULL,
  `Gemstone` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emerald_prices`
--

INSERT INTO `emerald_prices` (`id`, `Gemstone`, `Weight`, `Currency`, `Price`, `created_at`) VALUES
(1, 'Bluish Green Emerald', '10g', 'QAR', 25.50, '2025-09-18 06:07:34'),
(2, 'Green Emerald', '50g', 'QAR', 120.75, '2025-09-18 06:07:34'),
(3, 'Lab Grown Emerald', '100g', 'USD', 330.00, '2025-09-17 06:07:34'),
(7, 'Green Emerald', '1 carat', 'QAR', 467.00, '2025-09-18 10:33:15'),
(10, 'Green Emerald', '5 carat', 'INR', 333.00, '2025-09-19 10:22:28'),
(11, 'Yellowish Green Emerald', '1 carat', 'QAR', 778.00, '2025-09-19 10:22:46'),
(12, 'Bluish Green Emerald', '5 carat', 'INR', 167.00, '2025-09-19 10:23:03'),
(13, 'Lab Grown Emerald', '5 carat', 'USD', 490.00, '2025-09-19 10:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `gold_prices`
--

CREATE TABLE `gold_prices` (
  `id` int(25) NOT NULL,
  `currency_id` int(255) DEFAULT NULL,
  `Purity` varchar(50) NOT NULL,
  `Prices` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gold_prices`
--

INSERT INTO `gold_prices` (`id`, `currency_id`, `Purity`, `Prices`, `created_at`, `updated_at`) VALUES
(8, 1, '24K Gold', 5301.00, '2025-09-23 02:10:40', '2025-09-23 02:10:40'),
(9, 2, '24K Gold', 1407.32, '2025-09-23 02:11:45', '2025-09-23 02:11:45'),
(10, 3, '24K Gold', 123290.00, '2025-09-23 02:12:33', '2025-09-23 02:12:33'),
(11, 4, '24K Gold', 384200.00, '2025-09-23 02:13:08', '2025-09-23 02:13:08'),
(13, 1, '18K Gold', 3838.08, '2025-09-23 07:19:06', '2025-09-23 07:19:06'),
(14, 2, '18K Gold', 1054.06, '2025-09-23 07:19:28', '2025-09-23 07:19:28'),
(15, 3, '18K Gold', 93081.09, '2025-09-23 07:23:09', '2025-09-23 07:23:09'),
(16, 4, '18K Gold', 296711.86, '2025-09-23 07:23:45', '2025-09-23 07:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `pearl_prices`
--

CREATE TABLE `pearl_prices` (
  `id` int(11) NOT NULL,
  `Gemstone` varchar(50) DEFAULT NULL,
  `Length` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pearl_prices`
--

INSERT INTO `pearl_prices` (`id`, `Gemstone`, `Length`, `Currency`, `Price`, `created_at`) VALUES
(5, 'Blue Ruby', '500g', 'QAR', 600.25, '2025-09-17 07:27:03'),
(6, 'Freshwater Pearl', '6-10 mm', 'INR', 467.00, '2025-09-18 07:36:30'),
(8, 'Akoya Pearl', '6-10 mm', 'QAR', 247.00, '2025-09-18 10:40:33'),
(9, 'South Sea Pearl', '10+ mm', 'QAR', 576.00, '2025-09-18 10:40:48'),
(10, 'Freshwater Pearl', '10+ mm', 'QAR', 268.00, '2025-09-19 07:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `platinum_prices`
--

CREATE TABLE `platinum_prices` (
  `id` int(11) NOT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `platinum_prices`
--

INSERT INTO `platinum_prices` (`id`, `Weight`, `Currency`, `Price`, `created_at`) VALUES
(4, '250g', 'INR', 15000.00, '2025-09-18 05:23:17'),
(5, '500g', 'QAR', 600.25, '2025-09-18 05:23:17'),
(6, '1 Tola', 'QAR', 100.00, '2025-09-18 06:00:11'),
(7, '10 Grams', 'INR', 324.00, '2025-09-18 06:00:41'),
(8, '2 Gram', 'INR', 345.00, '2025-09-18 10:30:52');

-- --------------------------------------------------------

--
-- Table structure for table `ruby_prices`
--

CREATE TABLE `ruby_prices` (
  `id` int(11) NOT NULL,
  `Gemstone` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ruby_prices`
--

INSERT INTO `ruby_prices` (`id`, `Gemstone`, `Weight`, `Currency`, `Price`, `created_at`) VALUES
(1, 'Lab Grown Ruby', '10g', 'QAR', 25.50, '2025-09-18 06:22:51'),
(4, 'Green Ruby', '250g', 'INR', 15000.00, '2025-09-17 06:22:51'),
(7, 'Lab Grown Ruby', '1 carat', 'QAR', 356.00, '2025-09-18 10:35:40'),
(8, 'Natural Ruby', '10 carat', 'QAR', 335.00, '2025-09-18 10:35:54'),
(9, 'Natural Ruby', '2 carat', 'QAR', 357.00, '2025-09-19 07:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `sapphire_prices`
--

CREATE TABLE `sapphire_prices` (
  `id` int(11) NOT NULL,
  `Gemstone` varchar(50) DEFAULT NULL,
  `Weight` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sapphire_prices`
--

INSERT INTO `sapphire_prices` (`id`, `Gemstone`, `Weight`, `Currency`, `Price`, `created_at`) VALUES
(1, 'Lab Grown Ruby', '10g', 'QAR', 25.50, '2025-09-18 06:32:21'),
(3, 'Natural Ruby', '100g', 'USD', 330.00, '2025-09-18 06:32:21'),
(4, 'Green Ruby', '250g', 'INR', 15000.00, '2025-09-18 06:32:21'),
(5, 'Blue Ruby', '500g', 'QAR', 600.25, '2025-09-18 06:32:21'),
(6, 'White Sapphire', '1 carat', 'INR', 456.00, '2025-09-18 06:40:29'),
(7, 'Pink Sapphire', '1 carat', 'QAR', 354.00, '2025-09-18 10:37:01'),
(8, 'Green Sapphire', '1 carat', 'QAR', 245.00, '2025-09-18 10:37:17'),
(9, 'Pink Sapphire', '1 carat', 'INR', 367.00, '2025-09-19 07:20:13');

-- --------------------------------------------------------

--
-- Table structure for table `silver_prices`
--

CREATE TABLE `silver_prices` (
  `id` int(11) NOT NULL,
  `Quantity` varchar(50) DEFAULT NULL,
  `Currency` varchar(10) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `silver_prices`
--

INSERT INTO `silver_prices` (`id`, `Quantity`, `Currency`, `Price`, `created_at`) VALUES
(3, '100g', 'USD', 330.00, '2025-09-17 23:41:59'),
(4, '250g', 'INR', 15000.00, '2025-09-17 23:41:59'),
(8, '1 Kg', 'USD', 123.00, '2025-09-18 00:29:43'),
(9, '2 Tola', 'QAR', 100.00, '2025-09-18 10:13:43'),
(11, '1 Kg', 'QAR', 111.00, '2025-09-19 20:06:42'),
(13, '1 Ounce', 'QAR', 346.00, '2025-09-19 20:07:26'),
(14, '1 Tola', 'QAR', 222.00, '2025-09-19 20:08:40'),
(15, '1 Gram', 'QAR', 123.00, '2025-09-19 20:08:57'),
(16, '1 Tola', 'QAR', 234.00, '2025-09-23 07:44:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `14k_gold`
--
ALTER TABLE `14k_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `18k_gold`
--
ALTER TABLE `18k_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `21k_gold`
--
ALTER TABLE `21k_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `22k_gold`
--
ALTER TABLE `22k_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `24k_gold`
--
ALTER TABLE `24k_gold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diamond_prices`
--
ALTER TABLE `diamond_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emerald_prices`
--
ALTER TABLE `emerald_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gold_prices`
--
ALTER TABLE `gold_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pearl_prices`
--
ALTER TABLE `pearl_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `platinum_prices`
--
ALTER TABLE `platinum_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruby_prices`
--
ALTER TABLE `ruby_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sapphire_prices`
--
ALTER TABLE `sapphire_prices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `silver_prices`
--
ALTER TABLE `silver_prices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `14k_gold`
--
ALTER TABLE `14k_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `18k_gold`
--
ALTER TABLE `18k_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `21k_gold`
--
ALTER TABLE `21k_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `22k_gold`
--
ALTER TABLE `22k_gold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `24k_gold`
--
ALTER TABLE `24k_gold`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `diamond_prices`
--
ALTER TABLE `diamond_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `emerald_prices`
--
ALTER TABLE `emerald_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gold_prices`
--
ALTER TABLE `gold_prices`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pearl_prices`
--
ALTER TABLE `pearl_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `platinum_prices`
--
ALTER TABLE `platinum_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ruby_prices`
--
ALTER TABLE `ruby_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sapphire_prices`
--
ALTER TABLE `sapphire_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `silver_prices`
--
ALTER TABLE `silver_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
