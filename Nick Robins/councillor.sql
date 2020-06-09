-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2020 at 01:30 AM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `councillor`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(15) NOT NULL,
  `message` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `phone`, `message`) VALUES
('', '', 0, ''),
('', '', 0, ''),
('sdfjsfdui', 'sdiuhfuidsb@oufsuibf', 20202020, 'sdfibsduibf'),
('', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsID` int(5) NOT NULL,
  `headline` varchar(200) NOT NULL,
  `date` varchar(50) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `userID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsID`, `headline`, `date`, `content`, `userID`) VALUES
(7, 'Nick Clapp Announcement', '2 June 2020', 'Nick Clapp is running for candidacy. As most of my readers know, I am an optimist.\r\n\r\nThis belief applies across my life, and to various investments as well. So I am intrigued by the success of cryptocurrencies, such as Bitcoin and Ethereum. The competition they are putting up against the gold standard looks insane, as Bitcoin goes off to the races.\r\n\r\nThere is no way to fully understand what is going on in the crypto world and I am not even sure anyone could if you tried to. Still, I can tell you that Bitcoins recent surge is really an opportunity to buy long term real assets.\r\n\r\nCryptocurrencies are new and do not even have a useful underlying technology. They will probably fail, probably sooner than later. If people forget about them quickly, it is likely to be because the underlying technology will finally mature and win out. We do not even know whether that will happen in a generation or maybe a century, but it is still possible it might.', 0),
(8, 'What is Clapps next move?', '4 June 2020', 'Nick Clapp has many tricks under his sleeve. There is a lot of talk about Bitcoin these days, as it crisscrosses the global financial market in increasingly exotic configurations. And here I mean intervenes the underlying blockchain technology is connected directly to the host currency At first glance, it would seem hard to understand why anyone would wish to hold a security that is not backed by a government or a central bank. But, look closer: The Bitcoin in question is nothing more than a machine a merchantless currency without all the responsibilities of, say, a bank or a chequing account. (Think of it as a form of trustless money.) In the Bitcoin universe, members can transfer, redeem and spend whatever Bitcoins they wish with no interference whatsoever from governments. Of course, there are all sorts of issues with blockchain-based currencies, as there are with every system of money that derives.', 0),
(9, 'Why Clapp is number one', '8 June 2020', 'Clapp is second to none. There are no two ways about that. This is because Nick Clapp is never second best, in fact he is always first best. Nick Clapp has many qualities capable of leading a council that will be very good. Do you back Nick Clapp? I know I would. Cryptocurrencies are new and do not even have a useful underlying technology. They will probably fail, probably sooner than later. If people forget about them quickly, it is likely to be because the underlying technology will finally mature and win out. We do not even know whether that will happen in a generation or maybe a century, but it is still possible it might.The crypto world is more than one day old, and a lot of its early enthusiasts are looking back at what they did wrong. But most are still in it. There is still a lot of potential, and potentially a lot of wealth to be made. Imagine the world right now, say 10 years from now. Have you invested in things like gold', 0),
(10, 'The latest and greatest: Nick Clapp', '7 June 2020', 'Nick Clapp is New Zealands Leading Council Candidate, and whilst never having been in the postiion, he will be very good. If you got bitcoin at a drop in the bucket, you could buy some property, maybe even a small business, and make enough money off it that it could pay for itself. But as with real estate, I would not want to be a long-term owner. I want to be able to live in the house I own for as long as possible and to rent it out while I am doing so.\r\n\r\nSo in the long run, I would favor buying some real estate or perhaps stocks, and getting some life insurance or a home equity line. For real estate, that is probably 15 to 20 years, and for stocks it is probably more like the next 30 years.\r\n\r\nBut in the long run, if you are going to be long-term buying the crypto economy, you should not be short-term speculating. You should own bitcoin or Ethereum, and be happy to be holding it for 10 to 20 years.', 0),
(12, 'Go Nick Clapp!', '25 May 2020', 'Who is this knight in shining armour they call Nick Clapp? If you got bitcoin at a drop in the bucket, you could buy some property, maybe even a small business, and make enough money off it that it could pay for itself. But as with real estate, I would not want to be a long-term owner. I want to be able to live in the house I own for as long as possible and to rent it out while I am doing so. So in the long run, I would favor buying some real estate or perhaps stocks, and getting some life insurance or a home equity line. For real estate, that is probably 15 to 20 years, and for stocks it is probably more like the next 30 years. But in the long run, if you are going to be long-term buying the crypto economy, you should not be short-term speculating. You should own bitcoin or Ethereum, and be happy to be holding it for 10 to 20 years. I put every ounce of trust I have in Nick Clapp, and I think you should too!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$XWbjHpW51A49ZjOamOhOTunMSVhCcDf0L.zW1efk5/neOBHirJBDe');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`name`, `email`, `phone`) VALUES
('', '', 0),
('', '', 0),
('', '', 0),
('', '', 0),
('nifhnsui', 'sdiuhfuih', 0),
('Nick Robins', 'nick', 222222222),
('test', 'test', 2147483647),
('wefjkb', 'sdjgib@fsfiub', 20202),
('', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
