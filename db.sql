-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2020 at 05:27 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus-tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `driver` varchar(100) NOT NULL,
  `route_codename` varchar(50) NOT NULL,
  `seat_total` int(11) DEFAULT NULL,
  `plate_number` varchar(50) DEFAULT NULL,
  `is_full` tinyint(1) DEFAULT 0,
  `firebase_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`driver`, `route_codename`, `seat_total`, `plate_number`, `is_full`, `firebase_id`) VALUES
('john', 'T5', 100, 'SA84930', 0, '-Le0BoL4I4YA17Ir4D2L'),
('ahmad', 'T5', 100, 'ZAC8594', 0, '-Le0BsKqr3nmN9OYvxMg'),
('marvin', 'T3', 100, 'SA7779', 0, '-Le0ByNu6fHauQR_ELfb'),
('gillaleo', 'T5', 100, 'SAB7777', 0, '-Le0DlgZ9ttLYLk5RwjP'),
('gillaleo', 'T5', 100, 'XX8979', 0, '-Le5Jh5-3-8LNKPdjrQc'),
('7', 'T3', 55, '666', 0, '-M3Wz65vf8UoehGiT7jz');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `is_assign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `is_assign`) VALUES
(2, 'JOHN', 0),
(3, 'AHMAD', 0),
(4, 'MARVIN', 0),
(5, 'GILALEO', 0),
(6, 'ZULKARNAIN', 0),
(7, 'HAFIZ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `codename` varchar(50) NOT NULL,
  `route_array` text NOT NULL,
  `route_name` varchar(50) NOT NULL,
  `route_start` varchar(50) NOT NULL,
  `route_end` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`codename`, `route_array`, `route_name`, `route_start`, `route_end`) VALUES
('T3', '6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230,6.035872-116.116665,6.041379-116.123201,6.045237-116.128109,6.050041-116.133079,6.045205-116.130234,6.045163-116.128441,6.040422-116.124328', 'TESTING3', '6.033250,116.118115', '6.033450,116.113050'),
('T5', '6.0364908-116.1203991,6.033250-116.118115,6.032428-116.115643,6.033450-116.113050,6.035582-116.113230,6.035872-116.116665,6.041379-116.123201,6.045237-116.128109,6.050041-116.133079,6.045205-116.130234,6.045163-116.128441,6.040422-116.124328,6.042159-116.125114', 'TESTING5', '6.040422,116.124328', '6.042159,116.125114');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(0, 'admin', '$2y$12$uN88laQfjLiRKkXST/OHFesf8pxpl2uA0Fdubi9IfdXzg.q46OOCi');

-- --------------------------------------------------------

--
-- Table structure for table `waypoints`
--

CREATE TABLE `waypoints` (
  `id` int(11) NOT NULL,
  `stop_name` text NOT NULL,
  `stop_location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `waypoints`
--

INSERT INTO `waypoints` (`id`, `stop_name`, `stop_location`) VALUES
(4, 'FKJ', '6.0364908,116.1203991'),
(5, 'PPIB', '6.033250, 116.118115'),
(6, 'DEWAN RESITAL', '6.032428, 116.115643'),
(7, 'IPB', '6.033450, 116.113050'),
(8, 'IPMB', '6.035582, 116.113230'),
(9, 'CANSELORI', '6.035872, 116.116665'),
(10, 'CAFE', '6.041379, 116.123201'),
(11, 'DKP BARU', '6.045237, 116.128109'),
(12, 'FPSK', '6.050041, 116.133079'),
(13, 'PALAPES', '6.045205, 116.130234'),
(14, 'PADANG KAWAD', '6.045163, 116.128441'),
(15, 'TM', '6.040422, 116.124328'),
(16, 'TF', '6.042159, 116.125114');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waypoints`
--
ALTER TABLE `waypoints`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `waypoints`
--
ALTER TABLE `waypoints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
