-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 05:05 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `music hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `likeID` int(5) NOT NULL,
  `userID` int(4) NOT NULL,
  `musicID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeID`, `userID`, `musicID`) VALUES
(9, 4, 14),
(10, 7, 20),
(11, 7, 19),
(12, 4, 20);

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `musicID` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(300) NOT NULL,
  `userID` int(4) NOT NULL,
  `image` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`musicID`, `title`, `filename`, `userID`, `image`) VALUES
(1, 'flume', 'flume insp.wav', 1, 'jeff.jpg'),
(5, 'qwerty', 'comp.wav', 0, 'artgif4.gif'),
(9, 'fed', 'hip pop plau boi.wav', 4, 'print2.png'),
(11, 'test', 'comp.wav', 4, 'jeff.jpg'),
(14, 'sdfghj', 'comp.wav', 4, 'IMG_5654.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(3) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(1, 'jeff', '$2y$10$309mcGwKF6fnCSrBHmQEkO9QAInAbfXqMdSRTGNEev2'),
(3, 'username', '$2y$10$u35DspYJLujH2b1X3JLUsueEM1aUXGyucXIC5eARmUclFTaQNSQq.'),
(4, 'jo', '$2y$10$2LWCiv8178uVNZ3ML4R0Uuud8cp5Trwn.zXRaropx.kGPIM36XDZy'),
(5, 'dri', '$2y$10$nNCfBF2upHp9V9VyfVw6Q.UshGVrF9fgj0giGbGtdqssasCL2WQJm'),
(6, 'josh', '$2y$10$Trvg0chzLi8vuCqYKGXtK.MSk0ZQMJJAoBCvSMVkWwp92cIOjwKKm'),
(7, 'jefdun', '$2y$10$1DN02jJhsqIKhu.mG5Xbguhji4uD.j/ou7bvzqFpsSXHGWphztY1.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`likeID`);

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`musicID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `likeID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `musicID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
