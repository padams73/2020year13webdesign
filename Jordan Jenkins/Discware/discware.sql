-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 02:24 AM
-- Server version: 5.7.11
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `discware`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(1) NOT NULL,
  `categoryName` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Music'),
(2, 'Movies'),
(3, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `listID` int(5) NOT NULL,
  `listName` varchar(50) NOT NULL,
  `listItemCreator` varchar(50) NOT NULL,
  `listPrice` int(3) NOT NULL,
  `userID` int(4) NOT NULL,
  `listDsc` varchar(255) NOT NULL,
  `listCnd` int(1) NOT NULL,
  `listImage` varchar(50) NOT NULL,
  `categoryID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`listID`, `listName`, `listItemCreator`, `listPrice`, `userID`, `listDsc`, `listCnd`, `listImage`, `categoryID`) VALUES
(1, 'Sgt. Peppers Lonely Heart\'s Club Band', 'The Beatles', 25, 1, 'Sgt. Peppers Lonely Heart\'s Club Band\r\nBy The Beatles, released in 1967.\r\nRemastered in 2009 on CD.', 3, 'sgt-peppers-lonely-hearts-club-band.jpg', 1),
(3, '.5: The Gray Chapter - Deluxe Edition', 'Slipknot', 20, 9, 'The fifth studio album, from Iowa based band. Slipknot. Following the death of their bassist Paul Gray, and the swift exit of Joey Jordison, the drummer. This is what the band produced.\r\n\r\nTwo disc deluxe set.', 3, '.5-the-gray-chapter.jpg', 1),
(4, '1,039/Smoothed Out Slappy Hours', 'Green Day', 10, 1, 'One of Green Days earliest albums, released in 1991. This is also known as Green Day\'s debut. Is a mash of the band\'s actual debut, 39/Smooth, and two of their other works. Slappy, and 1,000 Hours.', 3, '1039-smoothed-out-slappy-hours.jpg', 1),
(5, '50 Years - Don\'t Stop', 'Fleetwood Mac', 13, 1, 'An exceptional collection from Fleetwood Mac\'s first 50 years of music production, not once did they seem to falter.', 3, '50-years-dont-stop.jpg', 1),
(6, 'Aerosmith\'s Greatest Hits 1973-1988', 'Aerosmith', 10, 1, 'A collection of Aerosmith\'s best song from a 15 year period out of their huge catalogue.', 3, 'aerosmith-greatest-hits.jpg', 1),
(11, 'All Hope Is Gone', 'Slipknot', 14, 1, 'Slipknot\'s fourth studio album, also their biggest success, and some of the band members greatest disappointment.', 3, 'all-hope-is-gone.jpg', 1),
(13, 'Animals', 'Pink Floyd', 10, 1, 'A small collection of songs by Pink Floyd, that probably gets bought with a pound of weed.', 2, 'animals.jpg', 1),
(14, 'Atrocity Exhibition', 'Danny Brown', 10, 1, 'Recommended to people who like noise. And not much else', 3, 'atrocity-exhibition.jpg', 1),
(15, 'Best Of Elton John', 'Elton John', 13, 1, 'A 2-Disc collection of Elton John\'s best work, which there seems to be a lot of.', 2, 'best-of-elton-john.jpg', 1),
(16, 'Blur', 'Blur', 9, 1, 'Blur, the fifth studio album from Blur, has some great pieces, and some "interesting" pieces.', 2, 'blur.jpg', 1),
(20, 'Dark Side Of The Moon', 'Pink Floyd', 15, 1, 'The legendary PinK Floyd album, this edition even has a small paint splatter on the front.', 2, 'dark-side-of-the-moon.jpg', 1),
(21, 'Dookie', 'Green Day', 20, 1, 'The fantastic Green Day piece, is anything but dookie, this vinyl re-release comes with a poster in the disc sleeve.', 3, 'dookie.jpg', 1),
(22, 'Evil Empire', 'Rage Against The Machine', 14, 1, 'One of Rage Against The Machines best albums, they combine elements of hip-hop and rock, to get a completely unique sound.', 3, 'evil-empire.jpg', 1),
(23, 'Exodus', 'Bob Marley and The Wailers', 7, 9, 'One of the wailers most influential albums, exodus is proof that stoners can still be productive.', 3, 'exodus.jpg', 1),
(26, 'American Idiot', 'Green Day', 15, 9, 'Inarguably Green Day\'s most influentual and most recognisable record to date.', 3, 'american-idiot.jpg', 1),
(28, '.5: The Gray Chapter', 'Slipknot', 15, 8, 'This is the 5th studio ablum from the world renowned heavy metal band.', 3, '.5-the-gray-chapter.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(4) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userAdmin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userName`, `userPass`, `userAdmin`) VALUES
(1, 'admin', '$2y$10$BeiZZHvTO5NdZzRnoJJoUO7h2w56h20Qns5lacY9SotYcUwPy1loi', 1),
(8, 'test', '$2y$10$JHtw.2p9vZOOBo6bemLKuum7vLBUVaSIndMO8IR7gzYKIE1UvUK2m', 0),
(9, 'user1', '$2y$10$hojqLWmZxVOHwu86V9rOq.n1ZTxwUVVSOuKX3BSbA/jXcz4fHZH42', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`listID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `listID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
