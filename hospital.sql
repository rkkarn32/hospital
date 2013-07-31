-- phpMyAdmin SQL Dump
-- version 2.11.2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2013 at 02:29 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patientid`, `userid`, `doctorid`, `nurseid`, `lastvisit`, `purposeofvisit`, `diagnosis`, `medication`) VALUES
(3, 26, '1', '14', '2013-07-15', 'just check up', 'none ', 'none'),
(4, 34, '12', '14', '2013-07-27', '', '', ''),
(5, 4, '1', '3', '1998-02-02', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permissionid` int(11) NOT NULL auto_increment,
  `permissionname` varchar(20) NOT NULL,
  PRIMARY KEY  (`permissionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permissionid`, `permissionname`) VALUES
(1, 'reportdata'),
(2, 'retrievedata'),
(3, 'createuser');

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
(4, 'Patient');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userid`, `username`, `password`, `roleid`, `groupid`, `creationdate`, `name`, `street`, `city`, `state`, `phoneno`, `birthdate`, `verified`) VALUES
(1, 'root', '6fc42c4388ed6f0c5a91257f096fef3c', 1, 1, '2013-07-07', 'Ramesh Kumar Karn', 'kupondole', 'Kathmandu', 'Nepal', '9779849757241', '2013-07-02', 1),
(2, 'D2', 'c4d62b6dcca08e5caf06c01889282859', 2, 1, '0000-00-00', 'Deepesh Karn', 'Matihani', '', 'Central Zone', '', '0000-00-00', 1),
(3, 'D3', 'a3deb6e481689f1d3303caecb8a6c401', 3, 2, '2013-07-27', 'Durga', '', '', '', '', '2013-07-07', 1),
(4, 'N4', 'b1c49f839832f51f6d687a04db101d4c', 4, 3, '2013-07-27', 'Nandan', 'Kathmandu,Nepal', '', 'Nepal', '', '2013-07-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userpermission`
--

CREATE TABLE `userpermission` (
  `userid` int(11) NOT NULL,
  `permissionid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userpermission`
--

INSERT INTO `userpermission` (`userid`, `permissionid`) VALUES
(2, '1'),
(2, '2'),
(2, '3'),
(2, '4'),
(3, '3'),
(3, '4'),
(3, '1'),
(1, '1'),
(1, '2'),
(1, '3'),
(1, '4');
