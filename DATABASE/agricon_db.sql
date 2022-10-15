-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2022 at 05:14 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `variation` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `shop_name` varchar(100) DEFAULT NULL,
  `imagee` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `contact`, `variation`, `quantity`, `price`, `shop_name`, `imagee`) VALUES
(1, 1, 9564654, 'General Fertilizers', 5, 80, 'Krusty Krab', 'uploads/sample.jpg'),
(13, 1, 9564654, 'Pempem Machine', 5, 80, 'Pempem Enterprise', 'uploads/sample.jpg'),
(14, 1, 9564654, 'ss Machine', 5, 80, 'Pempem Enterprise', 'uploads/sample.jpg'),
(16, 2, 9564654, 'ss fbghfg', 10, 80, 'Pempem Enterprise', 'uploads/sample.jpg'),
(17, 1, 9564654, 'ss fbghfg', 5, 80, 'Pempem Enterprise', 'uploads/sample.jpg'),
(18, 4, 9564654, 'ss fbghfg', 2, 80, 'Pempem Enterprise', 'uploads/sample.jpg'),
(19, 4, 564654, 'tutoy machine', 2, 20, 'Jacool-It Company', 'uploads/sample.jpg'),
(20, 1, 564654, 'tutoy machine', 5, 20, 'Jacool-It Company', 'uploads/sample.jpg'),
(21, 2, 564654, 'tutoy machine', 10, 20, 'Jacool-It Company', 'uploads/sample.jpg'),
(22, 2, 564654, 'asdf machine', 10, 100, 'Jacool-It Company', 'uploads/sample.jpg'),
(23, 1, 564654, 'asdf machine', 5, 100, 'Jacool-It Company', 'uploads/sample.jpg'),
(24, 2, 65448, 'aasdfgdfhgh', 18, 100, 'Jacool-It Company', 'uploads/sample.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `products` varchar(500) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `address` varchar(300) NOT NULL,
  `birthday` text NOT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `firstname`, `middlename`, `lastname`, `address`, `birthday`, `email`) VALUES
(1, 'michael', 'suarez', 'rilan', 'bacoor', '10/02/1999', 'micorilan1999@gmail.com'),
(2, 'avor', 'atienza', 'narag', 'bacoor', '08/08/1969', 'avorbading@gmail.com'),
(3, 'dodong', 'b', 'bading', 'bacoor', '12/12/1965', 'fsdfs@gmail.com'),
(4, 'berting', 'c', 'kalamuga', 'tondo', '12/12/1945', 'fdasdfs@gmail.com'),
(5, 'neneng', 'd', 'yow', 'malate', '10/12/1985', 'fsgdfgs@gmail.com');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
