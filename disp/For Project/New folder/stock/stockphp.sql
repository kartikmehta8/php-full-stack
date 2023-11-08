-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 18, 2021 at 10:47 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

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

CREATE TABLE `allocate` (
  `allocate_id` int(11) NOT NULL,
  `item_id` int(100) DEFAULT NULL,
  `lp_no` varchar(20) DEFAULT NULL,
  `dept_name` varchar(200) DEFAULT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `allocate_qty` int(10) DEFAULT NULL,
  `allocate_qty_in_store` int(10) DEFAULT NULL,
  `allocated_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allocate`
--

INSERT INTO `allocate` (`allocate_id`, `item_id`, `lp_no`, `dept_name`, `dept_id`, `allocate_qty`, `allocate_qty_in_store`, `allocated_date`) VALUES
(9, 13, 'TEC/28', NULL, 2, 5, 0, '2021-10-16'),
(10, 13, NULL, NULL, 3, 3, 3, '2021-10-16'),
(11, 14, 'IT/15', NULL, 2, 2, 2, '2021-10-18'),
(12, 15, 'REGT/23', NULL, 2, 1, 0, '2021-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `dept_details` varchar(255) NOT NULL,
  `added_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `password`, `role`, `dept_details`, `added_at`) VALUES
(1, 'Q Branch', '12345', 1, 'default stock department', '2018-03-27'),
(2, 'NMS Store', '12345', 0, '2 COY NMS SEC', '2018-04-05'),
(3, 'A Store', '12345', 0, '1 COY A SEC', '2018-04-04'),
(4, 'CQ 2 COY', '12345', 0, '2 COY CHQ SEC', '2018-04-19');

-- --------------------------------------------------------

--
-- Table structure for table `dept_issue`
--

CREATE TABLE `dept_issue` (
  `dept_issue_id` int(11) NOT NULL,
  `item_id` int(20) NOT NULL,
  `allocate_id` int(20) NOT NULL,
  `dept_qty_issue` int(20) DEFAULT NULL,
  `dept_issue_to` varchar(100) DEFAULT NULL,
  `dept_allocated_date` date DEFAULT NULL,
  `dept_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dept_issue`
--

INSERT INTO `dept_issue` (`dept_issue_id`, `item_id`, `allocate_id`, `dept_qty_issue`, `dept_issue_to`, `dept_allocated_date`, `dept_id`) VALUES
(6, 13, 9, 2, 'DET 1', '2021-10-16', 2),
(7, 13, 9, 2, 'DET 2', '2021-10-16', 2),
(8, 13, 9, 1, 'NMS', '2021-10-18', 2),
(9, 15, 12, 1, 'CQ 2 COY', '2021-10-18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(90) DEFAULT NULL,
  `item_cat` varchar(90) DEFAULT NULL,
  `qty` int(8) DEFAULT NULL,
  `item_detail` varchar(100) DEFAULT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(99) DEFAULT NULL,
  `dept_id` varchar(67) DEFAULT '1',
  `qty_issue` int(9) DEFAULT NULL,
  `supplied_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_cat`, `qty`, `item_detail`, `bill_no`, `supplier_id`, `dept_id`, `qty_issue`, `supplied_at`) VALUES
(13, 'BEETAL TELEPHONE', ' COMN ITEM', 10, 'TECH/III/56', 'L223123', 'LAKA PVT LTD', '1', 2, '2021-10-16'),
(14, 'EPSON PRINTERM3140', ' IT', 3, 'IT/V/129', 'L223123', 'INFO TEC', '1', 1, '2021-10-18'),
(15, 'KENT RO', ' RO SYSTEM', 2, 'REGT/12', 'CIV/87/23', 'DEVI STORE', '1', 1, '2021-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `qrcodes`
--

CREATE TABLE `qrcodes` (
  `id` int(11) NOT NULL,
  `qrUsername` varchar(250) NOT NULL,
  `qrContent` varchar(250) NOT NULL,
  `qrImg` varchar(250) NOT NULL,
  `qrlink` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qrcodes`
--

INSERT INTO `qrcodes` (`id`, `qrUsername`, `qrContent`, `qrImg`, `qrlink`) VALUES
(10, '480', 'ITEM ID : 480\r\nITEM NAME : KENT RO\r\nITEM CATEGORY : RO SYSTEM\r\nITEM DETAILS :REGT\r\nPURCHASE DATE :2021-10-08\r\nVENDOR :LAKA PVT LTD\r\nITEM ISSUE TO :CQ 2 COY', '480.png', 'localhost:8888/stock/lib/qr/userQr/480.png'),
(8, '478', 'ITEM ID : 478\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nITEM DETAILS :IT GRANTS\r\nPURCHASE DATE :2021-10-08\r\nVENDOR :INFO TEC\r\nITEM ISSUE TO :NMS Store', '478.png', 'localhost:8888/stock/lib/qr/userQr/478.png'),
(9, '479', 'ITEM ID : 479\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nITEM DETAILS :TECH GRANT\r\nPURCHASE DATE :2021-10-08\r\nVENDOR :INFO TEC\r\nITEM ISSUE TO :A Store', '479.png', 'localhost:8888/stock/lib/qr/userQr/479.png'),
(11, '478', 'ITEM ID : 478\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nITEM DETAILS :IT GRANTS\r\nPURCHASE DATE :2021-10-08\r\nVENDOR :INFO TEC\r\nITEM ISSUE TO :NMS Store', '478.png', 'localhost:8888/stock/lib/qr/userQr/478.png'),
(12, '9', 'ITEM ID : 9\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nQLP No :IT/V/129\r\nCIV No :CIV/6762/8\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :QM STORE', '9.png', 'localhost:8888/stock/lib/qr/userQr/9.png'),
(13, '10', 'ITEM ID : 10\r\nITEM NAME : KENT RO\r\nITEM CATEGORY : RO SYSTEM\r\nQLP No :REGT/VI/63\r\nCIV No :CIV/76/90\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :DEVI STORE\r\nITEM IN :QM STORE', '10.png', 'localhost:8888/stock/lib/qr/userQr/10.png'),
(14, '13', 'ITEM ID : 13\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :NMS Store', '13.png', 'localhost:8888/stock/lib/qr/userQr/13.png'),
(15, '14', 'ITEM ID : 14\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nQLP No :IT/V/129\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-18\r\nVENDOR :INFO TEC\r\nITEM IN :NMS Store', '14.png', 'localhost:8888/stock/lib/qr/userQr/14.png'),
(16, '14', 'ITEM ID : 14\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nQLP No :IT/V/129\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-18\r\nVENDOR :INFO TEC\r\nITEM IN :NMS Store', '14.png', 'localhost:8888/stock/lib/qr/userQr/14.png'),
(17, '13', 'ITEM ID : 13\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :', '13.png', 'localhost:8888/stock/lib/qr/userQr/13.png'),
(18, '9', 'ITEM ID : 9\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :NMS Store', '9.png', 'localhost:8888/stock/lib/qr/userQr/9.png'),
(19, '10', 'ITEM ID : 10\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :A Store', '10.png', 'localhost:8888/stock/lib/qr/userQr/10.png'),
(20, '11', 'ITEM ID : 11\r\nITEM NAME : EPSON PRINTERM3140\r\nITEM CATEGORY : IT\r\nQLP No :IT/V/129\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-18\r\nVENDOR :INFO TEC\r\nITEM IN :NMS Store', '11.png', 'localhost:8888/stock/lib/qr/userQr/11.png'),
(21, '15', 'ITEM ID : 15\r\nITEM NAME : KENT RO\r\nITEM CATEGORY : RO SYSTEM\r\nQLP No :REGT/12\r\nCIV No :CIV/87/23\r\nPURCHASE DATE :2021-10-18\r\nVENDOR :DEVI STORE\r\nITEM IN :', '15.png', 'localhost:8888/stock/lib/qr/userQr/15.png'),
(22, '12', 'ITEM ID : 12\r\nITEM NAME : KENT RO\r\nITEM CATEGORY : RO SYSTEM\r\nQLP No :REGT/12\r\nCIV No :CIV/87/23\r\nPURCHASE DATE :2021-10-18\r\nVENDOR :DEVI STORE\r\nITEM IN :NMS Store', '12.png', 'localhost:8888/stock/lib/qr/userQr/12.png'),
(23, '9', 'ITEM ID : 9\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :NMS Store', '9.png', 'localhost:8888/stock/lib/qr/userQr/9.png'),
(24, '13', 'ITEM ID : 13\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :', '13.png', 'localhost:8888/stock/lib/qr/userQr/13.png'),
(25, '9', 'ITEM ID : 9\r\nITEM NAME : BEETAL TELEPHONE\r\nITEM CATEGORY : COMN ITEM\r\nQLP No :TECH/III/56\r\nCIV No :L223123\r\nPURCHASE DATE :2021-10-16\r\nVENDOR :LAKA PVT LTD\r\nITEM IN :NMS Store', '9.png', 'localhost:8888/stock/lib/qr/userQr/9.png');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_details` varchar(255) NOT NULL,
  `added_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_details`, `added_at`) VALUES
(10, 'LAKESHMI ENTERPRICES', ' DEALERS IN HOUSE HOLD ITEMS', '2021-10-08'),
(11, 'LAKA PVT LTD', ' DEALERS IN RO SYSTEM', '2021-10-08'),
(12, 'DEVI STORE', ' DEALERS IN STATIONARY ITEMS', '2021-10-08'),
(13, 'INFO TEC', ' DEALERS IN IT EQPT', '2021-10-08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocate`
--
ALTER TABLE `allocate`
  ADD PRIMARY KEY (`allocate_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`),
  ADD UNIQUE KEY `dept_name` (`dept_name`),
  ADD KEY `dept_name_2` (`dept_name`);

--
-- Indexes for table `dept_issue`
--
ALTER TABLE `dept_issue`
  ADD PRIMARY KEY (`dept_issue_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `qrcodes`
--
ALTER TABLE `qrcodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_name` (`supplier_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocate`
--
ALTER TABLE `allocate`
  MODIFY `allocate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dept_issue`
--
ALTER TABLE `dept_issue`
  MODIFY `dept_issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `qrcodes`
--
ALTER TABLE `qrcodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
