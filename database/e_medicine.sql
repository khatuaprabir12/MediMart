-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 04:32 PM
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
-- Database: `e_medicine`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `profile_image`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Prabir', 'admin@gmail.com', '1234', 'users_img/1736362014_flower.jpg', 'admin', '2025-01-07 16:04:30', '2025-01-08 13:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 1, '2025-01-10 01:31:29', '2025-01-10 01:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cart_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `user_id`, `cart_id`, `product_id`, `product_name`, `product_price`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(31, 1, 13, 3, 'Moov-Gel', 59.00, 3, 177.00, '2025-01-11 11:38:27', '2025-01-11 11:40:23');

-- --------------------------------------------------------

--
-- Table structure for table `catagories`
--

CREATE TABLE `catagories` (
  `id` int(11) NOT NULL,
  `catagory_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `catagories`
--

INSERT INTO `catagories` (`id`, `catagory_name`) VALUES
(1, 'General'),
(2, 'Personal_Care'),
(3, 'Baby_Care');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `address`, `payment_method`, `subtotal`, `tax`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 'prabir', 'kolkata', 'credit_card', 132.15, 13.22, 145.37, '2025-01-04 09:25:39', '2025-01-04 09:25:39'),
(2, 1, 'prabir', 'nandigram', 'Cash on Delivery', 44.05, 4.41, 48.46, '2025-01-04 09:44:41', '2025-01-04 09:44:41'),
(3, 1, 'prabir khatua', 'sdf', 'Debit Card', 44.05, 4.41, 48.46, '2025-01-04 09:47:05', '2025-01-04 09:47:05'),
(4, 2, 'Subhajit', 'debra', 'Debit Card', 44.05, 4.41, 48.46, '2025-01-04 10:16:12', '2025-01-04 10:16:12'),
(5, 2, 'Subhajit', 'debra', 'Cash on Delivery', 88.10, 8.81, 96.91, '2025-01-04 20:53:26', '2025-01-04 20:53:26'),
(6, 4, 'dibhya', 'saltlake', 'UPI', 88.10, 8.81, 96.91, '2025-01-04 21:27:52', '2025-01-04 21:27:52'),
(7, 1, 'prabir khatua', 'nandigram', 'Cash on Delivery', 44.05, 4.41, 48.46, '2025-01-04 21:35:41', '2025-01-04 21:35:41'),
(8, 1, 'prabir khatua', 'simulkunda', 'Cash on Delivery', 44.05, 4.41, 48.46, '2025-01-04 21:44:46', '2025-01-04 21:44:46'),
(9, 2, 'prabir', 'sdf', 'Debit Card', 44.05, 4.41, 48.46, '2025-01-05 08:43:56', '2025-01-05 08:43:56'),
(10, 1, 'prabir', 'sdf', 'Cash on Delivery', 99.00, 9.90, 108.90, '2025-01-07 12:36:30', '2025-01-07 12:36:30'),
(11, 1, 'Prabir Khatua', 'New Town', 'Debit Card', 408.70, 40.87, 449.57, '2025-01-09 09:04:28', '2025-01-09 09:04:28'),
(12, 2, 'Subhajit Pal', 'debra', 'Debit Card', 118.00, 11.80, 129.80, '2025-01-11 07:37:19', '2025-01-11 07:37:19'),
(13, 2, 'Subhajit Pal', 'medinipur', 'Cash on Delivery', 59.00, 5.90, 64.90, '2025-01-11 07:39:23', '2025-01-11 07:39:23'),
(14, 2, 'Subhajit Pal', 'debra', 'Credit Card', 118.00, 11.80, 129.80, '2025-01-11 07:42:40', '2025-01-11 07:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Saridon Tablet', 44.05, 3, 132.15, '2025-01-04 09:25:39', '2025-01-04 09:25:39'),
(2, 8, 1, 'Saridon Tablet', 44.05, 1, 44.05, '2025-01-04 21:44:46', '2025-01-04 21:44:46'),
(3, 9, 1, 'Saridon Tablet', 44.05, 1, 44.05, '2025-01-05 08:43:56', '2025-01-05 08:43:56'),
(4, 10, 2, 'Zypara-650-mg', 99.00, 1, 99.00, '2025-01-07 12:36:30', '2025-01-07 12:36:30'),
(5, 11, 2, 'Zypara-650-mg', 99.00, 2, 198.00, '2025-01-09 09:04:28', '2025-01-09 09:04:28'),
(6, 11, 11, 'Sensodyne Toothpaste 70 gm', 210.70, 1, 210.70, '2025-01-09 09:04:28', '2025-01-09 09:04:28'),
(7, 12, 3, 'Moov-Gel', 59.00, 2, 118.00, '2025-01-11 07:37:19', '2025-01-11 07:37:19'),
(8, 13, 3, 'Moov-Gel', 59.00, 1, 59.00, '2025-01-11 07:39:23', '2025-01-11 07:39:23'),
(9, 14, 3, 'Moov-Gel', 59.00, 2, 118.00, '2025-01-11 07:42:40', '2025-01-11 07:42:40');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `catagory_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `catagory_id`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 'Zypara-650-mg', 99.00, './product_image/1736183635_111030336_Zypara-650-mg-1674628249-10106739-1.jpg', 1, 0, '2025-01-06 11:43:55', '2025-01-11 15:20:10'),
(3, 'Moov-Gel', 59.00, './product_image/1736184125_109596656_Moov-Gel-1644223321-10004040-1.jpg', 1, 3, '2025-01-06 11:52:05', '2025-01-11 08:17:10'),
(8, 'Protein Powder', 499.00, './product_image/1736313534_100261242_D-Protin-Choc-Jar-Powder-1578649327-10004500-1.jpg', 2, 0, '2025-01-07 23:48:54', '2025-01-11 15:20:10'),
(9, 'SEBAMED BABY CLEANSING BAR 100gm', 249.00, './product_image/1736428939_sebamed_baby_cleansing_bar_100gm.jpg', 3, 5, '2025-01-09 07:52:19', '2025-01-09 13:22:19'),
(10, 'Pampers Active Baby Diapers', 747.20, './product_image/1736430110_pampers_active_baby_diapers_.jpg', 3, 5, '2025-01-09 08:11:50', '2025-01-09 13:41:50'),
(11, 'Sensodyne Toothpaste 70 gm', 210.70, './product_image/1736431420_sensodyne_repair_protect_toothpaste.jpg', 2, 2, '2025-01-09 08:33:40', '2025-01-09 14:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT 'client',
  `status` varchar(50) DEFAULT 'unblock',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `profile_image`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Prabir Khatua', 'khatuaprabir12@gmail.com', 9635662700, '1234', './users_img/1736615269_unnamed.png', 'client', 'unblock', '2025-01-01 23:32:03', '2025-01-11 11:37:49'),
(2, 'Subhajit pal', 'subhajit@gmail.com', 9635662788, '1234', './users_img/1735794244_passport-photo.webp', 'client', 'unblock', '2025-01-01 23:34:04', '2025-01-07 16:03:18'),
(4, 'dibhya', 'dibhya@gmail.com', 9564726559, '1234', './users_img/1736009886_flower.jpg', 'client', 'unblock', '2025-01-04 11:28:06', '2025-01-07 16:03:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `product_name` (`product_name`),
  ADD KEY `product_price` (`product_price`);

--
-- Indexes for table `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `price` (`price`),
  ADD UNIQUE KEY `image` (`image`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `catagories`
--
ALTER TABLE `catagories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_items_ibfk_3` FOREIGN KEY (`product_name`) REFERENCES `products` (`name`),
  ADD CONSTRAINT `cart_items_ibfk_4` FOREIGN KEY (`product_price`) REFERENCES `products` (`price`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
