-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 11:28 AM
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
-- Table structure for table `ah_rating_option`
--

CREATE TABLE `ah_rating_option` (
  `rating_option_id` int(11) NOT NULL,
  `rating_option_title` varchar(200) NOT NULL,
  `rating_option_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=active,1=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ah_rating_option`
--

INSERT INTO `ah_rating_option` (`rating_option_id`, `rating_option_title`, `rating_option_status`) VALUES
(1, 'Needs Improvement', 0),
(2, 'Average', 0),
(3, 'Good', 0),
(4, 'Very Good', 0),
(5, 'Excellent', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ah_rating_option`
--
ALTER TABLE `ah_rating_option`
  ADD PRIMARY KEY (`rating_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ah_rating_option`
--
ALTER TABLE `ah_rating_option`
  MODIFY `rating_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
