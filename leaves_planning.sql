-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 26, 2014 at 08:54 PM
-- Server version: 5.5.35-0ubuntu0.13.10.2
-- PHP Version: 5.5.3-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leaves_planning`
--

-- --------------------------------------------------------

--
-- Table structure for table `approve_type`
--

CREATE TABLE IF NOT EXISTS `approve_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approve_type`
--

INSERT INTO `approve_type` (`id`, `name`) VALUES
(0, 'rejected'),
(1, 'approved'),
(2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE IF NOT EXISTS `leave_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_type` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `approve_type` int(11) NOT NULL,
  `from_date` varchar(10) NOT NULL,
  `to_date` varchar(10) NOT NULL,
  `warning` text,
  PRIMARY KEY (`id`),
  KEY `leave_type` (`leave_type`),
  KEY `user` (`user`),
  KEY `approve_type` (`approve_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `leave_type`, `user`, `approve_type`, `from_date`, `to_date`, `warning`) VALUES
(86, 1, 1, 2, '20-11-2014', '24-02-2015', NULL),
(88, 0, 1, 2, '31-10-2014', '23-01-2015', NULL),
(89, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(90, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(91, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(92, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(93, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(94, 0, 2, 1, '31-10-2014', '03-11-2014', NULL),
(95, 1, 2, 1, '28-11-2014', '26-12-2014', NULL),
(96, 1, 2, 1, '31-10-2014', '17-11-2014', NULL),
(97, 0, 1, 2, '31-10-2014', '03-11-2014', NULL),
(98, 0, 1, 2, '31-10-2014', '03-11-2014', NULL),
(99, 0, 1, 2, '31-10-2014', '04-11-2014', NULL),
(100, 0, 1, 2, '31-10-2014', '05-11-2014', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `name`) VALUES
(0, 'paid'),
(1, 'not_paid');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `user_type` int(3) NOT NULL,
  `paid_days_absent` int(11) NOT NULL DEFAULT '0',
  `not_paid_days_absent` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `user_type` (`user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `paid_days_absent`, `not_paid_days_absent`) VALUES
(0, 'placeholde', 'placeholde', 1, 0, 0),
(1, 'admin', 'admin', 1, 15, 85),
(2, 'marko.r', 'marko.r', 2, 20, 31);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`leave_type`) REFERENCES `leave_type` (`id`),
  ADD CONSTRAINT `leave_requests_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `leave_requests_ibfk_3` FOREIGN KEY (`approve_type`) REFERENCES `approve_type` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_type`) REFERENCES `user_type` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
