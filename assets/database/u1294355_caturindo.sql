-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 09, 2021 at 09:54 AM
-- Server version: 10.3.28-MariaDB-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1294355_caturindo`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_version`
--

CREATE TABLE `app_version` (
  `id` int(11) NOT NULL,
  `version` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_version`
--

INSERT INTO `app_version` (`id`, `version`) VALUES
(1, '0.0.60');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `id_user` int(11) UNSIGNED DEFAULT NULL,
  `code_room` varchar(200) DEFAULT NULL,
  `code_transport` varchar(200) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_start` time DEFAULT NULL,
  `time_end` time DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `id_user`, `code_room`, `code_transport`, `date`, `time_start`, `time_end`, `driver_name`, `location`, `note`, `created_at`) VALUES
(298, 74, '', 'T2', '2021-05-22', '15:42:00', '16:42:00', 'tes', 'dev', 'a', '2021-05-08 07:43:06'),
(297, 74, 'R2', '', '2021-05-21', '15:42:00', '17:42:00', '', 'Ruangan Tamu', 'a', '2021-05-08 07:42:26'),
(296, 74, 'R1', '', '2021-05-13', '19:12:00', '20:12:00', '', 'Ruangan Meeting', 'yes', '2021-05-08 07:13:11'),
(294, 74, 'R1', '', '2021-05-31', '15:02:00', '17:02:00', '', 'Ruangan Meeting', 'y', '2021-05-08 07:02:33'),
(293, 74, 'R2', '', '2021-05-31', '12:00:00', '13:00:00', '', 'Ruangan Tamu', 'tets', '2021-05-08 06:41:17'),
(292, 74, 'R1', '', '2021-05-31', '12:00:00', '14:00:00', '', 'Ruangan Meeting', 'booki', '2021-05-08 06:40:20'),
(291, 61, 'R2', '', '2021-05-31', '08:00:00', '12:00:00', '', 'Ruangan Tamu', 'uji coba', '2021-05-08 06:38:49'),
(289, 74, '', 'T1', '2021-05-19', '10:00:00', '02:00:00', 'xx', 'xx', 'xx', '2021-05-08 06:28:50'),
(288, 74, '', 'T2', '2021-05-19', '10:00:00', '02:00:00', 'xx', 'xx', 'xx', '2021-05-08 06:26:18'),
(285, 74, 'R1', '', '2021-05-19', '05:00:00', '06:00:00', '', 'Ruangan Meeting', 'xx', '2021-05-08 06:06:19'),
(286, 74, 'R1', '', '2021-05-17', '06:00:00', '06:00:00', '', 'Ruangan Meeting', 'xx', '2021-05-08 06:07:04'),
(284, 74, '', 'T1', '2021-05-21', '06:00:00', '12:00:00', 'xx', 'xx', 'xx', '2021-05-08 06:05:37'),
(283, 74, 'R1', '', '2021-05-27', '06:00:00', '12:59:00', '', NULL, 'xx', '2021-05-08 06:04:56'),
(282, 74, '', 'T2', '2021-05-21', '09:00:00', '12:00:00', 'xx', 'xx', 'xxl', '2021-05-08 06:02:26'),
(281, 74, 'R1', '', '2021-05-20', '09:00:00', '12:00:00', '', NULL, 'xx', '2021-05-08 06:00:51'),
(280, 74, 'R1', '', '2021-05-31', '08:00:00', '12:00:00', '', NULL, 'xx', '2021-05-08 05:54:10'),
(287, 74, 'R2', '', '2021-05-19', '10:00:00', '02:00:00', '', 'Ruangan Tamu', 'xxx', '2021-05-08 06:21:03'),
(277, 74, 'R1', '', '2021-05-10', '09:00:00', '02:00:00', '', NULL, 'xx', '2021-05-08 05:51:08'),
(276, 74, '', 'T1', '2021-05-10', '09:00:00', '12:00:00', 'ddd', 'xx', 'xx', '2021-05-07 06:42:19'),
(275, 74, 'R1', '', '2021-05-07', '14:00:00', '16:00:00', '', 'Ruangan Meeting', 'xx', '2021-05-07 06:29:29'),
(274, 74, 'R1', '', '2021-05-07', '14:00:00', '16:00:00', '', 'Ruangan Meeting', 'xx', '2021-05-07 06:26:16'),
(273, 74, 'R1', '', '2021-05-07', '14:00:00', '16:00:00', '', 'Ruangan Meeting', 'xxx', '2021-05-07 06:21:29'),
(272, 74, 'R1', '', '2021-05-07', '02:00:00', '04:00:00', '', 'Ruangan Meeting', 'xx', '2021-05-07 06:18:31'),
(271, 74, 'R1', '', '2021-05-07', '14:06:00', '14:06:00', '', 'Ruangan Meeting', 'a', '2021-05-07 06:08:19'),
(270, 74, 'R1', '', '2021-05-08', '03:23:00', '04:23:00', '', 'Ruangan Meeting', 'ok', '2021-05-07 04:23:47'),
(269, 74, 'R1', '', '2021-05-08', '06:22:00', '08:22:00', '', 'Ruangan Meeting', 'okk', '2021-05-07 04:22:47'),
(268, 74, 'R1', '', '2021-05-08', '06:22:00', '08:22:00', '', 'Ruangan Meeting', 'okk', '2021-05-07 04:22:32'),
(267, 74, 'R1', '', '2021-05-08', '03:00:00', '09:20:00', '', 'Ruangan Meeting', 'ok', '2021-05-07 04:21:42'),
(266, 74, NULL, 'T1', '2021-05-28', '13:47:00', '11:46:00', 'Didin', NULL, 'noteddd....', '2021-05-07 03:45:25'),
(265, 74, 'R1', NULL, '2021-05-08', '11:37:00', '11:37:00', NULL, NULL, 'ini noted ya.....', '2021-05-07 03:37:42'),
(264, 74, NULL, 'T1', '2021-05-08', '11:35:00', '14:11:00', 'Andi', NULL, 'ini catatan meeting...', '2021-05-07 03:35:59'),
(263, 74, 'R1', NULL, '2021-05-08', '10:32:00', '11:33:00', NULL, NULL, 'xxxxx...xxxxx', '2021-05-07 03:34:29'),
(262, 74, '', 'T2', '2021-05-08', '09:00:00', '12:00:00', 'zx', 'xx', 'xx', '2021-05-07 03:22:24'),
(261, 74, '', 'T2', '2021-05-10', '09:00:00', '12:00:00', 'xxx', 'xxx', 'xxx', '2021-05-07 03:15:01'),
(260, 74, '', 'T2', '2021-05-08', '09:00:00', '09:00:00', 'didin', 'bandung', 'xxxx', '2021-05-07 03:14:11'),
(259, 74, '', 'T1', '2021-05-08', '16:02:00', '20:02:00', 'a', 'dia kok coba aja text nya apakah bza', 'a', '2021-05-06 08:02:44'),
(258, 74, '', 'T1', '2021-05-06', '16:00:00', '18:00:00', 'dia', 'cidiwey ayokola akas', 'a', '2021-05-06 08:01:36'),
(256, 74, '', 'T2', '2021-05-08', '09:00:00', '12:01:00', 'Driver', 'bandung', 'okey', '2021-05-06 07:16:53'),
(257, 74, 'R2', '', '2021-05-06', '15:33:00', '15:33:00', '', 'Ruangan Tamu', 'test', '2021-05-06 07:34:38'),
(254, 74, 'R1', '', '2021-05-08', '09:00:00', '12:00:00', '', 'Ruangan Meeting', 'okey....', '2021-05-06 07:09:11'),
(253, 74, 'R1', '', '2021-05-07', '09:00:00', '12:00:00', '', 'Ruangan Meeting', 'okeyy...', '2021-05-06 06:59:36'),
(299, 74, 'R2', '', '2021-05-10', '09:00:00', '12:00:00', '', 'Ruangan Tamu', 'noted', '2021-05-10 03:42:37'),
(300, 74, '', 'T2', '2021-05-11', '09:00:00', '12:00:00', 'Didin', 'Bandung', 'noted...', '2021-05-10 03:44:58'),
(301, 74, 'R2', '', '2021-05-27', '07:00:00', '08:00:00', '', 'Ruangan Tamu', 'notedd.....', '2021-05-10 03:50:30'),
(302, 74, 'R1', '', '2021-06-25', '06:00:00', '08:00:00', '', 'Ruangan Meeting', 'ok', '2021-05-10 03:51:58'),
(303, 74, '', 'T2', '2021-06-10', '08:00:00', '11:00:00', 'ddd', 'dd', 'ddd', '2021-05-10 03:56:18'),
(304, 74, '', 'T1', '2021-05-26', '12:35:00', '13:35:00', 'test', 'tes', 'tes', '2021-05-10 04:35:27'),
(305, 74, '', 'T2', '2021-05-27', '12:50:00', '14:50:00', 'druve', 'tes', 'tes', '2021-05-10 04:50:53'),
(306, 74, '', 'T1', '2021-05-27', '12:51:00', '13:51:00', 'test', 'tes', 'tea', '2021-05-10 04:51:23'),
(307, 74, 'R1', '', '2021-05-27', '12:51:00', '13:51:00', '', 'Ruangan Meeting', 'tes', '2021-05-10 04:52:18'),
(308, 74, '', 'T1', '2021-05-11', '13:02:00', '15:02:00', 'tes', 'tes', 'tes', '2021-05-10 05:03:31'),
(309, 74, '', 'T1', '2021-05-12', '13:06:00', '14:06:00', 'tea', 'as', 'a', '2021-05-10 05:06:35'),
(310, 74, '', 'T2', '2021-05-12', '13:13:00', '15:13:00', 'tws', 'tes', 'tes', '2021-05-10 05:13:59'),
(311, 74, '', 'T2', '2021-05-10', '13:14:00', '15:14:00', 'tes', 'tes', 'tes', '2021-05-10 05:15:00'),
(333, 74, 'R1', NULL, '2021-05-22', '17:00:00', '19:30:00', NULL, NULL, 'Contoh ruang meetings', '2021-05-21 08:05:39'),
(313, 74, '', 'T2', '2021-05-13', '13:22:00', '15:22:00', 'tws', 'tes', 'tes', '2021-05-10 05:22:58'),
(314, 74, '', 'T1', '2021-05-12', '13:38:00', '15:38:00', 'tws', 'tes', 'tes', '2021-05-10 05:38:51'),
(315, 74, 'R1', '', '2021-05-11', '13:39:00', '13:39:00', '', 'Ruangan Meeting', 'tws', '2021-05-10 05:39:23'),
(316, 74, 'R1', '', '2021-05-10', '13:40:00', '13:40:00', '', 'Ruangan Meeting', 'tws', '2021-05-10 05:40:37'),
(317, 74, 'R1', '', '2021-05-12', '09:00:00', '12:00:00', '', 'Ruangan Meeting', 'xxx', '2021-05-10 07:50:10'),
(318, 74, '', 'T2', '2021-05-13', '08:00:00', '13:00:00', 'Driver lagi', 'Bandung', 'notedd.....', '2021-05-10 07:52:04'),
(319, 74, 'R1', '', '2021-05-20', '10:00:00', '14:00:00', '', 'Ruangan Meeting', 'okeyy', '2021-05-10 07:56:01'),
(320, 74, '', 'T2', '2021-05-13', '14:00:00', '18:00:00', 'Driver', 'Jakarta', 'noteddd....', '2021-05-10 07:58:02'),
(321, 74, 'R1', '', '2021-05-30', '09:00:00', '15:03:00', '', 'Ruangan Meeting', 'okey', '2021-05-10 08:03:48'),
(322, 74, '', 'T2', '2021-05-26', '20:00:00', '23:00:00', 'Driver', 'Jakarta', 'noteddd', '2021-05-10 08:05:15'),
(323, 74, 'R1', NULL, '2021-05-26', '16:35:00', '18:46:00', NULL, NULL, 'ini noted', '2021-05-10 08:45:09'),
(324, 76, 'R1', '', '2021-05-17', '13:33:00', '14:33:00', '', 'Ruangan Meeting', 'meet', '2021-05-17 06:34:11'),
(325, 76, 'R1', '', '2021-05-17', '13:35:00', '14:35:00', '', 'Ruangan Meeting', 'meet', '2021-05-17 06:35:23'),
(326, 76, 'R1', '', '2021-05-17', '13:51:00', '14:51:00', '', 'Ruangan Meeting', 'SENIN', '2021-05-17 06:51:39'),
(327, 74, 'R1', NULL, '2021-05-17', '14:39:00', '15:39:00', NULL, NULL, 'Test ', '2021-05-17 07:40:28'),
(328, 74, 'R1', NULL, '2021-05-17', '14:41:00', '15:41:00', NULL, NULL, 'Hai', '2021-05-17 07:42:10'),
(329, 74, NULL, 'T2', '2021-05-17', '14:42:00', '15:42:00', 'Yanto', NULL, 'Hi', '2021-05-17 07:43:14'),
(330, 76, 'R1', '', '2021-05-17', '14:50:00', '15:50:00', '', 'Ruangan Meeting', 'ya', '2021-05-17 07:51:07'),
(331, 74, 'R2', '', '2021-05-17', '14:56:00', '03:56:00', '', 'Ruangan Tamu', 'dbs', '2021-05-17 07:56:53'),
(332, 74, 'R1', NULL, '2021-05-19', '11:12:00', '12:12:00', NULL, NULL, 'skjd', '2021-05-19 04:12:26');

