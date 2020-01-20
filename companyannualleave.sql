-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2020 at 05:51 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `companyannualleave`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminId` int(11) NOT NULL,
  `adminName` varchar(20) NOT NULL,
  `adminSurname` varchar(30) NOT NULL,
  `adminUsername` varchar(20) NOT NULL,
  `adminPassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminId`, `adminName`, `adminSurname`, `adminUsername`, `adminPassword`) VALUES
(1, 'Bill', 'Gates', 'bili', '12345'),
(2, 'Mark', 'Zuckerberg', 'mark', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeId` int(11) NOT NULL,
  `employeeName` varchar(20) NOT NULL,
  `employeeSurname` varchar(30) NOT NULL,
  `employeeBirthDate` date NOT NULL,
  `employeeStartJobDate` date NOT NULL,
  `employeePosition` varchar(30) NOT NULL,
  `employeeContractType` varchar(20) NOT NULL,
  `employeeUsername` varchar(20) NOT NULL,
  `employeePassword` varchar(20) NOT NULL,
  `employeeFreeDays` int(40) NOT NULL,
  `employeeAnnualStatus` tinyint(1) NOT NULL,
  `employeeAnnualRequest` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeId`, `employeeName`, `employeeSurname`, `employeeBirthDate`, `employeeStartJobDate`, `employeePosition`, `employeeContractType`, `employeeUsername`, `employeePassword`, `employeeFreeDays`, `employeeAnnualStatus`, `employeeAnnualRequest`) VALUES
(1, 'Anna', 'Frank', '0000-00-00', '2019-03-03', 'Front End Developer', 'Full Time', '', '', 0, 0, 0),
(3, 'James', 'Deen', '0000-00-00', '2018-03-03', 'Back End Developer', 'Part Time', '', '', 0, 1, 0),
(4, 'Antonio', 'Michael', '0000-00-00', '2019-07-05', 'Full Stack Developer', 'Full Time', '', '', 0, 1, 0),
(27, 'Nicholas', 'Johnes', '1233-12-01', '1231-03-12', 'Front End Developer', 'Full Time', 'nich12', '123456', 0, 0, 0),
(29, 'Maria', 'Stones', '1987-05-24', '2016-07-26', 'Manager', 'Full Time', 'maria87', 'marry123', 0, 0, 1),
(30, 'Angela', 'Craft', '1988-08-15', '2018-08-01', 'Economist', 'Full Time', 'angela88', 'angelgirl', 0, 0, 0),
(31, 'Hanna', 'Montana', '2000-05-23', '2019-06-24', 'Manager', 'Part Time', 'Hanna00', 'hannayoung', 0, 0, 0),
(53, 'James', 'Cameroon', '1978-04-23', '2014-04-15', 'Full Stack Developer', 'Full Time', 'james78', 'james123', 31, 0, 1),
(54, 'Nikita', 'Geller', '1992-09-07', '2017-03-08', 'Economist', 'Full Time', 'nikita92', 'nicky23', 24, 0, 0),
(57, 'Nickita', 'Merge', '1986-04-23', '2015-03-01', 'Back End Developer', 'Full Time', 'nicky', '123456', 39, 0, 0),
(58, 'Ajde', 'asd', '2010-02-23', '2017-02-23', 'Front End Developer', 'Full Time', 'asd', 'asd', 23, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
