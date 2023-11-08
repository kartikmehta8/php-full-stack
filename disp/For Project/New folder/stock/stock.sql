-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 05, 2022 at 05:13 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stockphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocate`
--

DROP TABLE IF EXISTS `allocate`;
CREATE TABLE IF NOT EXISTS `allocate` (
  `allocate_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(100) DEFAULT NULL,
  `lp_no` varchar(20) DEFAULT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `allocate_qty` int(10) DEFAULT NULL,
  `allocate_qty_in_store` int(10) DEFAULT NULL,
  `allocated_date` date DEFAULT NULL,
  PRIMARY KEY (`allocate_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allocate`
--

INSERT INTO `allocate` (`allocate_id`, `item_id`, `lp_no`, `dept_name`, `dept_id`, `allocate_qty`, `allocate_qty_in_store`, `allocated_date`) VALUES
(1, 2, NULL, NULL, 61, 10, 10, '2022-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `dept_details` varchar(255) NOT NULL,
  `added_at` date DEFAULT NULL,
  PRIMARY KEY (`dept_id`),
  UNIQUE KEY `dept_name` (`dept_name`),
  KEY `dept_name_2` (`dept_name`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `password`, `role`, `dept_details`, `added_at`) VALUES
(1, 'Q Branch', '12345', 1, 'default stock department', '2018-03-27'),
(61, '3 COY RR STORE', 'ADMIN', 0, ' 3  COY RR STORE', '2022-07-05');

-- --------------------------------------------------------

--
-- Table structure for table `dept_issue`
--

DROP TABLE IF EXISTS `dept_issue`;
CREATE TABLE IF NOT EXISTS `dept_issue` (
  `dept_issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(20) NOT NULL,
  `allocate_id` int(20) NOT NULL,
  `dept_qty_issue` int(20) DEFAULT NULL,
  `dept_issue_to` varchar(100) DEFAULT NULL,
  `dept_allocated_date` date DEFAULT NULL,
  `dept_id` int(10) NOT NULL,
  PRIMARY KEY (`dept_issue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(90) DEFAULT NULL,
  `item_cat` varchar(90) DEFAULT NULL,
  `qty` int(8) DEFAULT NULL,
  `cost_per` varchar(20) NOT NULL,
  `item_detail` varchar(100) DEFAULT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(99) DEFAULT NULL,
  `dept_id` varchar(67) DEFAULT '1',
  `qty_issue` int(9) DEFAULT NULL,
  `supplied_at` date DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_cat`, `qty`, `cost_per`, `item_detail`, `bill_no`, `supplier_id`, `dept_id`, `qty_issue`, `supplied_at`) VALUES
(2, 'MONITOR', ' COMN ITEM', 20, '2200', 'TECH/333/56', 'L225021', 'INFOSYS', '1', 10, '2022-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

DROP TABLE IF EXISTS `qrcodes`;
CREATE TABLE IF NOT EXISTS `qrcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qrUsername` varchar(250) NOT NULL,
  `qrContent` varchar(250) NOT NULL,
  `qrImg` varchar(250) NOT NULL,
  `qrlink` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `qrUsername`, `qrContent`, `qrImg`, `qrlink`) VALUES
(1, 'MONITOR1', 'ITEM ID : 1\r\nITEM NAME : MONITOR\r\nITEM CATEGORY : COMN ITEM\r\nCost/Unit :2200\r\nQLP No :TECH/333/56\r\nCIV No :L225021\r\nPURCHASE DATE :2022-07-01\r\nVENDOR :INFOSYS\r\nITEM IN :3 COY RR STORE', 'MONITOR1.png', '210.10.10.200/stock/lib/qr/userQr/MONITOR1.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_details` varchar(255) NOT NULL,
  `added_at` date NOT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `supplier_name` (`supplier_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_details`, `added_at`) VALUES
(1, 'INFOSYS', ' INFO COMN', '2022-07-05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
