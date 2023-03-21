-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2023 at 05:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(10) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DOB` varchar(20) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Role` varchar(5) NOT NULL DEFAULT 'user',
  `Password` varchar(255) NOT NULL,
  `Createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `Updateat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `Fname`, `Lname`, `Email`, `DOB`, `Gender`, `Phone`, `Role`, `Password`, `Createdat`, `Updateat`) VALUES
(1, 'Karan', 'Chaudhary', 'karan@gmail.com', '2000-12-30', 'Male', '9821479916', 'user', '8d09635a76613b3029d05dc32fa0fe8d', '2023-03-21 00:06:57', '2023-03-21 00:06:57'),
(2, 'mukesh', 'tharu', 'mukesh@gmail.com', '2000-12-06', 'Male', '9821479916', 'user', '49f9ff3a98826af6cb10082688c8fba1', '2023-03-21 00:27:21', '2023-03-21 00:27:21'),
(3, 'Binod', 'Tharu', 'binod@gmail.com', '2002-12-10', 'Male', '9821479916', 'user', 'fc11417832b2f6133f95e298957bd819', '2023-03-21 16:33:45', '2023-03-21 16:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `trader`
--

CREATE TABLE `trader` (
  `Id` int(10) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `DOB` varchar(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Role` varchar(7) NOT NULL DEFAULT 'trader',
  `Phone` varchar(13) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedat` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `trader`
--
ALTER TABLE `trader`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trader`
--
ALTER TABLE `trader`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
