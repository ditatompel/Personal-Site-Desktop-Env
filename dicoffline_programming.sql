-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2012 at 08:29 AM
-- Server version: 5.5.25a-log
-- PHP Version: 5.4.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dicoffline_programming`
--

-- --------------------------------------------------------

--
-- Table structure for table `dic_articles`
--

CREATE TABLE IF NOT EXISTS `dic_articles` (
  `article_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `article_title` text CHARACTER SET utf8 NOT NULL,
  `article_content` longtext CHARACTER SET utf8 NOT NULL,
  `article_created_on` datetime NOT NULL,
  `article_last_update` datetime NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dic_categories`
--

CREATE TABLE IF NOT EXISTS `dic_categories` (
  `category_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `category_title` varchar(200) CHARACTER SET utf8 NOT NULL,
  `category_show` enum('Y','N') CHARACTER SET utf8 NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dic_files`
--

CREATE TABLE IF NOT EXISTS `dic_files` (
  `file_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file_title` text CHARACTER SET utf8 NOT NULL,
  `file_url` text CHARACTER SET utf8 NOT NULL,
  `category_id` int(4) NOT NULL,
  `mimetype_id` int(4) NOT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dic_mimetypes`
--

CREATE TABLE IF NOT EXISTS `dic_mimetypes` (
  `mimetype_id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `mimetype_title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `mimetype_picture` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`mimetype_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
