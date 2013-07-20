-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 20, 2013 at 05:26 AM
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
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patientid` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `doctorid` varchar(30) NOT NULL,
  `nurseid` varchar(30) NOT NULL,
  `lastvisit` date NOT NULL,
  `purposeofvisit` text NOT NULL,
  `diagnosis` text NOT NULL,
  `medication` text NOT NULL,
  PRIMARY KEY  (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `userid`, `doctorid`, `nurseid`, `lastvisit`, `purposeofvisit`, `diagnosis`, `medication`) VALUES
(3, 26, '1', '14', '2013-07-15', 'just check up', 'none ', 'none');

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
(1, 'Root'),
(2, 'ALA'),
(3, 'LLA'),
(4, 'Spectator');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `roleid` int(3) NOT NULL,
  `groupid` int(2) NOT NULL,
  `creationdate` date NOT NULL,
  `name` varchar(40) NOT NULL,
  `street` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `phoneno` varchar(13) NOT NULL,
  `birthdate` date NOT NULL,
  `verified` tinyint(1) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userid`, `username`, `password`, `roleid`, `groupid`, `creationdate`, `name`, `street`, `city`, `state`, `phoneno`, `birthdate`, `verified`) VALUES
(1, 'root', '6fc42c4388ed6f0c5a91257f096fef3c', 1, 1, '2013-07-07', 'Ramesh Kumar Karn', 'kupondole', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-02', 1),
(12, 'D2', 'c4d62b6dcca08e5caf06c01889282859', 2, 1, '1985-07-13', 'Deepesh Karn', 'Kathmandu,Nepal', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-14', 1),
(14, 'A14', '43ba9900ff2fc7d9d32072540b2cab12', 3, 2, '2013-07-14', 'Anju sah', 'Kathmandu,Nepal', 'Kathmandu', 'Nepal', '9779849757241', '1991-04-04', 0),
(15, 'G15', '22f32fd975a694d340a6ad22b872b1ae', 3, 2, '2013-07-15', 'Geetiak', 'Janak chauka', 'Kathmandu', 'Nepal', '9779849757241', '0000-00-00', 0),
(26, 'J26', 'a6a951f5b33744198df9a43c50d75d9f', 4, 3, '2013-07-15', 'Jag dish', 'Kathmandu,Nepal', 'janakpur', 'Nepal', '9779849757241', '1990-06-13', 0),
(27, 'R27', '9506a7d828145adf450505d92dac1b4a', 2, 1, '2013-07-19', 'Ramesh Karn', 'Kupondole', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-19', 1),
(29, 'a28', '838ff8b78dfbe82b2bc6c681f0cb390f', 2, 1, '0000-00-00', 'adf', '', '', '', '', '0000-00-00', 0),
(30, 's30', '0d6eccf00593e4f1c6e22ee059e41264', 2, 1, '0000-00-00', 'sadf', '', '', '', '', '0000-00-00', 1);
