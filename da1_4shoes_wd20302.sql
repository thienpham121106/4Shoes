-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2025 at 11:34 PM
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
-- Database: `da1_4shoes_wd20302`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'ADIDAS'),
(2, 'NIKE'),
(3, 'PUMA'),
(17, 'ád'),
(18, 'dấd'),
(19, 'a'),
(20, 'ăgaweg');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Giày'),
(2, 'Áo đá banh');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `voucher_id` int DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL DEFAULT '0.00',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','processing','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_method` enum('cod','card','paypal','momo') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cod',
  `transaction_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `voucher_id`, `total_price`, `order_date`, `status`, `payment_method`, `transaction_code`, `user_name`, `address`, `note`, `phone`, `email`) VALUES
(1, 5, NULL, 2750000.00, '2025-12-06 03:25:47', 'completed', 'cod', NULL, 'a', '515A Lê Thị Riêng - Hà Nội', 'a', '0985428627', 'vinh38077@gmail.com'),
(2, 5, NULL, 3200000.00, '2025-12-06 03:36:31', 'completed', 'cod', NULL, 'a', '515A Lê Thị Riêng - Hà Nội', 'a', '0985428627', 'vinh38077@gmail.com'),
(3, 5, NULL, 3200000.00, '2025-12-06 03:40:02', 'completed', 'cod', NULL, 'a', '515A Lê Thị Riêng - Hà Nội', 'a', '0985428627', 'vinh38077@gmail.com'),
(4, 9, NULL, 1200000.00, '2025-12-10 21:47:55', 'cancelled', 'cod', NULL, 'asd', '481/16 - Hà Nội', '123', '0396593637', 'hehethien7@gmail.com'),
(5, 9, NULL, 7000000.00, '2025-12-10 22:24:47', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hồ Chí Minh', 'giao lẹ đi', '03965936371', 'thienpham121106@gmail.com'),
(6, 9, NULL, 7000000.00, '2025-12-10 22:27:23', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hồ Chí Minh', '', '03965936371', 'thienpham121106@gmail.com'),
(7, 9, NULL, 7000000.00, '2025-12-10 22:31:41', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hồ Chí Minh', '', '03965936371', 'thienpham121106@gmail.com'),
(8, 9, NULL, 7000000.00, '2025-12-10 22:32:14', 'cancelled', 'momo', NULL, 'thien', '481/16 - Đà Nẵng', '', '03965936371', 'thienpham121106@gmail.com'),
(9, 9, NULL, 200000.00, '2025-12-10 22:35:16', 'cancelled', 'momo', NULL, 'thien', '481/16', 't', '03965936371', 'thienpham121106@gmail.com'),
(10, 9, NULL, 200000.00, '2025-12-10 22:36:16', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hà Nội', '', '03965936371', 'thienpham121106@gmail.com'),
(11, 9, NULL, 200000.00, '2025-12-10 22:52:09', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hà Nội', '1123', '03965936371', 'thienpham121106@gmail.com'),
(12, 9, NULL, 200000.00, '2025-12-10 22:53:56', 'cancelled', 'momo', NULL, 'thien', '481/16', '123', '03965936371', 'thienpham121106@gmail.com'),
(13, 9, NULL, 2000000.00, '2025-12-10 22:59:49', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hà Nội', '123', '03965936371', 'thienpham121106@gmail.com'),
(14, 9, NULL, 2000000.00, '2025-12-10 23:16:47', 'cancelled', 'momo', NULL, 'thien', '481/16 - Hà Nội', '123', '03965936371', 'thienpham121106@gmail.com'),
(15, 9, NULL, 200000.00, '2025-12-10 23:40:48', 'pending', 'cod', NULL, 'thien', '481/16 - Hà Nội', '123', '03965936371', 'thienpham121106@gmail.com'),
(16, 9, NULL, 2000000.00, '2025-12-11 00:26:30', 'processing', 'momo', NULL, 'thien', '123 - Hà Nội', '123', '03965936371', 'thienpham121106@gmail.com'),
(17, 9, NULL, 1200000.00, '2025-12-11 01:42:15', 'pending', 'cod', NULL, 'thien', '123', '123', '03965936371', 'thienpham121106@gmail.com'),
(18, 9, 5, 1100000.00, '2025-12-11 01:45:17', 'pending', 'cod', NULL, 'thien', '481/16', '123', '03965936371', 'thienpham121106@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 5, 1, 2750000.00),
(2, 2, 6, 1, 3200000.00),
(3, 3, 6, 1, 3200000.00),
(4, 4, 7, 1, 1200000.00),
(5, 11, 8, 1, 200000.00),
(6, 12, 8, 1, 200000.00),
(7, 13, 10, 2, 1000000.00),
(8, 14, 10, 2, 1000000.00),
(9, 15, 8, 1, 200000.00),
(10, 16, 10, 2, 1000000.00),
(11, 17, 7, 1, 1200000.00),
(12, 18, 7, 1, 1200000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `category_id` int NOT NULL,
  `brand_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `brand_id`, `name`, `price`, `description`, `image`, `stock`) VALUES
(4, 1, 2, 'GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL VAPOR 16 ACADEMY HỒNG ĐỎ/XANH TF', 1750000, 'Giày thể thao siêu bền', 'pd2.jpg', 44),
(5, 1, 2, 'GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL VAPOR 16 PRO HỒNG ĐỎ/XANH TF', 2750000, 'Giày Nike siêu bền', 'pd3.png', 120),
(6, 1, 1, 'GIÀY BÓNG ĐÁ ADIDAS PREDATOR EDGE.1 XANH NAVY TF', 3200000, 'Giày Adidas bền và đẹp', 'pd4.jpg', 22),
(7, 1, 1, 'GIÀY ĐÁ BÓNG NIKE MERCURIAL', 1200000, 'Giày vip proS', 'pd8.jpg', 2),
(8, 1, 1, 'NIKE ZOOM MERCURIAL SUPERFLY', 200000, '123123', 'pd5.jpg', 123),
(10, 1, 1, 'GIÀY ĐÁ BÓNG NIKE ZOOM MERCURIAL SUPERFLY 10 ACADEMY/PRO TF', 1000000, 'b', 'pd7.jpg', 123),
(11, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ CỎ NHÂN TẠO NIKE ZOOM MERCURIAL VAPOR 16 PRO XÁM XANH/HỒNG TF - FQ8687-301', 2750000, NULL, 'giay1.jpg', 36),
(12, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL SUPERFLY 9 ACADEMY TF - VÀNG CHANH', 1950000, NULL, 'giay2.jpg', 42),
(13, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE PHANTOM GX 2 PRO TF - TRẮNG/VÀNG KIM', 2650000, NULL, 'giay3.jpg', 28),
(14, 1, 2, ' GIÀY BÓNG ĐÁ NIKE TIEMPO LEGEND 10 PRO TF - ĐEN/XANH DƯƠNG', 2450000, NULL, 'giay4.jpg', 15),
(15, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL VAPOR 15 ELITE TF - HỒNG/TÍM', 3850000, NULL, 'giay5.jpg', 10),
(16, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE PHANTOM LUNA 2 ACADEMY TF - XANH NGỌC', 2100000, NULL, 'giay6.jpg', 50),
(17, 1, 2, 'GIÀY BÓNG ĐÁ NIKE STREETGATO - XÁM/CAM', 1890000, NULL, 'giay7.jpg', 33),
(18, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE PREMIER 3 TF - ĐEN CỔ ĐIỂN', 2250000, NULL, 'giay8.jpg', 20),
(19, 1, 2, ' GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL VAPOR 16 ACADEMY TF - BLUEPRINT PACK', 1990000, NULL, 'giay9.jpg', 65),
(20, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE PHANTOM GX ACADEMY DF TF - ĐỎ/TRẮNG', 1750000, NULL, 'giay10.jpg', 41),
(21, 1, 2, ' GIÀY BÓNG ĐÁ NIKE TIEMPO LEGEND 9 ACADEMY TF - TÍM THAN', 1450000, NULL, 'giay11.jpg', 18),
(22, 1, 2, '(CHÍNH HÃNG) GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL SUPERFLY 10 ELITE TF - TRẮNG TINH KHIẾT', 4100000, NULL, 'giay12.jpg', 8),
(23, 1, 2, ' GIÀY BÓNG ĐÁ NIKE LUNAR GATO II - TRẮNG/XANH DƯƠNG', 2300000, NULL, 'giay13.jpg', 25),
(24, 1, 2, 'GIÀY BÓNG ĐÁ NIKE PHANTOM GT2 ACADEMY TF - XANH LÁ', 1550000, NULL, 'giay14.jpg', 30),
(25, 1, 2, 'GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL VAPOR 15 CLUB TF - ĐEN (BẢN PHỔ THÔNG)', 950000, NULL, 'giay15.jpg', 100),
(26, 1, 2, 'GIÀY BÓNG ĐÁ NIKE TIEMPO LEGEND 10 ELITE TF - NGỌC TRAI', 3600000, NULL, 'giay16.jpg', 12),
(27, 1, 2, 'GIÀY BÓNG ĐÁ NIKE PHANTOM LUNA PRO TF - CAM ĐẤT', 2800000, NULL, 'giay17.jpg', 22),
(28, 1, 2, ' GIÀY BÓNG ĐÁ NIKE ZOOM MERCURIAL SUPERFLY 9 CLUB TF - XÁM BẠC', 1150000, NULL, 'giay18.jpg', 80),
(29, 1, 2, ' GIÀY BÓNG ĐÁ NIKE REACT GATO - ĐEN/VÀNG NEON', 2950000, NULL, 'giay19.jpg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00',
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_hidden` tinyint(1) DEFAULT '0',
  `is_blocked` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `is_hidden`, `is_blocked`) VALUES
(1, 'Nguyễn Hoàng Phú Vinh', 'vinh38077@gmail.com', '$2y$10$hjYwLVJdQY9XUEmUj1DFWOH/eBSQuDi6UOfdX3AE.eUqw/QQlZyKu', 'user', '0985428627', 0, 0),
(2, 'Admin', 'admin123@gmail.com', '123456789', 'admin', '0987654321', 0, 0),
(3, 'ngh', 'vinh38077@gmail.com', '$2y$10$GXHdtB.1jE9Ejhj.eoKORezWc3OGgCcV1XTDSXhdimgV42OJyGeKq', 'user', '0123456789', 0, 0),
(4, 'Vinhh', 'vinh38077@gmail.com', '$2y$10$zvQMFEnGbT0isBoPg1DwGO8DsFXzbyQivW/Gi/nthPptuuu33/1uK', 'user', '0985428627', 0, 0),
(5, 'Nguyễn Hoàng Phú Vinh', 'phuvinh123@gmail.com', '$2y$10$syU0lOff7txQvQPyxDAus.1Z5ILjT.kqGMFErVAx4m1JU5XWCXmQ2', 'user', '0985428627', 0, 0),
(6, 'V', 'V@gmail.com', '$2y$10$rbpD7EgqdxyE9wNHKdPPTu8PY8nRY6X9pvSBaBN/e/Q/Qi.1PT.ry', 'user', '0987654322', 0, 0),
(7, 'NGHP', 'NNN@gmail.com', '$2y$10$x7OWO7WtA8KY4CgtMyZNae4RaFArhgJKb4PU4pO71jvWh6a12TV6a', 'user', '01234556789', 0, 0),
(8, 'vinh1', 'vinh1@gmail.com', '$2y$10$qvAVgv2qAI52DJ6Kf7Yb6OZPcWjDaVeV4c5mm2CxJeovXTa75RG1W', 'user', '0985428627', 0, 0),
(9, 'thien', 'thienpham121106@gmail.com', '$2y$10$wHyMQZ4uMUZB.QzZzh.ISeEmmfIZpPkMY4ESNAThFjXweQ7KD3yMm', 'user', '03965936371', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `code` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '100',
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `user_id`, `code`, `discount`, `quantity`, `status`) VALUES
(5, NULL, 'CHUNGVUI', 100000, 100, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `voucher_id` (`voucher_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
