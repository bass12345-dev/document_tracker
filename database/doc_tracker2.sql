-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 09:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `doc_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `tracking_number` varchar(150) NOT NULL,
  `u_id` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `qr_code` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `flow`
--

CREATE TABLE `flow` (
  `flow_id` int(11) NOT NULL,
  `d_type` int(11) NOT NULL,
  `off_id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flow`
--

INSERT INTO `flow` (`flow_id`, `d_type`, `off_id`, `number`) VALUES
(6, 2, 0, 1),
(7, 2, 1, 2),
(8, 2, 3, 3),
(9, 2, 2, 4),
(10, 3, 0, 1),
(11, 3, 1, 2),
(12, 3, 3, 3),
(13, 3, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `history_id` int(11) NOT NULL,
  `t_number` int(11) NOT NULL,
  `f_id` int(11) NOT NULL,
  `typ_id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `office1` int(11) NOT NULL,
  `user2` int(11) NOT NULL,
  `office2` int(11) NOT NULL,
  `status` set('to-receive','received','to-hold','hold','to-complete','completed') NOT NULL,
  `received_status` int(11) NOT NULL,
  `received_date` datetime NOT NULL,
  `release_status` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`history_id`, `t_number`, `f_id`, `typ_id`, `user1`, `office1`, `user2`, `office2`, `status`, `received_status`, `received_date`, `release_status`, `release_date`, `remarks`) VALUES
(1, 1796009272, 10, 3, 11, 3, 11, 3, 'received', 1, '2022-04-08 05:40:12', 1, '2022-04-08 05:40:12', ''),
(4, 1796009272, 11, 3, 11, 3, 12, 1, 'received', 1, '2022-04-08 09:25:07', 1, '0000-00-00 00:00:00', ''),
(5, 1796009272, 12, 3, 12, 1, 11, 3, 'received', 1, '2022-04-08 09:30:05', 1, '2022-04-08 09:29:50', ''),
(6, 1796009272, 13, 3, 11, 3, 13, 2, 'received', 1, '2022-04-08 09:32:51', 1, '2022-04-08 09:32:29', '');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `office` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `status` enum('inactive','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office`, `created`, `status`) VALUES
(1, 'hey', '2022-04-06 07:52:52', 'active'),
(2, 'Assesor', '2022-04-06 07:54:50', 'active'),
(3, 'IT', '2022-04-06 07:55:03', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role`, `created`) VALUES
(4, 'Maker', '2022-04-02 18:45:07'),
(5, 'Receiver', '2022-04-02 18:45:26'),
(6, 'Releaser', '2022-04-02 18:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `id_number` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `extension` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL,
  `of_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `profile_picture` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `id_number`, `first_name`, `middle_name`, `last_name`, `extension`, `username`, `password`, `email_address`, `role`, `of_id`, `created`, `profile_picture`) VALUES
(11, '12345', 'basil', '', 'manabo', '', 'bass', '$2y$10$DMp/kCht5GFXhTtHtPc2WOAVGtAMVcVApjVYvE9ONP.AuLbOpV7Sa', 'manabobasil@gmail.com', '6 5 4', 3, '2022-04-08 02:50:14', NULL),
(12, '4331', 'hey', '', 'hey', '', 'hey', '$2y$10$9lkRA5urxxjUEe5M8DzJlubuY0orvgdQ8X4EJtO8xchfLHwYaeZT2', 'hey@gmail.com', '6 5 4', 1, '2022-04-08 08:23:25', NULL),
(13, '123', 'assesor', '', 'assesor', '', 'assesor', '$2y$10$0a38ECFiyfTWM6qSiOQJaeLLZSUU.nVWcybeWK0j.d1t.bESbLPkS', 'assesor@gmail.com', '6 5 4', 2, '2022-04-08 09:30:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `flow`
--
ALTER TABLE `flow`
  ADD PRIMARY KEY (`flow_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`office_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flow`
--
ALTER TABLE `flow`
  MODIFY `flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
