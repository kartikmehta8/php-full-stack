-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 07:14 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `allocate`
--

INSERT INTO `allocate` (`allocate_id`, `item_id`, `lp_no`, `dept_name`, `dept_id`, `allocate_qty`, `allocate_qty_in_store`, `allocated_date`) VALUES
(2, 3, NULL, NULL, 61, 3, 3, '2021-07-14'),
(3, 4, NULL, NULL, 62, 100, 100, '2021-07-15'),
(4, 7, '', NULL, 62, 3, 3, '2021-07-15'),
(5, 8, NULL, NULL, 62, 3, 3, '2021-07-15'),
(6, 9, NULL, NULL, 62, 3, 3, '2021-07-15'),
(7, 10, NULL, NULL, 64, 1, 1, '2021-07-15'),
(8, 5, NULL, NULL, 63, 2, 2, '2021-07-15'),
(9, 11, NULL, NULL, 62, 6, 6, '2021-07-15'),
(10, 6, NULL, NULL, 62, 1, 1, '2021-07-15'),
(11, 15, NULL, NULL, 61, 10, 10, '2021-07-15'),
(12, 30, NULL, NULL, 63, 1, 1, '2023-07-27'),
(13, 31, NULL, NULL, 87, 1, 1, '2023-09-08'),
(14, 42, NULL, NULL, 87, 100, 100, '2023-09-08'),
(15, 44, NULL, NULL, 89, 100, 100, '2023-09-08'),
(16, 44, NULL, NULL, 91, 100, 30, '2023-09-08'),
(17, 44, NULL, NULL, 91, 100, 70, '2023-09-07'),
(18, 43, NULL, NULL, 90, 100, 80, '2023-09-09'),
(19, 45, NULL, NULL, 87, 200, 200, '2023-09-09'),
(20, 45, NULL, NULL, 89, 200, 200, '2023-09-09'),
(21, 45, NULL, NULL, 90, 200, 200, '2023-09-09'),
(22, 45, NULL, NULL, 91, 200, 0, '2023-09-09'),
(23, 46, NULL, NULL, 91, 100, 90, '2023-09-09'),
(24, 44, NULL, NULL, 91, 200, 200, '2023-09-09'),
(25, 44, NULL, NULL, 90, 20, 20, '2023-09-11'),
(26, 44, NULL, NULL, 89, 13, 13, '2023-09-11'),
(27, 44, NULL, NULL, 87, 10, 10, '2023-09-11'),
(28, 44, NULL, NULL, 89, 10, 10, '2023-09-11'),
(29, 44, NULL, NULL, 91, 10, 10, '2023-09-11'),
(30, 46, NULL, NULL, 90, 10, 10, '2023-09-11'),
(31, 51, NULL, NULL, 92, 50, 40, '2023-09-14'),
(32, 51, NULL, NULL, 94, 50, 40, '2023-09-14'),
(33, 51, NULL, NULL, 93, 50, 45, '2023-09-14'),
(34, 52, NULL, NULL, 92, 50, 50, '2023-09-14'),
(35, 52, NULL, NULL, 93, 50, 50, '2023-09-14'),
(36, 52, NULL, NULL, 94, 50, 40, '2023-09-14'),
(37, 53, NULL, NULL, 95, 200, 195, '2023-09-14'),
(38, 53, NULL, NULL, 96, 200, 190, '2023-09-14'),
(39, 53, NULL, NULL, 97, 200, 200, '2023-09-14'),
(40, 54, NULL, NULL, 95, 500, 500, '2023-09-14'),
(41, 54, NULL, NULL, 96, 500, 480, '2023-09-14'),
(42, 54, NULL, NULL, 97, 500, 500, '2023-09-14'),
(43, 55, NULL, NULL, 91, 100, 100, '2023-09-14'),
(44, 57, NULL, NULL, 87, 20, 10, '2023-09-14'),
(45, 57, NULL, NULL, 92, 20, 18, '2023-09-14'),
(46, 57, NULL, NULL, 95, 20, 20, '2023-09-14'),
(47, 52, NULL, NULL, 87, 100, 87, '2023-09-16'),
(48, 51, NULL, NULL, 93, 40, 40, '2023-09-22'),
(49, 51, NULL, NULL, 87, 100, 60, '2023-09-27'),
(50, 52, NULL, NULL, 87, 100, 100, '2023-09-27'),
(51, 57, NULL, NULL, 87, 20, 20, '2023-09-29'),
(52, 58, NULL, NULL, 99, 100, 100, '2023-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 0,
  `dept_details` varchar(255) NOT NULL,
  `added_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`, `password`, `role`, `dept_details`, `added_at`) VALUES
(1, 'ADMIN', '12345', 1, 'STOCK MANAGER', '2018-03-27'),
(2, 'ADMIN1', '12345', 1, 'admin', '2018-03-27'),
(87, 'ECHS HISAR', 'abc123', 0, 'ECHS', '2023-07-18'),
(89, '433 Fd Hosp', 'abc123', 0, ' 433 Fd Hosp', '2023-09-08'),
(90, '333 Fd Hosp', 'abc123', 0, ' 333 Fd Hosp', '2023-09-08'),
(91, 'MH Hisar', 'abc123', 0, ' MH Hisar', '2023-09-08'),
(92, 'ECHS Jind', 'abc123', 0, ' ECHS Jind', '2023-09-14'),
(93, 'ECHS Meham', 'abc123', 0, ' ECHS Meham', '2023-09-14'),
(94, 'ECHS Bhiwani', 'abc123', 0, ' ECHS Bhiwani', '2023-09-14'),
(95, 'ECHS Rohtak', 'abc123', 0, ' ECHS Rohtak', '2023-09-14'),
(96, 'ECHS Fatehabad', 'abc123', 0, ' ECHS Fatehabad', '2023-09-14'),
(97, 'ECHS Gohana', 'abc123', 0, ' ECHS Gohana', '2023-09-14'),
(98, 'ECHS Narwana', 'abc123', 0, ' ECHS Narwana', '2023-09-14'),
(99, 'test echs', '12345', 0, ' test', '2023-10-11');

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
  `dept_id` int(10) NOT NULL,
  `doi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dept_issue`
