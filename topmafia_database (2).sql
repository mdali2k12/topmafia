-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2021 at 02:07 AM
-- Server version: 10.2.36-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topmafia_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_heists`
--

CREATE TABLE `active_heists` (
  `uid` int(11) NOT NULL,
  `hname` varchar(255) NOT NULL DEFAULT '',
  `hpower` int(11) NOT NULL DEFAULT 0,
  `hleader` int(11) NOT NULL DEFAULT 0,
  `hmembers` int(11) NOT NULL DEFAULT 0,
  `hid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_heists`
--

INSERT INTO `active_heists` (`uid`, `hname`, `hpower`, `hleader`, `hmembers`, `hid`) VALUES
(4, 'International Bank Robbery', 44, 156, 2, 1),
(9, 'International Bank Robbery', 1, 1039, 1, 1),
(26, 'Hatton Garden Jewellery Heist', 6689, 50, 2, 3),
(31, 'International Bank Robbery', 5, 1020, 1, 1),
(38, 'Hatton Garden Jewellery Heist', 1, 1086, 1, 3),
(51, 'International Bank Robbery', 2439, 1122, 2, 1),
(39, 'International Bank Robbery', 1, 1058, 1, 1),
(50, 'International Bank Robbery', 14548, 911, 2, 1),
(49, 'City Airport Hijacking', 8429, 1120, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `a_id` int(11) NOT NULL,
  `a_text` text NOT NULL,
  `a_time` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`a_id`, `a_text`, `a_time`) VALUES
(4, 'l', 1588218337),
(5, 'Hey', 1588280573),
(6, 'Hey\r\n', 1588280606),
(7, 'd', 1588300859),
(8, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1588464002),
(9, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1588464002),
(10, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1589068803),
(11, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1589068804),
(12, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1589673602),
(13, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1589673603),
(14, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1590278404),
(15, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1590278404),
(16, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1590883203),
(17, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1590883204),
(18, 'User ID  won <b>$0</b> at the weekly lottery. Well done!', 1591488001),
(19, 'User ID  won <b>0</b> crystals at the weekly Crystal lottery. Well done!', 1591488002);

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `appID` int(11) NOT NULL,
  `appUSER` int(11) NOT NULL DEFAULT 0,
  `appGANG` int(11) NOT NULL DEFAULT 0,
  `appTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`appID`, `appUSER`, `appGANG`, `appTEXT`) VALUES
(1, 169, 1, 'You are the best'),
(3, 44, 1, ''),
(6, 1002, 1, 'Looking for a gang, thought I might give it my best shot at this game, in yours.'),
(10, 1012, 1, 'New'),
(19, 1037, 1, ''),
(20, 996, 1, ''),
(21, 1038, 1, 'I\'m new to this game. I came from BG, GN, and Torn. I figured you guys could give me a good head start.'),
(28, 1047, 1, 'I read your description and I like the legit gangster mentality, I think together once I get used to the game I could be a good hand for you if you help me to grow! '),
(35, 954, 1, 'active player'),
(40, 1086, 1, 'Because I\'m active???\r\n'),
(42, 982, 1, 'hi there , if u active i wanna join '),
(46, 1112, 1, ''),
(56, 169, 8, 'You\'re the best'),
(49, 1120, 1, 'New would like to grow with yall'),
(50, 1120, 1, ''),
(51, 1120, 12, '');

-- --------------------------------------------------------

--
-- Table structure for table `attacklogs`
--

CREATE TABLE `attacklogs` (
  `log_id` int(11) NOT NULL,
  `attacker` int(11) NOT NULL DEFAULT 0,
  `attacked` int(11) NOT NULL DEFAULT 0,
  `result` enum('won','lost') NOT NULL DEFAULT 'won',
  `time` int(11) NOT NULL DEFAULT 0,
  `stole` bigint(20) NOT NULL DEFAULT 0,
  `attacklog` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auctioncollection`
--

CREATE TABLE `auctioncollection` (
  `cID` int(11) NOT NULL,
  `cBUYERSELLER` int(11) NOT NULL,
  `cUSERID` int(11) NOT NULL,
  `ididi` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auctions`
--

CREATE TABLE `auctions` (
  `aID` int(11) NOT NULL,
  `aEND` int(11) NOT NULL,
  `aITEM` int(11) NOT NULL,
  `aITEMNAME` varchar(255) NOT NULL,
  `aITEMTYPE` int(11) NOT NULL,
  `aBIN` bigint(25) NOT NULL,
  `aBID` bigint(25) NOT NULL,
  `aRES` bigint(25) NOT NULL,
  `aSELLERID` int(11) NOT NULL,
  `aSELLERNAME` varchar(255) NOT NULL,
  `aBUYERID` int(11) NOT NULL,
  `aBUYERNAME` varchar(255) NOT NULL,
  `aOVER` int(11) NOT NULL,
  `aLOSTBIDS` int(11) NOT NULL,
  `aLOCATION` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bankxferlogs`
--

CREATE TABLE `bankxferlogs` (
  `cxID` int(11) NOT NULL,
  `cxFROM` int(11) NOT NULL DEFAULT 0,
  `cxTO` int(11) NOT NULL DEFAULT 0,
  `cxAMOUNT` bigint(20) NOT NULL DEFAULT 0,
  `cxTIME` int(11) NOT NULL DEFAULT 0,
  `cxFROMIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `cxTOIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `cxBANK` enum('bank','cyber') NOT NULL DEFAULT 'bank'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankxferlogs`
--

INSERT INTO `bankxferlogs` (`cxID`, `cxFROM`, `cxTO`, `cxAMOUNT`, `cxTIME`, `cxFROMIP`, `cxTOIP`, `cxBANK`) VALUES
(1, 50, 28, 3000000, 1561075702, '107.128.8.150', '73.150.1.42', 'bank'),
(2, 1022, 1047, 13840000, 1561374440, '71.231.8.204', '92.23.228.76', 'bank'),
(3, 991, 156, 2000000, 1561386878, '172.90.133.243', '172.58.190.130', 'bank'),
(4, 911, 905, 10000000, 1561699729, '137.25.93.82', '174.23.161.156', 'bank'),
(5, 1047, 1066, 250000, 1561741781, '92.2.241.100', '172.56.26.68', 'bank'),
(6, 1047, 1066, 250000, 1561741787, '92.2.241.100', '172.56.26.68', 'bank'),
(7, 1047, 1022, 5000000, 1561742367, '92.2.241.100', '71.231.8.204', 'bank'),
(8, 867, 861, 38220, 1561812113, '69.139.16.182', '109.156.191.152', 'bank'),
(9, 1047, 905, 250000000, 1561841897, '92.2.241.100', '174.23.148.236', 'bank'),
(10, 1047, 1022, 25000000, 1561874473, '148.252.128.31', '71.231.8.204', 'bank'),
(11, 1047, 48, 4500000, 1562088839, '89.242.52.178', '107.77.206.57', 'bank');

-- --------------------------------------------------------

--
-- Table structure for table `blacklist`
--

CREATE TABLE `blacklist` (
  `bl_ID` int(11) NOT NULL,
  `bl_ADDER` int(11) NOT NULL DEFAULT 0,
  `bl_ADDED` int(11) NOT NULL DEFAULT 0,
  `bl_COMMENT` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bountys`
--

CREATE TABLE `bountys` (
  `bID` int(11) NOT NULL,
  `bADDER` int(11) NOT NULL DEFAULT 0,
  `bMONEY` int(11) NOT NULL DEFAULT 0,
  `bWHO` int(11) NOT NULL DEFAULT 0,
  `bTAKEN` int(11) NOT NULL DEFAULT 0,
  `bTIME` int(11) NOT NULL DEFAULT 0,
  `bDONE` int(11) NOT NULL DEFAULT 0,
  `bREASON` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `busId` int(11) NOT NULL,
  `busName` varchar(255) NOT NULL DEFAULT '',
  `busClass` int(11) NOT NULL DEFAULT 0,
  `busDirector` int(11) NOT NULL DEFAULT 0,
  `busProfit` bigint(25) NOT NULL DEFAULT 0,
  `busYProfit` bigint(25) NOT NULL DEFAULT 0,
  `busCust` int(11) NOT NULL DEFAULT 0,
  `busYCust` int(11) NOT NULL DEFAULT 0,
  `busCash` bigint(25) NOT NULL DEFAULT 0,
  `busDebt` int(11) NOT NULL DEFAULT 0,
  `busImage` varchar(255) NOT NULL DEFAULT '',
  `busDays` bigint(32) NOT NULL DEFAULT 0,
  `busEmployees` int(11) NOT NULL DEFAULT 0,
  `brank` int(11) NOT NULL DEFAULT 0,
  `busDesc` varchar(50) NOT NULL DEFAULT '',
  `bussecurity` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businesses_alerts`
--

CREATE TABLE `businesses_alerts` (
  `alertId` int(11) NOT NULL,
  `alertBusiness` int(11) NOT NULL DEFAULT 0,
  `alertTime` int(11) NOT NULL DEFAULT 0,
  `alertText` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businesses_apps`
--

CREATE TABLE `businesses_apps` (
  `appId` int(11) NOT NULL,
  `appMember` int(11) NOT NULL,
  `appBusiness` int(11) NOT NULL,
  `appText` text NOT NULL,
  `appTime` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businesses_apps`
--

INSERT INTO `businesses_apps` (`appId`, `appMember`, `appBusiness`, `appText`, `appTime`) VALUES
(1, 39, 6, 'need a job', 1561056671),
(3, 179, 1, 'Hellu', 1561480399),
(4, 179, 2, 'Hellu', 1561480433),
(14, 1122, 15, 'Hey!', 1562428860);

-- --------------------------------------------------------

--
-- Table structure for table `businesses_classes`
--

CREATE TABLE `businesses_classes` (
  `classId` int(11) NOT NULL,
  `className` varchar(255) NOT NULL,
  `classDesc` text NOT NULL,
  `classMembers` int(11) NOT NULL,
  `classCost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businesses_classes`
--

INSERT INTO `businesses_classes` (`classId`, `className`, `classDesc`, `classMembers`, `classCost`) VALUES
(1, 'Fireworks stand', 'Our customers will explode in delight with our fireworks. Great for holidays or any special event.', 4, 500000),
(2, 'Hair salon', 'A hair salon is a place where one goes to get their hair cut, as well as styled, highlighted or coloured.', 4, 750000),
(3, 'Law firm', 'A law firm is a business entity formed by one or more lawyers to engage in the practice of law. The money made is determined by the work hours the company sells. The amount of employees will increase this, aswell as the hired lawyers stats.', 6, 4000000),
(4, 'Flower shop', 'A store where flowers are purchased.', 4, 100000),
(5, 'Car dealership', 'Our customers need transportation. Sell them our best and send them on their way.', 8, 6000000),
(6, 'Football Club', 'Lead the way with your team and become the champions.', 10, 12000000);

-- --------------------------------------------------------

--
-- Table structure for table `businesses_members`
--

CREATE TABLE `businesses_members` (
  `bmembId` int(11) NOT NULL,
  `bmembMember` int(11) NOT NULL,
  `bmembBusiness` int(11) NOT NULL DEFAULT 0,
  `bmembCash` int(11) NOT NULL,
  `bmembRank` int(11) NOT NULL DEFAULT 0,
  `bmembDays` bigint(32) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `businesses_ranks`
--

CREATE TABLE `businesses_ranks` (
  `rankId` int(11) NOT NULL,
  `rankName` varchar(255) NOT NULL,
  `rankClass` int(11) NOT NULL,
  `rankCash` int(11) NOT NULL,
  `rankPrim` enum('labour','IQ','strength') NOT NULL,
  `rankSec` enum('labour','IQ','strength') NOT NULL,
  `rankPGain` decimal(11,2) NOT NULL,
  `rankSGain` decimal(11,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `businesses_ranks`
--

INSERT INTO `businesses_ranks` (`rankId`, `rankName`, `rankClass`, `rankCash`, `rankPrim`, `rankSec`, `rankPGain`, `rankSGain`) VALUES
(1, 'Sales person', 1, 1000, 'IQ', 'labour', 30.50, 15.25),
(2, 'Product manager', 1, 2500, 'labour', 'strength', 20.00, 10.00),
(3, 'Cashier', 1, 5000, 'IQ', 'strength', 25.00, 12.00),
(4, 'Stylist', 2, 800, 'IQ', 'labour', 25.00, 12.50),
(5, 'Cleaner', 2, 1400, 'labour', 'strength', 20.00, 10.00),
(6, 'Shampooist', 2, 2100, 'strength', 'labour', 25.00, 12.50),
(7, 'Lawyer', 3, 1200, 'IQ', 'labour', 40.00, 20.00),
(8, 'Cleaner', 3, 800, 'labour', 'strength', 20.00, 10.00),
(9, 'Receptionist', 3, 600, 'IQ', 'labour', 30.00, 15.00),
(10, 'Florist', 4, 500, 'labour', 'strength', 25.00, 12.50),
(11, 'Cleaner', 4, 750, 'labour', 'IQ', 20.00, 10.00),
(12, 'Salesman', 5, 3400, 'labour', 'strength', 30.00, 15.00),
(13, 'Cleaner', 5, 1400, 'labour', 'strength', 20.00, 10.00),
(14, 'Receptionist', 5, 900, 'IQ', 'labour', 34.00, 17.00),
(15, 'Referee', 6, 3150, 'labour', 'strength', 15.00, 10.00),
(16, 'Player', 6, 3500, 'labour', 'IQ', 28.00, 7.00),
(17, 'Goal Keeper', 6, 3100, 'labour', 'strength', 25.00, 7.00);

-- --------------------------------------------------------

--
-- Table structure for table `cashxferlogs`
--

CREATE TABLE `cashxferlogs` (
  `cxID` int(11) NOT NULL,
  `cxFROM` int(11) NOT NULL DEFAULT 0,
  `cxTO` int(11) NOT NULL DEFAULT 0,
  `cxAMOUNT` bigint(20) NOT NULL DEFAULT 0,
  `cxTIME` int(11) NOT NULL DEFAULT 0,
  `cxFROMIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `cxTOIP` varchar(15) NOT NULL DEFAULT '127.0.0.1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashxferlogs`
--

INSERT INTO `cashxferlogs` (`cxID`, `cxFROM`, `cxTO`, `cxAMOUNT`, `cxTIME`, `cxFROMIP`, `cxTOIP`) VALUES
(1, 31, 42, 50000, 1560755593, '120.148.77.251', '174.44.19.149'),
(2, 184, 28, 437534, 1560799476, '172.58.228.82', '73.150.1.42'),
(3, 28, 42, 1000000, 1560799651, '73.150.1.42', '174.44.19.149'),
(4, 833, 28, 301300, 1560807163, '172.58.106.66', '73.150.1.42'),
(5, 44, 1, 160000000, 1560962237, '98.199.64.220', '5.67.123.78'),
(6, 833, 28, 500000, 1560992716, '172.58.110.14', '73.150.1.42'),
(7, 28, 50, 10000000, 1560993822, '73.150.1.42', '107.128.8.150'),
(8, 28, 1, 100000000, 1560995065, '73.150.1.42', '213.205.240.48'),
(9, 156, 991, 30000, 1561031091, '172.58.185.65', '172.90.133.243'),
(10, 158, 1, 70000000, 1561072014, '172.58.221.146', '5.67.123.78'),
(11, 169, 44, 253681, 1561072987, '143.159.136.21', '98.200.8.144'),
(12, 905, 911, 50000, 1561090290, '174.23.187.244', '137.25.93.82'),
(13, 31, 42, 564709, 1561091592, '120.148.23.128', '174.44.19.149'),
(14, 28, 42, 6000000, 1561094212, '73.150.1.42', '174.44.19.149'),
(15, 28, 1022, 7500000, 1561113760, '73.150.1.42', '71.231.8.204'),
(16, 28, 1022, 2500000, 1561113777, '73.150.1.42', '71.231.8.204'),
(17, 28, 1022, 10000000, 1561135189, '73.150.1.42', '174.216.14.217'),
(18, 1045, 1052, 6000, 1561157825, '172.242.229.23', '172.79.193.103'),
(19, 911, 905, 160313, 1561169531, '137.25.93.82', '174.23.129.57'),
(20, 911, 905, 226099, 1561213470, '137.25.93.82', '174.23.129.57'),
(21, 44, 877, 11042784, 1561262160, '71.132.172.78', '73.157.30.206'),
(22, 28, 1047, 5000000, 1561342743, '73.150.1.42', '92.23.228.76'),
(23, 29, 182, 3000000, 1561352548, '174.224.18.253', '174.224.3.242'),
(24, 996, 1022, 1000, 1561583588, '2.98.65.119', '71.231.8.204'),
(25, 1066, 1047, 250000, 1561746802, '172.56.26.196', '92.2.241.100'),
(26, 861, 182, 10912725, 1561961061, '86.136.178.18', '174.224.18.36'),
(27, 996, 1104, 820, 1562048298, '2.98.65.119', '99.16.156.219'),
(28, 996, 1104, 819270, 1562048323, '2.98.65.119', '99.16.156.219'),
(29, 861, 156, 197900, 1562326809, '109.156.191.189', '172.58.184.160'),
(30, 1027, 1, 75000, 1562336317, '63.131.191.15', '5.66.211.23');

-- --------------------------------------------------------

--
-- Table structure for table `challengebots`
--

CREATE TABLE `challengebots` (
  `cb_id` int(11) NOT NULL,
  `cb_npcid` int(11) NOT NULL DEFAULT 0,
  `cb_money` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challengebots`
--

INSERT INTO `challengebots` (`cb_id`, `cb_npcid`, `cb_money`) VALUES
(18, 933, 500);

-- --------------------------------------------------------

--
-- Table structure for table `challengesbeaten`
--

CREATE TABLE `challengesbeaten` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT 0,
  `npcid` int(11) NOT NULL DEFAULT 0,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat2`
--

CREATE TABLE `chat2` (
  `id` int(11) NOT NULL,
  `time` int(11) NOT NULL DEFAULT 0,
  `user` varchar(100) NOT NULL DEFAULT '',
  `userid` int(11) NOT NULL,
  `chat` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chatjaillogs`
--

CREATE TABLE `chatjaillogs` (
  `jaID` int(11) NOT NULL,
  `jaJAILER` int(11) NOT NULL DEFAULT 0,
  `jaJAILED` int(11) NOT NULL DEFAULT 0,
  `jaDAYS` int(11) NOT NULL DEFAULT 0,
  `jaREASON` longtext NOT NULL,
  `jaTIME` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chatjaillogs`
--

INSERT INTO `chatjaillogs` (`jaID`, `jaJAILER`, `jaJAILED`, `jaDAYS`, `jaREASON`, `jaTIME`) VALUES
(1, 2, 2, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491),
(2, 2, 1252, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491),
(3, 2, 1251, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491),
(4, 2, 1202, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491),
(5, 2, 1246, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491),
(6, 2, 1250, 5, 'Same IP users, against the rules! Mail webmail@topmafia.net with your case.', 1591843491);

-- --------------------------------------------------------

--
-- Table structure for table `chat_box`
--

CREATE TABLE `chat_box` (
  `chat_id` int(11) NOT NULL,
  `chat_user` int(11) NOT NULL,
  `chat_to` int(11) NOT NULL,
  `chat_text` varchar(255) NOT NULL,
  `chat_time` int(11) NOT NULL,
  `chat_channel` int(11) NOT NULL,
  `chat_gang` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat_channels`
--

CREATE TABLE `chat_channels` (
  `channel_id` int(11) NOT NULL,
  `channel_alias` varchar(255) NOT NULL,
  `channel_name` varchar(255) NOT NULL,
  `channel_open` int(1) NOT NULL,
  `channel_req` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_channels`
--

INSERT INTO `chat_channels` (`channel_id`, `channel_alias`, `channel_name`, `channel_open`, `channel_req`) VALUES
(1, 'general_chat', 'General Chat', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `cityid` int(11) NOT NULL,
  `cityname` varchar(255) NOT NULL DEFAULT '',
  `citydesc` longtext NOT NULL,
  `cityminlevel` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`cityid`, `cityname`, `citydesc`, `cityminlevel`) VALUES
(1, 'Miami', 'Hometown of petty theifs ', 1),
(2, 'New York', 'Business as usual', 15),
(3, 'California', 'Home of The Crips and The Bloods', 60),
(4, 'London', 'Home of The Adams Crime Family', 80),
(5, 'Russia', 'Vicious part of the world full of former KGB agents and con artists', 100);

-- --------------------------------------------------------

--
-- Table structure for table `compspecials`
--

CREATE TABLE `compspecials` (
  `csID` int(11) NOT NULL,
  `csNAME` varchar(255) NOT NULL DEFAULT '',
  `csJOB` int(11) NOT NULL DEFAULT 0,
  `csCOST` int(11) NOT NULL DEFAULT 0,
  `csMONEY` int(11) NOT NULL DEFAULT 0,
  `csCRYSTALS` int(11) NOT NULL DEFAULT 0,
  `csITEM` int(11) NOT NULL DEFAULT 0,
  `csENDU` int(11) NOT NULL DEFAULT 0,
  `csIQ` int(11) NOT NULL DEFAULT 0,
  `csLABOUR` int(11) NOT NULL DEFAULT 0,
  `csSTR` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactlist`
--

CREATE TABLE `contactlist` (
  `cl_ID` int(11) NOT NULL,
  `cl_ADDER` int(11) NOT NULL DEFAULT 0,
  `cl_ADDED` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contactlist`
--

INSERT INTO `contactlist` (`cl_ID`, `cl_ADDER`, `cl_ADDED`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 1039, 50),
(4, 1002, 1036),
(5, 1044, 1036),
(6, 1045, 1052),
(7, 1047, 1),
(9, 1027, 1047),
(10, 29, 31),
(11, 1112, 1104),
(12, 1112, 169),
(13, 911, 1104),
(14, 1112, 905),
(15, 1122, 1047);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `crID` int(11) NOT NULL,
  `crNAME` varchar(255) NOT NULL DEFAULT '',
  `crDESC` text NOT NULL,
  `crCOST` int(11) NOT NULL DEFAULT 0,
  `crENERGY` int(11) NOT NULL DEFAULT 0,
  `crDAYS` int(11) NOT NULL DEFAULT 0,
  `crSTR` int(11) NOT NULL DEFAULT 0,
  `crGUARD` int(11) NOT NULL DEFAULT 0,
  `crLABOUR` int(11) NOT NULL DEFAULT 0,
  `crAGIL` int(11) NOT NULL DEFAULT 0,
  `crIQ` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`crID`, `crNAME`, `crDESC`, `crCOST`, `crENERGY`, `crDAYS`, `crSTR`, `crGUARD`, `crLABOUR`, `crAGIL`, `crIQ`) VALUES
(1, 'Beginner Boxing Course', 'learn the basics of boxing', 2500, 25, 2, 50, 30, 100, 20, 10),
(2, 'Intermediate Boxing Course', 'Learn advance boxing techniques', 5000, 50, 3, 75, 40, 150, 50, 50),
(3, 'Beginner Mafia Course', 'your first step for getting to the top', 15000, 50, 4, 200, 200, 200, 200, 100),
(4, 'Intermediate  Mafia Course', 'your second step for getting to the top', 25000, 0, 7, 250, 250, 200, 250, 200),
(5, 'Advanced Mafia Course', 'your third step for getting to the top', 35000, 0, 12, 350, 350, 275, 350, 250),
(6, 'Beginner Gun Handling ', 'your first step for better gun handling', 30000, 0, 7, 300, 300, 250, 300, 200),
(7, 'Intermediate Gun Handling', 'your second step for better gun handling', 40000, 0, 10, 400, 375, 300, 400, 275),
(8, 'Advanced Gun Handling', 'Your last step for better gun  handling', 50000, 0, 15, 450, 450, 425, 450, 350),
(9, 'Beginner Account Course', 'Your first step for get over the IRS', 30000, 0, 7, 350, 350, 300, 350, 275),
(10, 'Intermediate Account Course', 'Your second step for get over the IRS', 40000, 0, 10, 400, 400, 350, 400, 300),
(11, 'Advanced Account Course', 'Your third  step for get over the IRS', 50000, 0, 15, 450, 450, 375, 450, 375),
(12, 'Beginner Boss Course', 'Your fourth step for get to the top', 75000, 0, 10, 500, 500, 400, 500, 400),
(13, 'Intermediate Boss Course', 'Your fifth step for get to the top', 100000, 0, 15, 750, 750, 500, 750, 500),
(14, 'Advanced Boss Course', 'Your sixth step for get to the top', 150000, 0, 20, 1000, 1000, 750, 1000, 750),
(15, 'Beginner Underground Leader', 'Your seventh step for get to the top', 250000, 0, 21, 2000, 2000, 1500, 2000, 1500),
(16, 'Intermediate Underground Leader', 'Your eighth step for get to the top', 500000, 0, 21, 2500, 2500, 2000, 2500, 2000),
(17, 'Advanced Underground Leader', 'Your ninth step for get to the top', 750000, 0, 21, 3000, 3000, 2500, 3000, 2500),
(18, 'Underground Boss', 'Your tenth and last step for getting to the top', 1000000, 0, 21, 5000, 5000, 4000, 5000, 4000),
(19, 'Beginner World Leader', 'Your first step for world domination ', 2500000, 0, 21, 10000, 10000, 7500, 10000, 7500),
(20, 'Intermediate World Leader', 'Your second step for world domination ', 5000000, 0, 21, 15000, 1500, 10000, 15000, 10000),
(21, 'Advanced World Leader', 'Your Third step for world domination ', 7500000, 0, 21, 20000, 20000, 15000, 20000, 15000),
(22, 'World Leader', 'Now you are ready to take on the world', 10000000, 0, 21, 50000, 50000, 50000, 50000, 25000);

-- --------------------------------------------------------

--
-- Table structure for table `coursesdone`
--

CREATE TABLE `coursesdone` (
  `userid` int(11) NOT NULL DEFAULT 0,
  `courseid` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursesdone`
--

INSERT INTO `coursesdone` (`userid`, `courseid`) VALUES
(31, 1),
(42, 1),
(38, 1),
(169, 1),
(861, 1),
(926, 1),
(991, 1),
(868, 1),
(889, 1),
(992, 1),
(996, 1),
(998, 1),
(1002, 1),
(1003, 1),
(21, 1),
(858, 1),
(905, 1),
(958, 1),
(1012, 1),
(31, 2),
(169, 2),
(861, 2),
(991, 2),
(1027, 1),
(1039, 1),
(1038, 1),
(37, 3),
(1044, 1),
(868, 2),
(996, 2),
(858, 2),
(905, 2),
(958, 2),
(998, 2),
(1002, 2),
(992, 2),
(1027, 2),
(1039, 2),
(1047, 1),
(31, 3),
(42, 6),
(169, 3),
(1044, 2),
(991, 3),
(1035, 1),
(29, 1),
(179, 1),
(996, 3),
(1022, 4),
(1061, 1),
(858, 3),
(868, 3),
(905, 3),
(958, 3),
(959, 4),
(1002, 3),
(992, 3),
(1020, 1),
(1027, 3),
(1039, 3),
(1044, 3),
(21, 2),
(911, 1),
(1, 3),
(42, 3),
(982, 1),
(169, 4),
(991, 4),
(1037, 1),
(1104, 1),
(31, 4),
(889, 2),
(996, 4),
(1112, 1),
(21, 3),
(868, 4),
(905, 4),
(958, 4),
(1010, 8),
(982, 3),
(1002, 4),
(1104, 2),
(1119, 1),
(158, 1),
(911, 2),
(1027, 4),
(1105, 3),
(1122, 1),
(156, 14),
(1120, 2),
(982, 2),
(858, 4),
(1112, 4),
(29, 11),
(1044, 5),
(1061, 8),
(169, 5),
(991, 5),
(905, 5),
(1047, 14),
(958, 5),
(37, 14),
(50, 18),
(1022, 18);

-- --------------------------------------------------------

--
-- Table structure for table `creditmarket`
--

CREATE TABLE `creditmarket` (
  `cmID` int(11) NOT NULL,
  `cmQTY` int(11) NOT NULL DEFAULT 0,
  `cmADDER` int(11) NOT NULL DEFAULT 0,
  `cmPRICE` bigint(40) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `creditxferlogs`
--

CREATE TABLE `creditxferlogs` (
  `cxID` int(11) NOT NULL,
  `cxFROM` int(11) NOT NULL DEFAULT 0,
  `cxTO` int(11) NOT NULL DEFAULT 0,
  `cxAMOUNT` bigint(20) NOT NULL DEFAULT 0,
  `cxTIME` int(11) NOT NULL DEFAULT 0,
  `cxFROMIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `cxTOIP` varchar(15) NOT NULL DEFAULT '127.0.0.1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `creditxferlogs`
--

INSERT INTO `creditxferlogs` (`cxID`, `cxFROM`, `cxTO`, `cxAMOUNT`, `cxTIME`, `cxFROMIP`, `cxTOIP`) VALUES
(1, 44, 877, 73, 1561262142, '71.132.172.78', '73.157.30.206'),
(2, 991, 156, 100, 1561558229, '172.90.133.243', '172.58.184.189'),
(3, 905, 1047, 200, 1561841361, '174.23.148.236', '92.2.241.100'),
(4, 1061, 911, 10, 1562371019, '173.176.196.9', '107.77.227.8');

-- --------------------------------------------------------

--
-- Table structure for table `credit_items`
--

CREATE TABLE `credit_items` (
  `id` mediumint(8) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cat` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `credit_items`
--

INSERT INTO `credit_items` (`id`, `item_id`, `item_quant`, `credits`, `quantity`, `cat`) VALUES
(102, 202, 1, 10, -1, 1),
(86, 95, 1, 20, -1, 1),
(84, 215, 25, 5, -1, 1),
(1, 222, 1, 1, -1, 1),
(87, 90, 1, 5, -1, 1),
(90, 204, 1, 5, -1, 1),
(101, 223, 1, 5, -1, 1),
(99, 203, 1, 1, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `credit_packages`
--

CREATE TABLE `credit_packages` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `credits` mediumint(8) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `crimegroups`
--

CREATE TABLE `crimegroups` (
  `cgID` int(11) NOT NULL,
  `cgNAME` varchar(255) NOT NULL DEFAULT '',
  `cgORDER` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crimegroups`
--

INSERT INTO `crimegroups` (`cgID`, `cgNAME`, `cgORDER`) VALUES
(4, 'Novice Mob Crimes Level 10+', 3),
(2, 'Beginner Crimes Level 7+', 1),
(3, 'Trainee Crimes Level 1+', 2),
(5, 'Intermediate Mob Crimes Level 20+', 4),
(7, 'Under Boss Crimes Level 40+', 5),
(8, 'Intermediate Under Boss Crimes Level 50+', 6),
(9, 'Advanced Under Boss Crimes Level 60+', 7),
(10, 'Boss Crimes Level 70+', 8),
(13, 'Godfather Crimes Level 100+', 9),
(14, 'Intermediate Godfather Crimes Level 110+', 10),
(18, 'kk', 12),
(17, 'asdas', 13),
(19, 'test', 11);

-- --------------------------------------------------------

--
-- Table structure for table `crimes`
--

CREATE TABLE `crimes` (
  `crimeID` int(11) NOT NULL,
  `crimeNAME` varchar(255) NOT NULL DEFAULT '',
  `crimeBRAVE` int(11) NOT NULL DEFAULT 0,
  `crimePERCFORM` text NOT NULL,
  `crimeSUCCESSMUNY` int(11) NOT NULL DEFAULT 0,
  `crimeSUCCESSCRYS` int(11) NOT NULL DEFAULT 0,
  `crimeSUCCESSITEM` int(11) NOT NULL DEFAULT 0,
  `crimeGROUP` int(11) NOT NULL DEFAULT 0,
  `crimeJAILTIME` int(10) NOT NULL DEFAULT 0,
  `crimeXP` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crimes`
--

INSERT INTO `crimes` (`crimeID`, `crimeNAME`, `crimeBRAVE`, `crimePERCFORM`, `crimeSUCCESSMUNY`, `crimeSUCCESSCRYS`, `crimeSUCCESSITEM`, `crimeGROUP`, `crimeJAILTIME`, `crimeXP`) VALUES
(29, 'Sell Arms Underground', 51, '95', 2550, 0, 0, 5, 5, 18),
(34, 'Burn Police Station', 67, '95', 4050, 0, 0, 9, 5, 22),
(28, 'Steal Weapons From Enemy Mob', 47, '95', 2050, 0, 0, 5, 5, 17),
(27, 'Take Out Snitch', 43, '95', 1550, 0, 0, 5, 5, 16),
(17, 'Start Protection Racket', 17, '95', 225, 0, 0, 2, 5, 6),
(18, 'Museum Heist', 18, '95', 330, 0, 0, 2, 5, 7),
(37, 'Hijack Bank Truck', 79, '80', 2550, 2, 0, 9, 5, 25),
(22, 'Jewelry Store Robbery', 23, '95', 550, 0, 0, 4, 5, 11),
(36, 'Bomb Enemy Mobs Shipment', 75, '95', 7050, 0, 0, 9, 5, 24),
(21, 'Sell Liquor To Minors', 21, '90', 125, 1, 0, 2, 5, 10),
(19, 'Electronic Store Robbery', 19, '95', 365, 0, 0, 2, 5, 8),
(20, 'Liquor Smuggling', 20, '95', 445, 0, 14, 2, 5, 9),
(23, 'Infiltrate Mob Base', 27, '95', 650, 0, 0, 4, 5, 12),
(24, 'Take Out Mob Member', 31, '95', 750, 0, 0, 4, 5, 13),
(25, 'Rob Downtown Bank', 35, '95', 1045, 0, 0, 4, 5, 14),
(35, 'Manufacture Counterfeit Bills', 71, '95', 5250, 0, 0, 9, 5, 23),
(26, 'Hide Illegal Goods', 39, '90', 700, 1, 0, 4, 5, 15),
(11, 'Shoplifting', 2, '99', 25, 0, 0, 3, 5, 1),
(38, 'Bribe Judge To Drop Case', 83, '95', 7800, 0, 0, 7, 5, 26),
(12, 'Street Mugging', 3, '99', 50, 0, 0, 3, 5, 2),
(13, 'Breaking And Entering', 4, '97', 75, 0, 0, 3, 5, 3),
(15, 'Grand Theft Auto', 5, '97', 100, 0, 0, 3, 5, 4),
(16, 'Liquor Store Robbery', 6, '90', 50, 1, 0, 3, 5, 5),
(30, 'Extort Local Business', 55, '95', 3050, 0, 87, 5, 5, 19),
(31, 'Burn Police Station', 59, '85', 800, 2, 0, 5, 5, 20),
(33, 'Plant Evidence On Enemy Mob', 63, '95', 3500, 0, 0, 9, 5, 21),
(39, 'Take Out Prosecuter', 87, '95', 8700, 0, 0, 7, 5, 27),
(40, 'Protect The Godfather', 91, '95', 9800, 0, 0, 7, 5, 28),
(41, 'Survive A Bloody Shoot Out', 95, '95', 10300, 0, 0, 7, 5, 29),
(42, 'Destroy Enemy Weapon Supply', 99, '85', 7000, 2, 0, 7, 5, 30),
(43, 'Bootlegging Racket', 103, '95', 12050, 0, 0, 8, 5, 31),
(44, 'Take Out FBI Squad ', 107, '95', 15000, 0, 0, 8, 5, 32),
(45, 'Burn Down Casino', 111, '95', 18000, 0, 0, 8, 5, 33),
(46, 'Drive Enemy Mob Off Your Turf', 115, '95', 21050, 0, 0, 8, 5, 34),
(47, 'Expand Your Influence', 119, '80', 5000, 3, 0, 8, 5, 35),
(48, 'Eliminate Harbor Security', 123, '95', 27550, 0, 0, 9, 5, 36),
(49, 'Escape FBI Lock Down', 127, '95', 31050, 0, 0, 9, 5, 37),
(50, 'Rig City Election', 131, '95', 37550, 0, 0, 9, 5, 38),
(51, 'Destroy Enemy Shipment Trucks', 135, '95', 42150, 0, 0, 9, 5, 39),
(53, 'Import Illegal Goods', 143, '95', 45050, 0, 0, 10, 5, 41),
(54, 'Hide Illegal Imports From FBI', 147, '95', 52050, 0, 0, 10, 5, 42),
(55, 'Drive Out Mexican Cartel', 175, '95', 62550, 0, 1, 10, 5, 43),
(56, 'Bribe ATF Agents', 180, '95', 65800, 0, 0, 10, 5, 44),
(57, 'Execute Prison Break', 213, '80', 15000, 7, 0, 10, 5, 45),
(67, 'Commit Stock Fraud', 250, '80', 25000, 5, 0, 9, 5, 55),
(72, 'Commit Securities Embezzlement', 219, '80', 10000, 8, 0, 13, 5, 60),
(77, 'Build Illegal Casino', 275, '80', 35000, 8, 0, 14, 5, 65),
(82, 'Smuggle Biological Weapons', 299, '80', 24000, 11, 0, 9, 5, 70),
(89, 'Pick Pocket', 1, '99', 10, 0, 0, 3, 5, 1),
(90, 'Hijack President Jet', 345, '80', 50000, 13, 180, 9, 15, 87),
(91, 'iadsada', 50, '50', 50, 50, 0, 9, 50, 50),
(93, 'test1', 50, '50', 50, 50, 0, 9, 50, 50),
(94, 'test2', 505, '50', 50, 50, 188, 9, 50, 50);

-- --------------------------------------------------------

--
-- Table structure for table `crime_items`
--

CREATE TABLE `crime_items` (
  `id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cat` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crime_items`
--

INSERT INTO `crime_items` (`id`, `item_id`, `item_quant`, `credits`, `quantity`, `cat`) VALUES
(1, 86, 1, 25000, -1, 1),
(2, 213, 1, 10000, -1, 1),
(4, 88, 1, 50000, -1, 1),
(22, 160, 1, 5000, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `crystallotto`
--

CREATE TABLE `crystallotto` (
  `ticketid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `crystallottowinners`
--

CREATE TABLE `crystallottowinners` (
  `id` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crystallottowinners`
--

INSERT INTO `crystallottowinners` (`id`, `winner`, `amount`) VALUES
(1, 28, 8960),
(2, 1037, 5440),
(3, 1047, 10480),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0),
(18, 0, 0),
(19, 0, 0),
(20, 0, 0),
(21, 0, 0),
(22, 0, 0),
(23, 0, 0),
(24, 0, 0),
(25, 0, 0),
(26, 0, 0),
(27, 0, 0),
(28, 0, 0),
(29, 0, 0),
(30, 0, 0),
(31, 0, 0),
(32, 0, 0),
(33, 0, 0),
(34, 0, 0),
(35, 0, 0),
(36, 0, 0),
(37, 0, 0),
(38, 0, 0),
(39, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `crystalmarket`
--

CREATE TABLE `crystalmarket` (
  `cmID` int(11) NOT NULL,
  `cmQTY` int(11) NOT NULL DEFAULT 0,
  `cmADDER` int(11) NOT NULL DEFAULT 0,
  `cmPRICE` bigint(40) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crystalmarket`
--

INSERT INTO `crystalmarket` (`cmID`, `cmQTY`, `cmADDER`, `cmPRICE`) VALUES
(620, 1895, 1035, 18950000),
(624, 100, 21, 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `crystalxferlogs`
--

CREATE TABLE `crystalxferlogs` (
  `cxID` int(11) NOT NULL,
  `cxFROM` int(11) NOT NULL DEFAULT 0,
  `cxTO` int(11) NOT NULL DEFAULT 0,
  `cxAMOUNT` int(11) NOT NULL DEFAULT 0,
  `cxTIME` int(11) NOT NULL DEFAULT 0,
  `cxFROMIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `cxTOIP` varchar(15) NOT NULL DEFAULT '127.0.0.1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crystalxferlogs`
--

INSERT INTO `crystalxferlogs` (`cxID`, `cxFROM`, `cxTO`, `cxAMOUNT`, `cxTIME`, `cxFROMIP`, `cxTOIP`) VALUES
(1, 159, 158, 112, 1560789194, '96.238.35.183', '172.58.221.36'),
(2, 159, 158, 100, 1560789574, '96.238.35.183', '172.58.221.36'),
(3, 184, 28, 250, 1560800672, '172.58.228.82', '73.150.1.42'),
(4, 28, 42, 600, 1560800794, '73.150.1.42', '174.44.19.149'),
(5, 833, 28, 510, 1560807187, '172.58.106.66', '73.150.1.42'),
(6, 833, 28, 1300, 1560992736, '172.58.110.14', '73.150.1.42'),
(7, 50, 1037, 50, 1561007113, '107.128.8.150', '50.25.131.116'),
(8, 861, 1022, 38, 1561017877, '109.156.191.217', '71.231.8.204'),
(9, 861, 21, 28, 1561022778, '109.156.191.217', '172.56.42.98'),
(10, 867, 861, 92, 1561035310, '69.139.16.182', '109.156.191.217'),
(11, 991, 156, 100, 1561035981, '172.90.133.243', '172.58.185.65'),
(12, 861, 1022, 3280, 1561086374, '109.156.191.217', '71.231.8.204'),
(13, 42, 31, 1000, 1561093156, '174.44.19.149', '120.148.23.128'),
(14, 42, 31, 90, 1561094446, '174.44.19.149', '120.148.23.128'),
(15, 28, 50, 3000, 1561096362, '73.150.1.42', '107.128.8.150'),
(16, 28, 996, 2000, 1561098027, '73.150.1.42', '82.41.36.93'),
(17, 28, 31, 2000, 1561098112, '73.150.1.42', '120.148.23.128'),
(18, 905, 911, 1000, 1561166168, '174.23.129.57', '137.25.93.82'),
(19, 911, 905, 1506, 1561169486, '137.25.93.82', '174.23.129.57'),
(20, 905, 911, 1600, 1561171567, '174.23.129.57', '137.25.93.82'),
(21, 911, 905, 1663, 1561213493, '137.25.93.82', '174.23.129.57'),
(22, 50, 1037, 150, 1561256175, '107.128.8.150', '99.203.86.232'),
(23, 1022, 996, 10, 1561258759, '71.231.8.204', '2.98.64.196'),
(24, 21, 1045, 56, 1561299878, '73.157.10.252', '172.242.229.23'),
(25, 1047, 1022, 2000, 1561326881, '92.23.228.76', '174.216.13.134'),
(26, 44, 877, 200, 1561330751, '71.132.172.78', '73.157.30.206'),
(27, 44, 877, 106, 1561330828, '71.132.172.78', '73.157.30.206'),
(28, 1047, 28, 5000, 1561342720, '85.255.237.85', '73.150.1.42'),
(29, 158, 28, 5000, 1561342869, '172.58.223.190', '73.150.1.42'),
(30, 28, 42, 2000, 1561343161, '73.150.1.42', '174.44.19.149'),
(31, 28, 50, 1000, 1561343237, '73.150.1.42', '107.128.8.150'),
(32, 905, 911, 5000, 1561347701, '174.23.194.104', '137.25.93.82'),
(33, 1047, 1022, 13840, 1561374361, '92.23.228.76', '71.231.8.204'),
(34, 50, 1039, 150, 1561423614, '107.128.8.150', '172.58.23.141'),
(35, 158, 1022, 5000, 1561595417, '172.58.221.152', '174.216.55.62'),
(36, 1066, 1047, 247, 1561698432, '172.58.169.73', '85.255.235.67'),
(37, 868, 1022, 25, 1561759188, '72.134.156.199', '71.231.8.204'),
(38, 867, 861, 30, 1561812003, '69.139.16.182', '109.156.191.152'),
(39, 867, 861, 13, 1561812077, '69.139.16.182', '109.156.191.152'),
(40, 1022, 1088, 1000, 1561865565, '71.231.8.204', '66.177.134.86'),
(41, 861, 182, 518, 1561961070, '86.136.178.18', '174.224.18.36'),
(42, 996, 1104, 390, 1562048350, '2.98.65.119', '99.16.156.219'),
(43, 1112, 169, 3, 1562064492, '106.204.128.206', '143.159.136.21'),
(44, 48, 1047, 6000, 1562088800, '107.77.206.57', '89.242.52.178'),
(45, 1122, 905, 5, 1562295748, '71.211.169.240', '174.23.160.147'),
(46, 158, 159, 1000, 1562300891, '172.58.221.162', '96.238.35.183'),
(47, 159, 158, 1000, 1562301068, '96.238.35.183', '172.58.221.162'),
(48, 861, 156, 42, 1562326787, '109.156.191.189', '172.58.184.160'),
(49, 861, 156, 380, 1562326798, '109.156.191.189', '172.58.184.160'),
(50, 1027, 1, 125, 1562336340, '63.131.191.15', '5.66.211.23'),
(51, 1122, 982, 10, 1562343843, '71.211.169.240', '31.209.196.120'),
(52, 1122, 911, 20, 1562381570, '71.211.172.233', '137.25.93.82'),
(53, 1122, 1047, 30, 1562429291, '71.211.172.233', '92.6.195.45');

-- --------------------------------------------------------

--
-- Table structure for table `crystal_items`
--

CREATE TABLE `crystal_items` (
  `id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cat` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `crystal_items`
--

INSERT INTO `crystal_items` (`id`, `item_id`, `item_quant`, `credits`, `quantity`, `cat`) VALUES
(1, 161, 1, 100, -1, 1),
(2, 1, 25, 1500, -1, 1),
(3, 184, 1, 150, -1, 1),
(8, 87, 1, 10, -1, 1),
(5, 206, 1, 1000, -1, 1),
(6, 220, 1, 50, -1, 1),
(7, 180, 1, 50, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donatetogame`
--

CREATE TABLE `donatetogame` (
  `dID` bigint(40) NOT NULL,
  `total` bigint(40) NOT NULL DEFAULT 0,
  `totalc` bigint(40) NOT NULL DEFAULT 0,
  `user` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` int(11) NOT NULL,
  `buyer` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `buyer`, `timestamp`, `payment`, `quantity`, `item`, `text`) VALUES
(1, 5, 1557677688, 2.99, 1, 192, 'ID 5 has purchased 1 25 Credits (s) for $2.99.'),
(2, 5, 1557677688, 2.99, 1, 192, 'ID 5 has purchased 1 25 Credits (s) for $2.99.'),
(3, 5, 1557677688, 14.99, 5, 192, 'ID 5 has purchased 5 25 Credits (s) for $14.99.'),
(4, 5, 1557677688, 9.99, 1, 193, 'ID 5 has purchased 1 175 Credits (s) for $9.99.'),
(5, 34, 1557677688, 2.99, 1, 192, 'ID 34 has purchased 1 50 Credits (s) for $2.99.'),
(6, 28, 1557770873, 32.89, 11, 192, 'ID 28 has purchased 11 50 Credits(s) for $32.89.'),
(7, 34, 1557792245, 9.99, 1, 193, 'ID 34 has purchased 1 175 Credits(s) for $9.99.'),
(8, 42, 1557793683, 2.99, 1, 192, 'ID 42 has purchased 1 50 Credits(s) for $2.99.'),
(9, 34, 1557819341, 34.99, 1, 194, 'ID 34 has purchased 1 500 Credits(s) for $34.99.'),
(10, 5, 1557867689, 59.80, 20, 192, 'ID 5 has purchased 20 50 Credits(s) for $59.80.'),
(11, 28, 1557868446, 23.92, 8, 192, 'ID 28 has purchased 8 50 Credits(s) for $23.92.'),
(12, 31, 1557869327, 9.99, 1, 193, 'ID 31 has purchased 1 175 Credits(s) for $9.99.'),
(13, 155, 1557975982, 9.99, 1, 193, 'ID 155 has purchased 1 Hitman Pack(s) for $9.99.'),
(14, 47, 1557976105, 9.99, 1, 193, 'ID 47 has purchased 1 Hitman Pack(s) for $9.99.'),
(15, 47, 1557976444, 9.99, 1, 193, 'ID 47 has purchased 1 Hitman Pack(s) for $9.99.'),
(16, 45, 1557983702, 9.99, 1, 193, 'ID 45 has purchased 1 Hitman Pack(s) for $9.99.'),
(17, 45, 1557985274, 34.99, 1, 194, 'ID 45 has purchased 1 Platinum Boss Pack(s) for $34.99.'),
(18, 169, 1558018181, 9.99, 1, 193, 'ID 169 has purchased 1 Hitman Pack(s) for $9.99.'),
(19, 45, 1558028005, 34.99, 1, 194, 'ID 45 has purchased 1 Platinum Boss Pack(s) for $34.99.'),
(20, 28, 1558050329, 11.96, 4, 192, 'ID 28 has purchased 4 Starter Pack(s) for $11.96.'),
(21, 44, 1558363742, 29.97, 3, 193, 'ID 44 has purchased 3 Hitman Pack(s) for $29.97.'),
(22, 182, 1558535642, 5.90, 2, 192, 'ID 182 has purchased 2 Starter Pack(s) for $5.90.'),
(23, 47, 1558560946, 2.95, 1, 192, 'ID 47 has purchased 1 Starter Pack(s) for $2.95.'),
(24, 47, 1558729175, 9.95, 1, 193, 'ID 47 has purchased 1 Hitman Pack(s) for $9.95.'),
(25, 37, 1558787453, 2.66, 1, 192, 'ID 37 has purchased 1 Starter Pack(s) for $2.66.'),
(26, 28, 1558789510, 26.96, 1, 194, 'ID 28 has purchased 1 Platinum Boss Pack(s) for $26.96.'),
(27, 156, 1558790731, 8.96, 1, 193, 'ID 156 has purchased 1 Hitman Pack(s) for $8.96.'),
(28, 855, 1558797900, 8.96, 1, 193, 'ID 855 has purchased 1 Hitman Pack(s) for $8.96.'),
(29, 182, 1558829220, 5.31, 2, 192, 'ID 182 has purchased 2 Starter Pack(s) for $5.31.'),
(30, 182, 1558932974, 2.66, 1, 192, 'ID 182 has purchased 1 Starter Pack(s) for $2.66.'),
(31, 31, 1558940393, 8.96, 1, 193, 'ID 31 has purchased 1 Hitman Pack(s) for $8.96.'),
(32, 179, 1558953708, 2.66, 1, 192, 'ID 179 has purchased 1 Starter Pack(s) for $2.66.'),
(33, 47, 1559184993, 74.95, 1, 196, 'ID 47 has purchased 1 Ultimate Mafia Pack(s) for $74.95.'),
(34, 875, 1559190041, 9.95, 1, 193, 'ID 875 has purchased 1 Hitman Pack(s) for $9.95.'),
(35, 877, 1559235624, 5.90, 2, 192, 'ID 877 has purchased 2 Starter Pack(s) for $5.90.'),
(36, 899, 1559251290, 5.90, 2, 192, 'ID 899 has purchased 2 Starter Pack(s) for $5.90.'),
(37, 900, 1559259858, 5.90, 2, 192, 'ID 900 has purchased 2 Starter Pack(s) for $5.90.'),
(38, 899, 1559263429, 5.90, 2, 192, 'ID 899 has purchased 2 Starter Pack(s) for $5.90.'),
(39, 900, 1559345041, 19.90, 2, 193, 'ID 900 has purchased 2 Hitman Pack(s) for $19.90.'),
(40, 877, 1559347510, 9.95, 1, 193, 'ID 877 has purchased 1 Hitman Pack(s) for $9.95.'),
(41, 877, 1559353792, 15.49, 7, 192, 'ID 877 has purchased 7 Starter Pack(s) for $15.49.'),
(42, 899, 1559353938, 8.85, 4, 192, 'ID 899 has purchased 4 Starter Pack(s) for $8.85.'),
(43, 877, 1559360675, 7.46, 1, 193, 'ID 877 has purchased 1 Hitman Pack(s) for $7.46.'),
(44, 877, 1559360757, 4.43, 2, 192, 'ID 877 has purchased 2 Starter Pack(s) for $4.43.'),
(45, 875, 1559363414, 22.46, 1, 194, 'ID 875 has purchased 1 Platinum Boss Pack(s) for $22.46.'),
(46, 905, 1559404514, 22.46, 1, 194, 'ID 905 has purchased 1 Platinum Boss Pack(s) for $22.46.'),
(47, 158, 1559417413, 56.21, 1, 196, 'ID 158 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(48, 158, 1559417606, 22.46, 1, 194, 'ID 158 has purchased 1 Platinum Boss Pack(s) for $22.46.'),
(49, 900, 1559423467, 14.93, 2, 193, 'ID 900 has purchased 2 Hitman Pack(s) for $14.93.'),
(50, 877, 1559437385, 56.21, 1, 196, 'ID 877 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(51, 158, 1559503110, 56.21, 1, 196, 'ID 158 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(52, 900, 1559507326, 56.21, 1, 196, 'ID 900 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(53, 5, 1559508735, 56.21, 1, 196, 'ID 5 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(54, 900, 1559514074, 7.46, 1, 193, 'ID 900 has purchased 1 Hitman Pack(s) for $7.46.'),
(55, 877, 1559527927, 56.21, 1, 196, 'ID 877 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(56, 877, 1559569953, 56.21, 1, 196, 'ID 877 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(57, 169, 1559571377, 22.46, 1, 194, 'ID 169 has purchased 1 Platinum Boss Pack(s) for $22.46.'),
(58, 28, 1559582174, 56.21, 1, 196, 'ID 28 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(59, 28, 1559584058, 22.46, 1, 194, 'ID 28 has purchased 1 Platinum Boss Pack(s) for $22.46.'),
(60, 37, 1559594615, 2.21, 1, 192, 'ID 37 has purchased 1 Starter Pack(s) for $2.21.'),
(61, 182, 1559610895, 29.95, 1, 194, 'ID 182 has purchased 1 Platinum Boss Pack(s) for $29.95.'),
(62, 877, 1559652971, 5.90, 2, 192, 'ID 877 has purchased 2 Starter Pack(s) for $5.90.'),
(63, 156, 1559757570, 9.95, 1, 193, 'ID 156 has purchased 1 Hitman Pack(s) for $9.95.'),
(64, 877, 1559790533, 2.95, 1, 192, 'ID 877 has purchased 1 Starter Pack(s) for $2.95.'),
(65, 905, 1560095413, 41.74, 7, 95, 'ID 905 has purchased 7 Crystal Sack Pack(s) for $41.74.'),
(66, 901, 1560095579, 56.21, 1, 196, 'ID 901 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(67, 905, 1560095772, 8.96, 1, 193, 'ID 905 has purchased 1 Hitman Pack(s) for $8.96.'),
(68, 901, 1560096801, 5.93, 2, 105, 'ID 901 has purchased 2 14-Day VIP Pack(s) for $5.93.'),
(69, 169, 1560097770, 26.24, 1, 194, 'ID 169 has purchased 1 Platinum Boss Pack(s) for $26.24.'),
(70, 901, 1560114269, 56.21, 1, 196, 'ID 901 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(71, 156, 1560120098, 11.93, 2, 95, 'ID 156 has purchased 2 Crystal Sack Pack(s) for $11.93.'),
(72, 899, 1560220492, 11.95, 1, 193, 'ID 899 has purchased 1 Hitman Pack(s) for $11.95.'),
(73, 899, 1560220570, 3.95, 1, 105, 'ID 899 has purchased 1 14-Day VIP Pack(s) for $3.95.'),
(74, 926, 1560239634, 2.95, 1, 103, 'ID 926 has purchased 1 14-Day Donator Pack(s) for $2.95.'),
(75, 926, 1560242847, 3.95, 1, 105, 'ID 926 has purchased 1 14-Day VIP Pack(s) for $3.95.'),
(76, 875, 1560382672, 4.95, 1, 192, 'ID 875 has purchased 1 Starter Pack(s) for $4.95.'),
(77, 875, 1560429328, 4.95, 1, 192, 'ID 875 has purchased 1 Starter Pack(s) for $4.95.'),
(78, 875, 1560482952, 2.96, 1, 105, 'ID 875 has purchased 1 14-Day VIP Pack(s) for $2.96.'),
(79, 156, 1560516158, 17.93, 2, 193, 'ID 156 has purchased 2 Hitman Pack(s) for $17.93.'),
(80, 156, 1560517101, 2.21, 1, 103, 'ID 156 has purchased 1 14-Day Donator Pack(s) for $2.21.'),
(81, 156, 1560517564, 2.21, 1, 103, 'ID 156 has purchased 1 14-Day Donator Pack(s) for $2.21.'),
(82, 156, 1560517833, 2.21, 1, 103, 'ID 156 has purchased 1 14-Day Donator Pack(s) for $2.21.'),
(83, 156, 1560518706, 2.21, 1, 103, 'ID 156 has purchased 1 14-Day Donator Pack(s) for $2.21.'),
(84, 5, 1560538531, 56.21, 1, 196, 'ID 5 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(85, 1022, 1560985106, 3.71, 1, 105, 'ID 1022 has purchased 1 14-Day VIP Pack(s) for $3.71.'),
(86, 1022, 1561008389, 3.71, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $3.71.'),
(87, 905, 1561011071, 56.21, 1, 196, 'ID 905 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(88, 1022, 1561023148, 11.21, 1, 193, 'ID 1022 has purchased 1 Hitman Pack(s) for $11.21.'),
(89, 1022, 1561084032, 11.21, 1, 193, 'ID 1022 has purchased 1 Hitman Pack(s) for $11.21.'),
(90, 1022, 1561084291, 3.71, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $3.71.'),
(91, 1022, 1561103779, 3.71, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $3.71.'),
(92, 1022, 1561109095, 28.46, 1, 194, 'ID 1022 has purchased 1 Platinum Boss Pack(s) for $28.46.'),
(93, 1022, 1561112515, 3.71, 1, 105, 'ID 1022 has purchased 1 14-Day VIP Pack(s) for $3.71.'),
(94, 1022, 1561113663, 11.14, 3, 105, 'ID 1022 has purchased 3 14-Day VIP Pack(s) for $11.14.'),
(95, 31, 1561115281, 3.71, 1, 192, 'ID 31 has purchased 1 Starter Pack(s) for $3.71.'),
(96, 169, 1561125616, 56.21, 1, 196, 'ID 169 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(97, 905, 1561165180, 56.21, 1, 196, 'ID 905 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(98, 1022, 1561166834, 5.96, 1, 127, 'ID 1022 has purchased 1 Pack: Drug Booster Kit(s) for $5.96.'),
(99, 1022, 1561177912, 28.46, 1, 194, 'ID 1022 has purchased 1 Platinum Boss Pack(s) for $28.46.'),
(100, 182, 1561185141, 11.21, 1, 193, 'ID 182 has purchased 1 Hitman Pack(s) for $11.21.'),
(101, 1022, 1561256980, 3.71, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $3.71.'),
(102, 1047, 1561279469, 56.21, 1, 196, 'ID 1047 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(103, 1022, 1561315580, 28.46, 1, 194, 'ID 1022 has purchased 1 Platinum Boss Pack(s) for $28.46.'),
(104, 156, 1561322854, 11.21, 1, 193, 'ID 156 has purchased 1 Hitman Pack(s) for $11.21.'),
(105, 1022, 1561325939, 7.43, 2, 192, 'ID 1022 has purchased 2 Starter Pack(s) for $7.43.'),
(106, 1022, 1561326562, 3.71, 1, 105, 'ID 1022 has purchased 1 14-Day VIP Pack(s) for $3.71.'),
(107, 1061, 1561429039, 14.95, 1, 193, 'ID 1061 has purchased 1 Hitman Pack(s) for $14.95.'),
(108, 1022, 1561549894, 4.95, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $4.95.'),
(109, 991, 1561556985, 74.95, 1, 196, 'ID 991 has purchased 1 Ultimate Mafia Pack(s) for $74.95.'),
(110, 991, 1561557461, 19.80, 4, 105, 'ID 991 has purchased 4 14-Day VIP Pack(s) for $19.80.'),
(111, 991, 1561558683, 37.95, 1, 194, 'ID 991 has purchased 1 Platinum Boss Pack(s) for $37.95.'),
(112, 1022, 1561613263, 7.95, 1, 127, 'ID 1022 has purchased 1 Pack: Drug Booster Kit(s) for $7.95.'),
(113, 1022, 1561613354, 4.95, 1, 192, 'ID 1022 has purchased 1 Starter Pack(s) for $4.95.'),
(114, 1061, 1561686681, 37.95, 1, 194, 'ID 1061 has purchased 1 Platinum Boss Pack(s) for $37.95.'),
(115, 991, 1561731878, 112.43, 2, 196, 'ID 991 has purchased 2 Ultimate Mafia Pack(s) for $112.43.'),
(116, 1022, 1561742249, 7.43, 2, 105, 'ID 1022 has purchased 2 14-Day VIP Pack(s) for $7.43.'),
(117, 1047, 1561744297, 56.21, 1, 196, 'ID 1047 has purchased 1 Ultimate Mafia Pack(s) for $56.21.'),
(118, 1066, 1561760937, 3.71, 1, 105, 'ID 1066 has purchased 1 14-Day VIP Pack(s) for $3.71.'),
(119, 1022, 1561796210, 11.21, 1, 193, 'ID 1022 has purchased 1 Hitman Pack(s) for $11.21.'),
(120, 1022, 1561799873, 11.93, 2, 145, 'ID 1022 has purchased 2 Pack: Drug Booster Guard Kit(s) for $11.93.'),
(121, 1022, 1561846866, 7.43, 2, 105, 'ID 1022 has purchased 2 14-Day VIP Pack(s) for $7.43.'),
(122, 1022, 1561873841, 11.14, 3, 105, 'ID 1022 has purchased 3 14-Day VIP Pack(s) for $11.14.'),
(123, 8, 1562087882, 119.60, 8, 193, 'ID 8 has purchased 8 Hitman Pack(s) for $119.60.'),
(124, 982, 1562089606, 4.99, 1, 105, 'ID 982 has purchased 1 14-Day VIP Pack(s) for $4.99.'),
(125, 1027, 1562333245, 2.99, 1, 105, 'ID 1027 has purchased 1 14-Day VIP Pack(s) for $2.99.');

-- --------------------------------------------------------

--
-- Table structure for table `dpacks`
--

CREATE TABLE `dpacks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `crystals` int(11) NOT NULL,
  `money` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `items` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT 1,
  `hidden` int(11) NOT NULL DEFAULT 0,
  `bogo` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dpacks`
--

INSERT INTO `dpacks` (`id`, `name`, `crystals`, `money`, `days`, `price`, `description`, `items`, `active`, `hidden`, `bogo`) VALUES
(134, 'Platinum Pack', 0, 0, 0, 15.00, '2 x 14 Day VIP Pack, 2 x 14 Day Donator', 2, 0, 1, 0),
(192, 'Starter Pack', 250, 150000, 0, 4.95, '+15 Credits', 1, 1, 0, 0),
(193, 'Hitman Pack', 1000, 500000, 0, 14.95, '+50 Credits', 1, 1, 0, 0),
(194, 'Platinum Boss Pack', 2000, 5000000, 0, 37.95, '+150 Credits', 1, 1, 0, 0),
(196, 'Ultimate Mafia Pack', 5000, 15000000, 0, 74.95, '+500 Credits', 1, 1, 0, 0),
(101, 'Large Whiskey Case', 2000, 0, 0, 7.99, '200 x Whiskey Pack  + Bonus Crystals', 1, 0, 1, 0),
(97, 'Small Whiskey Case', 700, 0, 0, 3.99, '70 x Whiskey Pack + Bonus Crystals', 1, 0, 1, 0),
(96, 'Crystal Mine', 600, 0, 0, 11.50, '400 Crystals +200 Bonus, Item', 2, 0, 1, 0),
(94, 'X-Large Crystal Pack', 175, 0, 0, 6.99, '140 Crystals +35 Bonus', 0, 0, 1, 0),
(95, 'Crystal Sack Pack', 5000, 125000, 0, 7.95, '5000 Crystals', 0, 0, 1, 0),
(93, '10k of Crystals', 10000, 0, 0, 19.95, '10,000 Crystals Pack', 1, 0, 1, 0),
(92, 'Medium Crystal Pack', 95, 0, 0, 3.99, '80 Crystals +15 Bonus', 0, 0, 1, 0),
(90, 'Small Crystal Pack', 1000, 75000, 0, 1.95, '1000 Crystals', 0, 0, 1, 0),
(91, 'Large Crystal Pouch', 70, 0, 0, 2.99, '60 Crystals +10 Bonus', 0, 0, 1, 0),
(102, '7-Day Donator Pack', 65, 0, 7, 4.99, '7-Day Donator', 0, 0, 1, 0),
(103, '14-Day Donator Pack', 100, 75000, 14, 2.95, '14-Day Donator', 0, 0, 1, 0),
(104, '7-Day VIP Pack', 150, 0, 0, 8.99, '7-Day VIP ', 1, 0, 1, 0),
(105, '14-Day VIP Pack', 125, 75000, 0, 4.99, '14-Day VIP ', 1, 1, 0, 0),
(109, 'Donator Armor', 0, 0, 0, 9.99, 'Recieve a Rare Donation Armor', 1, 0, 1, 0),
(110, 'Donator Vehicle', 0, 0, 0, 9.99, 'Receive a Rare Donation Vehicle', 1, 0, 1, 0),
(111, 'Donator Weapon', 0, 0, 0, 9.99, 'Receive a Rare Donation Weapon', 1, 0, 1, 0),
(113, 'Crystal Mine', 7500, 0, 0, 19.99, '7500 Crystals + 150 Whiskeys', 1, 0, 1, 0),
(121, 'Extra Whiskey Box', 4000, 0, 0, 24.99, '500 x Whiskey pack, for those Alcoholics out there! + Bonus Crystals', 1, 0, 1, 0),
(124, 'Item: Top Weapon', 500, 0, 5, 9.99, 'Best Weapon in the game + Bonus 500 crystals & 5 days Donator status', 1, 0, 1, 0),
(126, 'Item: Top Armor', 500, 0, 5, 9.99, 'Best Armor in the game + Bonus 500 crystals & 5 days Donator status', 1, 0, 1, 0),
(127, 'Pack: Drug Booster Kit', 0, 0, 0, 7.95, 'Gain a level, 50 hp, 2 brave and boost your Strength and Agility permanently by 3%!', 3, 1, 0, 0),
(133, 'Item: 14-Days Top Items', 0, 0, 0, 5.00, 'Top Item Pack includes both the Top Weapon and Armor for 14 days then it is removed from your account!', 2, 0, 1, 0),
(134, 'Platinum Pack', 0, 0, 0, 24.99, '2 x 14 Day VIP Pack, 2 x 14 Day Donator', 2, 0, 1, 0),
(145, 'Pack: Drug Booster Guard Kit', 0, 0, 0, 7.95, 'Gain a level, 50 hp, 2 brave and boost your Guard and Strength permanently by 3%!', 3, 1, 0, 0),
(162, 'Item: VIP Bodyguard', 0, 0, 0, 1.99, 'The VIP Bodyguard blocks all incoming attacks for 1 hour, great for hassle free training sessions', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `dpitems`
--

CREATE TABLE `dpitems` (
  `dpid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dpitems`
--

INSERT INTO `dpitems` (`dpid`, `itemid`, `quantity`) VALUES
(109, 108, 1),
(104, 99, 1),
(101, 1, 200),
(96, 1, 5),
(96, 87, 5),
(93, 1, 1000),
(110, 107, 1),
(111, 106, 1),
(113, 1, 150),
(121, 1, 2000),
(122, 93, 1),
(97, 1, 150),
(124, 176, 1),
(126, 177, 1),
(127, 129, 1),
(127, 130, 1),
(127, 131, 1),
(133, 176, 1),
(133, 177, 1),
(134, 103, 2),
(134, 105, 2),
(145, 131, 1),
(145, 146, 1),
(145, 129, 1),
(162, 161, 1),
(192, 187, 1),
(193, 188, 1),
(194, 189, 1),
(197, 191, 1),
(196, 190, 1),
(105, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dplogs`
--

CREATE TABLE `dplogs` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `pack` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `drugsell`
--

CREATE TABLE `drugsell` (
  `cannabis` int(11) NOT NULL DEFAULT 1000,
  `cocaine` int(11) NOT NULL DEFAULT 2000,
  `mm` int(11) NOT NULL DEFAULT 2500,
  `heroin` int(11) NOT NULL DEFAULT 3500,
  `lsd` int(11) NOT NULL DEFAULT 4500
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugsell`
--

INSERT INTO `drugsell` (`cannabis`, `cocaine`, `mm`, `heroin`, `lsd`) VALUES
(27354, 257587, 1468799, 10956185, 25853783);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `evID` int(11) NOT NULL,
  `evUSER` int(11) NOT NULL DEFAULT 0,
  `evTIME` int(11) NOT NULL DEFAULT 0,
  `evREAD` int(11) NOT NULL DEFAULT 0,
  `evTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`evID`, `evUSER`, `evTIME`, `evREAD`, `evTEXT`) VALUES
(22, 5, 1609372805, 0, '<b>Thank you for playing today! You have been rewarded:</b> $4,144,  8 crystals, 53 exp and 1 merit points.'),
(19, 2, 1609372804, 1, '<b>Thank you for playing today! You have been rewarded:</b> $2,174,  8 crystals, 81 exp and 1 merit points.'),
(21, 4, 1609372804, 0, '<b>Thank you for playing today! You have been rewarded:</b> $3,939,  15 crystals, 90 exp and 1 merit points.'),
(14, 4, 1609286403, 0, '<b>Thank you for playing today! You have been rewarded:</b> $2,787,  13 crystals, 49 exp and 1 merit points.'),
(15, 5, 1609286403, 0, '<b>Thank you for playing today! You have been rewarded:</b> $4,401,  15 crystals, 43 exp and 1 merit points.'),
(24, 2, 1609459203, 1, '<b>Thank you for playing today! You have been rewarded:</b> $4,058,  23 crystals, 92 exp and 1 merit points.'),
(26, 4, 1609459204, 0, '<b>Thank you for playing today! You have been rewarded:</b> $1,729,  11 crystals, 58 exp and 1 merit points.'),
(27, 5, 1609459204, 0, '<b>Thank you for playing today! You have been rewarded:</b> $4,382,  21 crystals, 55 exp and 1 merit points.'),
(29, 2, 1609545602, 1, '<b>Thank you for playing today! You have been rewarded:</b> $4,017,  7 crystals, 98 exp and 1 merit points.'),
(31, 4, 1609545603, 0, '<b>Thank you for playing today! You have been rewarded:</b> $4,393,  15 crystals, 10 exp and 1 merit points.'),
(32, 5, 1609545603, 0, '<b>Thank you for playing today! You have been rewarded:</b> $1,024,  1 crystals, 14 exp and 1 merit points.'),
(53, 3, 1609804804, 0, '<b>Thank you for playing today! You have been rewarded:</b> $2,924,  17 crystals, 61 exp and 1 merit points.'),
(50, 1, 1609743321, 1, '<b>Lol123</b> has just signed up to the game!'),
(52, 2, 1609804803, 0, '<b>Thank you for playing today! You have been rewarded:</b> $2,933,  7 crystals, 55 exp and 1 merit points.'),
(34, 2, 1609632004, 1, '<b>Thank you for playing today! You have been rewarded:</b> $4,652,  18 crystals, 67 exp and 1 merit points.'),
(36, 4, 1609632004, 0, '<b>Thank you for playing today! You have been rewarded:</b> $4,367,  5 crystals, 14 exp and 1 merit points.'),
(37, 5, 1609632004, 0, '<b>Thank you for playing today! You have been rewarded:</b> $2,543,  13 crystals, 97 exp and 1 merit points.'),
(51, 1, 1609804803, 0, '<b>Thank you for playing today! You have been rewarded:</b> $1,113,  5 crystals, 90 exp and 1 merit points.'),
(49, 1, 1609742782, 1, '<b>demo</b> has just signed up to the game!'),
(45, 1, 1609741687, 1, '<b>demo</b> has just signed up to the game!'),
(46, 1, 1609742039, 1, '<b>kool</b> has just signed up to the game!'),
(47, 22, 1609742039, 0, 'For referring kool to the game, you have earned 25 crystals!'),
(44, 1, 1609718402, 1, '<b>Thank you for playing today! You have been rewarded:</b> $3,214,  18 crystals, 38 exp and 1 merit points.');

-- --------------------------------------------------------

--
-- Table structure for table `fedjail`
--

CREATE TABLE `fedjail` (
  `fed_id` int(11) NOT NULL,
  `fed_userid` int(11) NOT NULL DEFAULT 0,
  `fed_days` int(11) NOT NULL DEFAULT 0,
  `fed_jailedby` int(11) NOT NULL DEFAULT 0,
  `fed_reason` text NOT NULL,
  `fed_type` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_forums`
--

CREATE TABLE `forum_forums` (
  `ff_id` int(11) NOT NULL,
  `ff_name` varchar(255) NOT NULL DEFAULT '',
  `ff_desc` varchar(255) NOT NULL DEFAULT '',
  `ff_posts` int(11) NOT NULL DEFAULT 0,
  `ff_topics` int(11) NOT NULL DEFAULT 0,
  `ff_lp_time` int(11) NOT NULL DEFAULT 0,
  `ff_lp_poster_id` int(11) NOT NULL DEFAULT 0,
  `ff_lp_poster_name` text NOT NULL,
  `ff_lp_t_id` int(11) NOT NULL DEFAULT 0,
  `ff_lp_t_name` varchar(255) NOT NULL DEFAULT '',
  `ff_auth` enum('public','gang','staff') NOT NULL DEFAULT 'public',
  `ff_owner` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_forums`
--

INSERT INTO `forum_forums` (`ff_id`, `ff_name`, `ff_desc`, `ff_posts`, `ff_topics`, `ff_lp_time`, `ff_lp_poster_id`, `ff_lp_poster_name`, `ff_lp_t_id`, `ff_lp_t_name`, `ff_auth`, `ff_owner`) VALUES
(2, 'General Discussions', 'General talk', 13, 8, 1561511005, 50, 'TheGodFather', 46, 'Game moderator', 'public', 0),
(3, 'Q and A', 'Newbie? Ask and answers questions related to the game', 12, 4, 1558885732, 1, 'N/A', 58, 'N/A', 'public', 0),
(4, 'Black Market', 'Sell, buy or trade post', 3, 1, 1558683929, 29, 'Vask', 20, 'testing', 'public', 0),
(5, 'Bugs Errors', 'Please post any bugs or errors found in the game here', 91, 28, 1562083603, 156, 'PrinceReavon', 48, 'Energy Shot', 'public', 0),
(6, 'Suggestions', 'Post your game ideas here', 160, 42, 1562226982, 1039, 'BOUNCER', 47, 'Ideas', 'public', 0),
(10, 'Contest & Giveaways', 'Contests and giveaways in the games offered by staff or players.', 165, 17, 1561037297, 958, 'bulltat812', 5, '100k Cash & 100 Crystal', 'public', 0),
(16, 'The Untouchables', '', 56, 6, 1559735949, 5, 'Dark', 40, 'I\\\'m leaving', 'gang', 1),
(17, 'BigJugs&DonkeyPunch', '', 3, 2, 1558906472, 47, 'Avalia', 28, 'Gang Name', 'gang', 4),
(18, 'Rawr', '', 0, 0, 0, 0, 'N/A', 0, 'N/A', 'gang', 3),
(19, 'Unforgiven', '', 5, 1, 1561046321, 169, 'Yaotzin', 45, 'Hey everyone. ', 'gang', 10),
(20, 'FuckYou', '', 0, 0, 0, 0, 'N/A', 0, 'N/A', 'gang', 12),
(21, 'Mafia 187', '', 0, 0, 0, 0, 'N/A', 0, 'N/A', 'gang', 13),
(22, 'SINISTER INC.', '', 2, 1, 1562202458, 905, 'BLADE', 49, 'GEAR & HOUSING', 'gang', 9),
(23, 'jajdasjsdaj', 'j', 0, 0, 0, 0, 'N/A', 0, 'N/A', 'public', 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `fp_id` int(11) NOT NULL,
  `fp_topic_id` int(11) NOT NULL DEFAULT 0,
  `fp_forum_id` int(11) NOT NULL DEFAULT 0,
  `fp_poster_id` int(11) NOT NULL DEFAULT 0,
  `fp_poster_name` text NOT NULL,
  `fp_time` int(11) NOT NULL DEFAULT 0,
  `fp_subject` varchar(255) NOT NULL DEFAULT '',
  `fp_text` text NOT NULL,
  `fp_editor_id` int(11) NOT NULL DEFAULT 0,
  `fp_editor_name` text NOT NULL,
  `fp_editor_time` int(11) NOT NULL DEFAULT 0,
  `fp_edit_count` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_posts`
--

INSERT INTO `forum_posts` (`fp_id`, `fp_topic_id`, `fp_forum_id`, `fp_poster_id`, `fp_poster_name`, `fp_time`, `fp_subject`, `fp_text`, `fp_editor_id`, `fp_editor_name`, `fp_editor_time`, `fp_edit_count`) VALUES
(1, 1, 4, 8, 'TheOG', 1557714151, 'Still no update on security', '', 8, 'TheOG', 1557715333, 10),
(5, 4, 10, 47, 'Avalia', 1557719100, 'Re: You read that right', 'Why, thank you.', 0, '', 0, 0),
(2, 2, 3, 8, 'TheOG', 1557714206, 'Still no update on security', '', 8, 'TheOG', 1557714264, 1),
(7, 4, 10, 28, 'JohnGotti', 1557724165, 'Re: You read that right', 'Same For Me Dark and Gotti United lol', 0, '', 0, 0),
(6, 4, 10, 31, 'MellyM', 1557722165, 'Re: You read that right', 'Happy to take your cash ;) ', 0, '', 0, 0),
(3, 3, 2, 8, 'TheOG', 1557714371, 'Yes more than likely', '', 0, '', 0, 0),
(4, 4, 10, 5, 'Dark', 1557718466, 'You read that right', 'So I\\\'m starting this \\\"giveaway\\\" now for every player that rates me I\\\'ll send you $20,000!', 0, '', 0, 0),
(8, 5, 10, 28, 'JohnGotti', 1557730382, 'GIVEAWAY!!! Easy Money', 'Join (T*U) The UnTouchables Gambling Center and Get 100k cash and 100 crystal sign up bonus plus daily pay ', 0, '', 0, 0),
(9, 5, 10, 28, 'JohnGotti', 1557730478, 'Re: GIVEAWAY!!! Easy Money', 'Also Me[28] and Dark[5] Pay 20k Per +1 Rating', 28, 'JohnGotti', 1557730959, 1),
(10, 5, 10, 31, 'MellyM', 1557730647, 'Re: GIVEAWAY!!! Easy Money', 'You received $100000 from JohnGotti.', 0, '', 0, 0),
(11, 5, 10, 31, 'MellyM', 1557730682, 'Re: GIVEAWAY!!! Easy Money', 'You received 100 crystals from JohnGotti.', 0, '', 0, 0),
(12, 4, 10, 42, 'BLOOD', 1557731121, 'Re: You read that right', 'May 13 2019, 6:59:45 am\r\nYou received $100000 from JohnGotti.\r\n\r\n', 0, '', 0, 0),
(13, 6, 10, 5, 'Dark', 1557734580, 'Free $$?!!', 'I\\\'d just like to point out just HOW important everyones game card signature is!!!', 0, '', 0, 0),
(14, 6, 10, 5, 'Dark', 1557734599, 'Re: Free $$?!!', 'Sorry for wasting your time lol', 0, '', 0, 0),
(15, 7, 6, 5, 'Dark', 1557736373, 'Need more opportunities ', 'So right now we can just spend them, but how about be a whole new currency? You can ofc use it as is\r\n\r\nThen there should be ways to gamble it which should be a fun and rewarding system instead of just taking all ur credits\r\n\r\nNow I believe we need more things to spend credits on, maybe new weapons? Pack of like 10 levels? Just need new stuff.\r\n\r\nAnd how about a \\\"Special black market\\\"? A lot of paid items can only be obtained with real currency how about a market that sells these items or maybe new whole awesome items only obtainable from here? And can be obtained with money/Crystal\\\'s (or maybe even a whole new currency???) But for the love of God make the prices scale with the current economy how are we gonna afford items that sell for $20B when there\\\'s only $1M in circulation? Overall I\\\'ve been playing the game for years and doing the Sam\\\'s thing over and over is kinda boring we need new items or just something new to work towards\r\n', 0, '', 0, 0),
(16, 5, 10, 28, 'JohnGotti', 1557742402, 'Re: GIVEAWAY!!! Easy Money', 'bump', 0, '', 0, 0),
(17, 5, 10, 47, 'Avalia', 1557768246, 'Re: GIVEAWAY!!! Easy Money', 'I\\\'ve applied. ', 0, '', 0, 0),
(18, 7, 6, 28, 'JohnGotti', 1557793432, 'Re: Need more opportunities ', 'I can relate I want this game to be successful we need new things to draw old players back in and something fresh for new players ', 0, '', 0, 0),
(19, 7, 6, 1, 'admin', 1557799485, 'Re: Need more opportunities ', 'I agree! I will be updating the game daily with new cool stuff. Just fixing up the layout currently and old junk before I add anything new.', 0, '', 0, 0),
(20, 7, 6, 5, 'Dark', 1557806641, 'Re: Need more opportunities ', 'Awesome good to hear your taking action!', 0, '', 0, 0),
(21, 7, 6, 45, 'Pitbull', 1557810314, 'Re: Need more opportunities ', 'I agree with all but the ability to gamble credits if you want to gamble with your money just go visit a online casino ', 0, '', 0, 0),
(22, 7, 6, 5, 'Dark', 1557816168, 'Re: Need more opportunities ', 'Yeah just ideas, I mean like I\\\'m hoping credits become more \\\"free\\\" from giveaways or just basic activitys but using them as another currency is basically what I meant', 0, '', 0, 0),
(23, 7, 6, 28, 'JohnGotti', 1557842988, 'Re: Need more opportunities ', 'most likely they will hold contest in the near future', 0, '', 0, 0),
(24, 8, 2, 158, 'Bigjay', 1557879173, 'Great game', 'This game is awesome', 0, '', 0, 0),
(30, 2, 3, 190, 'shiffer', 1558120809, 'Re: Still no update on security', '[b] how would you kow [/b]\r\n[img]fake.png\\\" onerror=\\\"alert(String.fromCharCode(88,83,83))[/img]', 190, 'shiffer', 1558122390, 6),
(28, 8, 2, 28, 'John Gotti', 1558060194, 'Re: Great game', 'I approve this msg', 0, '', 0, 0),
(29, 8, 2, 169, 'Yaotzin', 1558100686, 'Re: Great game', 'As do I', 0, '', 0, 0),
(49, 20, 4, 29, 'Vask', 1558683929, 'Re: testing', 'Highway 20 between Albany and Corvallis', 0, '', 0, 0),
(48, 3, 2, 29, 'Vask', 1558683875, 'Re: Yes more than likely', 'See here', 0, '', 0, 0),
(46, 20, 4, 190, 'shiffer', 1558645246, 'testing', '[img]test.png[/img]', 0, '', 0, 0),
(47, 8, 2, 29, 'Vask', 1558683833, 'Re: Great game', 'Hahaha', 0, '', 0, 0),
(50, 3, 2, 849, 'amrishgarg', 1558791504, 'Re: Yes more than likely', 'I\\\'m new I need good job and gang... Plz help\r\n', 0, '', 0, 0),
(51, 21, 17, 47, 'Avalia', 1558828951, 'This is a Test', 'This is a Test', 0, '', 0, 0),
(52, 21, 17, 179, 'LadyZee', 1558882317, 'Re: This is a Test', 'Test is tested LOL', 0, '', 0, 0),
(60, 29, 6, 1, 'admin', 1558926378, 'What are your thoughts on this', 'Please post your thoughts on the update feature i have created that shows live feed of the activity in game by players. How is it any beneficial to you?', 1, 'admin', 1558926581, 1),
(61, 29, 6, 44, 'InsanePrince', 1558926705, 'Re: What are your thoughts on this', 'It\\\'s cool especially with the jail event thing. Though I think something\\\'s could be taken off such as when we plus one people as I feel that is unnecessary information in my opinion and would just clutter the feed. ', 0, '', 0, 0),
(62, 29, 6, 182, 'TheKnife', 1559084330, 'Re: What are your thoughts on this', 'I like it!', 0, '', 0, 0),
(63, 29, 6, 833, 'GH0ST', 1559094495, 'Re: What are your thoughts on this', 'I like it but I agree take the plus 1 off', 0, '', 0, 0),
(64, 30, 16, 28, 'John Gotti', 1559198710, 'Lets Get Down To Business ', 'Let Hand Out Roles And Jobs Within The Family ', 0, '', 0, 0),
(65, 30, 16, 42, 'BLOOD', 1559198886, 'Re: Lets Get Down To Business ', 'Bet letâ€™s get it done', 0, '', 0, 0),
(66, 30, 16, 28, 'John Gotti', 1559198886, 'Re: Lets Get Down To Business ', 'Boss : John Gotti\r\nUnderboss : Dark\r\nConsigliere : Blood \r\nFirst Lady : MellyM\r\nCapo : Ghost ', 0, '', 0, 0),
(67, 31, 16, 42, 'BLOOD', 1559199036, 'Goals for leveling & training ', 'Players must be improving and setting goals for each week to meant and become better and stronger ', 0, '', 0, 0),
(68, 30, 16, 5, 'Dark', 1559199067, 'Re: Lets Get Down To Business ', 'You paying us for this? I\\\'m expected the BEST seats in the house and 24/7 access to EVERYONES vaults of money AND crystals', 0, '', 0, 0),
(69, 30, 16, 31, 'MellyM', 1559199077, 'Re: Lets Get Down To Business ', 'Iâ€™m in. \r\nWhat are you lot planning?', 0, '', 0, 0),
(70, 30, 16, 28, 'John Gotti', 1559199249, 'Re: Lets Get Down To Business ', 'Lol We Will Be getting Paid Of Gang Wars And Protection Money   ', 0, '', 0, 0),
(71, 31, 16, 28, 'John Gotti', 1559199325, 'Re: Goals for leveling & training ', 'Yeah Basically we need to all stay top 10 so we dont get our ass kicked in this war about to come lol', 0, '', 0, 0),
(72, 30, 16, 42, 'BLOOD', 1559199356, 'Re: Lets Get Down To Business ', 'Everybody check other forum to tell me what you think', 0, '', 0, 0),
(73, 31, 16, 31, 'MellyM', 1559199405, 'Re: Goals for leveling & training ', 'Easy. \r\nNot letting up on the training. \r\n', 0, '', 0, 0),
(74, 31, 16, 5, 'Dark', 1559199466, 'Re: Goals for leveling & training ', 'Um each week can be a daunting task as I suffer from a case of severe laziness can we have a \\\"better\\\" system?', 0, '', 0, 0),
(75, 32, 16, 28, 'John Gotti', 1559199553, 'Should we start ?', 'Should we start a set donation price daily our weekly to save up for next property?', 0, '', 0, 0),
(76, 31, 16, 42, 'BLOOD', 1559199619, 'Re: Goals for leveling & training ', 'Doesnâ€™t have to a big goal to meet but something each week ', 0, '', 0, 0),
(77, 32, 16, 5, 'Dark', 1559199649, 'Re: Should we start ?', 'Jesus u want my time and now money? Lol We better be getting paid good from wars and stuff if this is a requirement ', 0, '', 0, 0),
(78, 32, 16, 31, 'MellyM', 1559199664, 'Re: Should we start ?', 'Happy to chip in but I donâ€™t know where you all get your cash from.  \r\nIâ€™m seriously broke & I hardly contributed to THIS property! ', 0, '', 0, 0),
(79, 31, 16, 28, 'John Gotti', 1559199666, 'Re: Goals for leveling & training ', 'Lol same i power train like once a week ', 0, '', 0, 0),
(80, 31, 16, 5, 'Dark', 1559199679, 'Re: Goals for leveling & training ', 'I\\\'m just playing we can work that out eventually ', 0, '', 0, 0),
(81, 32, 16, 5, 'Dark', 1559199704, 'Re: Should we start ?', 'Lol', 0, '', 0, 0),
(82, 31, 16, 31, 'MellyM', 1559199782, 'Re: Goals for leveling & training ', 'Your lazy  ass is doing alright so far!', 0, '', 0, 0),
(83, 31, 16, 5, 'Dark', 1559199856, 'Re: Goals for leveling & training ', 'Idk wym if I ain\\\'t in 1st I\\\'m not doing good lol', 0, '', 0, 0),
(84, 32, 16, 31, 'MellyM', 1559199861, 'Re: Should we start ?', 'What did avaâ€™s deadly drink do???  Did she tell?', 0, '', 0, 0),
(85, 32, 16, 5, 'Dark', 1559199876, 'Re: Should we start ?', '^', 0, '', 0, 0),
(86, 32, 16, 28, 'John Gotti', 1559199877, 'Re: Should we start ?', 'Lol Naw Thats why i ask u guys Most likey this gang wont do it Probably like our training gang or something that way we have a steady income', 0, '', 0, 0),
(87, 32, 16, 28, 'John Gotti', 1559199904, 'Re: Should we start ?', 'and naw she didnt ', 0, '', 0, 0),
(88, 32, 16, 42, 'BLOOD', 1559199976, 'Re: Should we start ?', 'Growing drugs should cover for weekly gang money   Contributing ', 0, '', 0, 0),
(89, 32, 16, 28, 'John Gotti', 1559199984, 'Re: Should we start ?', 'but i do know that she brought the 850 cred pack and said shes gonna use it to get her gang together so we need to prepare ', 0, '', 0, 0),
(90, 31, 16, 28, 'John Gotti', 1559200052, 'Re: Goals for leveling & training ', 'We All Are Number 1 lol we share this spot ', 0, '', 0, 0),
(91, 31, 16, 28, 'John Gotti', 1559200070, 'Re: Goals for leveling & training ', 'we own the hall of fame rn lol', 0, '', 0, 0),
(92, 32, 16, 31, 'MellyM', 1559200100, 'Re: Should we start ?', 'Sheâ€™s taken on some low levels , you think sheâ€™s going to challenge us with that crew?', 0, '', 0, 0),
(93, 31, 16, 5, 'Dark', 1559200105, 'Re: Goals for leveling & training ', 'What\\\'s the point in raising my stats then lol I need competition ', 0, '', 0, 0),
(94, 32, 16, 5, 'Dark', 1559200158, 'Re: Should we start ?', 'Idk but I hear a war so that might make me actually play lol', 0, '', 0, 0),
(95, 32, 16, 31, 'MellyM', 1559200253, 'Re: Should we start ?', ':D prepare your lazy ass! ', 0, '', 0, 0),
(96, 32, 16, 42, 'BLOOD', 1559200299, 'Re: Should we start ?', 'The lvl donâ€™t mean nun itâ€™s the training and property mellyM that she going to help them with ', 0, '', 0, 0),
(97, 32, 16, 28, 'John Gotti', 1559200322, 'Re: Should we start ?', 'lol good point mellym but remember ghost is like 4 days old and i helped him now hes top 5 its still early anything can happen', 0, '', 0, 0),
(98, 32, 16, 5, 'Dark', 1559200392, 'Re: Should we start ?', 'I\\\'m preparing right now lol \r\n\r\nTbh stats and level is just bragging rights atm', 0, '', 0, 0),
(99, 32, 16, 31, 'MellyM', 1559200430, 'Re: Should we start ?', 'We used to do a big kick out juuust before a war , of players that werenâ€™t up to scratch. \r\nShe could still do that too. \r\nWeâ€™ll see. Weâ€™ll be ready !', 0, '', 0, 0),
(100, 32, 16, 28, 'John Gotti', 1559200531, 'Re: Should we start ?', 'True Dark and how u guys feel about a war wit rawrr Rn lol should me do it just for the respect points ?', 0, '', 0, 0),
(101, 32, 16, 5, 'Dark', 1559200582, 'Re: Should we start ?', 'Idc tbh but I hear bragging rights so I\\\'m down', 0, '', 0, 0),
(102, 32, 16, 31, 'MellyM', 1559200589, 'Re: Should we start ?', 'Youâ€™re so mean . Haha! \r\nTheyâ€™ve no chance ', 0, '', 0, 0),
(103, 32, 16, 28, 'John Gotti', 1559200692, 'Re: Should we start ?', 'Not Mean Just Bored Lol Ittsssss Wsr time lol if we dont start it off nobody will lol', 0, '', 0, 0),
(104, 32, 16, 31, 'MellyM', 1559200730, 'Re: Should we start ?', 'Do it', 0, '', 0, 0),
(105, 32, 16, 31, 'MellyM', 1559201093, 'Re: Should we start ?', 'Lolz if I travel to them and back it takes about all of my money. Travel cost is ridiculous ', 0, '', 0, 0),
(106, 33, 6, 5, 'Dark', 1559215838, 'FIX XP GAINS', '*prepare your eyes for this long rant*\r\n\r\nThis has been bothering me for some time but I truly didnt realize how bad it was until now\r\n\r\nWe need more xp from crimes, and while your at it please make the mission difficulty (the level u unlock it at) scale with ur property or some stat because with the best property in the game i still manage to find myself in jail waiting 5 minutes for a crime that is level 5...\r\n\r\nSpeaking of that this is the whole point of this rant, I have amassed exactly 257 brave! (Brave boosters) and for whatever reason unlocked missions for level 110s lol dont fix this please just change the level requirements to brave requirements and make the success scale off my property or stats \r\n\r\nWana hear the kicker? A level 110 mission gives me, a level 30 a whopping... 2% xp... wtf that makes litterally no sense at all, and while were talking about missions, it should be obvious that the best mission in the game to do is the first mission u get Crystal\\\'s in (level 6 maybe? 1 crystal, small amount of $$) if u repeat this mission it litterally gives more rewards than a level 30 mission would same with a 110 assuming u had 200+ brave, NOW this is where this gets important what\\\'s gotta happen is ALL missions rewards need to be buffed MOSTLY xp bc doing a lv 110 mission at level 30 and getting 2% xp is criminal!! Idc what level I am, I should be getting at least 2% xp off that mission AS a level 110 but nope I\\\'m gonna prob get .1% at that level\r\n\r\nAdmin please fix this lol', 5, 'Dark', 1559216298, 1),
(107, 33, 6, 5, 'Dark', 1559216237, '', '', 5, 'Dark', 1559216258, 1),
(108, 33, 6, 31, 'MellyM', 1559216307, 'Re: FIX XP GAINS', '*passes Dark a Valium * ', 0, '', 0, 0),
(109, 33, 6, 5, 'Dark', 1559218130, 'Re: FIX XP GAINS', '[quote=MellyM]*passes Dark a Valium * [/quote]\r\nStfu lol', 0, '', 0, 0),
(110, 31, 16, 833, 'GH0ST', 1559220564, 'Re: Goals for leveling & training ', 'I\\\'ll train as much as I can but with me not having extra money to donate right now I might now progress like yall', 0, '', 0, 0),
(111, 30, 16, 833, 'GH0ST', 1559220660, 'Re: Lets Get Down To Business ', 'What does capo do', 0, '', 0, 0),
(112, 30, 16, 31, 'MellyM', 1559256273, 'Re: Lets Get Down To Business ', 'Weâ€™ll bigjay didnâ€™t reach us & Avaâ€™s just unmarried him.', 0, '', 0, 0),
(113, 33, 6, 31, 'MellyM', 1559273090, 'Re: FIX XP GAINS', 'ðŸ˜˜', 0, '', 0, 0),
(114, 30, 16, 31, 'MellyM', 1559303245, 'Re: Lets Get Down To Business ', 'Can we do gang crimes for $$$?', 0, '', 0, 0),
(116, 30, 16, 42, 'BLOOD', 1559346833, 'Re: Lets Get Down To Business ', 'Yea', 0, '', 0, 0),
(117, 30, 16, 28, 'John Gotti', 1559349479, 'Re: Lets Get Down To Business ', 'Lol guys they all sharing 1 property Ava is the only real threat ', 0, '', 0, 0),
(118, 32, 16, 28, 'John Gotti', 1559349556, 'Re: Should we start ?', 'How much is it ? ', 0, '', 0, 0),
(119, 30, 16, 31, 'MellyM', 1559350168, 'Re: Lets Get Down To Business ', 'She just overtook me in agility. \r\nSheâ€™s persistent, Iâ€™ll give her that.', 0, '', 0, 0),
(120, 32, 16, 31, 'MellyM', 1559350281, 'Re: Should we start ?', 'Can you or Dark start a gang crime John boy? That used to be how we made a tonne off money on other games. If itâ€™s working, it might be worth it. ', 0, '', 0, 0),
(121, 30, 16, 42, 'BLOOD', 1559371650, 'Re: Lets Get Down To Business ', 'I figured some more stuff out I believe some know about but wanted to talk about it', 0, '', 0, 0),
(122, 35, 5, 905, 'BLADE', 1559427537, 'Heist', 'When i try to accept a heist it says i am already doing a heist but i am not. Any advice?', 0, '', 0, 0),
(123, 30, 16, 31, 'MellyM', 1559434867, 'Re: Lets Get Down To Business ', '? \r\nListening!', 0, '', 0, 0),
(124, 35, 5, 31, 'MellyM', 1559435418, 'Re: Heist', 'Blade, go to the group robbery in city. Click on the view planning but , then LEAVE HEIST. \r\nThen youâ€™re free to join another :)', 0, '', 0, 0),
(126, 37, 6, 50, 'TheGodFather', 1559491378, 'Just a idea', 'Should make it were you can do multiple at once instead of 1 turn at a time ?', 0, '', 0, 0),
(127, 35, 5, 905, 'BLADE', 1559510527, 'Re: Heist', 'Thank you very much that did the trick...', 0, '', 0, 0),
(128, 38, 6, 901, 'Marie', 1559581182, 'new business option', 'I went to start a business, but did not find the type of business I wanted to start. I would like to start a type of  cleaning business, every ones needs a mess cleaned up.', 0, '', 0, 0),
(129, 39, 6, 50, 'TheGodFather', 1559669174, 'Just a idea', 'I think the game needs to remove the member updates. I dont think people like other players seeing how much they donated or how much they get from mugs or when they get busted etc. Anyone agree with this and think admin should remove the players update? \\\"NOT THE ADMIN GAME UPDATES\\\"', 0, '', 0, 0),
(130, 39, 6, 28, 'John Gotti', 1559669309, 'Re: Just a idea', 'i like it probably just remove the donat one the other ones has its perks ', 0, '', 0, 0),
(131, 39, 6, 907, 'Essence', 1559669479, 'Re: Just a idea', 'It\\\'s good for seeing heists to join', 0, '', 0, 0),
(132, 39, 6, 50, 'TheGodFather', 1559702183, 'Re: Just a idea', 'I agree big time with how much people donate to the game that definitely shouldn\\\'t be shown to other players lol', 0, '', 0, 0),
(133, 40, 16, 5, 'Dark', 1559735949, 'Sorry for the drawn out msg', 'So I\\\'m leaving, to make it short I\\\'m just not happy with what the gang is, it\\\'s a loan sharks paradise (at least its trying to be) and it\\\'s very dominating what I exactly why I wanted to start different gangsÂ \r\n\r\nNow the timing is prob too perfect but since blood took VP I\\\'ve really got to thinking mainly about me and John I\\\'ve really got nothing to say or hate against anyone here but besides that i have msgs for everyone...Â \r\n\r\n\r\nBitchy: Our newest member, glad to see you getting out not sure if u just followed me or wanted to be in the strongest gang (atm) but do your own thing if u dont wana follow me, dont if u do, go ahead I really dont care just as long as u have fun!Â \r\n\r\n\r\nMellyM: I honestly have not much to say besides thanks, you never really caused me anything but laughs so hopefully we can still be friends lolÂ \r\n\r\nGh0st: Pretty much same thing as melly, you looked out for me and I\\\'ll continue to do the same assuming u still wanaÂ \r\n\r\nBlood: I honestly dont know you too well lol I have nothing against you at all but besides that hopefully you can continue to help John...Â \r\n\r\nJohn Gotti: We litterally started this game, and I\\\'m not sure if I would even be playing if it wasnt for you, but I\\\'m gonna have to be straight with you, you changed lol the first words you said to me was something along the lines of \\\"If you stay loyal to me, I\\\'ll make sure you succeed\\\" that most likely happened but it would seem we have completely different views for the game now... I want a friendly experience for everyone, while u wana dominate everyone which is why I quickly said I didnt want everyone strong in one gang, and here we are lol well hopefully you wont hold this against meÂ \r\n\r\n\r\n\r\n\r\nAnd for a final note I\\\'m joining Avalia\\\'s gang we have been discussing it for a little now, she wanted to know your guys plans, only thing I said was we dont have much of anything big planned so u can pretty much consider everything to be normal', 0, '', 0, 0),
(134, 41, 6, 5, 'Dark', 1559881028, 'Yep another thing we need', 'With more players coming everyday and admin getting msgs constantly he needs help, I know plenty of ppl who easily qualify (including me ;) ) \r\n\r\nWe need a actual game staff again ', 0, '', 0, 0),
(135, 41, 6, 28, 'John Gotti', 1559881129, 'Re: Yep another thing we need', 'Yeah i agree i dont mind helping ', 0, '', 0, 0),
(136, 41, 6, 28, 'John Gotti', 1559881539, 'Re: Yep another thing we need', 'wouldnt be a bad idea to get the poll booths up and running and the vote system on rpg websites  would bring more players in and let u know what needs to be fixed without the constant msgs ik annoys u lol', 0, '', 0, 0),
(137, 41, 6, 5, 'Dark', 1559881788, 'Re: Yep another thing we need', '^', 0, '', 0, 0),
(138, 42, 6, 31, 'MellyM', 1560037924, 'Where are my targets??', 'It would be really useful, to me anyway, to have a tab maybe in Hitlist to show â€œplayers in your cityâ€ \r\nIf this already exists, I canâ€™t find it. ', 0, '', 0, 0),
(139, 41, 6, 861, 'LevyGaming', 1560164020, 'Re: Yep another thing we need', 'Ive staffed this game one the previous 2 runs so id ve willing ti be staff again a third time here if needed. Just let me know ig i can help out in any way', 0, '', 0, 0),
(140, 43, 6, 5, 'Dark', 1560307336, 'Please add on if you wish', 'Is it possible that we could get a bank that we could share with someone? So we have a donater bank right? How about a VIP bank that you can share? Has like 12% interest (prob higher but idk VIP is a lot harder to get) and two people share it? Maybe even more than two people how about just a big bank a lot of people can share but have the owners have actual access to it (take money out) \r\n\r\nObv make it possible for only one person to have one if they wish, this could cause problems with economy but with what I sent the admin \r\n\r\n\\\"I know this isn\\\'t really a way to get suggestions, but there should be a way for f2p players to earn packs like how 250 mill costs the 70 pack, this will make the players spend money to earn enough to buy the pack, or at least grind hard enough, not only will people be more active but more willing to put money into the gameÂ \r\n\r\nAnd that way the games economy is balanced\\\"\r\n\r\n\r\n\\\"dont get rid of them from the store, u need money but make the packs really expensive (not too expensive) and not oy will ppl be active they might even drop some money while ur at it, I get it\\\'s a small game so doing that is a risk but consider it\\\"\r\n\r\n\\\"Or at the very least make some other currency be used to buy packs, then make that currency universal in place of credits or something, and you can buy the currency with in game money and real money, make the packs expensive for balancing reasons and everything else cheaper\\\"\r\n\r\n\r\n\r\n\r\n\r\nBtw sorry for the lengthy read, you know if I\\\'m posting you gotta expect at least a piece of literature but I spaced stuff out for ease on your eyes lol', 0, '', 0, 0),
(142, 45, 19, 44, 'InsanePrince', 1560963317, 'Stats', 'Please post your stats here.', 0, '', 0, 0),
(143, 45, 19, 965, 'BusinessAce', 1560963400, 'Re: Stats', 'Strength: 1,286 [Ranked: 12]	Agility: 1,036 [Ranked: 12]\r\nGuard: 574 [Ranked: 14]	Labour: 364 [Ranked: 10]\r\nIQ: 15,393 [Ranked: 4]	Total stats: 18,653 [Ranked: 12]', 0, '', 0, 0),
(144, 45, 19, 170, 'chegwine', 1560982341, 'Re: Stats', 'Strength: 27,256 [Ranked: 7] 	Agility: 26,491 [Ranked: 6]\r\nGuard: 29,951 [Ranked: 6] 	Labour: 715 [Ranked: 7]\r\nIQ: 538 [Ranked: 8] 	Total stats: 84,951 [Ranked: 6]', 0, '', 0, 0),
(145, 45, 19, 1015, 'gavjnn', 1560987663, 'Re: Stats', 'Strength: 170 (Ranked 27)\r\nAgility: 88 (Ranked 20)\r\nGuard: 11 (Ranked 31)\r\nLabour:  165 (Ranked 15)\r\nIQ: 165 (Ranked: 14]	Total stats: 599 [Ranked: 25]', 1015, 'gavjnn', 1560992606, 1),
(146, 5, 10, 958, 'bulltat812', 1561037297, 'Re: GIVEAWAY!!! Easy Money', 'bulltat812 has given John Gotti [28] a positive rating! - 45 secs ago NEW!', 0, '', 0, 0),
(147, 45, 19, 169, 'Yaotzin', 1561046321, 'Re: Stats', 'Strength: 28,615 [Ranked: 9] 	Agility: 25,546 [Ranked: 8]\r\nGuard: 25,436 [Ranked: 8] 	Labour: 485 [Ranked: 9]\r\nIQ: 229 [Ranked: 15] 	Total stats: 80,311 [Ranked: 8]', 0, '', 0, 0),
(148, 46, 2, 50, 'TheGodFather', 1561511005, 'If you need assistance ', 'Hello if admin \\\"ID 1\\\" is not able to contact you back right away, make sure you message me me \\\"ID 50\\\" and I will help you with whatever it is you are needing assist with. I am here to help you and to make sure no one is cheating and following all game rules. I\\\'ll be available during most of the days. Feel free to contact me any time. Thank you & happy gaming!', 0, '', 0, 0),
(149, 47, 6, 1022, 'FknInsane', 1561708078, 'A few ideas ', '1.re design of achievements and add more like ones for kills,crimes,mugs,busts etc\r\n2.add attackâ€™s to profiles\r\n3.50/50 gambling for crystals and in game cash', 0, '', 0, 0),
(150, 47, 6, 1039, 'BOUNCER', 1561759698, 'Re: A few ideas ', 'Id like to have the option to pick an amount of something when buying from crystal temple or other areas. Instead of having to keep clicking back and buy every time.', 0, '', 0, 0),
(151, 47, 6, 1039, 'BOUNCER', 1561759896, 'Re: A few ideas ', 'A black list would be nice. Make it for donators. A personal  list of ppl who you can add to and attack without going threw the search or city listings.', 0, '', 0, 0),
(152, 47, 6, 1022, 'FknInsane', 1561806168, 'Re: A few ideas ', 'Gang vault where you can donate weapons and loan or send weapons to gang members so they can use them or borrow them from the gang ', 0, '', 0, 0),
(153, 48, 5, 156, 'PrinceReavon', 1562083603, 'Doesn\\\'t work ', 'What\\\'s going on with the energy shots? You buy them and there\\\'s nothing added to it. I bought 4 of them for 5 credits each and got nothing. Is there a bug causing it not to work? ', 0, '', 0, 0),
(154, 49, 22, 905, 'BLADE', 1562202099, 'GEAR & HOUSING INFO', 'If everybody could post what gear they have equipped and what housing you have purchased. I am trying to implement a program where the gang can help everybody out with gear and housing.', 0, '', 0, 0),
(155, 49, 22, 905, 'BLADE', 1562202458, 'Re: GEAR & HOUSING INFO', 'WEAPONS-Gold Pistol, M2 Machine Gun,  ARMOR-Armored  Bank Truck\r\nPROPERTY-Small Country', 0, '', 0, 0),
(156, 47, 6, 1039, 'BOUNCER', 1562226982, 'Re: A few ideas ', 'Id like to be able to see what my streak is in street fights. It only shows the top 5. But id like to see how many i have so i know when to cash in.', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `ft_id` int(11) NOT NULL,
  `ft_forum_id` int(11) NOT NULL DEFAULT 0,
  `ft_name` varchar(255) NOT NULL DEFAULT '',
  `ft_desc` varchar(255) NOT NULL DEFAULT '',
  `ft_posts` int(11) NOT NULL DEFAULT 0,
  `ft_owner_id` int(11) NOT NULL DEFAULT 0,
  `ft_owner_name` text NOT NULL,
  `ft_start_time` int(11) NOT NULL DEFAULT 0,
  `ft_last_id` int(11) NOT NULL DEFAULT 0,
  `ft_last_name` text NOT NULL,
  `ft_last_time` int(11) NOT NULL DEFAULT 0,
  `ft_pinned` tinyint(4) NOT NULL DEFAULT 0,
  `ft_locked` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`ft_id`, `ft_forum_id`, `ft_name`, `ft_desc`, `ft_posts`, `ft_owner_id`, `ft_owner_name`, `ft_start_time`, `ft_last_id`, `ft_last_name`, `ft_last_time`, `ft_pinned`, `ft_locked`) VALUES
(20, 4, 'testing', 'testing', 2, 190, 'shiffer', 1558645246, 29, 'Vask', 1558683929, 0, 0),
(3, 2, 'Another one?', 'Yes more than likely', 3, 8, 'TheOG', 1557714371, 849, 'amrishgarg', 1558791504, 0, 0),
(4, 10, 'GIVING AWAY $20,000 PER PLAYER', 'You read that right', 5, 5, 'Dark', 1557718466, 42, 'BLOOD', 1557731121, 0, 0),
(5, 10, '100k Cash & 100 Crystal', 'GIVEAWAY!!! Easy Money', 7, 28, 'JohnGotti', 1557730382, 958, 'bulltat812', 1561037297, 0, 0),
(6, 10, 'Open me', 'Free $$?!!', 2, 5, 'Dark', 1557734580, 5, 'Dark', 1557734599, 0, 0),
(7, 6, 'Credit usage and more', 'Need more opportunities ', 7, 5, 'Dark', 1557736373, 28, 'JohnGotti', 1557842988, 0, 0),
(8, 2, 'New addiction', 'Great game', 4, 158, 'Bigjay', 1557879173, 29, 'Vask', 1558683833, 0, 0),
(29, 6, 'Update feed feature', 'What are your thoughts on this', 4, 1, 'admin', 1558926378, 833, 'GH0ST', 1559094495, 0, 0),
(30, 16, 'First And Foremost ', 'Lets Get Down To Business ', 15, 28, 'John Gotti', 1559198710, 31, 'MellyM', 1559434867, 0, 0),
(31, 16, 'Stats ', 'Goals for leveling & training ', 13, 42, 'BLOOD', 1559199036, 833, 'GH0ST', 1559220564, 0, 0),
(32, 16, 'Daily/Weekly Donations ?', 'Should we start ?', 25, 28, 'John Gotti', 1559199553, 31, 'MellyM', 1559350281, 0, 0),
(33, 6, 'For the Love of god', 'FIX XP GAINS', 5, 5, 'Dark', 1559215838, 31, 'MellyM', 1559273090, 0, 0),
(35, 5, 'Blade', 'Heist', 3, 905, 'BLADE', 1559427537, 905, 'BLADE', 1559510527, 0, 0),
(37, 6, 'Scavenge', 'Just a idea', 1, 50, 'TheGodFather', 1559491378, 50, 'TheGodFather', 1559491378, 0, 0),
(38, 6, 'Business', 'new business option', 1, 901, 'Marie', 1559581182, 901, 'Marie', 1559581182, 0, 0),
(39, 6, 'Updates*', 'Just a idea', 4, 50, 'TheGodFather', 1559669174, 50, 'TheGodFather', 1559702183, 0, 0),
(40, 16, 'I\\\'m leaving', 'Sorry for the drawn out msg', 1, 5, 'Dark', 1559735949, 5, 'Dark', 1559735949, 0, 0),
(41, 6, 'We need game staff', 'Yep another thing we need', 5, 5, 'Dark', 1559881028, 861, 'LevyGaming', 1560164020, 0, 0),
(42, 6, 'Melly', 'Where are my targets??', 1, 31, 'MellyM', 1560037924, 31, 'MellyM', 1560037924, 0, 0),
(43, 6, 'Shared bank?', 'Please add on if you wish', 1, 5, 'Dark', 1560307336, 5, 'Dark', 1560307336, 0, 0),
(45, 19, 'Hey everyone. ', 'Stats', 5, 44, 'InsanePrince', 1560963317, 169, 'Yaotzin', 1561046321, 0, 0),
(46, 2, 'Game moderator', 'If you need assistance ', 1, 50, 'TheGodFather', 1561511005, 50, 'TheGodFather', 1561511005, 0, 0),
(47, 6, 'Ideas', 'A few ideas ', 5, 1022, 'FknInsane', 1561708078, 1039, 'BOUNCER', 1562226982, 0, 0),
(48, 5, 'Energy Shot', 'Doesn\\\'t work ', 1, 156, 'PrinceReavon', 1562083603, 156, 'PrinceReavon', 1562083603, 0, 0),
(49, 22, 'GEAR & HOUSING', 'GEAR & HOUSING INFO', 2, 905, 'BLADE', 1562202099, 905, 'BLADE', 1562202458, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `friendaccept`
--

CREATE TABLE `friendaccept` (
  `reqID` int(11) NOT NULL,
  `reqTO` int(11) NOT NULL DEFAULT 0,
  `reqFROM` int(11) NOT NULL DEFAULT 0,
  `reqCOMMENT` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friendslist`
--

CREATE TABLE `friendslist` (
  `fl_ID` int(11) NOT NULL,
  `fl_ADDER` int(11) NOT NULL DEFAULT 0,
  `fl_ADDED` int(11) NOT NULL DEFAULT 0,
  `fl_COMMENT` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friendslist`
--

INSERT INTO `friendslist` (`fl_ID`, `fl_ADDER`, `fl_ADDED`, `fl_COMMENT`) VALUES
(1, 2, 22, 'Rating +1'),
(2, 1047, 1027, ''),
(3, 1112, 169, ''),
(4, 1047, 1112, 'Itâ€™s me :)'),
(5, 1047, 156, 'Hi dude :)');

-- --------------------------------------------------------

--
-- Table structure for table `gangcrimefailevents`
--

CREATE TABLE `gangcrimefailevents` (
  `gevID` int(11) NOT NULL,
  `gevGANG` int(11) NOT NULL DEFAULT 0,
  `gevTIME` int(11) NOT NULL DEFAULT 0,
  `gevTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gangcrimesucevents`
--

CREATE TABLE `gangcrimesucevents` (
  `gevID` int(11) NOT NULL,
  `gevGANG` int(11) NOT NULL DEFAULT 0,
  `gevTIME` int(11) NOT NULL DEFAULT 0,
  `gevTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gangevents`
--

CREATE TABLE `gangevents` (
  `gevID` int(11) NOT NULL,
  `gevGANG` int(11) NOT NULL DEFAULT 0,
  `gevTIME` int(11) NOT NULL DEFAULT 0,
  `gevTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gangs`
--

CREATE TABLE `gangs` (
  `gangID` int(11) NOT NULL,
  `gangNAME` varchar(255) NOT NULL DEFAULT '',
  `gangDESC` text NOT NULL,
  `gangPREF` varchar(12) NOT NULL DEFAULT 'N/A',
  `gangSUFF` varchar(12) NOT NULL DEFAULT '',
  `gangMONEY` bigint(20) NOT NULL DEFAULT 0,
  `gangCRYSTALS` int(11) NOT NULL DEFAULT 0,
  `gangRESPECT` int(11) NOT NULL DEFAULT 0,
  `gangPRESIDENT` int(11) NOT NULL DEFAULT 0,
  `gangVICEPRES` int(11) NOT NULL DEFAULT 0,
  `gangCAPACITY` int(11) NOT NULL DEFAULT 0,
  `gangCRIME` int(11) NOT NULL DEFAULT 0,
  `gangCHOURS` int(11) NOT NULL DEFAULT 0,
  `gangAMENT` longtext NOT NULL,
  `gangLMM` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `gangAGE` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gangwars`
--

CREATE TABLE `gangwars` (
  `warID` int(11) NOT NULL,
  `warDECLARER` int(11) NOT NULL DEFAULT 0,
  `warDECLARED` int(11) NOT NULL DEFAULT 0,
  `warTIME` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `heists`
--

CREATE TABLE `heists` (
  `hid` int(11) NOT NULL,
  `hname` varchar(255) NOT NULL DEFAULT '',
  `hmembers` int(11) NOT NULL DEFAULT 0,
  `hpower` int(11) NOT NULL DEFAULT 0,
  `hminpayout` int(11) NOT NULL DEFAULT 0,
  `hmaxpayout` int(11) NOT NULL DEFAULT 0,
  `hcminpayout` int(11) NOT NULL DEFAULT 0,
  `hcmaxpayout` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heists`
--

INSERT INTO `heists` (`hid`, `hname`, `hmembers`, `hpower`, `hminpayout`, `hmaxpayout`, `hcminpayout`, `hcmaxpayout`) VALUES
(1, 'International Bank Robbery', 3, 10000, 5000, 25000, 1, 3),
(2, 'City Airport Hijacking', 5, 45000, 26000, 50000, 4, 7),
(3, 'Hatton Garden Jewellery Heist', 7, 95000, 50000, 90000, 8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `heist_invites`
--

CREATE TABLE `heist_invites` (
  `user` int(11) NOT NULL DEFAULT 0,
  `hleader` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heist_invites`
--

INSERT INTO `heist_invites` (`user`, `hleader`) VALUES
(1046, 1022),
(42, 1047),
(1025, 981),
(1025, 1022),
(911, 858),
(911, 905),
(156, 1022),
(156, 868),
(10, 1022),
(1002, 1022),
(995, 1022),
(991, 1022),
(36, 1022),
(991, 1120),
(911, 1022),
(182, 29),
(42, 50),
(1025, 1112),
(1039, 1112),
(1047, 1112),
(156, 1112),
(1061, 1112),
(911, 1112),
(1, 1120),
(871, 1120),
(1088, 1120),
(1047, 1120),
(911, 1120),
(158, 1120),
(1025, 958),
(1025, 911),
(159, 911),
(158, 911),
(911, 1122);

-- --------------------------------------------------------

--
-- Table structure for table `houses`
--

CREATE TABLE `houses` (
  `hID` int(11) NOT NULL,
  `hNAME` varchar(255) NOT NULL DEFAULT '',
  `hPRICE` bigint(40) NOT NULL DEFAULT 0,
  `hWILL` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `houses`
--

INSERT INTO `houses` (`hID`, `hNAME`, `hPRICE`, `hWILL`) VALUES
(1, 'Living With Parents', 0, 100),
(2, 'Motor Home', 10000, 110),
(3, 'Shared Housing', 20000, 130),
(4, 'Studio Flat', 30000, 150),
(6, 'Duplex', 100000, 200),
(7, 'Suburb Home', 150000, 250),
(8, 'Villa', 200000, 300),
(11, 'Penthouse', 800000, 500),
(12, 'Mansion', 1500000, 600),
(13, 'Palace', 5000000, 750),
(14, 'Sky Scraper', 9000000, 875),
(15, 'Hotel Resort', 15000000, 1000),
(16, 'Island Resort', 30000000, 1500),
(17, 'Private Island', 37500000, 1750),
(18, 'Small Country', 51000000, 2100);

-- --------------------------------------------------------

--
-- Table structure for table `hshoutbox`
--

CREATE TABLE `hshoutbox` (
  `id` int(11) NOT NULL,
  `hid` int(11) NOT NULL DEFAULT 0,
  `usr` int(11) NOT NULL DEFAULT 0,
  `mssg` varchar(255) NOT NULL DEFAULT '',
  `time` int(20) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hshoutbox`
--

INSERT INTO `hshoutbox` (`id`, `hid`, `usr`, `mssg`, `time`) VALUES
(6, 51, 1122, 'Lets get some money', 1562425235);

-- --------------------------------------------------------

--
-- Table structure for table `hshoutbox_banned`
--

CREATE TABLE `hshoutbox_banned` (
  `blockedwords` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `id`
--

CREATE TABLE `id` (
  `itmtypeid` int(11) DEFAULT NULL,
  `itmtypename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `id`
--

INSERT INTO `id` (`itmtypeid`, `itmtypename`) VALUES
(0, 'Drugs'),
(0, 'Medical'),
(0, 'Vehicle'),
(0, 'Gun'),
(0, 'Armor'),
(0, 'Melee'),
(0, 'Special'),
(0, 'Donation Items'),
(0, 'Potion'),
(0, 'Top Items');

-- --------------------------------------------------------

--
-- Table structure for table `ignorelist`
--

CREATE TABLE `ignorelist` (
  `ig_ID` int(11) NOT NULL,
  `ig_ADDER` int(11) NOT NULL DEFAULT 0,
  `ig_ADDED` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `imarketaddlogs`
--

CREATE TABLE `imarketaddlogs` (
  `imaID` int(11) NOT NULL,
  `imaITEM` int(11) NOT NULL DEFAULT 0,
  `imaPRICE` int(11) NOT NULL DEFAULT 0,
  `imaINVID` int(11) NOT NULL DEFAULT 0,
  `imaADDER` int(11) NOT NULL DEFAULT 0,
  `imaTIME` int(11) NOT NULL DEFAULT 0,
  `imaCONTENT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imarketaddlogs`
--

INSERT INTO `imarketaddlogs` (`imaID`, `imaITEM`, `imaPRICE`, `imaINVID`, `imaADDER`, `imaTIME`, `imaCONTENT`) VALUES
(1, 87, 1, 668, 184, 1560769879, 'Kinglarry561 added a Sparkling Martini - Restores Energy to the Item Market for 1 money'),
(2, 87, 1, 673, 184, 1560769921, 'Kinglarry561 added a Sparkling Martini - Restores Energy to the Item Market for 1 money'),
(3, 14, 251000, 839, 42, 1560775746, 'BLOOD added a Morphine - Restores Health to the Item Market for 251000 money'),
(4, 14, 400900, 1189, 42, 1560789601, 'BLOOD added a Morphine - Restores Health to the Item Market for 400900 money'),
(5, 9, 1000, 1543, 1, 1560799621, 'admin added a Pistol Glock to the Item Market for 1000 money'),
(6, 215, 100, 5982, 158, 1560817331, 'Bigjay added a Pure Crack to the Item Market for 100 crystals'),
(7, 215, 1000000, 18645, 50, 1560966295, 'TheGodFather added a Pure Crack to the Item Market for 1000000 money'),
(8, 215, 1000000, 18647, 50, 1560966328, 'TheGodFather added a Pure Crack to the Item Market for 1000000 money'),
(9, 215, 1000000, 18649, 50, 1560966352, 'TheGodFather added a Pure Crack to the Item Market for 1000000 money'),
(10, 215, 1000000, 18657, 50, 1560966446, 'TheGodFather added a Pure Crack to the Item Market for 1000000 money'),
(11, 15, 100, 44471, 1047, 1561326019, 'Herbsmokaz added a Automatic Rifle to the Item Market for 100 crystals'),
(12, 179, 1000000, 65655, 1066, 1561662984, 'ERA90 added a Mood Pill - Restores Will 100% to the Item Market for 1000000 money'),
(13, 179, 1000000, 65658, 1066, 1561663000, 'ERA90 added a Mood Pill - Restores Will 100% to the Item Market for 1000000 money'),
(14, 222, 50000, 67293, 1061, 1561687824, 'Franck187 added a Godfather Protection to the Item Market for 50000 money'),
(15, 222, 100000, 67338, 1061, 1561687922, 'Franck187 added a Godfather Protection to the Item Market for 100000 money'),
(16, 105, 10000000, 68739, 991, 1561697726, 'MzJus added a 14-Day VIP Pack to the Item Market for 10000000 money'),
(17, 15, 3000, 109904, 1039, 1562072339, 'BOUNCER added a Automatic Rifle to the Item Market for 3000 money'),
(18, 59, 4, 110396, 156, 1562076626, 'PrinceReavon added a Navy SEAL Patrol Boat to the Item Market for 4 money'),
(19, 59, 4000000, 110426, 156, 1562076686, 'PrinceReavon added a Navy SEAL Patrol Boat to the Item Market for 4000000 money'),
(20, 58, 2000000, 112052, 156, 1562150626, 'PrinceReavon added a Hired Thug to the Item Market for 2000000 money'),
(21, 222, 100000, 124209, 1061, 1562370677, 'Franck187 added a Godfather Protection to the Item Market for 100000 money'),
(22, 222, 100000, 124220, 1061, 1562370710, 'Franck187 added a Godfather Protection to the Item Market for 100000 money'),
(23, 222, 100000, 124231, 1061, 1562370728, 'Franck187 added a Godfather Protection to the Item Market for 100000 money');

-- --------------------------------------------------------

--
-- Table structure for table `imbuylogs`
--

CREATE TABLE `imbuylogs` (
  `imbID` int(11) NOT NULL,
  `imbITEM` int(11) NOT NULL DEFAULT 0,
  `imbADDER` int(11) NOT NULL DEFAULT 0,
  `imbBUYER` int(11) NOT NULL DEFAULT 0,
  `imbPRICE` int(11) NOT NULL DEFAULT 0,
  `imbIMID` int(11) NOT NULL DEFAULT 0,
  `imbINVID` int(11) NOT NULL DEFAULT 0,
  `imbTIME` int(11) NOT NULL DEFAULT 0,
  `imbCONTENT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imbuylogs`
--

INSERT INTO `imbuylogs` (`imbID`, `imbITEM`, `imbADDER`, `imbBUYER`, `imbPRICE`, `imbIMID`, `imbINVID`, `imbTIME`, `imbCONTENT`) VALUES
(1, 14, 42, 184, 251000, 3, 99999, 1560775788, 'Kinglarry561 bought a Morphine - Restores Health from the item market for $251000 from user ID 42'),
(2, 87, 184, 42, 1, 1, 99999, 1560775863, 'BLOOD bought a Sparkling Martini - Restores Energy from the item market for $1 from user ID 184'),
(3, 87, 184, 42, 1, 2, 99999, 1560775870, 'BLOOD bought a Sparkling Martini - Restores Energy from the item market for $1 from user ID 184'),
(4, 14, 42, 160, 400900, 4, 99999, 1560789734, 'shadowdemon bought a Morphine - Restores Health from the item market for $400900 from user ID 42'),
(5, 15, 1047, 868, 100, 11, 51346, 1561404684, 'Ravenous bought a Automatic Rifle from the item market for 100 crystals from user ID 1047'),
(6, 222, 1061, 156, 100000, 15, 98021, 1561899152, 'PrinceReavon bought a Godfather Protection from the item market for $100000 from user ID 1061'),
(7, 215, 50, 156, 1000000, 7, 99999, 1561923156, 'PrinceReavon bought a Cocaine - Restores All Stats from the item market for $1000000 from user ID 50');

-- --------------------------------------------------------

--
-- Table structure for table `imremovelogs`
--

CREATE TABLE `imremovelogs` (
  `imrID` int(11) NOT NULL,
  `imrITEM` int(11) NOT NULL DEFAULT 0,
  `imrADDER` int(11) NOT NULL DEFAULT 0,
  `imrREMOVER` int(11) NOT NULL DEFAULT 0,
  `imrIMID` int(11) NOT NULL DEFAULT 0,
  `imrINVID` int(11) NOT NULL DEFAULT 0,
  `imrTIME` int(11) NOT NULL DEFAULT 0,
  `imrCONTENT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `imremovelogs`
--

INSERT INTO `imremovelogs` (`imrID`, `imrITEM`, `imrADDER`, `imrREMOVER`, `imrIMID`, `imrINVID`, `imrTIME`, `imrCONTENT`) VALUES
(1, 9, 1, 1, 5, 99999, 1560799631, 'admin removed a Pistol Glock from the item market.'),
(2, 215, 158, 158, 6, 99999, 1561512462, 'Bigjay removed a Pure Crack from the item market.'),
(3, 222, 1061, 1061, 14, 99999, 1561687898, 'Franck187 removed a Godfather Protection from the item market.'),
(4, 105, 991, 991, 16, 99999, 1561698268, 'MzJus removed a 14-Day VIP Pack from the item market.'),
(5, 15, 1039, 1039, 17, 109972, 1562072680, 'BOUNCER removed a Automatic Rifle from the item market.'),
(6, 59, 156, 156, 18, 110416, 1562076653, 'PrinceReavon removed a Navy SEAL Patrol Boat from the item market.');

-- --------------------------------------------------------

--
-- Table structure for table `itembuylogs`
--

CREATE TABLE `itembuylogs` (
  `ibID` int(11) NOT NULL,
  `ibUSER` int(11) NOT NULL DEFAULT 0,
  `ibITEM` int(11) NOT NULL DEFAULT 0,
  `ibTOTALPRICE` int(11) NOT NULL DEFAULT 0,
  `ibQTY` int(11) NOT NULL DEFAULT 0,
  `ibTIME` int(11) NOT NULL DEFAULT 0,
  `ibCONTENT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itembuylogs`
--

INSERT INTO `itembuylogs` (`ibID`, `ibUSER`, `ibITEM`, `ibTOTALPRICE`, `ibQTY`, `ibTIME`, `ibCONTENT`) VALUES
(1, 31, 13, 10000, 1, 1560755964, 'MellyM bought 1 Stab-Proof Vest(s) for 10000'),
(2, 38, 13, 10000, 1, 1560767885, 'Jasper bought 1 Stab-Proof Vest(s) for 10000'),
(3, 169, 15, 6000, 1, 1560777227, 'Yaotzin bought 1 Automatic Rifle(s) for 6000'),
(4, 169, 15, 6000, 1, 1560777312, 'Yaotzin bought 1 Automatic Rifle(s) for 6000'),
(5, 169, 42, 75000, 1, 1560777390, 'Yaotzin bought 1 Benz S600(s) for 75000'),
(6, 42, 15, 6000, 1, 1560783367, 'BLOOD bought 1 Automatic Rifle(s) for 6000'),
(7, 160, 15, 6000, 1, 1560789016, 'shadowdemon bought 1 Automatic Rifle(s) for 6000'),
(8, 159, 15, 12000, 2, 1560789475, 'Number1chick bought 2 Automatic Rifle(s) for 12000'),
(9, 158, 13, 10000, 1, 1560789713, 'Bigjay bought 1 Stab-Proof Vest(s) for 10000'),
(10, 184, 15, 6000, 1, 1560791207, 'Kinglarry561 bought 1 Automatic Rifle(s) for 6000'),
(11, 42, 17, 25000, 1, 1560803210, 'BLOOD bought 1 Bullet Proof Vest(s) for 25000'),
(12, 42, 19, 50000, 1, 1560803219, 'BLOOD bought 1 Mac-10(s) for 50000'),
(13, 28, 14, 10000, 1, 1560805990, 'John Gotti bought 1 Morphine - Restores Health(s) for 10000'),
(14, 900, 14, 100000, 10, 1560813781, 'The choice bought 10 Morphine - Restores Health(s) for 100000'),
(15, 169, 14, 100000, 10, 1560820371, 'Yaotzin bought 10 Morphine - Restores Health(s) for 100000'),
(16, 169, 14, 100000, 10, 1560820406, 'Yaotzin bought 10 Morphine - Restores Health(s) for 100000'),
(17, 48, 15, 6000, 1, 1560820872, 'Tank bought 1 Automatic Rifle(s) for 6000'),
(18, 48, 10, 5000, 1, 1560820974, 'Tank bought 1 Jacket(s) for 5000'),
(19, 992, 42, 75000, 1, 1560827499, 'Ogkiller bought 1 Benz S600(s) for 75000'),
(20, 992, 15, 6000, 1, 1560827558, 'Ogkiller bought 1 Automatic Rifle(s) for 6000'),
(21, 992, 14, 100000, 10, 1560828024, 'Ogkiller bought 10 Morphine - Restores Health(s) for 100000'),
(22, 182, 14, 100000, 10, 1560837902, 'TheKnife bought 10 Morphine - Restores Health(s) for 100000'),
(23, 29, 15, 6000, 1, 1560838205, 'Vask bought 1 Automatic Rifle(s) for 6000'),
(24, 29, 13, 10000, 1, 1560838239, 'Vask bought 1 Stab-Proof Vest(s) for 10000'),
(25, 156, 42, 75000, 1, 1560859128, 'PrinceReavon bought 1 Benz S600(s) for 75000'),
(26, 156, 15, 12000, 2, 1560859145, 'PrinceReavon bought 2 Automatic Rifle(s) for 12000'),
(27, 156, 13, 10000, 1, 1560859157, 'PrinceReavon bought 1 Stab-Proof Vest(s) for 10000'),
(28, 156, 14, 100000, 10, 1560859383, 'PrinceReavon bought 10 Morphine - Restores Health(s) for 100000'),
(29, 156, 14, 100000, 10, 1560859390, 'PrinceReavon bought 10 Morphine - Restores Health(s) for 100000'),
(30, 156, 14, 20000, 2, 1560859406, 'PrinceReavon bought 2 Morphine - Restores Health(s) for 20000'),
(31, 182, 15, 6000, 1, 1560868451, 'TheKnife bought 1 Automatic Rifle(s) for 6000'),
(32, 182, 13, 10000, 1, 1560868474, 'TheKnife bought 1 Stab-Proof Vest(s) for 10000'),
(33, 1002, 13, 10000, 1, 1560870588, 'Chiara_Russo bought 1 Stab-Proof Vest(s) for 10000'),
(34, 991, 13, 10000, 1, 1560870799, 'MzJus bought 1 Stab-Proof Vest(s) for 10000'),
(35, 991, 15, 6000, 1, 1560870809, 'MzJus bought 1 Automatic Rifle(s) for 6000'),
(36, 1002, 15, 6000, 1, 1560872165, 'Chiara_Russo bought 1 Automatic Rifle(s) for 6000'),
(37, 1002, 42, 75000, 1, 1560872263, 'Chiara_Russo bought 1 Benz S600(s) for 75000'),
(38, 28, 14, 10000, 1, 1560882614, 'John Gotti bought 1 Morphine - Restores Health(s) for 10000'),
(39, 996, 15, 6000, 1, 1560886148, 'Bones bought 1 Automatic Rifle(s) for 6000'),
(40, 996, 13, 10000, 1, 1560886699, 'Bones bought 1 Stab-Proof Vest(s) for 10000'),
(41, 996, 14, 10000, 1, 1560887185, 'Bones bought 1 Morphine - Restores Health(s) for 10000'),
(42, 996, 42, 75000, 1, 1560894553, 'Bones bought 1 Benz S600(s) for 75000'),
(43, 1016, 11, 2000, 1, 1560902369, 'BigRonnie45 bought 1 Machete(s) for 2000'),
(44, 1016, 10, 5000, 1, 1560902395, 'BigRonnie45 bought 1 Jacket(s) for 5000'),
(45, 1015, 15, 6000, 1, 1560909343, 'gavjnn bought 1 Automatic Rifle(s) for 6000'),
(46, 50, 49, 250000, 1, 1560921938, 'TheGodFather bought 1 Knight XV(s) for 250000'),
(47, 50, 19, 50000, 1, 1560922015, 'TheGodFather bought 1 Mac-10(s) for 50000'),
(48, 50, 47, 35000, 1, 1560922046, 'TheGodFather bought 1 Gas Mask(s) for 35000'),
(49, 21, 42, 75000, 1, 1560933063, 'Sledog bought 1 Benz S600(s) for 75000'),
(50, 21, 15, 6000, 1, 1560933082, 'Sledog bought 1 Automatic Rifle(s) for 6000'),
(51, 190, 15, 6000, 1, 1560952048, 'shiffer bought 1 Automatic Rifle(s) for 6000'),
(52, 1015, 13, 10000, 1, 1560958397, 'gavjnn bought 1 Stab-Proof Vest(s) for 10000'),
(53, 50, 14, 100000, 10, 1560971074, 'TheGodFather bought 10 Morphine - Restores Health(s) for 100000'),
(54, 996, 19, 50000, 1, 1560986488, 'Bones bought 1 Mac-10(s) for 50000'),
(55, 996, 17, 25000, 1, 1560986657, 'Bones bought 1 Bullet Proof Vest(s) for 25000'),
(56, 996, 14, 10000, 1, 1560986717, 'Bones bought 1 Morphine - Restores Health(s) for 10000'),
(57, 1023, 15, 6000, 1, 1560988242, 'Ra_Ra_Rasputin bought 1 Automatic Rifle(s) for 6000'),
(58, 169, 49, 250000, 1, 1560988611, 'Yaotzin bought 1 Knight XV(s) for 250000'),
(59, 1029, 15, 6000, 1, 1560990362, 'JuicyBlackKitty bought 1 Automatic Rifle(s) for 6000'),
(60, 1029, 10, 5000, 1, 1560990410, 'JuicyBlackKitty bought 1 Jacket(s) for 5000'),
(61, 1035, 15, 6000, 1, 1560993439, 'TrippY_AlieN bought 1 Automatic Rifle(s) for 6000'),
(62, 868, 14, 80000, 8, 1560994568, 'Ravenous bought 8 Morphine - Restores Health(s) for 80000'),
(63, 1036, 14, 10000, 1, 1560998390, 'Dagger bought 1 Morphine - Restores Health(s) for 10000'),
(64, 1036, 14, 10000, 1, 1561003385, 'Dagger bought 1 Morphine - Restores Health(s) for 10000'),
(65, 1036, 15, 6000, 1, 1561003419, 'Dagger bought 1 Automatic Rifle(s) for 6000'),
(66, 1036, 13, 10000, 1, 1561005325, 'Dagger bought 1 Stab-Proof Vest(s) for 10000'),
(67, 1037, 15, 6000, 1, 1561006983, 'Cuddlez bought 1 Automatic Rifle(s) for 6000'),
(68, 1037, 13, 10000, 1, 1561006999, 'Cuddlez bought 1 Stab-Proof Vest(s) for 10000'),
(69, 1038, 10, 5000, 1, 1561008897, 'xXSPXxSPXx bought 1 Jacket(s) for 5000'),
(70, 1039, 15, 6000, 1, 1561021146, 'BOUNCER bought 1 Automatic Rifle(s) for 6000'),
(71, 1039, 13, 10000, 1, 1561027708, 'BOUNCER bought 1 Stab-Proof Vest(s) for 10000'),
(72, 958, 12, 4000, 1, 1561038240, 'bulltat812 bought 1 Shotgun(s) for 4000'),
(73, 958, 15, 6000, 1, 1561038264, 'bulltat812 bought 1 Automatic Rifle(s) for 6000'),
(74, 958, 11, 2000, 1, 1561038332, 'bulltat812 bought 1 Machete(s) for 2000'),
(75, 958, 13, 10000, 1, 1561038388, 'bulltat812 bought 1 Stab-Proof Vest(s) for 10000'),
(76, 958, 42, 75000, 1, 1561038502, 'bulltat812 bought 1 Benz S600(s) for 75000'),
(77, 44, 49, 250000, 1, 1561050878, 'InsanePrince bought 1 Knight XV(s) for 250000'),
(78, 1038, 15, 6000, 1, 1561061197, 'xXSPXxSPXx bought 1 Automatic Rifle(s) for 6000'),
(79, 1040, 13, 10000, 1, 1561109142, 'MrLost bought 1 Stab-Proof Vest(s) for 10000'),
(80, 1040, 15, 6000, 1, 1561109164, 'MrLost bought 1 Automatic Rifle(s) for 6000'),
(81, 1036, 19, 50000, 1, 1561111210, 'Dagger bought 1 Mac-10(s) for 50000'),
(82, 1036, 17, 25000, 1, 1561111214, 'Dagger bought 1 Bullet Proof Vest(s) for 25000'),
(83, 21, 14, 100000, 10, 1561111626, 'Sledog bought 10 Morphine - Restores Health(s) for 100000'),
(84, 992, 14, 100000, 10, 1561115140, 'Ogkiller bought 10 Morphine - Restores Health(s) for 100000'),
(85, 858, 17, 25000, 1, 1561134306, 'EOUA bought 1 Bullet Proof Vest(s) for 25000'),
(86, 858, 19, 50000, 1, 1561134311, 'EOUA bought 1 Mac-10(s) for 50000'),
(87, 1045, 13, 10000, 1, 1561161774, 'pepper13 bought 1 Stab-Proof Vest(s) for 10000'),
(88, 905, 49, 250000, 1, 1561180506, 'BLADE bought 1 Knight XV(s) for 250000'),
(89, 905, 19, 50000, 1, 1561180582, 'BLADE bought 1 Mac-10(s) for 50000'),
(90, 905, 48, 150000, 1, 1561180639, 'BLADE bought 1 Bullet Proof Benz S600 Limo(s) for 150000'),
(91, 1054, 15, 6000, 1, 1561224126, 'Lauren bought 1 Automatic Rifle(s) for 6000'),
(92, 1036, 14, 50000, 5, 1561239758, 'Dagger bought 5 Morphine - Restores Health(s) for 50000'),
(93, 158, 19, 50000, 1, 1561244258, 'Bigjay bought 1 Mac-10(s) for 50000'),
(94, 158, 49, 250000, 1, 1561244276, 'Bigjay bought 1 Knight XV(s) for 250000'),
(95, 858, 14, 40000, 4, 1561246174, 'EOUA bought 4 Morphine - Restores Health(s) for 40000'),
(96, 1022, 49, 250000, 1, 1561272289, 'FknInsane bought 1 Knight XV(s) for 250000'),
(97, 1022, 19, 50000, 1, 1561272314, 'FknInsane bought 1 Mac-10(s) for 50000'),
(98, 1022, 47, 35000, 1, 1561272319, 'FknInsane bought 1 Gas Mask(s) for 35000'),
(99, 1047, 15, 6000, 1, 1561289516, 'Herbsmokaz bought 1 Automatic Rifle(s) for 6000'),
(100, 1047, 13, 10000, 1, 1561289526, 'Herbsmokaz bought 1 Stab-Proof Vest(s) for 10000'),
(101, 1047, 42, 75000, 1, 1561289534, 'Herbsmokaz bought 1 Benz S600(s) for 75000'),
(102, 1027, 19, 50000, 1, 1561315677, 'CatLord bought 1 Mac-10(s) for 50000'),
(103, 959, 18, 2000, 1, 1561316843, 'tsume bought 1 .45 Cal Pistol(s) for 2000'),
(104, 959, 43, 50000, 1, 1561316868, 'tsume bought 1 H2 Hummer(s) for 50000'),
(105, 959, 42, 75000, 1, 1561316878, 'tsume bought 1 Benz S600(s) for 75000'),
(106, 959, 12, 4000, 1, 1561316893, 'tsume bought 1 Shotgun(s) for 4000'),
(107, 959, 10, 5000, 1, 1561316904, 'tsume bought 1 Jacket(s) for 5000'),
(108, 959, 13, 10000, 1, 1561316917, 'tsume bought 1 Stab-Proof Vest(s) for 10000'),
(109, 959, 8, 1000, 1, 1561316929, 'tsume bought 1 Baseball Bat(s) for 1000'),
(110, 959, 11, 2000, 1, 1561316939, 'tsume bought 1 Machete(s) for 2000'),
(111, 1047, 49, 250000, 1, 1561325838, 'Herbsmokaz bought 1 Knight XV(s) for 250000'),
(112, 1047, 19, 50000, 1, 1561325849, 'Herbsmokaz bought 1 Mac-10(s) for 50000'),
(113, 1047, 47, 35000, 1, 1561325855, 'Herbsmokaz bought 1 Gas Mask(s) for 35000'),
(114, 1039, 42, 75000, 1, 1561328459, 'BOUNCER bought 1 Benz S600(s) for 75000'),
(115, 1039, 47, 35000, 1, 1561333863, 'BOUNCER bought 1 Gas Mask(s) for 35000'),
(116, 1039, 19, 50000, 1, 1561333878, 'BOUNCER bought 1 Mac-10(s) for 50000'),
(117, 29, 14, 100000, 10, 1561352633, 'Vask bought 10 Morphine - Restores Health(s) for 100000'),
(118, 182, 16, 7000, 1, 1561359310, 'TheKnife bought 1 Semi-Automatic Shotgun(s) for 7000'),
(119, 182, 49, 250000, 1, 1561359373, 'TheKnife bought 1 Knight XV(s) for 250000'),
(120, 1022, 54, 600000, 1, 1561367943, 'FknInsane bought 1 Armored Bank Truck(s) for 600000'),
(121, 1022, 23, 650000, 1, 1561367953, 'FknInsane bought 1 Gold 9mm Pistol(s) for 650000'),
(122, 1022, 52, 120000, 1, 1561367961, 'FknInsane bought 1 Off Duty Dirty Cop(s) for 120000'),
(123, 1022, 21, 600000, 1, 1561367966, 'FknInsane bought 1 TAK-50 McMillan Tactical Rifle(s) for 600000'),
(124, 868, 14, 10000, 1, 1561404326, 'Ravenous bought 1 Morphine - Restores Health(s) for 10000'),
(125, 156, 19, 50000, 1, 1561410941, 'PrinceReavon bought 1 Mac-10(s) for 50000'),
(126, 29, 19, 50000, 1, 1561424733, 'Vask bought 1 Mac-10(s) for 50000'),
(127, 29, 49, 250000, 1, 1561426997, 'Vask bought 1 Knight XV(s) for 250000'),
(128, 1061, 12, 4000, 1, 1561430492, 'Franck187 bought 1 Shotgun(s) for 4000'),
(129, 1061, 13, 10000, 1, 1561431671, 'Franck187 bought 1 Stab-Proof Vest(s) for 10000'),
(130, 1061, 15, 6000, 1, 1561432295, 'Franck187 bought 1 Automatic Rifle(s) for 6000'),
(131, 156, 49, 250000, 1, 1561459353, 'PrinceReavon bought 1 Knight XV(s) for 250000'),
(132, 1027, 47, 35000, 1, 1561488667, 'CatLord bought 1 Gas Mask(s) for 35000'),
(133, 21, 14, 10000, 1, 1561489027, 'Sledog bought 1 Morphine - Restores Health(s) for 10000'),
(134, 868, 49, 250000, 1, 1561496249, 'Ravenous bought 1 Knight XV(s) for 250000'),
(135, 868, 19, 50000, 1, 1561496266, 'Ravenous bought 1 Mac-10(s) for 50000'),
(136, 868, 47, 35000, 1, 1561496278, 'Ravenous bought 1 Gas Mask(s) for 35000'),
(137, 868, 19, 50000, 1, 1561496347, 'Ravenous bought 1 Mac-10(s) for 50000'),
(138, 1064, 15, 6000, 1, 1561503412, 'Phntmst bought 1 Automatic Rifle(s) for 6000'),
(139, 21, 49, 250000, 1, 1561504916, 'Sledog bought 1 Knight XV(s) for 250000'),
(140, 1061, 19, 50000, 1, 1561513978, 'Franck187 bought 1 Mac-10(s) for 50000'),
(141, 1061, 46, 20000, 1, 1561513994, 'Franck187 bought 1 .50 Caliber Magnum S&W(s) for 20000'),
(142, 1061, 17, 25000, 1, 1561513999, 'Franck187 bought 1 Bullet Proof Vest(s) for 25000'),
(143, 21, 14, 10000, 1, 1561524373, 'Sledog bought 1 Morphine - Restores Health(s) for 10000'),
(144, 1058, 15, 6000, 1, 1561530983, 'Bubby_123 bought 1 Automatic Rifle(s) for 6000'),
(145, 1061, 14, 10000, 1, 1561566244, 'Franck187 bought 1 Morphine - Restores Health(s) for 10000'),
(146, 868, 14, 50000, 5, 1561572744, 'Ravenous bought 5 Morphine - Restores Health(s) for 50000'),
(147, 868, 14, 20000, 2, 1561576305, 'Ravenous bought 2 Morphine - Restores Health(s) for 20000'),
(148, 992, 49, 250000, 1, 1561586102, 'Ogkiller bought 1 Knight XV(s) for 250000'),
(149, 182, 14, 50000, 5, 1561605935, 'TheKnife bought 5 Morphine - Restores Health(s) for 50000'),
(150, 1068, 18, 2000, 1, 1561624162, 'Pieokid bought 1 .45 Cal Pistol(s) for 2000'),
(151, 156, 22, 25000, 1, 1561643897, 'PrinceReavon bought 1 Full Body Armor(s) for 25000'),
(152, 156, 22, 25000, 1, 1561643903, 'PrinceReavon bought 1 Full Body Armor(s) for 25000'),
(153, 868, 14, 20000, 2, 1561659324, 'Ravenous bought 2 Morphine - Restores Health(s) for 20000'),
(154, 868, 14, 60000, 6, 1561665343, 'Ravenous bought 6 Morphine - Restores Health(s) for 60000'),
(155, 21, 14, 10000, 1, 1561665873, 'Sledog bought 1 Morphine - Restores Health(s) for 10000'),
(156, 868, 14, 10000, 1, 1561688125, 'Ravenous bought 1 Morphine - Restores Health(s) for 10000'),
(157, 1061, 49, 250000, 1, 1561688236, 'Franck187 bought 1 Knight XV(s) for 250000'),
(158, 158, 14, 100000, 10, 1561689839, 'Bigjay bought 10 Morphine - Restores Health(s) for 100000'),
(159, 1061, 14, 20000, 2, 1561690944, 'Franck187 bought 2 Morphine - Restores Health(s) for 20000'),
(160, 1066, 14, 10000, 1, 1561734742, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(161, 1066, 14, 10000, 1, 1561735146, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(162, 1066, 14, 10000, 1, 1561735600, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(163, 21, 14, 10000, 1, 1561741883, 'Sledog bought 1 Morphine - Restores Health(s) for 10000'),
(164, 1066, 14, 10000, 1, 1561749530, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(165, 1039, 14, 10000, 1, 1561758788, 'BOUNCER bought 1 Morphine - Restores Health(s) for 10000'),
(166, 1066, 14, 10000, 1, 1561765646, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(167, 1066, 14, 10000, 1, 1561765695, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(168, 1083, 11, 2000, 1, 1561767874, 'Memphis bought 1 Machete(s) for 2000'),
(169, 1083, 15, 6000, 1, 1561767892, 'Memphis bought 1 Automatic Rifle(s) for 6000'),
(170, 1083, 12, 4000, 1, 1561767901, 'Memphis bought 1 Shotgun(s) for 4000'),
(171, 1083, 9, 4000, 2, 1561767923, 'Memphis bought 2 Pistol Glock(s) for 4000'),
(172, 1066, 14, 10000, 1, 1561769762, 'ERA90 bought 1 Morphine - Restores Health(s) for 10000'),
(173, 1066, 14, 30000, 3, 1561769833, 'ERA90 bought 3 Morphine - Restores Health(s) for 30000'),
(174, 1086, 8, 1000, 1, 1561776470, 'Dope bought 1 Baseball Bat(s) for 1000'),
(175, 1058, 11, 2000, 1, 1561783948, 'Bubby_123 bought 1 Machete(s) for 2000'),
(176, 1058, 15, 6000, 1, 1561792147, 'Bubby_123 bought 1 Automatic Rifle(s) for 6000'),
(177, 21, 14, 20000, 2, 1561802948, 'Sledog bought 2 Morphine - Restores Health(s) for 20000'),
(178, 1022, 51, 100000, 1, 1561803653, 'FknInsane bought 1 M2A1-7 Flamethrower(s) for 100000'),
(179, 1088, 13, 10000, 1, 1561812679, 'Carissa bought 1 Stab-Proof Vest(s) for 10000'),
(180, 1088, 15, 6000, 1, 1561812705, 'Carissa bought 1 Automatic Rifle(s) for 6000'),
(181, 1058, 13, 10000, 1, 1561812999, 'Bubby_123 bought 1 Stab-Proof Vest(s) for 10000'),
(182, 169, 54, 600000, 1, 1561821571, 'Yaotzin bought 1 Armored Bank Truck(s) for 600000'),
(183, 169, 23, 1300000, 2, 1561821711, 'Yaotzin bought 2 Gold 9mm Pistol(s) for 1300000'),
(184, 156, 58, 1000000, 1, 1561825592, 'PrinceReavon bought 1 Hired Thug(s) for 1000000'),
(185, 156, 27, 1550000, 1, 1561825621, 'PrinceReavon bought 1 FMG-9(s) for 1550000'),
(186, 21, 14, 30000, 3, 1561836417, 'Sledog bought 3 Morphine - Restores Health(s) for 30000'),
(187, 1047, 14, 100000, 10, 1561844747, 'GanjaMan bought 10 Morphine - Restores Health(s) for 100000'),
(188, 37, 14, 100000, 10, 1561854611, 'Blazinherb bought 10 Morphine - Restores Health(s) for 100000'),
(189, 1086, 14, 10000, 1, 1561862831, 'Dope bought 1 Morphine - Restores Health(s) for 10000'),
(190, 1086, 14, 10000, 1, 1561862994, 'Dope bought 1 Morphine - Restores Health(s) for 10000'),
(191, 1096, 14, 10000, 1, 1561871916, 'Slimdiesel3 bought 1 Morphine - Restores Health(s) for 10000'),
(192, 1022, 14, 100000, 10, 1561876155, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(193, 1022, 14, 100000, 10, 1561876164, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(194, 1022, 14, 100000, 10, 1561876172, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(195, 1022, 14, 100000, 10, 1561876176, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(196, 1022, 14, 100000, 10, 1561876186, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(197, 1022, 14, 100000, 10, 1561876191, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(198, 1022, 14, 100000, 10, 1561876195, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(199, 1022, 14, 100000, 10, 1561876199, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(200, 1022, 14, 100000, 10, 1561876204, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(201, 1022, 14, 100000, 10, 1561876248, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(202, 1022, 14, 100000, 10, 1561876253, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(203, 1022, 14, 100000, 10, 1561876257, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(204, 1022, 14, 100000, 10, 1561876262, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(205, 1022, 14, 100000, 10, 1561876266, 'FknInsane bought 10 Morphine - Restores Health(s) for 100000'),
(206, 992, 14, 100000, 10, 1561892683, 'Ogkiller bought 10 Morphine - Restores Health(s) for 100000'),
(207, 1058, 12, 4000, 1, 1561935056, 'Bubby_123 bought 1 Shotgun(s) for 4000'),
(208, 905, 47, 35000, 1, 1561939560, 'BLADE bought 1 Gas Mask(s) for 35000'),
(209, 1058, 19, 50000, 1, 1561955155, 'Bubby_123 bought 1 Mac-10(s) for 50000'),
(210, 1104, 14, 10000, 1, 1561962975, 'Patch bought 1 Morphine - Restores Health(s) for 10000'),
(211, 982, 45, 15000, 1, 1561991296, 'enolice bought 1 10MM Glock 20(s) for 15000'),
(212, 982, 47, 35000, 1, 1561993735, 'enolice bought 1 Gas Mask(s) for 35000'),
(213, 169, 27, 1550000, 1, 1562021871, 'Yaotzin bought 1 FMG-9(s) for 1550000'),
(214, 169, 27, 1550000, 1, 1562021957, 'Yaotzin bought 1 FMG-9(s) for 1550000'),
(215, 169, 59, 1200000, 1, 1562022397, 'Yaotzin bought 1 Navy SEAL Patrol Boat(s) for 1200000'),
(216, 37, 14, 50000, 5, 1562022426, 'Blazinherb bought 5 Morphine - Restores Health(s) for 50000'),
(217, 182, 14, 100000, 10, 1562023438, 'TheKnife bought 10 Morphine - Restores Health(s) for 100000'),
(218, 868, 14, 20000, 2, 1562025064, 'Ravenous bought 2 Morphine - Restores Health(s) for 20000'),
(219, 868, 14, 10000, 1, 1562025485, 'Ravenous bought 1 Morphine - Restores Health(s) for 10000'),
(220, 156, 59, 1200000, 1, 1562047414, 'PrinceReavon bought 1 Navy SEAL Patrol Boat(s) for 1200000'),
(221, 156, 27, 1550000, 1, 1562047424, 'PrinceReavon bought 1 FMG-9(s) for 1550000'),
(222, 156, 27, 1550000, 1, 1562047576, 'PrinceReavon bought 1 FMG-9(s) for 1550000'),
(223, 1112, 11, 2000, 1, 1562058848, 'Silver bought 1 Machete(s) for 2000'),
(224, 1039, 14, 10000, 1, 1562059198, 'BOUNCER bought 1 Morphine - Restores Health(s) for 10000'),
(225, 1039, 14, 50000, 5, 1562059238, 'BOUNCER bought 5 Morphine - Restores Health(s) for 50000'),
(226, 1039, 14, 20000, 2, 1562059914, 'BOUNCER bought 2 Morphine - Restores Health(s) for 20000'),
(227, 1112, 13, 10000, 1, 1562070356, 'Silver bought 1 Stab-Proof Vest(s) for 10000'),
(228, 958, 49, 250000, 1, 1562071517, 'bulltat812 bought 1 Knight XV(s) for 250000'),
(229, 958, 19, 50000, 1, 1562071522, 'bulltat812 bought 1 Mac-10(s) for 50000'),
(230, 958, 47, 35000, 1, 1562071529, 'bulltat812 bought 1 Gas Mask(s) for 35000'),
(231, 958, 16, 7000, 1, 1562071825, 'bulltat812 bought 1 Semi-Automatic Shotgun(s) for 7000'),
(232, 1112, 15, 6000, 1, 1562072611, 'Silver bought 1 Automatic Rifle(s) for 6000'),
(233, 1039, 54, 600000, 1, 1562073155, 'BOUNCER bought 1 Armored Bank Truck(s) for 600000'),
(234, 156, 35, 2400000, 1, 1562076019, 'PrinceReavon bought 1 CV90120-T Light Tank(s) for 2400000'),
(235, 156, 68, 1900000, 1, 1562076045, 'PrinceReavon bought 1 Mob Spy(s) for 1900000'),
(236, 156, 35, 2400000, 1, 1562076177, 'PrinceReavon bought 1 CV90120-T Light Tank(s) for 2400000'),
(237, 1112, 14, 10000, 1, 1562086540, 'Silver bought 1 Morphine - Restores Health(s) for 10000'),
(238, 1104, 14, 20000, 2, 1562086755, 'Mrs Gold bought 2 Morphine - Restores Health(s) for 20000'),
(239, 982, 42, 75000, 1, 1562092265, 'enolice bought 1 Benz S600(s) for 75000'),
(240, 982, 19, 50000, 1, 1562092313, 'enolice bought 1 Mac-10(s) for 50000'),
(241, 1058, 14, 10000, 1, 1562106652, 'Bubby_123 bought 1 Morphine - Restores Health(s) for 10000'),
(242, 1104, 19, 50000, 1, 1562113773, 'Mrs Gold bought 1 Mac-10(s) for 50000'),
(243, 1104, 42, 75000, 1, 1562113806, 'Mrs Gold bought 1 Benz S600(s) for 75000'),
(244, 1104, 47, 35000, 1, 1562113818, 'Mrs Gold bought 1 Gas Mask(s) for 35000'),
(245, 1104, 14, 100000, 10, 1562113842, 'Mrs Gold bought 10 Morphine - Restores Health(s) for 100000'),
(246, 1039, 53, 300000, 1, 1562115513, 'BOUNCER bought 1 Stealth Lambo(s) for 300000'),
(247, 1105, 15, 6000, 1, 1562115570, 'Bigmike209 bought 1 Automatic Rifle(s) for 6000'),
(248, 905, 23, 650000, 1, 1562120280, 'BLADE bought 1 Gold 9mm Pistol(s) for 650000'),
(249, 905, 21, 600000, 1, 1562120287, 'BLADE bought 1 TAK-50 McMillan Tactical Rifle(s) for 600000'),
(250, 905, 54, 600000, 1, 1562120302, 'BLADE bought 1 Armored Bank Truck(s) for 600000'),
(251, 905, 20, 300000, 1, 1562120310, 'BLADE bought 1 M2 Machine Gun(s) for 300000'),
(252, 905, 51, 100000, 1, 1562120317, 'BLADE bought 1 M2A1-7 Flamethrower(s) for 100000'),
(253, 905, 54, 600000, 1, 1562120325, 'BLADE bought 1 Armored Bank Truck(s) for 600000'),
(254, 905, 23, 650000, 1, 1562120334, 'BLADE bought 1 Gold 9mm Pistol(s) for 650000'),
(255, 905, 23, 650000, 1, 1562120458, 'BLADE bought 1 Gold 9mm Pistol(s) for 650000'),
(256, 29, 14, 30000, 3, 1562134676, 'Vask bought 3 Morphine - Restores Health(s) for 30000'),
(257, 1112, 49, 250000, 1, 1562152753, 'Silver bought 1 Knight XV(s) for 250000'),
(258, 1058, 14, 10000, 1, 1562203844, 'Bubby_123 bought 1 Morphine - Restores Health(s) for 10000'),
(259, 1058, 46, 20000, 1, 1562206554, 'Bubby_123 bought 1 .50 Caliber Magnum S&W(s) for 20000'),
(260, 1119, 15, 6000, 1, 1562248007, 'GHOST_FACE bought 1 Automatic Rifle(s) for 6000'),
(261, 1119, 13, 10000, 1, 1562248030, 'GHOST_FACE bought 1 Stab-Proof Vest(s) for 10000'),
(262, 29, 14, 30000, 3, 1562281708, 'Vask bought 3 Morphine - Restores Health(s) for 30000'),
(263, 1120, 15, 6000, 1, 1562282050, 'LuckyLuciano bought 1 Automatic Rifle(s) for 6000'),
(264, 1058, 17, 25000, 1, 1562282120, 'Bubby_123 bought 1 Bullet Proof Vest(s) for 25000'),
(265, 1120, 11, 2000, 1, 1562282125, 'LuckyLuciano bought 1 Machete(s) for 2000'),
(266, 911, 14, 40000, 4, 1562282966, 'Davina bought 4 Morphine - Restores Health(s) for 40000'),
(267, 911, 14, 40000, 4, 1562282973, 'Davina bought 4 Morphine - Restores Health(s) for 40000'),
(268, 1120, 13, 10000, 1, 1562283646, 'LuckyLuciano bought 1 Stab-Proof Vest(s) for 10000'),
(269, 1122, 15, 6000, 1, 1562292641, 'Koolsol bought 1 Automatic Rifle(s) for 6000'),
(270, 158, 14, 100000, 10, 1562301994, 'Bigjay bought 10 Morphine - Restores Health(s) for 100000'),
(271, 1122, 46, 20000, 1, 1562380857, 'Koolsol bought 1 .50 Caliber Magnum S&W(s) for 20000'),
(272, 1148, 43, 50000, 1, 1587753690, 'demo123123 bought 1 H2 Hummer(s) for 50000'),
(273, 1148, 43, 500000, 10, 1587753709, 'demo123123 bought 10 H2 Hummer(s) for 500000'),
(274, 1148, 43, 500000, 10, 1587753715, 'demo123123 bought 10 H2 Hummer(s) for 500000'),
(275, 1148, 43, 500000, 10, 1587753726, 'demo123123 bought 10 H2 Hummer(s) for 500000'),
(276, 1148, 43, 500000, 10, 1587753730, 'demo123123 bought 10 H2 Hummer(s) for 500000'),
(277, 1148, 43, 500000, 10, 1587753733, 'demo123123 bought 10 H2 Hummer(s) for 500000'),
(278, 1148, 43, 500000, 10, 1587753736, 'demo123123 bought 10 H2 Hummer(s) for 500000');

-- --------------------------------------------------------

--
-- Table structure for table `itemmarket`
--

CREATE TABLE `itemmarket` (
  `imID` int(11) NOT NULL,
  `imITEM` int(11) NOT NULL DEFAULT 0,
  `imADDER` int(11) NOT NULL DEFAULT 0,
  `imPRICE` bigint(20) NOT NULL DEFAULT 0,
  `imCURRENCY` enum('money','crystals') NOT NULL DEFAULT 'money',
  `imADDED` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemmarket`
--

INSERT INTO `itemmarket` (`imID`, `imITEM`, `imADDER`, `imPRICE`, `imCURRENCY`, `imADDED`) VALUES
(12, 179, 1066, 1000000, 'money', 1561749384),
(19, 59, 156, 4000000, 'money', 1562163086),
(8, 215, 50, 1000000, 'money', 1561052728),
(9, 215, 50, 1000000, 'money', 1561052752),
(10, 215, 50, 1000000, 'money', 1561052846),
(13, 179, 1066, 1000000, 'money', 1561749400),
(20, 58, 156, 2000000, 'money', 1562237026),
(21, 222, 1061, 100000, 'money', 1562457077),
(22, 222, 1061, 100000, 'money', 1562457110),
(23, 222, 1061, 100000, 'money', 1562457128);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `itmid` int(11) NOT NULL,
  `itmtype` int(11) NOT NULL DEFAULT 0,
  `itmname` varchar(255) NOT NULL DEFAULT '',
  `itmdesc` text NOT NULL,
  `itmbuyprice` bigint(25) NOT NULL DEFAULT 0,
  `itmsellprice` bigint(25) NOT NULL DEFAULT 0,
  `itmbuyable` int(11) NOT NULL DEFAULT 0,
  `effect1_on` tinyint(4) NOT NULL DEFAULT 0,
  `effect1` text NOT NULL,
  `effect2_on` tinyint(4) NOT NULL DEFAULT 0,
  `effect2` text NOT NULL,
  `effect3_on` tinyint(4) NOT NULL DEFAULT 0,
  `effect3` text NOT NULL,
  `weapon` int(11) NOT NULL DEFAULT 0,
  `armor` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`itmid`, `itmtype`, `itmname`, `itmdesc`, `itmbuyprice`, `itmsellprice`, `itmbuyable`, `effect1_on`, `effect1`, `effect2_on`, `effect2`, `effect3_on`, `effect3`, `weapon`, `armor`) VALUES
(80, 5, 'Laser Alarm System', 'Protect your self with the best alarm - The Laser Alarm System - Only in London', 1700000, 1275000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 7, 25),
(58, 5, 'Hired Thug', 'OG Thug from SouthSide Oakland, CA', 1000000, 750000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 20, 5),
(227, 2, 'm', 'm', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(57, 4, 'CornerShot SWAT Gun', 'Innovative handgun and grenade launcher weapon system that can shoot around corners.', 3500000, 2625000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 25, 12),
(98, 1, '7-Day Whiskey Pack', '+8% Faster Will, Energy & Brave Refills<br/>VIP Badge Next to Your Name<br/>1 Crystals Every Hour<br/>$1,000 Every Hour<br/>VIP Gym<br/>', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(99, 1, '+7 VIP Days', '+8% Faster Will, Energy & Brave Refills<br/>VIP Badge Next to Your Name<br/>1 Crystals Every Hour<br/>$1,000 Every Hour<br/>VIP Gym<br/>Bonus 150 Crystals<br/>', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:7;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(106, 4, 'Thermonuclear Bomb', 'Rare Donation Weapon. ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 25, 5),
(233, 0, 'k1', 'k', 10, 10, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(28, 4, 'Acr Sniper Rifle', 'Heat sensored sniper.. Your rival cant hide!', 1750000, 1312500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 27, 0),
(96, 0, 'Crystal Mine', '600 Crystals + Bonus Item', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(97, 0, 'Small Whiskey Case', '150 x Whiskey Pack + Bonus Crystals', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(224, 5, 'h', 'h', 10, 10, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(33, 4, 'Mini RPG Rocket Launcher', 'Anti-tank rocket propelled grenade launcher', 2000000, 1500000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 29, 0),
(34, 4, 'FGM-148 Rocket Launcher', 'Heat traced rockets never miss your target.', 4000000, 3000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 32, 0),
(35, 3, 'CV90120-T Light Tank', 'Sweden\'s NEW Light Tank carries a new 120 mm, fully stabilized, high-pressure, low recoil tank gun provides supreme fire power and accuracy against all targets on the battlefield.', 2400000, 1800000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:3;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 10, 20),
(37, 1, 'Nuke Gun', 'Destroy anything!', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 55, 0),
(42, 3, 'Benz S600', 'Blk On Blk V12 - Mobsters Dream Car', 75000, 50000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 3, 3),
(225, 0, 'kak', 'k', 10, 10, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(100, 1, '+14 VIP Days', '+8% Faster Will, Energy & Brave Refills<br/>VIP Badge Next to Your Name<br/>5 Crystals Every Hour<br/>$2,000 Every Hour<br/>Steroid Gym Gains<br/>Bonus 250 Crystals<br/>', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:14;}', 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:250;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(45, 4, '10MM Glock 20', 'Glock 20C Compensated Pistol, Polymer Frame, Fixed Sights', 15000, 11250, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 5, 5),
(43, 3, 'H2 Hummer', 'Big Rig For Big Players', 50000, 37500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 2, 2),
(56, 4, 'C-4 Explosive', 'The most powerful Non-nuclear Explosive in the world!', 2500000, 1875000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 20, 5),
(46, 4, '.50 Caliber Magnum S&W', 'Smith & Wesson Model 500 .50-Cal. Magnum Is The King Of Handguns', 20000, 150, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 7, 2),
(47, 5, 'Gas Mask', 'U.S. Army M45 Gas Mask, NBC Filter and Carrier', 35000, 26250, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 2, 5),
(48, 3, 'Bullet Proof Benz S600 Limo', 'Armored Mercedes Pullman Level B6, Bullet Proof Limousine', 150000, 7500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 6, 6),
(49, 3, 'Knight XV', ' KNIGHT XV defines the future of the ultra-luxurious, handcrafted fully armoured SUV.', 250000, 187500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 6, 10),
(92, 0, 'Medium Crystal Pack', '80 Crystals +15 Bonus', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(94, 0, 'X-Large Crystal Pack', '140 Crystals +35 Bonus', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(95, 0, 'Crystal Sack', '5000 Crystals', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(51, 4, 'M2A1-7 Flamethrower', 'M2A1-7 Heavy Infantry Flamethrowe', 100000, 75000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 10, 10),
(53, 3, 'Stealth Lambo', 'Undetectable, all blacked out, carbon fiber Lambo.', 300000, 225000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 6, 13),
(54, 3, 'Armored Bank Truck', 'Armored truck, bulletproof for security and mobile inter-bank vehicles.', 600000, 450000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 9, 16),
(59, 3, 'Navy SEAL Patrol Boat', 'U.S. Navy SEAL\\', 1200000, 900000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:3;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 10, 18),
(52, 5, 'Off Duty Dirty Cop', 'Dirty cop working to protect you.', 120000, 90000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 5, 10),
(29, 5, 'Hired Body Guard', 'Personal watch body guard for protection', 250000, 187500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 15),
(230, 5, 'jsdjsdjcdj', 'asda', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(231, 5, 'jjj', 'jj', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(228, 5, 'Chain Gun', 'asdasda', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(229, 5, 'chainasda', 'asd', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(232, 5, 'Chain Gunllll', 'asda', 0, 0, 1, 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(55, 4, 'Molotov Cocktail', 'Blow things up!', 850000, 637500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 15, 0),
(135, 6, 'Katana', 'Traditional weapon of the Samurai. This is not fake copy. But a true Katana, made by a master swordsmith. This blade can cut a person in half...A deadly Melee weapon.', 85000000, 70000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 60, 50),
(136, 4, 'P90 SMG', 'FN P90 personal defense weapon / submachine gun', 90000000, 75000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 70, 45),
(60, 4, '.50 Calibre PSG-1 Sniper Rifle', 'It features a unique camouflage, faster reload, and a built-in silencer/suppressor that does not affect firepower.', 6000000, 4500000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 30, 15),
(61, 4, 'AT4 Missile Launcher', 'High Penetration, Anti-Structure Tandem-warheads designed for destroying bunkers and buildings in combat.', 8000000, 3000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 35, 17),
(62, 4, 'AH-64A Apache Helicopter', 'The Apache is designed as a tank killer and carries - M230 30mm Cannon, Hydra 70mm FFAR Folding Fin Aerial Rockets, AGM-114 Hellfire Missiles and Stinger AIM-92 air-to-air missiles.', 10000000, 3500000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:25;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 40, 20),
(63, 4, 'BOLT-117 Laser Guided Bomb', 'A precision-guided munition (PGM, smart weapon, smart munition) is a guided munition intended to precisely hit a specific target, and to minimize damage to things other than the target.', 20000000, 5000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 56, 25),
(64, 4, 'G550 Executive Fighter Jet', 'G550 Executive/Fighter jet. Rolls-Royce BR710 turbofan engines, exceeding speeds of Mach 0.80! ', 29000000, 20000000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:25;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 60, 30),
(65, 4, 'Lockheed AC-130 Gun Ship', 'The Lockheed AC-130 gunship is a heavily-armed ground-attack aircraft. Firing The M102 105 MM Howitzer Cannon', 60000000, 40000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:50;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 80, 40),
(66, 4, 'Castle Bravo Nuclear Bomb', 'United States', 50000000, 45000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 70, 35),
(68, 5, 'Mob Spy', 'Veteran mobster spy', 1900000, 1425000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 7, 30),
(69, 5, 'Military Body Guard', 'Private military body guard.', 3250000, 2437500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 10, 40),
(70, 5, 'Ninja', 'Covert agent specializing in unorthodox arts of war.', 4250000, 3187500, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 12, 50),
(71, 5, 'Heavy Artillery', 'Artillery fire support - suppress the enemy.', 10500000, 7500000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 15, 60),
(72, 5, 'Military Satellites', 'Communications satellite used for gathering intelligence against your enemy. ', 20500000, 15375000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 17, 70),
(73, 5, 'Missile Defense System', 'Missile defense intended to shield an entire country against incoming missiles.', 25000000, 18750000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 18, 75),
(74, 5, 'Anti-Air Defense System', 'Military surface to air missile defense. No Mob will ever get to you.', 40000000, 25500000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 25, 80),
(75, 3, 'M1A2 Battle Tank', 'The M1 is a well armed, heavily armored, and highly mobile tank designed for modern armored ground warfare. Increase Energy +4. Increase Guard +4.', 4800000, 3600000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:4;}', 1, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:4;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 10, 25),
(76, 3, 'T84 Main Battle Tank', 'Fastest main battle tank. Increase Energy +5. Increase Guard +5.', 24000000, 18000000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:5;}', 1, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:5;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 20, 50),
(77, 3, 'T90 Heavy Battle Tank', 'Russian heavy battle tank. Equip with Kontakt-5 explosive-reactive armor, laser warning receivers, Nakidka camouflage and the Shtora infrared ATGM jamming system. Increase Energy +6. Increase Guard +6.', 65000000, 45000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 30, 100),
(113, 0, 'Crystal Mine', '7500 Crystals + 150 Whiskeys', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:7500;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(138, 1, 'Yakuza Tattoo', 'Special item: Ink your skin with a Yukuza Crime Syndicate Tattoo. Show you rank on your skin! When equipped as armor adds defense. ', 105000000, 90000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 120),
(107, 3, 'Luxury Yacht ', 'Rare Donation Vehicle. Attack 20 - Defense 10', 0, 1000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 20, 10),
(90, 0, 'Small Crystal Pouch', '1000 Crystals', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(91, 0, 'Large Crystal Pouch', '2500 Crystals +10 Bonus', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(86, 1, 'FireCracker', 'Increase your Strength Stat ~ Plus 25 Points Strength ~', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:25;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(87, 1003, 'Sparkling Martini - Restores Energy', 'Restores Energy 100%', 9000, 2500, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(89, 5, 'Fireman Suit', 'Fireman Suit to protect you from all the Fireworks on 4th of July! Attack 8 - Defense 8', 100000, 95000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 8, 8),
(108, 5, 'Secret Agent', 'Rare Donation Armor. Attack 5 - Defense 25', 0, 400000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 5, 25),
(109, 0, 'Donator Armor', 'Recieve a Rare Donation Armor', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(110, 0, 'Donator Vehicle', 'Receive a Rare Donation Vehicle', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(111, 0, 'Donator Weapon', 'Receive a Rare Donation Weapon', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(101, 0, 'Large Whiskey Case', '500 x Whiskey Pack  + Bonus Crystals', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(112, 6, 'Gordo\\\'s Wrath test', 'test item', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(114, 4, 'FireStorm Weapon System', 'FireStorm is a lightweight multi barrel 40mm electronic weapon system . The 4 barrel configuration can deliver a force spectrum from a lethal salvo of high explosive grenades at a burst fire rate of up to 24,000rpm. Rare Donation Weapon.', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 55, 25),
(115, 5, 'SWAT Full armor kit', 'Class 5 SWAT armor, Full Kevlar body protection with Kevlar helmet and face shield.  ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 35),
(102, 0, '7-Day Donator Pack', '7-Day Donator', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(104, 0, '7-Day VIP Pack', '7-Day VIP ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(116, 1, 'Mask of Terror', 'The Mask of Terror is a unique item of unknown origin. Its said that whomever looks at the masks faces his or her greatest fears. Weaks foes as it conjures deep and uncontrolled terror.. A powerful and unique armor. ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 45),
(118, 1, 'Thanksgiving Turkey', 'A tender oven roasted Turkey. Just the ticket for Thanksgiving! *Special item. Offers unique stat boost..', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:1;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 0),
(119, 3, 'Leopard 2A6 Battle Tank', 'The Leopard 2A6 main battle tank. Currently it is one of the best main battle tanks in the world. The Leopard 2A6 tank is armed with the Rheinmetall 120-mm L55 smoothbore gun', 0, 60000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 35, 115),
(120, 5, 'SMAW rocket launcher', 'Unique limited edition item. The SMAW Rocket launcher fires, 83 mm rocket rounds and also sports a 9mm spotting rifle. With an effective range off 250m the SMAW rocket launcher is a deadly weapon. ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 45, 10),
(121, 0, 'Extra Whiskey Box', '2000 x Whiskey pack, for those Alcoholics out there! + Bonus Crystals', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(122, 0, 'Special Christmas', 'Special Christmas', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(123, 1, 'Christmas Gift', 'A Christmas gift from the game....', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:50;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 0, 0),
(125, 4, 'A-10 Thunderbolt II', 'The Fairchild Republic A-10 Thunderbolt II is an American single-seat, twin-engine, straight-wing jet aircraft developed by Fairchild-Republic in the early 1970s. The A-10 was designed for a United States Air Force requirement to provide close air support (CAS) for ground forces by attacking tanks, armored vehicles, and other ground targets with a limited air interdiction capability', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 85, 50),
(126, 0, 'Item: Top Armor', 'Best Armor in the game + Bonus 500 crystals & 5 days Donator status', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(124, 0, 'Item: Top Weapon', 'Best Weapon in the game + Bonus 500 crystals & 5 days Donator status', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(128, 5, 'Air Force Intercept', 'Scramble an Air force strike jet to defend you and intercept your target via GPS.', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 90, 150),
(129, 7, 'Strength Booster', 'Permanently increases your strength 3%. *Best used at high levels', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(130, 7, 'Agility Booster', 'Permanently increases your Agility by 3% *Best used at high levels', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(132, 3, 'Shahed 285 Light Attack chopper', 'Ultra light attack helicopter. The Shahed 285 can carry autocanons, machine guns, guided missiles, anti-armor missiles and air-to-air and air-to-sea missiles. ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 70, 35),
(131, 7, '+ Level Boost', 'Instantly gain one level!', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"maxhp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:50;}', 1, 'a:4:{s:4:\"stat\";s:5:\"level\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 1, 'a:4:{s:4:\"stat\";s:8:\"maxbrave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2;}', 0, 0),
(205, 1, 'Crystal Gym Pass', 'Access to the crystal gym for 60 minutes.', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"gympass\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 0),
(134, 0, 'Platinum Pack', '2 x 31 Day VIP Pack, 2 x 31 Day Donator', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(137, 4, 'Dual wield P90s', 'Why use one when you can have two! FN P90 personal defense weapon / submachine gun', 100000000, 85000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 75, 50),
(139, 1, 'Yakuza Tattoo Full body', 'Step it up and cover your whole body in full Yakuza Tattoo\\', 125000000, 100000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 130),
(140, 1, 'Yakuza Assassin ', 'A Yakuza Assassin to do your bidding for you. He will fight and defend you with his life.', 500000000, 400000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 90, 90),
(141, 2, 'Green Tea - Adds Agility, Restores 20% will.', 'Increases Agility and restores some will.', 25000, 15000, 0, 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:20;}', 0, 'a:4:{s:4:\"stat\";s:2:\"hp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:75;}', 0, 0),
(142, 4, 'FN2000 Assault Rifle', 'The FN F2000 is a 5.56Ãƒâ€”45mm NATO bullpup assault rifle', 150000000, 120000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 95, 40),
(143, 7, 'Strength Pills', 'Special in-house treatment to boost your strength 15000 points permanently. Great for making weaker Gang members stronger.....', 149900000, 0, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:15000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(144, 1, 'Valentines Chocolates', 'A gift for Valentines Day from the Pocket Mafia team. Gift them to a loved one, or just item them yourself!... These chocolates have a mysterious effect when eaten..', 0, 10, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:15;}', 0, 0),
(145, 0, 'Item: Drug Booster Guard Kit', 'Gain a level, 50 hp, 2 brave and boost your Guard and Strength permanently by 3%!', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(147, 1, 'Golden Easter Egg', 'Happy Easter from Pocket Mafia! Eat to gain two bonuses and can even be thrown as a weapon if you feel the need...', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 15, 0),
(148, 4, 'XM25 Punisher', 'The XM25 Counter Defilade Target Engagement (CDTE) System aka Punisher. The gun fires 25 mm grenades that are set to explode in mid-air at or near the target. A laser rangefinder in the weapon is used to determine the distance to the target.', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 115, 45);
INSERT INTO `items` (`itmid`, `itmtype`, `itmname`, `itmdesc`, `itmbuyprice`, `itmsellprice`, `itmbuyable`, `effect1_on`, `effect1`, `effect2_on`, `effect2`, `effect3_on`, `effect3`, `weapon`, `armor`) VALUES
(146, 7, 'Guard Booster', 'Permanently increases your Gaurd 3% when taken!', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:2;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(127, 0, 'Item: Drug Booster Kit', 'Gain a level, 50 hp, 2 brave and boost your Strength and Agility permanently by 3%!', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(149, 4, 'B-2 Stealth Bomber', 'B-2 Spirit (Stealth Bomber). The Northrop Grumman B-2 Spirit (also known as the Stealth Bomber) is an American heavy bomber with low observable stealth technology designed to penetrate dense anti-aircraft defenses and deploy both conventional and nuclear weapons. The bomber has a crew of two and can drop up to 80 500 lb (230 kg)-class JDAM GPS-guided bombs, or 16 2,400 lb (1,100 kg) B83 nuclear bombs. The B-2 is the only aircraft that can carry large air to surface standoff weapons in a stealth configuration.', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 200, 100),
(150, 5, 'Patriot Air Defense System - Armor', 'Patriot Missile Air Defense System. SAM launchers from both land and sea. Advanced Radar and statilite tracking systems. Can defend against both long range sub orbital and short range ballistic bio and nuclear missiles.', 0, 500000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 120, 180),
(151, 1, 'Bunch of Flowers', 'Flower bouquet to make any Mob Partner PROUD!', 75000, 25000, 1, 0, 'a:4:{s:4:\"stat\";s:5:\"maxhp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 18, 10),
(152, 4, 'Dragontaser', 'Nice And Nasty In Ya Face', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 400, 150),
(154, 1, 'Fathers Day hamper', 'A gift for any mob father, what looks like a standard gift hamper packs a hidden cache of crystals! Happy fathers day', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:250;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(155, 4, 'GOD', 'The satellite god was created by the United States Government . In Area 51 taking the technology from aliens weapons. ', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 400, 150),
(156, 4, 'Tunguska Blast', '4th of July Special Item! 30 SHOT RED, GREEN, YELLOW, BLUE, PURPLE DAHLIA WITH WHITE STROBE ENDING WITH BROCADES AND CRACKLING FLOWERS.', 450000000, 350000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 175, 130),
(157, 4, 'Wolfpack HP Shell', 'Special 4th July item! Wolfpack high proformance shells. Used in mortar system', 280000000, 250000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 180, 110),
(158, 4, 'Fierce Tiger Rocket', 'Special 4th July item! This loud shrilling rocket roars loudly to space and then transforms into a gold-orange star burst. Ends with a colorful explosion of light!', 72000000, 60000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 130, 60),
(159, 2, 'Pyro Potion - Restore WILL/BRV/ENG', 'Recovery potion, great for recovering pyromaniacs. Restores 100% brave, will and energy!  Plus heals 3rd degree burns!\r\n', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 0, 0),
(160, 1, 'Russian Roulette Pistol', 'An old Pistol with one round in it, grants use of the Russian Roulette challenge. (Special Item) Useless in fire fights due to only having 1 round. *Disclaimer, fictional use only. Never play Russian Roulette in real life, it will end in tears... ', 0, 1000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(161, 1, 'VIP Bodyguard', 'Gives one hours protection from being attacked. Use on the hour game time.', 0, 0, 0, 1, 'a:4:{s:4:\"stat\";s:9:\"protected\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 0),
(162, 0, 'Item: VIP Bodyguard', 'The VIP Bodyguard blocks all incoming attacks for 1 hour, great for hassle free training sessions', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(163, 4, 'Bernardelli B4', 'The Bernardelli B4 shotgun, weapon feeds from a removable box magazine. A grip safety device prevents the weapon from being fired unless properly handled.The B4 shotgun can be operated as a self-loading weapon or manually as a pump-action gun, the choice being selected by a lever. ', 175000000, 130000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 145, 90),
(165, 4, 'Sukhoi PAK FA', 'The Sukhoi PAK FA, is a Russian twin engine stealth multirole fighter. The PAK FA is a next-generation aircraft that could head to head against the F-22 or F-35 stealth aircraft of the U.S. ', 350000000, 310000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 248, 134),
(167, 1003, 'Bulk2000 Muscle Builder', 'Serbian secret bodybuilding mix of steroids. Warning may cause: liver damage, heart disease and certain shrinkage... Increases strength and health. But hurts agility.', 200000000, 170000000, 1, 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2000000;}', 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:8000;}', 1, 'a:4:{s:4:\"stat\";s:5:\"maxhp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10;}', 0, 0),
(168, 1, 'Surcin Mafia Mob', 'Send in a mob of Surcin Mafia foot soldiers to do your dirty work for you. The mob can defend or attack for you depending on how you equip them.', 325000000, 305000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 220, 90),
(169, 4, 'AW50 - Sniper Rifle', 'The AW50 is intended to engage a variety of targets including radar installations, light vehicles (including light armoured vehicles), field fortifications, boats and ammunition dumps. The standard ammunition combines a penetrator, high explosive and incendiary effect in a single round.', 250000000, 220000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 185, 100),
(164, 3, 'F-35 Lightning II', 'The Lockheed Martin F-35 Lightning II. A single-seat, single-engine, fifth generation multirole fighters under development to perform ground attack, reconnaissance, and air defense missions with stealth capability.', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 310, 150),
(166, 3, 'Astute class Submarine', 'UK designed and built Astute class nuclear submarine. Equipped with harpoon torpedoes and Sea to ground tomahawk cruise missiles. The astute class submarine offers great defensive and the ability to hide for your enemy deep within the ocean.....', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 240, 300),
(170, 3, 'Type 45 Destroyer', 'THIS DESTROYER IS BUILT FOR THE UK ROYAL NAVY. IT\'S EQUIPPED WITH ANTI- AIR MISSILES AND MULTIPLE OTHER ARMAMENTS. THIS TYPE 45 DESTROYER GIVES YOU THE POWER TO ATTACK YOUR ENEMY UP CLOSE, AND THE SPEED TO SAFELY LEAVE THE AREA', 0, 5000000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 410, 160),
(171, 4, 'Exploding Jack-o-lantern', 'As the name implies, this is no normal Jack-O-Lantern, but one packed with a huge amount of C4. Gives your enemies a real surprise with this.', 210000000, 195000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 260, 100),
(172, 5, 'Dark Knight Armored Suit', 'Your very own Dark Knight suit of armor, stolen from one unamed super hero. Halloween 2012  item', 299000000, 250000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 80, 270),
(173, 1, 'The Headless Horseman', 'The legend of Sleepy Hollow returns to fight by your side. ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 275, 120),
(174, 1, 'Zombie Horde', 'Virus infected Zombie mob to overwhelm your enemies and eventually eat them! Halloween 2012 item.', 110000000, 90000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 200, 50),
(175, 6, 'The Grim Scythe ', 'Used by the one and only Mr Death. If this blade cuts only death will follow.... Halloween 2012 Item', 89000000, 75000000, 1, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 160, 75),
(176, 4, 'Battleship USS Iowa', 'Iowa class battleship, that served from the 40s to the 90s in the US navy.   ', 0, 500000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 400, 200),
(177, 5, 'Bunker', 'A defensive bunker designed to protect against chemical and nuclear weapons. Armed with artillery which can be used to attack any enemy forces within range.  ', 0, 500000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 160, 400),
(178, 1, 'Christmas Gift 2012', 'From the Pocket Mafia staff, wishing you a Merry Christmas and safe holidays! Grants 3 wishes. Agility, Strength and Wealth', 50, 50, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:3;}', 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:3;}', 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1000;}', 0, 0),
(179, 1, 'Mood Pill - Restores Will 100%', 'Restores your will power to 100%', 25000, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(180, 1, 'Prison Keys', 'Get out of prison instantly!', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:4:\"jail\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(181, 1, 'Strength Shot +200', 'Increase your strength by 200', 0, 25000, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:200;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(182, 1, 'Guard Shot +200', 'Increase your guard by 200', 0, 25000, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"guard\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:200;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(183, 1, 'Agility Shot +200', 'Increase your agility by 200', 0, 25000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:200;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(184, 1, '150 Max Energy', 'Set your energy bar to 150 for 60 minutes!', 0, 2500, 0, 1, 'a:4:{s:4:\"stat\";s:9:\"vipenergy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:30;}', 0, 0),
(185, 0, '75k of Crystals', '75k of Crystals', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(186, 0, '150k of Crystals', '150k of Crystals', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(187, 1, '15 Credit Pack', '15 Credits', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:15;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(188, 1, '50 Credit Pack', '50 Credits', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:50;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(189, 1, '150 Credit Pack', '150 Credits', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:150;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(191, 1, '2800 Credit Pack', '2800 Credits', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:2800;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(193, 0, 'Hitman Pack', 'Hitman Pack', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(197, 0, '2800 Credits', '+2800 Credits', 0, 0, 0, 0, '0', 0, '0', 0, '0', 0, 0),
(192, 0, 'Starter Pack', 'Starter pack.', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:25;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(194, 0, 'Platinum Boss Pack', 'Everything you need to be the boss.', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:375;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(201, 1, '250 Max Energy', '250 Max Energy for an hour!', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:12:\"vipmaxenergy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 0),
(202, 1, 'Brave Shot', 'Increase your max brave by 1 permanently!', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"maxbrave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(203, 1, 'Prison Badge', 'Avoid prison on failed crimes for 60 minutes!', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:9:\"jailavoid\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 1, 'a:4:{s:4:\"stat\";s:4:\"jail\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 0),
(103, 0, '14-Day Donator Pack', 'Double Speed Will, Energy & Brave Refills <br />  Donator Symbol next to your name  <br /> +6% Bank Interest ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(105, 0, '14-Day VIP Pack', '14-Day VIP ', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:14;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(200, 1, 'Energizer', 'Full refill on energy, will, brave and health every 5 minutes for 60 minutes.', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"mvp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 0),
(133, 1000, 'Item: Top Items', 'Set of top weapon and armor', 0, 50000, 0, 0, 'a:4:{s:4:\"stat\";s:10:\"weapondays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:14;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(196, 0, 'Ultimate Mafia Pack', 'The real deal pack!', 0, 0, 0, 0, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(204, 1, '7-Day Gradient Pack', 'Display your unique gradient username for 7 days! <a href=', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:12:\"gradientdays\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:7;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(206, 1, '$100K Game cash', '$100,000 added to your account.', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"money\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:100000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(211, 1, '$10M Game cash', '$10,000,000 added to your account.', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"money\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10000000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(93, 0, '10k of Crystals', '10,000 Crystals Pack + Bonus item', 0, 150000, 0, 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(210, 1, '$1M Game cash', '$1,000,000  added to your account.', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"money\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1000000;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(212, 1, '1-Day VIP', 'Access to VIP features for 1 day.', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"vip\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(199, 1, 'XP Booster', 'Double XP gained on successful crimes and attacks for 60 minutes!', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:10:\"crimebonus\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:30;}', 0, 0),
(198, 1, 'Dead lift', 'Double stat gained when working out at any gym for 60 minutes.', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:9:\"traintime\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:60;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:30;}', 0, 0),
(190, 1, '500 Credit Pack', '500 Credits', 0, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:7:\"credits\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:500;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(213, 1, 'Private Nurse', 'She will do anything you wish! 100% Energy and HP.', 10000, 1000, 1, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:2:\"hp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 0),
(117, 1, 'Drink of the Dead', 'This mysterious odd colored, veil smelling drink is said to be haunted but gives crystals. Even some talk of it being made from the dead themselves. Only a fool would drink such a thing, right?. Yet if taken its said to give wealth and power too. But at what cost? Are you game enough to use it or let others be the guinea pig?', 100000, 50000, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"crystals\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10;}', 0, 'a:4:{s:4:\"stat\";s:7:\"agility\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:1;}', 1, 'a:4:{s:4:\"stat\";s:8:\"hospital\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10;}', 0, 0),
(88, 4, 'Roman Candle', 'Explosive Roman Candles can be equipped as a weapon or dare to experiment the use!', 50000, 25000, 0, 1, 'a:4:{s:4:\"stat\";s:4:\"jail\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:10;}', 1, 'a:4:{s:4:\"stat\";s:8:\"strength\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:250;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:20;}', 13, 8),
(214, 1, '1-Day Crystal Ball', '+150 crystals added to your account per hour! ', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:11:\"crystalball\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 0),
(216, 1, '1-Day Premium Interest', 'Double up on your bank interest for a day! Applies to regular and donator bank!', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:12:\"bankinterest\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 0),
(218, 1003, 'XP Potion', 'Smells very bad but it is said to give +1000 instant increase in XP points, however it does harm your health! ', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:3:\"exp\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1000;}', 1, 'a:4:{s:4:\"stat\";s:2:\"hp\";s:3:\"dir\";s:3:\"neg\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:25;}', 0, 'a:4:{s:4:\"stat\";s:8:\"hospital\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:5;}', 0, 0),
(219, 1, '1-Day Amulet of Power', 'Powerful and blessed amulet by one of the Mafia Gods. By having this you will be sure to gain x amount (max +2500 points) in str, agility and guard per hour!', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:4:\"stat\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 1, 'a:4:{s:4:\"stat\";s:11:\"activeperks\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 0),
(220, 1003, 'Energy Drink', 'Refill your Turns and 100% Energy to continue scavenging!', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:5:\"turns\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(221, 1, '7-Day Animation Icons', 'Add a unique animated icon to your profile and stand out! <a href=animation.php><font color=orange>Set it here</font></a>', 0, 5000, 0, 1, 'a:4:{s:4:\"stat\";s:8:\"animated\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:7;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(215, 1, 'Cocaine - Restores All Stats', '100% Energy, Will & Brave, Instant action!', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:4:\"will\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 1, 'a:4:{s:4:\"stat\";s:5:\"brave\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:7:\"percent\";s:10:\"inc_amount\";i:100;}', 0, 0),
(222, 1, 'Godfather Protection', 'You will be protected for 24 hours from being attacked!', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:9:\"protected\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:24;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0),
(223, 1, 'Energy Shot', '+1 added to your energy permanently1 ', 0, 1000, 0, 1, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:1;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 'a:4:{s:4:\"stat\";s:6:\"energy\";s:3:\"dir\";s:3:\"pos\";s:8:\"inc_type\";s:6:\"figure\";s:10:\"inc_amount\";i:0;}', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `itemselllogs`
--

CREATE TABLE `itemselllogs` (
  `isID` int(11) NOT NULL,
  `isUSER` int(11) NOT NULL DEFAULT 0,
  `isITEM` int(11) NOT NULL DEFAULT 0,
  `isTOTALPRICE` int(11) NOT NULL DEFAULT 0,
  `isQTY` int(11) NOT NULL DEFAULT 0,
  `isTIME` int(11) NOT NULL DEFAULT 0,
  `isCONTENT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemselllogs`
--

INSERT INTO `itemselllogs` (`isID`, `isUSER`, `isITEM`, `isTOTALPRICE`, `isQTY`, `isTIME`, `isCONTENT`) VALUES
(1, 44, 215, 800000, 16, 1560754881, 'InsanePrince sold 16 Pure Crack(s) for $800000'),
(2, 31, 215, 50000, 1, 1560755575, 'MellyM sold 1 Pure Crack(s) for $50000'),
(3, 169, 9, 1500, 1, 1560777347, 'Yaotzin sold 1 Pistol Glock(s) for $1500'),
(4, 158, 215, 600000, 12, 1560788073, 'Bigjay sold 12 Pure Crack(s) for $600000'),
(5, 158, 215, 500000, 10, 1560788220, 'Bigjay sold 10 Pure Crack(s) for $500000'),
(6, 44, 215, 12900000, 258, 1560798896, 'InsanePrince sold 258 Pure Crack(s) for $12900000'),
(7, 44, 215, 25000000, 500, 1560800308, 'InsanePrince sold 500 Pure Crack(s) for $25000000'),
(8, 28, 14, 15000, 5, 1560801672, 'John Gotti sold 5 Morphine - Restores Health(s) for $15000'),
(9, 28, 215, 2400000, 48, 1560805844, 'John Gotti sold 48 Pure Crack(s) for $2400000'),
(10, 28, 215, 1000000, 20, 1560805928, 'John Gotti sold 20 Pure Crack(s) for $1000000'),
(11, 28, 215, 50000, 1, 1560805941, 'John Gotti sold 1 Pure Crack(s) for $50000'),
(12, 28, 215, 20000000, 400, 1560806399, 'John Gotti sold 400 Pure Crack(s) for $20000000'),
(13, 28, 215, 1250000, 25, 1560806418, 'John Gotti sold 25 Pure Crack(s) for $1250000'),
(14, 28, 215, 150000, 3, 1560806579, 'John Gotti sold 3 Pure Crack(s) for $150000'),
(15, 28, 215, 6250000, 125, 1560806859, 'John Gotti sold 125 Pure Crack(s) for $6250000'),
(16, 28, 9, 1500, 1, 1560807320, 'John Gotti sold 1 Pistol Glock(s) for $1500'),
(17, 28, 87, 5000, 2, 1560807337, 'John Gotti sold 2 Sparkling Martini - Restores Energy(s) for $5000'),
(18, 28, 215, 5000000, 100, 1560810248, 'John Gotti sold 100 Pure Crack(s) for $5000000'),
(19, 28, 215, 20000000, 400, 1560810260, 'John Gotti sold 400 Pure Crack(s) for $20000000'),
(20, 28, 215, 25000000, 500, 1560810326, 'John Gotti sold 500 Pure Crack(s) for $25000000'),
(21, 28, 215, 5000000, 100, 1560813062, 'John Gotti sold 100 Pure Crack(s) for $5000000'),
(22, 28, 215, 12500000, 250, 1560813361, 'John Gotti sold 250 Pure Crack(s) for $12500000'),
(23, 28, 215, 3700000, 74, 1560813820, 'John Gotti sold 74 Pure Crack(s) for $3700000'),
(24, 28, 215, 50000, 1, 1560813906, 'John Gotti sold 1 Pure Crack(s) for $50000'),
(25, 28, 215, 50000, 1, 1560813920, 'John Gotti sold 1 Pure Crack(s) for $50000'),
(26, 169, 215, 1250000, 25, 1560814065, 'Yaotzin sold 25 Pure Crack(s) for $1250000'),
(27, 169, 215, 5000000, 100, 1560814173, 'Yaotzin sold 100 Pure Crack(s) for $5000000'),
(28, 28, 215, 25000000, 500, 1560814605, 'John Gotti sold 500 Pure Crack(s) for $25000000'),
(29, 169, 215, 26250000, 525, 1560814861, 'Yaotzin sold 525 Pure Crack(s) for $26250000'),
(30, 169, 215, 12500000, 250, 1560815782, 'Yaotzin sold 250 Pure Crack(s) for $12500000'),
(31, 169, 215, 23750000, 475, 1560816066, 'Yaotzin sold 475 Pure Crack(s) for $23750000'),
(32, 38, 215, 5000000, 100, 1560816425, 'Jasper sold 100 Pure Crack(s) for $5000000'),
(33, 169, 215, 12500000, 250, 1560819403, 'Yaotzin sold 250 Pure Crack(s) for $12500000'),
(34, 169, 215, 6250000, 125, 1560820211, 'Yaotzin sold 125 Pure Crack(s) for $6250000'),
(35, 169, 215, 2500000, 50, 1560822236, 'Yaotzin sold 50 Pure Crack(s) for $2500000'),
(36, 28, 215, 10000000, 200, 1560826345, 'John Gotti sold 200 Pure Crack(s) for $10000000'),
(37, 28, 215, 50000000, 1000, 1560827210, 'John Gotti sold 1000 Pure Crack(s) for $50000000'),
(38, 28, 215, 10000000, 200, 1560827237, 'John Gotti sold 200 Pure Crack(s) for $10000000'),
(39, 28, 215, 50000000, 1000, 1560827399, 'John Gotti sold 1000 Pure Crack(s) for $50000000'),
(40, 28, 215, 6250000, 125, 1560827565, 'John Gotti sold 125 Pure Crack(s) for $6250000'),
(41, 28, 215, 7500000, 150, 1560827582, 'John Gotti sold 150 Pure Crack(s) for $7500000'),
(42, 28, 215, 5000000, 100, 1560827622, 'John Gotti sold 100 Pure Crack(s) for $5000000'),
(43, 42, 215, 16000000, 320, 1560829315, 'BLOOD sold 320 Pure Crack(s) for $16000000'),
(44, 42, 215, 18750000, 375, 1560832890, 'BLOOD sold 375 Pure Crack(s) for $18750000'),
(45, 42, 215, 750000, 15, 1560835335, 'BLOOD sold 15 Pure Crack(s) for $750000'),
(46, 31, 215, 3200000, 64, 1560836123, 'MellyM sold 64 Pure Crack(s) for $3200000'),
(47, 31, 215, 2800000, 56, 1560836922, 'MellyM sold 56 Pure Crack(s) for $2800000'),
(48, 31, 215, 2950000, 59, 1560837741, 'MellyM sold 59 Pure Crack(s) for $2950000'),
(49, 42, 215, 16250000, 325, 1560848218, 'BLOOD sold 325 Pure Crack(s) for $16250000'),
(50, 31, 215, 3100000, 62, 1560855907, 'MellyM sold 62 Pure Crack(s) for $3100000'),
(51, 31, 215, 2550000, 51, 1560858158, 'MellyM sold 51 Pure Crack(s) for $2550000'),
(52, 31, 215, 1000000, 20, 1560859343, 'MellyM sold 20 Pure Crack(s) for $1000000'),
(53, 169, 15, 100, 2, 1560867363, 'Yaotzin sold 2 Automatic Rifle(s) for $100'),
(54, 169, 215, 10000000, 200, 1560872863, 'Yaotzin sold 200 Pure Crack(s) for $10000000'),
(55, 42, 9, 1500, 1, 1560881036, 'BLOOD sold 1 Pistol Glock(s) for $1500'),
(56, 28, 215, 31250000, 625, 1560883298, 'John Gotti sold 625 Pure Crack(s) for $31250000'),
(57, 28, 215, 31250000, 625, 1560884149, 'John Gotti sold 625 Pure Crack(s) for $31250000'),
(58, 28, 215, 37500000, 750, 1560884695, 'John Gotti sold 750 Pure Crack(s) for $37500000'),
(59, 28, 179, 1000, 1, 1560885708, 'John Gotti sold 1 Mood Pill - Restores Will 100%(s) for $1000'),
(60, 861, 215, 50000, 1, 1560889076, 'LevyGaming sold 1 Pure Crack(s) for $50000'),
(61, 861, 215, 15000000, 300, 1560889161, 'LevyGaming sold 300 Pure Crack(s) for $15000000'),
(62, 170, 215, 1250000, 25, 1560896197, 'chegwine sold 25 Pure Crack(s) for $1250000'),
(63, 170, 215, 11250000, 225, 1560896301, 'chegwine sold 225 Pure Crack(s) for $11250000'),
(64, 170, 215, 5000000, 100, 1560896374, 'chegwine sold 100 Pure Crack(s) for $5000000'),
(65, 50, 9, 1500, 1, 1560922363, 'TheGodFather sold 1 Pistol Glock(s) for $1500'),
(66, 28, 215, 10000000, 200, 1560964560, 'John Gotti sold 200 Pure Crack(s) for $10000000'),
(67, 28, 215, 10000000, 200, 1560964836, 'John Gotti sold 200 Pure Crack(s) for $10000000'),
(68, 28, 215, 10000000, 200, 1560964919, 'John Gotti sold 200 Pure Crack(s) for $10000000'),
(69, 28, 215, 15000000, 300, 1560965271, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(70, 28, 215, 15000000, 300, 1560965441, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(71, 28, 215, 15000000, 300, 1560965586, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(72, 28, 215, 15000000, 300, 1560965729, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(73, 28, 215, 15000000, 300, 1560965813, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(74, 28, 215, 15000000, 300, 1560965906, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(75, 28, 215, 15000000, 300, 1560965977, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(76, 28, 215, 15000000, 300, 1560966443, 'John Gotti sold 300 Pure Crack(s) for $15000000'),
(77, 28, 215, 30000000, 600, 1560966530, 'John Gotti sold 600 Pure Crack(s) for $30000000'),
(78, 28, 215, 17500000, 350, 1560966711, 'John Gotti sold 350 Pure Crack(s) for $17500000'),
(79, 28, 215, 12500000, 250, 1560966793, 'John Gotti sold 250 Pure Crack(s) for $12500000'),
(80, 28, 215, 25000000, 500, 1560966838, 'John Gotti sold 500 Pure Crack(s) for $25000000'),
(81, 28, 215, 5000000, 100, 1560967991, 'John Gotti sold 100 Pure Crack(s) for $5000000'),
(82, 158, 215, 31450000, 629, 1560970098, 'Bigjay sold 629 Pure Crack(s) for $31450000'),
(83, 169, 42, 50000, 1, 1560988673, 'Yaotzin sold 1 Benz S600(s) for $50000'),
(84, 50, 88, 300000, 12, 1560989440, 'TheGodFather sold 12 Roman Candle(s) for $300000'),
(85, 1028, 14, 6000, 2, 1560989851, 'KingChicken sold 2 Morphine - Restores Health(s) for $6000'),
(86, 1028, 87, 5000, 2, 1560989864, 'KingChicken sold 2 Sparkling Martini - Restores Energy(s) for $5000'),
(87, 158, 215, 92650000, 1853, 1560992006, 'Bigjay sold 1853 Pure Crack(s) for $92650000'),
(88, 1035, 9, 1500, 1, 1560993470, 'TrippY_AlieN sold 1 Pistol Glock(s) for $1500'),
(89, 991, 9, 1500, 1, 1561034586, 'MzJus sold 1 Pistol Glock(s) for $1500'),
(90, 28, 9, 1500, 1, 1561057578, 'John Gotti sold 1 Pistol Glock(s) for $1500'),
(91, 861, 215, 50000, 50, 1561084958, 'LevyGaming sold 50 Pure Crack(s) for $50000'),
(92, 1036, 13, 7500, 1, 1561111477, 'Dagger sold 1 Stab-Proof Vest(s) for $7500'),
(93, 1045, 87, 5000, 2, 1561126714, 'pepper13 sold 2 Sparkling Martini - Restores Energy(s) for $5000'),
(94, 1045, 14, 6000, 2, 1561126729, 'pepper13 sold 2 Morphine - Restores Health(s) for $6000'),
(95, 1036, 15, 50, 1, 1561239818, 'Dagger sold 1 Automatic Rifle(s) for $50'),
(96, 1036, 9, 1500, 1, 1561239832, 'Dagger sold 1 Pistol Glock(s) for $1500'),
(97, 158, 15, 50, 1, 1561244318, 'Bigjay sold 1 Automatic Rifle(s) for $50'),
(98, 158, 9, 1500, 1, 1561244333, 'Bigjay sold 1 Pistol Glock(s) for $1500'),
(99, 158, 13, 7500, 1, 1561244357, 'Bigjay sold 1 Stab-Proof Vest(s) for $7500'),
(100, 1047, 42, 50000, 1, 1561325909, 'Herbsmokaz sold 1 Benz S600(s) for $50000'),
(101, 1047, 13, 7500, 1, 1561326052, 'Herbsmokaz sold 1 Stab-Proof Vest(s) for $7500'),
(102, 44, 14, 12000, 4, 1561330593, 'InsanePrince sold 4 Morphine - Restores Health(s) for $12000'),
(103, 44, 88, 25000, 1, 1561330694, 'InsanePrince sold 1 Roman Candle(s) for $25000'),
(104, 1039, 42, 50000, 1, 1561334015, 'BOUNCER sold 1 Benz S600(s) for $50000'),
(105, 1039, 9, 1500, 1, 1561334026, 'BOUNCER sold 1 Pistol Glock(s) for $1500'),
(106, 1039, 13, 7500, 1, 1561334043, 'BOUNCER sold 1 Stab-Proof Vest(s) for $7500'),
(107, 1022, 49, 187500, 1, 1561407472, 'FknInsane sold 1 Knight XV(s) for $187500'),
(108, 156, 42, 50000, 1, 1561459486, 'PrinceReavon sold 1 Benz S600(s) for $50000'),
(109, 156, 9, 1500, 1, 1561459550, 'PrinceReavon sold 1 Pistol Glock(s) for $1500'),
(110, 868, 47, 26250, 1, 1561496332, 'Ravenous sold 1 Gas Mask(s) for $26250'),
(111, 21, 42, 50000, 1, 1561504951, 'Sledog sold 1 Benz S600(s) for $50000'),
(112, 1061, 12, 3000, 1, 1561513862, 'Franck187 sold 1 Shotgun(s) for $3000'),
(113, 1061, 9, 1500, 1, 1561513908, 'Franck187 sold 1 Pistol Glock(s) for $1500'),
(114, 1061, 13, 7500, 1, 1561513933, 'Franck187 sold 1 Stab-Proof Vest(s) for $7500'),
(115, 992, 42, 50000, 1, 1561586173, 'Ogkiller sold 1 Benz S600(s) for $50000'),
(116, 156, 22, 37500, 2, 1561645462, 'PrinceReavon sold 2 Full Body Armor(s) for $37500'),
(117, 156, 13, 7500, 1, 1561645554, 'PrinceReavon sold 1 Stab-Proof Vest(s) for $7500'),
(118, 1022, 19, 37500, 1, 1561670559, 'FknInsane sold 1 Mac-10(s) for $37500'),
(119, 1022, 9, 1500, 1, 1561670566, 'FknInsane sold 1 Pistol Glock(s) for $1500'),
(120, 1022, 52, 90000, 1, 1561670575, 'FknInsane sold 1 Off Duty Dirty Cop(s) for $90000'),
(121, 1022, 47, 26250, 1, 1561670595, 'FknInsane sold 1 Gas Mask(s) for $26250'),
(122, 1022, 54, 450000, 1, 1561803395, 'FknInsane sold 1 Armored Bank Truck(s) for $450000'),
(123, 1022, 21, 450000, 1, 1561803411, 'FknInsane sold 1 TAK-50 McMillan Tactical Rifle(s) for $450000'),
(124, 1022, 23, 478500, 1, 1561803428, 'FknInsane sold 1 Gold 9mm Pistol(s) for $478500'),
(125, 169, 49, 187500, 1, 1561821604, 'Yaotzin sold 1 Knight XV(s) for $187500'),
(126, 169, 88, 25000, 1, 1561821794, 'Yaotzin sold 1 Roman Candle(s) for $25000'),
(127, 169, 23, 478500, 1, 1562022437, 'Yaotzin sold 1 Gold 9mm Pistol(s) for $478500'),
(128, 169, 54, 450000, 1, 1562022455, 'Yaotzin sold 1 Armored Bank Truck(s) for $450000'),
(129, 169, 23, 478500, 1, 1562022469, 'Yaotzin sold 1 Gold 9mm Pistol(s) for $478500'),
(130, 1105, 14, 6000, 2, 1562129980, 'Bigmike209 sold 2 Morphine - Restores Health(s) for $6000'),
(131, 1116, 14, 3000, 1, 1562143704, 'Fedber sold 1 Morphine - Restores Health(s) for $3000'),
(132, 1112, 13, 7500, 1, 1562153106, 'Silver sold 1 Stab-Proof Vest(s) for $7500'),
(133, 1120, 212, 50000, 1, 1562283589, 'LuckyLuciano sold 1 1-Day VIP(s) for $50000'),
(134, 1120, 11, 1500, 1, 1562286395, 'LuckyLuciano sold 1 Machete(s) for $1500'),
(135, 1120, 180, 1000, 1, 1562291213, 'LuckyLuciano sold 1 Prison Keys(s) for $1000');

-- --------------------------------------------------------

--
-- Table structure for table `itemtypes`
--

CREATE TABLE `itemtypes` (
  `itmtypeid` int(11) NOT NULL,
  `itmtypename` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemtypes`
--

INSERT INTO `itemtypes` (`itmtypeid`, `itmtypename`) VALUES
(1, 'Drugs'),
(2, 'Medical'),
(3, 'Vehicle'),
(4, 'Gun'),
(5, 'Armor'),
(6, 'Melee'),
(7, 'Special'),
(999, 'Donation Items'),
(8, 'Potion'),
(9, 'Top Items');

-- --------------------------------------------------------

--
-- Table structure for table `itemxferlogs`
--

CREATE TABLE `itemxferlogs` (
  `ixID` int(11) NOT NULL,
  `ixFROM` int(11) NOT NULL DEFAULT 0,
  `ixTO` int(11) NOT NULL DEFAULT 0,
  `ixITEM` int(11) NOT NULL DEFAULT 0,
  `ixQTY` int(11) NOT NULL DEFAULT 0,
  `ixTIME` int(11) NOT NULL DEFAULT 0,
  `ixFROMIP` varchar(255) NOT NULL DEFAULT '',
  `ixTOIP` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemxferlogs`
--

INSERT INTO `itemxferlogs` (`ixID`, `ixFROM`, `ixTO`, `ixITEM`, `ixQTY`, `ixTIME`, `ixFROMIP`, `ixTOIP`) VALUES
(1, 42, 31, 212, 1, 1560755704, '174.44.19.149', '120.148.77.251'),
(2, 184, 42, 1, 2, 1560769958, '172.58.228.82', '174.44.19.149'),
(3, 184, 42, 215, 25, 1560769977, '172.58.228.82', '174.44.19.149'),
(4, 184, 42, 87, 2, 1560769997, '172.58.228.82', '174.44.19.149'),
(5, 160, 42, 1, 2, 1560774460, '172.58.228.82', '174.44.19.149'),
(6, 160, 42, 87, 4, 1560774477, '172.58.228.82', '174.44.19.149'),
(7, 160, 42, 215, 25, 1560774495, '172.58.228.82', '174.44.19.149'),
(8, 159, 158, 1, 2, 1560787414, '96.238.35.183', '172.58.221.243'),
(9, 159, 158, 9, 1, 1560787428, '96.238.35.183', '172.58.221.243'),
(10, 159, 158, 14, 7, 1560787443, '96.238.35.183', '172.58.221.243'),
(11, 159, 158, 87, 4, 1560787780, '96.238.35.183', '172.58.221.243'),
(12, 159, 158, 215, 25, 1560787794, '96.238.35.183', '172.58.221.243'),
(13, 159, 158, 15, 1, 1560789495, '96.238.35.183', '172.58.221.36'),
(14, 159, 158, 192, 2, 1560800074, '96.238.35.183', '172.58.221.36'),
(15, 184, 28, 187, 1, 1560800706, '172.58.228.82', '73.150.1.42'),
(16, 184, 28, 105, 1, 1560800729, '172.58.228.82', '73.150.1.42'),
(17, 28, 42, 187, 1, 1560800771, '73.150.1.42', '174.44.19.149'),
(18, 28, 42, 105, 1, 1560800865, '73.150.1.42', '174.44.19.149'),
(19, 160, 42, 192, 2, 1560805559, '172.58.228.82', '174.44.19.149'),
(20, 833, 28, 187, 2, 1560807118, '172.58.106.66', '73.150.1.42'),
(21, 833, 28, 14, 2, 1560807230, '172.58.106.66', '73.150.1.42'),
(22, 833, 28, 9, 1, 1560807244, '172.58.106.66', '73.150.1.42'),
(23, 833, 28, 87, 2, 1560807259, '172.58.106.66', '73.150.1.42'),
(24, 42, 31, 215, 20, 1560809611, '174.44.19.149', '49.183.148.161'),
(25, 28, 42, 86, 1, 1560825445, '73.150.1.42', '174.44.19.149'),
(26, 28, 42, 141, 1, 1560825455, '73.150.1.42', '174.44.19.149'),
(27, 28, 858, 215, 20, 1560825523, '73.150.1.42', '74.133.124.203'),
(28, 28, 868, 215, 25, 1560825557, '73.150.1.42', '72.134.156.199'),
(29, 28, 868, 215, 25, 1560825574, '73.150.1.42', '72.134.156.199'),
(30, 28, 42, 141, 250, 1560826407, '73.150.1.42', '174.44.19.149'),
(31, 28, 42, 86, 1000, 1560826427, '73.150.1.42', '174.44.19.149'),
(32, 31, 42, 215, 15, 1560834597, '120.148.77.251', '174.44.19.149'),
(33, 42, 31, 86, 33, 1560835463, '174.44.19.149', '120.148.77.251'),
(34, 867, 861, 14, 7, 1560872556, '69.139.16.182', '109.156.191.217'),
(35, 867, 861, 105, 1, 1560872570, '69.139.16.182', '109.156.191.217'),
(36, 867, 861, 192, 1, 1560872580, '69.139.16.182', '109.156.191.217'),
(37, 867, 861, 87, 4, 1560872590, '69.139.16.182', '109.156.191.217'),
(38, 867, 861, 1, 2, 1560872602, '69.139.16.182', '109.156.191.217'),
(39, 905, 911, 100, 1, 1560908487, '207.224.194.93', '137.25.93.82'),
(40, 28, 50, 184, 1, 1560920946, '73.150.1.42', '107.128.8.150'),
(41, 28, 42, 88, 1, 1560986093, '73.150.1.42', '174.44.19.149'),
(42, 28, 42, 88, 499, 1560986106, '73.150.1.42', '174.44.19.149'),
(43, 28, 42, 141, 500, 1560986138, '73.150.1.42', '174.44.19.149'),
(44, 28, 50, 88, 100, 1560988522, '73.150.1.42', '107.128.8.150'),
(45, 833, 28, 188, 1, 1560992766, '172.58.110.14', '73.150.1.42'),
(46, 28, 50, 1, 232, 1560993420, '73.150.1.42', '107.128.8.150'),
(47, 28, 50, 184, 1, 1560993845, '73.150.1.42', '107.128.8.150'),
(48, 28, 50, 213, 1, 1560994200, '73.150.1.42', '107.128.8.150'),
(49, 28, 50, 88, 99, 1561003483, '73.150.1.42', '107.128.8.150'),
(50, 905, 911, 220, 1, 1561011692, '174.23.155.174', '137.25.93.82'),
(51, 905, 911, 204, 1, 1561015069, '174.23.155.174', '137.25.93.82'),
(52, 861, 1022, 14, 1, 1561017903, '109.156.191.217', '71.231.8.204'),
(53, 861, 7, 14, 1, 1561022788, '109.156.191.217', '99.203.186.236'),
(54, 156, 991, 161, 2, 1561044597, '172.58.185.19', '172.58.78.221'),
(55, 156, 991, 95, 1, 1561044643, '172.58.185.19', '172.58.78.221'),
(56, 991, 156, 215, 25, 1561045282, '172.58.78.221', '172.58.185.19'),
(57, 28, 50, 141, 1, 1561058689, '73.150.1.42', '107.242.117.32'),
(58, 1022, 1029, 204, 1, 1561073785, '71.231.8.204', '172.58.99.225'),
(59, 28, 42, 179, 100, 1561075341, '73.150.1.42', '174.44.19.149'),
(60, 28, 42, 1, 109, 1561075422, '73.150.1.42', '174.44.19.149'),
(61, 28, 50, 141, 27, 1561084124, '73.150.1.42', '107.128.8.150'),
(62, 28, 50, 88, 20, 1561084141, '73.150.1.42', '107.128.8.150'),
(63, 1022, 861, 187, 1, 1561084328, '71.231.8.204', '109.156.191.217'),
(64, 861, 1022, 215, 495, 1561086318, '109.156.191.217', '71.231.8.204'),
(65, 861, 1022, 14, 12, 1561086327, '109.156.191.217', '71.231.8.204'),
(66, 861, 1022, 87, 3, 1561086336, '109.156.191.217', '71.231.8.204'),
(67, 861, 1022, 1, 2, 1561086345, '109.156.191.217', '71.231.8.204'),
(68, 42, 31, 179, 26, 1561091733, '174.44.19.149', '120.148.23.128'),
(69, 42, 31, 141, 10, 1561093174, '174.44.19.149', '120.148.23.128'),
(70, 42, 31, 88, 100, 1561093191, '174.44.19.149', '120.148.23.128'),
(71, 42, 31, 88, 10, 1561094375, '174.44.19.149', '120.148.23.128'),
(72, 28, 50, 213, 1, 1561096551, '73.150.1.42', '107.128.8.150'),
(73, 28, 50, 213, 81, 1561096695, '73.150.1.42', '107.128.8.150'),
(74, 28, 996, 184, 1, 1561098161, '73.150.1.42', '82.41.36.93'),
(75, 28, 996, 184, 1, 1561098170, '73.150.1.42', '82.41.36.93'),
(76, 28, 31, 184, 1, 1561098178, '73.150.1.42', '120.148.23.128'),
(77, 1022, 28, 105, 3, 1561113710, '71.231.8.204', '73.150.1.42'),
(78, 1022, 28, 105, 1, 1561113759, '71.231.8.204', '73.150.1.42'),
(79, 28, 996, 105, 1, 1561114408, '73.150.1.42', '82.41.36.93'),
(80, 28, 996, 184, 1, 1561114484, '73.150.1.42', '82.41.36.93'),
(81, 996, 1045, 15, 1, 1561127415, '82.41.36.93', '172.242.229.23'),
(82, 1022, 28, 105, 4, 1561135157, '174.216.14.217', '73.150.1.42'),
(83, 905, 911, 179, 1, 1561166412, '174.23.129.57', '137.25.93.82'),
(84, 182, 29, 95, 1, 1561185924, '174.224.3.242', '174.224.6.1'),
(85, 911, 905, 179, 1, 1561213549, '137.25.93.82', '174.23.129.57'),
(86, 911, 905, 14, 2, 1561213571, '137.25.93.82', '174.23.129.57'),
(87, 911, 905, 9, 1, 1561213586, '137.25.93.82', '174.23.129.57'),
(88, 911, 905, 105, 1, 1561213599, '137.25.93.82', '174.23.129.57'),
(89, 911, 905, 192, 1, 1561213610, '137.25.93.82', '174.23.129.57'),
(90, 911, 905, 87, 1, 1561213620, '137.25.93.82', '174.23.129.57'),
(91, 996, 1054, 13, 1, 1561229195, '2.98.64.196', '2.98.64.196'),
(92, 182, 29, 193, 1, 1561251852, '174.224.3.242', '174.224.18.253'),
(93, 44, 877, 212, 1, 1561262188, '71.132.172.78', '73.157.30.206'),
(94, 44, 877, 215, 290, 1561262198, '71.132.172.78', '73.157.30.206'),
(95, 1022, 1047, 105, 1, 1561326731, '174.216.13.134', '92.23.228.76'),
(96, 905, 911, 179, 1, 1561347602, '174.23.194.104', '137.25.93.82'),
(97, 905, 911, 105, 1, 1561347739, '174.23.194.104', '137.25.93.82'),
(98, 905, 911, 14, 3, 1561347770, '174.23.194.104', '137.25.93.82'),
(99, 905, 911, 87, 1, 1561347792, '174.23.194.104', '137.25.93.82'),
(100, 905, 911, 215, 10, 1561347815, '174.23.194.104', '137.25.93.82'),
(101, 905, 911, 1, 150, 1561347851, '174.23.194.104', '137.25.93.82'),
(102, 905, 911, 204, 1, 1561348006, '174.23.194.104', '137.25.93.82'),
(103, 182, 29, 14, 2, 1561352163, '174.224.3.242', '174.224.18.253'),
(104, 156, 991, 95, 1, 1561387138, '172.58.190.130', '172.90.133.243'),
(105, 50, 1039, 179, 40, 1561423567, '107.128.8.150', '172.58.23.141'),
(106, 50, 1039, 88, 1, 1561424429, '107.128.8.150', '172.58.23.141'),
(107, 991, 156, 105, 1, 1561558121, '172.90.133.243', '172.58.184.189'),
(108, 991, 156, 1, 50, 1561558162, '172.90.133.243', '172.58.184.189'),
(109, 156, 991, 204, 1, 1561680912, '172.58.229.144', '172.58.23.201'),
(110, 156, 991, 221, 1, 1561680933, '172.58.229.144', '172.58.23.201'),
(111, 1066, 32, 14, 1, 1561694410, '172.58.172.79', '47.9.209.155'),
(112, 1066, 22, 14, 1, 1561734707, '172.56.26.68', '107.77.169.7'),
(113, 1066, 41, 14, 1, 1561734787, '172.56.26.68', '172.58.121.148'),
(114, 1066, 19, 14, 1, 1561735188, '172.56.26.68', '85.92.211.107'),
(115, 1066, 46, 14, 1, 1561735616, '172.56.26.68', '98.150.247.238'),
(116, 1022, 1047, 100, 2, 1561742340, '71.231.8.204', '92.2.241.100'),
(117, 156, 991, 58, 1, 1561825714, '172.58.184.113', '172.58.23.240'),
(118, 156, 991, 27, 1, 1561826280, '172.58.184.113', '172.58.23.240'),
(119, 905, 911, 95, 2, 1561840461, '174.23.148.236', '137.25.93.82'),
(120, 1022, 1047, 100, 5, 1561874509, '71.231.8.204', '148.252.128.31'),
(121, 29, 1104, 13, 1, 1561962469, '174.224.16.98', '99.16.156.219'),
(122, 29, 1104, 9, 1, 1561962507, '174.224.16.98', '99.16.156.219'),
(123, 156, 991, 35, 1, 1562076208, '172.58.185.56', '172.90.133.243'),
(124, 991, 156, 58, 1, 1562076351, '172.90.133.243', '172.58.185.56'),
(125, 156, 991, 68, 1, 1562077024, '172.58.185.56', '172.90.133.243'),
(126, 156, 1104, 180, 1, 1562176575, '172.58.187.91', '99.16.156.219'),
(127, 905, 911, 23, 1, 1562224369, '174.23.160.147', '137.25.93.82'),
(128, 905, 911, 20, 1, 1562224430, '174.23.160.147', '137.25.93.82'),
(129, 905, 911, 51, 1, 1562224494, '174.23.160.147', '137.25.93.82'),
(130, 905, 29, 14, 1, 1562274422, '174.23.160.147', '174.224.25.19'),
(131, 158, 159, 1, 50, 1562300832, '172.58.221.162', '96.238.35.183'),
(132, 158, 159, 184, 1, 1562300857, '172.58.221.162', '96.238.35.183'),
(133, 861, 156, 212, 1, 1562326824, '109.156.191.189', '172.58.184.160');

-- --------------------------------------------------------

--
-- Table structure for table `jobranks`
--

CREATE TABLE `jobranks` (
  `jrID` int(11) NOT NULL,
  `jrNAME` varchar(255) NOT NULL DEFAULT '',
  `jrJOB` int(11) NOT NULL DEFAULT 0,
  `jrPAY` int(11) NOT NULL DEFAULT 0,
  `jrIQG` int(11) NOT NULL DEFAULT 0,
  `jrLABOURG` int(11) NOT NULL DEFAULT 0,
  `jrSTRG` int(11) NOT NULL DEFAULT 0,
  `jrIQN` int(11) NOT NULL DEFAULT 0,
  `jrLABOURN` int(11) NOT NULL DEFAULT 0,
  `jrSTRN` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobranks`
--

INSERT INTO `jobranks` (`jrID`, `jrNAME`, `jrJOB`, `jrPAY`, `jrIQG`, `jrLABOURG`, `jrSTRG`, `jrIQN`, `jrLABOURN`, `jrSTRN`) VALUES
(8, 'Police Officer', 2, 4550, 15, 15, 15, 500, 1250, 2000),
(35, 'k', 21, 10, 10, 1, 1, 1, 1, 1),
(21, 'Rookie', 8, 500000, 1000, 1000, 1000, 10000, 100000, 100000),
(24, 'Mafia Boss', 8, 2500000, 3500, 3500, 3500, 1000000, 1000000, 1000000),
(27, 'kasdk', 15, 40, 0, 4, 40, 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jID` int(11) NOT NULL,
  `jNAME` varchar(255) NOT NULL DEFAULT '',
  `jFIRST` int(11) NOT NULL DEFAULT 0,
  `jDESC` varchar(255) NOT NULL DEFAULT '',
  `jOWNER` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jID`, `jNAME`, `jFIRST`, `jDESC`, `jOWNER`) VALUES
(21, 'ksdkk', 35, 'k', 'k'),
(20, 'k', 33, 'kk', 'kk');

-- --------------------------------------------------------

--
-- Table structure for table `livefeed`
--

CREATE TABLE `livefeed` (
  `evID` int(11) NOT NULL,
  `evUSER` int(11) NOT NULL DEFAULT 0,
  `evTIME` int(11) NOT NULL DEFAULT 0,
  `evREAD` int(11) NOT NULL DEFAULT 0,
  `evTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lostbids`
--

CREATE TABLE `lostbids` (
  `lbID` int(11) NOT NULL,
  `lbUSERNAME` varchar(255) NOT NULL,
  `lbUSERID` int(11) NOT NULL,
  `lbAUCTION` int(11) NOT NULL,
  `lbAMOUNT` bigint(25) NOT NULL,
  `lbITEMID` int(11) NOT NULL,
  `lbITEMNAME` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lostbidss`
--

CREATE TABLE `lostbidss` (
  `lbID` int(11) NOT NULL,
  `lbUSERNAME` varchar(255) NOT NULL,
  `lbUSERID` int(11) NOT NULL,
  `lbAUCTION` int(11) NOT NULL,
  `lbAMOUNT` bigint(25) NOT NULL,
  `lbITEMID` int(11) NOT NULL,
  `lbITEMNAME` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `mail_id` int(11) NOT NULL,
  `mail_read` int(11) NOT NULL DEFAULT 0,
  `mail_from` int(11) NOT NULL DEFAULT 0,
  `mail_to` int(11) NOT NULL DEFAULT 0,
  `mail_time` int(11) NOT NULL DEFAULT 0,
  `mail_text` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`mail_id`, `mail_read`, `mail_from`, `mail_to`, `mail_time`, `mail_text`) VALUES
(5, 1, 1, 2, 1609477930, 'asdada'),
(6, 1, 1, 2, 1609689171, 'h\\\'i i am \\\"\\\"asda\\\"'),
(7, 1, 1, 2, 1609689322, 'a'),
(10, 1, 1, 2, 1609698403, 'hi man how are you?\\r\\n\\r\\nadasdasd asdkaskdsa\\r\\n\\r\\nasdsad'),
(9, 1, 1, 2, 1609695953, 'asda'),
(11, 1, 1, 2, 1609698457, 'hi man hw are u\\r\\nasda\\r\\nfff\\r\\nff\\r\\ng\\r\\ng\\r\\nh');

-- --------------------------------------------------------

--
-- Table structure for table `mod_roulette`
--

CREATE TABLE `mod_roulette` (
  `User` int(10) UNSIGNED NOT NULL,
  `Tokens` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_slots`
--

CREATE TABLE `mod_slots` (
  `User` int(10) UNSIGNED NOT NULL,
  `Tokens` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mod_slotsc`
--

CREATE TABLE `mod_slotsc` (
  `User` int(10) UNSIGNED NOT NULL,
  `Tokens` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `moneylotto`
--

CREATE TABLE `moneylotto` (
  `ticketid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `moneylottowinners`
--

CREATE TABLE `moneylottowinners` (
  `id` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `moneylottowinners`
--

INSERT INTO `moneylottowinners` (`id`, `winner`, `amount`) VALUES
(1, 868, 15600000),
(2, 1039, 2200000),
(3, 905, 2400000),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0),
(13, 0, 0),
(14, 0, 0),
(15, 0, 0),
(16, 0, 0),
(17, 0, 0),
(18, 0, 0),
(19, 0, 0),
(20, 0, 0),
(21, 0, 0),
(22, 0, 0),
(23, 0, 0),
(24, 0, 0),
(25, 0, 0),
(26, 0, 0),
(27, 0, 0),
(28, 0, 0),
(29, 0, 0),
(30, 0, 0),
(31, 0, 0),
(32, 0, 0),
(33, 0, 0),
(34, 0, 0),
(35, 0, 0),
(36, 0, 0),
(37, 0, 0),
(38, 0, 0),
(39, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mugger_oth`
--

CREATE TABLE `mugger_oth` (
  `uid` int(11) NOT NULL,
  `total_mugged` int(11) NOT NULL DEFAULT 0,
  `date_start` datetime NOT NULL,
  `total_mugs` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mugger_oth_global`
--

CREATE TABLE `mugger_oth_global` (
  `entry_type` enum('top_ever','top_hour','top_24') NOT NULL DEFAULT 'top_24',
  `uid` int(11) NOT NULL,
  `total_mugs` int(11) NOT NULL,
  `total_mugged` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `multis_detected`
--

CREATE TABLE `multis_detected` (
  `userid` int(11) NOT NULL,
  `ip_detected` bigint(40) NOT NULL,
  `time` bigint(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oclogs`
--

CREATE TABLE `oclogs` (
  `oclID` int(11) NOT NULL,
  `oclOC` int(11) NOT NULL DEFAULT 0,
  `oclGANG` int(11) NOT NULL DEFAULT 0,
  `oclLOG` text NOT NULL,
  `oclRESULT` enum('success','failure') NOT NULL DEFAULT 'success',
  `oclMONEY` int(11) NOT NULL DEFAULT 0,
  `ocCRIMEN` varchar(255) NOT NULL DEFAULT '',
  `ocTIME` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oclogs`
--

INSERT INTO `oclogs` (`oclID`, `oclOC`, `oclGANG`, `oclLOG`, `oclRESULT`, `oclMONEY`, `ocCRIMEN`, `ocTIME`) VALUES
(1, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 7321, 'Rob Supermarket', 1560751202),
(2, 1, 10, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 6101, 'Rob Supermarket', 1560902414),
(3, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 2712, 'Rob Supermarket', 1560988814),
(4, 2, 10, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 100344, 'Rob a low security Bank', 1560988814),
(5, 2, 10, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 168781, 'Rob a low security Bank', 1561089602),
(6, 1, 1, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561150802),
(7, 1, 12, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561158004),
(8, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 6846, 'Rob Supermarket', 1561172402),
(9, 1, 12, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 7894, 'Rob Supermarket', 1561244403),
(10, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561266002),
(11, 2, 10, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 116746, 'Rob a low security Bank', 1561323602),
(12, 1, 1, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 2688, 'Rob Supermarket', 1561327202),
(13, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 3349, 'Rob Supermarket', 1561356003),
(14, 1, 1, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 4649, 'Rob Supermarket', 1561417205),
(15, 2, 12, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 137375, 'Rob a low security Bank', 1561442404),
(16, 1, 12, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561633203),
(17, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561687202),
(18, 1, 12, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561759204),
(19, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561852805),
(20, 1, 12, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 1659, 'Rob Supermarket', 1561885204),
(21, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 'failure', 0, 'Rob Supermarket', 1561942804),
(22, 1, 9, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'success', 3587, 'Rob Supermarket', 1562032804),
(23, 2, 10, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Before you could even warn your members the security guard saw you coming. On of your members was wounded and the bank manager shouted he has triggered the alarm and the cops where on there way. You run from the bank unsuccessful. Better luck next time! ', 'failure', 0, 'Rob a low security Bank', 1562090402),
(24, 2, 9, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 76714, 'Rob a low security Bank', 1562119203),
(25, 2, 9, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Before you could even warn your members the security guard saw you coming. On of your members was wounded and the bank manager shouted he has triggered the alarm and the cops where on there way. You run from the bank unsuccessful. Better luck next time! ', 'failure', 0, 'Rob a low security Bank', 1562205604),
(26, 2, 9, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'success', 132085, 'Rob a low security Bank', 1562342403),
(27, 2, 9, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.Before you could even warn your members the security guard saw you coming. On of your members was wounded and the bank manager shouted he has triggered the alarm and the cops where on there way. You run from the bank unsuccessful. Better luck next time! ', 'failure', 0, 'Rob a low security Bank', 1562432403);

-- --------------------------------------------------------

--
-- Table structure for table `orgcrimes`
--

CREATE TABLE `orgcrimes` (
  `ocID` int(11) NOT NULL,
  `ocNAME` varchar(255) NOT NULL DEFAULT '',
  `ocUSERS` int(11) NOT NULL DEFAULT 0,
  `ocSTARTTEXT` text NOT NULL,
  `ocSUCCTEXT` text NOT NULL,
  `ocFAILTEXT` text NOT NULL,
  `ocMINMONEY` int(11) NOT NULL DEFAULT 0,
  `ocMAXMONEY` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orgcrimes`
--

INSERT INTO `orgcrimes` (`ocID`, `ocNAME`, `ocUSERS`, `ocSTARTTEXT`, `ocSUCCTEXT`, `ocFAILTEXT`, `ocMINMONEY`, `ocMAXMONEY`) VALUES
(1, 'Rob Supermarket', 2, 'Two of your gang members plan to rob a supermarket in the area, they prepare to go in the supermarket.', 'While one of the gang member pulls out a gun from behind and points it to the cashier, the others outside on a lookout. The cashier gets scared and empties the till.', 'Both gang members point an unloaded gun at the cashier. The cashier pulls out a shotgun and the gang members run for their lives!', 1000, 10000),
(2, 'Rob a low security Bank', 5, 'Five of your gang members plan to rob a low security Bank in the area, they prepare to head towards the Bank.', 'Your Gang stormed the bank, over powered the fat lazy security guard with easy and cleared out the banks vault. Lucky the bank vault was open at the time!', 'Before you could even warn your members the security guard saw you coming. On of your members was wounded and the bank manager shouted he has triggered the alarm and the cops where on there way. You run from the bank unsuccessful. Better luck next time! ', 50000, 200000);

-- --------------------------------------------------------

--
-- Table structure for table `papercontent`
--

CREATE TABLE `papercontent` (
  `content` longtext NOT NULL,
  `dfgdfg` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `papercontent`
--

INSERT INTO `papercontent` (`content`, `dfgdfg`) VALUES
('<font color=\"gray\">\r\nTip: Inactive accounts are removed every 30 days. To avoid this, please login at least once every 30 days.</font>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '0',
  `question` varchar(255) NOT NULL DEFAULT '',
  `choice1` varchar(255) NOT NULL DEFAULT '',
  `choice2` varchar(255) NOT NULL DEFAULT '',
  `choice3` varchar(255) NOT NULL DEFAULT '',
  `choice4` varchar(255) NOT NULL DEFAULT '',
  `choice5` varchar(255) NOT NULL DEFAULT '',
  `choice6` varchar(255) NOT NULL DEFAULT '',
  `choice7` varchar(255) NOT NULL DEFAULT '',
  `choice8` varchar(255) NOT NULL DEFAULT '',
  `choice9` varchar(255) NOT NULL DEFAULT '',
  `choice10` varchar(255) NOT NULL DEFAULT '',
  `voted1` int(11) NOT NULL DEFAULT 0,
  `voted2` int(11) NOT NULL DEFAULT 0,
  `voted3` int(11) NOT NULL DEFAULT 0,
  `voted4` int(11) NOT NULL DEFAULT 0,
  `voted5` int(11) NOT NULL DEFAULT 0,
  `voted6` int(11) NOT NULL DEFAULT 0,
  `voted7` int(11) NOT NULL DEFAULT 0,
  `voted8` int(11) NOT NULL DEFAULT 0,
  `voted9` int(11) NOT NULL DEFAULT 0,
  `voted10` int(11) NOT NULL DEFAULT 0,
  `votes` int(11) NOT NULL DEFAULT 0,
  `winner` int(11) NOT NULL DEFAULT 0,
  `hidden` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`id`, `active`, `question`, `choice1`, `choice2`, `choice3`, `choice4`, `choice5`, `choice6`, `choice7`, `choice8`, `choice9`, `choice10`, `voted1`, `voted2`, `voted3`, `voted4`, `voted5`, `voted6`, `voted7`, `voted8`, `voted9`, `voted10`, `votes`, `winner`, `hidden`) VALUES
(1, '0', 'sdf', 'hh', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 'h', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, '1', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, '1', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, '1', 'test', 'test', 'test', 'tes', '', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `preports`
--

CREATE TABLE `preports` (
  `prID` int(11) NOT NULL,
  `prREPORTER` int(11) NOT NULL DEFAULT 0,
  `prREPORTED` int(11) NOT NULL DEFAULT 0,
  `prTEXT` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `profilecomments`
--

CREATE TABLE `profilecomments` (
  `id` int(11) NOT NULL,
  `posteruserid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `profileuserid` int(11) NOT NULL,
  `postername` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilecomments`
--

INSERT INTO `profilecomments` (`id`, `posteruserid`, `time`, `comment`, `profileuserid`, `postername`) VALUES
(1, 3, 1608166918, 'Ajajja', 1, 'ibrahim619'),
(2, 3, 1609032008, 'hi', 1, 'demo'),
(3, 2, 1609648389, 'hi', 5, 'ibrahim61');

-- --------------------------------------------------------

--
-- Table structure for table `profilesignatures`
--

CREATE TABLE `profilesignatures` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `signature` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profilesignatures`
--

INSERT INTO `profilesignatures` (`id`, `userid`, `signature`) VALUES
(9, 1264, '[url=Url Here]Link NAME[/url] [i]TEXT HERE[/i]'),
(10, 2, '.'),
(11, 3, '[url=Url Here]Link NAME[/url] &nbrlb;[img]https://images.theconversation.com/files/312156/original/file-20200127-81411-4omix7.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=1200&h=900.0&fit=crop[/img]'),
(12, 1, 'hi\r\n\r\n [color=red]TEXT HERE[/color]\r\n\r\nssds');

-- --------------------------------------------------------

--
-- Table structure for table `proposals`
--

CREATE TABLE `proposals` (
  `id` int(11) NOT NULL,
  `proposer` int(11) NOT NULL DEFAULT 0,
  `proposed` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `proposals`
--

INSERT INTO `proposals` (`id`, `proposer`, `proposed`) VALUES
(2, 50, 158),
(3, 158, 50);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rateID` int(11) NOT NULL,
  `rateD` int(11) NOT NULL DEFAULT 0,
  `rateR` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `Rec_ID` tinyint(1) UNSIGNED NOT NULL,
  `Rec_15m` int(7) UNSIGNED NOT NULL DEFAULT 0,
  `Rec_30m` int(7) UNSIGNED NOT NULL DEFAULT 0,
  `Rec_1h` int(7) UNSIGNED NOT NULL DEFAULT 0,
  `Rec_24h` int(7) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`Rec_ID`, `Rec_15m`, `Rec_30m`, `Rec_1h`, `Rec_24h`) VALUES
(1, 33, 39, 52, 117);

-- --------------------------------------------------------

--
-- Table structure for table `r_items`
--

CREATE TABLE `r_items` (
  `id` mediumint(8) NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_quant` int(11) NOT NULL,
  `credits` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cat` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `r_items`
--

INSERT INTO `r_items` (`id`, `item_id`, `item_quant`, `credits`, `quantity`, `cat`) VALUES
(1, 192, 1, 5, -1, 1),
(2, 105, 1, 5, -1, 1),
(3, 193, 1, 15, -1, 1),
(4, 194, 1, 37, -1, 1),
(5, 196, 1, 74, -1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `conf_id` int(11) NOT NULL,
  `conf_name` varchar(255) NOT NULL DEFAULT '',
  `conf_value` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`conf_id`, `conf_name`, `conf_value`) VALUES
(1, 'validate_period', '60'),
(2, 'validate_on', '1'),
(3, 'regcap_on', '1'),
(6, 'sendcrys_on', '1'),
(7, 'sendbank_on', '1'),
(10, 'ct_moneypercrys', '10'),
(11, 'staff_pad', '*Item useage log - Show top item and drop down search option to pick item and see data (how many users own it, equipped it, total sell val x qty owned)\r\n*See most owned item in inventory\r\n\r\nheist create/edit/delete/logs\r\nsmuggle system \r\n\r\nbank withdrawl logs/deposit\r\n\r\nstaff reward system with staff panel\r\nmarried couples (delete/married bonuses)\r\nreferrals (bonuses)\r\ndonator packs\r\nplayer shops and items\r\nvoting system logs\r\ngame stats (heist, drug smuggle, bounty, auction, business rank, jobranks)\r\n\r\nchallenge bot scripting to be added to all attack pages\r\nIntergrate ban die msgs in game for forums, fedjail, mail and chat.\r\nadd edit del item group and crime group\r\ncreate drug smuggle function\r\nheist function\r\nbounty function\r\nauction,\r\nbusiness func\r\njob rank\r\nadd/edit/del item group\r\nfunction add images for houses, city, items, dp for users\r\n\r\n*Make sure global for staff has multi login check and to kick 1 login out - check\r\n*Make sure all staff action work - check\r\n\r\nSmuggle Logs/User Smuggle Logs [staff] - DONE\r\nMail/Events with search ID [staff] - DONE\r\nRegisteration Logs [staff] - DONE\r\nBan system recoded [staff] - DONE\r\nChallenge beaten logs [staff]- DONE\r\nView user account [staff] - DONE\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nCheck login/signup to secure all post/get and validate everything.\r\nCreate a log system for failed logins or password recover requests\r\ncreate staff system to add mailbans and ip bans\r\ncreate session login time, duration and logout time and system or ip\r\ncreate a tracking system to monitor user interaction\r\nsecue globals and global func'),
(13, 'game_name', 'Top Mafia'),
(15, 'paypal', ''),
(17, 'percent_off_sale', ''),
(18, 'sale_off_dates', 'a:1:{i:0;s:0:\"\";}'),
(19, 'sale_text', 'Massive 40% Independence day sale!');

-- --------------------------------------------------------

--
-- Table structure for table `shopitems`
--

CREATE TABLE `shopitems` (
  `sitemID` int(11) NOT NULL,
  `sitemSHOP` int(11) NOT NULL DEFAULT 0,
  `sitemITEMID` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopitems`
--

INSERT INTO `shopitems` (`sitemID`, `sitemSHOP`, `sitemITEMID`) VALUES
(51, 15, 55),
(50, 15, 25),
(86, 24, 69),
(53, 15, 29),
(65, 15, 58),
(66, 15, 59),
(67, 24, 33),
(68, 24, 34),
(69, 24, 60),
(70, 24, 25),
(87, 24, 70),
(88, 24, 75),
(104, 28, 138),
(105, 28, 139),
(108, 29, 141),
(110, 29, 143),
(117, 31, 167),
(118, 32, 168),
(119, 32, 165),
(120, 32, 163),
(121, 32, 169);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shopID` int(11) NOT NULL,
  `shopLOCATION` int(11) NOT NULL DEFAULT 0,
  `shopNAME` varchar(255) NOT NULL DEFAULT '',
  `shopDESCRIPTION` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shopID`, `shopLOCATION`, `shopNAME`, `shopDESCRIPTION`) VALUES
(3, 1, 'Pharmacist', 'Medical products'),
(15, 4, 'West-Side Arms Dealer', 'Californias Best'),
(16, 2, 'NYC Pharmacist', 'Medical products'),
(45, 1, 'sadasda', 'asd'),
(19, 5, 'London Pharmacist', 'Medical products'),
(20, 6, 'Russian Pharmacist', 'Medical products'),
(21, 7, 'Rome Pharmacist', 'Medical products'),
(24, 6, 'Russian Underworld', 'KGB Supplies'),
(28, 10, 'Yamaguchi Tattoo', 'Ink your skin in Yazuka style! (Speical Item/s)'),
(29, 10, 'Yoshi-kai Herbalist', 'Medical Supplies and Special teas'),
(31, 1, 'Vozdovac Meds', 'Medical suppies '),
(32, 1, 'New Belgrade Arms', 'Black market military grade weapons');

-- --------------------------------------------------------

--
-- Table structure for table `shout_box`
--

CREATE TABLE `shout_box` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` text NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `smuggle`
--

CREATE TABLE `smuggle` (
  `id` int(11) NOT NULL,
  `useridd` int(11) NOT NULL DEFAULT 0,
  `drug` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(255) NOT NULL DEFAULT '',
  `skill` int(11) NOT NULL DEFAULT 0,
  `ends` varchar(255) NOT NULL DEFAULT '0',
  `finished` int(11) NOT NULL DEFAULT 0,
  `reward` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `smuggle`
--

INSERT INTO `smuggle` (`id`, `useridd`, `drug`, `city`, `skill`, `ends`, `finished`, `reward`) VALUES
(1, 28, 'Weed', 'Miami', 4, '1560769273', 1, 16617),
(2, 42, 'LSD', 'Miami', 7, '1561007151', 1, 80862),
(3, 28, 'Weed', 'Miami', 4, '1560775391', 1, 5408),
(4, 44, 'LSD', 'Miami', 7, '1561013902', 0, 85335),
(5, 169, 'Weed', 'Miami', 4, '1560777540', 1, 19857),
(6, 38, 'Heroin', 'Miami', 7, '1560937824', 1, 725758),
(7, 911, 'Mushrooms', 'Miami', 7, '1560854565', 1, 26818),
(8, 169, 'Cocaine', 'Miami', 6, '1560831507', 1, 39087),
(9, 50, 'Heroin', 'Miami', 7, '1560970058', 1, 771172),
(10, 31, 'Weed', 'Miami', 4, '1560831347', 1, 8197),
(11, 28, 'Weed', 'Miami', 4, '1560831403', 1, 17208),
(12, 48, 'Weed', 'Miami', 4, '1560842600', 1, 18056),
(13, 868, 'Weed', 'Miami', 4, '1560844536', 1, 9214),
(14, 992, 'Heroin', 'Miami', 7, '1560998797', 1, 422376),
(15, 182, 'LSD', 'Miami', 7, '1561096460', 1, 82624),
(16, 31, 'Weed', 'Miami', 4, '1560860229', 1, 15758),
(17, 169, 'Mushrooms', 'Miami', 7, '1560925206', 1, 29921),
(18, 170, 'Weed', 'Miami', 4, '1560875586', 1, 16901),
(19, 919, 'LSD', 'Miami', 7, '1561113682', 0, 92665),
(20, 48, 'Heroin', 'Miami', 7, '1561032775', 1, 421134),
(21, 875, 'Cocaine', 'Miami', 6, '1560904307', 0, 24178),
(22, 37, 'Mushrooms', 'Miami', 7, '1560947896', 1, 58094),
(23, 31, 'Weed', 'Miami', 4, '1560883255', 1, 7283),
(24, 998, 'Cocaine', 'Miami', 6, '1560912893', 0, 32169),
(25, 156, 'Cocaine', 'Miami', 6, '1560912968', 1, 11462),
(26, 170, 'Cocaine', 'Miami', 6, '1560922157', 1, 29003),
(27, 960, 'Weed', 'Miami', 4, '1560901442', 0, 6676),
(28, 996, 'Cocaine', 'Miami', 6, '1560937944', 1, 30608),
(29, 909, 'Mushrooms', 'Miami', 7, '1560993072', 0, 38972),
(30, 877, 'LSD', 'New York', 7, '1561166569', 1, 80728),
(31, 905, 'Cocaine', 'Miami', 6, '1560954125', 1, 16876),
(32, 31, 'Heroin', 'Miami', 7, '1561084429', 1, 612994),
(33, 169, 'Heroin', 'Miami', 7, '1561102169', 1, 56519),
(34, 21, 'Heroin', 'Miami', 7, '1561106196', 1, 109346),
(35, 156, 'Cocaine', 'Miami', 6, '1560984912', 1, 19186),
(36, 170, 'Weed', 'Miami', 4, '1560965511', 1, 8254),
(37, 37, 'LSD', 'Miami', 7, '1561209817', 1, 102412),
(38, 38, 'Heroin', 'Miami', 7, '1561127516', 1, 76956),
(39, 170, 'Mushrooms', 'Miami', 7, '1561055107', 0, 19058),
(40, 861, 'LSD', 'Miami', 7, '1561237393', 0, 64907),
(41, 858, 'Mushrooms', 'Miami', 7, '1561072170', 1, 34873),
(42, 1033, 'Weed', 'Miami', 4, '1561012486', 0, 6269),
(43, 1035, 'LSD', 'Miami', 7, '1561252464', 1, 71409),
(44, 868, 'LSD', 'Miami', 7, '1561252826', 1, 80803),
(45, 996, 'Heroin', 'Miami', 7, '1561169573', 1, 79702),
(46, 1037, 'LSD', 'Miami', 7, '1561267337', 1, 148515),
(47, 42, 'Weed', 'Miami', 4, '1561031686', 1, 8495),
(48, 1039, 'LSD', 'Miami', 7, '1561280408', 1, 114093),
(49, 156, 'Cocaine', 'Miami', 6, '1561074857', 1, 17470),
(50, 42, 'Cocaine', 'Miami', 6, '1561091607', 1, 29237),
(51, 1027, 'Weed', 'Miami', 4, '1561098940', 1, 6540),
(52, 31, 'Heroin', 'New York', 7, '1561258830', 1, 77328),
(53, 29, 'LSD', 'Miami', 7, '1561349566', 1, 68696),
(54, 992, 'LSD', 'Miami', 7, '1561353820', 1, 120352),
(55, 905, 'LSD', 'Miami', 7, '1561355746', 1, 106749),
(56, 42, 'Heroin', 'Miami', 7, '1561271005', 1, 95340),
(57, 1022, 'Cocaine', 'Miami', 6, '1561145197', 1, 8688),
(58, 156, 'Cocaine', 'Miami', 6, '1561160159', 1, 20620),
(59, 958, 'LSD', 'Miami', 7, '1561379652', 1, 69393),
(60, 1046, 'Weed', 'Miami', 4, '1561145146', 0, 2448),
(61, 1045, 'Cocaine', 'Miami', 6, '1561168781', 1, 14934),
(62, 21, 'LSD', 'Miami', 7, '1561388804', 1, 149641),
(63, 169, 'LSD', 'Miami', 7, '1561388837', 1, 72278),
(64, 1047, 'Weed', 'Miami', 4, '1561152004', 1, 8271),
(65, 38, 'LSD', 'Miami', 7, '1561390265', 1, 123432),
(66, 1027, 'Weed', 'Miami', 4, '1561170168', 1, 6061),
(67, 9, 'Weed', 'Miami', 4, '1561186444', 1, 7704),
(68, 858, 'Mushrooms', 'Miami', 7, '1561268024', 1, 13015),
(69, 182, 'LSD', 'Miami', 7, '1561443967', 1, 163429),
(70, 156, 'Cocaine', 'Miami', 6, '1561244256', 1, 19728),
(71, 996, 'LSD', 'New York', 7, '1561467378', 0, 97771),
(72, 9, 'LSD', 'Miami', 7, '1561481825', 0, 79629),
(73, 1027, 'LSD', 'Miami', 7, '1561484740', 1, 69560),
(74, 48, 'Heroin', 'Miami', 7, '1561412579', 1, 75354),
(75, 156, 'Cocaine', 'Miami', 6, '1561290298', 1, 16531),
(76, 158, 'Weed', 'Miami', 4, '1561273268', 1, 8110),
(77, 991, 'Heroin', 'New York', 7, '1561444701', 1, 29074),
(78, 1047, 'Weed', 'Miami', 4, '1561302524', 1, 6125),
(79, 156, 'Cocaine', 'Miami', 6, '1561342241', 1, 13293),
(80, 1047, 'LSD', 'Miami', 7, '1561572347', 1, 129750),
(81, 1037, 'LSD', 'Miami', 7, '1561573781', 1, 125454),
(82, 42, 'LSD', 'New York', 7, '1561574339', 1, 173541),
(83, 184, 'Heroin', 'Miami', 7, '1561491481', 0, 98584),
(84, 160, 'LSD', 'Miami', 7, '1561578102', 0, 85905),
(85, 1039, 'LSD', 'Miami', 7, '1561584302', 1, 99001),
(86, 28, 'LSD', 'Miami', 7, '1561586819', 0, 151859),
(87, 1035, 'LSD', 'New York', 7, '1561594589', 0, 149543),
(88, 911, 'Cocaine', 'Miami', 6, '1561385007', 1, 28409),
(89, 37, 'Cocaine', 'New York', 6, '1561403360', 1, 23397),
(90, 992, 'LSD', 'Miami', 7, '1561621309', 1, 111623),
(91, 156, 'Cocaine', 'Miami', 6, '1561421914', 1, 7908),
(92, 877, 'LSD', 'Boston', 7, '1561657225', 0, 119299),
(93, 868, 'LSD', 'Miami', 7, '1561661914', 1, 162252),
(94, 1022, 'Heroin', 'Boston', 7, '1561582822', 1, 87836),
(95, 21, 'LSD', 'Miami', 7, '1561676991', 1, 101446),
(96, 156, 'Cocaine', 'New York', 6, '1561474069', 1, 12020),
(97, 1061, 'Cocaine', 'Miami', 6, '1561483986', 1, 27906),
(98, 169, 'LSD', 'Miami', 7, '1561703789', 1, 108891),
(99, 905, 'LSD', 'New York', 7, '1561726449', 1, 114491),
(100, 179, 'LSD', 'Miami', 7, '1561739727', 0, 93974),
(101, 29, 'LSD', 'New York', 7, '1561741027', 1, 144776),
(102, 1027, 'Weed', 'New York', 4, '1561509651', 1, 9862),
(103, 911, 'Weed', 'Miami', 4, '1561534474', 1, 3165),
(104, 1061, 'LSD', 'Miami', 7, '1561772534', 1, 156537),
(105, 156, 'Cocaine', 'Miami', 6, '1561595723', 1, 16952),
(106, 958, 'Weed', 'Miami', 4, '1561576593', 1, 7352),
(107, 1027, 'LSD', 'Miami', 7, '1561849399', 1, 102080),
(108, 911, 'Cocaine', 'Miami', 6, '1561637771', 1, 17924),
(109, 48, 'LSD', 'New York', 7, '1561858158', 1, 145420),
(110, 31, 'Heroin', 'New York', 7, '1561776332', 1, 100828),
(111, 182, 'LSD', 'New York', 7, '1561866689', 1, 100795),
(112, 1039, 'LSD', 'New York', 7, '1561885557', 1, 89798),
(113, 1068, 'Weed', 'Miami', 4, '1561651057', 0, 8334),
(114, 156, 'Cocaine', 'New York', 6, '1561677973', 1, 27303),
(115, 958, 'Cocaine', 'Miami', 6, '1561682544', 1, 8660),
(116, 37, 'Cocaine', 'Miami', 6, '1561688935', 1, 17932),
(117, 42, 'LSD', 'Miami', 7, '1561909523', 0, 112426),
(118, 911, 'Mushrooms', 'Miami', 7, '1561740730', 1, 24055),
(119, 1047, 'LSD', 'New York', 7, '1561918704', 1, 76802),
(120, 868, 'LSD', 'New York', 7, '1561924524', 1, 82583),
(121, 1066, 'Heroin', 'Miami', 7, '1561845061', 0, 87844),
(122, 156, 'Heroin', 'Miami', 7, '1561851491', 1, 53189),
(123, 21, 'Heroin', 'New York', 7, '1561853485', 1, 98198),
(124, 50, 'Heroin', 'New York', 7, '1561859840', 0, 92489),
(125, 1022, 'Weed', 'Boston', 4, '1561716816', 1, 8168),
(126, 858, 'Weed', 'Miami', 4, '1561718304', 0, 2044),
(127, 991, 'Heroin', 'Miami', 7, '1561870180', 1, 30472),
(128, 1020, 'Weed', 'Miami', 4, '1561729440', 0, 6978),
(129, 38, 'Heroin', 'Miami', 7, '1561899278', 1, 115617),
(130, 992, 'Heroin', 'New York', 7, '1561906522', 1, 49258),
(131, 1022, 'LSD', 'Boston', 7, '1562017035', 0, 135444),
(132, 911, 'Heroin', 'Miami', 7, '1561931351', 1, 41423),
(133, 1002, 'Weed', 'Miami', 4, '1561788191', 0, 4903),
(134, 905, 'Heroin', 'New York', 7, '1561947614', 1, 95716),
(135, 1058, 'Weed', 'Miami', 4, '1561803446', 1, 2752),
(136, 169, 'LSD', 'Miami', 7, '1562054332', 1, 140076),
(137, 958, 'Heroin', 'Miami', 7, '1561984992', 1, 80063),
(138, 29, 'Heroin', 'New York', 7, '1561994331', 1, 33457),
(139, 1027, 'LSD', 'Miami', 7, '1562110576', 1, 124225),
(140, 1061, 'LSD', 'Miami', 7, '1562115434', 1, 152760),
(141, 1086, 'Weed', 'Miami', 4, '1561883848', 1, 6102),
(142, 1088, 'Weed', 'Miami', 4, '1561888732', 1, 7156),
(143, 182, 'LSD', 'New York', 7, '1562126880', 1, 69593),
(144, 1096, 'Weed', 'Miami', 4, '1561891997', 1, 3849),
(145, 21, 'Heroin', 'Miami', 7, '1562049453', 1, 40665),
(146, 1039, 'Heroin', 'New York', 7, '1562061478', 1, 83501),
(147, 1086, 'Weed', 'Miami', 4, '1561920618', 1, 8764),
(148, 156, 'Cocaine', 'California', 6, '1561944384', 1, 13883),
(149, 982, 'Weed', 'Miami', 4, '1561927985', 1, 3987),
(150, 1037, 'LSD', 'Miami', 7, '1562174414', 0, 114635),
(151, 38, 'LSD', 'Miami', 7, '1562188062', 1, 91478),
(152, 1058, 'Cocaine', 'Miami', 6, '1561977613', 1, 20947),
(153, 991, 'Heroin', 'Miami', 7, '1562114876', 1, 34545),
(154, 156, 'Heroin', 'California', 7, '1562120705', 1, 74678),
(155, 905, 'LSD', 'New York', 7, '1562208634', 1, 159312),
(156, 31, 'Heroin', 'Miami', 7, '1562128862', 0, 110873),
(157, 37, 'LSD', 'New York', 7, '1562234569', 0, 152051),
(158, 1105, 'Weed', 'Miami', 4, '1561997308', 1, 6675),
(159, 1106, 'Cocaine', 'Miami', 6, '1562025152', 0, 15264),
(160, 889, 'LSD', 'Miami', 7, '1562254915', 1, 116899),
(161, 1105, 'Weed', 'Miami', 4, '1562032266', 1, 5888),
(162, 29, 'LSD', 'Miami', 7, '1562275744', 1, 119442),
(163, 1047, 'Weed', 'Miami', 4, '1562040223', 1, 7382),
(164, 868, 'LSD', 'Miami', 7, '1562283028', 0, 172960),
(165, 1105, 'LSD', 'Miami', 7, '1562302604', 0, 92393),
(166, 1112, 'Weed', 'Miami', 4, '1562080915', 1, 3118),
(167, 982, 'Weed', 'New York', 4, '1562090033', 0, 2983),
(168, 48, 'LSD', 'Boston', 7, '1562333328', 0, 150538),
(169, 1112, 'Mushrooms', 'Miami', 7, '1562168252', 1, 44849),
(170, 1047, 'Weed', 'Miami', 4, '1562122190', 0, 5183),
(171, 1039, 'LSD', 'Boston', 7, '1562375346', 0, 88766),
(172, 958, 'LSD', 'New York', 7, '1562379806', 1, 74495),
(173, 169, 'LSD', 'California', 7, '1562396124', 0, 129913),
(174, 156, 'Heroin', 'London', 7, '1562326545', 1, 102063),
(175, 1117, 'Weed', 'Miami', 4, '1562187560', 0, 6222),
(176, 1112, 'Cocaine', 'New York', 6, '1562215334', 0, 17572),
(177, 21, 'Heroin', 'Miami', 7, '1562345720', 0, 117518),
(178, 1045, 'LSD', 'Miami', 7, '1562433224', 0, 158946),
(179, 992, 'LSD', 'Miami', 7, '1562435329', 0, 132245),
(180, 1061, 'Heroin', 'Miami', 7, '1562368044', 0, 110161),
(181, 1058, 'Weed', 'Miami', 4, '1562227413', 1, 5340),
(182, 991, 'Heroin', 'Boston', 7, '1562385997', 0, 75377),
(183, 905, 'Weed', 'Boston', 4, '1562243542', 1, 5584),
(184, 911, 'Weed', 'Miami', 4, '1562248297', 1, 3185),
(185, 1118, 'Cocaine', 'Miami', 6, '1562272001', 0, 11934),
(186, 1096, 'Cocaine', 'Miami', 6, '1562284126', 0, 10655),
(187, 1119, 'Cocaine', 'Miami', 6, '1562291772', 0, 13220),
(188, 911, 'Heroin', 'New York', 7, '1562447037', 0, 99133),
(189, 1088, 'Weed', 'Miami', 4, '1562299496', 0, 8738),
(190, 29, 'Weed', 'Boston', 4, '1562300655', 1, 6070),
(191, 1058, 'Weed', 'Miami', 4, '1562303265', 0, 4948),
(192, 905, 'LSD', 'Boston', 7, '1562540898', 0, 62676),
(193, 1120, 'Weed', 'Miami', 4, '1562305685', 0, 2386),
(194, 1122, 'Weed', 'Miami', 4, '1562311901', 1, 3036),
(195, 158, 'LSD', 'New York', 7, '1562557018', 0, 68476),
(196, 889, 'Weed', 'Miami', 4, '1562320161', 0, 2804),
(197, 156, 'Heroin', 'London', 7, '1562504411', 0, 104617),
(198, 1027, 'LSD', 'Miami', 7, '1562592174', 0, 146045),
(199, 1122, 'LSD', 'Miami', 7, '1562602790', 0, 123436),
(200, 29, 'LSD', 'Boston', 7, '1562618261', 0, 139737),
(201, 1135, 'Cocaine', 'Miami', 6, '1562421086', 0, 9852),
(202, 958, 'LSD', 'Miami', 7, '1562683389', 0, 130764);

-- --------------------------------------------------------

--
-- Table structure for table `stafflog`
--

CREATE TABLE `stafflog` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT 0,
  `time` int(11) NOT NULL DEFAULT 0,
  `action` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stafflog`
--

INSERT INTO `stafflog` (`id`, `user`, `time`, `action`, `ip`) VALUES
(167, 2, 1607748978, 'Viewed user demo [2] inventory', '213.205.240.90'),
(166, 2, 1607049870, 'Edited user demo [2]', '213.205.200.17'),
(165, 2, 1607049316, 'Edited user demo [2]', '213.205.200.17'),
(164, 2, 1607049227, 'Edited user demo [2]', '213.205.200.17'),
(163, 2, 1607049204, 'Edited user demo [2]', '213.205.200.17'),
(162, 2, 1607049179, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(161, 2, 1607048583, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(160, 2, 1607048555, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(159, 2, 1607048545, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(158, 2, 1607048500, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(157, 2, 1607048095, 'Viewed user Demoasddaa [2] account', '213.205.200.17'),
(156, 2, 1607047117, 'Edited user Demoasddaa [2]', '213.205.200.17'),
(155, 2, 1607046768, 'Credited Demo [2] $0, 0 crystals and/or 10 vip days.', '213.205.200.17'),
(154, 2, 1606703452, 'Staff logs older than 30 days deleted.', '5.66.193.136'),
(29, 2, 1605756308, 'Looked at Drug Smuggle logs (page 1)', '5.66.193.136'),
(30, 2, 1605756313, 'Looked at Completed Drug Smuggle logs (page 1)', '5.66.193.136'),
(31, 2, 1605756327, 'Looked at Drug Smuggle logs (page 1)', '5.66.193.136'),
(32, 2, 1605756333, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(33, 2, 1605756342, 'Looked at Game Event logs (page 1)', '5.66.193.136'),
(34, 2, 1605756350, 'Looked at Item Xfer Logs (page 1)', '5.66.193.136'),
(35, 2, 1606013602, 'Looked at Donation logs (page 1)', '5.66.193.136'),
(36, 2, 1606013612, 'Looked at Donation logs (page 2)', '5.66.193.136'),
(37, 2, 1606013614, 'Looked at Donation logs (page 1)', '5.66.193.136'),
(38, 2, 1606013658, 'Looked at Credit Xfer Logs (page 1)', '5.66.193.136'),
(39, 2, 1606014255, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(40, 2, 1606014303, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(41, 2, 1606014428, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(42, 2, 1606016712, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(43, 2, 1606016929, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(44, 2, 1606016956, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(45, 2, 1606016970, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(46, 2, 1606016974, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(47, 2, 1606017378, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(48, 2, 1606017405, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(49, 2, 1606017654, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(50, 2, 1606018287, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(51, 2, 1606018308, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(52, 2, 1606018340, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(53, 2, 1606018400, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(54, 2, 1606018480, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(55, 2, 1606018653, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(56, 2, 1606018666, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(57, 2, 1606019117, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(58, 2, 1606019119, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(59, 2, 1606019120, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(60, 2, 1606019684, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(61, 2, 1606019696, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(62, 2, 1606019705, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(63, 2, 1606019708, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(64, 2, 1606019749, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(65, 2, 1606019820, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(66, 2, 1606019826, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(67, 2, 1606019828, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(68, 2, 1606019831, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(69, 2, 1606020009, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(70, 2, 1606020047, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(71, 2, 1606020048, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(72, 2, 1606020103, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(73, 2, 1606020117, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(74, 2, 1606020125, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(75, 2, 1606020127, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(76, 2, 1606020145, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(77, 2, 1606020175, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(78, 2, 1606020240, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(79, 2, 1606020279, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(80, 2, 1606020317, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(81, 2, 1606020326, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(82, 2, 1606020334, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(83, 2, 1606020353, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(84, 2, 1606020375, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(85, 2, 1606020407, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(86, 2, 1606020441, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(87, 2, 1606020471, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(88, 2, 1606020493, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(89, 2, 1606020502, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(90, 2, 1606020530, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(91, 2, 1606020531, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(92, 2, 1606020566, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(93, 2, 1606020593, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(94, 2, 1606020702, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(95, 2, 1606020802, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(96, 2, 1606020824, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(97, 2, 1606020930, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(98, 2, 1606020958, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(99, 2, 1606100562, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(100, 2, 1606156762, 'Looked at Item Xfer Logs (page 1)', '5.66.193.136'),
(101, 2, 1606156907, 'Viewed user admin [1] account', '5.66.193.136'),
(102, 2, 1606157020, 'Mass jailed IDs 1', '5.66.193.136'),
(103, 2, 1606157040, 'Unfedded user ID 1', '5.66.193.136'),
(104, 2, 1606160860, 'IP Banned:skds#', '5.66.193.136'),
(105, 2, 1606160918, 'IP Banned:5.66.211.23', '5.66.193.136'),
(106, 2, 1606161086, 'IP Banned:5.66.211.23', '5.66.193.136'),
(107, 2, 1606161121, 'IP Banned:5.66.211.23', '5.66.193.136'),
(108, 2, 1606161163, 'IP Banned:5.66.211.23', '5.66.193.136'),
(109, 2, 1606161220, 'IP Banned:5.66.211.23', '5.66.193.136'),
(110, 2, 1606161240, 'IP Banned:5.66.211.23', '5.66.193.136'),
(111, 2, 1606163203, 'IP Banned:5.66.211.23', '5.66.193.136'),
(112, 2, 1606163266, 'IP Banned:5.66.211.23', '5.66.193.136'),
(113, 2, 1606163289, 'IP Banned:5.66.211.23', '5.66.193.136'),
(114, 2, 1606163385, 'IP Banned:5.66.211.23', '5.66.193.136'),
(115, 2, 1606163397, 'IP Banned:5.66.211.23', '5.66.193.136'),
(116, 2, 1606163572, 'IP Banned:5.66.211.23', '5.66.193.136'),
(117, 2, 1606163646, 'IP Banned:5.66.211.23', '5.66.193.136'),
(118, 2, 1606163659, 'IP Banned:5.66.211.23', '5.66.193.136'),
(119, 2, 1606163891, 'IP Banned:5.66.211.23', '5.66.193.136'),
(120, 2, 1606164073, 'IP Banned:5.66.211.23', '5.66.193.136'),
(121, 2, 1606164608, 'IP Banned:5.66.211.23', '5.66.193.136'),
(122, 2, 1606164790, 'IP Banned:5.66.211.23', '5.66.193.136'),
(123, 2, 1606164811, 'IP Banned:5.66.211.23', '5.66.193.136'),
(124, 2, 1606167497, 'Looked at Donation logs (page 1)', '5.66.193.136'),
(125, 2, 1606167520, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(126, 2, 1606234876, 'IP Banned:5.66.211.23', '5.66.193.136'),
(127, 2, 1606234900, 'IP Banned:5.66.211.23', '5.66.193.136'),
(128, 2, 1606234916, 'IP Banned:5.66.211.23', '5.66.193.136'),
(129, 2, 1606235372, 'IP Banned:5.66.211.23', '5.66.193.136'),
(130, 2, 1606235444, 'IP Banned:sdfds', '5.66.193.136'),
(131, 2, 1606235478, 'IP Banned:5.66.211.23', '5.66.193.136'),
(132, 2, 1606351713, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(133, 2, 1606351721, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(134, 2, 1606351726, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(135, 2, 1606699013, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(136, 2, 1606700829, 'Looked at Credit Xfer Logs (page 1)', '5.66.193.136'),
(137, 2, 1606700834, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(138, 2, 1606700846, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(139, 2, 1606702251, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(140, 2, 1606702467, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(141, 2, 1606702609, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(142, 2, 1606702652, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(143, 2, 1606702682, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(144, 2, 1606702805, 'Looked at Activity logs (page 1)', '5.66.193.136'),
(145, 2, 1606702830, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(146, 2, 1606702985, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(147, 2, 1606702990, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(148, 2, 1606703016, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(149, 2, 1606703238, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(150, 2, 1606703252, 'Looked at Donation logs (page 1)', '5.66.193.136'),
(151, 2, 1606703273, 'Looked at Donation logs (page 2)', '5.66.193.136'),
(152, 2, 1606703275, 'Looked at Donation logs (page 1)', '5.66.193.136'),
(153, 2, 1606703403, 'Looked at Registration logs (page 1)', '5.66.193.136'),
(168, 2, 1607748980, 'Deleted Acr Sniper Rifle from demo [2] inventory', '213.205.240.90');

-- --------------------------------------------------------

--
-- Table structure for table `staffnotelogs`
--

CREATE TABLE `staffnotelogs` (
  `snID` int(11) NOT NULL,
  `snCHANGER` int(11) NOT NULL DEFAULT 0,
  `snCHANGED` int(11) NOT NULL DEFAULT 0,
  `snTIME` int(11) NOT NULL DEFAULT 0,
  `snOLD` longtext NOT NULL,
  `snNEW` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_holdings`
--

CREATE TABLE `stock_holdings` (
  `holdingID` bigint(25) NOT NULL,
  `holdingUSER` bigint(25) NOT NULL DEFAULT 0,
  `holdingSTOCK` bigint(25) NOT NULL DEFAULT 0,
  `holdingQTY` bigint(25) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_records`
--

CREATE TABLE `stock_records` (
  `recordUSER` bigint(25) NOT NULL DEFAULT 0,
  `recordTIME` bigint(25) NOT NULL DEFAULT 0,
  `recordTEXT` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_records`
--

INSERT INTO `stock_records` (`recordUSER`, `recordTIME`, `recordTEXT`) VALUES
(1, 1561773772, 'me bought 10 of stock Metal for $19,210'),
(1, 1561773860, 'me sold 10 of stock Metal for $18,390'),
(1, 1561774002, 'me bought 0 of stock Metal for $0'),
(1, 1561774074, 'me sold 0 of stock Metal for $0'),
(1, 1561774205, 'me bought 10 of stock Metal for $18,770'),
(1, 1561774579, 'me sold 10 of stock Metal for $19,070'),
(1, 1561775009, 'me bought 100 of stock Metal for $17,700'),
(1, 1561775957, 'me bought 10 of stock Metal for $7,760'),
(1, 1561775966, 'me bought 10 of stock Metal for $7,760'),
(1022, 1561776453, 'me bought 20 of stock USD for $487,360'),
(1022, 1561776463, 'me bought 10 of stock GBP for $491,730'),
(991, 1561779266, 'me bought 3 of stock USD for $81,642'),
(42, 1561780890, 'me bought 5 of stock Metal for $18,815'),
(1022, 1561788755, 'me sold 20 of stock USD for $566,120'),
(1022, 1561791397, 'me sold 10 of stock GBP for $478,890'),
(169, 1561792956, 'me bought 1 of stock Gold for $11,822'),
(1022, 1561794961, 'me bought 20 of stock GBP for $1,046,760'),
(1022, 1561794972, 'me bought 5 of stock GBP for $261,690'),
(1022, 1561801845, 'me sold 25 of stock GBP for $1,251,425'),
(1047, 1561826118, 'me bought 1500 of stock USD for $40,464,000'),
(156, 1561827780, 'me bought 3 of stock Gold for $21,213'),
(156, 1561827844, 'me bought 3 of stock Metal for $35,502'),
(156, 1561827936, 'me bought 3 of stock Gold for $19,773'),
(1047, 1561836806, 'me sold 1500 of stock USD for $40,779,000'),
(1047, 1561836819, 'me bought 750 of stock GBP for $35,481,000'),
(1047, 1561836914, 'me bought 100000 of stock Oil for $-1,138,300,000'),
(1047, 1561836969, 'me sold 100000 of stock Oil for $-1,138,300,000'),
(1047, 1561837032, 'me bought 1000000 of stock Oil for $-11,383,000,000'),
(1047, 1561837220, 'me sold 750 of stock GBP for $35,373,000'),
(156, 1561898314, 'me sold 6 of stock  for $0');

-- --------------------------------------------------------

--
-- Table structure for table `stock_stocks`
--

CREATE TABLE `stock_stocks` (
  `stockID` bigint(25) NOT NULL,
  `stockNAME` varchar(255) NOT NULL,
  `stockOPRICE` bigint(25) NOT NULL,
  `stockNPRICE` bigint(25) NOT NULL,
  `stockCHANGE` int(25) NOT NULL,
  `stockUD` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_stocks`
--

INSERT INTO `stock_stocks` (`stockID`, `stockNAME`, `stockOPRICE`, `stockNPRICE`, `stockCHANGE`, `stockUD`) VALUES
(23, 'kk', 2000, -12093191, 555, 2),
(2, 'asdasd', 2000, -11998435, 43, 1),
(1, 'test', 2000, -12055409, 679, 2),
(19, 'sad', 2000, -12127246, 15, 1),
(20, 'test', 2000, -12267937, 25, 1),
(21, 'sdfdfgd', 2000, -12145980, 370, 2),
(22, 'jj', 2000, -12207238, 851, 2);

-- --------------------------------------------------------

--
-- Table structure for table `surrenders`
--

CREATE TABLE `surrenders` (
  `surID` int(11) NOT NULL,
  `surWAR` int(11) NOT NULL DEFAULT 0,
  `surWHO` int(11) NOT NULL DEFAULT 0,
  `surTO` int(11) NOT NULL DEFAULT 0,
  `surMSG` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surrenders`
--

INSERT INTO `surrenders` (`surID`, `surWAR`, `surWHO`, `surTO`, `surMSG`) VALUES
(1, 1, 3, 1, ''),
(2, 2, 3, 4, ''),
(5, 6, 10, 1, 'Never wanted a war in the first place.  Too early in the game for this shit'),
(4, 5, 8, 1, 'Hey'),
(6, 6, 10, 1, ''),
(7, 6, 10, 1, ''),
(8, 9, 9, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `unjaillogs`
--

CREATE TABLE `unjaillogs` (
  `ujaID` int(11) NOT NULL,
  `ujaJAILER` int(11) NOT NULL DEFAULT 0,
  `ujaJAILED` int(11) NOT NULL DEFAULT 0,
  `ujaTIME` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unjaillogs`
--

INSERT INTO `unjaillogs` (`ujaID`, `ujaJAILER`, `ujaJAILED`, `ujaTIME`) VALUES
(1, 1192, 25, 1587527084),
(2, 2, 897, 1591840709),
(3, 2, 3, 1592185583);

-- --------------------------------------------------------

--
-- Table structure for table `updates`
--

CREATE TABLE `updates` (
  `a_id` int(11) NOT NULL,
  `a_text` text NOT NULL,
  `a_time` int(11) NOT NULL DEFAULT 0,
  `type` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `updates`
--

INSERT INTO `updates` (`a_id`, `a_text`, `a_time`, `type`) VALUES
(1, 'Boosters have been removed from the credit store.', 1560815399, 'cmarket'),
(2, 'Bank bug has been fixed.', 1560821694, 'bug'),
(3, 'Bank and locker now display the balance with added interest rate at the end of the day!', 1560822527, 'feature'),
(4, 'Partner/Marriage now cost $75K to propose and $50k to break. We have also added a menu link for it.', 1560823666, 'feature'),
(5, 'The android application has been fixed. Please either clear the cache or reinstall the app.', 1560857447, 'bug'),
(6, 'Bounty has been added to the game. You can now place a bounty on a player secretly without them knowing who has placed it. To locate the feature, head over to City > Fight > Bounty. Enjoy!', 1560879977, 'feature'),
(7, 'Gang respect bug fixed. Gang respect is gained by +2 on successful attacks and loss of -2 on defeats. You can gain +3 respect if you decide to hospitalize the user.', 1560880050, 'bug'),
(8, 'Bounty bug has been fixed!', 1560943618, 'bug'),
(9, 'Business/companies profit ratio has been updated. Previously it was setup incorrectly and was giving out way too much profit! I have set it up in a way where you get an added rank value per day to your company. To get a better rank value, employ more members to your company. You will unlock stars for your company based on your rank score reaching x amounts, this simply shows how profitable your company is.\r\n<br /><br />Tip: The more members you employ the higher the profit margin!', 1560949797, 'bug'),
(10, 'Future updates planned for the gang system. Create your gangs and recruit members now to take advantage of the updates straight away.', 1560956540, 'feature'),
(11, 'Gym has been updated with a few achievable boosters to make training more fun! Once your stat reaches x amount the button will unlock. <br /><br />What this gym will booster does is calculates your gym gain with your current will power + added will power that you\'ve unlocked. In basic; it\'s like having 2 properties. Note: Unlocked will power booster does not get added to your account will bar, it\'s only used to calculate the gain.  <br /><br />\r\n<font color=red>This booster can be used for 5 minutes and resets every game hour!</font>\r\n\r\n<br /><br />Tip: Top property, VIP + Will booster activated = Gorilla Gains!! If you got game play then you will know how best to use it. ', 1560976297, 'feature'),
(12, 'Whisky and Mood Pills available! Limited offer on Whiskys! ', 1560986905, 'bmarket'),
(13, 'Attack mug gain has been increased, you can mug a higher % of the players cash in hand. Start storing it away into banks for security!', 1561063889, 'feature'),
(14, 'Hit list now displays all players in the same location that can be attacked! ', 1561075893, 'feature'),
(15, 'Player shops added to the game! Items in inventory can be added to your very own shop by clicking the new button that has been added. The feature can be located, City >> Shops. Enjoy!', 1561081148, 'feature'),
(16, 'Attack cash, crystals and exp gain has been increased!', 1561081367, 'feature'),
(17, 'I\'ve added the cash, crystals and attack button on Hit list. Enjoy fighting :)', 1561082917, 'feature'),
(18, 'You can now add a unique animated icon near your username to stand out with our 7 Day Animated pack! Available in credit store.', 1561089117, 'feature'),
(19, 'New items are being added to the credit store shortly.', 1561129748, 'cmarket'),
(20, 'A button has been added to profiles to send credits more easily.', 1561145996, 'feature'),
(21, 'Crystal, Cash and Exp gain has been increased on searching the streets.', 1561744354, 'feature'),
(22, 'Sparring gain has been set back to normal.', 1561776029, 'feature'),
(23, 'sdc', 1587741057, 'bug'),
(24, 'a', 1587760935, 'bug'),
(25, '', 1587765035, 'bug'),
(26, 's', 1587765167, 'bug'),
(27, 's', 1587776460, 'bug'),
(28, 's', 1587776948, 'bug'),
(29, 'r', 1588044917, 'bug'),
(30, 'hi', 1588190569, 'bug'),
(31, 'hi', 1588280900, 'bug'),
(32, 'as', 1588281173, 'bug'),
(33, 'a', 1588281288, 'bug'),
(34, 'hi', 1588281317, 'bug');

-- --------------------------------------------------------

--
-- Table structure for table `usershopitems`
--

CREATE TABLE `usershopitems` (
  `id` int(11) NOT NULL,
  `shopid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usershoplogs`
--

CREATE TABLE `usershoplogs` (
  `id` int(11) NOT NULL,
  `buyer` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usershops`
--

CREATE TABLE `usershops` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `money` bigint(20) NOT NULL,
  `totalsold` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_activitylogs`
--

CREATE TABLE `users_activitylogs` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `timein` int(11) NOT NULL,
  `timeout` int(11) NOT NULL,
  `sesscode` varchar(255) NOT NULL,
  `fb` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_avatars`
--

CREATE TABLE `users_avatars` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `display_pic` varchar(255) DEFAULT NULL,
  `forum_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_avatars`
--

INSERT INTO `users_avatars` (`id`, `userid`, `display_pic`, `forum_pic`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 3, 'https://graph.facebook.com/2587095298008235/picture?type=large', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_data`
--

CREATE TABLE `users_data` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL DEFAULT '',
  `userpass` varchar(255) NOT NULL DEFAULT '',
  `laston` int(11) NOT NULL DEFAULT 0,
  `lastip` varchar(255) NOT NULL DEFAULT '',
  `job` int(11) NOT NULL DEFAULT 0,
  `lastrest_life` int(11) NOT NULL DEFAULT 0,
  `lastrest_other` int(11) NOT NULL DEFAULT 0,
  `location` int(11) NOT NULL DEFAULT 0,
  `hospital` int(11) NOT NULL DEFAULT 0,
  `jail` int(11) NOT NULL DEFAULT 0,
  `jail_reason` varchar(255) NOT NULL DEFAULT '',
  `fedjail` int(11) NOT NULL DEFAULT 0,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `gender` enum('Male','Female','unset') NOT NULL DEFAULT 'unset',
  `daysold` int(11) NOT NULL DEFAULT 0,
  `signedup` int(11) NOT NULL DEFAULT 0,
  `gang` int(11) NOT NULL DEFAULT 0,
  `daysingang` int(11) NOT NULL DEFAULT 0,
  `course` int(11) NOT NULL DEFAULT 0,
  `cdays` int(11) NOT NULL DEFAULT 0,
  `jobrank` int(11) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL DEFAULT '',
  `login_name` varchar(255) NOT NULL DEFAULT '',
  `display_pic` text DEFAULT NULL,
  `staffnotes` longtext DEFAULT NULL,
  `mailban` int(11) NOT NULL DEFAULT 0,
  `mb_reason` varchar(255) NOT NULL DEFAULT '',
  `hospreason` varchar(255) NOT NULL DEFAULT '',
  `lastip_login` varchar(255) NOT NULL DEFAULT '127.0.0.1',
  `lastip_signup` varchar(255) NOT NULL DEFAULT '127.0.0.1',
  `last_login` int(11) NOT NULL DEFAULT 0,
  `voted` text DEFAULT NULL,
  `crimexp` int(11) NOT NULL DEFAULT 0,
  `attacking` int(11) NOT NULL DEFAULT 0,
  `verified` int(11) NOT NULL DEFAULT 0,
  `forumban` int(11) NOT NULL DEFAULT 0,
  `fb_reason` varchar(255) NOT NULL DEFAULT '',
  `posts` int(11) NOT NULL DEFAULT 0,
  `forums_avatar` varchar(255) NOT NULL DEFAULT '',
  `forums_signature` text DEFAULT NULL,
  `friend_count` int(11) NOT NULL DEFAULT 0,
  `enemy_count` int(11) NOT NULL DEFAULT 0,
  `new_announcements` int(11) NOT NULL DEFAULT 0,
  `boxes_opened` int(11) NOT NULL DEFAULT 0,
  `user_notepad` text DEFAULT NULL,
  `equip_primary` int(11) NOT NULL DEFAULT 0,
  `equip_secondary` int(11) NOT NULL DEFAULT 0,
  `equip_armor` int(11) NOT NULL DEFAULT 0,
  `force_logout` tinyint(4) NOT NULL DEFAULT 0,
  `married` int(11) NOT NULL DEFAULT 0,
  `turns` int(11) NOT NULL DEFAULT 25,
  `profileSIG` text DEFAULT NULL,
  `bounty` int(11) NOT NULL DEFAULT 0,
  `cannabis` int(11) NOT NULL DEFAULT 0,
  `cannabisDays` int(11) NOT NULL DEFAULT 0,
  `cocaineDays` int(11) NOT NULL DEFAULT 0,
  `cocaine` int(11) NOT NULL DEFAULT 0,
  `mm` int(11) NOT NULL DEFAULT 0,
  `mmDays` int(11) NOT NULL DEFAULT 0,
  `heroin` int(11) NOT NULL DEFAULT 0,
  `lsd` int(11) NOT NULL DEFAULT 0,
  `lsdDays` int(11) NOT NULL DEFAULT 0,
  `heroinDays` int(11) NOT NULL DEFAULT 0,
  `ca` varchar(255) NOT NULL DEFAULT 'n',
  `co` varchar(255) NOT NULL DEFAULT 'n',
  `h` varchar(255) NOT NULL DEFAULT 'n',
  `m` varchar(255) NOT NULL DEFAULT 'n',
  `myphone` varchar(255) DEFAULT NULL,
  `notify` int(11) NOT NULL DEFAULT 0,
  `vip` int(11) NOT NULL DEFAULT 0,
  `noobpack` int(11) NOT NULL DEFAULT 0,
  `comppoints` int(11) NOT NULL DEFAULT 0,
  `business` int(11) NOT NULL DEFAULT 0,
  `active` int(11) NOT NULL DEFAULT 0,
  `activedays` int(11) NOT NULL DEFAULT 0,
  `rating` int(11) NOT NULL DEFAULT 0,
  `merits` int(11) NOT NULL DEFAULT 0,
  `mlevel` int(11) NOT NULL DEFAULT 0,
  `mmarried` int(11) NOT NULL DEFAULT 0,
  `mdaysold` int(11) NOT NULL DEFAULT 0,
  `mgang` int(11) NOT NULL DEFAULT 0,
  `rob` int(11) NOT NULL DEFAULT 0,
  `fb_userid` varchar(255) DEFAULT NULL,
  `cBan` text DEFAULT NULL,
  `cReason` text DEFAULT NULL,
  `donated` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tutorial` int(11) NOT NULL DEFAULT 0,
  `phoneon` int(11) DEFAULT NULL,
  `hourlyReward` int(3) NOT NULL DEFAULT 0,
  `main` int(3) NOT NULL DEFAULT 0,
  `second` int(3) NOT NULL DEFAULT 0,
  `steps` int(11) NOT NULL DEFAULT 250,
  `rr` int(11) NOT NULL DEFAULT 0,
  `round` int(11) NOT NULL DEFAULT 0,
  `lastshot` int(11) DEFAULT NULL,
  `betamount` bigint(25) NOT NULL DEFAULT 0,
  `opp` int(11) NOT NULL DEFAULT 0,
  `protected` int(11) NOT NULL DEFAULT 0,
  `banshout` int(11) NOT NULL DEFAULT 0,
  `heist` int(11) DEFAULT 0,
  `score` bigint(40) NOT NULL DEFAULT 0,
  `killingstreak` int(11) NOT NULL DEFAULT 0,
  `pvp` int(11) NOT NULL DEFAULT 0,
  `activeperks` int(11) NOT NULL DEFAULT 0,
  `gradientdays` int(11) NOT NULL DEFAULT 0,
  `respected` int(11) NOT NULL DEFAULT 0,
  `new_shout` int(11) NOT NULL DEFAULT 0,
  `sessiontoken` varchar(255) DEFAULT NULL,
  `code` bigint(44) NOT NULL,
  `validate` int(44) NOT NULL DEFAULT 0,
  `new_update` int(11) NOT NULL DEFAULT 0,
  `exp_gained` bigint(40) NOT NULL DEFAULT 0,
  `startColor` varchar(7) NOT NULL DEFAULT '#ffffff',
  `stopColor` varchar(7) NOT NULL DEFAULT '#ffffff',
  `middleColor` varchar(7) NOT NULL DEFAULT '#ffffff',
  `voting` int(11) NOT NULL DEFAULT 0,
  `compensation` int(11) NOT NULL DEFAULT 0,
  `amount` int(11) NOT NULL DEFAULT 0,
  `shadowban` int(11) NOT NULL,
  `email_verified` int(11) NOT NULL,
  `email_verify_code` int(11) NOT NULL,
  `ipban` int(11) NOT NULL,
  `fbuser` int(11) NOT NULL,
  `email_code2` int(11) NOT NULL,
  `refby` int(11) NOT NULL,
  `referrals` int(11) NOT NULL,
  `profileskin` text NOT NULL,
  `namechange` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_data`
--

INSERT INTO `users_data` (`userid`, `username`, `userpass`, `laston`, `lastip`, `job`, `lastrest_life`, `lastrest_other`, `location`, `hospital`, `jail`, `jail_reason`, `fedjail`, `user_level`, `gender`, `daysold`, `signedup`, `gang`, `daysingang`, `course`, `cdays`, `jobrank`, `email`, `login_name`, `display_pic`, `staffnotes`, `mailban`, `mb_reason`, `hospreason`, `lastip_login`, `lastip_signup`, `last_login`, `voted`, `crimexp`, `attacking`, `verified`, `forumban`, `fb_reason`, `posts`, `forums_avatar`, `forums_signature`, `friend_count`, `enemy_count`, `new_announcements`, `boxes_opened`, `user_notepad`, `equip_primary`, `equip_secondary`, `equip_armor`, `force_logout`, `married`, `turns`, `profileSIG`, `bounty`, `cannabis`, `cannabisDays`, `cocaineDays`, `cocaine`, `mm`, `mmDays`, `heroin`, `lsd`, `lsdDays`, `heroinDays`, `ca`, `co`, `h`, `m`, `myphone`, `notify`, `vip`, `noobpack`, `comppoints`, `business`, `active`, `activedays`, `rating`, `merits`, `mlevel`, `mmarried`, `mdaysold`, `mgang`, `rob`, `fb_userid`, `cBan`, `cReason`, `donated`, `tutorial`, `phoneon`, `hourlyReward`, `main`, `second`, `steps`, `rr`, `round`, `lastshot`, `betamount`, `opp`, `protected`, `banshout`, `heist`, `score`, `killingstreak`, `pvp`, `activeperks`, `gradientdays`, `respected`, `new_shout`, `sessiontoken`, `code`, `validate`, `new_update`, `exp_gained`, `startColor`, `stopColor`, `middleColor`, `voting`, `compensation`, `amount`, `shadowban`, `email_verified`, `email_verify_code`, `ipban`, `fbuser`, `email_code2`, `refby`, `referrals`, `profileskin`, `namechange`) VALUES
(1, 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 1609801087, '94.14.250.182', 0, 0, 0, 1, 0, 0, '', 0, 1, 'Male', 1, 1609742782, 0, 0, 0, 0, 0, 'mdali2k12@gmail.com', 'demo', NULL, NULL, 0, '', '', '94.14.250.182', '94.14.250.182', 1609801075, NULL, 0, 0, 0, 0, '', 0, '', NULL, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 25, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'n', 'n', 'n', 'n', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0.00, 0, NULL, 60, 1113, 5, 250, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '222e24e844d3001520bfebcd09820b62', 9399263, 1, 0, 0, '#ffffff', '#ffffff', '#ffffff', 0, 0, 0, 0, 0, 0, 0, 0, 31885, 0, 0, '', 0),
(2, 'Lol123', 'adbf5a778175ee757c34d0eba4e932bc', 1609743351, '213.205.240.143', 0, 0, 0, 1, 0, 0, '', 0, 1, 'Male', 1, 1609743321, 0, 0, 0, 0, 0, 'ddd@gma.com', 'Lol123', NULL, NULL, 0, '', '', '213.205.240.143', '213.205.240.143', 1609743322, NULL, 0, 0, 0, 0, '', 0, '', NULL, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 25, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'n', 'n', 'n', 'n', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0.00, 0, NULL, 60, 2933, 7, 250, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '186c26edaf381128a276c17bf3c0802b', 2691608, 1, 0, 0, '#ffffff', '#ffffff', '#ffffff', 0, 0, 0, 0, 0, 0, 0, 0, 80114, 0, 0, '', 0),
(3, 'ibrahim619', '83abb2c005380088ca14a40542a7eda0', 1609801160, '213.205.200.84', 0, 0, 0, 1, 0, 0, '', 0, 1, 'Male', 1, 1609743367, 0, 0, 0, 0, 0, 'ibrahim619@live.co.uk', 'ibrahim619', NULL, NULL, 0, '', '', '213.205.200.84', '213.205.240.143', 1609801129, NULL, 0, 0, 0, 0, '', 0, '', NULL, 0, 0, 0, 0, NULL, 0, 0, 0, 0, 0, 25, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'n', 'n', 'n', 'n', NULL, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, NULL, NULL, NULL, 0.00, 0, NULL, 60, 2924, 17, 250, 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '39451c3989597aba1ca2fdf9d0bdfd21', 0, 1, 0, 0, '#ffffff', '#ffffff', '#ffffff', 0, 0, 0, 0, 0, 0, 0, 0, 36898, 0, 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_drugs`
--

CREATE TABLE `users_drugs` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `cannabis` int(11) NOT NULL,
  `cannabisDays` int(11) NOT NULL,
  `cocaine` int(11) NOT NULL,
  `cocaineDays` int(11) NOT NULL,
  `mm` int(11) NOT NULL,
  `mmDays` int(11) NOT NULL,
  `heroin` int(11) NOT NULL,
  `heroinDays` int(11) NOT NULL,
  `lsd` int(11) NOT NULL,
  `lsdDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_facebook`
--

CREATE TABLE `users_facebook` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_facebook`
--

INSERT INTO `users_facebook` (`id`, `userid`, `username`, `email`) VALUES
(1, 3, 'ibrahim619', 'ibrahim619@live.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `users_finance`
--

CREATE TABLE `users_finance` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `money` bigint(40) NOT NULL DEFAULT -1,
  `bankmoney` bigint(40) NOT NULL DEFAULT -1,
  `crystals` bigint(40) NOT NULL DEFAULT -1,
  `bankcrystals` bigint(40) NOT NULL DEFAULT -1,
  `credits` bigint(40) NOT NULL DEFAULT 0,
  `refpoints` bigint(40) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_finance`
--

INSERT INTO `users_finance` (`id`, `userid`, `money`, `bankmoney`, `crystals`, `bankcrystals`, `credits`, `refpoints`) VALUES
(1, 1, 1213, 0, 5, 0, 0, 0),
(2, 2, 3033, 0, 7, 0, 0, 0),
(3, 3, 3024, 0, 17, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_freeze`
--

CREATE TABLE `users_freeze` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `hospital` int(11) NOT NULL DEFAULT 0,
  `jail` int(11) NOT NULL DEFAULT 0,
  `jail_reason` varchar(255) NOT NULL DEFAULT '',
  `fedjail` int(11) NOT NULL DEFAULT 0,
  `mailban` int(11) NOT NULL DEFAULT 0,
  `mb_reason` varchar(255) NOT NULL DEFAULT '',
  `hospreason` varchar(255) NOT NULL DEFAULT '',
  `forumban` int(11) NOT NULL DEFAULT 0,
  `fb_reason` varchar(255) NOT NULL DEFAULT '',
  `cBan` text DEFAULT NULL,
  `cReason` text DEFAULT NULL,
  `banshout` int(11) NOT NULL DEFAULT 0,
  `shadowban` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_inventory`
--

CREATE TABLE `users_inventory` (
  `inv_id` int(11) NOT NULL,
  `inv_itemid` int(11) NOT NULL DEFAULT 0,
  `inv_userid` int(11) NOT NULL DEFAULT 0,
  `inv_qty` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_referals`
--

CREATE TABLE `users_referals` (
  `refID` int(11) NOT NULL,
  `refREFER` int(11) NOT NULL DEFAULT 0,
  `refREFED` int(11) NOT NULL DEFAULT 0,
  `refTIME` int(11) NOT NULL DEFAULT 0,
  `refREFERIP` varchar(15) NOT NULL DEFAULT '127.0.0.1',
  `refREFEDIP` varchar(15) NOT NULL DEFAULT '127.0.0.1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_session`
--

CREATE TABLE `users_session` (
  `session` int(11) NOT NULL,
  `userid` bigint(40) NOT NULL,
  `timeout` bigint(40) NOT NULL,
  `sesscode` varchar(255) NOT NULL,
  `fb` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_session`
--

INSERT INTO `users_session` (`session`, `userid`, `timeout`, `sesscode`, `fb`) VALUES
(9, 1, 1609801075, '8136d62a1c103f21f6ea8869694c296b2997212c', 0),
(2, 2, 1609743322, 'c40b2f4ff396be2938f185141609d27c0f3bebc2', 0),
(10, 3, 1609801129, 'd2cec7d8813b18924e5446143bb7bcaa70d4341f', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_stats`
--

CREATE TABLE `users_stats` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL DEFAULT 0,
  `strength` double(25,0) NOT NULL DEFAULT 0,
  `agility` double(25,0) NOT NULL DEFAULT 0,
  `guard` double(25,0) NOT NULL DEFAULT 0,
  `labour` bigint(40) NOT NULL DEFAULT 0,
  `IQ` bigint(20) NOT NULL DEFAULT 0,
  `robskill` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_stats`
--

INSERT INTO `users_stats` (`id`, `userid`, `strength`, `agility`, `guard`, `labour`, `IQ`, `robskill`) VALUES
(1, 1, 10, 10, 10, 10, 10, 0),
(2, 2, 10, 10, 10, 10, 10, 0),
(3, 3, 10, 10, 10, 10, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_vitals`
--

CREATE TABLE `users_vitals` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `level` bigint(40) NOT NULL,
  `exp` bigint(40) NOT NULL,
  `energy` bigint(40) NOT NULL,
  `maxenergy` bigint(40) NOT NULL,
  `will` bigint(40) NOT NULL,
  `maxwill` bigint(40) NOT NULL,
  `willmax` bigint(40) NOT NULL,
  `brave` bigint(40) NOT NULL,
  `maxbrave` bigint(40) NOT NULL,
  `hp` bigint(40) NOT NULL,
  `maxhp` bigint(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_vitals`
--

INSERT INTO `users_vitals` (`id`, `userid`, `level`, `exp`, `energy`, `maxenergy`, `will`, `maxwill`, `willmax`, `brave`, `maxbrave`, `hp`, `maxhp`) VALUES
(1, 1, 1, 90, 100, 100, 100, 100, 0, 5, 5, 100, 100),
(2, 2, 1, 55, 100, 100, 100, 100, 0, 5, 5, 100, 100),
(3, 3, 1, 61, 100, 100, 100, 100, 0, 5, 5, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `userid` int(11) NOT NULL DEFAULT 0,
  `list` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_heists`
--
ALTER TABLE `active_heists`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD UNIQUE KEY `a_id` (`a_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`appID`);

--
-- Indexes for table `attacklogs`
--
ALTER TABLE `attacklogs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `auctioncollection`
--
ALTER TABLE `auctioncollection`
  ADD PRIMARY KEY (`ididi`);

--
-- Indexes for table `auctions`
--
ALTER TABLE `auctions`
  ADD PRIMARY KEY (`aID`);

--
-- Indexes for table `bankxferlogs`
--
ALTER TABLE `bankxferlogs`
  ADD PRIMARY KEY (`cxID`);

--
-- Indexes for table `blacklist`
--
ALTER TABLE `blacklist`
  ADD PRIMARY KEY (`bl_ID`);

--
-- Indexes for table `bountys`
--
ALTER TABLE `bountys`
  ADD PRIMARY KEY (`bID`);

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`busId`);

--
-- Indexes for table `businesses_alerts`
--
ALTER TABLE `businesses_alerts`
  ADD PRIMARY KEY (`alertId`);

--
-- Indexes for table `businesses_apps`
--
ALTER TABLE `businesses_apps`
  ADD PRIMARY KEY (`appId`);

--
-- Indexes for table `businesses_classes`
--
ALTER TABLE `businesses_classes`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `businesses_members`
--
ALTER TABLE `businesses_members`
  ADD PRIMARY KEY (`bmembId`);

--
-- Indexes for table `businesses_ranks`
--
ALTER TABLE `businesses_ranks`
  ADD PRIMARY KEY (`rankId`);

--
-- Indexes for table `cashxferlogs`
--
ALTER TABLE `cashxferlogs`
  ADD PRIMARY KEY (`cxID`);

--
-- Indexes for table `challengebots`
--
ALTER TABLE `challengebots`
  ADD PRIMARY KEY (`cb_id`);

--
-- Indexes for table `challengesbeaten`
--
ALTER TABLE `challengesbeaten`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `chat2`
--
ALTER TABLE `chat2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatjaillogs`
--
ALTER TABLE `chatjaillogs`
  ADD PRIMARY KEY (`jaID`);

--
-- Indexes for table `chat_box`
--
ALTER TABLE `chat_box`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `chat_channels`
--
ALTER TABLE `chat_channels`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `compspecials`
--
ALTER TABLE `compspecials`
  ADD PRIMARY KEY (`csID`);

--
-- Indexes for table `contactlist`
--
ALTER TABLE `contactlist`
  ADD PRIMARY KEY (`cl_ID`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`crID`);

--
-- Indexes for table `creditmarket`
--
ALTER TABLE `creditmarket`
  ADD PRIMARY KEY (`cmID`);

--
-- Indexes for table `creditxferlogs`
--
ALTER TABLE `creditxferlogs`
  ADD PRIMARY KEY (`cxID`);

--
-- Indexes for table `credit_items`
--
ALTER TABLE `credit_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_packages`
--
ALTER TABLE `credit_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crimegroups`
--
ALTER TABLE `crimegroups`
  ADD PRIMARY KEY (`cgID`);

--
-- Indexes for table `crimes`
--
ALTER TABLE `crimes`
  ADD PRIMARY KEY (`crimeID`);

--
-- Indexes for table `crime_items`
--
ALTER TABLE `crime_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crystallotto`
--
ALTER TABLE `crystallotto`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `crystallottowinners`
--
ALTER TABLE `crystallottowinners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crystalmarket`
--
ALTER TABLE `crystalmarket`
  ADD PRIMARY KEY (`cmID`);

--
-- Indexes for table `crystalxferlogs`
--
ALTER TABLE `crystalxferlogs`
  ADD PRIMARY KEY (`cxID`);

--
-- Indexes for table `crystal_items`
--
ALTER TABLE `crystal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donatetogame`
--
ALTER TABLE `donatetogame`
  ADD PRIMARY KEY (`dID`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dplogs`
--
ALTER TABLE `dplogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`evID`);

--
-- Indexes for table `fedjail`
--
ALTER TABLE `fedjail`
  ADD PRIMARY KEY (`fed_id`);

--
-- Indexes for table `forum_forums`
--
ALTER TABLE `forum_forums`
  ADD PRIMARY KEY (`ff_id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`fp_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`ft_id`);

--
-- Indexes for table `friendaccept`
--
ALTER TABLE `friendaccept`
  ADD PRIMARY KEY (`reqID`);

--
-- Indexes for table `friendslist`
--
ALTER TABLE `friendslist`
  ADD PRIMARY KEY (`fl_ID`);

--
-- Indexes for table `gangcrimefailevents`
--
ALTER TABLE `gangcrimefailevents`
  ADD PRIMARY KEY (`gevID`);

--
-- Indexes for table `gangcrimesucevents`
--
ALTER TABLE `gangcrimesucevents`
  ADD PRIMARY KEY (`gevID`);

--
-- Indexes for table `gangevents`
--
ALTER TABLE `gangevents`
  ADD PRIMARY KEY (`gevID`);

--
-- Indexes for table `gangs`
--
ALTER TABLE `gangs`
  ADD PRIMARY KEY (`gangID`);

--
-- Indexes for table `gangwars`
--
ALTER TABLE `gangwars`
  ADD PRIMARY KEY (`warID`);

--
-- Indexes for table `heists`
--
ALTER TABLE `heists`
  ADD PRIMARY KEY (`hid`);

--
-- Indexes for table `houses`
--
ALTER TABLE `houses`
  ADD PRIMARY KEY (`hID`);

--
-- Indexes for table `hshoutbox`
--
ALTER TABLE `hshoutbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `id`
--
ALTER TABLE `id`
  ADD KEY `itmtypeid` (`itmtypeid`);

--
-- Indexes for table `ignorelist`
--
ALTER TABLE `ignorelist`
  ADD PRIMARY KEY (`ig_ID`);

--
-- Indexes for table `imarketaddlogs`
--
ALTER TABLE `imarketaddlogs`
  ADD PRIMARY KEY (`imaID`);

--
-- Indexes for table `imbuylogs`
--
ALTER TABLE `imbuylogs`
  ADD PRIMARY KEY (`imbID`);

--
-- Indexes for table `imremovelogs`
--
ALTER TABLE `imremovelogs`
  ADD PRIMARY KEY (`imrID`);

--
-- Indexes for table `itembuylogs`
--
ALTER TABLE `itembuylogs`
  ADD PRIMARY KEY (`ibID`);

--
-- Indexes for table `itemmarket`
--
ALTER TABLE `itemmarket`
  ADD PRIMARY KEY (`imID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`itmid`);

--
-- Indexes for table `itemselllogs`
--
ALTER TABLE `itemselllogs`
  ADD PRIMARY KEY (`isID`);

--
-- Indexes for table `itemtypes`
--
ALTER TABLE `itemtypes`
  ADD PRIMARY KEY (`itmtypeid`),
  ADD KEY `itmtypeid` (`itmtypeid`);

--
-- Indexes for table `itemxferlogs`
--
ALTER TABLE `itemxferlogs`
  ADD PRIMARY KEY (`ixID`);

--
-- Indexes for table `jobranks`
--
ALTER TABLE `jobranks`
  ADD PRIMARY KEY (`jrID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jID`);

--
-- Indexes for table `livefeed`
--
ALTER TABLE `livefeed`
  ADD PRIMARY KEY (`evID`);

--
-- Indexes for table `lostbids`
--
ALTER TABLE `lostbids`
  ADD PRIMARY KEY (`lbID`);

--
-- Indexes for table `lostbidss`
--
ALTER TABLE `lostbidss`
  ADD PRIMARY KEY (`lbID`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`mail_id`);

--
-- Indexes for table `mod_roulette`
--
ALTER TABLE `mod_roulette`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `mod_slots`
--
ALTER TABLE `mod_slots`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `mod_slotsc`
--
ALTER TABLE `mod_slotsc`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `moneylotto`
--
ALTER TABLE `moneylotto`
  ADD PRIMARY KEY (`ticketid`);

--
-- Indexes for table `moneylottowinners`
--
ALTER TABLE `moneylottowinners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mugger_oth`
--
ALTER TABLE `mugger_oth`
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `mugger_oth_global`
--
ALTER TABLE `mugger_oth_global`
  ADD PRIMARY KEY (`entry_type`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `oclogs`
--
ALTER TABLE `oclogs`
  ADD PRIMARY KEY (`oclID`);

--
-- Indexes for table `orgcrimes`
--
ALTER TABLE `orgcrimes`
  ADD PRIMARY KEY (`ocID`);

--
-- Indexes for table `papercontent`
--
ALTER TABLE `papercontent`
  ADD PRIMARY KEY (`dfgdfg`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preports`
--
ALTER TABLE `preports`
  ADD PRIMARY KEY (`prID`);

--
-- Indexes for table `profilecomments`
--
ALTER TABLE `profilecomments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `profilesignatures`
--
ALTER TABLE `profilesignatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proposals`
--
ALTER TABLE `proposals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rateID`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`Rec_ID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`conf_id`);

--
-- Indexes for table `shopitems`
--
ALTER TABLE `shopitems`
  ADD PRIMARY KEY (`sitemID`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shopID`);

--
-- Indexes for table `shout_box`
--
ALTER TABLE `shout_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smuggle`
--
ALTER TABLE `smuggle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stafflog`
--
ALTER TABLE `stafflog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffnotelogs`
--
ALTER TABLE `staffnotelogs`
  ADD PRIMARY KEY (`snID`);

--
-- Indexes for table `stock_holdings`
--
ALTER TABLE `stock_holdings`
  ADD PRIMARY KEY (`holdingID`);

--
-- Indexes for table `stock_stocks`
--
ALTER TABLE `stock_stocks`
  ADD PRIMARY KEY (`stockID`);

--
-- Indexes for table `surrenders`
--
ALTER TABLE `surrenders`
  ADD PRIMARY KEY (`surID`);

--
-- Indexes for table `unjaillogs`
--
ALTER TABLE `unjaillogs`
  ADD PRIMARY KEY (`ujaID`);

--
-- Indexes for table `updates`
--
ALTER TABLE `updates`
  ADD UNIQUE KEY `a_id` (`a_id`);

--
-- Indexes for table `usershopitems`
--
ALTER TABLE `usershopitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usershoplogs`
--
ALTER TABLE `usershoplogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usershops`
--
ALTER TABLE `usershops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_activitylogs`
--
ALTER TABLE `users_activitylogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_avatars`
--
ALTER TABLE `users_avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `users_drugs`
--
ALTER TABLE `users_drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_facebook`
--
ALTER TABLE `users_facebook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_finance`
--
ALTER TABLE `users_finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_freeze`
--
ALTER TABLE `users_freeze`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_inventory`
--
ALTER TABLE `users_inventory`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `users_referals`
--
ALTER TABLE `users_referals`
  ADD PRIMARY KEY (`refID`);

--
-- Indexes for table `users_session`
--
ALTER TABLE `users_session`
  ADD PRIMARY KEY (`session`);

--
-- Indexes for table `users_stats`
--
ALTER TABLE `users_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_vitals`
--
ALTER TABLE `users_vitals`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_heists`
--
ALTER TABLE `active_heists`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `appID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `attacklogs`
--
ALTER TABLE `attacklogs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auctioncollection`
--
ALTER TABLE `auctioncollection`
  MODIFY `ididi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auctions`
--
ALTER TABLE `auctions`
  MODIFY `aID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bankxferlogs`
--
ALTER TABLE `bankxferlogs`
  MODIFY `cxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `blacklist`
--
ALTER TABLE `blacklist`
  MODIFY `bl_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bountys`
--
ALTER TABLE `bountys`
  MODIFY `bID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `busId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `businesses_alerts`
--
ALTER TABLE `businesses_alerts`
  MODIFY `alertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `businesses_apps`
--
ALTER TABLE `businesses_apps`
  MODIFY `appId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `businesses_classes`
--
ALTER TABLE `businesses_classes`
  MODIFY `classId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `businesses_members`
--
ALTER TABLE `businesses_members`
  MODIFY `bmembId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `businesses_ranks`
--
ALTER TABLE `businesses_ranks`
  MODIFY `rankId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `cashxferlogs`
--
ALTER TABLE `cashxferlogs`
  MODIFY `cxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `challengebots`
--
ALTER TABLE `challengebots`
  MODIFY `cb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `challengesbeaten`
--
ALTER TABLE `challengesbeaten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat2`
--
ALTER TABLE `chat2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatjaillogs`
--
ALTER TABLE `chatjaillogs`
  MODIFY `jaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chat_box`
--
ALTER TABLE `chat_box`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_channels`
--
ALTER TABLE `chat_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `cityid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `compspecials`
--
ALTER TABLE `compspecials`
  MODIFY `csID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactlist`
--
ALTER TABLE `contactlist`
  MODIFY `cl_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `crID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `creditmarket`
--
ALTER TABLE `creditmarket`
  MODIFY `cmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `creditxferlogs`
--
ALTER TABLE `creditxferlogs`
  MODIFY `cxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `credit_items`
--
ALTER TABLE `credit_items`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `credit_packages`
--
ALTER TABLE `credit_packages`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crimegroups`
--
ALTER TABLE `crimegroups`
  MODIFY `cgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `crimes`
--
ALTER TABLE `crimes`
  MODIFY `crimeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `crime_items`
--
ALTER TABLE `crime_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `crystallotto`
--
ALTER TABLE `crystallotto`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crystallottowinners`
--
ALTER TABLE `crystallottowinners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `crystalmarket`
--
ALTER TABLE `crystalmarket`
  MODIFY `cmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=637;

--
-- AUTO_INCREMENT for table `crystalxferlogs`
--
ALTER TABLE `crystalxferlogs`
  MODIFY `cxID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `donatetogame`
--
ALTER TABLE `donatetogame`
  MODIFY `dID` bigint(40) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `dplogs`
--
ALTER TABLE `dplogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `evID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `fedjail`
--
ALTER TABLE `fedjail`
  MODIFY `fed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `forum_forums`
--
ALTER TABLE `forum_forums`
  MODIFY `ff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `fp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `ft_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `friendaccept`
--
ALTER TABLE `friendaccept`
  MODIFY `reqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friendslist`
--
ALTER TABLE `friendslist`
  MODIFY `fl_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gangcrimefailevents`
--
ALTER TABLE `gangcrimefailevents`
  MODIFY `gevID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gangcrimesucevents`
--
ALTER TABLE `gangcrimesucevents`
  MODIFY `gevID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gangevents`
--
ALTER TABLE `gangevents`
  MODIFY `gevID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `gangs`
--
ALTER TABLE `gangs`
  MODIFY `gangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `gangwars`
--
ALTER TABLE `gangwars`
  MODIFY `warID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `heists`
--
ALTER TABLE `heists`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `houses`
--
ALTER TABLE `houses`
  MODIFY `hID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `hshoutbox`
--
ALTER TABLE `hshoutbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ignorelist`
--
ALTER TABLE `ignorelist`
  MODIFY `ig_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `imarketaddlogs`
--
ALTER TABLE `imarketaddlogs`
  MODIFY `imaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `imbuylogs`
--
ALTER TABLE `imbuylogs`
  MODIFY `imbID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `imremovelogs`
--
ALTER TABLE `imremovelogs`
  MODIFY `imrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `itembuylogs`
--
ALTER TABLE `itembuylogs`
  MODIFY `ibID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;

--
-- AUTO_INCREMENT for table `itemmarket`
--
ALTER TABLE `itemmarket`
  MODIFY `imID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `itmid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `itemselllogs`
--
ALTER TABLE `itemselllogs`
  MODIFY `isID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `itemtypes`
--
ALTER TABLE `itemtypes`
  MODIFY `itmtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `itemxferlogs`
--
ALTER TABLE `itemxferlogs`
  MODIFY `ixID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `jobranks`
--
ALTER TABLE `jobranks`
  MODIFY `jrID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `lostbids`
--
ALTER TABLE `lostbids`
  MODIFY `lbID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lostbidss`
--
ALTER TABLE `lostbidss`
  MODIFY `lbID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `mail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `moneylotto`
--
ALTER TABLE `moneylotto`
  MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moneylottowinners`
--
ALTER TABLE `moneylottowinners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `oclogs`
--
ALTER TABLE `oclogs`
  MODIFY `oclID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orgcrimes`
--
ALTER TABLE `orgcrimes`
  MODIFY `ocID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `papercontent`
--
ALTER TABLE `papercontent`
  MODIFY `dfgdfg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `preports`
--
ALTER TABLE `preports`
  MODIFY `prID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profilecomments`
--
ALTER TABLE `profilecomments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profilesignatures`
--
ALTER TABLE `profilesignatures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `proposals`
--
ALTER TABLE `proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rateID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `Rec_ID` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `conf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `shopitems`
--
ALTER TABLE `shopitems`
  MODIFY `sitemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `shout_box`
--
ALTER TABLE `shout_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smuggle`
--
ALTER TABLE `smuggle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `stafflog`
--
ALTER TABLE `stafflog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `staffnotelogs`
--
ALTER TABLE `staffnotelogs`
  MODIFY `snID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_holdings`
--
ALTER TABLE `stock_holdings`
  MODIFY `holdingID` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock_stocks`
--
ALTER TABLE `stock_stocks`
  MODIFY `stockID` bigint(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `surrenders`
--
ALTER TABLE `surrenders`
  MODIFY `surID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unjaillogs`
--
ALTER TABLE `unjaillogs`
  MODIFY `ujaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `updates`
--
ALTER TABLE `updates`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `usershopitems`
--
ALTER TABLE `usershopitems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usershoplogs`
--
ALTER TABLE `usershoplogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usershops`
--
ALTER TABLE `usershops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_activitylogs`
--
ALTER TABLE `users_activitylogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_avatars`
--
ALTER TABLE `users_avatars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_data`
--
ALTER TABLE `users_data`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_drugs`
--
ALTER TABLE `users_drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_facebook`
--
ALTER TABLE `users_facebook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_finance`
--
ALTER TABLE `users_finance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_freeze`
--
ALTER TABLE `users_freeze`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_inventory`
--
ALTER TABLE `users_inventory`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_referals`
--
ALTER TABLE `users_referals`
  MODIFY `refID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_session`
--
ALTER TABLE `users_session`
  MODIFY `session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_stats`
--
ALTER TABLE `users_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_vitals`
--
ALTER TABLE `users_vitals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
