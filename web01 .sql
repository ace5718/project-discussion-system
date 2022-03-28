-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-04-22 10:00:15
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `web01`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `leader` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`id`, `user_id`, `project_id`, `leader`) VALUES
(6, 3, 7, 1),
(8, 3, 8, 1),
(10, 6, 9, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `file` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `program_id` int(11) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `message`
--

INSERT INTO `message` (`id`, `name`, `des`, `time`, `file`, `type`, `father`, `program_id`, `total`) VALUES
(7, 'm1', 'm1', '2020-04-22 03:44:20', 'dc9d85eb801fca0a4b39d813d92f151f.mp4', 'video', NULL, 13, 4),
(8, '1111', '4444444', '2020-04-22 04:02:12', 'e59a1ffecc7abee48e9fb184e5a2f325.mpeg', 'audio', NULL, 15, 0),
(9, '喔ya', '喔ya', '2020-04-22 05:31:53', '0bc7281e2881b05e77900e2e76912ff9.jpeg', 'image', NULL, 32, 8),
(10, '游客134325229', '游客134325229', '2020-04-22 05:32:17', '5acb6744b6d64f909dd63c9e03bccc11.mpeg', 'audio', NULL, 32, 2),
(11, 'fvewrty', '34tb34bbtwervvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', '2020-04-22 05:33:49', '61f62e27a8a82d974079a7b1128c68d9.mpeg', 'audio', NULL, 32, 8),
(12, 'vvvas', 'ccc', '2020-04-22 05:36:36', '7eec4de33b1d203af760ab609f25fbc9.mp4', 'video', '10,11', 32, 0),
(13, '10', '10', '2020-04-22 05:38:31', NULL, NULL, NULL, 32, 10);

-- --------------------------------------------------------

--
-- 資料表結構 `message_point`
--

CREATE TABLE `message_point` (
  `id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `message_point`
--

INSERT INTO `message_point` (`id`, `point`, `user_id`, `message_id`) VALUES
(4, 4, 1, 7),
(5, 5, 6, 9),
(6, 1, 6, 10),
(7, 3, 6, 11),
(8, 3, 1, 9),
(9, 1, 1, 10),
(10, 5, 1, 11),
(11, 5, 1, 13),
(12, 5, 6, 13);

-- --------------------------------------------------------

--
-- 資料表結構 `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan`
--

INSERT INTO `plan` (`id`, `name`, `des`, `project_id`, `total`) VALUES
(3, '12', '12', 7, 0),
(4, '9977', '88777', 7, 0),
(5, '<p style=\"color:blue\">游客13432522999</p>', '游客134325229999', 9, 10),
(7, 'test', 'test', 9, 20);

-- --------------------------------------------------------

--
-- 資料表結構 `plan_message`
--

CREATE TABLE `plan_message` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan_message`
--

INSERT INTO `plan_message` (`id`, `message_id`, `plan_id`, `program_id`) VALUES
(3, 7, 3, 13),
(4, 7, 4, 13),
(5, 11, 5, 32),
(7, 12, 7, 32);

-- --------------------------------------------------------

--
-- 資料表結構 `plan_point`
--

CREATE TABLE `plan_point` (
  `id` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `plan_point`
--

INSERT INTO `plan_point` (`id`, `point`, `user_id`, `plan_id`, `target_id`) VALUES
(68, 2, 1, 3, 10),
(69, 3, 1, 3, 11),
(70, 5, 1, 4, 10),
(71, 5, 1, 4, 11),
(79, 5, 6, 7, 12),
(80, 5, 6, 7, 14),
(81, 5, 1, 7, 12),
(82, 5, 1, 7, 14),
(83, 1, 1, 5, 12),
(84, 3, 1, 5, 14),
(85, 5, 6, 5, 12),
(86, 5, 6, 5, 14),
(87, 5, 6, 5, 15);

-- --------------------------------------------------------

--
-- 資料表結構 `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `program`
--

INSERT INTO `program` (`id`, `name`, `des`, `project_id`) VALUES
(13, 't1', 't1', 7),
(14, 't2', 't2', 7),
(15, '222', '2222222', 8),
(16, '888', '7777', 8),
(17, '8888', '44444', 8),
(18, '77', '777', 8),
(32, 'vv', 'casca', 9),
(33, 'c', 'c', 9);

-- --------------------------------------------------------

--
-- 資料表結構 `project`
--

CREATE TABLE `project` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `des` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `speak` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `project`
--

INSERT INTO `project` (`id`, `name`, `des`, `speak`) VALUES
(7, 't1', 't1', 1),
(8, '22222', '2222', 1),
(9, '喔!', '喔!', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `target`
--

CREATE TABLE `target` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `target`
--

INSERT INTO `target` (`id`, `name`, `project_id`) VALUES
(10, '88888', 7),
(11, '44444', 7),
(12, 'vvvvvvssq', 9),
(14, 'bbb', 9),
(15, '123', 9);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `account` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`id`, `name`, `account`, `password`, `level`) VALUES
(1, 'admin', 'admin', '1234', 1),
(3, 'user2', 'user1', '1234', 0),
(6, '123', '123', '123', 0),
(7, '123', '', '', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_id` (`program_id`);

--
-- 資料表索引 `message_point`
--
ALTER TABLE `message_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- 資料表索引 `plan_message`
--
ALTER TABLE `plan_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `message_id` (`message_id`),
  ADD KEY `program_id` (`program_id`);

--
-- 資料表索引 `plan_point`
--
ALTER TABLE `plan_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_id` (`plan_id`),
  ADD KEY `target_id` (`target_id`),
  ADD KEY `user_id` (`user_id`);

--
-- 資料表索引 `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- 資料表索引 `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `target`
--
ALTER TABLE `target`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_id` (`project_id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `message_point`
--
ALTER TABLE `message_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan_message`
--
ALTER TABLE `plan_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `plan_point`
--
ALTER TABLE `plan_point`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `project`
--
ALTER TABLE `project`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `target`
--
ALTER TABLE `target`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `member_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `message_point`
--
ALTER TABLE `message_point`
  ADD CONSTRAINT `message_point_ibfk_1` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_point_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `plan_message`
--
ALTER TABLE `plan_message`
  ADD CONSTRAINT `plan_message_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_message_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `message` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_message_ibfk_3` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `plan_point`
--
ALTER TABLE `plan_point`
  ADD CONSTRAINT `plan_point_ibfk_1` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_point_ibfk_2` FOREIGN KEY (`target_id`) REFERENCES `target` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_point_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `program_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `target`
--
ALTER TABLE `target`
  ADD CONSTRAINT `target_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
