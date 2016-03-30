-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2016 at 04:21 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `member`
--

-- --------------------------------------------------------

--
-- Table structure for table `portal_logo`
--

CREATE TABLE `portal_logo` (
  `logo_id` int(11) NOT NULL,
  `agreement_no` varchar(128) NOT NULL,
  `agreement_name` varchar(256) NOT NULL,
  `image_url` varchar(256) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portal_logo`
--

INSERT INTO `portal_logo` (`logo_id`, `agreement_no`, `agreement_name`, `image_url`, `status`, `created`) VALUES
(1, 'PC00400', 'PHILHEALTHCARE INC', 'upload/logo/01036ea2b4d9b2ad80cebb32bfcc9ed4.PNG', 1, '2016-01-05 01:41:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `portal_logo`
--
ALTER TABLE `portal_logo`
  ADD PRIMARY KEY (`logo_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `portal_logo`
--
ALTER TABLE `portal_logo`
  MODIFY `logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
