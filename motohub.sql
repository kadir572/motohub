-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2023 at 05:32 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `motohub`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(11) NOT NULL,
  `page` varchar(50) NOT NULL,
  `contentType` varchar(50) NOT NULL,
  `text` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motorcycle`
--

CREATE TABLE `motorcycle` (
  `id` int(11) NOT NULL,
  `make` varchar(30) NOT NULL,
  `model` varchar(30) NOT NULL,
  `year` smallint(6) NOT NULL,
  `imagePath` varchar(100) NOT NULL,
  `displacement` smallint(6) NOT NULL,
  `horsepower` varchar(10) NOT NULL,
  `peakHorsepowerRpm` smallint(6) NOT NULL,
  `torque` varchar(10) NOT NULL,
  `peakTorqueRpm` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motorcycle`
--

INSERT INTO `motorcycle` (`id`, `make`, `model`, `year`, `imagePath`, `displacement`, `horsepower`, `peakHorsepowerRpm`, `torque`, `peakTorqueRpm`) VALUES
(55, 'honda', 'cbr650r', 2023, 'assets/images/motorcycles/Honda_Cbr650r_image.jpg', 649, '95', 12000, '63', 9500),
(56, 'yamaha', 'yzf-r3', 2019, 'assets/images/motorcycles/Yamaha_Yzf-r3_image.jpg', 321, '42', 10750, '29.6', 9000),
(57, 'kawasaki', 'ninja 400', 2018, 'assets/images/motorcycles/Kawasaki_Ninja 400_image.webp', 399, '45', 10000, '37', 8000),
(58, 'aprilia', 'rs 660', 2020, 'assets/images/motorcycles/Aprilia_Rs 660_image.jpg', 659, '100', 10500, '67', 8500),
(59, 'yamaha', 'yzf-r7', 2022, 'assets/images/motorcycles/Yamaha_Yzf-r7_image.jpg', 689, '73.4', 8750, '67', 6500);

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `selector` text NOT NULL,
  `token` longtext NOT NULL,
  `expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`id`, `email`, `selector`, `token`, `expires`) VALUES
(9, 'user@gmail.com', '456ef570b0d4a8c8', '$2y$10$TptlAz5njJR.hcLZnx3KhedjHWBJ1fjhz24rso8ONN12D.r8wpgny', '1685748297');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash` varchar(60) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `hash`, `isAdmin`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$i6da.OE7S6291aInioDWw.IqM1TTpCbKtSYU2b96JQnlS.NocwgUq', 1),
(5, 'user', 'user@gmail.com', '$2y$10$aCaOIoj8atBfwVBcKr9Z0ufxZgZjLUbzQ1rdoFLD1iDRNrU3B7K46', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `motorcycle`
--
ALTER TABLE `motorcycle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motorcycle`
--
ALTER TABLE `motorcycle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
