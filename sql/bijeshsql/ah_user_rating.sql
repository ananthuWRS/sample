-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 11:30 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amrithaahead`
--

-- --------------------------------------------------------

--
-- Table structure for table `ah_user_rating`
--

CREATE TABLE `ah_user_rating` (
  `rating_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `reporting_staff_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `rating_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ah_user_rating`
--
ALTER TABLE `ah_user_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `ah_user_rating_ibfk_1` (`staff_id`),
  ADD KEY `ah_user_rating_ibfk_2` (`reporting_staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ah_user_rating`
--
ALTER TABLE `ah_user_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ah_user_rating`
--
ALTER TABLE `ah_user_rating`
  ADD CONSTRAINT `ah_user_rating_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `ah_user_rating_ibfk_2` FOREIGN KEY (`reporting_staff_id`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
