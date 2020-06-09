-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 02:15 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `decibels`
--

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE `music` (
  `coverArt` varchar(1000) NOT NULL,
  `audioFile` varchar(1000) NOT NULL,
  `songName` varchar(200) NOT NULL,
  `musicID` int(3) NOT NULL,
  `UserID` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `music`
--

INSERT INTO `music` (`coverArt`, `audioFile`, `songName`, `musicID`, `UserID`) VALUES
('1_rIkmavUeqyRySwlQdA9kKg.jpeg', 'ear-rape-moaning-girl-troll-sound-crappy-long-edition-loudtronix-hq.mp3', 'Jeff', 14, 27),
('55-22599-ab4_85638-1432851468.jpg', 'zapsplat_human_fart_wet_dribble_poop_002_51584.mp3', 'poo', 18, 29),
('243xe5.jpg', 'ringtone_20.mp3', 'cool', 20, 29),
('1dnho4.jpg', 'cyka-blyat.mp3', 'halo gamer', 21, 29);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(30) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UserID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`, `UserID`) VALUES
('jo', '$2y$10$chX0JoB6oYpAgM4RskLl0.26v9mXyRZbE.k0AQVxEU0ReV53GY4e6', 27),
('user1', '$2y$10$owscq1ceJyY8dz5LnkQkaeJ4Bln5WQjH6ybtkZEzPNhL0zn3Nx5le', 28),
('Charlseus12', '$2y$10$mvU9gy3ObFppGRaHIZm7KexsxpeH.W9icCbgnrY0qzwot.mt9172O', 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `music`
--
ALTER TABLE `music`
  ADD PRIMARY KEY (`musicID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `music`
--
ALTER TABLE `music`
  MODIFY `musicID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
