-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 04:35 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portadown`
--

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `breedID` int(5) NOT NULL,
  `breed_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`breedID`, `breed_name`) VALUES
(1, 'Bull'),
(2, 'Steer'),
(3, 'Heifer');

-- --------------------------------------------------------

--
-- Table structure for table `herd`
--

CREATE TABLE `herd` (
  `herdID` int(5) NOT NULL,
  `herd_year` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `herd`
--

INSERT INTO `herd` (`herdID`, `herd_year`) VALUES
(1, '2018'),
(2, '2019');

-- --------------------------------------------------------

--
-- Table structure for table `irrigation`
--

CREATE TABLE `irrigation` (
  `irrigationID` int(5) NOT NULL,
  `date` date NOT NULL,
  `time` char(4) NOT NULL,
  `volume` char(6) NOT NULL,
  `hours` char(5) NOT NULL,
  `run` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `irrigation`
--

INSERT INTO `irrigation` (`irrigationID`, `date`, `time`, `volume`, `hours`, `run`) VALUES
(1, '2020-01-01', '2030', '200000', '09999', '1a'),
(2, '2020-01-01', '1900', '210000', '10000', '2b');

-- --------------------------------------------------------

--
-- Table structure for table `sowing`
--

CREATE TABLE `sowing` (
  `paddockID` int(5) NOT NULL,
  `sowingID` int(5) NOT NULL,
  `date` date NOT NULL,
  `seed_type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockID` int(5) NOT NULL,
  `tag_number` int(3) NOT NULL,
  `herdID` int(5) NOT NULL,
  `breedID` int(5) NOT NULL,
  `notes` varchar(500) NOT NULL COMMENT 'This allows the user to make notes on the individual cattle '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockID`, `tag_number`, `herdID`, `breedID`, `notes`) VALUES
(5, 1, 2, 1, ''),
(6, 2, 2, 2, ''),
(7, 3, 2, 3, ''),
(8, 4, 2, 3, ''),
(9, 5, 2, 2, ''),
(10, 6, 2, 1, ''),
(11, 7, 2, 2, ''),
(12, 8, 2, 2, ''),
(13, 9, 2, 1, 'note'),
(14, 10, 2, 1, ''),
(15, 11, 2, 3, ''),
(16, 12, 2, 2, ''),
(17, 13, 2, 3, ''),
(18, 14, 2, 3, ''),
(19, 15, 2, 2, ''),
(20, 16, 2, 1, ''),
(21, 17, 2, 1, ''),
(22, 18, 2, 1, ''),
(25, 1, 1, 3, ''),
(26, 2, 1, 3, ''),
(27, 3, 0, 1, ''),
(28, 4, 1, 3, ''),
(29, 5, 1, 2, ''),
(30, 6, 1, 2, ''),
(31, 7, 1, 1, ''),
(32, 8, 1, 3, ''),
(33, 9, 1, 1, ''),
(34, 10, 1, 2, ''),
(35, 11, 1, 2, ''),
(36, 12, 1, 3, ''),
(37, 13, 1, 1, ''),
(38, 14, 1, 3, ''),
(39, 15, 1, 2, ''),
(40, 16, 1, 1, ''),
(41, 17, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$yGWozHkTdo7/jB6SmnPMWO2EEjMm3.T8OdXAuQykhZMkj2N/yFz8e'),
(2, 'brynley', '$2y$10$fPpA2CTmBGgNOXAJo8mIJOrqcbzscFSU1NSm/QTn/bhpaxhvoLkiO');

-- --------------------------------------------------------

--
-- Table structure for table `weight`
--

CREATE TABLE `weight` (
  `weightID` int(5) NOT NULL,
  `stockID` int(5) NOT NULL,
  `date` date NOT NULL COMMENT 'The date is entered by SQL to avoid user input',
  `weight` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `weight`
--

INSERT INTO `weight` (`weightID`, `stockID`, `date`, `weight`) VALUES
(5, 5, '2019-12-15', 154),
(6, 6, '2019-12-15', 132),
(7, 7, '2019-12-15', 148),
(8, 8, '2019-12-15', 116),
(9, 9, '2019-12-15', 0),
(10, 10, '2019-12-15', 107),
(11, 11, '2019-12-15', 0),
(12, 12, '2019-12-15', 126),
(13, 13, '2019-12-15', 0),
(14, 14, '2019-12-15', 151),
(15, 15, '2019-12-15', 147),
(16, 16, '2019-12-15', 130),
(17, 17, '2019-12-15', 0),
(18, 18, '2019-12-15', 130),
(19, 19, '2019-12-15', 120),
(20, 20, '2019-12-15', 129),
(21, 21, '2019-12-15', 155),
(22, 22, '2019-12-15', 155),
(24, 24, '2019-12-15', 138),
(25, 5, '2020-04-05', 218),
(26, 6, '2020-04-05', 178),
(27, 7, '2020-04-05', 228),
(28, 8, '2020-04-05', 0),
(29, 9, '2020-04-05', 190),
(30, 10, '2020-04-05', 167),
(31, 11, '2020-04-05', 189),
(32, 12, '2020-04-05', 187),
(33, 13, '2020-04-05', 188),
(34, 14, '2020-04-05', 240),
(35, 15, '2020-04-05', 199),
(36, 16, '2020-04-05', 205),
(37, 17, '2020-04-05', 0),
(38, 18, '2020-04-05', 184),
(39, 19, '2020-04-05', 184),
(40, 20, '2020-04-05', 185),
(41, 21, '2020-04-05', 220),
(42, 22, '2020-04-05', 210),
(44, 24, '2020-04-05', 213),
(45, 8, '2020-04-05', 0),
(46, 9, '2020-04-05', 190),
(47, 10, '2020-04-05', 167),
(48, 11, '2020-04-05', 189),
(49, 12, '2020-04-05', 187),
(50, 13, '2020-04-05', 188),
(51, 14, '2020-04-05', 240),
(52, 15, '2020-04-05', 199),
(53, 16, '2020-04-05', 205),
(54, 17, '2020-04-05', 0),
(55, 18, '2020-04-05', 184),
(56, 19, '2020-04-05', 184),
(57, 20, '2020-04-05', 185),
(58, 21, '2020-04-05', 220),
(59, 22, '2020-04-05', 210),
(61, 24, '2020-04-05', 213),
(62, 25, '2019-10-26', 310),
(63, 25, '2019-12-14', 356),
(64, 25, '2020-02-08', 395),
(65, 26, '2019-10-26', 325),
(66, 26, '2019-12-14', 397),
(67, 26, '2020-02-08', 438),
(68, 27, '2019-10-26', 296),
(69, 27, '2019-12-14', 373),
(70, 27, '2020-02-08', 426),
(71, 28, '2019-10-26', 344),
(72, 28, '2019-12-14', 410),
(73, 28, '2020-02-08', 472),
(74, 29, '2019-10-26', 291),
(75, 29, '2019-12-14', 349),
(76, 29, '2020-02-08', 394),
(77, 30, '2019-10-26', 284),
(78, 30, '2019-12-14', 339),
(79, 30, '2020-02-08', 380),
(80, 31, '2019-10-26', 296),
(81, 31, '2019-12-14', 374),
(82, 31, '2020-02-08', 406),
(83, 32, '2019-10-26', 274),
(84, 32, '2019-12-14', 329),
(85, 32, '2020-02-08', 375),
(86, 33, '2019-10-26', 299),
(87, 33, '2019-12-14', 378),
(88, 33, '2020-02-08', 423),
(89, 34, '2019-10-26', 292),
(90, 34, '2019-12-14', 375),
(91, 34, '2020-02-08', 424),
(92, 35, '2019-10-26', 288),
(93, 35, '2019-12-14', 331),
(94, 35, '2020-02-08', 381),
(95, 36, '2019-10-26', 315),
(96, 36, '2019-12-14', 394),
(97, 36, '2020-02-08', 431),
(98, 37, '2019-10-26', 260),
(99, 37, '2019-12-14', 315),
(100, 37, '2020-02-08', 361),
(101, 38, '2019-10-26', 357),
(102, 38, '2019-12-14', 411),
(103, 38, '2020-02-08', 463),
(104, 39, '2019-10-26', 303),
(105, 39, '2019-12-14', 371),
(106, 39, '2020-02-08', 417),
(107, 40, '2019-10-26', 337),
(108, 40, '2019-12-14', 404),
(109, 40, '2020-02-08', 454),
(110, 41, '2019-10-26', 278),
(111, 41, '2019-12-14', 345),
(112, 41, '2020-02-08', 381),
(157, 23, '2020-02-08', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`breedID`);

--
-- Indexes for table `herd`
--
ALTER TABLE `herd`
  ADD PRIMARY KEY (`herdID`);

--
-- Indexes for table `irrigation`
--
ALTER TABLE `irrigation`
  ADD PRIMARY KEY (`irrigationID`);

--
-- Indexes for table `sowing`
--
ALTER TABLE `sowing`
  ADD PRIMARY KEY (`sowingID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `weight`
--
ALTER TABLE `weight`
  ADD PRIMARY KEY (`weightID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breed`
--
ALTER TABLE `breed`
  MODIFY `breedID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `herd`
--
ALTER TABLE `herd`
  MODIFY `herdID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `irrigation`
--
ALTER TABLE `irrigation`
  MODIFY `irrigationID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sowing`
--
ALTER TABLE `sowing`
  MODIFY `sowingID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `weight`
--
ALTER TABLE `weight`
  MODIFY `weightID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
