-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 02:24 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `challengeme`
--

-- --------------------------------------------------------

--
-- Table structure for table `bets`
--

CREATE TABLE `bets` (
  `challengeID` int(5) NOT NULL COMMENT 'The ID used to identify individual challenges',
  `userID` int(5) NOT NULL COMMENT 'The ID of the user whos placed a bet',
  `betID` int(20) NOT NULL COMMENT 'The main key for identifying individual bets',
  `pickedID` int(5) NOT NULL COMMENT 'The userID of the user who is''betted''on',
  `winnerID` int(5) DEFAULT NULL COMMENT 'UserID of the user who won the challenged which was betted on'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bets`
--

INSERT INTO `bets` (`challengeID`, `userID`, `betID`, `pickedID`, `winnerID`) VALUES
(54, 39, 29, 30, NULL),
(54, 36, 35, 8, NULL),
(67, 30, 38, 30, NULL),
(67, 31, 39, 26, 19),
(68, 26, 40, 26, NULL),
(68, 26, 41, 26, NULL),
(68, 26, 42, 26, NULL),
(54, 8, 51, 26, NULL),
(54, 8, 52, 26, NULL),
(49, 26, 69, 39, NULL),
(49, 26, 71, 39, NULL),
(49, 26, 72, 1, NULL),
(49, 26, 73, 1, NULL),
(49, 26, 74, 1, NULL),
(49, 26, 75, 1, NULL),
(42, 26, 76, 20, NULL),
(42, 26, 77, 20, NULL),
(54, 26, 78, 8, NULL),
(72, 19, 79, 3, NULL),
(54, 19, 80, 30, NULL),
(42, 19, 81, 5, NULL),
(71, 19, 82, 26, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `userOneID` int(5) NOT NULL COMMENT 'UseriD of th first user ivolved in the challenge',
  `userTwoID` int(5) NOT NULL COMMENT 'UseriD of the 2nd user ivolved in the challenge',
  `winnerID` int(5) DEFAULT NULL COMMENT 'UserID of the user who won the challenge',
  `challengeID` int(6) NOT NULL COMMENT 'The main key for identifying individual challenges',
  `date` date NOT NULL COMMENT 'date of challenge',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT 'status of challenge (e.g. active, pending etc.)',
  `creatorID` int(5) NOT NULL COMMENT 'userID of the user whocreated the chalenge'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`userOneID`, `userTwoID`, `winnerID`, `challengeID`, `date`, `status`, `creatorID`) VALUES
(5, 20, 20, 42, '1112-08-22', 1, 5),
(19, 5, 5, 43, '8772-07-08', 1, 19),
(1, 3, 3, 45, '2211-02-11', 2, 1),
(26, 19, 26, 46, '1221-07-12', 2, 19),
(19, 26, 19, 47, '3333-05-31', 2, 24),
(39, 1, NULL, 49, '3222-03-22', 1, 39),
(8, 30, 30, 54, '1111-11-11', 1, 30),
(19, 26, 26, 67, '2222-02-22', 2, 19),
(31, 26, 26, 68, '8888-08-08', 0, 50),
(57, 26, 57, 71, '3333-03-31', 1, 57),
(3, 26, NULL, 72, '2222-03-23', 1, 26);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL COMMENT 'The main key for identifying individual users',
  `username` varchar(20) NOT NULL COMMENT 'username of user',
  `firstName` varchar(15) NOT NULL COMMENT 'first name of user',
  `lastName` varchar(15) NOT NULL COMMENT 'last name of user',
  `userWins` int(6) DEFAULT '0' COMMENT 'number of wins for each user',
  `userPoints` int(6) DEFAULT '0' COMMENT 'points for each user (determined by usering bets)',
  `password` varchar(400) NOT NULL COMMENT 'password for user acounts',
  `level` int(1) NOT NULL DEFAULT '0' COMMENT 'level of user acces (e.g. admin or user)',
  `totalChallenges` int(8) DEFAULT '0' COMMENT 'number of challenges user has been in',
  `status` varchar(400) DEFAULT 'this user hasn''t added a status' COMMENT 'user status on profile'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `firstName`, `lastName`, `userWins`, `userPoints`, `password`, `level`, `totalChallenges`, `status`) VALUES
(1, 'omrikepes', 'Omri', 'Kepes', 25, 100, 'yes', 0, 33, ''),
(3, 'topranking', 'Hayley', 'Johnston', 2, 10, 'cvgbhnj', 0, 3, ''),
(5, 'yonnikepes', 'Yonni', 'Kepes', 68, 66, 'cvgbhjn', 0, 72, 'My names yonni and im 18'),
(8, 'XaverLetgo', 'Xavier', 'McMillian', 57, 556, 'a', 0, 64, ''),
(9, 'jamescollens', 'James', 'Collens', 5, 46, 'cfgvbhjnh7u3herf87yhr', 0, 10, ''),
(10, 'winnerwinner', 'Lilly', 'Fitser', 7, 70, 'hfchjbng', 0, 9, 'Top 3 here I come!'),
(19, 'emilytyrrell', 'Emily', 'Tyrrell', 53, 15, '$2y$10$/tsfQ4Fs3RUSv5pZTNGo9eMeacPxWS1bxzgTLeIfz0U.m6Nau.cre', 0, 71, 'emily tyrrels status is here, first user lets go'),
(20, 'benkepes', 'ben', 'kepes', 4, 0, '$2y$10$LXMXxD.ObRzhHC6Ao3w0HO/i9Cu5QWf1BFcmYuRtIHVNTRq9rPcbW', 0, NULL, ''),
(23, 'extrcyubnyuvt', 'Sam', 'Croot', 1, 0, '$2y$10$KMqB85gpd2v190FesDPNI.8BU25AwDs.KyK4OJuuQJ8pXrddlWcBm', 0, 2, 'this user hasn\'t added a status'),
(26, 'user', 'user', 'user', 28, 0, '$2y$10$QoFu3rFX50D98Go5wuY/meSiHzu6bN8EPm7V5UW7hOIMKkm7u0YBy', 0, 78, 'this is my status\r\n'),
(28, 'randomperson', 'firght', 'kdkjkwef', 0, 0, '$2y$10$EuwyVtvVS9Fsa24mf8m6AOPM1IKzP1mqBgg1HbJb95af.aSQLENeK', 0, 0, 'this user hasn\'t added a status'),
(30, 'blahblah', 'poo', 'face', 5, 0, '$2y$10$7IkdSFfSo02NS/36ytJjUeVe2vA4KckNZ2565SxG38br6HHEhtUxG', 0, 9, 'retarded.'),
(31, 'em', 'em', 'em', 0, 0, '$2y$10$3lGNt9.Jgr//CtFDzCHQQuCzPPfVK3.QhgrRMjPRItGSr6UnNTE4K', 0, 0, 'this user hasn\'t added a status'),
(36, 'jordan', 'jordan', 'jordan', 0, 0, '$2y$10$soVK7Pth5b8eHAh2UERoieHuelzxAP8HsTtkvVIONBPen5f4PJdVa', 0, 0, 'this user hasn\'t added a status'),
(39, 'me', 'OMRI', 'KEPES', 0, 0, '$2y$10$5FzHto5auUZ/TRNgD7.Qxu54HKW6aa9KeRV6gbkKFJqhHz3soLWcS', 0, 0, 'uewbhsbkasnadsjndahuasd'),
(57, 'admin', 'admin', 'admin', 0, 0, '$2y$10$aEG/XZg6f8EsvTt/ugSIvOuaU8Da6pwg1lPd8CUWQm2TFDA33yvcO', 1, 0, 'this user hasn\'t added a status'),
(58, 'admin2', 'admin', 'admin', 0, 0, '$2y$10$T8HkfNKlKE4OsbzgXnb46uff2eUfZ9T1lQKPP.0YgfpVxHwn1RcfW', 1, 0, 'this user hasn\'t added a status'),
(60, 'hello', 'James', 'jordan', 0, 0, '$2y$10$Qhfb/jlzy2KpmBjR.Zaa9eAVWtNEHPzJAsomHfgVIyDimv1bYih.y', 0, 0, 'this user hasn\'t added a status');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bets`
--
ALTER TABLE `bets`
  ADD PRIMARY KEY (`betID`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`challengeID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bets`
--
ALTER TABLE `bets`
  MODIFY `betID` int(20) NOT NULL AUTO_INCREMENT COMMENT 'The main key for identifying individual bets', AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `challengeID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'The main key for identifying individual challenges', AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT COMMENT 'The main key for identifying individual users', AUTO_INCREMENT=61;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
