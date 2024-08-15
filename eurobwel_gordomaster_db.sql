-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2024 at 08:02 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eurobwel_gordomaster_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `lottery_info`
--

CREATE TABLE `lottery_info` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `lottery_number` varchar(255) DEFAULT NULL,
  `balance` double DEFAULT NULL,
  `last_win` varchar(255) DEFAULT NULL,
  `comprobar_status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lottery_info`
--

INSERT INTO `lottery_info` (`id`, `name`, `email`, `password`, `lottery_number`, `balance`, `last_win`, `comprobar_status`) VALUES
(15, 'Sandra Logan', 'alifhossain174@gmail.com', '12345678', '211', 100, 'Maiores mollit excep', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `category_image` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_channels`
--

CREATE TABLE `tbl_channels` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `channel_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `channel_icon` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `channel_banner` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `source_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `source_url` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `views` int(11) NOT NULL,
  `channel_status` int(11) NOT NULL DEFAULT 1,
  `slider_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_settings`
--

CREATE TABLE `tbl_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_limit` varchar(255) DEFAULT NULL,
  `access` tinyint(4) NOT NULL DEFAULT 0,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `app_logo` text NOT NULL,
  `fcm_server_key` varchar(355) NOT NULL,
  `user_otp` varchar(5000) DEFAULT NULL,
  `header_title` varchar(6000) DEFAULT NULL,
  `variable_link` varchar(5000) DEFAULT NULL,
  `variable_image` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_settings`
--

INSERT INTO `tbl_settings` (`id`, `app_name`, `name`, `time_limit`, `access`, `username`, `password`, `api_key`, `app_logo`, `fcm_server_key`, `user_otp`, `header_title`, `variable_link`, `variable_image`) VALUES
(1, 'Gordo Master - Winner Club', 'Gordo Master', '2024-08-10 22:30:00', 0, 'Irfanmillion', 'admin86', 'apikeyapikey', 'images (7).png', '', '91847', 'Selected result number:', '29717', 'birthday_banner_balloons_9f6d430eb297253063db6d6780f357c1.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `email`, `status`) VALUES
(53, '634174416', 1),
(54, '635992609', 1),
(57, '631669365', 1),
(64, '34631119099', 1),
(65, '34631119099', 1),
(66, '34631119099', 1),
(69, '634182731', 1),
(73, '604289585', 1),
(75, '2948647166263', 1),
(76, '34635992609', 1),
(78, '34632635436', 1),
(79, '3663737377373', 1),
(80, '34632122258', 1),
(81, '632635436', 1),
(82, '29488', 1),
(83, '34634174416', 1),
(84, '18837', 1),
(85, '39052', 1),
(86, '50593', 1),
(87, '920558397', 1),
(88, '74734', 1),
(89, '613347945', 1),
(90, '29487', 1),
(91, '25047', 1),
(92, '39583', 1),
(93, '29583', 1),
(94, '16052', 1),
(95, '10498', 1),
(96, '613349745', 1),
(97, '632445263', 1),
(98, '24568', 1),
(99, '6134414606', 1),
(100, '198483', 1),
(101, '57092', 1),
(102, '675413634', 1),
(103, '57092', 1),
(104, '57092', 1),
(105, '463542', 1),
(106, '604351701', 1),
(107, '30493', 1),
(108, '10864', 1),
(109, '634140580', 1),
(110, '631507035', 1),
(111, '198473', 1),
(112, '19380', 1),
(113, '10386', 1),
(114, '108864', 1),
(115, '10894', 1),
(117, '1916323777', 1),
(118, '2872', 1),
(119, '2993', 1),
(120, '1234', 1),
(121, '631759588', 1),
(122, '40532', 1),
(123, '602801887', 1),
(124, '4312', 1),
(125, '28731', 1),
(126, '377277272', 1),
(127, '4650', 1),
(128, '4312', 1),
(129, '632502599', 1),
(130, '98987', 1),
(131, '26351', 1),
(132, '12345', 1),
(133, '613597690', 1),
(134, '29740', 1),
(135, '28734', 1),
(136, '28740', 1),
(137, '4810', 1),
(138, '1866683752', 1),
(139, '4810', 1),
(140, '4810', 1),
(141, '32619', 1),
(142, '32196', 1),
(143, '4810', 1),
(144, '32616', 1),
(145, '4810', 1),
(146, '42619', 1),
(147, '7206', 1),
(148, '4810', 1),
(149, '4810', 1),
(150, '78545', 1),
(151, '40539', 1),
(152, '28339', 1),
(153, '4810', 1),
(154, '15679', 1),
(155, '9650', 1),
(156, '95676', 1),
(157, '4810', 1),
(158, '97864', 1),
(159, '541256', 1),
(160, '1969005035', 1),
(161, '1969005035', 1),
(162, '1969005035', 1),
(163, '1969005035', 1),
(164, '1969005035', 1),
(165, '1969005035', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` int(11) NOT NULL,
  `otp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_otp`
--

INSERT INTO `user_otp` (`id`, `otp`) VALUES
(34, 62957),
(35, 10845),
(36, 90140),
(37, 58139),
(38, 10467),
(39, 7592),
(40, 30742),
(41, 10864),
(42, 10864),
(43, 42629),
(44, 30582),
(45, 16487),
(46, 10783),
(47, 29840),
(48, 93029),
(49, 19380),
(50, 30493),
(52, 89126),
(55, 26351),
(56, 28734),
(57, 4312),
(58, 4650),
(59, 75345),
(60, 40532),
(62, 40539),
(63, 4810),
(64, 4312);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lottery_info`
--
ALTER TABLE `lottery_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_channels`
--
ALTER TABLE `tbl_channels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lottery_info`
--
ALTER TABLE `lottery_info`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_channels`
--
ALTER TABLE `tbl_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_settings`
--
ALTER TABLE `tbl_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
