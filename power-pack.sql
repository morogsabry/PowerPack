-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2021 at 02:41 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `power-pack`
--

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Telephone1` varchar(255) NOT NULL,
  `Telephone2` varchar(255) NOT NULL,
  `LocationEn` varchar(255) NOT NULL,
  `LocationAr` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `instgram` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `Email`, `Telephone1`, `Telephone2`, `LocationEn`, `LocationAr`, `facebook`, `instgram`, `twitter`) VALUES
(2, 'sales@powerpackegypt.com', '01004237741', '', '15 Salah Gawdat street – New Nozha - Cairo – Egypt', '١٥ شارع صلاح جودت - النزهة الجديدة - القاهرة - مصر', '#', '#', '#');

-- --------------------------------------------------------

--
-- Table structure for table `imagesofpages`
--

CREATE TABLE `imagesofpages` (
  `id` int(11) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `GroupId` varchar(255) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imagesofpages`
--

INSERT INTO `imagesofpages` (`id`, `imagePath`, `GroupId`) VALUES
(3, '603441214607_55.jpeg', 'qualitycontrol'),
(4, '464360489729_factory.jpeg', 'factory'),
(5, '910193597593_app1.jpg', 'applications'),
(6, '620837781491_product main.jpg', 'products'),
(7, '13154766231_mat.jpg', 'materials'),
(9, '316335383169_adv.jpg', 'advantages'),
(11, '904690360883_02.jpeg', 'machines'),
(13, '395629274747_01.jpeg', 'vision$mission');

-- --------------------------------------------------------

--
-- Table structure for table `productsen`
--

CREATE TABLE `productsen` (
  `ProductID` int(11) NOT NULL,
  `ProductNameEn` varchar(255) NOT NULL,
  `DescriptionEn` varchar(255) NOT NULL,
  `LocationEn` varchar(255) NOT NULL,
  `ProductNameAr` varchar(255) NOT NULL,
  `DescriptionAr` varchar(255) NOT NULL,
  `LocationAr` varchar(255) NOT NULL,
  `imagePath` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productsen`
--

INSERT INTO `productsen` (`ProductID`, `ProductNameEn`, `DescriptionEn`, `LocationEn`, `ProductNameAr`, `DescriptionAr`, `LocationAr`, `imagePath`) VALUES
(24, 'DOUBLE LAYER BAGS ', '( WOVEN + BOPP )', ' Port said – Egypt', 'شنط طبقتين ', '( منسوج + بولي بروبيلين )', ' بورسعيد – مصر', '262228812641_111.jpeg'),
(35, 'NONWOVEN SHOES BOX', '', ' Port said – Egypt', 'غطاء جزامه قماش غير منسوج', '', ' بورسعيد – مصر', '717235893531_222.jpeg'),
(36, 'DOUBLE LAYER', '( PAPER + NONWOVEN )', ' Port said – Egypt', 'شنطه طبقتين ', '(ورق + قماش غير منسوج)', ' بورسعيد – مصر', '766308685377_333.jpeg'),
(37, 'NONWOVEN SHOPPING BAGS', '', ' Port said – Egypt', 'شنط تسوق قماش غير منسوج', '', ' بورسعيد – مصر', '766593409689_prod1.jpg'),
(38, 'ULTRA SONIC NONWOVEN BAGS', '', ' Port said – Egypt', 'شنط قماش غير منسوجه', '( لحام الترا سونيك)', ' بورسعيد – مصر', '361997740187_prod2.jpg'),
(46, 'NONWOVEN BAGS WITH ZIPER', '', 'Port said – Egypt', 'شنطة قماش غير منسوجة ', '( لحام الترا سونيك + غلق ذاتي )', ' بورسعيد – مصر', '654470473907_prod3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `quations`
--

CREATE TABLE `quations` (
  `QID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `Response` varchar(255) NOT NULL,
  `DateQuestion` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `requseteden`
--

CREATE TABLE `requseteden` (
  `RequestID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Message` varchar(255) NOT NULL,
  `ConfirmOrder` varchar(255) NOT NULL,
  `DateOrder` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `ID` int(11) NOT NULL,
  `imagePath` varchar(255) NOT NULL,
  `GroupId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` (`ID`, `imagePath`, `GroupId`) VALUES
(2, '414273775349_02.jpeg', 1),
(3, '867542198003_11.png', 1),
(4, '610033290298_03.jpeg', 0),
(6, '909165162912_01.jpeg', 1),
(7, '373591842039_555.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `GroupID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Password`, `Email`, `Phone`, `Address`, `GroupID`) VALUES
(1, 'Admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'powerpack@gmail.com', '', '', 1),
(2, 'User', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'user@gmail.com', '01012756805', '3str El salam - Queen , Fesial', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imagesofpages`
--
ALTER TABLE `imagesofpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productsen`
--
ALTER TABLE `productsen`
  ADD PRIMARY KEY (`ProductID`),
  ADD UNIQUE KEY `ProductName` (`ProductNameEn`),
  ADD UNIQUE KEY `ProductNameAr` (`ProductNameAr`);

--
-- Indexes for table `quations`
--
ALTER TABLE `quations`
  ADD PRIMARY KEY (`QID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `requseteden`
--
ALTER TABLE `requseteden`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `ProductID` (`ProductID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imagesofpages`
--
ALTER TABLE `imagesofpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `productsen`
--
ALTER TABLE `productsen`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `quations`
--
ALTER TABLE `quations`
  MODIFY `QID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requseteden`
--
ALTER TABLE `requseteden`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quations`
--
ALTER TABLE `quations`
  ADD CONSTRAINT `quations_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `requseteden`
--
ALTER TABLE `requseteden`
  ADD CONSTRAINT `requseteden_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `productsen` (`ProductID`),
  ADD CONSTRAINT `requseteden_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
