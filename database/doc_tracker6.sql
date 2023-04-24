-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2022 at 05:35 AM
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
-- Table structure for table `action_history_logs`
--

CREATE TABLE `action_history_logs` (
  `history_log_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `action_history_logs`
--

INSERT INTO `action_history_logs` (`history_log_id`, `usr_id`, `description`, `date_time`) VALUES
(5, 11, 'User <a href=\"javascript:;\" data-id=\"11\" class=\"view-profile\">12345</a> created Document <a href=\"javascript:;\" data-id=\"7\" class=\"view-type\">Type</a>', '2022-04-19 15:37:31'),
(6, 11, 'User <a href=\"javascript:;\" data-id=\"11\" class=\"view-profile\">12345</a> added <a href=\"javascript:;\" data-id=\"7\" class=\"view-office\">Office</a>', '2022-04-20 15:36:15'),
(7, 11, 'User <a href=\"javascript:;\" data-id=\"11\" class=\"view-profile\">12345</a> added <a href=\"javascript:;\" data-id=\"8\" class=\"view-office\">Office</a>', '2022-04-20 15:38:25'),
(8, 11, 'User <a href=\"javascript:;\" data-id=\"11\" class=\"view-profile\">12345</a> added <a href=\"javascript:;\" data-id=\"9\" class=\"view-office\">Office</a>', '2022-04-20 15:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `us_id` int(11) NOT NULL,
  `admin_role` enum('admin','superadmin') NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `us_id`, `admin_role`, `created_on`) VALUES
(1, 11, 'superadmin', '2022-04-14 16:48:17'),
(2, 13, 'admin', '2022-04-14 23:33:52'),
(3, 12, 'admin', '2022-04-18 10:17:45');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_id` int(11) NOT NULL,
  `tracking_number` varchar(150) NOT NULL,
  `u_id` int(11) NOT NULL,
  `offi_id` int(11) NOT NULL,
  `doc_type` int(11) NOT NULL,
  `qr_code` varchar(100) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_id`, `tracking_number`, `u_id`, `offi_id`, `doc_type`, `qr_code`, `created`) VALUES
(1, '500987727', 11, 3, 1, 'QR-1559432582.png', '2022-04-18 10:23:27'),
(2, '1291939210', 11, 3, 1, 'QR-1581740473.png', '2022-04-18 11:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`type_id`, `type_name`, `created`) VALUES
(1, 'CAFOA', '2022-04-11 03:11:59'),
(2, 'sample1', '2022-04-12 05:24:11'),
(7, 'DASDSA', '2022-04-19 15:37:31');

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
(1, 1, 0, 1),
(2, 1, 2, 2),
(3, 1, 1, 3),
(4, 2, 0, 1),
(5, 2, 3, 2),
(6, 2, 1, 3),
(7, 2, 1, 4),
(8, 3, 0, 1),
(9, 4, 0, 1),
(10, 5, 0, 1),
(11, 6, 0, 1),
(12, 7, 0, 1);

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
(1, 500987727, 1, 1, 11, 3, 11, 3, 'received', 1, '2022-04-18 10:23:28', 1, '2022-04-18 10:23:28', ''),
(2, 500987727, 2, 1, 11, 3, 13, 2, 'received', 1, '2022-04-18 10:26:16', 1, '2022-04-18 10:24:13', ''),
(3, 500987727, 3, 1, 13, 2, 12, 1, 'completed', 1, '2022-04-18 10:31:48', 0, '2022-04-18 10:31:48', ''),
(4, 1291939210, 1, 1, 11, 3, 11, 3, 'received', 1, '2022-04-18 11:32:16', 0, '2022-04-18 11:32:16', '');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `office_id` int(11) NOT NULL,
  `office` varchar(100) NOT NULL,
  `created` datetime NOT NULL,
  `stat` enum('inactive','active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`office_id`, `office`, `created`, `stat`) VALUES
(1, 'hey', '2022-04-06 07:52:52', 'active'),
(2, 'Assesor', '2022-04-06 07:54:50', 'active'),
(3, 'IT', '2022-04-06 07:55:03', 'active'),
(9, 'dsdsd', '2022-04-20 15:39:24', 'active');

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
  `profile_picture` varchar(100) DEFAULT NULL,
  `token` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `id_number`, `first_name`, `middle_name`, `last_name`, `extension`, `username`, `password`, `email_address`, `role`, `of_id`, `created`, `profile_picture`, `token`) VALUES
(11, '12345', 'basil', '', 'manabo', '', 'bass', '$2y$10$DMp/kCht5GFXhTtHtPc2WOAVGtAMVcVApjVYvE9ONP.AuLbOpV7Sa', 'manabobasil@gmail.com', '6 5 4', 3, '2022-04-08 02:50:14', NULL, 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6STFOaUo5LmV5SnBZWFFpT2pFMk5UQXpNelUyTnprc0ltbHpjeUk2SW1oMGRI'),
(12, '4331', 'hey', '', 'hey', '', 'hey', '$2y$10$9lkRA5urxxjUEe5M8DzJlubuY0orvgdQ8X4EJtO8xchfLHwYaeZT2', 'hey@gmail.com', '6 5 4', 1, '2022-04-08 08:23:25', NULL, ''),
(13, '123', 'assesor', '', 'assesor', '', 'assesor', '$2y$10$0a38ECFiyfTWM6qSiOQJaeLLZSUU.nVWcybeWK0j.d1t.bESbLPkS', 'assesor@gmail.com', '6 5 4', 2, '2022-04-08 09:30:52', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_history_logs`
--
ALTER TABLE `action_history_logs`
  ADD PRIMARY KEY (`history_log_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

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
-- AUTO_INCREMENT for table `action_history_logs`
--
ALTER TABLE `action_history_logs`
  MODIFY `history_log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `flow`
--
ALTER TABLE `flow`
  MODIFY `flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `office_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
