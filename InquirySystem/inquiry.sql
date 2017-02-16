-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2017 年 01 月 23 日 08:20
-- 伺服器版本: 5.7.17
-- PHP 版本： 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `inquiry`
--

-- --------------------------------------------------------

--
-- 資料表結構 `inquires`
--

CREATE TABLE `inquires` (
  `listid` int(10) UNSIGNED NOT NULL,
  `productname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `productid` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) DEFAULT '0',
  `progress` int(11) NOT NULL DEFAULT '0',
  `user` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `listdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `inquires`
--

INSERT INTO `inquires` (`listid`, `productname`, `productid`, `number`, `price`, `progress`, `user`, `listdate`) VALUES
(1, '皮帶', 'A001', 3, 3600, 1, 'Gary', '2017-01-22 18:11:19'),
(5, '碗公', 'E001', 1, 0, 0, 'Gary', '2017-01-22 18:29:48'),
(6, '皮帶', 'B001', 4, 5600, 1, 'Jack', '2017-01-22 20:44:16'),
(7, '離合器', 'F001', 1, 2400, 1, 'Jack', '2017-01-22 20:44:52'),
(8, '空濾海棉', 'A002', 2, 0, 0, 'Jack', '2017-01-22 20:45:15'),
(9, '機油尺', 'C001', 5, 0, 0, 'Gary', '2017-01-22 20:47:05');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `productname` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `productid` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `descript` varchar(40) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`productname`, `productid`, `descript`) VALUES
('空濾海棉', 'A001', '新勁戰、高手、Racing'),
('皮帶', 'B001', '新勁戰、高手、Racing'),
('機油尺', 'C001', '125全車系'),
('煞車皮', 'D001', '125全車系'),
('碗公', 'E001', 'Cuxi、Many'),
('離合器', 'F001', 'Cuxi、Many'),
('皮帶', 'B002', 'Cuxi、Many'),
('空濾海棉', 'A002', 'Cuxi、Many');

-- --------------------------------------------------------

--
-- 資料表結構 `Users`
--

CREATE TABLE `Users` (
  `id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `usertype` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `mail` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `Users`
--

INSERT INTO `Users` (`id`, `password`, `usertype`, `phone`, `mail`) VALUES
('Admins', 'root', 'Admin', 900123123, 'Admins@company.com'),
('Gary', 'abc123', 'Customer', 900456123, 'Gary@customer.com'),
('Jack', 'def123', 'Customer', 900888888, 'Jack@customer.com');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `inquires`
--
ALTER TABLE `inquires`
  ADD PRIMARY KEY (`listid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `inquires`
--
ALTER TABLE `inquires`
  MODIFY `listid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
