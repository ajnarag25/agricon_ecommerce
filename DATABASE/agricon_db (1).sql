-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2022 at 06:23 PM
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
-- Database: `agricon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `valid_id` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `delivery_address` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `address`, `birthday`, `valid_id`, `password`, `type`, `delivery_address`, `otp`, `status`) VALUES
(1, 'Aj', 'Atienza', 'Narag', 'ajnarag25', 'ajnarag25@gmail.com', 'blk 3 lot 8 meadow park subdivision, molino 4', '1999-08-25', 'uploads/6525a08f1df98a2e3a545fe2ace4be47.jpg', '$2y$10$kf0bW8KhMxYPeFMpaGv9B./VdqRG4Zeka3OS5lvhtbmtkWzkcahl6', 'SELLER', 'blk 3 lot 8 meadow park subdivision, molino 4', 0, 'VERIFIED'),
(2, 'Mark Zelon', 'Atienza', 'Narag', 'markzelon25', 'markzelon@gmail.com', 'blk 3 lot 8 meadow park subdivision, molino 4', '2008-09-25', 'uploads/6525a08f1df98a2e3a545fe2ace4be47.jpg', '$2y$10$zfKLnQJaFbrKZ1Y7HNjQgedzmCAM9r3bu7i8OtaE2rPRK7V7E6vxm', 'USER', 'blk 3 lot 8 meadow park subdivision, molino 4', 0, 'DENIED'),
(4, 'Vinix Matthew', 'Atienza', 'Narag', 'vinix11', 'vinix@gmail.com', 'blk 3 lot 8 meadow park subdivision, molino 4', '2000-12-11', 'uploads/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg', '$2y$10$wHcw4U18HlEocyf5oIL7w.L7KGjo6wz/OStp2ik.sAiz3u.RGnkF.', 'SELLER', 'blk 3 lot 8 meadow park subdivision, molino 4', 0, 'VERIFIED'),
(5, 'Michael', 'Suarez', 'Rilan', 'micorilan1999@gmail.com', 'micorilan1999@gmail.com', 'bacoor', '1999-10-02', 'uploads/profile.PNG', '$2y$10$dq2fAVKD5u8saLasica9fe8iG.X6uexdKgGXmQGiHlTd7PfkhEFwm', 'USER', 'bacoor din malamang', 0, 'VERIFIED'),
(6, 'Pedro', 'Kalamuga', 'Penduko', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'bacoor din malamang', '1999-10-02', 'uploads/profile.PNG', '$2y$10$.wGX3/hnZXYqeENUe7GXgu8gDbxjIRhfWZ1ZdiUNMbq6BmA3p5APq', 'SELLER', 'bacoor din malamang', 0, 'VERIFIED');

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `about` text NOT NULL,
  `otp` int(11) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `about`, `otp`, `email`) VALUES
(1, 'administrator', 'admin123', 'AgriCon Mart is the first and only e-commerce platform exclusively in Oriental Mindoro.Launched in 2022, \r\n\r\nit is a platform specialized for the province, abling the customers enjoy an easy, fast, \r\n\r\nand secured online purchasing of agricultural and construction or hardware products.\r\n\r\nAgriCon Mart believes that those types of products should be easily accessible. \r\n\r\nThis is the vision we aspire to deliver and the Mindoreños deserve.\r\n', 0, 'cristcastillo14@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `imagee` varchar(300) NOT NULL,
  `shop_name` varchar(200) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `product_name` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `imagee`, `shop_name`, `contact`, `price`, `quantity`, `email`, `product_name`, `user_id`, `product_id`) VALUES
(12, 'uploads/310097646_1195219574363668_3037091966571760648_n.jpg', 'dasfddf', '609694651', 12, 2, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'gsdfgd', 5, 1),
(13, 'uploads/297950858_412643754179161_2094280779286556854_n.jpg', 'dasfddf', '609694651', 1, 1, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'fasdfsd', 5, 3),
(14, 'uploads/Capture.PNG', 'fsdfasdf', '452343', 69, 5, 'ajnarag25@gmail.com', 'asdf', 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `imagee` varchar(200) NOT NULL,
  `shop_name` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `total` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `imagee`, `shop_name`, `contact`, `price`, `quantity`, `email`, `product_name`, `user_id`, `status`, `total`, `product_id`) VALUES
(12, 'uploads/310097646_1195219574363668_3037091966571760648_n.jpg', 'dasfddf', '609694651', 12, 4, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'gsdfgd', 5, 'TO RECEIVE', 48, 1),
(13, 'uploads/297950858_412643754179161_2094280779286556854_n.jpg', 'dasfddf', '609694651', 456, 3, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'nvbnxcvb', 5, 'REJECT', 1368, 2),
(14, 'uploads/Capture.PNG', 'dasfddf', '609694651', 69, 5, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'asdf', 5, 'REJECT', 345, 4),
(15, 'uploads/297950858_412643754179161_2094280779286556854_n.jpg', 'dasfddf', '609694651', 1, 2, 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'fasdfsd', 5, 'TO RECEIVE', 2, 3),
(16, 'uploads/Capture.PNG', 'fsdfasdf', '452343', 69, 6, 'ajnarag25@gmail.com', 'asdf', 6, 'REJECT', 345, 4);

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `shop` varchar(100) NOT NULL,
  `header` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feed`
--

INSERT INTO `feed` (`id`, `image`, `shop`, `header`, `description`) VALUES
(5, 'uploads/310524002_784284989494522_5269852136763519512_n.jpg', 'dasfddf', 'fasdf', 'sdfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `details` text NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product`, `image`, `price`, `stock`, `details`, `email`) VALUES
(1, 'gsdfgd', 'uploads/310097646_1195219574363668_3037091966571760648_n.jpg', 12, 0, 'hfghfgh', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph'),
(2, 'nvbnxcvb', 'uploads/297950858_412643754179161_2094280779286556854_n.jpg', 456, 34, 'fasdfasdf', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph'),
(3, 'fasdfsd', 'uploads/297950858_412643754179161_2094280779286556854_n.jpg', 1, 421, 'fdsfsdsa', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph'),
(4, 'asdf', 'uploads/Capture.PNG', 69, 100000, 'Kapag ininom mo toh titigas ang dapat tumigas ', 'ajnarag25@gmail.com'),
(5, 'azxc', 'uploads/WIN_20221019_00_53_42_Pro.jpg', 2, 1234, 'fasdfasdf', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph'),
(6, 'fsadf', 'uploads/WIN_20221019_00_53_42_Pro.jpg', 5, 3, 'fasdfsdf', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph');

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `details` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `owner`, `address`, `email`, `image`, `name`, `contact`, `details`) VALUES
(1, 'Pedro Kalamuga Penduko', 'bacoor din malamang', 'michaelangelo.rilan@gsfe.tupcavite.edu.ph', 'uploads/310524002_784284989494522_5269852136763519512_n.jpg', 'dasfddf', '609694651', 'fsdfsdaf'),
(2, 'avor', 'bacoor', 'ajnarag25@gmail.com', 'uploads/310524002_784284989494522_5269852136763519512_n.jpg', 'fsdfasdf', '452343', 'sadfsadf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
