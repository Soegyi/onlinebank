-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2017 at 03:19 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `AccountNo` varchar(30) NOT NULL,
  `OpenDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `Balance` double DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `AccountTypeID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`AccountNo`, `OpenDate`, `Balance`, `userid`, `AccountTypeID`) VALUES
('1234123412341234', '2017-04-24 01:00:59', 6590, 75, 'AT100'),
('1234123412341235', '2016-02-01 02:28:16', 57500, 68, 'AT101'),
('1234123412341236', '2017-04-24 02:08:47', 2300, 78, 'AT100'),
('1234123412341237', '2017-04-24 11:18:40', 3000, 79, 'AT100'),
('1234123412351236', '2017-04-22 01:06:28', 1234, 72, 'AT101');

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `AccountTypeID` varchar(30) NOT NULL,
  `AccountTypeName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`AccountTypeID`, `AccountTypeName`) VALUES
('AT100', 'Saving'),
('AT101', 'Fixed');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `BranchCode` varchar(30) NOT NULL,
  `BranchName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`BranchCode`, `BranchName`) VALUES
('M100', 'Mandalay,Zaycho'),
('M101', 'Mandalay,Chanayetharzan'),
('M102', 'Mandalay,ChanMyatharsi'),
('M103', 'Mandalay,Mingalarzay'),
('Y100', 'Yangon,Theingyizay'),
('Y101', 'Yangon,Insein'),
('Y102', 'Yangon,Hlaedan'),
('Y103', 'Yangon,Tarmwe');

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `CardNo` varchar(40) NOT NULL,
  `OwnerName` varchar(50) NOT NULL,
  `Balance` double NOT NULL,
  `BranchCode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`CardNo`, `OwnerName`, `Balance`, `BranchCode`) VALUES
('4567456745674567', 'U Ba ', 14932, 'M100'),
('4567456745674568', 'U Aye Mg', 2000, 'Y101'),
('4567456745674569', 'Daw Mya Mya', 2500, 'M102');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE `deposit` (
  `dpid` int(11) NOT NULL,
  `AccountNo` varchar(40) NOT NULL,
  `Amount` double NOT NULL,
  `DateOfDeposit` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`dpid`, `AccountNo`, `Amount`, `DateOfDeposit`) VALUES
(7, '1234123412341235', 5000, '2016-02-01 02:35:19'),
(8, '1234123412341234', 5000, '2017-04-24 02:16:03'),
(9, '1234123412341234', 1500, '2017-04-24 02:19:13'),
(12, '1234123412341234', -10, '2017-04-24 13:24:30'),
(13, '1234123412341234', 0, '2017-04-24 13:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `nrcrecepient`
--

CREATE TABLE `nrcrecepient` (
  `reid` int(11) NOT NULL,
  `NRC` varchar(50) NOT NULL,
  `BranchCode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nrcrecepient`
--

INSERT INTO `nrcrecepient` (`reid`, `NRC`, `BranchCode`) VALUES
(1, '9/mataya(N)146376', 'Y101'),
(2, '9/mataya(N)146376', 'Y101'),
(3, '9/MAKHASA(N)145388', 'Y101'),
(4, '9/mataya(N)146376', 'Y100');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `TransactionID` int(11) NOT NULL,
  `TransactionTypeID` varchar(10) NOT NULL,
  `TransactionDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `Amount` double NOT NULL,
  `Recepient` varchar(50) NOT NULL,
  `AccountNo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`TransactionID`, `TransactionTypeID`, `TransactionDate`, `Amount`, `Recepient`, `AccountNo`) VALUES
(1, 'TT100', '2017-04-22 01:23:06', 200, '1234123412351235', '1234123412341235'),
(2, 'TT102', '2017-04-22 01:23:37', 500, '4567456745674567', '1234123412341235'),
(3, 'TT100', '2017-04-24 02:25:32', 200, '1234123412341235', '1234123412341236'),
(4, 'TT100', '2017-04-24 14:00:30', 2000, '1234123412341236', '1234123412341235');

-- --------------------------------------------------------

--
-- Table structure for table `transactiontype`
--

CREATE TABLE `transactiontype` (
  `TransactionTypeID` varchar(10) NOT NULL,
  `TransactionTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactiontype`
--

INSERT INTO `transactiontype` (`TransactionTypeID`, `TransactionTypeName`) VALUES
('TT100', 'Account To Account'),
('TT101', 'Account To NRC'),
('TT102', 'Account To Card');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `NRC` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `phono` varchar(40) DEFAULT NULL,
  `BranchCode` varchar(30) NOT NULL,
  `OwnerName` varchar(50) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Role` varchar(30) NOT NULL,
  `otp` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `NRC`, `email`, `address`, `phono`, `BranchCode`, `OwnerName`, `DateOfBirth`, `Role`, `otp`) VALUES
