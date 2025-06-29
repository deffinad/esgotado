-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 05:19 PM
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
-- Database: `db_esgotado`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_category`
--

CREATE TABLE `t_category` (
  `id_category` int(11) NOT NULL,
  `code_sku` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_inbound`
--

CREATE TABLE `t_inbound` (
  `id_inbound` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `code_sku` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount_unit` int(11) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_inventory`
--

CREATE TABLE `t_inventory` (
  `code_sku` varchar(100) NOT NULL,
  `type_of_material` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_log`
--

CREATE TABLE `t_log` (
  `id_log` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_outbound`
--

CREATE TABLE `t_outbound` (
  `id_outbound` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `code_sku` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `amount_unit` int(11) NOT NULL,
  `serial_number` varchar(100) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`id_user`, `nama`, `email`, `password`, `level`, `phone`, `address`) VALUES
(1, 'Admin', 'admin@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Owner', '085721350359', 'Jl. Moch Yunus Gg. Siti Salsah No.7'),
(2, 'Haikal', 'haikal@gmail.com', 'c21b3ad4636fcc88a81c8154ff319be7936e63ae', 'Staff', '085721350359', 'Jl. Moch Yunus Gg. Siti Salsah No.7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `t_inbound`
--
ALTER TABLE `t_inbound`
  ADD PRIMARY KEY (`id_inbound`),
  ADD KEY `t_inbound_ibfk_2` (`code_sku`),
  ADD KEY `t_inbound_ibfk_4` (`id_user`);

--
-- Indexes for table `t_inventory`
--
ALTER TABLE `t_inventory`
  ADD PRIMARY KEY (`code_sku`);

--
-- Indexes for table `t_log`
--
ALTER TABLE `t_log`
  ADD PRIMARY KEY (`id_log`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `t_outbound`
--
ALTER TABLE `t_outbound`
  ADD PRIMARY KEY (`id_outbound`),
  ADD KEY `t_outbound_ibfk_2` (`code_sku`),
  ADD KEY `t_outbound_ibfk_4` (`id_user`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_inbound`
--
ALTER TABLE `t_inbound`
  MODIFY `id_inbound` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_log`
--
ALTER TABLE `t_log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_outbound`
--
ALTER TABLE `t_outbound`
  MODIFY `id_outbound` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_inbound`
--
ALTER TABLE `t_inbound`
  ADD CONSTRAINT `t_inbound_ibfk_1` FOREIGN KEY (`code_sku`) REFERENCES `t_inventory` (`code_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_inbound_ibfk_2` FOREIGN KEY (`code_sku`) REFERENCES `t_inventory` (`code_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_inbound_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_inbound_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_log`
--
ALTER TABLE `t_log`
  ADD CONSTRAINT `t_log_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`);

--
-- Constraints for table `t_outbound`
--
ALTER TABLE `t_outbound`
  ADD CONSTRAINT `t_outbound_ibfk_1` FOREIGN KEY (`code_sku`) REFERENCES `t_inventory` (`code_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_outbound_ibfk_2` FOREIGN KEY (`code_sku`) REFERENCES `t_inventory` (`code_sku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_outbound_ibfk_3` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_outbound_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `t_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
