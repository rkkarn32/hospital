-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 07, 2013 at 01:43 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountgroup`
--

CREATE TABLE `accountgroup` (
  `groupid` int(11) NOT NULL auto_increment,
  `groupname` varchar(30) NOT NULL,
  PRIMARY KEY  (`groupid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `accountgroup`
--

INSERT INTO `accountgroup` (`groupid`, `groupname`) VALUES
(1, 'Doctor'),
(2, 'Nurse'),
(3, 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleid` int(11) NOT NULL auto_increment,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY  (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `role`) VALUES
(1, 'root'),
(2, 'ala'),
(3, 'lla'),
(4, 'patient');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `roleid` int(3) NOT NULL,
  `accountgroupid` int(2) NOT NULL,
  `creationdate` date NOT NULL,
  `name` varchar(40) NOT NULL,
  `street` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `phoneno` varchar(13) NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userid`, `username`, `password`, `roleid`, `accountgroupid`, `creationdate`, `name`, `street`, `city`, `state`, `phoneno`, `birthdate`) VALUES
(1, 'ramesh', 'ramesh', 1, 1, '2013-07-07', 'Ramesh Kumar Karn', 'kupondole', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-02');
