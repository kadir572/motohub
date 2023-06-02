-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2023 at 01:50 AM
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
  `imageUrl` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motorcycle`
--

INSERT INTO `motorcycle` (`id`, `make`, `model`, `imageUrl`) VALUES
(2, 'Yamaha', 'Yzf-r3', 'Https://www.moto-data.net/media/yamaha/pics/yamaha-yzf-r3-2023[1].jpg'),
(3, 'Honda', 'Cbr650r', 'Https://www.de.honda.ch/content/dam/central/motorcycles/supersports/cbr650r_2023/360-view/Matte_Gunpowder_black_metallic/angle001-0x3.5x10.png/jcr:content/renditions/fb_r.png'),
(6, 'Aprilia', 'Rs660', 'https://www.moto-data.net/media/aprilia/pics/aprilia-rs-660-2021[1].jpg'),
(9, 'Kawasaki', 'Ninja 400', 'https://storage.kawasaki.eu/public/kawasaki.eu/en-EU/model/23MY_Ninja_400_GN1_STU__2_.png'),
(10, 'Ducati', 'Diavel', 'https://images5.1000ps.net/b-f_W3005023-ducati-diavel-1260-2019-636769593774289817.jpg');

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
(8, 'user@gmail.com', '616d4896647d2475', '$2y$10$FiDTaFrDDgNG94a/JH6zLOqpB00CPduvEfTIoZMSGaV6G1aAFzqoq', '1684240085');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
