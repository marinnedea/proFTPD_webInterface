-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2017 at 06:23 PM
-- Server version: 5.5.41
-- PHP Version: 5.4.39-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ftps`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first` varchar(300) NOT NULL,
  `last` varchar(300) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(300) NOT NULL,
  `phone` varchar(300) NOT NULL,
  `dep` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first`, `last`, `password`, `email`, `phone`, `dep`) VALUES
(1, 'Admin', 'User', 'ebfc7910077770c8340f63cd2dca2ac1f120444f', 'admin@domain.com', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ftpgroup`
--

CREATE TABLE IF NOT EXISTS `ftpgroup` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(300) NOT NULL DEFAULT '',
  `gid` smallint(6) NOT NULL DEFAULT '1002',
  `members` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groupname_2` (`groupname`),
  UNIQUE KEY `gid` (`gid`),
  UNIQUE KEY `gid_2` (`gid`),
  KEY `groupname` (`groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ProFTP group table' AUTO_INCREMENT=60 ;


--
-- Table structure for table `ftpquotalimits`
--

CREATE TABLE IF NOT EXISTS `ftpquotalimits` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `quota_type` enum('user','group','class','all') NOT NULL DEFAULT 'user',
  `per_session` enum('false','true') NOT NULL DEFAULT 'false',
  `limit_type` enum('soft','hard') NOT NULL DEFAULT 'soft',
  `bytes_in_avail` float unsigned NOT NULL DEFAULT '',
  `bytes_out_avail` float unsigned NOT NULL DEFAULT '0',
  `bytes_xfer_avail` float unsigned NOT NULL DEFAULT '0',
  `files_in_avail` bigint(20) unsigned NOT NULL DEFAULT '0',
  `files_out_avail` bigint(20) unsigned NOT NULL DEFAULT '0',
  `files_xfer_avail` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;


--
-- Table structure for table `ftpquotatallies`
--

CREATE TABLE IF NOT EXISTS `ftpquotatallies` (
  `id` bigint(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `quota_type` enum('user','group','class','all') NOT NULL DEFAULT 'group',
  `bytes_in_used` float unsigned NOT NULL DEFAULT '0',
  `bytes_out_used` float unsigned NOT NULL DEFAULT '0',
  `bytes_xfer_used` float unsigned NOT NULL DEFAULT '0',
  `files_in_used` bigint(20) unsigned NOT NULL DEFAULT '0',
  `files_out_used` bigint(20) unsigned NOT NULL DEFAULT '0',
  `files_xfer_used` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `name_2` (`name`),
  UNIQUE KEY `name_3` (`name`),
  UNIQUE KEY `name_4` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Table structure for table `ftpuser`
--

CREATE TABLE IF NOT EXISTS `ftpuser` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(32) NOT NULL DEFAULT '',
  `passwd` varchar(40) NOT NULL,
  `uid` smallint(6) NOT NULL DEFAULT '1002',
  `gid` smallint(6) NOT NULL DEFAULT '1002',
  `homedir` varchar(255) NOT NULL DEFAULT '',
  `shell` varchar(16) NOT NULL DEFAULT '/sbin/nologin',
  `count` int(11) NOT NULL DEFAULT '0',
  `accessed` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='ProFTP user table' AUTO_INCREMENT=66 ;


--
-- Table structure for table `xferlog`
--

CREATE TABLE IF NOT EXISTS `xferlog` (
  `username` varchar(100) NOT NULL,
  `timestamp` datetime NOT NULL,
  `bytes` int(20) NOT NULL,
  `file` varchar(255) NOT NULL,
  `direction` varchar(1) NOT NULL,
  `ip` varchar(20) NOT NULL,
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