--

INSERT INTO `dept_issue` (`dept_issue_id`, `item_id`, `allocate_id`, `dept_qty_issue`, `dept_issue_to`, `dept_allocated_date`, `dept_id`, `doi`) VALUES
(14, 44, 16, 50, 'Nk Nabin A', '2023-09-08', 91, '2023-09-29'),
(23, 51, 32, 10, 'L/nk Bheem Singh', '2023-09-14', 94, '2023-08-22'),
(24, 52, 36, 10, 'Hav Gurjar', '2023-09-14', 94, '2023-08-21'),
(25, 53, 38, 10, 'Daughter of Hav SAJJAN', '2023-09-14', 96, '2023-08-30'),
(26, 54, 41, 20, 'Hav Ajeet Singh', '2023-09-14', 96, '2023-08-21'),
(27, 57, 45, 2, 'HAv ABC', '2023-09-14', 92, '2023-08-26'),
(28, 57, 44, 5, 'abc', '2023-09-14', 87, '2023-08-27'),
(29, 57, 44, 2, 'Nk Test Singh', '2023-09-15', 87, '2023-09-15'),
(30, 51, 31, 10, 'aaaaaaaaaaaaaa', '2023-09-15', 92, '2023-08-16'),
(31, 57, 44, 12, 'Hav abc ccccccc', '2023-09-16', 87, '2023-09-20'),
(32, 52, 47, 10, 'Hav CP Singh', '2023-09-22', 87, '2023-09-23'),
(33, 57, 44, 1, 'Hav Cp Sin', '2023-09-27', 87, '2023-09-25'),
(34, 57, 44, 10, 'NK ABC', '2023-09-27', 87, '2023-09-27'),
(35, 52, 47, 3, 'Test Test', '2023-09-29', 87, '2023-09-29'),
(36, 51, 33, 5, 'Hav XYZ', '2023-09-30', 93, '2023-09-30'),
(37, 53, 37, 5, 'Hav Test ', '2023-09-30', 95, '2023-10-01'),
(38, 51, 49, 20, 'abcd', '2023-10-05', 87, '2023-10-05'),
(39, 51, 49, 20, 'hav abc', '2019-12-25', 87, '2019-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(90) DEFAULT NULL,
  `item_cat` varchar(90) DEFAULT NULL,
  `qty` int(8) DEFAULT NULL,
  `cost_per` varchar(20) NOT NULL,
  `item_detail` varchar(100) DEFAULT NULL,
  `bill_no` varchar(50) DEFAULT NULL,
  `supplier_id` varchar(99) DEFAULT NULL,
  `dept_id` varchar(67) DEFAULT '1',
  `qty_issue` int(9) DEFAULT NULL,
  `supplied_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item_name`, `item_cat`, `qty`, `cost_per`, `item_detail`, `bill_no`, `supplier_id`, `dept_id`, `qty_issue`, `supplied_at`) VALUES
(51, 'Paracetamol', 'aaa', 200, '200', '', '2024-09-01', 'Sun Pharmaceutical', '1', -90, '2023-08-01'),
(52, 'Marliv DS', ' test', 500, '1000', '', '2025-10-01', 'Cipla ltd', '1', 150, '2023-09-01'),
(53, 'Nasal Drop', ' test', 1000, '2000', '', '2025-01-01', 'Lupin ltd', '1', 400, '2023-07-01'),
(54, 'ORS', 'test', 2000, '2000', '', '2026-01-01', 'Torrent Pharma', '1', 500, '2023-08-31'),
(55, 'Dolo', 'Fever', 1000, '2000', '', '2025-01-01', 'Cipla ltd', '1', 0, '2023-09-01'),
(57, 'Vicks', ' headache', 1000, '1000', '', '2023-09-30', 'Sun Pharmaceutical', '1', 20, '2023-09-14'),
(58, 'covid 19', ' -', 500, '500', '', '2024-11-30', 'Dr. Reddy&#39;s Lab', '1', 400, '2023-10-11');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(30) NOT NULL,
  `supplier_details` varchar(255) NOT NULL,
  `added_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_details`, `added_at`) VALUES
(11, 'Sun Pharmaceutical', ' Sun Pharmaceutical industries ltd', '2023-09-08'),
(12, 'Dr. Reddy&#39;s Lab', ' Dr. Reddy&#39;s Laboratories ltd', '2023-09-08'),
(13, 'Cipla ltd', ' Cipla ltd buy Company', '2023-09-08'),
(14, 'Torrent Pharma', ' Torrent Pharmaceuticals ltd', '2023-09-08'),
(15, 'Zydus Lifesciences', ' Zydus Lifesciences', '2023-09-08'),
(16, 'Lupin ltd', ' Lupin ltd', '2023-09-08');

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
  MODIFY `allocate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `dept_issue`
--
ALTER TABLE `dept_issue`
  MODIFY `dept_issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
