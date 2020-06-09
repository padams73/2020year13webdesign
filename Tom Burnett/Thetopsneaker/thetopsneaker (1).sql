-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 03:44 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thetopsneaker`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandid` int(2) NOT NULL,
  `brand` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandid`, `brand`) VALUES
(1, 'Nike'),
(2, 'Adidas');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(5) NOT NULL,
  `userid` int(4) NOT NULL,
  `productid` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `userid`, `productid`) VALUES
(32, 20, 2),
(34, 19, 6),
(35, 30, 6),
(48, 34, 2),
(49, 34, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(8) NOT NULL,
  `image` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `blurb` varchar(1000) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `brandid` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `image`, `name`, `blurb`, `price`, `brandid`) VALUES
(1, '97-blue.jpg', 'Nike Air Max 97 \"Indigo Storm\"', 'After a first look surfaced late last year, atmos has now released a closer look at Nike‘s upcoming Air Max 97 “Have a Nike Day.” The sneaker is wrapped in a tonal blue upper, constructed from mesh, nubuck and canvas in different shades of blue ranging from light to dark.\r\n\r\nThe stand-out feature of the silhouette — and the inspiration for its name — is the “Have a Nike Day” taping that wraps around the entire shoe. The sneaker is then finished with white embroidered Swoosh branding, a full-length white midsole, a blue air unit and a Swoosh-adorned smiley face on the lacing unit.', '445.04', 1),
(2, '97-white.jpg', 'Nike Air Max 97 \"Triple White\"', 'Continuing its focus on the fairway, Nike Golf is now preparing a “Triple White” colorway of the Air Max 97 G.\r\n\r\nReimagined for the links, the latest take on the lifestyle classic expresses a clean tonal white leather and mesh upper construction. Branding on the shoe comes in the form of subtle grey Swooshes on the lower midfoot, tongue badge, “AIR MAX” embroidered heel tab and printed insoles. Elevating the shoe is a phylon midsole assisted by a full-length Air Max cushioning unit and paired with a contrasting grey toothy rubber outsole for enhanced grip on the course.', '217.12', 1),
(3, '97-team-red.jpg', 'Nike Air Max 95 \"Team Red\"', 'Nike’s Air Max 95 model is one classic Swoosh runner that has seen its fair share of colorway renditions just this year alone. One of the latest models to join the storied catalog is this Air Max 95 “Wolf Grey/Team Red” rework. The signature grey hue lands on the eyestay and outsole area, while hits of white can be found on the toe, side panels and midsole. Lively pops of red seen on the side panel region and tongue tag branding finish off the new design. While release dates and locations have yet to be confirmed, be sure to check back for more details.', '305.69', 1),
(4, 'yeezy-cloud.jpg', 'Yeezy Boost 350 V2 \"Cloud White\" [Reflective]', 'The adidas YEEZY BOOST 350 V2 “Cloud White” lends itself to a dreamy combination of white, light blue and grey tones along the upper and across the laces with a mix of primeknit patterns weaving above the midsole. With a translucent monofilament side stripe and classic gum midsole coated in a thick white hue, the boost technology hides in the ridged sole for signature comfort and consistent design aesthetic. Just like recent YEEZY BOOST 350 V2 releases, the adidas YEEZY BOOST 350 V2 “Cloud White” will also be offered in a “Cloud White Reflective” variation at a later date.', '497.97', 2),
(5, 'offwhite-vapormax.jpg', 'Off White x Nike VaporMax 2018 \"White\"', 'Despite the Virgil Abloh x Nike’s “The Ten” collection being behind us, that hasn’t stopped the rumor mill from generating a discussion of what’s next to come from the partnership. Following a selection of leaked pictures of the collaborative Air VaporMax in a white colorway, an additional image has surfaced which can easily lead many to believe that the joint project has a sequel on the horizon. The aforementioned Air VaporMax is paired with a red zip-tie and marker both being presented on a background that channels the popular DIY aesthetic.', '1283.26', 1),
(6, 'yeezy-black-product.jpg', 'Yeezy Boost 350 V2 \"Static Black\" [Non Reflective]', 'One of the standout features of the non-reflective YEEZY BOOST 350 V2 “Static Black,” originally known as the “Pirate Black,” is the fully blacked-out design of the silhouette that seems to draw people in. With a black upper, black midsole and a black sole, the only hints of color on the sneaker appear upon the heel pull tab, which sees a bit of bright red stitching for a subtle pop. Additionally, the shoe is covered in Primeknit on the upper with adidas BOOST technology on the midsole and laces. Rounding out the offering, the sneaker features a translucent side strip where the SPLY-350 branding usually sits and a rubber outsole. Another option for those who want to flex even brighter on this Black Friday is the more limited Reflective YEEZY BOOST 350 V2 Statics.', '1342.67', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(2) NOT NULL,
  `user` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `user`, `password`) VALUES
(32, 'a', '$2y$10$6OS/1JRWCoufdi0OVuLw8OBhiJ/hDIr/Y.f/olqRSHCBhT9Qj.F3i'),
(33, 'qq', '$2y$10$qQumAFPO9vnBuaeDDC3FQ.FAO0VyoZPIpcLN1DAIi/elCgpgyFN36'),
(34, 'tt', '$2y$10$9d/ylu61G2iFJsxXxCLR1eHppmTQC9PoqFn5nuIUIviDMwGFwRklO'),
(35, 'username', '$2y$10$/1I7rF52lIAkLMg5QTIthepfxEeb5PRa237ecvSmHUaWgkIQX90sW'),
(36, 'tij', '$2y$10$D4gR1wpIeK9ll0l5vT75IOOb2m.pNCqyabQfMBIGU3sOk6Lo0cd9O'),
(37, 'Admin', '$2y$10$hLblxBrL8diajUlS2R6eoO5FhxQqiynGx1aHQ/uKaN3IeDP8Isp1O');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