-- --------------------------------------------------------

--
-- Table structure for table `comment_meeting`
--

CREATE TABLE `comment_meeting` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_meeting` varchar(50) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_meeting`
--

INSERT INTO `comment_meeting` (`id`, `id_user`, `id_meeting`, `comment`) VALUES
(142, 74, 'M48507', 'dari manager baru...'),
(141, 82, 'M48507', 'dri stafff baru'),
(140, 82, 'M48507', 'dari manager'),
(139, 74, 'M48507', 'dari staff ...'),
(138, 74, 'M43303', 'test'),
(143, 72, 'M78362', 'tes'),
(144, 72, 'M78362', 'te'),
(145, 76, 'M78362', 'test '),
(146, 72, 'M78362', 'tes');

-- --------------------------------------------------------

--
-- Table structure for table `comment_sub_meeting`
--

CREATE TABLE `comment_sub_meeting` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_sub_meeting` varchar(50) DEFAULT NULL,
  `comment` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_sub_meeting`
--

INSERT INTO `comment_sub_meeting` (`id`, `id_user`, `id_sub_meeting`, `comment`) VALUES
(26, 74, 'SM04204', 'sub dari manager'),
(25, 82, 'SM04204', 'sub dari stafff'),
(27, 76, 'SM24581', 'ping'),
(28, 72, 'SM24581', 'tes'),
(29, 72, 'SM24581', 'tes'),
(30, 72, 'SM24581', 'ttes'),
(31, 76, 'SM24581', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `comment_task`
--

CREATE TABLE `comment_task` (
  `id` int(11) NOT NULL,
  `id_task` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'waktu input data'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_task`
--

INSERT INTO `comment_task` (`id`, `id_task`, `id_user`, `comment`, `created_at`) VALUES
(113, 'TA8096', 82, 'task sub staff', '2021-05-07 11:48:49'),
(112, 'TA8096', 74, 'task sub manager', '2021-05-07 11:48:21'),
(111, 'TA8353', 82, 'task dari staff', '2021-05-07 11:43:18'),
(110, 'TA8353', 74, 'task dari manager', '2021-05-07 11:42:36'),
(114, 'TA0067', 72, 'tes', '2021-05-17 13:44:37'),
(115, 'TA0067', 76, 'test ', '2021-05-17 13:45:10'),
(116, 'TA6660', 76, 'test', '2021-05-17 13:52:22'),
(117, 'TA6660', 72, 'tes', '2021-05-17 13:52:47'),
(118, 'TA6029', 76, 'test', '2021-05-17 13:54:57'),
(119, 'TA6029', 76, 'halo', '2021-05-17 13:55:03'),
(120, 'TA6029', 72, 'tes', '2021-05-17 13:55:23'),
(121, 'TA6029', 72, 'tes', '2021-05-17 13:55:29'),
(122, 'TA6029', 72, 'tes', '2021-05-17 13:55:53'),
(123, 'TA6029', 76, 'xybs', '2021-05-17 13:58:30'),
(124, 'TA6029', 72, 'tes', '2021-05-17 13:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `file` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `file`, `date`) VALUES
(351, '488e50e1ac439be7605a0a8f08b857d9.pdf', '2021-05-08 14:07:16'),
(349, 'a44daed1f81247fd860d71d3c3cdec34.jpg', '2021-05-08 13:28:47'),
(348, '156c2d92183e43dbed89c4d929d81213.jpg', '2021-05-08 13:26:05'),
(346, '2906abf27ac7f561a43dc070d2337997.jpg', '2021-05-08 13:07:01'),
(345, 'd3694c4b5baf28f919fcd1ba7aa11ee3.jpg', '2021-05-08 13:06:16'),
(344, 'a04c07ee26c17c62c06702f94a4e1128.jpg', '2021-05-08 13:05:31'),
(343, '0d61b7450392ccffebfc9f459fc0fb5e.jpg', '2021-05-08 13:04:53'),
(342, 'c50003d0a01514d858cf1cfe2e32122e.jpg', '2021-05-08 13:02:21'),
(341, '2994342f22185272d411134b51909269.jpg', '2021-05-08 13:00:46'),
(340, 'f68598aa3b57308b89e0ceb2201d7df8.jpg', '2021-05-08 12:54:06'),
(339, '6b1c8e4a324c27d4ba16845322663f9c.jpg', '2021-05-08 12:52:38'),
(338, 'e51ab60047cf82eb70896d6263a53071.jpg', '2021-05-08 12:51:47'),
(347, '8ad1395610ab7e42e52fca54daf43955.jpg', '2021-05-08 13:21:00'),
(336, '1d823ff53e62d887590b2d690d1877d5.jpg', '2021-05-07 13:42:16'),
(335, '119c0830308c88fbfd15df71c72fe201.jpg', '2021-05-07 13:29:26'),
(334, '7cc137382a9613e4accf544e96d9c8a0.jpg', '2021-05-07 13:25:26'),
(333, '3bc4cada1e7ed33677f61f1de9d4eb9b.jpg', '2021-05-07 13:21:21'),
(332, '0a9a12115a9e185d0041fbbab93a1c6b.jpg', '2021-05-07 13:18:28'),
(331, '30f64ca149693f5d77b2758f641af1ae.jpeg', '2021-05-07 11:47:41'),
(330, 'c1feb69006caf258733a308bc5b7e1da.jpg', '2021-05-07 11:21:37'),
(329, 'fc78c90a2163a2aa78552d002be62a1e.jpeg', '2021-05-07 10:45:25'),
(328, '3f0128a0753159dfc0e871e5d6e3f0fd.jpeg', '2021-05-07 10:37:42'),
(327, 'b9635cc642d19dfe95dc94c85db1c1b7.jpeg', '2021-05-07 10:36:01'),
(326, 'b50f126f1bf778676d55ea626be6e0a7.jpeg', '2021-05-07 10:34:30'),
(325, 'fcf0913785fcd2cfd454a3bbe270bb36.jpg', '2021-05-07 10:26:58'),
(324, 'd0b02cd61b602c5c3752b29a4c4c7cc0.jpg', '2021-05-07 10:24:08'),
(323, '93711158d4b9333b66733e3380bf841a.jpg', '2021-05-07 10:22:21'),
(322, '11341863bf0c9231042f0f2c8e5ca5c8.jpg', '2021-05-07 10:16:34'),
(321, '3d95c421ac9a447126d79eec91042c68.jpg', '2021-05-07 10:14:58'),
(320, 'a67eb578b385d810b71947f6a8708dde.jpg', '2021-05-07 10:14:06'),
(319, 'f25b92a01538324e07fdcd47f8ade89e.pdf', '2021-05-06 14:34:21'),
(318, '377b5bb6099e21cb33f0f45eb72a1add.jpg', '2021-05-06 14:16:50'),
(316, '77e7c48f6b9f2fd141a84dc79694264d.jpg', '2021-05-06 14:09:07'),
(315, 'd54dec901b115722c2d7efdd054185d8.jpg', '2021-05-06 13:59:31'),
(314, 'ba7534bbb80d0c91e3022e33840c7a74.jpg', '2021-05-06 13:56:01'),
(352, 'f9287e2ca95c62b51a891719f923c21a.jpg', '2021-05-10 10:42:24'),
(353, '4d8846e00f913e287421b3604e4661d4.jpg', '2021-05-10 10:44:55'),
(354, 'c5d0c5789707e7aceedd7ba3bde88f44.jpg', '2021-05-10 10:50:26'),
(355, '2c72b3870846257a69c73b80ea9faeea.jpg', '2021-05-10 10:51:53'),
(356, 'b10fed2e52b69ab217c5a4d11487d252.jpg', '2021-05-10 10:56:10'),
(357, '44a947fc9569b0ecd9d8a3ffe6b792a5.jpg', '2021-05-10 11:01:46'),
(358, '75548996f162d48558cdfdfa1b497994.jpg', '2021-05-10 11:02:59'),
(359, 'e9c302753c0d39bf1c1dd5504f30ec6d.jpg', '2021-05-10 11:03:44'),
(360, '999ebe733b8b039a5bf4bf9f3d849790.jpg', '2021-05-10 11:05:00'),
(361, '3a2b72815e86510fdd5989f43a270ce6.jpg', '2021-05-10 11:08:45'),
(376, '2202b91bcf60c1f52daee21614ec9ae5.png', '2021-05-18 17:19:32'),
(363, '91e532a517b1fc6c6b9a03da44c85bb6.jpg', '2021-05-10 11:49:42'),
(364, '16e045916790bf5207eb0c0e3b0eb133.pdf', '2021-05-10 11:52:12'),
(384, 'baa05e04c4ab552e6f2cda379e84ad26.jpeg', '2021-05-21 15:05:41'),
(366, '4bc144dcbb59c11f6bfbf20940c2b02f.pdf', '2021-05-10 12:22:54'),
(367, '6a9f352cb3b920524238e8327eeee6ea.pdf', '2021-05-10 12:38:49'),
(368, '0f81c046380ff6511d2481794014623a.jpg', '2021-05-10 14:50:00'),
(369, 'f8dfcd4fba611f57ba033540e9d099ad.jpg', '2021-05-10 14:51:50'),
(370, 'a6584e328a6b56f823b83c83f39e082a.jpg', '2021-05-10 14:55:55'),
(371, 'e196f5f0a6bc49a2026ee3ab2f4dc506.jpg', '2021-05-10 14:57:59'),
(372, '3ba83737698f801f7aa9272746e23423.jpg', '2021-05-10 15:03:45'),
(373, 'e0f657ebe97e198c5b3e090d15d2356a.jpg', '2021-05-10 15:05:09'),
(374, '8528db4f5759f9abb2f97eafc5830124.png', '2021-05-10 15:45:15'),
(375, '84eb78c69132255e857ca18b04a07669.png', '2021-05-17 14:40:31'),
(377, 'ae45180a7cbde26774638bbee069a7ca.jpg', '2021-05-18 17:50:47'),
(378, '5291846ce32ecc819d57774a7a862981.jpg', '2021-05-20 11:52:28'),
(379, 'c87e6beca64d42ab4b0750d726b0fcdf.jpg', '2021-05-20 11:55:53'),
(380, '892817126bb7d750b8b3699e534dd2df.jpg', '2021-05-20 13:42:17'),
(381, '70bc7571fe1107b8adfc24fd720ec40c.jpg', '2021-05-20 13:43:24'),
(382, '7e7dd0859116fda4f8b4d3363de7cd9f.jpg', '2021-05-20 14:26:46'),
(383, '54cc70db5918b1b7d25f65c0b3e4e367.jpg', '2021-05-20 14:41:18');

-- --------------------------------------------------------

--
-- Table structure for table `group_team`
--

CREATE TABLE `group_team` (
  `id` int(11) NOT NULL,
  `id_user` int(100) DEFAULT NULL COMMENT 'id user dari manajer',
  `nama_team` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_team`
--

INSERT INTO `group_team` (`id`, `id_user`, `nama_team`) VALUES
(24, 61, 'Percobaan Transport'),
(23, 74, 'Marketing'),
(25, 76, 'baru'),
(27, 74, 'Contoh Group');

-- --------------------------------------------------------

--
-- Table structure for table `image_rooms`
--

CREATE TABLE `image_rooms` (
  `id` int(11) NOT NULL,
  `code_room` varchar(200) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_rooms`
--

INSERT INTO `image_rooms` (`id`, `code_room`, `image`) VALUES
(26, 'R1', '3120001301761bddca30803ca8c0bd64.png'),
(27, 'R2', '293e538788a38faaed278ec536e4cdce.jpg'),
(30, 'R3', 'ae99b258e45bd45a00bdc1509b001c4f.jpeg'),
(32, 'R4', 'f3c90e64b42ba13b306c5360eec1617a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `image_transports`
--

CREATE TABLE `image_transports` (
  `id` int(11) NOT NULL,
  `code_transport` varchar(50) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image_transports`
--

INSERT INTO `image_transports` (`id`, `code_transport`, `image`) VALUES
(14, 'T2', '75aea84c9381ac7b8c91fbf1f76ecb1b.png'),
(13, 'T1', '30b296eb1e41e98b993b674fc4f5778a.png'),
(15, 'T1', 'cba9c8e1270beb977759b84bc7ff980a.jpg'),
(16, 'T1', 'cd3be8b1c4e0db9fa4db7aafd541c6a5.jpg'),
(19, 'T3', '80c02c41c9a2e177eb2f83bc35678d02.png'),
(20, 'T3', '981f3a0d52eed39b803f6842d546505e.png'),
(21, 'T3', '160bd0600881eea38227467b434cb579.png');

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` varchar(50) NOT NULL DEFAULT 'NULL',
  `id_user` int(11) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_booking` varchar(50) DEFAULT NULL,
  `id_file` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `tag` varchar(200) DEFAULT NULL,
  `location` text DEFAULT NULL,
  `sub_meting` int(11) DEFAULT NULL,
  `status_meeting` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `id_user`, `id_group`, `id_booking`, `id_file`, `title`, `description`, `date`, `time`, `tag`, `location`, `sub_meting`, `status_meeting`, `created_at`) VALUES
('M79721', 74, 23, '275', '335', 'xxx', 'xxx', '2021-05-07', '14:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 13:29:29'),
('M64454', 74, 23, '297', '', 'twst 2626262', 'desk', '2021-05-21', '15:42:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-08 14:42:27'),
('M16635', 74, 23, '296', '', 'test', 'test', '2021-05-13', '19:12:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-08 14:13:12'),
('M69418', 74, 23, '293', '', 'test 54321', 'test', '2021-05-31', '12:00:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-08 13:41:17'),
('M90611', 74, 23, '292', '', 'test 123456', 'test', '2021-05-31', '12:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-08 13:40:20'),
('M71790', 74, 23, '289', '349', 'test 19 lagi', 'xx', '2021-05-19', '10:00:00', '', 'xx', NULL, NULL, '2021-05-08 13:28:50'),
('M78650', 74, 23, '288', '348', 'Luar Kantor 19', 'xxx', '2021-05-19', '10:00:00', '', 'xx', NULL, NULL, '2021-05-08 13:26:18'),
('M08850', 74, 23, '284', '344', 'xx', 'xx', '2021-05-21', '06:00:00', '', 'xx', NULL, NULL, '2021-05-08 13:05:37'),
('M29811', 74, 23, '287', '347', 'xxc', 'xxx', '2021-05-19', '10:00:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-08 13:21:04'),
('M67963', 74, 23, '263', '326', 'Meeting Office', 'xxxxx...xxxxx', '2021-05-08', '10:32:00', NULL, 'Ruangan Meeting', NULL, NULL, '2021-05-07 10:34:30'),
('M57916', 74, 23, '281', '341', 'Meeting 20 Mei', 'xxx', '2021-05-20', '09:00:00', '', NULL, NULL, NULL, '2021-05-08 13:00:51'),
('M81589', 74, 23, '283', '343', 'xx', 'xx', '2021-05-27', '06:00:00', '', NULL, NULL, NULL, '2021-05-08 13:04:56'),
('M71877', 74, 23, '276', '336', 'Test Transport', 'xxx', '2021-05-10', '09:00:00', '', 'xx', NULL, NULL, '2021-05-07 13:42:19'),
('M59827', 74, 23, '273', '333', 'xxxxx', 'xxx', '2021-05-07', '14:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 13:21:29'),
('M12352', 74, 23, '274', '334', 'test duplicate', 'xxxxx', '2021-05-07', '14:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 13:26:17'),
('M16091', 74, 23, '272', '332', 'xxx', 'xxx', '2021-05-07', '02:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 13:18:31'),
('M78361', 74, 23, '271', '', 'test', 'test', '2021-05-07', '14:06:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 13:08:20'),
('M65007', 74, 23, '269', '', 'office', 'xxx', '2021-05-08', '06:22:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 11:22:47'),
('M48507', 74, 23, '270', '', 'xx', 'xxx', '2021-05-08', '03:23:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 11:23:47'),
('M58252', 74, 23, '268', '', 'office', 'xxx', '2021-05-08', '06:22:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 11:22:32'),
('M32416', 74, 23, '264', '327', 'Meeting luar kantor', 'ini catatan meeting...', '2021-05-08', '11:35:00', NULL, 'Mobilio D 235 X', NULL, NULL, '2021-05-07 10:36:02'),
('M41645', 74, 23, '261', '321', 'xxx', 'xxx', '2021-05-10', '09:00:00', '', 'xxx', NULL, NULL, '2021-05-07 10:15:02'),
('M71162', 74, 23, '262', '323', 'luar meeting', 'xxx', '2021-05-08', '09:00:00', '', 'xx', NULL, NULL, '2021-05-07 10:22:24'),
('M43303', 74, 23, '258', '', 't st test', 'tets tetst', '2021-05-06', '16:00:00', '', 'cidiwey ayokola akas', NULL, 1, '2021-05-06 15:01:37'),
('M12038', 74, 0, '257', '319', 'test meeting', 'test', '2021-05-06', '15:33:00', '', 'Ruangan Tamu', NULL, 1, '2021-05-06 14:34:38'),
('M79844', 74, 23, '256', '318', 'Judul Meeting', 'deskrispiii...', '2021-05-08', '09:00:00', '', 'bandung', NULL, 1, '2021-05-06 14:16:53'),
('M18324', 74, 23, '253', '315', 'Meeting 7 Mei ', 'deksripsi meeting', '2021-05-07', '09:00:00', '', 'Ruangan Meeting', NULL, 1, '2021-05-06 13:59:36'),
('M70945', 74, 23, '299', '352', 'New Meeting 10', 'deskripsi meetingg..', '2021-05-10', '09:00:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-10 10:42:38'),
('M16705', 74, 23, '300', '353', 'New Meeting Outside', 'deskripsi meeting', '2021-05-11', '09:00:00', '', 'Bandung', NULL, 1, '2021-05-10 10:44:58'),
('M29524', 74, 23, '305', '', 'meeting test', 'test', '2021-05-27', '12:50:00', '', 'tes', NULL, NULL, '2021-05-10 11:50:53'),
('M68051', 74, 23, '316', '', 'meeting', 'tes', '2021-05-10', '13:40:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 12:40:37'),
('M60294', 74, 23, '319', '370', 'New Meeting Office', 'deskripsi meeting', '2021-05-20', '10:00:00', '', 'Ruangan Meeting', NULL, 1, '2021-05-10 14:56:01'),
('M63001', 74, 23, '320', '371', 'New Meeting Outside', 'xxx', '2021-05-13', '14:00:00', '', 'Jakarta', NULL, NULL, '2021-05-10 14:58:02'),
('M15461', 74, 23, '323', '374', 'Meeting Baru Web', 'ini noted', '2021-05-26', '16:35:00', NULL, 'Ruangan Meeting', NULL, 1, '2021-05-10 15:45:15'),
('M78362', 76, 25, '324', '', 'meet', 'meet', '2021-05-17', '13:33:00', '', 'Ruangan Meeting', NULL, 1, '2021-05-17 13:34:12'),
('M29862', 76, 25, '326', '', 'SENIN', 'senin', '2021-05-17', '13:51:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-17 13:51:39'),
('M50467', 74, 23, '327', '375', 'Test manager', 'Test ', '2021-05-17', '14:39:00', NULL, 'Ruangan Meeting', NULL, 1, '2021-05-17 14:40:31'),
('M01746', 76, 25, '330', '', 'new mobile ', 'new ', '2021-05-17', '14:50:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-17 14:51:07'),
('M71833', 74, 23, '331', '', 'new meeting mobile', 'aha', '2021-05-17', '14:56:00', '', 'Ruangan Tamu', NULL, 1, '2021-05-17 14:56:53'),
('M78572', 74, 27, '333', '384', 'Contoh Meetings', 'Contoh ruang meetings', '2021-05-22', '17:00:00', NULL, 'Ruangan Meeting', NULL, 1, '2021-05-21 15:05:41');

-- --------------------------------------------------------

--
-- Table structure for table `member_meeting`
--

CREATE TABLE `member_meeting` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `id_meeting` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_meeting`
--

INSERT INTO `member_meeting` (`id`, `user`, `id_meeting`) VALUES
(247, '', 'M64454'),
(246, '', 'M16635'),
(245, '', 'M69418'),
(244, '', 'M90611'),
(243, '', 'M71790'),
(242, '', 'M78650'),
(241, '', 'M29811'),
(240, '', 'M08850'),
(239, '', 'M81589'),
(238, '', 'M57916'),
(237, '', 'M71877'),
(236, '', 'M79721'),
(235, '', 'M12352'),
(234, '', 'M59827'),
(233, '', 'M16091'),
(232, '', 'M78361'),
(231, '', 'M48507'),
(230, '', 'M65007'),
(229, '', 'M58252'),
(228, '', 'M32416'),
(227, '', 'M67963'),
(226, '', 'M71162'),
(225, '', 'M41645'),
(224, '', 'M43303'),
(223, '', 'M12038'),
(222, '', 'M79844'),
(221, '', 'M42743'),
(220, '', 'M18324'),
(248, '', 'M70945'),
(249, '', 'M16705'),
(250, '', 'M29524'),
(251, '', 'M68051'),
(252, '', 'M60294'),
(253, '', 'M63001'),
(254, '', 'M15461'),
(255, '', 'M78362'),
(256, '', 'M29862'),
(257, '', 'M50467'),
(258, '', 'M01746'),
(259, '', 'M71833'),
(260, '', 'M78572');

-- --------------------------------------------------------

--
-- Table structure for table `member_submeeting`
--

CREATE TABLE `member_submeeting` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `id_sub_meeting` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_submeeting`
--

INSERT INTO `member_submeeting` (`id`, `user`, `id_sub_meeting`) VALUES
(54, '', 'SM54180'),
(53, '', 'SM39636'),
(52, '', 'SM17156'),
(51, '', 'SM32175'),
(50, '', 'SM35353'),
(49, '', 'SM86525'),
(48, '', 'SM67235'),
(47, '', 'SM19889'),
(46, '', 'SM21925'),
(45, '', 'SM92274'),
(44, '', 'SM40979'),
(43, '', 'SM30260'),
(42, '', 'SM21723'),
(41, '', 'SM04204'),
(40, '', 'SM80571'),
(39, '', 'SM63198'),
(38, '', 'SM82479'),
(37, '', 'SM23229'),
(55, '', 'SM37192'),
(56, '', 'SM41680'),
(57, '', 'SM88522'),
(58, '', 'SM13040'),
(59, '', 'SM85464'),
(60, '', 'SM59986'),
(61, '', 'SM58500'),
(62, '', 'SM59726'),
(63, '', 'SM56063'),
(64, '', 'SM92090'),
(65, '', 'SM96148'),
(66, '', 'SM85883'),
(67, '', 'SM69022'),
(68, '', 'SM21778'),
(69, '', 'SM63863'),
(70, '', 'SM66700'),
(71, '', 'SM23076'),
(72, '', 'SM94248'),
(73, '', 'SM39889'),
(74, '', 'SM42528'),
(75, '', 'SM59183'),
(76, '', 'SM83671'),
(77, '', 'SM51229'),
(78, '', 'SM27081'),
(79, '', 'SM87112'),
(80, '', 'SM24581');

-- --------------------------------------------------------

--
-- Table structure for table `member_task`
--

CREATE TABLE `member_task` (
  `id` int(11) NOT NULL,
  `id_user` int(50) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `id_task` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_task` varchar(50) DEFAULT NULL,
  `id_meeting` varchar(50) DEFAULT NULL,
  `id_sub_meeting` varchar(100) DEFAULT NULL,
  `id_user_tag` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `id_user`, `id_task`, `id_meeting`, `id_sub_meeting`, `id_user_tag`, `title`) VALUES
(680, 82, NULL, 'M64454', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(678, 82, NULL, 'M16635', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(679, 79, NULL, 'M64454', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(677, 79, NULL, 'M16635', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(675, 79, NULL, 'M69418', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(676, 82, NULL, 'M69418', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(674, 82, NULL, 'M90611', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(673, 79, NULL, 'M90611', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(672, 82, NULL, 'M71790', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(671, 79, NULL, 'M71790', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(670, 82, NULL, 'M78650', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(669, 79, NULL, 'M78650', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(668, 82, NULL, 'M29811', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(667, 79, NULL, 'M29811', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(666, 82, NULL, 'M08850', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(665, 79, NULL, 'M08850', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(664, 82, NULL, 'M81589', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(663, 79, NULL, 'M81589', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(662, 82, NULL, 'M57916', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(661, 79, NULL, 'M57916', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(660, 82, NULL, 'M71877', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(659, 79, NULL, 'M71877', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(658, 82, NULL, 'M79721', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(657, 79, NULL, 'M79721', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(656, 82, NULL, 'M12352', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(655, 79, NULL, 'M12352', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(654, 82, NULL, 'M59827', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(653, 79, NULL, 'M59827', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(652, 82, NULL, 'M16091', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(651, 79, NULL, 'M16091', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(650, 82, NULL, 'M78361', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(649, 79, NULL, 'M78361', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(648, 74, 'TA8096', NULL, NULL, 74, 'manager comment on task Task Sub Meeting'),
(647, 74, 'TA8096', NULL, NULL, 79, 'manager comment on task Task Sub Meeting'),
(646, 74, 'TA8096', NULL, NULL, 82, 'manager comment on task Task Sub Meeting'),
(645, 74, 'TA8096', NULL, NULL, 79, 'manager comment on task Task Sub Meeting'),
(644, 74, 'TA8353', NULL, NULL, 74, 'manager comment on task task meeting luar'),
(643, 74, 'TA8353', NULL, NULL, 79, 'manager comment on task task meeting luar'),
(642, 74, 'TA8353', NULL, NULL, 82, 'manager comment on task task meeting luar'),
(641, 74, 'TA8353', NULL, NULL, 79, 'manager comment on task task meeting luar'),
(640, 74, NULL, NULL, 'SM04204', 82, 'manager comment on sub meeting Sub Luar Office'),
(639, 74, NULL, NULL, 'SM04204', 79, 'manager comment on sub meeting Sub Luar Office'),
(638, 82, NULL, NULL, 'SM04204', 74, 'staff27 comment on sub meeting Sub Luar Office'),
(637, 82, NULL, NULL, 'SM04204', 79, 'staff27 comment on sub meeting Sub Luar Office'),
(636, 74, NULL, 'M48507', NULL, 82, 'manager comment on meeting xx'),
(635, 74, NULL, 'M48507', NULL, 79, 'manager comment on meeting xx'),
(634, 82, NULL, 'M48507', NULL, 74, 'staff27 comment on meeting xx'),
(633, 82, NULL, 'M48507', NULL, 79, 'staff27 comment on meeting xx'),
(632, 82, NULL, 'M48507', NULL, 74, 'staff27 comment on meeting xx'),
(631, 82, NULL, 'M48507', NULL, 79, 'staff27 comment on meeting xx'),
(630, 74, NULL, 'M48507', NULL, 82, 'manager comment on meeting xx'),
(629, 74, NULL, 'M48507', NULL, 79, 'manager comment on meeting xx'),
(628, 79, NULL, 'M48507', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(627, 79, NULL, 'M65007', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(626, 79, NULL, 'M58252', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(625, 79, NULL, 'M32416', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(624, 79, NULL, 'M67963', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(623, 79, NULL, 'M71162', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(622, 79, NULL, 'M41645', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(621, 74, NULL, 'M43303', NULL, 79, 'manager comment on meeting t st test'),
(620, 79, NULL, 'M43303', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(619, 79, NULL, 'M79844', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(618, 79, NULL, 'M18324', NULL, 79, 'manager tagged you and 2 others in a meeting'),
(617, 74, NULL, '', NULL, 79, 'manager tagged you and 2 others in group Marketing'),
(681, 79, NULL, 'M70945', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(682, 82, NULL, 'M70945', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(683, 79, NULL, 'M16705', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(684, 82, NULL, 'M16705', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(685, 79, NULL, 'M29524', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(686, 82, NULL, 'M29524', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(687, 79, NULL, 'M68051', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(688, 82, NULL, 'M68051', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(689, 79, NULL, 'M60294', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(690, 82, NULL, 'M60294', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(691, 79, NULL, 'M63001', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(692, 82, NULL, 'M63001', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(693, 79, NULL, 'M15461', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(694, 82, NULL, 'M15461', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(695, 72, NULL, 'M78362', NULL, 72, 'raka tagged you and 2 others in a meeting'),
(696, 76, NULL, NULL, 'SM24581', 72, 'raka comment on sub meeting meet'),
(697, 72, NULL, NULL, 'SM24581', 76, 'Fajrin comment on sub meeting meet'),
(698, 72, NULL, NULL, 'SM24581', 76, 'Fajrin comment on sub meeting meet'),
(699, 72, NULL, 'M78362', NULL, 76, 'Fajrin comment on meeting meet'),
(700, 72, NULL, 'M78362', NULL, 76, 'Fajrin comment on meeting meet'),
(701, 76, NULL, 'M78362', NULL, 72, 'raka comment on meeting meet'),
(702, 76, 'TA0067', NULL, NULL, 76, 'raka comment on task sub task'),
(703, 76, 'TA0067', NULL, NULL, 72, 'raka comment on task sub task'),
(704, 72, NULL, NULL, 'SM24581', 76, 'Fajrin comment on sub meeting meet'),
(705, 76, NULL, NULL, 'SM24581', 72, 'raka comment on sub meeting meet'),
(706, 72, NULL, 'M29862', NULL, 72, 'raka tagged you and 2 others in a meeting'),
(707, 76, 'TA6660', NULL, NULL, 72, 'raka comment on task task SENIN'),
(708, 76, 'TA6660', NULL, NULL, 76, 'raka comment on task task SENIN'),
(709, 76, 'TA6029', NULL, NULL, 72, 'raka comment on task SENIN'),
(710, 76, 'TA6029', NULL, NULL, 72, 'raka comment on task SENIN'),
(711, 76, 'TA6029', NULL, NULL, 76, 'raka comment on task SENIN'),
(712, 76, 'TA6029', NULL, NULL, 76, 'raka comment on task SENIN'),
(713, 76, 'TA6029', NULL, NULL, 76, 'raka comment on task SENIN'),
(714, 72, NULL, 'M78362', NULL, 76, 'Fajrin comment on meeting meet'),
(715, 76, 'TA6029', NULL, NULL, 72, 'raka comment on task SENIN'),
(716, 76, 'TA6029', NULL, NULL, 76, 'raka comment on task SENIN'),
(717, 79, NULL, 'M50467', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(718, 82, NULL, 'M50467', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(719, 72, NULL, 'M01746', NULL, 72, 'raka tagged you and 2 others in a meeting'),
(720, 79, NULL, 'M71833', NULL, 79, 'manager tagged you and 3 others in a meeting'),
(721, 82, NULL, 'M71833', NULL, 82, 'manager tagged you and 3 others in a meeting'),
(722, 74, NULL, '', NULL, 76, 'manager tagged you and 5 others in group Marketing'),
(723, 74, NULL, '', NULL, 76, 'manager tagged you and 5 others in group Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `code_room` varchar(50) NOT NULL DEFAULT '',
  `name_room` varchar(200) NOT NULL DEFAULT '',
  `max_people` int(11) NOT NULL DEFAULT 0,
  `status_booking` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`code_room`, `name_room`, `max_people`, `status_booking`) VALUES
('R1', 'Ruangan Meeting', 5, NULL),
('R2', 'Ruangan Tamu', 5, NULL),
('R3', 'Ruangan Baru', 8, NULL),
('R4', 'Room Baru', 10, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_meeting`
--

CREATE TABLE `sub_meeting` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `id_meeting` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_task` varchar(50) DEFAULT NULL,
  `id_group` int(11) DEFAULT NULL,
  `id_booking` int(11) DEFAULT NULL,
  `id_file` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `tag` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `time_start` datetime DEFAULT NULL,
  `time_end` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  `status_meeting` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_meeting`
--

INSERT INTO `sub_meeting` (`id`, `id_meeting`, `id_user`, `id_task`, `id_group`, `id_booking`, `id_file`, `title`, `description`, `date`, `time`, `tag`, `location`, `time_start`, `time_end`, `created_at`, `updated_at`, `status_meeting`) VALUES
('SM04204', 'M71162', 74, NULL, 23, 266, 329, 'Sub Luar Office', 'noteddd....', '2021-05-28', '13:47:00', NULL, 'Mobilio D 235 X', NULL, NULL, '2021-05-07 10:45:26', NULL, '1'),
('SM21723', 'M43303', 74, NULL, 23, 267, 330, 'Meeting sub baru', 'xxx', '2021-05-08', '03:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-07 11:21:42', NULL, NULL),
('SM80571', 'M79844', 74, NULL, 23, 265, 328, 'Sub office', 'ini noted ya.....', '2021-05-08', '11:37:00', NULL, 'Ruangan Meeting', NULL, NULL, '2021-05-07 10:37:43', NULL, NULL),
('SM23229', 'M18324', 74, NULL, 23, 254, 316, 'Judul Sub Meeting', 'ini deskripsi meeting', '2021-05-08', '09:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-06 14:09:11', NULL, NULL),
('SM82479', 'M43303', 74, NULL, 23, 259, 0, 'tets sub', 'tetts', '2021-05-08', '16:02:00', '', 'dia kok coba aja text nya apakah bza', NULL, NULL, '2021-05-06 15:02:44', NULL, '1'),
('SM63198', 'M43303', 74, NULL, 23, 260, 320, 'xx', 'xcxx', '2021-05-08', '09:00:00', '', 'bandung', NULL, NULL, '2021-05-07 10:14:11', NULL, NULL),
('SM30260', 'M18324', 74, NULL, 23, 277, 337, 'Sub meeting', 'xxxx', '2021-05-10', '09:00:00', '', NULL, NULL, NULL, '2021-05-08 12:51:08', NULL, NULL),
('SM21925', 'M43303', 74, NULL, 23, 280, 340, 'xx', 'xxx', '2021-05-31', '08:00:00', '', NULL, NULL, NULL, '2021-05-08 12:54:10', NULL, NULL),
('SM19889', 'M43303', 74, NULL, 23, 282, 342, 'xxx', 'xxx', '2021-05-21', '09:00:00', '', 'xx', NULL, NULL, '2021-05-08 13:02:26', NULL, NULL),
('SM67235', 'M43303', 74, NULL, 23, 285, 345, 'xx', 'xx', '2021-05-19', '05:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-08 13:06:19', NULL, NULL),
('SM86525', 'M12038', 74, NULL, 23, 286, 346, 'xx', 'xx', '2021-05-17', '06:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-08 13:07:04', NULL, NULL),
('SM32175', 'M43303', 61, NULL, 24, 291, 0, 'sub meeting testing bug', 'uji coba', '2021-05-31', '08:00:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-08 13:38:49', NULL, NULL),
('SM17156', 'M43303', 74, NULL, 23, 294, 0, 'sub meeting', 'test', '2021-05-31', '15:02:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-08 14:02:33', NULL, NULL),
('SM54180', 'M43303', 74, NULL, 23, 298, 0, 'sub', 'sub', '2021-05-22', '15:42:00', '', 'dev', NULL, NULL, '2021-05-08 14:43:06', NULL, NULL),
('SM37192', 'M18324', 74, NULL, 23, 301, 354, 'New Office', 'deksripsi meeting', '2021-05-27', '07:00:00', '', 'Ruangan Tamu', NULL, NULL, '2021-05-10 10:50:30', NULL, NULL),
('SM41680', 'M18324', 74, NULL, 23, 302, 354, 'New Sub Office ', 'deksripsi meeting', '2021-06-25', '06:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 10:51:58', NULL, NULL),
('SM88522', 'M12038', 74, NULL, 23, 303, 356, 'new sub outside', 'deskripsi...', '2021-06-10', '08:00:00', '', 'dd', NULL, NULL, '2021-05-10 10:56:18', NULL, NULL),
('SM13040', 'M16705', 74, NULL, 23, 304, 0, 'test', 'test', '2021-05-26', '12:35:00', '', 'tes', NULL, NULL, '2021-05-10 11:35:27', NULL, NULL),
('SM85464', 'M43303', 74, NULL, 23, 306, 0, 'sub', 'sub', '2021-05-27', '12:51:00', '', 'tes', NULL, NULL, '2021-05-10 11:51:23', NULL, NULL),
('SM59986', 'M16705', 74, NULL, 0, 307, 364, 'sub tes', 'sub', '2021-05-27', '12:51:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 11:52:19', NULL, NULL),
('SM58500', 'M16705', 74, NULL, 0, 308, 364, 'sub tes', 'sub', '2021-05-11', '13:02:00', '', 'tes', NULL, NULL, '2021-05-10 12:03:31', NULL, NULL),
('SM59726', 'M16705', 74, NULL, 0, 309, 364, 'sub tes', 'sub', '2021-05-12', '13:06:00', '', 'as', NULL, NULL, '2021-05-10 12:06:36', NULL, NULL),
('SM56063', 'M16705', 74, NULL, 23, 310, 0, 'teat', 'tes', '2021-05-12', '13:13:00', '', 'tes', NULL, NULL, '2021-05-10 12:14:00', NULL, NULL),
('SM92090', 'M12038', 74, NULL, 23, 311, 365, 'tes', 'tea', '2021-05-10', '13:14:00', '', 'tes', NULL, NULL, '2021-05-10 12:15:01', NULL, NULL),
('SM85883', 'M16705', 74, NULL, 23, 313, 366, 'twst', 'twa', '2021-05-13', '13:22:00', '', 'tes', NULL, NULL, '2021-05-10 12:22:59', NULL, NULL),
('SM69022', NULL, 74, NULL, 23, 0, 366, 'twst', 'twa', '2021-05-13', '13:22:00', '', 'tes', NULL, NULL, '2021-05-10 12:26:57', NULL, NULL),
('SM39889', NULL, 74, NULL, 23, 0, 366, 'twst', 'twa', '2021-05-13', '13:22:00', '', 'tes', NULL, NULL, '2021-05-10 12:38:00', NULL, NULL),
('SM42528', 'M16705', 74, NULL, 0, 314, 366, 'twst', 'twa', '2021-05-12', '13:38:00', '', 'tes', NULL, NULL, '2021-05-10 12:38:51', NULL, NULL),
('SM59183', 'M12038', 74, NULL, 23, 315, 0, 'twst', 'tws', '2021-05-11', '13:39:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 12:39:23', NULL, NULL),
('SM83671', 'M16705', 74, NULL, 23, 317, 368, 'Meeting lagi office', 'xxx', '2021-05-12', '09:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 14:50:10', NULL, NULL),
('SM51229', 'M16705', 74, NULL, 23, 318, 369, 'Sub Meeting outside', 'xxxx', '2021-05-13', '08:00:00', '', 'Bandung', NULL, NULL, '2021-05-10 14:52:04', NULL, NULL),
('SM27081', 'M16705', 74, NULL, 23, 321, 372, 'New Sub Office', 'deskripsi...', '2021-05-30', '09:00:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-10 15:03:48', NULL, NULL),
('SM87112', 'M16705', 74, NULL, 23, 322, 373, 'New sub outside', 'deskripsi....', '2021-05-26', '20:00:00', '', 'Jakarta', NULL, NULL, '2021-05-10 15:05:15', NULL, '1'),
('SM24581', 'M78362', 76, NULL, 25, 325, 0, 'meet', 'meet', '2021-05-17', '13:35:00', '', 'Ruangan Meeting', NULL, NULL, '2021-05-17 13:35:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `id_user` int(11) DEFAULT NULL,
  `id_meeting` varchar(50) DEFAULT NULL,
  `id_file` varchar(100) DEFAULT NULL,
  `id_group` varchar(50) DEFAULT NULL,
  `name_task` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status_task` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `id_user`, `id_meeting`, `id_file`, `id_group`, `name_task`, `description`, `due_date`, `time`, `status_task`) VALUES
('TA6816', 74, 'M78650', NULL, '23', 'Test Meeting Sabtu', 'okeyyy', '2021-05-21', '12:14:00', 'Y'),
('TA2378', 74, 'M43303', '', '23', 't', 't', '2021-05-08', '15:51:00', NULL),
('TA0429', 74, 'M01746', '', '23', 'task mobile sabtu', 'deskripsi', '2021-05-28', '06:00:00', 'Y'),
('TA7082', 74, 'SM32175', '', '23', 'task sub', 'desk', '2021-05-08', '16:59:00', 'Y'),
('TA5772', 74, 'M71790', '', '23', 'test', 'test', '2021-05-08', '14:37:00', 'Y'),
('TA4987', 74, 'M71833', '', '23', 'xx', 'xxx', '2021-05-22', '05:52:00', 'Y'),
('TA0913', 74, 'SM59986', NULL, '23', 'Task Sub test', 'okey', '2021-05-29', '12:15:00', 'Y'),
('TA2478', 74, 'M41645', '322', '23', 'xxx', 'xx', '2021-05-08', '12:00:00', NULL),
('TA9103', 74, 'M16705', '357', '23', 'New Task Meeting Office', 'okee', '2021-05-26', '12:00:00', 'Y'),
('TA5486', 74, 'M16705', '358', '23', 'New Task Outside', 'xxxx', '2021-05-22', '05:00:00', 'Y'),
('TA7201', 74, 'M90611', NULL, '23', 'Task Tes', 'he', '2021-05-19', '12:58:00', 'Y'),
('TA3461', 74, 'SM41680', '360', '23', 'New task Sub Outside', 'xx', '2021-05-20', '09:00:00', 'Y'),
('TA0255', 74, 'SM13040', '', '23', 'task sub meeting', 'test', '2021-05-10', '12:49:00', NULL),
('TA7093', 74, 'M70945', '363', '23', 'task meeting', 'task', '2021-05-10', '12:49:00', 'Y'),
('TA0067', 76, 'SM24581', '', '25', 'sub task', 'task', '2021-05-17', '14:43:00', NULL),
('TA6660', 76, 'M29862', '', '25', 'task SENIN', 'SENIN', '2021-05-17', '15:52:00', NULL),
('TA6029', 76, 'SM24581', '', '25', 'SENIN', 'SENIN', '2021-05-17', '14:54:00', NULL),
('TA3914', 74, 'M79721', NULL, '23', 'SENIN TASK MANAGER', 'TEST', '2021-05-17', '15:20:00', 'Y'),
('TA8275', 74, 'M90611', NULL, '23', 'ghghhhhh', 'hgggghhbhbjjhkki', '2021-05-17', '17:21:00', 'Y'),
('TA8408', 74, 'M79844', NULL, '23', 'sdliskjds', 'sdkjsjdskjsk', '2021-05-17', '18:22:00', 'Y'),
('TA4249', 76, 'M29862', '', '25', 'coba', 'coba', '2021-05-17', '14:32:00', NULL),
('TA5435', 74, 'SM92090', NULL, '23', 'task sub sabtu', 'okey', '2021-05-28', '11:27:00', 'Y'),
('TA3699', 74, 'M78572', NULL, '23', 'Test Task Meeting', 'okey', '2021-05-19', '12:51:00', NULL),
('TA1729', 74, 'M90611', NULL, '23', 'Nama Task Sabtu', 'okeyyyy', '2021-05-18', '13:55:00', NULL),
('TA3806', 74, 'SM88522', NULL, '23', 'Sub Meeting lagi', 'okeyyy', '2021-05-29', '15:59:00', NULL),
('TA5093', 74, 'M81589', NULL, '23', 'Coba lagi', 'okeyyy', '2021-05-28', '14:59:00', 'Y'),
('TA5217', 74, 'M01746', '', '23', 'xxx', 'xxx', '2021-05-18', '12:00:00', NULL),
('TA5345', 74, 'M01746', '', '23', 'test 20', 'xxx', '2021-05-20', '12:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_group` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `id_user`, `id_member`, `id_group`) VALUES
(98, 65, 41, 9),
(89, 62, 57, 5),
(101, 65, 72, 9),
(94, 73, 72, 8),
(58, 35, 37, NULL),
(102, 65, 55, 9),
(134, NULL, 74, 22),
(64, 32, 31, NULL),
(63, 32, 26, NULL),
(43, 21, 32, NULL),
(62, 32, 25, NULL),
(84, 61, 65, 1),
(112, 61, 66, 1),
(139, 61, 61, 24),
(131, NULL, 76, 21),
(117, 62, 78, 5),
(137, 74, 79, 23),
(136, NULL, 74, 23),
(120, 62, 62, 5),
(121, NULL, 61, 16),
(122, NULL, 61, 1),
(123, NULL, 61, 2),
(130, NULL, 74, 20),
(138, 74, 82, 23),
(132, 76, 72, 21),
(140, NULL, 76, 25),
(141, 76, 72, 25),
(143, 74, 56, 23),
(146, NULL, 74, 27);

-- --------------------------------------------------------

--
-- Table structure for table `transports`
--

CREATE TABLE `transports` (
  `id` varchar(50) NOT NULL DEFAULT '0',
  `id_image` int(11) DEFAULT NULL,
  `name_transport` varchar(50) DEFAULT NULL,
  `max_people` int(10) DEFAULT NULL,
  `status_booking` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transports`
--

INSERT INTO `transports` (`id`, `id_image`, `name_transport`, `max_people`, `status_booking`) VALUES
('T2', NULL, 'HIACE D 25252 WZ', 6, NULL),
('T1', NULL, 'Honda X D 235 X ', 5, NULL),
('T3', NULL, 'Karimun D 235 X', 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_image_profile` int(11) DEFAULT NULL,
  `id_image_background` int(11) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `whatsapp` varchar(50) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `user_aktif` int(11) DEFAULT NULL,
  `token_firebase` text DEFAULT NULL,
  `cookie` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_image_profile`, `id_image_background`, `name`, `email`, `username`, `phone`, `whatsapp`, `password`, `role`, `user_aktif`, `token_firebase`, `cookie`) VALUES
(2, NULL, NULL, 'administrator', 'admin@caturindo.com', 'admin', '081111111', '081111111', '$2y$12$.Ya9Oh5QpYczWxqoGbPu7eyt70AQsvR9SBBcvF6bg86Q869YdBleS', 1, 1, 'fdbUAERhTQ-HCuC_IX1NYi:APA91bF6q5FIKmnqmwh9zcVREEcLpoYIX_7dG6qu0PLUoKxmpLdI87NR_aFQ_05YyevD14ZCeeTGBip6BTLPj9Z-oFp4L94qko5uAYV2zInLuTjylF4n5kZEt8u481cWqx03VFKgrbmp', NULL),
(64, NULL, NULL, NULL, 'rani.herliani210@gmail.com', 'Rani', '089666910510', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', NULL, NULL, 'cMErlIbKSAGQf_Bu9WW4ag:APA91bEkuAZjc6R7jXMKqMOVj3neSe7BZMVQAtfVQAPplADkcue-tGGZSGmVTgYnSZUWjuCQwSVl33Sf2ng0sy19gYpl2NhqhCz0OnAQEGepwEsxag9gVuSkDxH-WUlE-ZKbAn3XOgMX', NULL),
(74, 376, 361, 'Andi R', 'andi@tokoweb.co', 'manager', '089888888', '0896675757', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'fgh52JBTTSGqBqwoB3FAi4:APA91bEDKdQqOPsYVZ-KjEbkap3IxRprdBQu7CzuAmgox1V0-2eTrHunm5o29Scmfx8ZUDhb9OqjVFli3hVlrOY_W0dELVvsGrH1OkH43DkvW8vopV0jdEtLzJ5lJO3qkARRSPM17YWo', '3JsV9GRy'),
(62, NULL, NULL, NULL, 'abas.zer12@gmail.com', 'basri', '085398038073', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'eaoIoR4ATMqhBs9MYB7wE3:APA91bEWY_TdLvuZrd_vxrJN3G27tETtduDcCeG6l06eQ1vXuqP7DsaEybK02nM1QJrS0NgpLMhJGXgpJ7OsWFej4pGHGe370q1L39FoXgXes54Y9f4QnWOtSLtHZDm4s2q1J_ZEhA3H', NULL),
(63, NULL, NULL, NULL, 'elizankvls21@gmail.com', 'Eliza Noviany Kusmayadi', '081214169825', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', NULL, NULL, 'cXttrKSERtu1Dt9k9uerIV:APA91bEnIFwWDBBTbqjs6QiKG5OtqKLXEJR5ah6Ag2XxgqKUqcoQ_Mmdwav6ersS8B9fg9ztio0yUIR5eMLyJC_pQW8CucCrnDyHMLlXYusTZurpq19l6X2YSpioxQp647UcghJrwRLP', NULL),
(41, NULL, NULL, NULL, 'K3@caturindo.com', 'feisal maulana akbar', '082240805046', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'fn1T_33OQxKPbFN6kAm-mB:APA91bF-9DdLgZI2uSut3_lfbnQuAq5cjGftmJxMGcommsmxOCXr3VvSVpKx5p2UYTxjHwPUeR9VAvo2mI9INZMynZk4qJEAmVo9yc-y3n7CFFD4uVN27xMnp_JirfIDlRXzUDq1zuFv', NULL),
(56, NULL, NULL, NULL, 'erwincrcv160411@gmail.com', 'Erwin', '087730305866', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'd1QGTmHaQ3O_sDUsv53pEi:APA91bHwCW8Jyz3_Tqi8ZB26m6q7veQf14kFS62AHa7FhIzVcc3ctU8BqODnauqKf5A_8VAQ20G9rOIj3ByoQNA50QbGu-bCBMwPdfhAv0QRxL82TEnqWvU6xge97lsA0W5X76EgZdhM', NULL),
(57, NULL, NULL, NULL, 'ginanjar.gf@gmail.com', 'ginanjar', '082178549948', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'f_5AwuAKStyMgOMdwdwlEU:APA91bFrRAnvC-WMjNoG2VCIAQWmINQeAgjIZXO7DBK7dHq1K-KzqYGvPZrAVw2ekMv1jr854WJ7RvE-bThhgGX2PS54UBAaGI4UHvBaP04-oASGCOADnQlZAkj3Ma2sVR0naLH5YiP5', NULL),
(58, NULL, NULL, NULL, 'asep.chandra7@gmail.com', 'Chandra1403', '08987144108', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'fs4OC9zXTPaQhwmbm8JprF:APA91bEBFWYhHgNU4dwzY9HX_qf4NIzUxbL-bwqA0OjcCRXEW06FzSOtMcE2IeGUNxt9mrO1PCpzl_Sg97Qm5cXla7ztfLmVr3ZoBCjFyijfC1KJ_4vzgpYhHxS2-Z0vMQg07NyTlFuq', NULL),
(59, NULL, NULL, NULL, 'depit.sugianto86@gmail.com', 'Depit SG', '089633962209', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'fWVJCfX0SGCGlj9GuWni4Y:APA91bFCUhix8ykoWs1NLdn5VU0M5hD5lgvB55WLiIMJBqpA51qR9JkGsUiALHhtvbzw9iTU4cF7teq-_YHl-e--D0HMdhilMFPauDeMLNMorviusmE9Su8vtc0V3qCeFefHEjXn8Bm8', NULL),
(60, NULL, NULL, NULL, 'andreas@melsa.net.id', 'Andreas T', '08112324242', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'dJvdMqvIS5qehOT1adqSrO:APA91bHbswDJWUQYQ7IIlB4Ui9UReFwsPNC1JLTJ7t8UFVvcqzVnHpaS0aG46a2H8RO5-89ADryC5fqwYjNBhW_ZRGUuHjiUHpOIAtsFKhVwpbqhC433jJRM3KpvcnQSLNFw5rMBl7Fy', NULL),
(61, 238, 166, 'nopezi saputra pratama', 'nopezisaputra@gmail.com', 'nopezi', '081943214722', '081943214722', '$2y$12$iD4s61Cix4kbQ6cPG2KNaeSJIJV1ujCMrmq/TPZXrbzZuALfXrx1.', 2, 1, 'dGaJVCEFQOmO1IDvfhLxRQ:APA91bGrD9wq3hgZFuv_FmWV9ItN8WMS0xHxG0azhxedrD627BTOMWXBPqGrSwTsvC91HIgyP1hWrp_xRj3X9bn5lJ5EXYvxlxU-A0RUEmiINx-6-DsoUkCffdEJH5NYqwf-1M4QnjF5', '56sag9Dy'),
(42, NULL, NULL, 'Febby Y', 'febby18041995@gmail.com', 'Zhaben', '087718618841', '087718618841', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'cXXcun-LSSi_gQjToZBy-1:APA91bE1UYMmEmN6lp3bFnwMzbCBsFe9fAlVvLAfJGKhJLzO9Sm5_eECjk7PT9hlOWogC3dg3LZefaz74-T11LM33EYLNesWNw3i9SbXI8Pj_GFm3o9pVQXeUHrZMxdzcsFoZmGOgV_K', NULL),
(43, NULL, NULL, NULL, 'zainalmuttaqin290595@gmail.com', 'Zainal Muttaqin', '083130400910', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'd8M7hgRjQu232r_e5MB-ZR:APA91bH30ErjQud3ThNB8yhFuFRIFR0Dsc7sAs2Pr6ItaUOJSL4UH5B-ieR5MA27QYXHddTJdObFVNDlznhGpyTGAfCgZtxarnZGNb1GbI4KZEt0CQS_yftf9wg2EsfrxpUroaS43ADw', NULL),
(44, NULL, NULL, NULL, 'yp.lukmansah@gmail.com', 'Yusep PL', '08999575116', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'f_jOTxX4R42-vr452VS30R:APA91bEmigGFOQUdAVWfuTsSxsSzH40uQM7SjbJcYe0i8iBJ-T7JnmGfZAlpAxlRyPRx6EALch2ZZ4eors85TWXkB95RdOFP6eEPGevXiNimUQQsrr_bID-7Tc0wt6puMNwbHWKcf_CS', NULL),
(45, NULL, NULL, NULL, 'virgangels@gmail.com', 'Lisda Lindawati', '085724226299', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'c_ITrtmQRW2aSwxERq4elF:APA91bHcgjeeqhlOLT_MsEUtQJAHwmn9qEuMbWXtfVcriu-Fa9TlIcu3etOXld5K-y0Pk5d_Ou1hp5KmJWDZH9d6nJvktyNegO563bkhtD3W84EEEI15LqiC17Eel9QO_O2g0CPxaaNm', NULL),
(46, NULL, NULL, 'Fajar Ferdiansyah', 'fajar.ferdiansyah07@gmail.com', 'Fajar', '081902417565', '081902417565', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'epeM7mteQAeeARy2K-F_JG:APA91bFT7wz0q3IeQEKcjA1EJnJgZFLLJXWX0_RdMF7U25oR5d_OG4DmYHqAtf9PQke4YFNVsRgZB6-woh5VlDYAWr_3d4Dv4uhgZGG-1v-wHG2V4a67pb0pear68nqMINUUKktVrJic', NULL),
(47, 109, NULL, 'risal faisal', 'risalf8@gmail.com', 'risal', '087802475449', '087802475449', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'c636bvw_SHaWcfxOs30lNs:APA91bHPVs_ByhiN-4cUxWJ_8R_C09kHJDnH1OwIO16GO1m77vomqR05qdf-Mx7GYpexJFsWkd2OeXu0V7sz-8UQgNUrHy1ekauoy_aAJ3HBXfF5oOO7M8gwM9Lr8iGt8gWzNM7QmrEF', NULL),
(48, NULL, NULL, NULL, 'destiapaulina@gmail.com', 'Destia', '081214131374', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'fXtK_R0ySpup82hl4_yT3x:APA91bFN9SgBjUz75--vBhq2qpkYoTkNfuC0H80jRCFu0KcFzxEQWp8wlYzN2Qj4iiUNW8FRlM-Kj329PypvAM3vM5J9Q77PbZyG8xQaoSIXrUUu6s0SJYd-p873UKpHZ2B9HDxw6ljR', NULL),
(50, NULL, NULL, NULL, 'garnapatriadika@gmail.com', 'Dika Garnapatria', '085221778779', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'f-E3Ih1KRqa0Nqpf3Bj1LB:APA91bGWhH9ak0XbERyVeyrPQMyEEMPL8ychNBsdRpTRYmGzz6aP20mShD5BLJ8JfS1SjAzDvpti3LAw-oPcJ6hxfoClsceRCVeX0K_WtJ5vwdsIIBjSKqFMvjWvVwPX7HCDT5YvTph-', NULL),
(52, NULL, NULL, 'Irfan', 'novendrairfan@gmail.com', 'irfan', '082115570606', '082115570606', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'fUl-VElXQoOT-2rFrCsCV2:APA91bGU_dVtdyTWH11OkA12lBAZY3VqFFfgTnJ9ebtZcOoCanLwzm3EPh85cFyDKTD16OpTaorBB4iHBAmmIv4_w4wzxPs8LzFpZ1UgKidSn5zTNwMzZdWgUbD5XszPx7B2wk-6Dxwi', NULL),
(53, NULL, NULL, NULL, 'diannugraha029@gmail.com', 'dian nugraha', '089617318395', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'e_T3-5kwRwakmkFCtLo0M3:APA91bF9oM-K7sOARjAzbjQfjID5qNHODdUteO9z3UpR5Sb-gDM0MQvOj8tu1PQ8wTugHRFY4hB8itSaBi__JTuucFAH8w1yC2a-eK-n7UAjSWXcjfipuXZ6tqYTiqKPwX8qhtuU6f5b', NULL),
(54, NULL, NULL, NULL, 'melyagustiani26@gmail.com', 'Mely Agustiani', '083866153821', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'f8LcO7nfQr-4umqwDE63_j:APA91bFZ64pLfzakUEFvKmALIqODdet38VgGK9DSN_gyAfH19bZUe0z-iUlEd_lOwwB85lH25s2cQFCyyezMjsJOOPBOfcC2ldQnWTFV7vfCiJF3eBjfcoYbpvML4Nefym_eEgHE1WX9', NULL),
(55, NULL, NULL, NULL, 'is.ihin@gmail.com', 'ihin', '0895357662952', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'cqdECrjNQcORKguUWzkGzQ:APA91bFjUDChUGl9Z86nGuh30oUVsOJlvN8Wcg5h97h9h-IhtbfemgqSYXwq-d37kUXIBec8fLiWNKBVq3dGGESPlxb-MhqCAFJpqVDqLhIiJXAHYVUrjfYDgTT0iypLFQAaEG3kzEur', NULL),
(82, NULL, NULL, NULL, 'staff@mail.com', 'staff27', '0885888888', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'eUsFWGiRSCeNgbYVFb-Sce:APA91bHdw0iGzFByNOdL8Ww4VqvIDHdvRuy26_fbZEKYOJpTWKVh9VOtVbCv90fYWuT2GhMqh1h8IWQEm2kwl-AgjdIvssTQmHEx5hNlPUx_3G1W7WUU8Dz8ML7FFaZilvUkJZwFrD9t', NULL),
(83, NULL, NULL, NULL, 'didinwahyudi04@gmail.com', 'didinw', '085703259802', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', NULL, NULL, 'e6MLMnMJRBCcGKvxbk-haW:APA91bE4ERwOV0EXy8cxtXK8kb3XBk37q8iK7i6tZ6iyyfcamcARu85KBZOm8emwtb1MuzL8JWyos8_oh20sBRYxEHbpRsC_uzRL_TX6qBmh4tKrmNSHYoruAqV7WD8WCzuTVBnlg7Z5', NULL),
(70, NULL, NULL, NULL, 'haris@tokoweb.co', 'fnharis', '08976732159', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'dZ7ltvOQQ2iXz5_Q7Q-ZAL:APA91bHbDZC9Dl4IrzGX5OwQUtCZWD8QTPn_1hxRSXq5N4OWWLmrsFJk8ZX-yYyKanBmJcCMCjeqRW_pdSIikBsgfMYBiT5cRFMclJkxs-JBP66_0tGNM-I5fqA20tx4ULXCNtjEnOyJ', NULL),
(72, NULL, NULL, 'fajrin', 'fajrin1245@gmail.com', 'Fajrin', '081221213131', '08122121313', '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'eZ1ubGVdTgm5_5MsJqS9Dl:APA91bHZOJcYnrJZNdbsxl2Z4BHvuY_fFrfKAEQLgnKOOX6BRCQxBsZKG-H5KlW79cZ8MF_ZCCpEeUgVPYvoF-Yl73Rsdd3w0wJSTeq1Jp09ugmfPULnkcsG6A0OHk2pjwbBHqH_k2T_', NULL),
(76, NULL, NULL, NULL, 'rakazzakaria22@gmail.com', 'raka', '089531910926', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'dl0MicrATyiKUaiI7XzLn_:APA91bGoBxNaIXx6GC-Q67Q1X0fStIb0uBufh0_pmUZLXS0H0YltCPF4tehTEyGi125aDE-6zzC_YRUx9ASZjoqsysCPnzDI7y0f9qsHj4WAh9pRWJfKtagxIQFyVCISEIpJOEIUK_pk', NULL),
(75, NULL, NULL, NULL, 'snopezi123@hotmail.com', 'tesya', '082373483819', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'dGaJVCEFQOmO1IDvfhLxRQ:APA91bFEHReqdJD0RKfsqiDdtwEZpj4HvpROxT4htF2cF2Uk4tOzxzuQUDYcWWXbb2BW-gLWlw_-lamPdJF-lkzncFWfj2E3TKOQ9Vg5p1pkyCVBWG3QWwcpJ5-v3PBZqpT7iFjUiaBL', NULL),
(77, NULL, NULL, NULL, 'tenthon69@gmail.com', 'tenton', '081212', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'dGaJVCEFQOmO1IDvfhLxRQ:APA91bFEHReqdJD0RKfsqiDdtwEZpj4HvpROxT4htF2cF2Uk4tOzxzuQUDYcWWXbb2BW-gLWlw_-lamPdJF-lkzncFWfj2E3TKOQ9Vg5p1pkyCVBWG3QWwcpJ5-v3PBZqpT7iFjUiaBL', NULL),
(78, NULL, NULL, NULL, 'gafaryasin11@gmail.com', 'gafar', '08454343464343', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 2, 1, 'eaoIoR4ATMqhBs9MYB7wE3:APA91bEWY_TdLvuZrd_vxrJN3G27tETtduDcCeG6l06eQ1vXuqP7DsaEybK02nM1QJrS0NgpLMhJGXgpJ7OsWFej4pGHGe370q1L39FoXgXes54Y9f4QnWOtSLtHZDm4s2q1J_ZEhA3H', NULL),
(79, NULL, NULL, NULL, 'rizki@tokoweb.co', 'rizki27', '08522582588', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', 3, 1, 'etVniPUmSSqch_H3XX1aIb:APA91bH4XibtFxnvkyf5PvaMIq4sZs4OlBVJsRrwee68yZXhrUUbtpjfZIvzfwTH5vpPcIMAQvVAPBvqWbQVfb7wPDg1MXEOE6wf0wU9V4qHjEciIPJJm0fg69mWmWGGuYNcx257pBtf', NULL),
(84, NULL, NULL, NULL, 'playstorecnx12345@gmail.com', 'johndeo', '6366784019', NULL, '$2y$12$g9Bz6lq7pp1xSYve0FR/wOTeg8cUUVBbe3214R1wsI5wWjC1no5P2', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Staf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_version`
--
ALTER TABLE `app_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_meeting`
--
ALTER TABLE `comment_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_sub_meeting`
--
ALTER TABLE `comment_sub_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_task`
--
ALTER TABLE `comment_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_team`
--
ALTER TABLE `group_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_rooms`
--
ALTER TABLE `image_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_transports`
--
ALTER TABLE `image_transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_meeting`
--
ALTER TABLE `member_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_submeeting`
--
ALTER TABLE `member_submeeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_task`
--
ALTER TABLE `member_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`code_room`);

--
-- Indexes for table `sub_meeting`
--
ALTER TABLE `sub_meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_version`
--
ALTER TABLE `app_version`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=334;

--
-- AUTO_INCREMENT for table `comment_meeting`
--
ALTER TABLE `comment_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `comment_sub_meeting`
--
ALTER TABLE `comment_sub_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `comment_task`
--
ALTER TABLE `comment_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=385;

--
-- AUTO_INCREMENT for table `group_team`
--
ALTER TABLE `group_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `image_rooms`
--
ALTER TABLE `image_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `image_transports`
--
ALTER TABLE `image_transports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `member_meeting`
--
ALTER TABLE `member_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `member_submeeting`
--
ALTER TABLE `member_submeeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `member_task`
--
ALTER TABLE `member_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=724;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
