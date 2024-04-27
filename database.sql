-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 23, 2024 at 05:48 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id22040941_foodmatic`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodations`
--

CREATE TABLE `accommodations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accommodations`
--

INSERT INTO `accommodations` (`id`, `user_id`, `name`, `address`, `contact_email`, `contact_number`, `image`) VALUES
(2, 5, 'Block A', NULL, NULL, NULL, 'Accomodation.jpg'),
(3, 2, 'Block B', NULL, NULL, NULL, 'Accomodation_2.jpg'),
(4, 2, 'Block C', NULL, NULL, NULL, 'Accomodation_3.jpg'),
(5, 2, 'Block D', NULL, NULL, NULL, 'Accomodation_4.jpg'),
(6, 2, 'Block E', NULL, NULL, NULL, 'Accomodation_5.jpg'),
(7, 2, 'Block F', NULL, NULL, NULL, 'Accomodation_6.jpg'),
(8, 2, 'Block H', NULL, NULL, NULL, 'Accomodation_8.jpg'),
(9, 2, 'Block I', NULL, NULL, NULL, 'Accomodation_9.jpg'),
(10, 2, 'Block J', NULL, NULL, NULL, 'Accomodation_10.jpg'),
(11, 2, 'Block G', NULL, NULL, NULL, 'Hostel_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `taste` int(11) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `service_speed` int(11) DEFAULT NULL,
  `crew_friendliness` int(11) DEFAULT NULL,
  `order_accuracy` int(11) DEFAULT NULL,
  `cleanliness` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `taste`, `temperature`, `service_speed`, `crew_friendliness`, `order_accuracy`, `cleanliness`) VALUES
