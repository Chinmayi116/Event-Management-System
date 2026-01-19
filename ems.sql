-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2023-05-21 13:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `tblbookings`
--

CREATE TABLE `tblbookings` (
  `id` int(11) NOT NULL,
  `BookingId` bigint(12) DEFAULT NULL,
  `UserId` int(11) DEFAULT NULL,
  `EventId` int(11) DEFAULT NULL,
  `NumberOfMembers` int(11) DEFAULT NULL,
  `UserRemark` mediumtext DEFAULT NULL,
  `AdminRemark` mediumtext DEFAULT NULL,
  `UserCancelRemark` mediumtext DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT current_timestamp(),
  `BookingStatus` varchar(100) DEFAULT NULL,
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbookings`
--

INSERT INTO `tblbookings` (`id`, `BookingId`, `UserId`, `EventId`, `NumberOfMembers`, `UserRemark`, `AdminRemark`, `UserCancelRemark`, `BookingDate`, `BookingStatus`, `LastUpdationDate`) VALUES
(1, 713920123, 1, 2, 5, 'NA', 'Booking Confirmed', NULL, '2023-05-21 11:34:49', 'Confirmed', '2023-05-21 11:35:42'),
(2, 429161742, 2, 2, 50, 'ggjhghj', 'Your booking has been confirmed', NULL, '2023-05-21 13:43:59', 'Confirmed', '2023-05-21 14:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CategoryDescription` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsActive` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `CategoryDescription`, `CreationDate`, `UpdationDate`, `IsActive`) VALUES
(1, 'Sports Day', 'Sports Day', '2023-05-21 02:40:49', NULL, '1'),
(2, 'Celebrity Event', 'Celebrity Event', '2023-05-21 02:41:57', NULL, '1'),
(3, 'Political Event', 'Political Event', '2023-05-21 02:42:19', NULL, '1'),
(4, 'Seminar', 'Seminar', '2023-05-21 02:44:09', NULL, '1'),
(5, 'Business Event', 'Business Event', '2023-05-21 02:44:24', NULL, '1'),
(6, 'Exhibitions', 'Exhibitions', '2023-05-21 02:44:52', NULL, '1'),
(7, 'Comedy Show', 'Comedy Show', '2023-05-21 11:36:19', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `id` int(11) NOT NULL,
  `CategoryId` char(10) DEFAULT NULL,
  `SponserId` char(10) DEFAULT NULL,
  `EventName` varchar(255) DEFAULT NULL,
  `EventDescription` mediumtext DEFAULT NULL,
  `EventStartDate` date DEFAULT NULL,
  `EventEndDate` date DEFAULT NULL,
  `EventLocation` varchar(255) DEFAULT NULL,
  `EventImage` varchar(255) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsActive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`id`, `CategoryId`, `SponserId`, `EventName`, `EventDescription`, `EventStartDate`, `EventEndDate`, `EventLocation`, `EventImage`, `PostingDate`, `LastUpdationDate`, `IsActive`) VALUES
(1, '1', '1', 'DPS vs St. Xavier\'s High School(SXHS) Cricket Match', 'DPS vs St. Xavier\'s High School(SXHS) league cricket match', '2023-06-01', '2023-06-02', 'Ghaziabad UP', '4d8059f98f63ed90420ab0789ee94c2e.jpg', '2023-05-21 02:50:51', NULL, 1),
(2, '2', '4', 'Movie Promotion', 'Movie Promotion Event.\r\nCelebrities List:\r\nShahrukh Khan\r\nSalman Khan\r\n', '2023-07-08', '2023-07-08', 'Mumbai ', '6d693697b598cf35ba8c45f3df1c7694.jpg', '2023-05-21 11:25:37', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblgenralsettings`
--

CREATE TABLE `tblgenralsettings` (
  `id` int(11) NOT NULL,
  `SiteName` varchar(200) DEFAULT NULL,
  `PhoneNumber` bigint(12) DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `footercontent` mediumtext DEFAULT NULL,
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblgenralsettings`
--

INSERT INTO `tblgenralsettings` (`id`, `SiteName`, `PhoneNumber`, `EmailId`, `address`, `footercontent`, `LastUpdationDate`) VALUES
(1, 'EMS ', 1234567890, 'demotest@test.com', 'Test address\r\nTest City\r\nTest State\r\nIN-110091', 'Event Management System', '2023-05-21 11:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `tblnews`
--

CREATE TABLE `tblnews` (
  `id` int(11) NOT NULL,
  `NewsTitle` varchar(255) DEFAULT NULL,
  `NewsDetails` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblnews`
--

INSERT INTO `tblnews` (`id`, `NewsTitle`, `NewsDetails`, `PostingDate`, `LastUpdationDate`) VALUES
(4, 'Test news', ' This is for testing purpose. This is for testing purpose. This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.This is for testing purpose.', '2023-05-21 02:24:03', NULL),
(5, 'New title', 'New detail come here. New detail come hereNew detail come hereNew detail come hereNew detail come hereNew detail come hereNew detail come hereNew detail come here', '2023-05-21 11:39:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageType` varchar(255) DEFAULT NULL,
  `PageDetails` mediumtext DEFAULT NULL,
  `LastupdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageType`, `PageDetails`, `LastupdationDate`) VALUES
(1, 'aboutus', 'Sample text for testing. Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.Sample text for testing.', '2023-05-21 14:57:01');

-- --------------------------------------------------------

--
-- Table structure for table `tblsponsers`
--

CREATE TABLE `tblsponsers` (
  `id` int(11) NOT NULL,
  `sponserName` varchar(255) DEFAULT NULL,
  `sponserLogo` varchar(255) DEFAULT NULL,
  `postingDate` timestamp NULL DEFAULT current_timestamp(),
  `lastUpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsponsers`
--

INSERT INTO `tblsponsers` (`id`, `sponserName`, `sponserLogo`, `postingDate`, `lastUpdationDate`) VALUES
(1, 'VIVO', 'f6aac84a83343a247532b533b0ef059f.png', '2023-05-21 02:45:57', '0000-00-00 00:00:00'),
(2, 'OLA', 'dd7e6dd23586907e1b0cb0b0319f6445.jpg', '2023-05-21 02:46:33', '0000-00-00 00:00:00'),
(3, 'TATA', 'dc78d13a95344a4147b0b2657c851cda.png', '2023-05-21 02:47:13', '0000-00-00 00:00:00'),
(4, 'Airtel', '80ba95f4a6e05bd753fdf3c43ce89f46.jpg', '2023-05-21 02:47:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubscriber`
--

CREATE TABLE `tblsubscriber` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(255) DEFAULT NULL,
  `Regdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblsubscriber`
--

INSERT INTO `tblsubscriber` (`id`, `UserEmail`, `Regdate`) VALUES
(1, 'johndoe@test.com', '2023-05-21 04:20:09'),
(2, 'ak@gmail.com', '2023-05-21 11:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `Userid` int(11) NOT NULL,
  `FullName` varchar(255) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `Emailid` varchar(255) DEFAULT NULL,
  `PhoneNumber` bigint(12) DEFAULT NULL,
  `UserGender` varchar(100) DEFAULT NULL,
  `UserPassword` varchar(255) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `LastUpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `IsActive` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`Userid`, `FullName`, `UserName`, `Emailid`, `PhoneNumber`, `UserGender`, `UserPassword`, `RegDate`, `LastUpdationDate`, `IsActive`) VALUES
(1, 'John Doe', 'john12', 'john@test.com', 1425632120, 'Male', 'f925916e2754e5e03f75dd58a5733251', '2023-05-21 11:34:02', '2023-05-21 11:34:21', 1),
(2, 'Test123', 'test12345', 'test@gmail.com', 7979797979, 'Male', 'f925916e2754e5e03f75dd58a5733251', '2023-05-21 13:37:28', '2023-05-21 15:12:39', 1);

--
-- Indexes for dumped tables
--
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblgenralsettings`
--
ALTER TABLE `tblgenralsettings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblnews`
--
ALTER TABLE `tblnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsponsers`
--
ALTER TABLE `tblsponsers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`Userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblgenralsettings`
--
ALTER TABLE `tblgenralsettings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblnews`
--
ALTER TABLE `tblnews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsponsers`
--
ALTER TABLE `tblsponsers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblsubscriber`
--
ALTER TABLE `tblsubscriber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `Userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
