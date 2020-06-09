-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 01:54 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lightwork`
--

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE `colours` (
  `colourID` int(2) NOT NULL COMMENT '*Linking Table* gives each colour and ID tag',
  `RGB` varchar(7) NOT NULL COMMENT 'The RGB code for each colour'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`colourID`, `RGB`) VALUES
(1, '#ffffff'),
(2, '#0a1257'),
(3, '#a1081c'),
(4, '#085dd4'),
(5, '#9fa6a0'),
(6, '#2a344a'),
(7, '#000000'),
(8, '#3d3434'),
(9, '#00f2ea'),
(12, '#696969');

-- --------------------------------------------------------

--
-- Table structure for table `itemcolours`
--

CREATE TABLE `itemcolours` (
  `ID` int(2) NOT NULL,
  `itemID` int(2) NOT NULL COMMENT '*Linking Table* Links the items from ''items'' so that we can match colours to them',
  `colourID` int(2) NOT NULL COMMENT '*Linking Table* Links the colours to this table so we know what RGB code goes with which item.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemcolours`
--

INSERT INTO `itemcolours` (`ID`, `itemID`, `colourID`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 2, 3),
(5, 2, 4),
(6, 2, 5),
(7, 3, 6),
(8, 3, 5),
(9, 3, 7),
(10, 4, 8),
(11, 4, 7),
(12, 4, 1),
(13, 8, 9),
(14, 8, 3),
(15, 8, 1),
(19, 5, 5),
(20, 5, 7),
(21, 5, 8),
(22, 6, 8),
(23, 6, 1),
(24, 6, 7),
(25, 7, 7),
(26, 7, 3),
(27, 7, 4);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itemID` int(2) NOT NULL COMMENT '*Linking Table* Gives the items a number to match in other tables (itemsize and itemcolours)',
  `name` varchar(100) NOT NULL COMMENT 'Name of the item.',
  `price` int(2) NOT NULL COMMENT 'Item''s Price',
  `availability` int(1) NOT NULL COMMENT 'This column is for whether the item is on sale or not at the current time.',
  `image` varchar(30) NOT NULL COMMENT 'Image for item.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itemID`, `name`, `price`, `availability`, `image`) VALUES
(1, 'Light Work Ringer T-Shirt', 25, 0, 'shirt_ringer_white.png'),
(2, 'Light Work Polo Shirt', 41, 1, 'polo_shirt_red.png'),
(3, 'Light Work Premium Hoodie', 82, 0, 'premium_hoodie_navy.png'),
(4, 'Light Work Letterman Jacket', 82, 0, 'letterman_jacket.png'),
(5, 'Light Work Embroidered Jacket', 78, 1, 'embroidered_jacket.png'),
(6, 'Light Work Tank Top', 37, 1, 'tank_top_asphalt.png'),
(7, 'Lightwork Zip Up Hoodie', 73, 1, 'zip_up_hoodie.png'),
(8, 'Light Work T-Shirt', 28, 0, 'shirt_sky.png');

-- --------------------------------------------------------

--
-- Table structure for table `itemsize`
--

CREATE TABLE `itemsize` (
  `itemID` int(2) NOT NULL COMMENT '*Linking Table* Gives the items a number to match in other tables (items and itemcolours)',
  `sizeID` int(1) NOT NULL COMMENT '*Linking Table* Gives the sizes ID numbers so we can see what items come in what sizes.',
  `ID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemsize`
--

INSERT INTO `itemsize` (`itemID`, `sizeID`, `ID`) VALUES
(8, 1, 1),
(8, 2, 2),
(8, 3, 3),
(8, 4, 4),
(8, 5, 5),
(8, 6, 6),
(8, 7, 7),
(8, 8, 8),
(1, 1, 9),
(1, 2, 10),
(1, 3, 11),
(1, 4, 12),
(1, 5, 13),
(2, 1, 14),
(2, 2, 15),
(2, 3, 16),
(2, 4, 17),
(2, 5, 18),
(3, 1, 19),
(3, 2, 20),
(3, 3, 21),
(3, 4, 22),
(3, 5, 23),
(4, 1, 24),
(4, 2, 25),
(4, 3, 26),
(4, 4, 27),
(4, 5, 28),
(5, 1, 29),
(5, 2, 30),
(5, 3, 31),
(5, 4, 32),
(5, 5, 33),
(6, 1, 34),
(6, 2, 35),
(6, 3, 36),
(6, 4, 37),
(6, 5, 38),
(6, 6, 39),
(7, 1, 40),
(7, 2, 41),
(7, 3, 42),
(7, 4, 43),
(7, 5, 44),
(7, 6, 45),
(7, 7, 46),
(15, 1, 52),
(15, 2, 53),
(15, 3, 54),
(16, 1, 55),
(16, 2, 56),
(16, 3, 57),
(17, 1, 58),
(17, 2, 59),
(17, 3, 60),
(18, 7, 61),
(18, 8, 62),
(8, 1, 63),
(8, 2, 64),
(8, 6, 65),
(20, 5, 69),
(20, 6, 70),
(20, 8, 71),
(20, 7, 72);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `sizeID` int(2) NOT NULL COMMENT '*Linking Table* Gives the sizes ID numbers so we can see what items come in what sizes.',
  `sizes` varchar(5) NOT NULL COMMENT 'Gives the sizes that items can come in'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`sizeID`, `sizes`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, '2XL'),
(6, '3XL'),
(7, '4XL'),
(8, '5XL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(3) NOT NULL COMMENT 'Gives the user an ID',
  `username` varchar(30) NOT NULL COMMENT 'Username of User',
  `password` varchar(100) NOT NULL COMMENT 'Password of User'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(1, 'Tij', '$2y$10$/3Fdtp7c/VoOCcW0nkY2Zuqd/qEENGBIW4d72.elhS27UzSb0j5mC'),
(2, 'PAD', '$2y$10$SdhEGSZqNpGIRDa365sBhOqdBr.mJyghvvQNUPeC8x3tS.w7wUYiC'),
(3, 'Tij', '$2y$10$Qq53DS3M8V9/7AesuweDuOeE3yvjOYxZI.90NhCZfItaAfiO6SSOe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`colourID`);

--
-- Indexes for table `itemcolours`
--
ALTER TABLE `itemcolours`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `itemsize`
--
ALTER TABLE `itemsize`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`sizeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colours`
--
ALTER TABLE `colours`
  MODIFY `colourID` int(2) NOT NULL AUTO_INCREMENT COMMENT '*Linking Table* gives each colour and ID tag', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `itemcolours`
--
ALTER TABLE `itemcolours`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itemID` int(2) NOT NULL AUTO_INCREMENT COMMENT '*Linking Table* Gives the items a number to match in other tables (itemsize and itemcolours)', AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `itemsize`
--
ALTER TABLE `itemsize`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
