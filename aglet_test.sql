-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 24, 2023 at 09:22 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aglet_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(1, 'jointheteam', '$2y$10$nsURQRmF5jCakRjkX7uw1.thyju7.2fyd6Y1TX.XGipp7e1B6Mrr6', 'jointheteam@aglet.co.za');

-- --------------------------------------------------------

--
-- Table structure for table `favourite_movies`
--

DROP TABLE IF EXISTS `favourite_movies`;
CREATE TABLE IF NOT EXISTS `favourite_movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `adult` tinyint(1) DEFAULT NULL,
  `overview` mediumtext NOT NULL,
  `original_title` varchar(200) NOT NULL,
  `original_language` varchar(20) NOT NULL,
  `poster_path` varchar(10000) NOT NULL,
  `release_date` varchar(250) DEFAULT NULL,
  `vote_count` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favourite_movies`
--

INSERT INTO `favourite_movies` (`id`, `title`, `adult`, `overview`, `original_title`, `original_language`, `poster_path`, `release_date`, `vote_count`) VALUES
(1, 'Avatar: The Way of Water', 0, 'Set more than a decade after the events of the first film, learn the story of the Sully family (Jake, Neytiri, and their kids)', 'Avatar: The Way of Water', 'en', 'https://lionsgate.brightspotcdn.com/9e/eb/4832f7e048098e855bf3d2c0925f/plane-movies-promo-horizontal-01.jpg', '2022-12-14 00:00:00', 300),
(2, 'Puss in Boots: The Last Wish', NULL, 'Puss in Boots discovers that his passion for adventure has taken its toll: He has burned through eight of his nine lives, leaving him with only one life left. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.', 'Puss in Boots: The Last Wish', 'en', '/kuf6dutpsT0vSVehic3EZIqkOBt.jpg', '2022-12-07 00:00:00', 2366),
(3, 'æº«æ³‰é„‰çš„å‰ä»–', NULL, '', 'æº«æ³‰é„‰çš„å‰ä»–', 'zh', '', '', 0),
(4, 'Puss in Boots: The Last Wish', NULL, 'Puss in Boots discovers that his passion for adventure has taken its toll: He has burned through eight of his nine lives, leaving him with only one life left. Puss sets out on an epic journey to find the mythical Last Wish and restore his nine lives.', 'Puss in Boots: The Last Wish', 'en', '/kuf6dutpsT0vSVehic3EZIqkOBt.jpg', '2022-12-07', 2444);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
