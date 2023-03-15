-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 06:45 PM
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
-- Database: `queuing_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `username`, `password`) VALUES
(1, 'admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `availability` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`ID`, `name`, `image`, `availability`) VALUES
(4, 'Library', '', 'unavailable'),
(5, 'Guidance', '', 'unavailable'),
(13, 'Accounting', '', 'unavailable'),
(15, 'Registrar', '', 'unavailable'),
(16, 'Treasurer', '', 'unavailable'),
(25, 'Alumni', 'none', 'available'),
(26, 'SBO', 'none', 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `priority_queue`
--

CREATE TABLE `priority_queue` (
  `ID` int(11) NOT NULL,
  `date_of_transaction` date NOT NULL,
  `number` int(11) NOT NULL,
  `office` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `priority_queue`
--

INSERT INTO `priority_queue` (`ID`, `date_of_transaction`, `number`, `office`, `status`) VALUES
(141, '2023-01-07', 1, 5, 'Served'),
(142, '2023-01-07', 1, 4, 'Served'),
(145, '2023-01-07', 1, 16, 'Served'),
(146, '2023-01-07', 1, 15, 'Served'),
(147, '2023-01-07', 1, 13, 'Served'),
(148, '2023-01-07', 2, 5, 'Served'),
(149, '2023-01-18', 1, 4, 'Served'),
(150, '2023-01-18', 1, 5, 'Served'),
(151, '2023-01-18', 2, 5, 'Served'),
(152, '2023-01-18', 3, 5, 'Served'),
(153, '2023-01-18', 2, 4, 'Served'),
(154, '2023-01-18', 3, 4, 'Served'),
(155, '2023-01-18', 4, 4, 'Served'),
(156, '2023-01-18', 5, 4, 'Served'),
(157, '2023-01-18', 6, 4, 'Served'),
(158, '2023-01-18', 7, 4, 'Served'),
(159, '2023-01-18', 8, 4, 'Served'),
(160, '2023-01-18', 9, 4, 'Served'),
(161, '2023-01-18', 10, 4, 'Served'),
(162, '2023-01-18', 11, 4, 'Served');

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `ID` int(11) NOT NULL,
  `date_of_transaction` date NOT NULL DEFAULT current_timestamp(),
  `number` int(11) NOT NULL,
  `office` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`ID`, `date_of_transaction`, `number`, `office`, `status`) VALUES
(295, '2023-01-07', 1, 5, 'Served'),
(296, '2023-01-07', 1, 4, 'Served'),
(299, '2023-01-07', 1, 16, 'Served'),
(300, '2023-01-07', 1, 15, 'Served'),
(301, '2023-01-07', 1, 13, 'Served'),
(302, '2023-01-07', 2, 5, 'Served'),
(303, '2023-01-18', 1, 4, 'Served'),
(304, '2023-01-18', 2, 4, 'Served'),
(305, '2023-01-18', 1, 5, 'Served'),
(306, '2023-01-18', 2, 5, 'Served'),
(307, '2023-01-18', 3, 5, 'Served'),
(308, '2023-01-18', 4, 5, 'Served'),
(309, '2023-01-18', 5, 5, 'Served'),
(310, '2023-01-18', 3, 4, 'Served'),
(311, '2023-01-18', 4, 4, 'Served'),
(312, '2023-01-18', 5, 4, 'Served'),
(313, '2023-01-18', 6, 4, 'Served'),
(314, '2023-01-18', 7, 4, 'Served'),
(315, '2023-01-18', 8, 4, 'Served'),
(316, '2023-01-18', 9, 4, 'Served'),
(317, '2023-01-18', 10, 4, 'Served'),
(318, '2023-01-18', 11, 4, 'Served'),
(319, '2023-01-18', 12, 4, 'Served'),
(320, '2023-01-18', 13, 4, 'Served'),
(321, '2023-01-18', 14, 4, 'Served'),
(322, '2023-01-18', 15, 4, 'Served'),
(323, '2023-01-18', 16, 4, 'Served'),
(324, '2023-01-18', 17, 4, 'Served'),
(325, '2023-01-18', 18, 4, 'Served'),
(326, '2023-01-18', 19, 4, 'Served'),
(327, '2023-01-18', 20, 4, 'Served'),
(328, '2023-01-18', 21, 4, 'Served'),
(329, '2023-01-18', 22, 4, 'Served'),
(330, '2023-01-18', 23, 4, 'Served'),
(331, '2023-01-18', 24, 4, 'Served'),
(332, '2023-01-18', 25, 4, 'Served');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `ID` int(11) NOT NULL,
  `admin_ID` int(11) NOT NULL,
  `timeout` int(11) NOT NULL,
  `days_before_reschedule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_history`
--

CREATE TABLE `transaction_history` (
  `ID` int(11) NOT NULL,
  `office` int(11) NOT NULL,
  `time_served` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `office` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `username`, `password`, `type`, `office`, `name`) VALUES
(1, 'Library', '12345', 'staff', 4, 'Library'),
(2, 'Accounting', '123', 'staff', 13, 'Accounting'),
(3, 'Registrar', '123', 'staff', 15, 'Registrar'),
(4, 'Guidance', '123', 'staff', 5, 'Guidance'),
(5, 'Treasurer', '123', 'staff', 16, 'Treasurer'),
(12, 'Alumni', 'none', 'staff', 25, 'Alumni'),
(13, 'SBO', 'none', 'staff', 26, 'SBO');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `priority_queue`
--
ALTER TABLE `priority_queue`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `office` (`office`);

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `office` (`office`);

--
-- Indexes for table `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `priority_queue`
--
ALTER TABLE `priority_queue`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT for table `queue`
--
ALTER TABLE `queue`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT for table `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
