-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2025 at 08:06 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grocery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `email` varchar(20) NOT NULL,
  `password` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`email`, `password`) VALUES
('sayeed2002@gmail.com', 4321),
('shaeidabu2@gmail.com', 321);

-- --------------------------------------------------------

--
-- Table structure for table `fruits_vegetables`
--

CREATE TABLE `fruits_vegetables` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fruits_vegetables`
--

INSERT INTO `fruits_vegetables` (`id`, `name`, `price`, `details`, `image`) VALUES
(1, 'Apple', 150, 'Juicy and sweet apples perfect for snacking and desserts.', 'images/apple1.png'),
(2, 'Green Chili', 60, 'Spicy and fresh chilies to add a kick to your dishes.', 'images/greenchilli.png'),
(3, 'Onion', 50, 'Fresh and flavorful onions, a kitchen essential.', 'images/onion.png'),
(4, 'Tomato', 60, 'Ripe and juicy tomatoes for your salads and sauces.', 'images/tomato.jpg'),
(5, 'Garlic', 120, 'Fresh garlic cloves to enhance the flavor of any dish.', 'images/garlic.jpg'),
(6, 'Carrot', 50, 'Crunchy and sweet carrots, perfect for snacking and cooking.', 'images/carrot.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `ID` int(11) NOT NULL,
  `Full_Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone_Number` varchar(15) NOT NULL,
  `Address` text NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`ID`, `Full_Name`, `Email`, `Phone_Number`, `Address`, `Password`) VALUES
(2, 'Md Shihab', 'shihab2002@gmail.com', '01741928573', 'Dhaka', '$2y$10$xP1RvoGSB0A1VWJFRR/4DOmV8ruobMPlGlsCG95B7gyZcjrdrATc2');

-- --------------------------------------------------------

--
-- Table structure for table `singup`
--

CREATE TABLE `singup` (
  `ID` int(11) NOT NULL,
  `Full_Name` varchar(20) NOT NULL,
  `Email` varchar(20) NOT NULL,
  `Phone_Number` int(11) NOT NULL,
  `Address` varchar(20) NOT NULL,
  `Password` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `snacks`
--

CREATE TABLE `snacks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `snacks`
--

INSERT INTO `snacks` (`id`, `name`, `price`, `details`) VALUES
(1, 'Cookies', '170.00', 'Delicious and crunchy treats for any time.\r\n'),
(2, 'Bread', '110.00', 'Soft and fresh, perfect for your breakfast.'),
(3, 'Chips', '15.00', 'Crunchy and flavorful snacks for all occasions.'),
(4, 'Juice', '20.00', 'Refreshing and natural beverages.'),
(5, 'Soda', '50.00', 'Fizzy and fun drinks to quench your thirst.'),
(6, 'Chocolates', '130.00', 'Rich and indulgent treats for sweet cravings.'),
(7, 'Max Cola', '25.00', 'Refreshing and natural beverages.');

-- --------------------------------------------------------

--
-- Table structure for table `snacks_drinks`
--

CREATE TABLE `snacks_drinks` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `snacks_drinks`
--

INSERT INTO `snacks_drinks` (`id`, `name`, `price`, `details`, `image`) VALUES
(1, 'Cookies', '170.00', 'Delicious and crunchy treats for any time.', 'images/cookies.png'),
(2, 'Bread', '110.00', 'Soft and fresh, perfect for your breakfast.', 'images/bread.png'),
(3, 'Chips', '15.00', 'Crunchy and flavorful snacks for all occasions.', 'images/chips.png'),
(4, 'Juice', '20.00', 'Refreshing and natural beverages.', 'images/juice.png'),
(5, 'Soda', '20.00', 'Fizzy and fun drinks to quench your thirst.', 'images/mojo.png'),
(6, 'Chocolates', '130.00', 'Rich and indulgent treats for sweet cravings.', 'images/chocolate.png');

-- --------------------------------------------------------

--
-- Table structure for table `spices`
--

CREATE TABLE `spices` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `details` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `spices`
--

INSERT INTO `spices` (`id`, `name`, `price`, `details`, `image`) VALUES
(1, 'Turmeric Powder (Holud)', '120.00', 'Aromatic and vibrant spice essential in Bangladeshi cuisine.', 'images/turmricpowder.png'),
(2, 'Red Chili Powder (Morich)', '160.00', 'Pure and fiery red chili powder to spice up your dishes.', 'images/redchilipowder.png'),
(3, 'Cumin Seeds (Jeera)', '160.00', 'Earthy and warm, perfect for curries and biryanis.', 'images/cumin.png'),
(4, 'Coriander Powder (Dhonia)', '80.00', 'Fragrant and mild, a must-have for any kitchen.', 'images/Coriander-Powder.png'),
(5, 'Mustard Seeds (Shorisha)', '360.00', 'Essential for traditional Bengali fish curries.', 'images/musteredseeds.png'),
(6, 'Cardamom (Elachi)', '220.00', 'Rich and aromatic, ideal for desserts and tea.', 'images/cardemon.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fruits_vegetables`
--
ALTER TABLE `fruits_vegetables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signup`
--
ALTER TABLE `signup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `singup`
--
ALTER TABLE `singup`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `snacks`
--
ALTER TABLE `snacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `snacks_drinks`
--
ALTER TABLE `snacks_drinks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spices`
--
ALTER TABLE `spices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fruits_vegetables`
--
ALTER TABLE `fruits_vegetables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `signup`
--
ALTER TABLE `signup`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `snacks`
--
ALTER TABLE `snacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `snacks_drinks`
--
ALTER TABLE `snacks_drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `spices`
--
ALTER TABLE `spices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
