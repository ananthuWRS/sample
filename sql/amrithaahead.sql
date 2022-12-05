-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2022 at 06:56 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `ah_task_category`
--

CREATE TABLE `ah_task_category` (
  `task_categoryid` int(11) NOT NULL,
  `tc_name` text NOT NULL,
  `tc_addedby` int(11) NOT NULL,
  `tc_addedon` datetime NOT NULL,
  `tc_updatedon` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tc_status` tinyint(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ck_authentication`
--

CREATE TABLE `ck_authentication` (
  `authenticationid` int(11) NOT NULL,
  `au_crickus` varbinary(200) NOT NULL,
  `au_crickp` text DEFAULT NULL,
  `au_crickf` varbinary(200) NOT NULL,
  `au_crickl` varbinary(200) NOT NULL,
  `au_crickpn` varbinary(200) NOT NULL,
  `au_cricke` varbinary(200) DEFAULT NULL,
  `au_cricka` varbinary(200) DEFAULT NULL,
  `au_createdon` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `au_usertype` int(11) NOT NULL,
  `au_status` tinyint(2) NOT NULL DEFAULT 0,
  `au_salt` varchar(255) DEFAULT NULL,
  `au_createdby` int(11) NOT NULL,
  `au_designation` int(11) DEFAULT NULL,
  `au_emailverification` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ck_authentication`
--

INSERT INTO `ck_authentication` (`authenticationid`, `au_crickus`, `au_crickp`, `au_crickf`, `au_crickl`, `au_crickpn`, `au_cricke`, `au_cricka`, `au_createdon`, `au_usertype`, `au_status`, `au_salt`, `au_createdby`, `au_designation`, `au_emailverification`) VALUES
(1, 0x5b77fa5a540c0d9d967ac2c04e15052a, '7625ce4c99fc9933b3aab914c5979de3', 0x5b77fa5a540c0d9d967ac2c04e15052a, 0x5b77fa5a540c0d9d967ac2c04e15052a, 0x2d2718b47cb21a84df3428b14b288574, 0x05f45e1bfccbbb12de98804e4230ca765ac06bcdd7eb6e95b853493e5a4cf7cf, 0x9b5aa9e0cee8769b1b968ed959a2fe5a90bdf53b72d56f89e64fb1c8342dbb2e, '2022-10-18 12:19:15', 1, 0, 'IHeX4KTGWmY7pc9P', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ck_usertype`
--

CREATE TABLE `ck_usertype` (
  `usertypeid` int(11) NOT NULL,
  `ut_name` varchar(255) NOT NULL,
  `ut_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ck_usertype`
--

INSERT INTO `ck_usertype` (`usertypeid`, `ut_name`, `ut_status`) VALUES
(1, 'Admin', 0),
(2, 'Teaching Staff', 0),
(3, 'Non Teaching Staff', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ah_task_category`
--
ALTER TABLE `ah_task_category`
  ADD PRIMARY KEY (`task_categoryid`);

--
-- Indexes for table `ck_authentication`
--
ALTER TABLE `ck_authentication`
  ADD PRIMARY KEY (`authenticationid`),
  ADD KEY `au_usertype` (`au_usertype`);

--
-- Indexes for table `ck_usertype`
--
ALTER TABLE `ck_usertype`
  ADD PRIMARY KEY (`usertypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ah_task_category`
--
ALTER TABLE `ah_task_category`
  MODIFY `task_categoryid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ck_authentication`
--
ALTER TABLE `ck_authentication`
  MODIFY `authenticationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `ck_usertype`
--
ALTER TABLE `ck_usertype`
  MODIFY `usertypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
