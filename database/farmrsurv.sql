-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2016 at 07:05 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `farmrsurv`
--

-- --------------------------------------------------------

--
-- Table structure for table `formsheet`
--

CREATE TABLE IF NOT EXISTS `formsheet` (
  `FormSheetID` bigint(20) unsigned NOT NULL,
  `FormSheetTitle` varchar(120) NOT NULL,
  `FormSheetDesc` varchar(300) NOT NULL,
  `FormSheetDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `formsheet`
--

INSERT INTO `formsheet` (`FormSheetID`, `FormSheetTitle`, `FormSheetDesc`, `FormSheetDate`) VALUES
(1, 'Proper Test', 'This is an experimental form', '2016-08-04 00:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `quest`
--

CREATE TABLE IF NOT EXISTS `quest` (
  `QuestID` bigint(20) unsigned NOT NULL,
  `QuestTypeID` int(11) NOT NULL,
  `QuestText` varchar(500) NOT NULL,
  `QuestOpts` varchar(200) DEFAULT NULL,
  `FormSheetID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quest`
--

INSERT INTO `quest` (`QuestID`, `QuestTypeID`, `QuestText`, `QuestOpts`, `FormSheetID`) VALUES
(1, 1, 'What is you name', NULL, 1),
(2, 3, 'Gender', 'Male:|:Female', 1),
(3, 2, 'Phone Number', NULL, 1),
(4, 4, 'Do you like;', 'Chocolate:|:Apple Juice:|:Milk', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questtype`
--

CREATE TABLE IF NOT EXISTS `questtype` (
  `QuestTypeID` bigint(20) unsigned NOT NULL,
  `QuestTypeName` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questtype`
--

INSERT INTO `questtype` (`QuestTypeID`, `QuestTypeName`) VALUES
(1, 'Text Answer'),
(2, 'Numeric Answer'),
(3, 'Single choice'),
(4, 'Multiple choice');

-- --------------------------------------------------------

--
-- Table structure for table `survres`
--

CREATE TABLE IF NOT EXISTS `survres` (
  `SurvResID` bigint(20) unsigned NOT NULL,
  `QuestID` int(11) NOT NULL,
  `SurvResText` varchar(400) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survres`
--

INSERT INTO `survres` (`SurvResID`, `QuestID`, `SurvResText`) VALUES
(1, 1, 'Emmanuel Duah'),
(2, 2, 'Male'),
(3, 3, '1234567890'),
(4, 4, 'Apple Juice:|:Chocolate'),
(5, 1, 'Juliana'),
(6, 2, 'Female'),
(7, 3, '7654323456789'),
(8, 4, 'Milk:|:Apple Juice');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formsheet`
--
ALTER TABLE `formsheet`
  ADD UNIQUE KEY `FormSheetID` (`FormSheetID`);

--
-- Indexes for table `quest`
--
ALTER TABLE `quest`
  ADD UNIQUE KEY `QuestID` (`QuestID`);

--
-- Indexes for table `questtype`
--
ALTER TABLE `questtype`
  ADD UNIQUE KEY `QuestTypeID` (`QuestTypeID`);

--
-- Indexes for table `survres`
--
ALTER TABLE `survres`
  ADD UNIQUE KEY `FormAnsID` (`SurvResID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formsheet`
--
ALTER TABLE `formsheet`
  MODIFY `FormSheetID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `quest`
--
ALTER TABLE `quest`
  MODIFY `QuestID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `questtype`
--
ALTER TABLE `questtype`
  MODIFY `QuestTypeID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `survres`
--
ALTER TABLE `survres`
  MODIFY `SurvResID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
