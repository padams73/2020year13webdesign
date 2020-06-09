-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 04:18 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bounding salmon`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentID` int(2) NOT NULL,
  `postID` int(2) NOT NULL,
  `userID` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `date` date NOT NULL COMMENT 'This is the date that was sent through by the website'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `postID`, `userID`, `comment`, `date`) VALUES
(13, 1, 1, 'Hello', '2020-06-07'),
(16, 3, 1, 'Hello ', '2020-06-08'),
(28, 31, 2, 'Hello nice post!', '2020-06-09'),
(29, 3, 3, 'Hello', '2020-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `following`
--

CREATE TABLE `following` (
  `userID` int(2) NOT NULL COMMENT 'This is the ID of the user that wants to follow a table',
  `groupID` int(2) NOT NULL COMMENT 'This is the ID of the group that the user wants to follow'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `following`
--

INSERT INTO `following` (`userID`, `groupID`) VALUES
(1, 1),
(2, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groupID` int(2) NOT NULL,
  `userID` int(2) NOT NULL,
  `groupImage` varchar(50) NOT NULL COMMENT 'This is the location for the image file for the group',
  `groupDescription` varchar(200) NOT NULL,
  `upvotes` int(3) NOT NULL COMMENT 'This is how many upvotes the group has',
  `groupName` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupID`, `userID`, `groupImage`, `groupDescription`, `upvotes`, `groupName`, `date`) VALUES
(1, 1, 'fishingreport.jpg', 'Share your information about your latest fishing adventure here', 9, 'Fishing Reports', '2020-06-03'),
(2, 1, 'freshwater.jpg', 'All the info about freshwater fishing in NZ', 5, 'Freshwater', '2019-03-07'),
(3, 1, 'saltwater.jpg', 'All the info about saltwater fishing in NZ', 8, 'Saltwater', '2020-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `postID` int(2) NOT NULL,
  `userID` int(2) NOT NULL,
  `groupID` int(2) NOT NULL,
  `title` varchar(50) NOT NULL COMMENT 'This is the name of post',
  `date` date NOT NULL,
  `postContents` varchar(5000) NOT NULL,
  `postImage` varchar(50) NOT NULL,
  `upvotes` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`postID`, `userID`, `groupID`, `title`, `date`, `postContents`, `postImage`, `upvotes`) VALUES
(3, 2, 3, 'Salmon escape from Akaroa Salmon farm', '2020-06-06', 'Recently while fishing in akaroa we happened to catch an escaped Salmon', 'salmon.jpg', 11),
(21, 1, 3, 'Fishing around Mussel Farms', '2020-06-07', 'Hello has anyone had much luck fishing around mussel farms?', '', 3),
(32, 2, 3, 'This is a test sound', '2020-06-09', 'Weewoo', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(2) NOT NULL,
  `userImage` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userImage`, `username`, `password`, `admin`) VALUES
(1, 'profile.png', 'Admin', '$2y$10$rLWl4zcutYaSkvsdwGBxuOUKMl2/7QiulNkBradsD1q/qTJjhXovK', 1),
(2, 'sean.jpg', 'Sean', '$2y$10$rLWl4zcutYaSkvsdwGBxuOUKMl2/7QiulNkBradsD1q/qTJjhXovK', 0),
(3, 'andrew.jpg', 'Andrew', '$2y$10$Otq88tCmStlQJYux4pYtxugt6z1K5U48FH/yki5m/1Y7G1zcQM0DG', 0),
(4, 'andrei.png', 'Andrei', '$2y$10$vcQMJsFSxZaqIoBA5T6fK.FJEY9LJGQ6Qr5CpKTkDPf8CLKz4J5H.', 0),
(5, 'allan.PNG', 'lilboy', '$2y$10$qM9hwvBkg1oPsHZpQlBJt.EECItr6Zk.RM1RFRmITpVo8TiEz1iGq', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentID`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`postID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groupID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `postID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
