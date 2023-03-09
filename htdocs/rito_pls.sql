-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 08:58 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rito_pls`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `username`, `password_hash`, `is_admin`) VALUES
(2, 'admin', '$2y$10$uyZSavkq54sdWKMAlrZlG.hc1Bknb7w.ra3HPqEyIge6XcbDMrMfW', 1),
(5, 'emp1', '$2y$10$d1H8AWjElRe1FDsLGELGUueGo8pYLS3UaAQBV6/UPhik5QEjgeJnm', 0),
(6, 'emp3', '$2y$10$51qFpGaeQINVAr.0wDldPummwJ2o2bijcE2go1xeF3SXYtrgMKVWa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `skin`
--

CREATE TABLE `skin` (
  `skin_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `champion` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `discount` decimal(2,2) DEFAULT NULL,
  `sold` int(11) DEFAULT NULL,
  `image` varchar(50) DEFAULT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skin`
--

INSERT INTO `skin` (`skin_id`, `name`, `champion`, `description`, `price`, `discount`, `sold`, `image`, `available`) VALUES
(1, 'Beemo', 'Teemo', 'teemo in a cute bee costume', 1350, '0.90', 135, '5eae370c9a924.jpg', 1),
(4, 'Elementalist Lux', 'Lux', 'many forms', 3250, '0.00', NULL, '5eaf8e3e08343.jpg', 1),
(7, 'Final Boss Veigar', 'Veigar', 'scary', 1820, '0.10', 5278, '5eb0a50196353.jpg', 1),
(8, 'Cottontail Teemo', 'Teemo', 'cute', 975, NULL, 975, '5eb0a57f3d8ee.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `skin_owned`
--

CREATE TABLE `skin_owned` (
  `user_id` int(11) NOT NULL,
  `skin_id` int(11) NOT NULL,
  `in_cart` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skin_owned`
--

INSERT INTO `skin_owned` (`user_id`, `skin_id`, `in_cart`) VALUES
(1, 1, 0),
(1, 4, 0),
(1, 7, 0),
(2, 4, 0),
(2, 7, 0),
(3, 1, 0),
(3, 4, 0),
(3, 7, 0),
(3, 8, 0),
(4, 1, 0),
(4, 4, 0),
(4, 7, 0),
(5, 1, 0),
(5, 4, 0),
(5, 7, 0),
(6, 7, 0),
(7, 7, 0),
(8, 1, 0),
(8, 4, 1),
(8, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `opened_on` date NOT NULL,
  `closed_on` date DEFAULT NULL,
  `status` enum('Open','Pending','Closed') NOT NULL DEFAULT 'Open'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_detail`
--

CREATE TABLE `ticket_detail` (
  `ticket_detail_id` int(11) NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `sent_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password_hash` varchar(72) NOT NULL,
  `riot_points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password_hash`, `riot_points`) VALUES
(1, 'wow1', '$2y$10$A1nNENlCZSOrjqLzc27p9.8vV3JFj8Dn2obmOYl17DeJ.pkLsCJoS', 60),
(2, 'wow2', '$2y$10$vM9YugiF.GqEZ6Xr5Qge4.ikkgKOo/HDpvYF.YWmoJO7MMh/1cfji', 5930),
(3, 'wow3', '$2y$10$nZWDJv19dloWwj0dQArj1O2cItDt7qQNtMQ7Po1tROwkD0w2kkKzy', 10560),
(4, 'wow5', '$2y$10$ziXAEwnq0fa9uhp4rBvaNukHE4G9M6ts/JUr5EpoP5shBgjGkMxdK', 5795),
(5, 'wow4', '$2y$10$yUqahSTu4vLIfD5y5ypIEOjh31NRVKKCw/vfYWUOFRlHEIo4xj4oC', 5795),
(6, 'wow6', '$2y$10$lly6xeEt9wgHsqFbSkVepudt2nOPsDzZQGO298HYVcw/2q60QZ7ne', 9180),
(7, 'wow7', '$2y$10$ZdlqXVlV1V9HnLeEfQR4V.IJ0oZxCPMNKQs11cn4cQenAmDvjhDWi', 9362),
(8, 'wow8', '$2y$10$qlnS.Bn0sIOTLUKao0rYl.a/pYi8oaMWZXhnJ3hvQQPZ1pzgQ7pFO', 3570);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `skin`
--
ALTER TABLE `skin`
  ADD PRIMARY KEY (`skin_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `image` (`image`);

--
-- Indexes for table `skin_owned`
--
ALTER TABLE `skin_owned`
  ADD PRIMARY KEY (`user_id`,`skin_id`),
  ADD KEY `skin_owned_to_skin` (`skin_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_to_user` (`requested_by`);

--
-- Indexes for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  ADD PRIMARY KEY (`ticket_detail_id`),
  ADD KEY `ticket_detail_to_ticket` (`ticket_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skin`
--
ALTER TABLE `skin`
  MODIFY `skin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  MODIFY `ticket_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skin_owned`
--
ALTER TABLE `skin_owned`
  ADD CONSTRAINT `skin_owned_to_skin` FOREIGN KEY (`skin_id`) REFERENCES `skin` (`skin_id`),
  ADD CONSTRAINT `skin_owned_to_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_to_user` FOREIGN KEY (`requested_by`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `ticket_detail`
--
ALTER TABLE `ticket_detail`
  ADD CONSTRAINT `ticket_detail_to_ticket` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
