-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2022 at 03:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `delivery_address` varchar(100) NOT NULL,
  `otp` int(11) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `email`, `address`, `birthday`, `valid_id`, `password`, `delivery_address`, `otp`, `status`) VALUES
(5, 'Aj', 'Atienza', 'Narag', 'ajnarag25', 'ajnarag25@gmail.com', 'blk 3 lot 8 meadow park subdivision, molino 4', '1999-08-25', 'uploads/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg', '$2y$10$mVW9ckzL3G8Xc0NcBg.y6OXC0IQCFAPbO86kjPwkY3d29TBw4v9GG', 'blk 3 lot 8 meadow park subdivision, molino 4', 2148, 'VERIFIED'),
(6, 'Cristopher', 'Merano', 'Castillo', 'castillo22', 'cristcastillo14@gmail.com', 'oriental mindoro', '1997-12-18', 'uploads/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg', '$2y$10$I.2J14vMEPzs/7CxG7P7tuLQf2yyHBA11Ybka1roZ93ynOWkMRqAe', 'oriental mindoro', 0, 'UNVERIFIED');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
