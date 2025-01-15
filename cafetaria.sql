-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2025 at 01:04 PM
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
-- Database: `cafetaria`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `update_at`) VALUES
(1, 'Burger', '2024-01-11 00:18:25', '2024-04-29 05:08:54'),
(2, 'Hot Drink', '2024-05-15 12:28:08', '2024-08-01 13:39:48'),
(3, 'Cold Drink', '2024-03-22 14:04:28', '2024-05-04 15:36:01'),
(4, 'Ice Cream', '2024-09-01 03:16:48', '2024-10-09 15:33:14'),
(5, 'Soup', '2024-10-11 11:31:20', '2024-10-26 14:38:17'),
(6, 'Main Dash', '2024-07-29 10:04:00', '2024-09-10 07:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_by` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `notes` text DEFAULT NULL,
  `status` enum('processing','out for delivery','done') NOT NULL,
  `total` float NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_by`, `room_id`, `notes`, `status`, `total`, `created_at`) VALUES
(1, 7, 2, 'Order notes 1', 'processing', 423, '2024-08-28 15:33:30'),
(2, 4, 8, 'Order notes 2', 'done', 276, '2024-02-04 20:34:22'),
(3, 4, 9, 'Order notes 3', 'done', 277, '2024-03-08 08:20:49'),
(4, 3, 1, 'Order notes 4', 'out for delivery', 219, '2024-07-28 05:41:06'),
(5, 9, 5, 'Order notes 5', 'out for delivery', 181, '2024-03-03 15:04:38'),
(6, 3, 5, 'Order notes 6', 'out for delivery', 336, '2024-12-09 03:20:45'),
(7, 9, 4, 'Order notes 7', 'out for delivery', 411, '2024-03-12 10:52:48'),
(8, 3, 1, 'Order notes 8', 'processing', 401, '2024-02-16 05:46:51'),
(9, 1, 8, 'Order notes 9', 'done', 383, '2024-02-11 08:02:49'),
(10, 10, 4, 'Order notes 10', 'done', 495, '2024-04-12 20:20:44'),
(11, 1, 9, 'Order notes 11', 'out for delivery', 413, '2024-07-16 14:41:03'),
(12, 9, 5, 'Order notes 12', 'processing', 382, '2024-07-04 14:14:23'),
(13, 7, 10, 'Order notes 13', 'out for delivery', 241, '2024-10-13 14:20:38'),
(14, 9, 6, 'Order notes 14', 'processing', 330, '2024-05-11 00:09:32'),
(15, 5, 7, 'Order notes 15', 'done', 197, '2024-01-18 05:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `product_id`, `order_id`, `price`, `quantity`) VALUES
(1, 12, 1, 32, 5),
(2, 11, 4, 12, 5),
(3, 2, 13, 76, 5),
(4, 17, 10, 83, 2),
(5, 12, 5, 49, 3),
(6, 1, 15, 81, 1),
(7, 6, 11, 71, 4),
(8, 19, 7, 23, 2),
(9, 4, 6, 74, 2),
(10, 14, 1, 35, 4),
(11, 3, 15, 98, 1),
(12, 17, 14, 90, 4),
(13, 8, 12, 29, 1),
(14, 9, 5, 32, 3),
(15, 5, 3, 77, 5),
(16, 20, 6, 60, 4),
(17, 7, 8, 54, 5),
(18, 18, 11, 35, 2),
(19, 6, 6, 58, 4),
(20, 2, 9, 11, 3),
(21, 12, 15, 98, 5),
(22, 18, 7, 91, 3),
(23, 2, 7, 50, 4),
(24, 19, 10, 23, 2),
(25, 1, 7, 23, 4),
(26, 8, 8, 79, 1),
(27, 5, 7, 48, 5),
(28, 19, 14, 69, 5),
(29, 3, 9, 37, 2),
(30, 20, 10, 38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(300) NOT NULL,
  `category_id` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category_id`, `available`, `create_at`, `update_at`) VALUES
