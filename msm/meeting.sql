-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 19, 2024 at 08:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meeting`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `empid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `emppass` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`empid`, `name`, `gender`, `address`, `salary`, `emppass`) VALUES
(101, 'manu', 'male', 'kundapura', 40000.00, '1212'),
(102, 'putty', 'female', 'kundapura', 50000.00, '123'),
(103, 'bharath', 'male', 'koppa', 50000.00, '1234'),
(104, 'kavya', 'female', 'sagara', 50000.00, '5333'),
(105, 'anu', 'female', 'benglore', 50000.00, '3421'),
(106, 'divya', 'female', 'mandya', 54000.00, '4331'),
(107, 'praveen', 'male', 'maddur', 40000.00, '4212');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(20) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `pass`) VALUES
('admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `meetingid` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `meetingdate` date DEFAULT NULL,
  `meetingtime` time DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `rejection_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`meetingid`, `empid`, `title`, `description`, `meetingdate`, `meetingtime`, `status`, `rejection_reason`) VALUES
(1101, 101, 'project meeting', 'about assigned dbms  project', '2024-02-29', '11:00:00', 'accepted', NULL),
(1102, 102, 'CS meeting', 'a meeting about new cs association', '2024-11-19', '11:30:00', NULL, NULL),
(1104, 105, 'project meeting', 'about assigned dsa project', '2024-02-29', '11:00:00', 'rejected', 'not interested'),
(1105, 104, 'TL meeting', 'about delhi project', '2024-11-23', '02:00:00', NULL, NULL),
(1106, 106, 'devops meeting', 'about devops learning and project management', '2024-11-21', '03:00:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`meetingid`),
  ADD KEY `empid` (`empid`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meetings`
--
ALTER TABLE `meetings`
  ADD CONSTRAINT `meetings_ibfk_1` FOREIGN KEY (`empid`) REFERENCES `employee` (`empid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