(66, 'administrator', '$2y$10$t7ubg7mGoesB0gE/PVyEE./YF.zDxScZw/HamX5sjzNG0RrsE3IJG', '9/MATAYA(N)146324', 'admin@gmail.com', '', '', 'Y102', 'U Soe Thu Hein', '1987-11-19', 'Administrator', NULL),
(67, 'admin', '$2y$10$BN8E0lo7p8/LiefPI5mfuu.tgvpZqyNXCa0NSxKAH.FzezU4AQi..', 'a', 'admin@gmail.com', '', '', 'Y103', 'admin', '1986-12-30', 'Administrator', NULL),
(68, 'moemoe', '$2y$10$2uQTDGfelfBDz5ZjQTeFqe8Xku8i4zMOk2fXDYxLPQv2nEc2LvIPi', '9/pasanya(N)145334', 'moemoe@localhost', 'Yangon,Insein', '094026558657', 'Y101', 'Daw Moe Moe', '1987-11-18', 'User', '9B9D71'),
(72, 'soesoe', '$2y$10$JNpoLhTVMB18oNzqjI/tHefXFdyo5ioMb2XKTvv9ZQxhIi.9NtH5a', '14/kamasa(N) 154231', 'soesoe@localhost', 'Mandalay, Manawhari', '09886135214', 'M100', 'U Soe Soe', '1989-02-28', 'User', '3AF639'),
(75, 'toetoe', '$2y$10$oPCXO5nmCjPu8Q8m3kvuIuCtMrJcZHYP6fouS6Nl07qcE3wfYzrQa', '14/kamasa(N) 154232', 'toetoe@localhost', 'Mandalay, Manawhari', '098861352141', 'M101', 'U Toe', '1993-02-18', 'User', '9783A9'),
(78, 'soethuhein', '$2y$10$RgF/K/NfjQZYXKHRQ0AltO4qCsm.qYAU1biANxTyqXyAW7nNKOBYC', '9/mataya(N)146376', 'soethuhein@localhost', 'Mandalay, Manawhari', '0997727652', 'M101', 'U Soe Thu Hein', '1992-05-18', 'User', '8450F6'),
(79, 'phyophyo', '$2y$10$HQYoyjFh1v1othVbP6/dceKdfL8LmPC6S0Tp2oSnHb4o0v1hnH4vC', '9/mataya(N)146374', 'phyohpyo@localhost', 'Mandaly, Chanayetharzan', '0924545784', 'M101', 'U Phyo', '1996-01-19', 'User', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountNo`),
  ADD KEY `userid` (`userid`),
  ADD KEY `AccountTypeID` (`AccountTypeID`);

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`AccountTypeID`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`BranchCode`);

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`CardNo`),
  ADD KEY `BranchCode` (`BranchCode`);

--
-- Indexes for table `deposit`
--
ALTER TABLE `deposit`
  ADD PRIMARY KEY (`dpid`),
  ADD KEY `AccountNo` (`AccountNo`);

--
-- Indexes for table `nrcrecepient`
--
ALTER TABLE `nrcrecepient`
  ADD PRIMARY KEY (`reid`),
  ADD KEY `BranchCode` (`BranchCode`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `AccountNo` (`AccountNo`),
  ADD KEY `TransactionTypeID` (`TransactionTypeID`),
  ADD KEY `Recepient` (`Recepient`);

--
-- Indexes for table `transactiontype`
--
ALTER TABLE `transactiontype`
  ADD PRIMARY KEY (`TransactionTypeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `BranchCode` (`BranchCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deposit`
--
ALTER TABLE `deposit`
  MODIFY `dpid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `nrcrecepient`
--
ALTER TABLE `nrcrecepient`
  MODIFY `reid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`AccountTypeID`) REFERENCES `accounttype` (`AccountTypeID`),
  ADD CONSTRAINT `account_ibfk_3` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE;

--
-- Constraints for table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`BranchCode`) REFERENCES `branch` (`BranchCode`);

--
-- Constraints for table `deposit`
--
ALTER TABLE `deposit`
  ADD CONSTRAINT `deposit_ibfk_1` FOREIGN KEY (`AccountNo`) REFERENCES `account` (`AccountNo`) ON DELETE CASCADE;

--
-- Constraints for table `nrcrecepient`
--
ALTER TABLE `nrcrecepient`
  ADD CONSTRAINT `nrcrecepient_ibfk_1` FOREIGN KEY (`BranchCode`) REFERENCES `branch` (`BranchCode`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`TransactionTypeID`) REFERENCES `transactiontype` (`TransactionTypeID`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`AccountNo`) REFERENCES `account` (`AccountNo`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`BranchCode`) REFERENCES `branch` (`BranchCode`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