(1, 5, 4, 3, 2, 1, 1),
(2, 5, 4, 4, 4, 5, 4),
(3, 5, 4, 5, 4, 4, 5),
(4, 5, 3, 4, 5, 4, 5),
(5, 5, 3, 5, 4, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `accommodation_id` int(11) DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `item_img` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `desc` longtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `accommodation_id`, `item`, `price`, `item_img`, `quantity`, `desc`, `user_id`) VALUES
(14, 2, 'Ackee and saltfish ', 20, 'Ackee_and_Saltfish.jpg', 5, 'Dive into the heart of Jamaican cuisine with Ackee and Saltfish, the national dish that symbolizes the island\'s rich culture and culinary diversity. This beloved meal pairs the unique, buttery ackee fruit with savory salted cod, creating a harmonious blend of flavors that\'s both comforting and exotic. SautÃ©ed with onions, scotch bonnet peppers, and tomatoes, it\'s a vibrant dish that\'s as colorful as it is delicious.', 2),
(15, 2, 'Cornish Pasty', 30, 'Cornish_pasty.jpg', 94, 'The Cornish Pasty, a staple from Cornwall, England, is a savory hand-held pie filled with beef, potatoes, swede, and onions, wrapped in a D-shaped short crust pastry. This hearty meal has become a beloved symbol of Cornish heritage, enjoyed nationwide for its delicious filling and flaky pastry.', 2),
(16, 2, 'Pakoras', 50, 'Pakora.jpg', 25, 'Pakora is a beloved fried snack from the Indian subcontinent, featuring vegetables, meat, or fish coated in a spiced gram flour batter and deep-fried until golden and crispy. Pakoras are a favorite at gatherings for their crunchy texture and flavorful bite. They are especially enjoyed during rainy and cold seasons, offering a warm and comforting treat.', 2),
(17, 2, 'Dhokla', 10, 'Dhokla.jpg', 100, 'Dhokla is a light and spongy vegetarian snack from Gujarat, India, made from fermented rice and chickpea flour batter. It\'s steamed, then seasoned with mustard seeds, green chilies, and curry leaves, and often garnished with coconut and coriander.', 2),
(18, 2, 'Dim Sum', 45, 'Dim_Sum.jpg', 100, 'Indulge in the exquisite tradition of Dim Sum, the heart of Cantonese cuisine, offering an array of bite-sized delights that promise to tantalize your taste buds. From succulent dumplings to fluffy buns and savory pastries, each piece is a masterpiece of flavor, meticulously prepared to offer a unique dining experience.', 2),
(19, 2, 'Chow Mein', 25, 'Chow_Mein.jpg', 100, 'Dive into the rich flavors of Chow Mein, a cornerstone of Chinese cuisine known for its delightful mix of stir-fried noodles, crisp vegetables, and your choice of protein, all tossed in a savory sauce.', 2),
(20, 2, 'Fish and chips', 15, 'Fish_and_chips.jpg', 100, 'Experience the iconic Fish and Chips, a beloved British dish that\'s become a worldwide favorite. Savor the perfect harmony of crispy, golden-battered fish paired with hot, fluffy chips, creating a comforting, and satisfying meal.', 2),
(21, 2, 'Chicken Biryani', 10, 'Chicken_biryani.jpg', 99, 'Embark on a culinary journey with Chicken Biryani, a majestic dish that marries fragrant basmati rice with spiced, tender chicken, all layered with caramelized onions, fresh herbs, and saffron.', 2),
(22, 2, 'Sushi', 45, 'Sushi.jpg', 100, 'Dive into the delicate art of Sushi, a cornerstone of Japanese culinary tradition renowned for its simple elegance and fresh flavors. This exquisite dish features perfectly seasoned sushi rice paired with a variety of toppings, including fresh fish, seafood, and vegetables, meticulously crafted into bite-sized pieces.', 2),
(25, 3, 'Biscuit', 200, '', 98, 'Biscuits', 2),
(26, 6, 'Kiwi', 50, '', 500, 'Kiwi', 2),
(27, 3, 'Fish and Chips', 15, '', 80, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `address`, `phone`, `payment_method`, `order_date`) VALUES
(1, 4, 'Jayme Rosales', 'pytytit@mailinator.com', 'Id voluptas in volup', '+1 (584) 466-8026', 'cash', '2024-04-21 09:34:13'),
(2, 4, 'Lucia', 'lbgf@ggf.com', '45', 'Gfdrt', 'card', '2024-04-23 11:15:26'),
(3, 4, 'aa', 'abc@gmail.com', 'aaa', '000000000', 'card', '2024-04-23 12:55:55'),
(4, 4, 'tamoor', 'idk@gmail.com', 'lsbu', '123', 'card', '2024-04-23 13:30:09'),
(5, 4, 'tamoor', 'tamoor@idk', 'lsbu', '133456464', 'card', '2024-04-23 15:12:27'),
(6, 4, 'tamoor', 'tamoor@123', 'lsbu', '12345', 'card', '2024-04-23 15:43:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 21, 1, 10.00),
(2, 2, 15, 2, 30.00),
(3, 3, 14, 1, 20.00),
(4, 4, 14, 1, 20.00),
(5, 5, 14, 1, 20.00),
(6, 6, 14, 1, 20.00);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `reserved_items` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `reserved_items`, `created_at`) VALUES
(1, 4, 'a:1:{i:14;s:1:\"1\";}', '2024-04-21 13:40:21'),
(2, 4, 'a:1:{i:14;s:1:\"1\";}', '2024-04-22 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` enum('manager','staff','student','admin') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'manager', '$2y$10$sLIWGu9Ldd3BSuYMJXA.cu1LxGutsTQnvAa3kx2iS8LDdLdcLC1Bm', 'manager'),
(3, 'staff', '$2y$10$hb6YqcCYJd2j5U8YsDBDJu8D84K.A6G1otpdk9kEHP/9yvtSnxm4e', 'staff'),
(4, 'student', '$2y$10$QJKHu8AKiLbtiqpDILXIjuuDknfLOo/wXCyQZZ.gd.MUN7zXBixsi', 'student'),
(5, 'admin', '$2y$10$O34xdQ0MDru2ghyhybXbwuSsaRVXJASNU3vA/B6.LKg5kIuXF0qJG', 'admin'),
(6, 'test', '$2y$10$kEAT9qw.qkem6XEOTXSLJOFzI6rXUZYveuxfQBPowvAxam1ymRE8G', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodations`
--
ALTER TABLE `accommodations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodations`
--
ALTER TABLE `accommodations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `inventory` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
