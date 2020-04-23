-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2020 at 04:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bls`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `sid` varchar(11) NOT NULL,
  `linkmail` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`sid`, `linkmail`, `pwd`) VALUES
('admin', 'vladilenlimingzi@gmail.com', '$2y$10$pE9uAX4GkrBxKG3b/1dkhOmrBn.Hmz6WBGgZMvMXKxCCbcii918ry'),
('s1155100000', 'remigiolimingzi@gmail.com', '$2y$10$h2dxSg2enW.V2jJRM.frHexdP3RzahA.VUW/DPUKo2N/I7uZT2IG6'),
('s1155109349', '1155109349@link.cuhk.edu.hk', '$2y$10$L5GVaD9sSI23AQFcAUVCseQDVnEXUtgc6GwDRbHS4Z5Jt3LnOL5jW'),
('s1155109544', '1155109544@link.cuhk.edu.hk', '$2y$10$r/H7K3gpCqhPPknJVN/i8ugZpw9JtPk1hGxwvk605QvidgzuMabke'),
('test', '1155109544@link.cuhk.edu.hk', '$2y$10$/dDoVbSsrhk1nBGe95LwVul40k8C4nbyQ2EhulRly.CHehqly9vRS'),
('test1', '1155109544@link.cuhk.edu.hk', '$2y$10$IW5LO2LRDPNaH2gr4kZ0vuiYc7GoPHux6rm5rO0kpHKsO3lfrCV6C');

-- --------------------------------------------------------

--
-- Table structure for table `areainfo`
--

CREATE TABLE `areainfo` (
  `area` char(2) NOT NULL,
  `lib` char(50) NOT NULL,
  `seatnum` int(6) NOT NULL,
  `floor` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `areainfo`
--

INSERT INTO `areainfo` (`area`, `lib`, `seatnum`, `floor`) VALUES
('A', 'ulib', 20, '2'),
('B', 'ulib', 20, '3'),
('C', 'ulib', 15, '3'),
('D', 'ulib', 12, '3'),
('E', 'ulib', 15, '4'),
('F', 'ulib', 15, '4'),
('A', 'uclib', 6, '2'),
('B', 'uclib', 6, '2'),
('C', 'uclib', 4, '2'),
('A', 'cclib', 10, '1'),
('B', 'cclib', 10, '2');

-- --------------------------------------------------------

--
-- Table structure for table `bookrecord`
--

CREATE TABLE `bookrecord` (
  `bookid` int(11) NOT NULL,
  `sid` varchar(11) NOT NULL,
  `bookdate` date NOT NULL,
  `starttime` time NOT NULL,
  `endtime` time NOT NULL,
  `seatid` varchar(11) NOT NULL,
  `area` char(2) NOT NULL,
  `lib` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookrecord`
--

INSERT INTO `bookrecord` (`bookid`, `sid`, `bookdate`, `starttime`, `endtime`, `seatid`, `area`, `lib`) VALUES
(45, 'test', '2020-05-02', '13:00:00', '15:00:00', 'F4', 'F', 'ulib'),
(65, 's1155109544', '2020-04-26', '10:00:00', '10:50:00', 'C3', 'C', 'ulib'),
(66, 's1155100000', '2020-04-28', '14:00:00', '14:30:00', 'F13', 'F', 'ulib'),
(72, 's1155109544', '2020-05-02', '08:01:00', '08:09:00', 'B16', 'B', 'uclib'),
(75, 's1155109544', '2020-04-29', '08:11:00', '08:20:00', 'A6', 'A', 'uclib'),
(76, 's1155109544', '2020-04-30', '07:50:00', '07:59:00', 'B2', 'B', 'cclib'),
(77, 's1155109544', '2020-04-27', '13:01:00', '13:09:00', 'B7', 'B', 'cclib'),
(83, 's1155100000', '2020-04-25', '14:00:00', '18:30:00', 'B6', 'B', 'ulib'),
(84, 'test1', '2020-04-25', '13:00:00', '17:30:00', 'B3', 'B', 'ulib'),
(85, 'test2', '2020-04-25', '12:00:00', '18:30:00', 'B9', 'B', 'ulib'),
(87, 'test', '2020-04-25', '13:00:00', '17:00:00', 'B20', 'B', 'ulib'),
(88, 'test', '2020-04-30', '14:00:00', '16:00:00', 'A6', 'A', 'uclib'),
(97, 's1155109544', '2020-04-26', '13:00:00', '14:59:00', 'B10', 'B', 'cclib'),
(103, 's1155100000', '2020-04-30', '13:00:00', '17:30:00', 'B3', 'B', 'uclib'),
(105, 'testsid1', '2020-04-25', '13:30:00', '18:30:00', 'B7', 'B', 'ulib'),
(109, 's1155109349', '2020-04-25', '13:00:00', '18:30:00', 'B15', 'B', 'ulib');

-- --------------------------------------------------------

--
-- Table structure for table `closeday`
--

CREATE TABLE `closeday` (
  `closedate` date NOT NULL,
  `opentime` time NOT NULL,
  `closetime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `closeday`
--

INSERT INTO `closeday` (`closedate`, `opentime`, `closetime`) VALUES
('2020-05-01', '23:59:59', '00:00:00'),
('2020-06-25', '23:59:59', '00:00:00'),
('2020-07-01', '23:59:59', '00:00:00'),
('2020-10-01', '23:59:59', '00:00:00'),
('2020-10-02', '23:59:59', '00:00:00'),
('2020-12-25', '23:59:59', '00:00:00'),
('2020-06-01', '08:59:59', '22:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `bookrecord`
--
ALTER TABLE `bookrecord`
  ADD PRIMARY KEY (`bookid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookrecord`
--
ALTER TABLE `bookrecord`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
