-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: 10.53.216.201:3938
-- Generation Time: 2016-11-08 20:37:30
-- 服务器版本： 5.6.28-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xiaochu`
--

-- --------------------------------------------------------

--
-- 表的结构 `c_tasks_star`
--

CREATE TABLE `c_tasks_star` (
  `id` int(11) NOT NULL DEFAULT '0',
  `gems` int(11) DEFAULT NULL,
  `star` int(11) DEFAULT NULL,
  `blue_gems` int(11) NOT NULL COMMENT '3366每日礼包'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c_tasks_star`
--

INSERT INTO `c_tasks_star` (`id`, `gems`, `star`, `blue_gems`) VALUES
(1, 2, 30, 1),
(2, 2, 60, 1),
(3, 2, 90, 1),
(4, 2, 120, 1),
(5, 2, 150, 1),
(6, 2, 180, 1),
(7, 2, 210, 1),
(8, 2, 240, 1),
(9, 2, 270, 1),
(10, 2, 300, 1),
(11, 2, 330, 1),
(12, 2, 360, 1),
(13, 2, 390, 1),
(14, 2, 420, 1),
(15, 2, 450, 1),
(16, 2, 480, 1),
(17, 2, 510, 1),
(18, 2, 540, 1),
(19, 2, 570, 1),
(20, 2, 600, 1),
(21, 2, 630, 1),
(22, 2, 660, 1),
(23, 2, 690, 1),
(24, 2, 720, 1),
(25, 2, 750, 1),
(26, 2, 780, 1),
(27, 2, 810, 1),
(28, 2, 840, 1),
(29, 2, 870, 1),
(30, 2, 900, 1),
(31, 2, 930, 1),
(32, 2, 960, 1),
(33, 2, 990, 1),
(34, 2, 1020, 1),
(35, 2, 1050, 1),
(36, 2, 1080, 1),
(37, 2, 1110, 1),
(38, 2, 1140, 1),
(39, 2, 1170, 1),
(40, 2, 1200, 1),
(41, 2, 1230, 1),
(42, 2, 1260, 1),
(43, 2, 1290, 1),
(44, 2, 1320, 1),
(45, 2, 1350, 1),
(46, 2, 1380, 1),
(47, 2, 1410, 1),
(48, 2, 1440, 1),
(49, 2, 1470, 1),
(50, 2, 1500, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `c_tasks_star`
--
ALTER TABLE `c_tasks_star`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
