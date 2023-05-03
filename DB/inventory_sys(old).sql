-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2023 at 02:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'food'),
(2, 'Beverages'),
(3, 'Snacks'),
(4, 'Condiments');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category` varchar(111) NOT NULL,
  `name` varchar(111) NOT NULL,
  `quantity` varchar(25) NOT NULL,
  `buy_price` decimal(25,0) NOT NULL,
  `sale_price` decimal(25,0) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category`, `name`, `quantity`, `buy_price`, `sale_price`, `date`) VALUES
(18, 'food', 'tae', '2', '3', '4', '0000-00-00 00:00:00'),
(22, 'Snacks', 'Piattos', '4', '10', '4', '0000-00-00 00:00:00'),
(23, 'Condiments', 'Asin', '10', '15', '15', '0000-00-00 00:00:00'),
(24, 'Snacks', 'Nova', '12', '5', '10', '0000-00-00 00:00:00'),
(25, 'Beverages', 'Pepsi Pink', '1', '10', '20', '0000-00-00 00:00:00'),
(26, 'food', 'Proven', '20', '5', '10', '2023-03-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `name` varchar(115) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sales_made` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `name`, `product_id`, `quantity`, `sales_made`, `date`, `time`) VALUES
(40, '', 0, 3, 50.00, '2023-02-23', '00:00:22'),
(41, '', 0, 5, 36.00, '2023-02-23', '00:00:22'),
(42, '', 0, 3, 0.00, '2023-02-23', '00:00:22'),
(43, 'POS Sale', 0, 7, 78.00, '2023-02-23', '00:00:22'),
(44, 'POS Sale', 0, 5, 38.00, '2023-02-23', '00:00:22'),
(45, 'POS Sale', 0, 4, 32.00, '2023-02-27', '00:00:14'),
(46, 'POS Sale', 0, 3, 40.00, '2023-02-27', '00:00:14'),
(47, 'POS Sale', 0, 2, 30.00, '2023-02-27', '00:00:19'),
(48, 'POS Sale', 0, 1, 20.00, '2023-02-27', '00:00:19'),
(49, 'POS Sale', 0, 3, 40.00, '2023-02-27', '00:00:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(115) NOT NULL,
  `password` varchar(115) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `level`) VALUES
(1, 'superadmin', 'superadmin', 1),
(3, 'admin', 'admin', 2),
(4, 'user', 'user', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
