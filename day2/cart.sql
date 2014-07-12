-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2014 at 12:48 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `chil_menu`
--

CREATE TABLE IF NOT EXISTS `chil_menu` (
  `chil_id` int(10) NOT NULL AUTO_INCREMENT,
  `chil_name` varchar(50) NOT NULL,
  `par_id` int(10) NOT NULL,
  PRIMARY KEY (`chil_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `chil_menu`
--

INSERT INTO `chil_menu` (`chil_id`, `chil_name`, `par_id`) VALUES
(11, 'iaoi,aid,', 9);

-- --------------------------------------------------------

--
-- Table structure for table `par_menu`
--

CREATE TABLE IF NOT EXISTS `par_menu` (
  `par_id` int(10) NOT NULL AUTO_INCREMENT,
  `par_name` varchar(50) NOT NULL,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `par_menu`
--

INSERT INTO `par_menu` (`par_id`, `par_name`) VALUES
(9, 'Ba con soi'),
(14, 'oaiuaoi'),
(15, 'iaoioa');
