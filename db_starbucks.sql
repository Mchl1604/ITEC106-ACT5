-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2026 at 03:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_starbucks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE `tbl_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_messages`
--

INSERT INTO `tbl_messages` (`id`, `name`, `email`, `message`) VALUES
(1, 'michael', 'micha@gmail', '1234556'),
(2, 'michael', 'micha@gmail', '1234556'),
(3, 'michael', 'michaelcapanayan@gmail.com', '123qweasd');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','staff','user') NOT NULL DEFAULT 'user',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `fullname`, `email`, `password`, `created_at`, `role`, `status`) VALUES
(1, 'Michael Capanayan', 'michaelcapanayan@gmail.com', '$2y$10$3RVWjU3uiP8.k5l1oypAv.6HMspQt0gg6FFc1iwk42QTAOjahHyC.', '2026-03-03 13:11:05', 'admin', 'Active'),
(7, 'Gerald Apuntar', 'sample2@gmail.com', '$2y$10$jRdnkS2pJgXd.PgoUPg/Nu4xbwCMCh8C2/cKRZmdENiCRnYI8NEe2', '2026-03-03 13:35:59', 'user', 'Active'),
(9, 'Mikaela Maalat', 'mika@gmail.com', '$2y$10$HmjofHjuELAUKF1E9U2d5eQOQTwAEmG5naXisgbvJQQCTC8e1OG4W', '2026-03-04 00:20:10', 'user', 'Active'),
(11, 'james Mangalindad', 'james@gmail.com', '', '2026-03-04 06:47:30', 'staff', 'Active'),
(12, 'Mikku Xen', 'mikku@gmail.com', '', '2026-03-04 06:48:09', 'staff', 'Active'),
(13, 'Symon Apilado', 'Symon@gmail.com', '', '2026-03-04 13:21:51', 'staff', 'Active'),
(14, 'Gladys Rebato', 'gladys@gmail.com', '', '2026-03-04 13:22:52', 'admin', 'Active'),
(16, 'ambo', 'ambo@gmail.com', '$2y$10$ThSHiuFxKjSiOSDaorBz9e2z3zqgnOfZKfaIm5zN2nA/uFt91LnBu', '2026-03-04 14:05:18', 'user', 'Active'),
(17, 'mika', 'mikas@gmail.com', '$2y$10$wkAE7521uh/LbhxMmxlsxOn1f4AOGC6yfEF20weXhvxfoOcEy3O3a', '2026-03-04 14:07:36', 'user', 'Active'),
(18, 'bert', 'bert@gmail.com', '$2y$10$5q0TkX29bhr2LXF0L7OzXOzuVNLJu3KmsrQRB5IqpHOTa3SG5bDda', '2026-03-04 14:09:58', 'user', 'Active'),
(19, 'aram', 'aram@gmail.co', '$2y$10$wkECKaoAeewF4gcnN8xjCOX4NuJwO1rT8HOA7ZFraIN7JgIkcwwd6', '2026-03-04 14:12:03', 'user', 'Active'),
(20, 'Analyn Penamora', 'analyn@gmail.com', '', '2026-03-08 02:29:50', 'staff', 'Active'),
(21, 'Mary Thesa Datoon', 'mary@gmail.com', '', '2026-03-08 02:30:49', 'staff', 'Active'),
(22, 'Loren Corro', 'loren@gmail.com', '', '2026-03-08 02:34:19', 'staff', 'Active'),
(23, 'Mark Vincent Capanayan', 'mark@gmail.com', '', '2026-03-11 00:29:34', 'staff', 'Active'),
(24, 'Rosemarie Capanayan', 'rose@gmail.com', '', '2026-03-11 00:30:43', 'staff', 'Active'),
(25, 'Vicente P. Capanayan', 'vicente@gmail.com', '', '2026-03-11 00:31:18', 'staff', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UK_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_messages`
--
ALTER TABLE `tbl_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
