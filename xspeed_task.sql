-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 11:50 PM
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
-- Database: `xspeed_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `simple_table`
--

CREATE TABLE `simple_table` (
  `id` bigint(20) NOT NULL,
  `amount` int(10) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) DEFAULT NULL,
  `note` text CHARACTER SET utf8 NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `entry_at` date DEFAULT NULL,
  `entry_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `simple_table`
--

INSERT INTO `simple_table` (`id`, `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `entry_at`, `entry_by`) VALUES
(22, 4554, '32434', 'hhh', 'hhh', 'ifat@gmail.com', '::1', '  ', 'hhh', '01869017089', '2022-08-18', 1),
(48, 3244, 'dsafd', 'erwer', 'erwer', 'mira@gmail.com', '::1', ' Google     ', 'were', '01763277700', '2022-08-20', 1),
(52, 1000, 'Ariful', 'recopod', 'onem', 'manik@mon.con', '::1', 'Mon toke boli jtoto', 'dhaka', '01763274899', '2022-08-20', 1),
(57, 7897, 'bbbb', 'cccc', 'iiii', 'kala@vala.com', '::1', 'dfadsfasd', 'ddd', '01789014702', '2022-08-20', 2),
(58, 4554, 'erweew', 'werwe', 'werwe', 'd@gmail.com', '::1', 'werwer werewsd', 'sx', '01776995888', '2022-08-20', 1),
(59, 4554, 'pppp', 'ooiii', 'oooo', 'mar@gmail.com', '::1', '55444', 'iii', '01869017089', '2022-08-20', 2),
(60, 78899, 'dfas 342', 'dsfas', 'adsf', 'y@me.com', '::1', 'sf', 'dsfas', '01869017089', '2022-08-21', 1),
(61, 32432342, 'gfdgffd', 'erewerre', 'cvzcv', 'ifat@gmail.com', '::1', 'gdfsdfsg', 'erwer', '01869017089', '2022-08-21', 1),
(62, 4234, 'dfad', 'dasfd', 'dafd', 'ifat@g.com', '::1', 'আমি বাংলা লিখে টেস্ট করলাম ', 'sdasd', '01869017089', '2022-08-21', 1),
(63, 4554, 'dfas', 'dsafsd', 'oo', 'ifat@gmail.com', '::1', 'দ্বাদশ ডিসফেদ ডিসফ ', 'sdfsd', '01869017089', '2022-08-21', 3),
(64, 4554, 'dfas safd ', 'wrqer', 'rerretw', 'ifat@gmail.com', '::1', 'asfasfd', 'dsafdf', '01869017089', '2022-08-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(128) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `data-status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `data-status`) VALUES
(1, 'Ifat', '12345', '2022-08-19', 1),
(2, 'Azhar', '12345', '2022-08-19', 1),
(3, 'Manik', 'ewrwer', '2022-08-19', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `simple_table`
--
ALTER TABLE `simple_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `simple_table`
--
ALTER TABLE `simple_table`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
