-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2013 at 09:10 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guestbook`
--

-- --------------------------------------------------------

--
-- Table structure for table `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(40) DEFAULT NULL,
  `content` text,
  `fk_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `entry`
--

INSERT INTO `entry` (`id`, `title`, `content`, `fk_user`) VALUES
(6, 'asdfasdf', 'sdfesfas', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `firstname` varchar(40) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `password` char(60) NOT NULL,
  `role` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstname`, `name`, `password`, `role`, `email`) VALUES
(1, 'test', 'te', 'st', '$2a$12$/mqM6W/m6op5uj8AvX7dt.c7LKfJ4tudBOw6qzjLpqnWeDIZcvdd.', 1, 'te.st@test.ch'),
(2, 'asdf', 'TESET', 'NACHNAHME!', '$2a$12$P.76aT/i.7UV.YtetPK47.hIwE.Bf/CGythyC7EoVv09fCv13sH2O', 1, 'as.df@test.ch'),
(3, 'admin', 'ad', 'min', '$2a$12$f73eUGrrO8NP5hLe0j311uRzNOUIaowXe9vIFIC6AR0ldfxmSxQEG', 0, 'ad.min@test.ch');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
