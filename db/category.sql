-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mariaDB
-- Generation Time: Jun 29, 2022 at 08:55 AM
-- Server version: 10.7.3-MariaDB-1:10.7.3+maria~focal
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soc`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category_type` varchar(255) NOT NULL COMMENT 'ประเภทข้อมูล',
  `name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_type`, `name`, `title`) VALUES
(1, '1', 'นักศึกษา', 'นักศึกษา'),
(2, '1', 'บุคลากร', 'บุคลากร'),
(3, '1', 'ภายนอก', 'ภายนอก'),
(4, '2', 'ติดตามตรวจสอบ ยานพาหนะ', 'ติดตามตรวจสอบ ยานพาหนะ'),
(5, '2', 'ติดตามตรวจสอบ เหตุการณ์', 'ติดตามตรวจสอบ เหตุการณ์'),
(6, '2', 'โจรกรรมทรัพย์สิน', 'โจรกรรมทรัพย์สิน'),
(7, '2', 'อื่นๆ', 'อื่นๆ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
