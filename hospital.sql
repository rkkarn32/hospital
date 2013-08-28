-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2013 at 02:56 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountgroup`
--

CREATE TABLE IF NOT EXISTS `accountgroup` (
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(30) NOT NULL,
  PRIMARY KEY (`groupid`)
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

CREATE TABLE IF NOT EXISTS `patient` (
  `patientid` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `doctorid` varchar(30) NOT NULL,
  `nurseid` varchar(30) NOT NULL,
  `lastvisit` date NOT NULL,
  `purposeofvisit` text NOT NULL,
  `diagnosis` text NOT NULL,
  `medication` text NOT NULL,
  PRIMARY KEY (`patientid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `userid`, `doctorid`, `nurseid`, `lastvisit`, `purposeofvisit`, `diagnosis`, `medication`) VALUES
(3, 26, '1', '14', '2013-07-15', 'just check up', 'none ', 'none'),
(4, 34, '12', '14', '2013-07-27', '', '', ''),
(5, 4, '1', '0', '1998-02-02', '', '', ''),
(6, 5, '2', '0', '2011-08-28', '', '', ''),
(7, 6, '2', '0', '2011-08-28', '', '', ''),
(8, 7, '1', '0', '2012-08-28', '', '', ''),
(9, 8, '1', '0', '2012-08-28', '', '', ''),
(10, 9, '1', '0', '2010-08-28', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `permissionid` int(11) NOT NULL AUTO_INCREMENT,
  `permissionname` varchar(20) NOT NULL,
  PRIMARY KEY (`permissionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permissionid`, `permissionname`) VALUES
(1, 'reportdata'),
(2, 'retrievedata'),
(3, 'createuser'),
(4, 'editInfo');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(10) NOT NULL,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleid`, `role`) VALUES
(1, 'Root'),
(2, 'ALA'),
(3, 'LLA'),
(4, 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE IF NOT EXISTS `userdetail` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userid`, `username`, `password`, `roleid`, `groupid`, `creationdate`, `name`, `street`, `city`, `state`, `phoneno`, `birthdate`, `verified`) VALUES
(1, 'root', '6fc42c4388ed6f0c5a91257f096fef3c', 1, 1, '2013-07-07', 'Ramesh Kumar Karn', 'kupondole', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-02', 1),
(2, 'D2', 'c4d62b6dcca08e5caf06c01889282859', 2, 1, '2013-08-04', 'Deepesh Karn', 'Matihani', '', 'Central Zone', '', '0000-00-00', 1),
(3, 'D3', 'a3deb6e481689f1d3303caecb8a6c401', 3, 1, '2013-07-27', 'Durga', '', '', '', '', '2013-07-07', 1),
(4, 'N4', 'b1c49f839832f51f6d687a04db101d4c', 4, 3, '2013-07-27', 'Niku karn', 'Kathmandu,Nepal', '', 'Nepal', '', '2013-07-01', 1),
(6, 'G5', '94d310c7d04458fde088caf8ed27c9b1', 4, 3, '2011-08-28', 'Ganesh Sah', 'Kathmandu,Nepal', '', 'Nepal', '', '2010-12-31', 0),
(8, 'R7', 'b9d7e51eba2c6d155e7fd3013338c38e', 4, 3, '2007-06-28', 'RajniKant', 'Kathmandu,Nepal', 'Kathmandu', 'Nepal', '09849757241', '2012-12-29', 0),
(9, 'R9', '8d28dad91e1ffada38203b9e5f9af86d', 4, 3, '2010-08-28', 'Rajnikan', 'Matihani', 'Janakpur', 'Central Zone', '949499449', '2009-11-30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userpermission`
--

CREATE TABLE IF NOT EXISTS `userpermission` (
  `userid` int(11) NOT NULL,
  `permissionid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userpermission`
--

INSERT INTO `userpermission` (`userid`, `permissionid`) VALUES
(1, '1'),
(1, '2'),
(1, '3'),
(1, '4'),
(2, '1'),
(2, '2'),
(2, '3'),
(2, '4'),
(3, '3'),
(3, '1'),
(3, '2');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
