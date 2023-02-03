-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 17, 2023 at 02:44 AM
-- Server version: 5.7.40-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amritha_ahead`
--

-- --------------------------------------------------------

--
-- Table structure for table `ah_campus`
--

CREATE TABLE `ah_campus` (
  `campus_id` int(11) NOT NULL,
  `campus_name` varchar(255) NOT NULL,
  `cp_addedon` datetime NOT NULL,
  `cp_addedby` int(11) NOT NULL,
  `cp_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `cp_status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_campus`
--

INSERT INTO `ah_campus` (`campus_id`, `campus_name`, `cp_addedon`, `cp_addedby`, `cp_updatedon`, `cp_status`) VALUES
(1, 'Cmbtr', '2022-11-04 12:42:23', 1, '2022-11-04 00:12:23', 0),
(2, 'mkd1', '2022-12-29 11:57:45', 1, '2022-12-28 23:28:53', 1),
(3, 'sa', '2022-12-30 13:03:39', 1, '2022-12-30 00:34:32', 1),
(4, 'mkd', '2022-12-30 13:08:49', 1, '2022-12-30 00:39:02', 1),
(5, 'mkd', '2022-12-30 13:09:41', 1, '2022-12-30 00:39:52', 1),
(6, 'amritapuri', '2023-01-06 09:50:43', 1, '2023-01-05 21:20:43', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_departments`
--

CREATE TABLE `ah_departments` (
  `departmentid` int(11) NOT NULL,
  `dp_name` varchar(255) NOT NULL,
  `dp_addedby` int(11) NOT NULL,
  `dp_addedon` datetime NOT NULL,
  `dp_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dp_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_departments`
--

INSERT INTO `ah_departments` (`departmentid`, `dp_name`, `dp_addedby`, `dp_addedon`, `dp_updatedon`, `dp_status`) VALUES
(1, 'fg', 1, '2022-11-03 14:10:22', '2022-11-03 01:40:27', 1),
(2, 'CS', 1, '2022-11-04 12:42:06', '2022-11-14 20:49:24', 1),
(3, 'Cs', 1, '2022-11-15 09:19:16', '2022-11-14 20:49:16', 0),
(4, 'CS 1', 1, '2022-12-29 11:48:51', '2022-12-28 23:21:59', 1),
(5, 'CS 1', 1, '2022-12-29 11:52:13', '2022-12-28 23:22:25', 1),
(6, 'CA', 1, '2022-12-29 15:07:32', '2022-12-29 02:39:16', 0),
(7, 'ASW', 1, '2022-12-30 12:41:14', '2022-12-30 00:14:08', 1),
(8, 'MCA', 1, '2022-12-30 12:41:39', '2022-12-30 00:11:39', 0),
(9, 'Els', 1, '2023-01-05 15:38:15', '2023-01-05 03:08:15', 0),
(10, 'Mechanical', 1, '2023-01-06 09:50:08', '2023-01-05 21:20:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_designation`
--

CREATE TABLE `ah_designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(225) NOT NULL,
  `dg_addedon` datetime NOT NULL,
  `dg_addedby` int(11) NOT NULL,
  `dg_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `dg_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_designation`
--

INSERT INTO `ah_designation` (`designation_id`, `designation_name`, `dg_addedon`, `dg_addedby`, `dg_updatedon`, `dg_status`) VALUES
(1, 'teacherr', '2022-12-15 17:01:50', 1, '2022-12-15 04:33:41', 1),
(2, 'teacher', '2022-12-15 17:03:48', 1, '2022-12-15 04:33:48', 0),
(3, 'sample', '2022-12-29 11:54:29', 1, '2022-12-28 23:26:20', 1),
(4, 'sample', '2022-12-29 12:16:46', 1, '2022-12-28 23:46:46', 0),
(5, 'Student', '2022-12-30 13:02:48', 1, '2022-12-30 00:32:48', 0),
(6, 'supporting staff', '2023-01-06 09:50:30', 1, '2023-01-05 21:20:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_location`
--

CREATE TABLE `ah_location` (
  `location_id` int(11) NOT NULL,
  `lo_name` varchar(225) NOT NULL,
  `lo_addedby` int(11) NOT NULL,
  `lo_addedon` datetime NOT NULL,
  `lo_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `lo_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_location`
--

INSERT INTO `ah_location` (`location_id`, `lo_name`, `lo_addedby`, `lo_addedon`, `lo_updatedon`, `lo_status`) VALUES
(1, 'Remote Location', 1, '2022-12-08 10:54:10', '2022-12-15 04:31:00', 0),
(2, 'From Campus', 1, '2022-12-08 10:54:10', '2022-12-15 04:31:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_programme`
--

CREATE TABLE `ah_programme` (
  `programmeid` int(11) NOT NULL,
  `pg_name` varchar(255) NOT NULL,
  `pg_addedon` datetime NOT NULL,
  `pg_addedby` int(11) NOT NULL,
  `pg_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pg_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_programme`
--

INSERT INTO `ah_programme` (`programmeid`, `pg_name`, `pg_addedon`, `pg_addedby`, `pg_updatedon`, `pg_status`) VALUES
(1, 'sdd', '2022-11-15 14:34:11', 1, '2022-11-15 02:04:22', 1),
(2, 't', '2022-11-15 14:59:20', 1, '2022-11-15 02:29:23', 1),
(3, 'meeting 1', '2022-12-29 12:02:06', 1, '2022-12-28 23:34:51', 1),
(4, 'meeting', '2022-12-30 13:12:57', 1, '2022-12-30 00:42:57', 0),
(5, 'oniline class', '2023-01-06 09:50:57', 1, '2023-01-05 21:20:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_rating_option`
--

CREATE TABLE `ah_rating_option` (
  `rating_option_id` int(11) NOT NULL,
  `rating_option_title` varchar(200) NOT NULL,
  `rating_option_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=active,1=deleted'
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

-- --------------------------------------------------------

--
-- Table structure for table `ah_stafflocation`
--

CREATE TABLE `ah_stafflocation` (
  `stafflocation_id` int(11) NOT NULL,
  `sl_staff_id` int(11) NOT NULL,
  `sl_location_type` int(11) NOT NULL,
  `sl_addedby` int(11) NOT NULL,
  `sl_addedon` datetime NOT NULL,
  `sl_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sl_start_date` datetime DEFAULT NULL,
  `sl_end_date` datetime DEFAULT NULL,
  `sl_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_stafflocation`
--

INSERT INTO `ah_stafflocation` (`stafflocation_id`, `sl_staff_id`, `sl_location_type`, `sl_addedby`, `sl_addedon`, `sl_updatedon`, `sl_start_date`, `sl_end_date`, `sl_status`) VALUES
(1, 58, 1, 1, '2022-12-15 17:25:30', '2022-12-15 04:55:54', '2022-12-16 00:00:00', '2022-12-20 00:00:00', 0),
(2, 53, 1, 53, '2022-12-20 00:02:30', '2022-12-19 11:32:30', '2023-01-01 00:00:00', '2022-12-20 00:00:00', 0),
(3, 53, 1, 43, '2022-12-26 14:51:25', '2022-12-26 02:21:25', '2022-12-29 00:00:00', '2022-12-30 00:00:00', 0),
(4, 53, 2, 43, '2022-12-26 14:51:25', '2022-12-26 02:23:00', '2022-12-29 00:00:00', '2022-12-30 00:00:00', 0),
(5, 59, 2, 1, '2022-12-29 12:19:50', '2022-12-29 00:48:17', '2023-01-05 00:00:00', '2023-01-05 00:00:00', 0),
(6, 59, 2, 1, '2022-12-29 13:16:53', '2022-12-29 00:48:17', '2023-01-05 00:00:00', '2023-01-05 00:00:00', 0),
(7, 60, 2, 1, '2022-12-30 14:19:19', '2022-12-30 01:49:19', '2022-12-31 00:00:00', '2023-01-04 00:00:00', 0),
(8, 60, 2, 1, '2022-12-30 14:30:11', '2022-12-30 02:00:30', '2023-01-09 00:00:00', '2023-01-07 00:00:00', 0),
(9, 61, 2, 1, '2022-12-30 14:36:21', '2022-12-30 02:06:21', '2023-01-02 00:00:00', '2022-12-15 00:00:00', 0),
(10, 62, 2, 1, '2022-12-30 14:38:37', '2022-12-30 02:08:37', '2023-01-11 00:00:00', '2022-12-08 00:00:00', 0),
(11, 63, 2, 1, '2022-12-30 14:41:57', '2022-12-30 02:11:57', '2023-01-21 00:00:00', '2022-12-16 00:00:00', 0),
(12, 64, 2, 1, '2022-12-30 14:43:54', '2022-12-30 02:16:22', '2023-01-27 00:00:00', '2023-01-13 00:00:00', 0),
(13, 65, 1, 1, '2023-01-05 16:25:04', '2023-01-05 03:55:04', '2023-01-17 00:00:00', '2023-01-18 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_staff_reporting_conn`
--

CREATE TABLE `ah_staff_reporting_conn` (
  `reportingid` int(11) NOT NULL,
  `rp_staffid` int(11) NOT NULL,
  `rp_reportingperson` int(11) NOT NULL,
  `rp_teamid` int(11) DEFAULT NULL,
  `rp_addedon` datetime NOT NULL,
  `rp_addedby` int(11) NOT NULL,
  `rp_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `rp_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_staff_reporting_conn`
--

INSERT INTO `ah_staff_reporting_conn` (`reportingid`, `rp_staffid`, `rp_reportingperson`, `rp_teamid`, `rp_addedon`, `rp_addedby`, `rp_updatedon`, `rp_status`) VALUES
(1, 44, 43, NULL, '2022-11-03 14:48:07', 1, '2022-11-03 02:18:07', 0),
(2, 46, 48, NULL, '2022-11-04 11:55:12', 1, '2022-11-03 23:25:12', 0),
(3, 53, 43, NULL, '2022-11-04 12:49:20', 1, '2023-01-06 01:10:08', 1),
(4, 53, 47, NULL, '2022-11-09 11:06:35', 1, '2022-11-08 22:36:35', 0),
(5, 53, 48, NULL, '2022-11-09 11:06:35', 1, '2022-11-08 22:36:35', 0),
(6, 53, 45, NULL, '2022-11-15 14:49:53', 1, '2022-11-29 21:04:50', 1),
(7, 53, 52, NULL, '2022-11-30 09:34:29', 1, '2022-11-29 21:04:29', 0),
(8, 53, 45, NULL, '2022-12-01 11:58:34', 1, '2022-11-30 23:28:34', 0),
(9, 58, 58, 4, '2022-12-29 12:07:04', 1, '2022-12-28 23:37:04', 0),
(10, 44, 47, 5, '2022-12-29 12:09:17', 1, '2022-12-28 23:39:17', 0),
(11, 45, 47, 5, '2022-12-29 12:09:17', 1, '2022-12-28 23:39:17', 0),
(12, 47, 47, 5, '2022-12-29 12:09:17', 1, '2022-12-28 23:39:17', 0),
(13, 59, 58, NULL, '2022-12-29 12:27:34', 1, '2022-12-28 23:57:34', 0),
(14, 59, 45, NULL, '2022-12-29 12:33:04', 1, '2022-12-29 00:03:25', 1),
(15, 45, 45, 6, '2022-12-30 13:17:47', 1, '2022-12-30 00:47:47', 0),
(16, 64, 45, NULL, '2022-12-30 14:55:11', 1, '2022-12-30 02:25:31', 1),
(17, 65, 44, NULL, '2023-01-05 16:28:25', 1, '2023-01-05 03:58:25', 0),
(18, 65, 65, 7, '2023-01-06 09:51:44', 1, '2023-01-05 21:22:21', 1),
(19, 65, 43, NULL, '2023-01-06 09:53:43', 1, '2023-01-05 21:23:43', 0),
(20, 43, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(21, 44, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(22, 46, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(23, 47, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(24, 48, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(25, 49, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(26, 50, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(27, 52, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(28, 53, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(29, 54, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(30, 56, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(31, 58, 45, 8, '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(32, 53, 43, NULL, '2023-01-06 15:24:39', 1, '2023-01-06 02:54:39', 0),
(33, 43, 53, 9, '2023-01-12 09:42:32', 1, '2023-01-11 21:12:32', 0),
(34, 53, 65, NULL, '2023-01-12 09:44:06', 1, '2023-01-11 21:14:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_staff_task_approved_details`
--

CREATE TABLE `ah_staff_task_approved_details` (
  `approveddetailsid` int(11) NOT NULL,
  `ad_staff_id` int(11) NOT NULL,
  `ad_task_id` int(11) NOT NULL,
  `ad_approved_date` date NOT NULL,
  `ad_approved_type` int(2) NOT NULL COMMENT '1=>approved,2=>rejected',
  `ad_approved_comment` text,
  `ad_approved_by` int(11) NOT NULL,
  `ad_addedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_staff_task_approved_details`
--

INSERT INTO `ah_staff_task_approved_details` (`approveddetailsid`, `ad_staff_id`, `ad_task_id`, `ad_approved_date`, `ad_approved_type`, `ad_approved_comment`, `ad_approved_by`, `ad_addedon`) VALUES
(1, 53, 10, '2022-12-20', 1, NULL, 43, '2022-12-19 22:10:33'),
(2, 47, 12, '2022-12-29', 2, NULL, 1, '2022-12-29 00:13:36'),
(3, 47, 12, '2022-12-29', 1, NULL, 1, '2022-12-29 00:14:06'),
(4, 47, 12, '2022-12-29', 1, NULL, 1, '2022-12-29 00:16:07'),
(5, 47, 12, '2022-12-29', 2, NULL, 1, '2022-12-29 00:18:05'),
(6, 46, 20, '2022-12-29', 2, NULL, 1, '2022-12-29 03:59:20'),
(7, 46, 20, '2022-12-29', 2, NULL, 1, '2022-12-29 04:02:28'),
(8, 46, 21, '2022-12-29', 2, NULL, 1, '2022-12-29 04:06:44'),
(9, 46, 21, '2022-12-29', 2, NULL, 1, '2022-12-29 04:08:46'),
(10, 46, 21, '2022-12-29', 2, NULL, 1, '2022-12-29 04:09:44'),
(11, 46, 22, '2022-12-29', 2, NULL, 1, '2022-12-29 04:21:01'),
(12, 46, 22, '2022-12-29', 2, NULL, 1, '2022-12-29 04:23:26'),
(13, 63, 24, '2022-12-30', 2, NULL, 1, '2022-12-30 03:18:54'),
(14, 63, 24, '2022-12-30', 1, NULL, 1, '2022-12-30 03:19:10'),
(15, 63, 24, '2022-12-30', 1, NULL, 1, '2022-12-30 03:20:54'),
(16, 63, 24, '2022-12-30', 2, NULL, 1, '2022-12-30 03:27:57'),
(17, 63, 24, '2022-12-30', 2, NULL, 1, '2022-12-30 03:28:17'),
(18, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:41:56'),
(19, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:42:26'),
(20, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:42:56'),
(21, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:43:26'),
(22, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:43:56'),
(23, 43, 27, '2023-01-05', 1, NULL, 1, '2023-01-05 03:44:27'),
(24, 43, 28, '2023-01-05', 1, NULL, 1, '2023-01-05 03:48:29'),
(25, 53, 26, '2023-01-05', 1, '', 43, '2023-01-05 04:00:49'),
(26, 53, 26, '2023-01-05', 1, '', 43, '2023-01-05 04:00:49'),
(27, 53, 29, '2023-01-05', 1, '', 43, '2023-01-05 04:05:32'),
(28, 44, 29, '2023-01-05', 2, '', 43, '2023-01-05 04:09:28'),
(29, 53, 32, '2023-01-12', 1, NULL, 43, '2023-01-11 20:51:34'),
(30, 53, 33, '2023-01-12', 1, NULL, 43, '2023-01-11 22:54:53'),
(31, 53, 34, '2023-01-12', 1, NULL, 43, '2023-01-11 22:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `ah_subcategory`
--

CREATE TABLE `ah_subcategory` (
  `subcategoryid` int(11) NOT NULL,
  `sc_categoryid` int(11) NOT NULL,
  `sc_name` varchar(255) NOT NULL,
  `sc_addedby` int(11) NOT NULL,
  `sc_addedon` datetime NOT NULL,
  `sc_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sc_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_subcategory`
--

INSERT INTO `ah_subcategory` (`subcategoryid`, `sc_categoryid`, `sc_name`, `sc_addedby`, `sc_addedon`, `sc_updatedon`, `sc_status`) VALUES
(1, 1, 'maths', 1, '2022-10-28 14:34:40', '2022-10-28 02:04:40', 0),
(2, 2, 'Physics', 1, '2022-11-04 12:29:29', '2022-11-03 23:59:29', 0),
(3, 3, 'BE', 1, '2022-11-04 12:41:10', '2022-11-04 00:11:10', 0),
(4, 4, 'Meeting with Director', 1, '2022-11-15 08:58:01', '2022-11-14 20:28:14', 1),
(5, 2, 'Physics', 1, '2022-11-15 09:13:59', '2022-11-14 20:43:59', 0),
(6, 2, 'Physics', 1, '2022-11-15 09:14:58', '2022-12-28 23:09:25', 1),
(7, 2, 'sample', 1, '2022-12-29 11:23:07', '2022-12-28 23:08:46', 1),
(8, 2, 'sa', 1, '2022-12-29 11:29:11', '2022-12-28 23:02:03', 1),
(9, 3, 'sample', 1, '2022-12-29 11:33:35', '2022-12-28 23:08:34', 1),
(10, 2, 'sa', 1, '2022-12-29 11:34:17', '2022-12-28 23:08:17', 1),
(11, 2, 'chemistry', 1, '2022-12-29 11:39:56', '2022-12-28 23:09:56', 0),
(12, 2, 'example', 1, '2022-12-30 12:30:23', '2022-12-30 00:00:23', 0),
(13, 18, 'sub new', 1, '2023-01-05 15:59:52', '2023-01-05 03:29:52', 0),
(14, 19, 'for new', 53, '2023-01-12 09:16:22', '2023-01-11 20:46:22', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_tasks`
--

CREATE TABLE `ah_tasks` (
  `taskid` int(11) NOT NULL,
  `task_category` int(11) NOT NULL,
  `task_subcategory` int(11) NOT NULL,
  `task_title` text NOT NULL,
  `task_details` longtext NOT NULL,
  `task_staffid` int(11) NOT NULL COMMENT 'added staff id (not assigned staff id)',
  `task_priority` enum('low','normal','urgent') DEFAULT NULL,
  `task_completed_percentage` int(11) NOT NULL,
  `task_date` date DEFAULT NULL,
  `task_end_date` date DEFAULT NULL,
  `task_status` int(2) DEFAULT '0' COMMENT '0=>active,1=>pending,2=>completed',
  `task_temids` varchar(255) DEFAULT NULL,
  `task_addedon` datetime NOT NULL,
  `task_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_addedby` int(11) NOT NULL,
  `task_active` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_tasks`
--

INSERT INTO `ah_tasks` (`taskid`, `task_category`, `task_subcategory`, `task_title`, `task_details`, `task_staffid`, `task_priority`, `task_completed_percentage`, `task_date`, `task_end_date`, `task_status`, `task_temids`, `task_addedon`, `task_updatedon`, `task_addedby`, `task_active`) VALUES
(1, 1, 1, 'Maths Assignments', 'Assignment Details', 43, 'urgent', 99, NULL, NULL, 0, NULL, '2022-11-03 14:07:30', '2022-11-04 00:37:09', 43, 0),
(2, 2, 2, 'Lab preparation', 'Prepare note for lab', 43, 'normal', 0, NULL, NULL, 0, NULL, '2022-11-04 12:10:00', '2022-11-03 23:59:51', 43, 0),
(3, 1, 1, 'CS PROJECT', 'CS PROJECT FOR MCA', 43, 'normal', 0, NULL, NULL, 0, NULL, '2022-11-04 13:03:25', '2022-11-04 00:33:25', 43, 0),
(4, 2, 5, 'te', 'dertails', 43, 'normal', 0, '2022-11-22', '2022-12-01', 1, NULL, '2022-11-15 15:01:15', '2022-11-15 02:58:20', 43, 1),
(5, 2, 5, 'te2', 'ss', 43, 'urgent', 0, '2022-11-22', '2022-11-29', 2, NULL, '2022-11-15 15:05:37', '2022-11-22 00:16:42', 43, 0),
(6, 2, 2, 'Lab Assigment by NFONICS', 'DASdasdds', 1, 'normal', 0, '2022-11-17', '2022-11-19', 1, '2,3', '2022-11-15 15:42:41', '2022-11-15 03:16:57', 1, 0),
(7, 1, 1, 'MY OWN TASK', 'MY OWN TASK FOR MATHS', 43, 'normal', 0, '2022-11-15', '1970-01-01', 1, NULL, '2022-11-15 15:57:48', '2022-11-21 21:43:04', 43, 1),
(8, 2, 2, 'test', 'd', 43, 'urgent', 0, '2022-11-22', '2022-11-30', 0, NULL, '2022-11-22 10:13:46', '2022-12-26 22:25:44', 43, 1),
(9, 2, 11, 'dfgdft', 'fghfgh', 43, 'urgent', 0, '1970-01-01', '0000-00-00', 2, NULL, '2022-11-22 12:45:03', '2023-01-05 03:29:42', 43, 0),
(10, 2, 2, 'demo task', 'demo details', 53, 'normal', 0, '2022-11-04', '2022-11-07', 2, NULL, '2022-11-23 14:40:03', '2022-12-19 22:13:01', 53, 0),
(11, 2, 5, 'Lorem Ipsum', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 43, 'urgent', 0, '2022-12-10', '2022-12-12', 2, '', '2022-12-20 11:05:28', '2023-01-06 02:56:49', 43, 0),
(12, 2, 5, 'sample', '', 1, 'normal', 0, '2022-12-31', '2022-12-15', 0, '2,3', '2022-12-29 12:51:51', '2022-12-29 00:24:49', 1, 1),
(13, 3, 3, 'sample 1', '', 1, 'normal', 0, '2022-12-07', '2022-12-06', 0, '2', '2022-12-29 12:53:40', '2022-12-29 00:24:44', 1, 1),
(14, 2, 11, 'sample', '', 1, 'normal', 0, '2022-12-08', '2022-12-21', 0, '2,3', '2023-01-06 13:46:02', '2023-01-06 01:16:02', 1, 0),
(15, 3, 3, 'sample', '', 1, 'normal', 0, '2022-12-08', '2022-12-06', 0, '2,3', '2022-12-29 12:57:34', '2022-12-29 02:05:51', 1, 1),
(16, 3, 3, 'sample', 'jkjl', 1, 'normal', 0, '2022-12-16', '2022-12-13', 0, '2,3', '2022-12-29 13:06:19', '2022-12-29 02:05:46', 1, 1),
(17, 2, 5, 'sample', 'jhu', 1, 'normal', 0, '2022-12-31', '2023-01-05', 0, '1,2', '2022-12-29 13:08:22', '2022-12-29 02:05:36', 1, 1),
(18, 3, 3, 'sample', '', 1, 'urgent', 0, '2022-12-30', '2022-12-02', 0, '2', '2022-12-29 13:21:54', '2022-12-29 02:01:36', 1, 1),
(19, 3, 3, 'example', '', 1, 'low', 0, '2022-12-22', '2022-12-06', 0, NULL, '2022-12-29 13:23:28', '2022-12-29 02:01:16', 1, 1),
(20, 2, 11, 'sample', '', 1, 'normal', 0, '2022-12-30', '2022-12-19', 2, '', '2022-12-29 14:36:42', '2022-12-29 04:01:34', 1, 0),
(21, 3, 3, 'example', '', 1, 'urgent', 0, '2022-12-17', '0000-00-00', 1, '', '2022-12-29 16:36:28', '2022-12-29 04:08:17', 1, 0),
(22, 2, 5, 'new', '', 46, 'low', 0, '2022-12-02', '1970-01-01', 1, NULL, '2022-12-29 16:49:56', '2022-12-29 04:20:23', 46, 0),
(23, 2, 11, 'test', 'r', 1, 'urgent', 0, '2023-01-26', '2022-12-09', 0, NULL, '2022-12-30 14:56:36', '2022-12-30 02:26:36', 1, 0),
(24, 3, 3, 'sample1', 'daw', 1, 'normal', 0, '2023-01-12', '2022-12-16', 0, '', '2022-12-30 15:57:37', '2022-12-30 03:27:37', 1, 0),
(25, 3, 3, 'testing1', 'ghyj', 1, 'normal', 0, '2023-01-12', '2022-12-24', 0, '2,3', '2022-12-30 15:45:06', '2022-12-30 03:16:26', 1, 1),
(26, 3, 3, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a  ', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.\r\n\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 53, 'urgent', 0, '2023-01-11', '2023-02-01', 1, NULL, '2023-01-04 16:28:31', '2023-01-04 04:18:16', 53, 0),
(27, 18, 13, 'Testing', '', 43, 'normal', 0, '0000-00-00', '0000-00-00', 2, '', '2023-01-05 16:07:57', '2023-01-05 03:41:07', 1, 0),
(28, 18, 13, 'testing new', '', 43, 'urgent', 0, '2023-01-05', '2023-01-06', 2, NULL, '2023-01-05 16:15:48', '2023-01-05 03:47:37', 43, 0),
(29, 3, 3, 'ne wtask', '', 43, 'urgent', 0, '2023-01-05', '2023-01-10', 2, '', '2023-01-05 16:34:16', '2023-01-11 20:41:55', 43, 0),
(30, 3, 3, 'newtask', '', 1, 'urgent', 0, '2023-01-06', '2023-01-07', 1, '', '2023-01-06 13:54:23', '2023-01-06 01:27:54', 1, 0),
(31, 3, 3, 'newtask', '', 43, 'normal', 0, '2023-01-06', '2023-01-14', 0, NULL, '2023-01-06 14:03:37', '2023-01-06 01:33:37', 43, 0),
(32, 19, 14, 'New one', '', 53, 'urgent', 0, '2023-01-12', '2023-01-14', 2, NULL, '2023-01-12 09:16:56', '2023-01-11 21:01:46', 53, 0),
(33, 19, 14, 'sample4', '', 53, 'normal', 0, '2023-01-12', '2023-01-12', 2, NULL, '2023-01-12 11:24:03', '2023-01-11 22:55:11', 53, 0),
(34, 19, 14, 'sample5', '', 53, 'urgent', 0, '2023-01-13', '2023-01-13', 2, NULL, '2023-01-12 11:25:58', '2023-01-11 22:56:12', 53, 0),
(35, 19, 14, 'sample 6', '', 43, 'low', 0, '2023-01-13', '2023-01-13', 1, NULL, '2023-01-12 11:27:58', '2023-01-11 22:58:13', 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_task_category`
--

CREATE TABLE `ah_task_category` (
  `task_categoryid` int(11) NOT NULL,
  `tc_name` text NOT NULL,
  `tc_addedby` int(11) NOT NULL,
  `tc_addedon` datetime NOT NULL,
  `tc_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tc_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ah_task_category`
--

INSERT INTO `ah_task_category` (`task_categoryid`, `tc_name`, `tc_addedby`, `tc_addedon`, `tc_updatedon`, `tc_status`) VALUES
(1, 'Assignments', 1, '2022-10-27 16:26:58', '2022-11-18 22:32:59', 1),
(2, 'Lab', 1, '2022-10-28 15:02:39', '2022-11-03 23:59:19', 0),
(3, 'Online Course', 1, '2022-11-04 12:40:45', '2022-11-04 00:10:45', 0),
(4, 'Weekly Meetings', 1, '2022-11-15 08:52:50', '2022-11-22 00:01:50', 1),
(5, 'new', 1, '2022-12-03 12:34:52', '2022-12-03 00:05:11', 1),
(6, 'sample 1', 1, '2022-12-29 11:05:58', '2022-12-28 22:46:43', 1),
(7, 'sample ', 1, '2022-12-29 11:06:37', '2022-12-28 22:44:20', 1),
(8, 'sample1', 1, '2022-12-29 11:07:02', '2022-12-28 22:44:14', 1),
(9, 'sample 2', 1, '2022-12-29 11:07:50', '2022-12-28 22:44:11', 1),
(10, 'sample 3', 1, '2022-12-29 11:07:57', '2022-12-28 22:44:06', 1),
(11, 'sample 4', 1, '2022-12-29 11:08:04', '2022-12-28 22:44:03', 1),
(12, 'sample 5', 1, '2022-12-29 11:08:14', '2022-12-28 22:43:59', 1),
(13, 'sample 6', 1, '2022-12-29 11:08:23', '2022-12-28 22:43:40', 1),
(14, 'sample 7', 1, '2022-12-29 11:08:32', '2022-12-28 22:40:46', 1),
(15, 'SAm', 1, '2022-12-29 15:08:25', '2022-12-29 02:38:31', 1),
(16, 'sample', 1, '2022-12-30 12:09:09', '2022-12-29 23:39:09', 0),
(17, 'MAths', 1, '2022-12-30 12:42:58', '2022-12-30 00:13:19', 1),
(18, 'new', 1, '2023-01-05 15:59:29', '2023-01-05 03:29:29', 0),
(19, 'offline', 1, '2023-01-06 13:36:14', '2023-01-06 01:06:14', 0),
(20, 'xyz test', 43, '2023-01-15 00:57:21', '2023-01-14 12:27:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_task_staff`
--

CREATE TABLE `ah_task_staff` (
  `task_staff_addedid` int(11) NOT NULL,
  `tsa_staffid` int(11) NOT NULL,
  `tsa_taskid` int(11) NOT NULL,
  `tsa_completed_status` int(2) DEFAULT '0' COMMENT '0=>active,1=>pending,2=>completed ',
  `tsa_completed_percentage` int(11) DEFAULT NULL,
  `tsa_approved` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=>approved,2=>rejected',
  `tsa_approvedon` datetime DEFAULT NULL,
  `tsa_approved_by` int(11) NOT NULL DEFAULT '0',
  `tsa_comment` text,
  `tsa_addedon` datetime NOT NULL,
  `tsa_addedby` int(11) NOT NULL,
  `tsa_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_task_staff`
--

INSERT INTO `ah_task_staff` (`task_staff_addedid`, `tsa_staffid`, `tsa_taskid`, `tsa_completed_status`, `tsa_completed_percentage`, `tsa_approved`, `tsa_approvedon`, `tsa_approved_by`, `tsa_comment`, `tsa_addedon`, `tsa_addedby`, `tsa_status`) VALUES
(1, 43, 4, 1, 1, 0, NULL, 0, NULL, '2022-11-15 15:01:15', 43, 0),
(2, 53, 5, 2, 100, 1, '2022-11-22 12:53:33', 43, 'hfdhsdfh', '2022-11-15 15:05:37', 53, 0),
(3, 43, 6, 1, 20, 0, NULL, 0, NULL, '2022-11-15 15:42:41', 43, 0),
(4, 43, 7, 1, 99, 0, NULL, 0, NULL, '2022-11-15 15:57:48', 43, 0),
(5, 43, 8, 0, NULL, 0, NULL, 0, NULL, '2022-11-22 10:13:46', 43, 0),
(6, 43, 9, 2, 100, 0, NULL, 0, NULL, '2022-11-22 12:45:03', 43, 0),
(7, 53, 10, 2, 100, 1, '2022-12-20 10:40:33', 43, NULL, '2022-11-23 14:40:03', 53, 0),
(8, 53, 11, 2, 100, 0, NULL, 0, NULL, '2022-12-20 11:05:28', 53, 0),
(14, 59, 18, 0, 0, 0, NULL, 0, NULL, '2022-12-29 13:21:54', 1, 0),
(15, 59, 19, 0, 0, 0, NULL, 0, NULL, '2022-12-29 13:23:28', 1, 0),
(16, 46, 20, 2, 100, 2, '2022-12-29 16:32:28', 1, NULL, '2022-12-29 14:36:42', 46, 0),
(17, 46, 21, 1, 86, 2, '2022-12-29 16:39:44', 1, NULL, '2022-12-29 16:36:28', 46, 0),
(18, 46, 22, 1, 96, 2, '2022-12-29 16:53:26', 1, NULL, '2022-12-29 16:49:56', 46, 0),
(19, 64, 23, 0, 0, 0, NULL, 0, NULL, '2022-12-30 14:56:36', 1, 0),
(21, 47, 25, 0, 0, 0, NULL, 0, NULL, '2022-12-30 15:45:06', 1, 0),
(23, 63, 24, 0, 0, 2, '2022-12-30 15:58:17', 1, NULL, '2022-12-30 15:57:37', 1, 0),
(24, 53, 26, 1, 5, 1, '2023-01-05 16:30:49', 43, '', '2023-01-04 16:28:31', 53, 0),
(25, 43, 27, 2, 100, 1, '2023-01-05 16:14:27', 1, NULL, '2023-01-05 16:00:40', 43, 0),
(26, 43, 28, 2, 100, 1, '2023-01-05 16:18:29', 1, NULL, '2023-01-05 16:15:48', 43, 0),
(27, 44, 29, 0, 0, 2, '2023-01-05 16:39:28', 43, '', '2023-01-05 16:34:16', 43, 0),
(28, 53, 29, 2, 100, 1, '2023-01-05 16:35:32', 43, '', '2023-01-05 16:34:16', 53, 0),
(34, 43, 14, 0, 0, 0, NULL, 0, NULL, '2023-01-06 13:46:02', 1, 0),
(35, 47, 14, 0, 0, 0, NULL, 0, NULL, '2023-01-06 13:46:02', 1, 0),
(36, 57, 14, 0, 0, 0, NULL, 0, NULL, '2023-01-06 13:46:02', 1, 0),
(37, 45, 14, 0, 0, 0, NULL, 0, NULL, '2023-01-06 13:46:02', 1, 0),
(38, 48, 14, 0, 0, 0, NULL, 0, NULL, '2023-01-06 13:46:02', 1, 0),
(39, 43, 30, 1, 15, 0, NULL, 0, NULL, '2023-01-06 13:54:23', 43, 0),
(40, 43, 31, 0, NULL, 0, NULL, 0, NULL, '2023-01-06 14:03:37', 43, 0),
(41, 53, 32, 2, 100, 1, '2023-01-12 09:21:34', 43, NULL, '2023-01-12 09:16:56', 53, 0),
(42, 53, 33, 2, 100, 1, '2023-01-12 11:24:53', 43, NULL, '2023-01-12 11:24:03', 53, 0),
(43, 53, 34, 2, 100, 1, '2023-01-12 11:26:33', 43, NULL, '2023-01-12 11:25:58', 53, 0),
(44, 43, 35, 1, 50, 0, NULL, 0, NULL, '2023-01-12 11:27:58', 43, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_task_status_details`
--

CREATE TABLE `ah_task_status_details` (
  `task_details_id` int(11) NOT NULL,
  `td_staff_id` int(11) NOT NULL,
  `td_task_id` int(11) NOT NULL,
  `td_completion_percentage` int(11) NOT NULL DEFAULT '0',
  `td_execution_date` date NOT NULL,
  `td_hours` int(11) NOT NULL,
  `td_minutes` int(11) NOT NULL,
  `td_remarks` text,
  `td_addedon` datetime NOT NULL,
  `td_addedby` int(11) NOT NULL,
  `td_status` tinyint(2) NOT NULL DEFAULT '0',
  `td_approved` int(2) NOT NULL COMMENT '1=>approved,2=>rejected',
  `td_approved_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_task_status_details`
--

INSERT INTO `ah_task_status_details` (`task_details_id`, `td_staff_id`, `td_task_id`, `td_completion_percentage`, `td_execution_date`, `td_hours`, `td_minutes`, `td_remarks`, `td_addedon`, `td_addedby`, `td_status`, `td_approved`, `td_approved_id`) VALUES
(1, 43, 4, 1, '2022-11-23', 1, 1, 'ss', '2022-11-15 15:01:15', 43, 0, 0, 0),
(2, 43, 6, 10, '2022-11-15', 4, 25, 'ERWERWERWERWER\r\n', '2022-11-15 15:46:57', 43, 0, 0, 0),
(3, 43, 6, 10, '2022-11-16', 3, 30, '3.30', '2022-11-15 15:48:47', 43, 0, 0, 0),
(4, 43, 6, 20, '2022-11-17', 2, 30, '43345', '2022-11-15 15:49:09', 43, 0, 0, 0),
(5, 43, 7, 1, '2022-11-15', 3, 1, 'MY OWN TASK FOR MATHS', '2022-11-15 15:57:48', 43, 0, 0, 0),
(6, 43, 7, 99, '2022-11-17', 5, 0, 'Completed', '2022-11-15 15:58:30', 43, 0, 0, 0),
(7, 43, 9, 10, '2022-11-05', 1, 1, '', '2022-11-22 12:45:03', 43, 0, 0, 0),
(8, 43, 9, 15, '2022-11-08', 1, 1, '', '2022-11-22 12:45:03', 43, 0, 0, 0),
(9, 43, 9, 16, '2022-11-09', 1, 1, '', '2022-11-22 12:45:03', 43, 0, 0, 0),
(10, 53, 5, 100, '2022-11-05', 1, 1, '', '2022-11-22 12:46:42', 53, 0, 0, 0),
(11, 53, 10, 10, '2022-11-08', 1, 1, 'first status', '2022-11-23 14:40:03', 53, 0, 1, 1),
(12, 53, 10, 15, '2022-11-10', 1, 1, 'second', '2022-11-23 14:40:03', 53, 0, 1, 1),
(13, 53, 10, 100, '2022-12-22', 4, 0, 'Testing', '2022-12-20 10:43:01', 53, 0, 0, 0),
(14, 53, 11, 20, '2022-12-08', 4, 0, 'Testing', '2022-12-20 11:06:09', 53, 0, 0, 0),
(15, 53, 11, 25, '2022-12-29', 2, 0, 'Testing', '2022-12-20 11:07:51', 53, 0, 0, 0),
(16, 46, 20, 100, '2022-12-15', 3, 7, 'jyjyjh', '2022-12-29 16:31:34', 46, 0, 2, 7),
(17, 46, 21, 8, '2022-12-07', 2, 0, '', '2022-12-29 16:38:17', 46, 0, 2, 10),
(18, 46, 21, 86, '2022-12-20', 0, 0, '', '2022-12-29 16:39:26', 46, 0, 2, 10),
(19, 46, 22, 96, '2022-12-01', 0, 0, '', '2022-12-29 16:50:23', 46, 0, 2, 12),
(20, 53, 26, 4, '2023-01-04', 2, 0, '', '2023-01-04 16:48:16', 53, 0, 1, 25),
(21, 53, 26, 5, '2023-01-12', 1, 0, '', '2023-01-04 16:48:27', 53, 0, 1, 25),
(22, 43, 27, 20, '2023-01-21', 3, 1, '', '2023-01-05 16:10:37', 43, 0, 1, 18),
(23, 43, 27, 100, '2023-01-25', 2, 3, '', '2023-01-05 16:11:07', 43, 0, 1, 18),
(24, 43, 28, 30, '2023-01-05', 2, 1, '', '2023-01-05 16:16:54', 43, 0, 1, 24),
(25, 43, 28, 100, '2023-01-06', 2, 2, '', '2023-01-05 16:17:37', 43, 0, 1, 24),
(26, 43, 30, 15, '2023-01-06', 0, 15, '', '2023-01-06 13:57:54', 43, 0, 0, 0),
(27, 53, 11, 27, '2023-01-05', 4, 0, 'Testing', '2023-01-06 15:21:03', 53, 0, 0, 0),
(28, 53, 11, 100, '2023-01-06', 4, 0, 'Testing', '2023-01-06 15:26:49', 53, 0, 0, 0),
(29, 53, 29, 50, '2023-01-05', 4, 0, 'Testing', '2023-01-06 15:28:35', 53, 0, 0, 0),
(30, 53, 29, 100, '2023-01-12', 2, 2, '', '2023-01-12 09:11:55', 53, 0, 0, 0),
(31, 53, 32, 5, '2023-01-12', 1, 1, 'working', '2023-01-12 09:17:49', 53, 0, 1, 29),
(32, 53, 32, 100, '2023-01-14', 2, 3, 'completing', '2023-01-12 09:31:46', 53, 0, 0, 0),
(33, 53, 33, 100, '2023-01-12', 2, 2, '', '2023-01-12 11:25:11', 53, 0, 0, 0),
(34, 53, 34, 100, '2023-01-13', 3, 5, '', '2023-01-12 11:26:12', 53, 0, 1, 31),
(35, 43, 35, 50, '2023-01-13', 2, 3, '', '2023-01-12 11:28:13', 43, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_team`
--

CREATE TABLE `ah_team` (
  `teamid` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `team_addedon` datetime NOT NULL,
  `team_addedby` int(11) NOT NULL,
  `team_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `team_status` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_team`
--

INSERT INTO `ah_team` (`teamid`, `team_name`, `team_addedon`, `team_addedby`, `team_updatedon`, `team_status`) VALUES
(1, 'rerty', '2022-11-09 11:05:50', 1, '2022-11-08 22:35:50', 0),
(2, 'NFONICS Development Team', '2022-11-15 15:34:15', 1, '2022-11-15 03:05:24', 0),
(3, 'NFONCIS Lead Team', '2022-11-15 15:36:00', 1, '2022-11-15 03:06:00', 0),
(4, 'sampl', '2022-12-29 12:07:04', 1, '2022-12-28 23:38:54', 1),
(5, 'sample', '2022-12-29 12:09:17', 1, '2022-12-28 23:40:05', 1),
(6, 'sample', '2022-12-30 13:17:47', 1, '2022-12-30 00:48:06', 1),
(7, 'Testing', '2023-01-06 09:51:44', 1, '2023-01-05 21:21:44', 0),
(8, 'main', '2023-01-06 13:39:25', 1, '2023-01-06 01:09:25', 0),
(9, 'feature', '2023-01-12 09:42:32', 1, '2023-01-11 21:12:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ah_team_member`
--

CREATE TABLE `ah_team_member` (
  `team_memberid` int(11) NOT NULL,
  `tm_staffid` int(11) NOT NULL,
  `tm_teamid` int(11) NOT NULL,
  `tm_ishead` tinyint(2) NOT NULL DEFAULT '0' COMMENT '1=>head,0=>not head',
  `tm_status` tinyint(2) NOT NULL DEFAULT '0',
  `tm_addedon` datetime NOT NULL,
  `tm_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_team_member`
--

INSERT INTO `ah_team_member` (`team_memberid`, `tm_staffid`, `tm_teamid`, `tm_ishead`, `tm_status`, `tm_addedon`, `tm_updatedon`) VALUES
(1, 44, 1, 0, 0, '2022-11-09 11:05:50', '2022-11-08 22:35:50'),
(2, 46, 1, 0, 0, '2022-11-09 11:05:50', '2022-11-08 22:35:50'),
(3, 48, 1, 1, 0, '2022-11-09 11:05:50', '2022-11-08 22:35:50'),
(4, 43, 2, 0, 0, '2022-11-15 15:34:15', '2022-11-15 03:04:15'),
(5, 47, 2, 0, 0, '2022-11-15 15:34:15', '2022-11-15 03:04:15'),
(6, 48, 2, 1, 0, '2022-11-15 15:34:15', '2022-11-15 03:04:15'),
(7, 57, 2, 0, 0, '2022-11-15 15:34:15', '2022-11-15 03:04:15'),
(8, 46, 2, 1, 0, '2022-11-15 15:34:15', '2022-11-15 03:04:15'),
(9, 45, 3, 0, 0, '2022-11-15 15:36:00', '2022-11-15 03:06:00'),
(10, 48, 3, 0, 0, '2022-11-15 15:36:00', '2022-11-15 03:06:00'),
(11, 47, 3, 1, 0, '2022-11-15 15:36:00', '2022-11-15 03:06:00'),
(12, 58, 4, 1, 0, '2022-12-29 12:07:04', '2022-12-28 23:37:04'),
(13, 44, 5, 0, 0, '2022-12-29 12:09:17', '2022-12-28 23:39:17'),
(14, 45, 5, 0, 0, '2022-12-29 12:09:17', '2022-12-28 23:39:17'),
(15, 47, 5, 1, 0, '2022-12-29 12:09:17', '2022-12-28 23:39:17'),
(16, 45, 6, 1, 0, '2022-12-30 13:17:47', '2022-12-30 00:47:47'),
(17, 65, 7, 1, 0, '2023-01-06 09:51:44', '2023-01-05 21:21:44'),
(18, 43, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(19, 44, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(20, 46, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(21, 47, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(22, 48, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(23, 49, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(24, 50, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(25, 52, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(26, 53, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(27, 54, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(28, 56, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(29, 58, 8, 0, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(30, 45, 8, 1, 0, '2023-01-06 13:39:25', '2023-01-06 01:09:25'),
(31, 43, 9, 0, 0, '2023-01-12 09:42:32', '2023-01-11 21:12:32'),
(32, 53, 9, 1, 0, '2023-01-12 09:42:32', '2023-01-11 21:12:32');

-- --------------------------------------------------------

--
-- Table structure for table `ah_usertime`
--

CREATE TABLE `ah_usertime` (
  `usertime_id` int(11) NOT NULL,
  `ut_staff_id` int(11) NOT NULL,
  `ut_date` datetime NOT NULL,
  `ut_login_time` datetime NOT NULL,
  `ut_logout_time` datetime DEFAULT NULL,
  `ut_total_time` time DEFAULT NULL,
  `ut_json_time` json DEFAULT NULL,
  `ut_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ah_usertime`
--

INSERT INTO `ah_usertime` (`usertime_id`, `ut_staff_id`, `ut_date`, `ut_login_time`, `ut_logout_time`, `ut_total_time`, `ut_json_time`, `ut_status`) VALUES
(51, 43, '0000-00-00 00:00:00', '2022-12-30 16:32:32', NULL, NULL, NULL, 0),
(52, 53, '0000-00-00 00:00:00', '2023-01-02 10:50:04', NULL, NULL, NULL, 0),
(53, 53, '0000-00-00 00:00:00', '2023-01-02 11:11:58', '2023-01-02 11:12:20', '00:14:25', '[{\"pausedDate\": \"Mon Jan 02 2023 11:12:08 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:14:25\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(54, 53, '0000-00-00 00:00:00', '2023-01-02 11:13:40', '2023-01-02 11:14:04', '00:00:15', '[{\"pausedDate\": \"Mon Jan 02 2023 11:13:54 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:08\", \"resumeDate\": \"Mon Jan 02 2023 11:13:54 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 594}, {\"pausedDate\": \"Mon Jan 02 2023 11:13:55 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:08\", \"resumeDate\": \"Mon Jan 02 2023 11:13:55 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 713}, {\"pausedDate\": \"Mon Jan 02 2023 11:14:03 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:15\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(55, 53, '0000-00-00 00:00:00', '2023-01-02 11:14:35', '2023-01-02 11:16:11', '00:01:07', '[{\"pausedDate\": \"Mon Jan 02 2023 11:15:12 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:30\", \"resumeDate\": \"Mon Jan 02 2023 11:15:15 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 3306}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:17 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:32\", \"resumeDate\": \"Mon Jan 02 2023 11:15:25 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 8591}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:27 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:33\", \"resumeDate\": \"Mon Jan 02 2023 11:15:29 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2306}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:30 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:34\", \"resumeDate\": \"Mon Jan 02 2023 11:15:32 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2537}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:33 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:35\", \"resumeDate\": \"Mon Jan 02 2023 11:15:35 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2310}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:38 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:37\", \"resumeDate\": \"Mon Jan 02 2023 11:15:40 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2161}, {\"pausedDate\": \"Mon Jan 02 2023 11:15:43 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:40\", \"resumeDate\": \"Mon Jan 02 2023 11:15:46 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 3062}]', 0),
(56, 1, '0000-00-00 00:00:00', '2023-01-03 11:20:26', '2023-01-03 11:32:04', '00:09:18', 'null', 0),
(57, 53, '0000-00-00 00:00:00', '2023-01-03 11:24:45', '2023-01-03 11:25:11', '00:00:24', '[{\"pausedDate\": \"Tue Jan 03 2023 11:25:06 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:21\", \"resumeDate\": \"Tue Jan 03 2023 11:25:07 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1762}]', 0),
(58, 43, '0000-00-00 00:00:00', '2023-01-03 11:32:14', NULL, NULL, NULL, 0),
(59, 43, '0000-00-00 00:00:00', '2023-01-03 11:52:31', '2023-01-03 11:53:17', '00:00:41', 'null', 0),
(60, 43, '0000-00-00 00:00:00', '2023-01-03 11:53:57', '2023-01-03 11:54:12', '00:00:11', 'null', 0),
(61, 1, '0000-00-00 00:00:00', '2023-01-03 11:55:22', NULL, NULL, NULL, 0),
(62, 1, '0000-00-00 00:00:00', '2023-01-03 12:38:00', '2023-01-03 12:43:09', '00:29:57', 'null', 0),
(63, 43, '0000-00-00 00:00:00', '2023-01-03 12:43:14', '2023-01-03 13:35:18', '00:07:38', '[{\"pausedDate\": \"Tue Jan 03 2023 13:30:17 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:07:38\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(64, 1, '0000-00-00 00:00:00', '2023-01-03 14:38:06', '2023-01-03 15:57:06', '00:34:49', '[{\"pausedDate\": \"Tue Jan 03 2023 15:27:45 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:10:03\", \"resumeDate\": \"Tue Jan 03 2023 15:28:07 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 22976}]', 0),
(65, 43, '0000-00-00 00:00:00', '2023-01-03 15:57:13', NULL, NULL, NULL, 0),
(66, 1, '0000-00-00 00:00:00', '2023-01-04 12:46:39', '2023-01-04 12:58:30', '00:08:05', 'null', 0),
(67, 53, '0000-00-00 00:00:00', '2023-01-04 12:59:46', NULL, NULL, NULL, 0),
(68, 1, '0000-00-00 00:00:00', '2023-01-04 13:00:15', NULL, NULL, NULL, 0),
(69, 1, '0000-00-00 00:00:00', '2023-01-04 14:17:47', NULL, NULL, NULL, 0),
(70, 1, '0000-00-00 00:00:00', '2023-01-04 14:18:07', '2023-01-04 14:47:48', '00:50:53', '[{\"pausedDate\": \"Wed Jan 04 2023 14:42:48 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:40:19\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(71, 53, '0000-00-00 00:00:00', '2023-01-04 15:34:22', NULL, NULL, NULL, 0),
(72, 53, '0000-00-00 00:00:00', '2023-01-04 16:27:13', '2023-01-04 16:27:40', '00:00:18', 'null', 0),
(73, 53, '0000-00-00 00:00:00', '2023-01-04 16:27:50', '2023-01-04 16:52:12', '00:23:55', '[{\"pausedDate\": \"Wed Jan 04 2023 16:51:56 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:23:41\", \"resumeDate\": \"Wed Jan 04 2023 16:51:58 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2003}]', 0),
(74, 1, '0000-00-00 00:00:00', '2023-01-05 15:25:51', '2023-01-05 15:35:05', '00:01:42', '[{\"pausedDate\": \"Thu Jan 05 2023 15:33:01 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:09\", \"resumeDate\": \"Thu Jan 05 2023 15:33:05 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 4094}, {\"pausedDate\": \"Thu Jan 05 2023 15:33:06 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:10\", \"resumeDate\": \"Thu Jan 05 2023 15:34:23 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 77510}]', 0),
(75, 1, '0000-00-00 00:00:00', '2023-01-05 15:25:51', '2023-01-05 15:35:05', '00:01:42', '[{\"pausedDate\": \"Thu Jan 05 2023 15:33:01 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:09\", \"resumeDate\": \"Thu Jan 05 2023 15:33:05 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 4094}, {\"pausedDate\": \"Thu Jan 05 2023 15:33:06 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:10\", \"resumeDate\": \"Thu Jan 05 2023 15:34:23 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 77510}]', 0),
(76, 1, '0000-00-00 00:00:00', '2023-01-05 15:27:24', NULL, NULL, NULL, 0),
(77, 1, '0000-00-00 00:00:00', '2023-01-05 15:30:23', NULL, NULL, NULL, 0),
(78, 43, '0000-00-00 00:00:00', '2023-01-05 15:35:23', '2023-01-05 15:51:24', '00:13:13', '[{\"pausedDate\": \"Thu Jan 05 2023 15:43:15 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:07:13\", \"resumeDate\": \"Thu Jan 05 2023 15:43:15 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 324}, {\"pausedDate\": \"Thu Jan 05 2023 15:43:16 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:07:13\", \"resumeDate\": \"Thu Jan 05 2023 15:43:16 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 236}, {\"pausedDate\": \"Thu Jan 05 2023 15:43:16 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:07:13\", \"resumeDate\": \"Thu Jan 05 2023 15:43:17 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1388}, {\"pausedDate\": \"Thu Jan 05 2023 15:44:49 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:08:41\", \"resumeDate\": \"Thu Jan 05 2023 15:46:40 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 111622}]', 0),
(79, 43, '0000-00-00 00:00:00', '2023-01-05 15:36:14', NULL, NULL, NULL, 0),
(80, 43, '0000-00-00 00:00:00', '2023-01-05 15:36:25', '2023-01-05 15:37:24', '00:00:50', 'null', 0),
(81, 43, '0000-00-00 00:00:00', '2023-01-05 15:37:35', '2023-01-05 15:37:57', '00:00:20', 'null', 0),
(82, 1, '0000-00-00 00:00:00', '2023-01-05 15:38:05', NULL, NULL, NULL, 0),
(83, 43, '0000-00-00 00:00:00', '2023-01-05 15:39:37', NULL, NULL, NULL, 0),
(84, 1, '0000-00-00 00:00:00', '2023-01-05 15:51:29', NULL, NULL, NULL, 0),
(85, 43, '0000-00-00 00:00:00', '2023-01-05 15:53:32', NULL, NULL, NULL, 0),
(86, 43, '0000-00-00 00:00:00', '2023-01-05 15:56:33', '2023-01-05 16:20:59', '00:23:17', 'null', 0),
(87, 1, '0000-00-00 00:00:00', '2023-01-05 16:21:10', '2023-01-05 16:32:18', '00:10:48', 'null', 0),
(88, 43, '0000-00-00 00:00:00', '2023-01-05 16:28:34', NULL, NULL, NULL, 0),
(89, 43, '0000-00-00 00:00:00', '2023-01-05 16:32:29', NULL, NULL, NULL, 0),
(90, 1, '0000-00-00 00:00:00', '2023-01-06 09:48:06', NULL, NULL, NULL, 0),
(91, 1, '0000-00-00 00:00:00', '2023-01-06 09:56:50', NULL, NULL, NULL, 0),
(92, 1, '0000-00-00 00:00:00', '2023-01-06 10:02:46', NULL, NULL, NULL, 0),
(93, 1, '0000-00-00 00:00:00', '2023-01-06 10:03:14', NULL, NULL, NULL, 0),
(94, 53, '0000-00-00 00:00:00', '2023-01-06 11:09:56', '2023-01-06 12:25:08', '00:10:39', '[{\"pausedDate\": \"Fri Jan 06 2023 11:55:12 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:10:39\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(95, 1, '0000-00-00 00:00:00', '2023-01-06 13:33:21', NULL, NULL, NULL, 0),
(96, 1, '0000-00-00 00:00:00', '2023-01-06 13:34:10', NULL, NULL, NULL, 0),
(97, 1, '0000-00-00 00:00:00', '2023-01-06 13:53:19', '2023-01-06 13:55:19', '00:50:07', '[{\"pausedDate\": \"Thu Jan 05 2023 15:28:20 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:53\", \"resumeDate\": \"Thu Jan 05 2023 15:28:22 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 2376}, {\"pausedDate\": \"Thu Jan 05 2023 15:28:40 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:11\", \"resumeDate\": \"Thu Jan 05 2023 15:28:41 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1776}, {\"pausedDate\": \"Thu Jan 05 2023 15:28:42 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:12\", \"resumeDate\": \"Fri Jan 06 2023 10:02:59 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 66857264}, {\"pausedDate\": \"Fri Jan 06 2023 10:34:47 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:31:11\", \"resumeDate\": \"Fri Jan 06 2023 10:34:54 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 7387}]', 0),
(98, 1, '0000-00-00 00:00:00', '2023-01-06 13:55:22', '2023-01-06 13:55:32', '00:00:09', 'null', 0),
(99, 43, '0000-00-00 00:00:00', '2023-01-06 13:55:54', NULL, NULL, NULL, 0),
(100, 1, '0000-00-00 00:00:00', '2023-01-06 15:07:39', '2023-01-06 15:26:07', '03:26:19', 'null', 0),
(101, 53, '0000-00-00 00:00:00', '2023-01-06 15:13:12', '2023-01-06 15:16:05', '00:02:24', 'null', 0),
(102, 43, '0000-00-00 00:00:00', '2023-01-06 15:16:17', '2023-01-06 15:19:58', '00:03:40', 'null', 0),
(103, 53, '0000-00-00 00:00:00', '2023-01-06 15:20:06', '2023-01-06 15:21:59', '00:01:50', 'null', 0),
(104, 43, '0000-00-00 00:00:00', '2023-01-06 15:22:09', NULL, NULL, NULL, 0),
(105, 53, '0000-00-00 00:00:00', '2023-01-06 15:26:16', NULL, NULL, NULL, 0),
(106, 53, '0000-00-00 00:00:00', '2023-01-09 13:00:07', '2023-01-09 13:00:24', '00:00:15', 'null', 0),
(107, 53, '0000-00-00 00:00:00', '2023-01-09 14:18:09', '2023-01-09 14:18:17', '00:00:06', 'null', 0),
(108, 53, '0000-00-00 00:00:00', '2023-01-09 14:18:41', '2023-01-09 14:19:27', '00:00:41', 'null', 0),
(109, 1, '0000-00-00 00:00:00', '2023-01-09 14:19:45', '2023-01-09 14:20:17', '00:00:28', '[{\"pausedDate\": \"Mon Jan 09 2023 14:19:59 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:12\", \"resumeDate\": \"Mon Jan 09 2023 14:20:00 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1834}]', 0),
(110, 43, '0000-00-00 00:00:00', '2023-01-10 11:54:40', '2023-01-10 11:59:17', '00:04:31', 'null', 0),
(111, 1, '0000-00-00 00:00:00', '2023-01-10 11:59:26', '2023-01-10 13:00:13', '00:19:52', '[{\"pausedDate\": \"Tue Jan 10 2023 12:55:12 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:19:52\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(112, 1, '0000-00-00 00:00:00', '2023-01-11 09:50:18', NULL, NULL, NULL, 0),
(113, 43, '0000-00-00 00:00:00', '2023-01-11 10:03:13', '2023-01-11 10:30:41', '00:43:03', '[{\"pausedDate\": \"Wed Jan 11 2023 10:21:44 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:41:11\", \"resumeDate\": \"Wed Jan 11 2023 10:28:43 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 419875}, {\"pausedDate\": \"Wed Jan 11 2023 10:28:43 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:41:11\", \"resumeDate\": \"Wed Jan 11 2023 10:28:44 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1723}]', 0),
(114, 1, '0000-00-00 00:00:00', '2023-01-11 10:31:41', '2023-01-11 10:32:35', '00:00:49', 'null', 0),
(115, 1, '0000-00-00 00:00:00', '2023-01-11 10:33:00', '2023-01-11 10:36:02', '00:02:39', 'null', 0),
(116, 43, '0000-00-00 00:00:00', '2023-01-11 10:36:06', '2023-01-11 10:51:03', '00:44:05', '[{\"pausedDate\": \"Wed Jan 11 2023 10:36:41 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:25\", \"resumeDate\": \"Wed Jan 11 2023 10:36:49 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 8083}, {\"pausedDate\": \"Wed Jan 11 2023 10:37:28 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:38:46\", \"resumeDate\": \"Wed Jan 11 2023 10:37:29 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1146}, {\"pausedDate\": \"Wed Jan 11 2023 10:41:10 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:42:24\", \"resumeDate\": \"Wed Jan 11 2023 10:41:35 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 25378}]', 0),
(117, 43, '0000-00-00 00:00:00', '2023-01-11 10:52:12', '2023-01-11 11:27:04', '01:06:23', '[{\"pausedDate\": \"Wed Jan 11 2023 11:22:02 GMT+0530 (India Standard Time)\", \"pausedTime\": \"01:06:23\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(118, 43, '0000-00-00 00:00:00', '2023-01-11 10:58:11', NULL, NULL, NULL, 0),
(119, 43, '0000-00-00 00:00:00', '2023-01-11 10:58:54', NULL, NULL, NULL, 0),
(120, 43, '0000-00-00 00:00:00', '2023-01-11 11:00:11', NULL, NULL, NULL, 0),
(121, 43, '0000-00-00 00:00:00', '2023-01-11 11:00:27', NULL, NULL, NULL, 0),
(122, 53, '0000-00-00 00:00:00', '2023-01-11 14:35:03', '2023-01-11 14:35:09', '00:00:01', 'null', 0),
(123, 43, '0000-00-00 00:00:00', '2023-01-11 15:55:21', NULL, NULL, NULL, 0),
(124, 53, '0000-00-00 00:00:00', '2023-01-12 09:10:01', '2023-01-12 09:18:26', '00:04:42', '[{\"pausedDate\": \"Thu Jan 05 2023 15:39:10 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:03\", \"resumeDate\": \"Thu Jan 05 2023 15:39:11 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1322}, {\"pausedDate\": \"Thu Jan 05 2023 15:39:11 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:03\", \"resumeDate\": \"Fri Jan 06 2023 09:48:17 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 65346489}, {\"pausedDate\": \"Fri Jan 06 2023 09:48:18 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:03\", \"resumeDate\": \"Fri Jan 06 2023 09:55:26 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 428381}, {\"pausedDate\": \"Fri Jan 06 2023 09:55:26 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:03\", \"resumeDate\": \"Fri Jan 06 2023 09:55:27 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1213}, {\"pausedDate\": \"Fri Jan 06 2023 09:55:30 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:06\", \"resumeDate\": \"Thu Jan 12 2023 09:14:36 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 515946199}]', 0),
(125, 43, '0000-00-00 00:00:00', '2023-01-12 09:18:36', NULL, NULL, NULL, 0),
(126, 43, '0000-00-00 00:00:00', '2023-01-12 09:25:47', NULL, NULL, NULL, 0),
(127, 53, '0000-00-00 00:00:00', '2023-01-12 09:27:08', NULL, NULL, NULL, 0),
(128, 53, '0000-00-00 00:00:00', '2023-01-12 09:30:36', '2023-01-12 09:35:15', '00:02:29', '[{\"pausedDate\": \"Thu Jan 05 2023 16:34:08 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:55 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 287414}, {\"pausedDate\": \"Thu Jan 05 2023 16:38:56 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:56 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 526}, {\"pausedDate\": \"Thu Jan 05 2023 16:38:56 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:56 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 958}, {\"pausedDate\": \"Thu Jan 05 2023 16:38:57 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:57 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 358}, {\"pausedDate\": \"Thu Jan 05 2023 16:38:57 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:57 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 742}, {\"pausedDate\": \"Thu Jan 05 2023 16:38:57 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:32\", \"resumeDate\": \"Thu Jan 05 2023 16:38:58 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1094}, {\"pausedDate\": \"Thu Jan 05 2023 16:39:01 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:01:35\", \"resumeDate\": \"Thu Jan 12 2023 09:31:09 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 579128449}, {\"pausedDate\": \"Thu Jan 12 2023 09:32:06 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:02:29\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(129, 53, '0000-00-00 00:00:00', '2023-01-12 09:35:19', NULL, NULL, NULL, 0),
(130, 53, '0000-00-00 00:00:00', '2023-01-12 09:35:48', NULL, NULL, NULL, 0),
(131, 43, '0000-00-00 00:00:00', '2023-01-12 09:35:59', NULL, NULL, NULL, 0),
(132, 1, '0000-00-00 00:00:00', '2023-01-12 09:40:02', '2023-01-12 09:49:53', '00:02:38', '[{\"pausedDate\": \"Thu Jan 12 2023 09:35:25 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:03\", \"resumeDate\": \"Thu Jan 12 2023 09:47:15 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 710930}]', 0),
(133, 53, '0000-00-00 00:00:00', '2023-01-12 09:49:57', '2023-01-12 09:53:03', '00:03:05', 'null', 0),
(134, 43, '0000-00-00 00:00:00', '2023-01-12 09:53:20', '2023-01-12 09:53:59', '00:00:07', '[{\"pausedDate\": \"Thu Jan 12 2023 09:53:28 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:00:07\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(135, 53, '0000-00-00 00:00:00', '2023-01-12 09:54:01', '2023-01-12 09:55:47', '00:01:29', 'null', 0),
(136, 43, '0000-00-00 00:00:00', '2023-01-12 09:56:04', NULL, NULL, NULL, 0),
(137, 53, '0000-00-00 00:00:00', '2023-01-12 09:56:44', '2023-01-12 11:09:10', '01:08:02', 'null', 0),
(138, 43, '0000-00-00 00:00:00', '2023-01-12 09:57:38', NULL, NULL, NULL, 0),
(139, 43, '0000-00-00 00:00:00', '2023-01-12 10:06:38', NULL, NULL, NULL, 0),
(140, 43, '0000-00-00 00:00:00', '2023-01-12 11:09:18', NULL, NULL, NULL, 0),
(141, 43, '0000-00-00 00:00:00', '2023-01-12 11:10:19', NULL, NULL, NULL, 0),
(142, 43, '0000-00-00 00:00:00', '2023-01-12 11:12:38', NULL, NULL, NULL, 0),
(143, 53, '0000-00-00 00:00:00', '2023-01-12 11:13:53', NULL, NULL, NULL, 0),
(144, 1, '0000-00-00 00:00:00', '2023-01-12 11:14:14', '2023-01-12 11:19:51', '01:02:26', '[{\"pausedDate\": \"Thu Jan 12 2023 09:32:42 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:13:21\", \"resumeDate\": \"Thu Jan 12 2023 09:53:54 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 1272201}, {\"pausedDate\": \"Thu Jan 12 2023 11:09:26 GMT+0530 (India Standard Time)\", \"pausedTime\": \"01:02:26\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(145, 53, '0000-00-00 00:00:00', '2023-01-12 11:19:34', NULL, NULL, NULL, 0),
(146, 43, '0000-00-00 00:00:00', '2023-01-12 11:19:55', NULL, NULL, NULL, 0),
(147, 53, '0000-00-00 00:00:00', '2023-01-12 11:30:13', NULL, NULL, NULL, 0),
(148, 53, '0000-00-00 00:00:00', '2023-01-12 12:09:11', NULL, NULL, NULL, 0),
(149, 43, '0000-00-00 00:00:00', '2023-01-12 12:11:05', NULL, NULL, NULL, 0),
(150, 43, '0000-00-00 00:00:00', '2023-01-14 17:30:00', '2023-01-14 18:48:33', '00:31:38', '[{\"pausedDate\": \"Sat Jan 14 2023 18:47:02 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:31:34\", \"resumeDate\": \"Sat Jan 14 2023 18:48:15 GMT+0530 (India Standard Time)\", \"totalBreakTime\": 73932}]', 0),
(151, 43, '0000-00-00 00:00:00', '2023-01-14 18:48:40', NULL, NULL, NULL, 0),
(152, 43, '0000-00-00 00:00:00', '2023-01-15 10:45:03', '2023-01-15 12:08:55', '00:29:11', '[{\"pausedDate\": \"Sun Jan 15 2023 12:03:42 GMT+0530 (India Standard Time)\", \"pausedTime\": \"00:29:11\", \"resumeDate\": \"null\", \"totalBreakTime\": \"null\"}]', 0),
(153, 43, '0000-00-00 00:00:00', '2023-01-16 11:52:09', NULL, NULL, NULL, 0),
(154, 1, '0000-00-00 00:00:00', '2023-01-16 13:55:35', NULL, NULL, NULL, 0),
(155, 1, '0000-00-00 00:00:00', '2023-01-17 08:40:56', NULL, NULL, NULL, 0),
(156, 1, '0000-00-00 00:00:00', '2023-01-17 08:56:22', NULL, NULL, NULL, 0),
(157, 1, '0000-00-00 00:00:00', '2023-01-17 09:51:44', '2023-01-17 09:54:50', '00:02:57', 'null', 0),
(158, 43, '0000-00-00 00:00:00', '2023-01-17 11:16:29', NULL, NULL, NULL, 0),
(159, 1, '0000-00-00 00:00:00', '2023-01-17 12:05:04', NULL, NULL, NULL, 0),
(160, 1, '0000-00-00 00:00:00', '2023-01-17 13:59:34', NULL, NULL, NULL, 0);

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
-- Dumping data for table `ah_user_rating`
--

INSERT INTO `ah_user_rating` (`rating_id`, `staff_id`, `reporting_staff_id`, `rating`, `comment`, `rating_date`) VALUES
(1, 53, 1, 1, 'need improvement', '2022-12-16'),
(2, 53, 43, 2, 'outstanding', '2022-12-01'),
(3, 53, 43, 2, 'very gud..', '2022-10-01'),
(4, 53, 43, 3, 'tiyui', '2022-01-01'),
(5, 53, 43, 1, 'test', '2022-03-01'),
(6, 59, 1, 3, ';,', '2022-01-01'),
(7, 59, 1, 5, 'io', '2022-07-01'),
(8, 59, 1, 2, 'jj', '2022-12-01'),
(9, 60, 1, 2, 'qa', '2022-10-01'),
(10, 65, 1, 3, 'F', '2023-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `ck_authentication`
--

CREATE TABLE `ck_authentication` (
  `authenticationid` int(11) NOT NULL,
  `au_crickus` varbinary(200) NOT NULL,
  `au_crickp` text,
  `au_crickf` varbinary(200) NOT NULL,
  `au_crickl` varbinary(200) NOT NULL,
  `au_crickpn` varbinary(200) NOT NULL,
  `au_cricke` varbinary(200) DEFAULT NULL,
  `au_cricka` varbinary(200) DEFAULT NULL,
  `au_createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `au_usertype` int(11) NOT NULL,
  `au_title` varchar(100) DEFAULT NULL,
  `au_emp_number` int(11) NOT NULL,
  `au_gender` enum('Male','Female') DEFAULT NULL,
  `au_deptarment` varchar(255) DEFAULT NULL,
  `au_school` varchar(255) DEFAULT NULL,
  `au_campus` varchar(255) DEFAULT NULL,
  `au_status` tinyint(2) NOT NULL DEFAULT '0',
  `au_salt` varchar(255) DEFAULT NULL,
  `au_createdby` int(11) NOT NULL,
  `au_designation` int(11) DEFAULT NULL,
  `au_emailverification` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ck_authentication`
--

INSERT INTO `ck_authentication` (`authenticationid`, `au_crickus`, `au_crickp`, `au_crickf`, `au_crickl`, `au_crickpn`, `au_cricke`, `au_cricka`, `au_createdon`, `au_usertype`, `au_title`, `au_emp_number`, `au_gender`, `au_deptarment`, `au_school`, `au_campus`, `au_status`, `au_salt`, `au_createdby`, `au_designation`, `au_emailverification`) VALUES
(1, 0x5b77fa5a540c0d9d967ac2c04e15052a, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x68e56b774f3f649ac78ca0fc38c42a86, 0xce819e452add07465fd56ea4116ff972, 0xb5c6c56a0db55ab4d973e6d01a68ae82, 0x05f45e1bfccbbb12de98804e4230ca765ac06bcdd7eb6e95b853493e5a4cf7cf, 0x9b5aa9e0cee8769b1b968ed959a2fe5a90bdf53b72d56f89e64fb1c8342dbb2e, '2023-01-11 21:19:43', 1, NULL, 0, NULL, NULL, NULL, NULL, 0, 'IHeX4KTGWmY7pc9P', 0, 0, 0),
(43, 0x38a068ed98078407814699810ed30541, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xcd9d8e53d95c8689ece1f2e317e05ea4, 0x2821e230b627db405b63e21c1f84fa3b, 0x2d2718b47cb21a84df3428b14b288574, 0xb4fc87b770219577c6b15c9cbfab34d05ac06bcdd7eb6e95b853493e5a4cf7cf, 0x38a068ed98078407814699810ed30541, '2022-11-03 01:36:45', 2, 'Mr', 1002, 'Male', 'Physics', 'School of Engineering', 'Amritapuri', 0, 'IHeX4KTGWmY7pc9P', 0, 0, 0),
(44, 0x3d692991392f819ad8f78d567d68d2a3, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x6d7f34369ce6ffc7c71bdce03545e902, '', 0x2d2718b47cb21a84df3428b14b288574, 0x3d692991392f819ad8f78d567d68d2a3, 0xf3f0ec0f9206d1aaa912d558492fe511, '2022-11-22 00:16:20', 2, 'Mr', 10012, 'Male', 'Physics', 'School of Engineering', 'Amritapuri', 0, '654321', 1, 1, 0),
(45, 0x336e1b017c2e432ec7e4d1c99f3db43a, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xfcfcd97634fa211780f1a4250cad555f, '', 0x2d2718b47cb21a84df3428b14b288574, 0xa8ce9414bde1ad7091b37c75c21c6805, 0x0a53685c6360eb39fa21c584fcffa076, '2022-11-22 00:16:20', 2, 'Miss', 1003, 'Female', 'Computer Science', 'School of Engineering', 'Amritapuri', 0, '321456', 1, 1, 0),
(46, 0xaab7a56aa94434802c105ed2904e3215, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xdd7be95b507451baf322acaa4cb5321c, '', 0x2d2718b47cb21a84df3428b14b288574, 0x573ce74a9382d16971a07990270b2417be6a8aadc26053884329debcdba11230, 0x0af5cb2df07aa67eedd169ead54557a4, '2022-11-22 00:16:20', 2, 'Mr', 1004, 'Male', 'Computer Science', 'School of Engineering', 'Amritapuri', 0, '987458', 1, 1, 0),
(47, 0xd15788ad49f12af7adc44c2b4899b7ae, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x8aa1dfa9d6a8b8cf763b0c719bffaee0, '', 0x2d2718b47cb21a84df3428b14b288574, 0x4b00a6070fadc5fc2c97377d3480917bc33adbb21f8a7b0c03d82e572c1f93f9, 0xa88f0e52a031d0229b992824e44aa8f7, '2022-11-22 00:16:20', 2, 'Mr', 1005, 'Male', 'Mechanical', 'School of Engineering', 'Amritapuri', 0, '987458', 1, 1, 0),
(48, 0x6b28b58b5f7b5a2564429defa5cfcf99, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x672aade731fa0293b7ac5c80cf7204a5, '', 0x2d2718b47cb21a84df3428b14b288574, 0x4feaaf217d9846446e519f88ea9ce7d0b3abc6b861c7b9de0cdd7636e29657fc, 0x0dbfbacd3d38d273a09b4f6996d8d42f, '2022-11-22 00:16:20', 2, 'Miss', 1006, 'Male', 'Mechanical', 'School of Engineering', 'Amritapuri', 0, '123542', 1, 1, 0),
(49, 0xdb6ec32637cdd117b1cc101cfb3d6aa8, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x3b2ece04442ab3cb4ac9aab21709f543, '', 0x2d2718b47cb21a84df3428b14b288574, 0x67154dfe7d6ba60c0f9951a6bb079fff, 0x86c89f757197a25ff9ba3c4190d0e0da, '2022-11-22 00:16:20', 2, 'Mr', 1007, 'Male', 'Computer Science', 'School of Engineering', 'Amritapuri', 0, '987458', 1, 1, 0),
(50, 0x6d6afb0846cf4c2d7f2207099202e957, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x57a796511be53da89900f97f0b2b656f, '', 0x5887d414e2876119a46d90eeae15cd63, 0x59cd532ff65f046d121fdfb760ce8d19c33adbb21f8a7b0c03d82e572c1f93f9, 0x7fe571c30a8c444eda63b92bed8b532a, '2022-11-22 00:16:20', 2, 'Miss', 1008, 'Female', 'Information Technology', 'School of Engineering', 'Amritapuri', 0, '345345', 1, 1, 0),
(51, 0xbaf248522bde65904360fc686f0dac6a, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xe0418cc4627d072d503c6e751e838b69, '', 0x0df55f2e6d9e34b602a8861902c6f3a1, 0xc7a55b9de1cd488301e23448f8438f79b288012d67db50e7f31c9ec9bfc29cee, 0xe83b03019722c53dce11bec1cb8829db, '2022-11-22 00:16:20', 2, 'Mr', 1009, 'Male', 'Mechanical', 'School of Engineering', 'Amritapuri', 0, '345345', 1, 1, 0),
(52, 0x4b05d60d20b6d14e851dcb6020f0a0a2, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x38e6339da8329ad0c460b63f74e54395, '', 0x2d2718b47cb21a84df3428b14b288574, 0xf15988369db662d896c80ed786822e47b288012d67db50e7f31c9ec9bfc29cee, 0x43ba52dd9b3f23e15bf7873eb79c7c1c, '2022-11-22 00:16:20', 2, 'Mr', 1010, 'Male', 'Computer Science', 'School of Engineering', 'Amritapuri', 0, 'sdfsdf', 1, 1, 0),
(53, 0xf8d95965d485880beeceef623925c026, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x2b22c8cebea7b5fc7c3f43a81011bc7c, '', 0x83727471db19badfe578b3b8966ad03c, 0x56bb611172b62f4bc54efae0f17b6399c33adbb21f8a7b0c03d82e572c1f93f9, 0x7a1c30f82f42cd3aa695b82cca3f06fc, '2022-12-15 04:57:29', 2, 'Mr', 1011, 'Male', 'cs', 'cmbtr', 'Amritapuri', 0, '345345', 1, 2, 0),
(54, 0x01c460ec78cd18f99592128e29e2e904, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0x19e9c7aa1af5a8c44418e6ea3cb1718c, '', 0x3c37a01d342a6098a0551bec7b0be299, 0x518e418dddba92e56b4031e88a54c3eac33adbb21f8a7b0c03d82e572c1f93f9, 0x4283f3f73755eda7d9d4a2a295300cb1, '2022-11-22 00:16:20', 2, 'Mr', 1013, 'Male', 'Mechanical', 'School of Engineering', 'Amritapuri', 0, '345345', 1, 1, 0),
(55, 0x0c6125c417a7c9502d9dce794ebde8d2, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xd4c3eebb950404dc7f40b37ed69e8e43, '', 0x2d2718b47cb21a84df3428b14b288574, 0x4311fb9883a6197faf2835a8dda5dc78, 0x3a2c073c33ce6dedf1906e1090788532, '2022-11-22 00:16:20', 2, 'Miss', 1014, 'Female', 'Computer Science', 'School of Engineering', 'Amritapuri', 0, 'sdfsdf', 1, 1, 0),
(56, 0x371bb38b9616589dbd3159c3927b9bfc, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xc6d2dcea50f357b5426f4af305f1ef3b, '', 0x83727471db19badfe578b3b8966ad03c, 0x59ab9f85d0c39b5f52019eb3fa5e79aa, 0x24310b6060bf9cb894deda1f1489c106, '2022-11-22 00:16:20', 2, 'Mr', 1015, 'Male', 'Information Technology', 'School of Engineering', 'Amritapuri', 0, '345345', 1, 1, 0),
(57, 0xd6c84c3d61bb89cc338c11e6382cd25e, '$2y$10$Gw8VJUnLPeF3wCza4L7WhuwRXx/MSWnoT33zwUrcDAVU31LNQO81q', 0xaa7091135dec808e0cf477bfb6a8a3a6, '', 0x3c37a01d342a6098a0551bec7b0be299, 0x982bc3e60fd57d835a5aba42efaec60dc33adbb21f8a7b0c03d82e572c1f93f9, 0x0b529c1393ac75070f072251a541acd1, '2022-11-22 00:16:20', 2, 'Mr', 101, 'Male', 'Mechanical', 'School of Engineering', 'Amritapuri', 0, '345345', 1, 1, 0),
(58, 0x0c602b9b208890e04ef40b191f21d40e, '$2y$10$qStBDoy.J4nKKiHt5FHrLuFC4T.2r1ugSl.x4PLZuKiZYAbhBS08a', 0x184335f7cf7df1bf3e3e78772e5d89d6, '', '', 0x30178d9fa21f195fdd88090d34aa4256107bb0c1b02f806348de5abd50ea49e3, NULL, '2022-12-15 04:56:09', 2, 'mr', 123456, 'Male', 'cs', 'cmbtr', 'Amritapuri', 0, NULL, 1, 2, 0),
(59, 0x0c602b9b208890e04ef40b191f21d40e, '$2y$10$nzCWpH1zX9MEGInuj6fSEeICDbYimcfBYuHRkE8LeL2q7RAzA7BpW', 0xe0e562447bcab08a3c672938d3db9aec, '', '', 0x59d3744760ffc93ed8283fe8cad8dc2f5ac06bcdd7eb6e95b853493e5a4cf7cf, NULL, '2022-12-28 23:56:29', 3, 'sample', 123456, 'Female', 'cs', 'cmbtr', 'Amritapuri', 0, NULL, 1, 2, 0),
(60, 0x86784b9e131783e7544f7a75da1a3f0b, '$2y$10$rumxCd8xABleqL20s4m9bOb10l/II5SzAZR9fVy6KjjZZK2tXe5aW', 0x1f62311ee35bf7e9985937a9d0ac9b6c, '', '', 0x97bf52a4c6c29c00e7bf8c44378073dc, NULL, '2022-12-30 01:51:05', 3, 'Ms.', 1234, 'Female', 'ca', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0),
(61, 0xdd2445f35ab0d2724eb8427eec02f78a, '$2y$10$MqrzOGdcuofON2au9mSZ5.MuRPqvbb4ZbIeVxU.OqasaNpZXXvCgG', 0x73c394dee2b5890abd445f9faeea5b8c, '', '', 0xab29edfd67cca75567f24569b12dc161, NULL, '2022-12-30 02:06:21', 3, 'ms', 1234567, 'Female', 'mca', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0),
(62, 0x2d2718b47cb21a84df3428b14b288574, '$2y$10$9N9EEVU/mvmQNjj3cjAbqedHNI3BHuI7VXCYyku2eVV962pe7r32m', 0xe6e7b5e4622765f55a77be4554693eb8, '', '', 0xeb7bdf63e1a5018214a08440c3d29e90, NULL, '2022-12-30 02:08:37', 2, 'Ms', 1234567890, 'Female', 'ca', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0),
(63, 0x2e42f0b77417f3f8f864c8067a8f4e21, '$2y$10$7f5y.zsJuhaUaLTKC/tkguIaW5aTpi1R4dubUDUzp/ZrO7W1UTosq', 0x3a410a86371a7ffc797042ee64977744, '', '', 0x5c49175b8a475657c88082f2658cf9965d99c78e0a0a2528f79f0dbfb897500a, NULL, '2022-12-30 02:11:57', 3, 'Ms', 123400, 'Female', 'ca', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0),
(64, 0x18249f0f4aae8b9df8d9734acab11c46, '$2y$10$bWBPa1yVLVe9lIBCnsEVWOg8ZnCYZ6DrvqZszKnWtJ/E76mvla8nC', 0xd21a2388116dec3b85561a7dc5337974, '', '', 0xc24401492b03d7d4d02318feee8b14946c0f402f6302cccded0da03aeee5deb7, NULL, '2022-12-30 02:13:54', 3, 'Ms', 120000, 'Male', 'ca', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0),
(65, 0xf4b738ab767640486dd97308a8cd2b41, '$2y$10$eP3H.dt/8M9nrtALIcHgC.wCcFjI7yJz0gkSMSzrpBZTrbdEVU3gK', 0xbdc61092607c92a9bba3c7fedaa88e39, '', '', 0x529f61dc78a3b5cbc4105103b7498b945ac06bcdd7eb6e95b853493e5a4cf7cf, NULL, '2023-01-05 21:22:45', 2, 'mr', 1, 'Male', 'cs', 'cmbtr', 'Amritapuri', 0, NULL, 1, 4, 0);

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
(3, 'Non Teaching Staff', 0),
(4, 'Reporting Person', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ah_campus`
--
ALTER TABLE `ah_campus`
  ADD PRIMARY KEY (`campus_id`);

--
-- Indexes for table `ah_departments`
--
ALTER TABLE `ah_departments`
  ADD PRIMARY KEY (`departmentid`);

--
-- Indexes for table `ah_designation`
--
ALTER TABLE `ah_designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `ah_location`
--
ALTER TABLE `ah_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `ah_programme`
--
ALTER TABLE `ah_programme`
  ADD PRIMARY KEY (`programmeid`);

--
-- Indexes for table `ah_rating_option`
--
ALTER TABLE `ah_rating_option`
  ADD PRIMARY KEY (`rating_option_id`);

--
-- Indexes for table `ah_stafflocation`
--
ALTER TABLE `ah_stafflocation`
  ADD PRIMARY KEY (`stafflocation_id`),
  ADD KEY `staff_id` (`sl_staff_id`);

--
-- Indexes for table `ah_staff_reporting_conn`
--
ALTER TABLE `ah_staff_reporting_conn`
  ADD PRIMARY KEY (`reportingid`),
  ADD KEY `fk_rp_staffid_authentication` (`rp_staffid`);

--
-- Indexes for table `ah_staff_task_approved_details`
--
ALTER TABLE `ah_staff_task_approved_details`
  ADD PRIMARY KEY (`approveddetailsid`),
  ADD KEY `fk_ad_staff_id_authentication` (`ad_staff_id`),
  ADD KEY `fk_ad_task_id_tasks` (`ad_task_id`);

--
-- Indexes for table `ah_subcategory`
--
ALTER TABLE `ah_subcategory`
  ADD PRIMARY KEY (`subcategoryid`);

--
-- Indexes for table `ah_tasks`
--
ALTER TABLE `ah_tasks`
  ADD PRIMARY KEY (`taskid`),
  ADD KEY `fk_task_category_category` (`task_category`),
  ADD KEY `fk_task_subcategory_subcat` (`task_subcategory`),
  ADD KEY `fk_task_staffid_auth_staff` (`task_staffid`);

--
-- Indexes for table `ah_task_category`
--
ALTER TABLE `ah_task_category`
  ADD PRIMARY KEY (`task_categoryid`);

--
-- Indexes for table `ah_task_staff`
--
ALTER TABLE `ah_task_staff`
  ADD PRIMARY KEY (`task_staff_addedid`),
  ADD KEY `fk_tsa_staffid_authentication_id` (`tsa_staffid`),
  ADD KEY `tsa_taskid_tasks_id` (`tsa_taskid`);

--
-- Indexes for table `ah_task_status_details`
--
ALTER TABLE `ah_task_status_details`
  ADD PRIMARY KEY (`task_details_id`),
  ADD KEY `td_staff_id_authentication_id` (`td_staff_id`),
  ADD KEY `td_task_id_tasks_id` (`td_task_id`);

--
-- Indexes for table `ah_team`
--
ALTER TABLE `ah_team`
  ADD PRIMARY KEY (`teamid`);

--
-- Indexes for table `ah_team_member`
--
ALTER TABLE `ah_team_member`
  ADD PRIMARY KEY (`team_memberid`),
  ADD KEY `fk_teamid_team` (`tm_teamid`),
  ADD KEY `fk_tm_staff_authentication` (`tm_staffid`);

--
-- Indexes for table `ah_usertime`
--
ALTER TABLE `ah_usertime`
  ADD PRIMARY KEY (`usertime_id`);

--
-- Indexes for table `ah_user_rating`
--
ALTER TABLE `ah_user_rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `ah_user_rating_ibfk_1` (`staff_id`),
  ADD KEY `ah_user_rating_ibfk_2` (`reporting_staff_id`);

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
-- AUTO_INCREMENT for table `ah_campus`
--
ALTER TABLE `ah_campus`
  MODIFY `campus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ah_departments`
--
ALTER TABLE `ah_departments`
  MODIFY `departmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ah_designation`
--
ALTER TABLE `ah_designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ah_location`
--
ALTER TABLE `ah_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ah_programme`
--
ALTER TABLE `ah_programme`
  MODIFY `programmeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ah_rating_option`
--
ALTER TABLE `ah_rating_option`
  MODIFY `rating_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ah_stafflocation`
--
ALTER TABLE `ah_stafflocation`
  MODIFY `stafflocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ah_staff_reporting_conn`
--
ALTER TABLE `ah_staff_reporting_conn`
  MODIFY `reportingid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `ah_staff_task_approved_details`
--
ALTER TABLE `ah_staff_task_approved_details`
  MODIFY `approveddetailsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `ah_subcategory`
--
ALTER TABLE `ah_subcategory`
  MODIFY `subcategoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ah_tasks`
--
ALTER TABLE `ah_tasks`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ah_task_category`
--
ALTER TABLE `ah_task_category`
  MODIFY `task_categoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `ah_task_staff`
--
ALTER TABLE `ah_task_staff`
  MODIFY `task_staff_addedid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `ah_task_status_details`
--
ALTER TABLE `ah_task_status_details`
  MODIFY `task_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ah_team`
--
ALTER TABLE `ah_team`
  MODIFY `teamid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ah_team_member`
--
ALTER TABLE `ah_team_member`
  MODIFY `team_memberid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `ah_usertime`
--
ALTER TABLE `ah_usertime`
  MODIFY `usertime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `ah_user_rating`
--
ALTER TABLE `ah_user_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ck_authentication`
--
ALTER TABLE `ck_authentication`
  MODIFY `authenticationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ck_usertype`
--
ALTER TABLE `ck_usertype`
  MODIFY `usertypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ah_stafflocation`
--
ALTER TABLE `ah_stafflocation`
  ADD CONSTRAINT `staff_id` FOREIGN KEY (`sl_staff_id`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_staff_reporting_conn`
--
ALTER TABLE `ah_staff_reporting_conn`
  ADD CONSTRAINT `fk_rp_staffid_authentication` FOREIGN KEY (`rp_staffid`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_staff_task_approved_details`
--
ALTER TABLE `ah_staff_task_approved_details`
  ADD CONSTRAINT `fk_ad_staff_id_authentication` FOREIGN KEY (`ad_staff_id`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ad_task_id_tasks` FOREIGN KEY (`ad_task_id`) REFERENCES `ah_tasks` (`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_tasks`
--
ALTER TABLE `ah_tasks`
  ADD CONSTRAINT `fk_task_category_category` FOREIGN KEY (`task_category`) REFERENCES `ah_task_category` (`task_categoryid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_staffid_auth_staff` FOREIGN KEY (`task_staffid`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_task_subcategory_subcat` FOREIGN KEY (`task_subcategory`) REFERENCES `ah_subcategory` (`subcategoryid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_task_staff`
--
ALTER TABLE `ah_task_staff`
  ADD CONSTRAINT `fk_tsa_staffid_authentication_id` FOREIGN KEY (`tsa_staffid`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tsa_taskid_tasks_id` FOREIGN KEY (`tsa_taskid`) REFERENCES `ah_tasks` (`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_task_status_details`
--
ALTER TABLE `ah_task_status_details`
  ADD CONSTRAINT `td_staff_id_authentication_id` FOREIGN KEY (`td_staff_id`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `td_task_id_tasks_id` FOREIGN KEY (`td_task_id`) REFERENCES `ah_tasks` (`taskid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ah_team_member`
--
ALTER TABLE `ah_team_member`
  ADD CONSTRAINT `fk_teamid_team` FOREIGN KEY (`tm_teamid`) REFERENCES `ah_team` (`teamid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tm_staff_authentication` FOREIGN KEY (`tm_staffid`) REFERENCES `ck_authentication` (`authenticationid`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
