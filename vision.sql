-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2022 at 03:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vision`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

DROP TABLE IF EXISTS `login_log`;
CREATE TABLE IF NOT EXISTS `login_log` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(20) NOT NULL,
  `device_mac_address` varchar(50) NOT NULL,
  `device_os` varchar(50) NOT NULL,
  `device_browser` varchar(30) NOT NULL,
  `date_time_login` varchar(40) NOT NULL,
  `session_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`login_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`login_id`, `device_name`, `device_mac_address`, `device_os`, `device_browser`, `date_time_login`, `session_status`, `user_id`) VALUES
(81, 'Computer', 'D4-1B-81-45-C3-6E   ', 'Windows 10', 'Chrome', '10/02/2022 11:47:32am', 'inactive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(30) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_mail_id` varchar(35) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `number_of_device_access` int(3) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_mobile`, `user_mail_id`, `user_password`, `number_of_device_access`) VALUES
(1, 'Akash Singh', '6394877241', 'akashsngh681681@gmail.com', '4280cc936cebdd304f81690df529922c', 2),
(2, 'Akash Singh', '6394877241', 'akash.visionias@gmail.com', '94754d0abb89e4cf0a7f1c494dbb9d2c', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