(1, 'Product1', 40, 'assets/images/products/7350702125.jpg', 1, 1, '2024-03-19 09:15:36', '2024-07-22 01:45:21'),
(2, 'Product2', 68, 'assets/images/products/9255638506.jpg', 5, 1, '2024-02-22 04:49:33', '2024-03-09 06:57:49'),
(3, 'Product3', 96, 'assets/images/products/2017533374.jpg', 5, 0, '2024-11-22 20:24:28', '2024-12-24 23:50:05'),
(4, 'Product4', 70, 'assets/images/products/4098095441.jpg', 4, 0, '2024-06-29 16:09:03', '2024-11-23 15:14:23'),
(5, 'Product5', 20, 'assets/images/products/6159017812.jpg', 5, 1, '2024-06-26 07:53:40', '2024-10-28 06:18:36'),
(6, 'Product6', 22, 'assets/images/products/6534499992.jpg', 1, 0, '2024-09-13 22:01:57', '2024-09-30 21:36:23'),
(7, 'Product7', 79, 'assets/images/products/3969098823.jpg', 3, 0, '2024-05-05 04:53:51', '2024-06-01 17:44:06'),
(8, 'Product8', 50, 'assets/images/products/2194546123.jpg', 4, 1, '2024-07-07 11:14:05', '2024-11-18 10:49:26'),
(9, 'Product9', 84, 'assets/images/products/4897442895.jpg', 4, 1, '2024-10-29 10:03:01', '2024-10-31 20:05:00'),
(10, 'Product10', 43, 'assets/images/products/8126265494.jpg', 2, 1, '2024-11-05 20:46:05', '2024-11-08 06:58:37'),
(11, 'Product11', 45, 'assets/images/products/5477695685.jpg', 5, 0, '2024-07-12 07:33:30', '2024-11-28 03:16:51'),
(12, 'Product12', 97, 'assets/images/products/5407317754.jpg', 3, 1, '2024-11-16 00:55:49', '2024-12-29 22:22:37'),
(13, 'Product13', 95, 'assets/images/products/8248504949.jpg', 1, 1, '2024-09-18 18:42:38', '2024-12-28 03:31:29'),
(14, 'Product14', 27, 'assets/images/products/5851965392.jpg', 1, 1, '2024-08-22 16:23:04', '2024-09-29 11:33:20'),
(15, 'Product15', 24, 'assets/images/products/6529623610.jpg', 1, 0, '2024-07-28 11:12:26', '2024-10-27 04:25:22'),
(16, 'Product16', 45, 'assets/images/products/3759954226.jpg', 5, 0, '2024-07-26 09:49:53', '2024-10-03 14:45:35'),
(17, 'Product17', 46, 'assets/images/products/6596474140.jpg', 5, 1, '2024-08-12 11:29:01', '2024-10-13 19:51:08'),
(18, 'Product18', 37, 'assets/images/products/4098667341.jpg', 3, 1, '2024-10-24 22:52:15', '2024-11-02 03:06:28'),
(19, 'Product19', 87, 'assets/images/products/1749993233.jpg', 5, 0, '2024-09-01 06:23:40', '2024-09-15 20:55:40'),
(20, 'Product20', 49, 'assets/images/products/5448348422.jpg', 2, 0, '2024-12-18 18:20:37', '2024-12-30 16:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(200) NOT NULL,
  `floor` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `floor`, `bed_number`) VALUES
(1, 'Room1', 3, 2),
(2, 'Room2', 5, 3),
(3, 'Room3', 4, 3),
(4, 'Room4', 3, 1),
(5, 'Room5', 3, 3),
(6, 'Room6', 3, 4),
(7, 'Room7', 4, 3),
(8, 'Room8', 3, 3),
(9, 'Room9', 2, 2),
(10, 'Room10', 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `room_booking`
--

CREATE TABLE `room_booking` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_booking`
--

INSERT INTO `room_booking` (`id`, `user_id`, `room_id`, `check_in`, `check_out`) VALUES
(1, 5, 9, '2024-11-12 00:26:34', '2024-12-20 23:35:36'),
(2, 7, 10, '2024-11-28 16:27:03', '2024-12-27 13:04:19'),
(3, 2, 1, '2024-11-27 05:34:39', '2024-12-27 03:12:19'),
(4, 4, 10, '2024-04-30 19:46:06', '2024-09-01 15:22:43'),
(5, 8, 9, '2024-10-04 09:44:38', '2024-11-23 02:45:55'),
(6, 10, 8, '2024-05-03 06:39:17', '2024-06-12 10:46:12'),
(7, 2, 5, '2024-09-25 17:35:54', '2024-12-25 07:45:32'),
(8, 6, 5, '2024-03-19 20:12:17', '2024-10-28 02:47:41'),
(9, 1, 4, '2024-10-15 15:11:18', '2024-10-19 02:12:23'),
(10, 4, 5, '2024-05-01 09:18:30', '2024-11-29 11:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `phone` varchar(11) NOT NULL,
  `image` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `phone`, `image`) VALUES
(1, 'User1', 'user1@example.com', '202cb962ac59075b964b07152d234b70', 'user', '01032112261', 'assets/images/upload/1736939325.jpg'),
(2, 'User2', 'user2@example.com', '202cb962ac59075b964b07152d234b70', 'admin', '01095021374', 'assets/images/upload/products1431898721.jpg'),
(3, 'User3', 'user3@example.com', '202cb962ac59075b964b07152d234b70', 'user', '01065816354', 'assets/images/upload/products7787950813.jpg'),
(4, 'User4', 'user4@example.com', '202cb962ac59075b964b07152d234b70', 'admin', '01056939319', 'assets/images/upload/products5690685833.jpg'),
(5, 'User5', 'user5@example.com', '202cb962ac59075b964b07152d234b70', 'user', '01022802212', 'assets/images/upload/products3386241932.jpg'),
(6, 'User6', 'user6@example.com', '202cb962ac59075b964b07152d234b70', 'admin', '01048964847', 'assets/images/upload/products6857355124.jpg'),
(7, 'User7', 'user7@example.com', '202cb962ac59075b964b07152d234b70', 'user', '01089916652', 'assets/images/upload/products9358896895.jpg'),
(8, 'User8', 'user8@example.com', '202cb962ac59075b964b07152d234b70', 'admin', '01055609173', 'assets/images/upload/products5722828204.jpg'),
(9, 'User9', 'user9@example.com', '202cb962ac59075b964b07152d234b70', 'user', '01044968564', 'assets/images/upload/products8660775096.jpg'),
(10, 'User10', 'user10@example.com', '202cb962ac59075b964b07152d234b70', 'admin', '01073232530', 'assets/images/upload/products6228140596.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `order_by` (`order_by`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_order` (`product_id`,`order_id`) USING BTREE,
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `room_booking`
--
ALTER TABLE `room_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`order_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `room_booking`
--
ALTER TABLE `room_booking`
  ADD CONSTRAINT `room_booking_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `room_booking_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
