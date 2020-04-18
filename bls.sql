-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020 年 04 月 18 日 09:46
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bls`
--

-- --------------------------------------------------------

--
-- 資料表結構 `accounts`
--

CREATE TABLE `accounts` (
  `sid` varchar(11) NOT NULL,
  `linkmail` text NOT NULL,
  `pwd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `accounts`
--

INSERT INTO `accounts` (`sid`, `linkmail`, `pwd`) VALUES
('admin', 'vladilenlimingzi@gmail.com', '$2y$10$pE9uAX4GkrBxKG3b/1dkhOmrBn.Hmz6WBGgZMvMXKxCCbcii918ry'),
('s1155100000', 'remigiolimingzi@gmail.com', '$2y$10$h2dxSg2enW.V2jJRM.frHexdP3RzahA.VUW/DPUKo2N/I7uZT2IG6'),
('s1155109349', '1155109349@link.cuhk.edu.hk', '$2y$10$L5GVaD9sSI23AQFcAUVCseQDVnEXUtgc6GwDRbHS4Z5Jt3LnOL5jW'),
('s1155109544', '1155109544@link.cuhk.edu.hk', '$2y$10$r/H7K3gpCqhPPknJVN/i8ugZpw9JtPk1hGxwvk605QvidgzuMabke'),
('test', '1155109544@link.cuhk.edu.hk', '$2y$10$/dDoVbSsrhk1nBGe95LwVul40k8C4nbyQ2EhulRly.CHehqly9vRS');

-- --------------------------------------------------------

--
-- 資料表結構 `areainfo`
--

CREATE TABLE `areainfo` (
  `area` char(2) NOT NULL,
  `lib` char(50) NOT NULL,
  `seatnum` int(6) NOT NULL,
  `floor` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `areainfo`
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
('C', 'uclib', 5, '2');

-- --------------------------------------------------------

--
-- 資料表結構 `bookrecord`
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
-- 傾印資料表的資料 `bookrecord`
--

INSERT INTO `bookrecord` (`bookid`, `sid`, `bookdate`, `starttime`, `endtime`, `seatid`, `area`, `lib`) VALUES
(10, 's1155100000', '2020-04-20', '13:00:00', '19:00:00', 'A10', 'A', 'ulib'),
(17, 's1155100000', '2020-04-15', '12:30:00', '16:30:00', 'A1', 'A', 'ulib'),
(25, 's1155100000', '2019-01-01', '13:00:00', '19:00:00', 'D1', 'D', 'ulib'),
(36, 's1155109544', '2020-04-16', '13:00:00', '13:55:00', 'F1', 'F', 'ulib'),
(40, 's1155100000', '2020-04-16', '13:00:00', '16:30:00', 'F15', 'F', 'ulib'),
(43, 'admin', '2020-04-12', '13:00:00', '16:30:00', 'C8', 'C', 'ulib'),
(45, 'test', '2020-05-02', '13:00:00', '15:00:00', 'F4', 'F', 'ulib'),
(46, 'test', '2020-04-07', '14:00:00', '14:59:00', 'E4', 'E', 'ulib'),
(48, 'test', '2020-04-07', '13:00:00', '13:40:00', 'C2', 'C', 'ulib'),
(50, 's1155109349', '2020-04-09', '13:00:00', '17:30:00', 'E15', 'E', 'ulib'),
(51, 's1155100000', '2020-04-19', '13:00:00', '13:30:00', 'E3', 'E', 'ulib'),
(54, 's1155109349', '2020-04-08', '12:00:00', '15:00:00', 'F12', 'F', 'ulib'),
(62, 's1155100000', '2020-04-10', '09:10:00', '09:30:00', 'D3', 'D', 'ulib'),
(63, 's1155109544', '2020-04-15', '10:00:00', '10:50:00', 'B3', 'B', 'ulib'),
(65, 's1155109544', '2020-04-26', '10:00:00', '10:50:00', 'C3', 'C', 'ulib'),
(66, 's1155100000', '2020-04-28', '14:00:00', '14:30:00', 'F13', 'F', 'ulib'),
(67, 's1155100000', '2020-04-22', '20:50:00', '20:55:00', 'A20', 'A', 'ulib'),
(68, 's1155100000', '2020-05-18', '09:10:00', '09:59:00', 'F15', 'F', 'ulib'),
(69, 's1155109544', '2020-05-03', '08:01:00', '08:09:00', 'C3', 'C', 'uclib'),
(70, 's1155109544', '2020-05-03', '08:10:00', '08:20:00', 'B2', 'B', 'uclib'),
(71, 's1155109544', '2020-05-05', '09:00:00', '09:25:00', 'B8', 'B', 'uclib'),
(72, 's1155109544', '2020-05-02', '08:01:00', '08:09:00', 'B16', 'B', 'uclib'),
(73, 's1155109544', '2020-05-03', '08:21:00', '08:29:00', 'B13', 'B', 'uclib'),
(75, 's1155109544', '2020-04-29', '08:11:00', '08:20:00', 'A6', 'A', 'uclib');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`sid`);

--
-- 資料表索引 `bookrecord`
--
ALTER TABLE `bookrecord`
  ADD PRIMARY KEY (`bookid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `bookrecord`
--
ALTER TABLE `bookrecord`
  MODIFY `bookid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
