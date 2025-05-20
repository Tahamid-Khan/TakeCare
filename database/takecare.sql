-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2024 at 11:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takecare`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` timestamp NULL DEFAULT NULL,
  `check_out` timestamp NULL DEFAULT NULL,
  `total_hours` time DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('present','absent','leave') NOT NULL DEFAULT 'present',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `check_in`, `check_out`, `total_hours`, `date`, `status`, `created_at`, `updated_at`) VALUES
(11, 1, '2008-09-28 15:39:55', '2020-06-13 11:59:16', '12:32:06', '2024-05-19', 'present', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(12, 1, '1976-11-30 17:00:27', '2021-04-17 13:46:56', '05:39:20', '2024-05-19', 'absent', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(13, 1, '2016-06-17 07:57:24', '1992-09-09 22:34:39', '10:25:00', '2024-05-19', 'present', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(14, 1, '1989-11-24 20:10:19', '1981-05-21 15:54:42', '15:29:38', '2005-02-02', 'absent', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(15, 1, '2021-12-13 07:23:04', '2015-08-02 07:31:37', '19:44:16', '1987-10-05', 'leave', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(16, 1, '1994-04-13 08:30:10', '1995-03-01 15:12:50', '20:28:31', '2023-05-19', 'present', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(17, 1, '1979-04-21 17:53:23', '1992-01-25 11:36:10', '12:44:10', '1970-06-29', 'leave', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(18, 1, '1998-07-27 06:09:51', '2003-11-20 15:40:06', '15:04:19', '1985-12-28', 'leave', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(19, 1, '2012-03-12 21:35:19', '2016-09-27 05:44:45', '17:46:11', '1973-02-12', 'absent', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(20, 1, '1985-11-24 10:46:38', '1991-04-28 10:19:45', '02:28:15', '1997-01-17', 'absent', '2024-05-18 18:36:37', '2024-05-18 18:36:37'),
(21, 1, '2009-01-30 00:03:29', '2023-02-06 08:43:43', '16:42:30', '2013-08-08', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(22, 1, '1984-11-05 04:28:03', '2013-12-19 15:45:08', '14:12:24', '1984-03-01', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(23, 1, '2017-12-21 22:14:21', '1993-05-18 12:18:27', '11:29:32', '1999-03-22', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(24, 1, '1971-08-13 21:57:22', '1978-01-21 21:46:05', '17:25:51', '1988-10-18', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(25, 1, '1981-06-05 11:00:46', '2023-11-27 10:15:41', '13:25:48', '1989-02-09', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(26, 1, '1973-05-02 09:16:57', '1978-09-02 20:47:21', '15:41:47', '2023-10-27', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(27, 1, '2014-01-11 22:05:58', '1970-02-06 12:49:12', '20:26:51', '2009-01-28', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(28, 1, '2006-10-28 15:58:16', '1993-08-10 08:25:39', '03:40:01', '1997-01-20', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(29, 1, '2008-10-13 09:43:54', '1984-01-07 01:32:13', '05:10:48', '1993-06-01', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(30, 1, '1980-05-02 17:38:03', '2002-09-01 05:05:17', '15:58:53', '1988-11-12', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(31, 1, '2021-06-18 00:31:04', '2018-08-22 11:35:21', '07:14:27', '2004-12-31', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(32, 1, '1988-12-18 07:28:13', '2003-06-26 19:50:11', '00:56:48', '2019-10-29', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(33, 1, '2006-07-12 19:34:08', '2023-12-10 03:28:44', '19:03:35', '1985-04-21', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(34, 1, '2002-05-27 03:10:27', '1997-02-16 14:50:13', '09:32:09', '1997-05-15', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(35, 1, '1982-01-31 10:57:34', '1979-02-03 05:34:04', '14:41:19', '2000-08-28', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(36, 1, '2008-11-20 23:19:50', '2001-01-12 17:35:17', '08:18:49', '1999-01-10', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(37, 1, '1977-12-14 14:54:47', '1997-08-02 11:10:01', '03:18:52', '2013-06-14', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(38, 1, '1977-09-03 23:07:14', '1989-03-02 12:07:51', '11:12:33', '1977-03-27', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(39, 1, '2003-05-09 17:46:27', '2006-01-05 10:50:18', '17:31:53', '1986-04-11', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(40, 1, '2013-07-20 04:00:49', '1992-02-16 01:45:27', '01:54:25', '1978-05-16', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(41, 1, '1982-10-17 17:41:57', '1995-03-04 06:55:37', '05:54:53', '1992-02-04', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(42, 1, '2021-05-10 16:34:23', '2008-09-09 10:58:30', '17:48:38', '1998-04-07', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(43, 1, '1997-03-13 03:08:25', '2010-10-18 16:18:13', '06:28:05', '1985-09-28', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(44, 1, '2021-12-14 22:14:05', '2012-10-14 10:12:28', '07:14:55', '1984-04-04', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(45, 1, '1996-04-06 17:23:55', '2008-05-16 11:40:14', '23:44:05', '2010-06-22', 'leave', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(46, 1, '2014-06-27 17:54:38', '2005-03-12 06:51:34', '22:12:57', '2020-07-30', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(47, 1, '1987-08-22 07:55:25', '1989-12-15 18:54:22', '15:47:04', '2019-08-01', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(48, 1, '1999-12-25 23:00:03', '2011-10-22 12:15:47', '01:27:40', '1986-03-23', 'present', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(49, 1, '2017-05-06 15:06:26', '1972-05-17 14:35:51', '08:26:00', '1999-09-19', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(50, 1, '2001-12-15 07:27:31', '1999-05-22 14:27:02', '05:12:07', '1993-04-17', 'absent', '2024-05-19 18:58:35', '2024-05-19 18:58:35'),
(51, 1, '2003-01-03 05:02:51', '1976-05-18 08:05:21', '07:42:36', '1985-02-20', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(52, 1, '2018-05-15 00:56:04', '1997-05-28 21:08:20', '19:28:26', '2019-06-18', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(53, 1, '2017-05-19 15:58:22', '1998-10-12 16:04:38', '15:08:49', '1990-01-09', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(54, 1, '2006-03-16 22:05:05', '2010-11-02 06:19:22', '01:25:46', '1989-05-19', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(55, 1, '2008-10-01 19:50:18', '2007-08-24 15:28:46', '22:05:02', '1973-02-22', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(56, 1, '1973-04-22 09:12:48', '1999-09-30 23:41:09', '08:13:11', '1990-04-17', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(57, 1, '2000-10-12 07:39:23', '2005-07-08 00:11:39', '19:17:20', '2011-01-06', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(58, 1, '1981-06-05 10:36:28', '2022-08-29 14:50:36', '18:14:40', '2004-10-16', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(59, 1, '2007-12-28 14:49:47', '2015-12-02 16:33:28', '11:55:26', '1976-09-30', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(60, 1, '1973-08-13 07:52:18', '2020-03-27 14:08:47', '22:25:44', '1974-04-30', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(61, 1, '1991-11-30 20:28:30', '1982-03-10 03:15:39', '12:14:12', '2010-09-22', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(62, 1, '1974-01-25 01:15:57', '1977-11-09 15:29:17', '10:58:14', '2011-06-20', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(63, 1, '2020-01-28 00:26:56', '2021-05-28 10:40:10', '17:52:08', '2001-03-07', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(64, 1, '2011-12-12 10:01:14', '1971-07-09 10:34:38', '05:08:17', '2014-09-23', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(65, 1, '1978-05-03 14:16:10', '1997-12-01 04:39:07', '14:13:57', '2019-10-20', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(66, 1, '1990-04-04 06:51:58', '2000-12-15 00:48:33', '14:37:18', '1987-05-03', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(67, 1, '2006-07-02 11:04:36', '1970-04-26 16:43:11', '11:00:41', '2007-03-03', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(68, 1, '2000-02-16 17:49:59', '1971-12-24 17:04:10', '23:52:28', '1975-07-05', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(69, 1, '1978-12-08 05:44:49', '2023-09-10 15:13:45', '12:24:35', '2007-09-08', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(70, 1, '1996-02-09 03:30:50', '1987-02-02 02:18:18', '19:18:41', '2021-02-27', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(71, 1, '1997-08-10 00:19:21', '2001-04-02 03:51:44', '13:47:47', '1983-06-06', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(72, 1, '1988-05-15 08:31:51', '2008-12-08 23:22:45', '03:47:24', '2006-06-05', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(73, 1, '2022-02-16 20:57:02', '1987-10-17 05:32:15', '20:48:13', '1983-09-30', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(74, 1, '1995-12-12 20:56:28', '1996-12-15 00:27:26', '12:35:27', '2003-04-07', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(75, 1, '2004-01-30 20:15:29', '1982-07-07 20:02:30', '15:56:24', '2011-08-29', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(76, 1, '1996-01-10 08:35:42', '1991-03-25 00:40:41', '16:49:52', '1970-05-17', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(77, 1, '1970-09-09 04:37:18', '2002-10-09 17:08:57', '20:04:42', '1998-05-16', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(78, 1, '2018-05-03 15:19:45', '2017-09-01 00:34:31', '00:51:37', '2006-03-24', 'absent', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(79, 1, '2010-01-06 09:54:54', '1998-01-19 17:16:47', '04:24:25', '2003-04-08', 'leave', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(80, 1, '2009-08-04 20:34:36', '2000-05-11 19:02:21', '12:10:09', '2014-10-12', 'present', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(81, 1, '1989-01-30 01:42:52', '2004-02-22 00:57:05', '16:04:50', '1977-11-28', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(82, 1, '1999-09-09 04:45:36', '2014-10-14 00:57:49', '17:05:12', '1971-04-24', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(83, 1, '1998-06-08 20:45:56', '2021-10-10 07:43:46', '20:01:39', '1988-06-23', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(84, 1, '2014-06-12 09:23:33', '2017-12-29 11:50:33', '18:36:38', '1994-06-29', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(85, 1, '1989-08-02 08:45:46', '1982-09-17 05:54:30', '23:04:54', '2014-12-27', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(86, 1, '1993-04-24 16:07:07', '2010-07-22 14:34:33', '12:40:58', '1998-01-19', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(87, 1, '1993-09-25 19:50:53', '1980-09-13 02:16:30', '07:24:10', '1972-02-24', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(88, 1, '1972-02-14 06:04:21', '2003-06-06 18:28:33', '17:21:37', '1975-02-17', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(89, 1, '1995-10-27 12:35:03', '2001-07-09 00:34:28', '07:20:49', '1984-10-30', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(90, 1, '2019-09-05 13:23:11', '1971-04-08 15:04:13', '19:41:41', '1998-10-16', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(91, 1, '2002-02-24 05:55:29', '2010-09-18 21:13:33', '13:18:33', '1980-07-29', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(92, 1, '1991-08-04 13:12:03', '2023-12-02 13:07:31', '13:35:05', '2022-09-07', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(93, 1, '2005-01-09 06:18:46', '1986-05-17 13:20:28', '17:37:57', '2004-04-07', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(94, 1, '2003-04-09 00:05:13', '1988-07-20 10:54:38', '17:08:13', '2005-04-10', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(95, 1, '1988-07-23 09:00:36', '1980-03-17 03:28:54', '05:14:45', '1994-01-13', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(96, 1, '2020-09-12 01:31:23', '1985-11-02 13:47:32', '10:33:36', '1997-08-24', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(97, 1, '1989-09-16 06:25:45', '2023-05-12 20:16:52', '07:32:44', '1979-02-02', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(98, 1, '1987-08-17 10:30:11', '1984-08-21 07:02:20', '01:18:41', '1992-06-05', 'absent', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(99, 1, '1979-07-14 23:13:16', '1979-03-01 10:23:08', '22:55:25', '1991-08-16', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(100, 1, '1977-07-12 12:18:23', '1989-12-04 12:53:59', '04:20:16', '2017-07-16', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(101, 1, '2013-08-26 15:33:44', '1976-12-05 02:47:55', '07:58:14', '2006-11-07', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(102, 1, '1979-03-23 06:52:51', '1986-08-15 21:16:56', '22:38:50', '1999-03-01', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(103, 1, '1984-03-07 02:14:59', '1992-09-22 15:47:23', '12:45:48', '2004-03-25', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(104, 1, '2005-07-14 11:26:30', '2023-12-26 07:03:44', '08:28:12', '1986-07-20', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(105, 1, '2001-02-24 22:07:40', '2010-12-17 15:45:34', '14:03:42', '1986-07-01', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(106, 1, '2001-06-21 00:45:09', '2018-11-28 18:25:37', '00:56:24', '1976-04-22', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(107, 1, '1976-02-23 16:48:41', '1989-10-25 10:23:02', '08:47:33', '1989-07-27', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(108, 1, '2013-03-10 07:54:52', '1992-06-15 20:38:36', '06:32:33', '1970-01-24', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(109, 1, '1986-05-06 15:38:46', '2016-05-11 07:40:50', '21:12:27', '2023-03-12', 'present', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(110, 1, '1982-09-26 07:01:36', '1973-04-21 11:30:33', '11:51:42', '1988-12-10', 'leave', '2024-06-08 08:42:45', '2024-06-08 08:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `beds`
--

CREATE TABLE `beds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ward_id` bigint(20) UNSIGNED NOT NULL,
  `bed_number` int(11) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `bed_status` varchar(255) NOT NULL,
  `patient_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beds`
--

INSERT INTO `beds` (`id`, `ward_id`, `bed_number`, `bed_type`, `bed_status`, `patient_id`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 'Basic', 'empty', NULL, '2024-07-26 20:46:59', '2024-07-26 20:49:31'),
(2, 1, 11, 'Basic', 'occupied', NULL, '2024-07-26 20:47:08', '2024-07-26 20:58:29'),
(3, 2, 112, 'Emergency', 'occupied', NULL, '2024-07-26 20:47:35', '2024-07-26 21:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `cavin_wards`
--

CREATE TABLE `cavin_wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cavin_wards`
--

INSERT INTO `cavin_wards` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '203', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `limit_emp` varchar(255) DEFAULT NULL,
  `total_emp` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive, 1 = active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `limit_emp`, `total_emp`, `status`, `created_at`, `updated_at`) VALUES
(1, 'CTA', '5', '2', 1, '2024-03-14 10:59:43', '2024-05-29 13:20:56');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` varchar(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `availableTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctor_id`, `department_id`, `name`, `type`, `created_at`, `updated_at`, `specialization`, `contactNumber`, `address`, `availableTime`) VALUES
(1, 'D001', 1, 'Dr Motin', 'duty_doctor', NULL, NULL, NULL, '+88312412', NULL, NULL),
(2, 'D002', 1, 'Dr John Doe', 'duty_doctor', NULL, NULL, NULL, '+4123431', NULL, NULL),
(3, 'V001', 1, 'Dr Motinsda', 'visiting_doctor', NULL, NULL, NULL, NULL, NULL, NULL),
(4, '', 1, 'Dr John Doedas', 'opd', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'P001', 1, 'Dr Motin', 'pow_doctor', NULL, NULL, NULL, '+88312412', NULL, NULL),
(6, 'P002', 1, 'Dr John Doe', 'pow_doctor', NULL, NULL, NULL, '+4123431', NULL, NULL),
(7, 'P004', 1, 'Dr Motinsda', 'pow_doctor', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'O001', 1, 'Dr Motin', 'opd_doctor', NULL, NULL, NULL, '+88312412', NULL, NULL),
(9, 'P002', 1, 'Dr John Doe', 'opd_doctor', NULL, NULL, NULL, '+4123431', NULL, NULL),
(10, 'P004', 1, 'Dr Motinsda', 'opd_doctor', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'O001', 1, 'Dr Motin', 'icu_doctor', NULL, NULL, NULL, '+88312412', NULL, NULL),
(12, 'P002', 1, 'Dr John Doe', 'icu_doctor', NULL, NULL, NULL, '+4123431', NULL, NULL),
(13, 'P004', 1, 'Dr Motinsda', 'icu_doctor', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'O001', 1, 'Dr Motin', 'ot_doctor', NULL, NULL, NULL, '+88312412', NULL, NULL),
(15, 'P002', 1, 'Dr John Doe', 'ot_doctor', NULL, NULL, NULL, '+4123431', NULL, NULL),
(16, 'P004', 1, 'Dr Motinsda', 'ot_doctor', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` char(255) NOT NULL,
  `name` char(255) NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `gender` char(255) NOT NULL COMMENT 'Male,Female,Others',
  `date_of_birth` date NOT NULL,
  `religion` char(255) NOT NULL COMMENT 'Muslim,Hindu,Buddhist,Christian,Others',
  `mobile_no` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `blood_group` char(255) DEFAULT NULL COMMENT 'A+, A-,B+,B-,AB+,AB-,O+,O-',
  `joining_date` date NOT NULL,
  `address` text DEFAULT NULL,
  `showcases` text NOT NULL,
  `summery` text DEFAULT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `salary_scale` varchar(255) NOT NULL,
  `type` char(255) NOT NULL COMMENT 'Permanent,Temporary',
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive,1= active',
  `hr_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `emp_id`, `name`, `department_id`, `gender`, `date_of_birth`, `religion`, `mobile_no`, `email`, `blood_group`, `joining_date`, `address`, `showcases`, `summery`, `basic_salary`, `salary_scale`, `type`, `photo`, `status`, `hr_type`, `created_at`, `updated_at`) VALUES
(1, '102', 'Md Sohag Hosen', 1, 'Male', '1999-02-10', 'Muslim', '01716647919', 'sohaghosenemon@gmail.com', 'B+', '2024-03-14', '11/12, Road 1, Kaderabad Housing, Mohammadpur', 'Good', 'Great', '30000', '12', 'Permanent', NULL, 1, 'Staff', '2024-03-14 11:02:19', NULL),
(2, '103', 'Md Sohag Hosen', 1, 'Male', '1999-02-10', 'Muslim', '01716647919', 'sohaghosenemon@gmail.com', 'B+', '2024-03-14', '11/12, Road 1, Kaderabad Housing, Mohammadpur', 'Good', 'Great', '30000', '12', 'Permanent', NULL, 1, 'Staff', '2024-03-14 11:02:19', NULL),
(3, 'Non in autem dolor v', 'Jenna Morris', 1, 'Female', '1999-07-19', 'Other', '7', 'tekega@mailinator.com', 'B-', '1991-12-11', 'Nostrum odit rerum a', 'Animi est voluptas', 'Dolore omnis consequ', '32', 'Expedita molestias c', 'Permanent', NULL, 1, NULL, '2024-05-29 13:20:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_leaves`
--

CREATE TABLE `employee_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `sick_leave` int(11) NOT NULL DEFAULT 0,
  `casual_leave` int(11) NOT NULL DEFAULT 0,
  `marital_leave` int(11) NOT NULL DEFAULT 0,
  `total_leave` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_leaves`
--

INSERT INTO `employee_leaves` (`id`, `employee_id`, `sick_leave`, `casual_leave`, `marital_leave`, `total_leave`, `created_at`, `updated_at`) VALUES
(1, 2, 6, 5, 4, 4, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(2, 1, 0, 1, 7, 7, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(3, 2, 10, 6, 4, 1, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(4, 2, 9, 0, 1, 8, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(5, 1, 7, 9, 6, 9, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(6, 1, 7, 1, 1, 5, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(7, 2, 3, 0, 7, 0, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(8, 2, 0, 2, 7, 2, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(9, 1, 1, 10, 5, 4, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(10, 2, 10, 10, 1, 10, '2024-05-19 18:23:34', '2024-05-19 18:23:34'),
(11, 1, 3, 6, 5, 3, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(12, 2, 7, 1, 2, 3, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(13, 1, 6, 6, 7, 5, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(14, 2, 1, 3, 9, 3, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(15, 2, 8, 2, 5, 9, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(16, 2, 3, 4, 0, 7, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(17, 2, 9, 4, 9, 3, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(18, 1, 10, 4, 6, 10, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(19, 2, 7, 6, 10, 1, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(20, 1, 10, 2, 1, 5, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(21, 1, 9, 5, 8, 0, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(22, 1, 9, 6, 2, 1, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(23, 1, 0, 10, 0, 7, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(24, 2, 3, 2, 9, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(25, 1, 10, 2, 4, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(26, 1, 3, 0, 3, 3, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(27, 2, 3, 0, 4, 8, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(28, 1, 4, 2, 0, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(29, 2, 6, 8, 5, 2, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(30, 2, 5, 9, 1, 6, '2024-06-08 08:42:45', '2024-06-08 08:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `emp_histories`
--

CREATE TABLE `emp_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `history` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leaves`
--

CREATE TABLE `emp_leaves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `total_leave` varchar(255) NOT NULL,
  `sick_leave` varchar(255) NOT NULL,
  `casual_leave` varchar(255) NOT NULL,
  `anual_leave` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emp_shifts`
--

CREATE TABLE `emp_shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `shift` char(255) NOT NULL COMMENT 'Morning,Evening,Night',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_out_logs`
--

CREATE TABLE `in_out_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `time_calc` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `i_c_u_patients`
--

CREATE TABLE `i_c_u_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `isICU` tinyint(1) NOT NULL DEFAULT 1,
  `bed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `referredHospital` varchar(255) DEFAULT NULL,
  `isDischarged` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `i_c_u_patients`
--

INSERT INTO `i_c_u_patients` (`id`, `patient_id`, `isICU`, `bed_id`, `doctor_id`, `referredHospital`, `isDischarged`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 11, NULL, 0, '2024-07-26 20:58:29', '2024-07-26 20:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_08_23_185057_create_zkteco_devices_table', 1),
(4, '2021_08_23_185624_create_in_out_logs_table', 1),
(5, '2022_01_11_111437_update_users', 1),
(6, '2023_09_11_204538_create_teacher_staff_info_table', 1),
(7, '2023_12_10_185817_create_doctors_table', 1),
(8, '2023_12_10_203024_create_cavin_wards_table', 1),
(9, '2023_12_10_203619_create_patients_table', 1),
(10, '2023_12_10_210929_create_pathologys_table', 1),
(11, '2023_12_10_211832_create_test_list_table', 1),
(12, '2023_12_21_040821_update_pathologys_table', 1),
(13, '2023_12_22_053919_create_tubes_table', 1),
(14, '2023_12_22_062518_add_status_to_pathologys_table', 1),
(15, '2023_12_23_231846_create_departments_table', 1),
(16, '2024_01_16_211255_create_employees_table', 1),
(17, '2024_01_16_214644_create_emp_histories_table', 1),
(18, '2024_05_09_211646_create_previous_histories_table', 1),
(19, '2024_05_09_214157_add_column_to_doctors_table', 1),
(20, '2024_05_09_232523_create_patient_medicines_table', 1),
(21, '2024_05_12_213849_create_patient_daily_summaries_table', 1),
(22, '2024_05_12_213908_create_patient_statuses_table', 1),
(23, '2024_05_14_170359_add_column_to_employees_table', 1),
(24, '2024_05_19_001824_create_attendances_table', 1),
(25, '2024_05_20_001855_create_employee_leaves_table', 1),
(26, '2024_05_21_185617_create_o_p_d_patients_table', 1),
(27, '2024_05_21_185642_create_o_p_d_patient_serials_table', 1),
(28, '2024_05_21_185702_create_o_p_d_prescriptions_table', 1),
(29, '2024_05_21_185715_create_o_p_d_medicines_table', 1),
(30, '2024_05_22_190652_add_department_id_to_doctors_table', 1),
(31, '2024_05_22_192027_add_status_to_o_p_d_patient_serials_table', 1),
(32, '2024_05_25_144751_update_previous_histories_table', 1),
(33, '2024_06_06_170948_create_patient_doctor_assignments_table', 1),
(34, '2024_06_06_171710_add_doctor_id_column_to_doctors_table', 1),
(35, '2024_06_07_150507_add_columns_to_doctors_table', 1),
(41, '2024_07_09_211330_create_wards_table', 2),
(42, '2024_07_09_211433_create_beds_table', 2),
(43, '2024_07_09_211507_create_operations_table', 2),
(44, '2024_07_09_211536_create_p_o_w_patients_table', 2),
(45, '2024_07_09_211551_create_i_c_u_patients_table', 3),
(46, '2024_07_23_222709_create_store_departments_table', 4),
(47, '2024_07_23_222729_create_store_item_types_table', 4),
(48, '2024_07_23_222757_create_store_products_table', 4),
(49, '2024_07_23_222810_create_store_inventories_table', 4),
(50, '2024_07_23_222832_create_store_inventory_update_logs_table', 4),
(51, '2024_07_23_222851_create_store_invoices_table', 4),
(52, '2024_07_23_222905_create_store_material_requests_table', 4),
(53, '2024_07_26_181014_add_column_to_store_products_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `operations`
--

CREATE TABLE `operations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `iscomplete` tinyint(1) NOT NULL DEFAULT 0,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `operation_date` date NOT NULL,
  `operation_time` time NOT NULL,
  `operation_name` varchar(255) DEFAULT NULL,
  `operation_type` varchar(255) DEFAULT NULL,
  `operation_status` varchar(255) DEFAULT NULL,
  `operation_result` varchar(255) DEFAULT NULL,
  `operation_remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operations`
--

INSERT INTO `operations` (`id`, `patient_id`, `iscomplete`, `doctor_id`, `operation_date`, `operation_time`, `operation_name`, `operation_type`, `operation_status`, `operation_result`, `operation_remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 14, '2024-07-29', '19:04:00', 'Heart Surgery', 'Test', NULL, NULL, NULL, '2024-07-26 21:00:57', '2024-07-26 21:01:32'),
(2, 2, 0, 14, '2024-07-31', '19:04:00', 'Heart Surgery', 'Test', NULL, NULL, NULL, '2024-07-26 21:00:57', '2024-07-26 21:00:57');

-- --------------------------------------------------------

--
-- Table structure for table `o_p_d_medicines`
--

CREATE TABLE `o_p_d_medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_prescription_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `schedule` varchar(255) NOT NULL,
  `taking_time` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `store_type` enum('CentralStore','OutdoorStore') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `o_p_d_patients`
--

CREATE TABLE `o_p_d_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_p_d_patients`
--

INSERT INTO `o_p_d_patients` (`id`, `patient_id`, `name`, `age`, `gender`, `mobile`, `address`, `created_at`, `updated_at`) VALUES
(11, 'OPD000001', 'Cruz Marshall', 32, 'male', '106', NULL, '2024-05-22 11:31:36', '2024-05-22 11:31:36'),
(12, 'OPD000002', 'Plato Benton', 100, 'other', '361', NULL, '2024-05-22 11:33:33', '2024-05-22 11:33:33'),
(13, 'OPD000003', 'Herman Sykes', 51, 'other', '18126388616', 'Veniam ex expedita', '2024-05-22 11:58:22', '2024-05-22 11:58:22'),
(14, 'OPD000004', 'Brynn Browning', 35, 'male', '18126388616', 'Veniam aliquam sed', '2024-05-22 12:09:22', '2024-05-22 12:09:22'),
(15, 'OPD000005', 'Veronica Daniels', 77, 'other', '17681665821', 'Illum minima est ip', '2024-05-22 12:43:10', '2024-05-22 12:43:10'),
(20, 'OPD000006', 'Rae Burch', 44, 'female', '2134', 'Qui sint tempora qu', '2024-05-22 13:14:04', '2024-05-22 13:14:04'),
(21, 'OPD000007', 'Mariko Nelson', 43, 'male', '2345', 'Ea incididunt corpor', '2024-05-22 13:14:21', '2024-05-22 13:14:21'),
(22, 'OPD000008', 'Ferris Shepherd', 64, 'other', '234', 'Ullam et unde vel sa', '2024-05-22 13:15:50', '2024-05-22 13:15:50'),
(29, 'OPD000009', 'Bert Holloway', 89, 'female', '3456', 'Sit id tempora sed f', '2024-05-22 13:18:50', '2024-05-22 13:18:50'),
(30, 'OPD000010', 'Elaine Gilbert', 3, 'female', '53462', 'Est odit quis deser', '2024-05-22 13:19:00', '2024-05-22 13:19:00'),
(31, 'OPD000011', 'Kaseem Cleveland', 47, 'other', '16966388965', 'Sit aut cumque dolor', '2024-05-26 06:54:00', '2024-05-26 06:54:00'),
(32, 'OPD000012', 'Caldwell Burns', 92, 'male', '12542429636', 'Aliqua Dolorum id', '2024-05-26 06:54:46', '2024-05-26 06:54:46'),
(34, 'OPD000013', 'Willow Erickson', 40, 'male', '1254242963', 'Ullamco dolorem comm', '2024-05-26 06:54:58', '2024-05-26 06:54:58'),
(35, 'OPD000014', 'Okey Kulas', 12, NULL, '+1-283-537-5008', '296 April Cove Apt. 979\nWest Ava, CA 48042-6866', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(40, 'OPD000015', 'Kyla Delgado', 99, 'other', '19151294068', 'Enim enim iure in fu', '2024-07-26 20:56:17', '2024-07-26 20:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `o_p_d_patient_serials`
--

CREATE TABLE `o_p_d_patient_serials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_patient_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `serial` int(11) NOT NULL,
  `status` enum('pending','completed','absent') NOT NULL DEFAULT 'pending',
  `cluster` enum('C Board','General') NOT NULL,
  `amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_p_d_patient_serials`
--

INSERT INTO `o_p_d_patient_serials` (`id`, `opd_patient_id`, `date`, `doctor_id`, `department_id`, `serial`, `status`, `cluster`, `amount`, `created_at`, `updated_at`) VALUES
(1, 20, '1972-08-10', 3, 1, 1, 'completed', 'C Board', 2, '2024-05-22 13:14:04', '2024-05-22 13:14:04'),
(2, 21, '2016-05-23', 4, 1, 1, 'pending', 'General', 13, '2024-05-22 13:14:21', '2024-05-22 13:14:21'),
(3, 14, '2017-12-05', 3, 1, 1, 'completed', 'General', 51, '2024-05-22 13:15:50', '2024-05-22 13:15:50'),
(4, 29, '2024-05-22', 3, 1, 1, 'pending', 'C Board', 16, '2024-05-22 13:18:50', '2024-05-22 13:18:50'),
(5, 30, '2024-05-22', 3, 1, 2, 'pending', 'General', 76, '2024-05-22 13:19:00', '2024-05-22 13:19:00'),
(6, 14, '2024-05-22', 3, 1, 3, 'completed', 'General', 79, '2024-05-22 13:38:26', '2024-05-22 13:38:26'),
(7, 14, '2024-05-22', 3, 1, 4, 'pending', 'General', 14, '2024-05-22 13:39:20', '2024-05-22 13:39:20'),
(8, 11, '1986-07-31', 4, 1, 1, 'pending', 'C Board', 93, '2024-05-26 06:53:01', '2024-05-26 06:53:01'),
(9, 31, '2017-04-21', 3, 1, 1, 'pending', 'C Board', 62, '2024-05-26 06:54:00', '2024-05-26 06:54:00'),
(10, 32, '2024-05-26', 3, 1, 1, 'pending', 'General', 37, '2024-05-26 06:54:46', '2024-05-26 06:54:46'),
(11, 34, '1985-04-06', 4, 1, 1, 'pending', 'General', 38, '2024-05-26 06:54:58', '2024-05-26 06:54:58'),
(12, 11, '2024-05-26', 3, 1, 2, 'pending', 'General', 49, '2024-05-26 06:55:08', '2024-05-26 06:55:08'),
(13, 11, '2024-05-26', 3, 1, 3, 'pending', 'C Board', 34, '2024-05-26 06:55:13', '2024-05-26 06:55:13'),
(14, 40, '2024-08-09', 10, 1, 1, 'pending', 'General', 15, '2024-07-26 20:56:17', '2024-07-26 20:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `o_p_d_prescriptions`
--

CREATE TABLE `o_p_d_prescriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_patient_id` bigint(20) UNSIGNED NOT NULL,
  `opd_patient_serial_id` bigint(20) UNSIGNED NOT NULL,
  `prescription` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`prescription`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `o_p_d_prescriptions`
--

INSERT INTO `o_p_d_prescriptions` (`id`, `opd_patient_id`, `opd_patient_serial_id`, `prescription`, `created_at`, `updated_at`) VALUES
(1, 14, 7, '{\"cc\":\"Velit sint rerum ma\",\"ho\":\"Ab dolor neque nostr\",\"rf\":\"Assumenda vel illum\",\"oe\":\"Id dolorum itaque cu\",\"inv\":\"Veritatis tempor asp\",\"adv\":\"Dolorem ipsa impedi\",\"dx\":\"Minus culpa velit es\"}', '2024-05-22 15:45:19', '2024-05-22 15:45:19'),
(2, 14, 7, '{\"cc\":null,\"ho\":null,\"rf\":null,\"oe\":null,\"inv\":null,\"adv\":null,\"dx\":null}', '2024-05-22 15:53:13', '2024-05-22 15:53:13'),
(3, 32, 10, '{\"cc\":null,\"ho\":null,\"rf\":null,\"oe\":null,\"inv\":null,\"adv\":null,\"dx\":null}', '2024-05-26 06:58:10', '2024-05-26 06:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@mail.com', '$2y$10$Db8dYdmKkX94EbyKYdgho.H7as9Y81mxBBJhHl3X7A5F/kTFp7rMG', '2024-06-08 08:39:52');

-- --------------------------------------------------------

--
-- Table structure for table `pathologys`
--

CREATE TABLE `pathologys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '0 = OPD, 1 = IPD',
  `pathology_id` varchar(255) NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `test_list_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`test_list_details`)),
  `date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `delivery_time` time NOT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `payable` decimal(10,2) NOT NULL,
  `paid` decimal(10,2) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `account` tinyint(4) NOT NULL COMMENT '1 = Cash, 2 = Bkash',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = pending, 1 = processing, 2 = Ready, 3 = Delivery'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pathologys`
--

INSERT INTO `pathologys` (`id`, `type`, `pathology_id`, `patient_id`, `doctor_id`, `name`, `mobile`, `gender`, `age`, `address`, `reference`, `test_list_details`, `date`, `delivery_date`, `delivery_time`, `remark`, `total`, `discount`, `payable`, `paid`, `due`, `account`, `created_at`, `updated_at`, `status`) VALUES
(6, 1, 'PATHO122349', 1, 1, 'Md Sohag Hosen', '+8801716647919', 'Male', '23', '11/12, Road 1, Kaderabad Housing, Mohammadpur', 'DMSC', '[{\"name\":\"MRI\",\"price\":1000,\"days\":2}]', '2023-12-22', '2023-12-24', '10:30:00', NULL, 1000.00, 10.00, 900.00, 900.00, 0.00, 1, '2023-12-22 12:50:51', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `cavin_ward_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `patient_id` varchar(255) NOT NULL,
  `gender` char(255) NOT NULL COMMENT 'Male,Female,Others',
  `age` varchar(255) NOT NULL,
  `blood_group` char(255) DEFAULT NULL COMMENT 'A+, A-,B+,B-,AB+,AB-,O+,O-',
  `mobile` varchar(255) NOT NULL,
  `guardian_mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `disease` varchar(255) NOT NULL,
  `patient_summary` varchar(255) NOT NULL,
  `patient_type` char(255) NOT NULL COMMENT 'General,CBD',
  `department` char(255) NOT NULL COMMENT 'OT,Pathology',
  `reference` char(255) DEFAULT NULL COMMENT 'DMSC,MOD,MED,CBD',
  `advance` varchar(255) DEFAULT NULL,
  `due` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `doctor_id`, `cavin_ward_id`, `name`, `patient_id`, `gender`, `age`, `blood_group`, `mobile`, `guardian_mobile`, `address`, `disease`, `patient_summary`, `patient_type`, `department`, `reference`, `advance`, `due`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Md Sohag Hosen', 'P12232276', 'Male', '23', 'B+', '+8801716647919', '+8801716647918', '11/12, Road 1, Kaderabad Housing, Mohammadpur', 'Fiver', 'Summary', 'General', 'Pathology', 'DMSC', '100', '0', NULL, NULL),
(2, 1, 1, 'Steven Travis', 'P05244052', 'Other', '5', 'B+', 'Iste est autem molli', 'Aliqua Ut quos numq', 'Rerum architecto in', 'Quis est expedita et', 'Non tempore obcaeca', 'General', 'OT', 'GENERAL', '13', '98', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_daily_summaries`
--

CREATE TABLE `patient_daily_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `summary` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_daily_summaries`
--

INSERT INTO `patient_daily_summaries` (`id`, `patient_id`, `doctor_id`, `summary`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Quas minus in enim eligendi in.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(2, 2, 1, 'Est possimus sit iusto consequatur.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(3, 1, 1, 'Ut rem magni ullam rem in in quisquam.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(4, 1, 2, 'Ut molestiae autem et unde.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(5, 1, 2, 'Qui iste ea praesentium id et.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(6, 2, 1, 'Reprehenderit qui vero debitis quia.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(7, 2, 2, 'Aut ipsum laudantium omnis sed omnis et.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(8, 2, 2, 'Laborum mollitia harum quibusdam.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(9, 1, 2, 'Sequi est quibusdam dolorum quia ea inventore.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(10, 2, 2, 'Deleniti repellendus pariatur sunt laborum.', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(11, 2, 1, 'Facere consectetur', '2024-05-13 15:57:52', '2024-05-13 15:57:52'),
(12, 2, 1, 'Aut reprehenderit laAut reprehenderit laAut reprehenderit la', '2024-05-13 16:22:44', '2024-05-13 16:22:44'),
(13, 2, 1, 'fsda', '2024-05-26 16:50:12', '2024-05-26 16:50:12'),
(14, 2, 2, 'Est qui maxime ex quasi minima cumque temporibus.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(15, 2, 2, 'Saepe assumenda qui quae eveniet quis temporibus.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(16, 2, 1, 'Dignissimos cupiditate neque sit.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(17, 2, 1, 'Asperiores itaque et totam vel et ullam.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(18, 1, 1, 'Libero voluptatem explicabo earum ea.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(19, 2, 2, 'Excepturi ipsa placeat ab enim cum aut id animi.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(20, 2, 2, 'Dolorem aspernatur nihil aut.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(21, 2, 2, 'Est velit quo quas ut ipsa eos voluptate.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(22, 1, 1, 'Velit nesciunt praesentium illum sint neque.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(23, 1, 2, 'Numquam earum ab itaque sed non aut blanditiis.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(24, 1, 2, 'Minima distinctio rerum voluptate est.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(25, 2, 2, 'Debitis et aut repellendus ratione quis.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(26, 1, 1, 'Rerum mollitia ea libero harum modi.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(27, 1, 1, 'Placeat sint aliquid quis.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(28, 1, 1, 'Dolore et error perspiciatis quibusdam.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(29, 2, 1, 'Esse aliquam doloremque minima commodi et.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(30, 1, 1, 'Architecto non quo ut excepturi repudiandae.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(31, 2, 2, 'Amet explicabo incidunt eveniet.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(32, 2, 2, 'Harum expedita architecto aut et qui natus eum.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(33, 1, 2, 'Ut suscipit modi cupiditate nemo.', '2024-06-08 08:42:45', '2024-06-08 08:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `patient_doctor_assignments`
--

CREATE TABLE `patient_doctor_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_doctor_assignments`
--

INSERT INTO `patient_doctor_assignments` (`id`, `patient_id`, `doctor_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_medicines`
--

CREATE TABLE `patient_medicines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `medicine_name` varchar(255) NOT NULL,
  `schedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`schedule`)),
  `taking_time` varchar(255) NOT NULL,
  `dose` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_medicines`
--

INSERT INTO `patient_medicines` (`id`, `date`, `patient_id`, `doctor_id`, `medicine_name`, `schedule`, `taking_time`, `dose`, `duration`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '1986-04-07', 2, 1, 'minima', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'sint', '3 weeks', 'inactive', 'Lambert Bailey', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(2, '2001-10-02', 2, 2, 'alias', '[\"morning\",\"evening\"]', 'after', 'maiores', '3 weeks', 'inactive', 'Dr. Roderick Durgan', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(3, '1996-06-06', 2, 2, 'praesentium', '[\"morning\",\"afternoon\"]', 'after', 'iusto', '3 weeks', 'active', 'Prof. Rosalyn Bins DDS', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(4, '2023-07-21', 2, 1, 'optio', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'delectus', '3 weeks', 'inactive', 'Weston Kozey', '2024-05-12 17:16:32', '2024-05-22 16:37:27'),
(5, '1997-05-17', 2, 2, 'ipsam', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'omnis', '1 week', 'inactive', 'Leonardo Douglas', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(6, '2018-02-01', 2, 2, 'molestias', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'doloribus', '3 weeks', 'inactive', 'Kianna Corwin', '2024-05-12 17:16:32', '2024-05-22 16:37:27'),
(7, '1979-09-22', 1, 2, 'repellendus', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'reprehenderit', '2 weeks', 'inactive', 'Giuseppe Wiegand', '2024-05-12 17:16:32', '2024-05-26 06:50:29'),
(8, '1975-03-11', 1, 2, 'itaque', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'id', '1 week', 'inactive', 'Henderson Leuschke', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(9, '2007-11-20', 2, 1, 'molestias', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'hic', '4 weeks', 'inactive', 'Nelson Lindgren', '2024-05-12 17:16:32', '2024-05-22 16:52:04'),
(10, '2003-08-23', 1, 2, 'velit', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'similique', '4 weeks', 'inactive', 'Dr. Consuelo Kuvalis', '2024-05-12 17:16:32', '2024-05-12 17:16:32'),
(11, '2004-07-25', 1, 1, 'cum', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'eum', '3 weeks', 'inactive', 'Leopoldo Altenwerth', '2024-05-12 17:17:50', '2024-05-26 06:50:29'),
(12, '2015-04-10', 2, 1, 'fugiat', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'voluptas', '1 week', 'inactive', 'Jairo Hand', '2024-05-12 17:17:50', '2024-05-22 16:37:27'),
(13, '2011-11-26', 1, 1, 'nesciunt', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'rerum', '2 weeks', 'inactive', 'Stuart McClure', '2024-05-12 17:17:50', '2024-05-12 17:17:50'),
(14, '1998-10-05', 1, 1, 'et', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'ut', '1 week', 'inactive', 'Mr. Newell Jacobs', '2024-05-12 17:17:50', '2024-05-26 06:50:29'),
(15, '1979-06-03', 2, 2, 'dolor', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'est', '4 weeks', 'inactive', 'Magdalen Leuschke', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(16, '2014-04-22', 1, 1, 'veritatis', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'totam', '4 weeks', 'active', 'Jonathon Fadel', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(17, '2015-04-18', 2, 1, 'aut', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'sit', '3 weeks', 'inactive', 'Makayla Kassulke', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(18, '2005-03-13', 1, 2, 'voluptatem', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'aut', '4 weeks', 'inactive', 'Wilhelmine Macejkovic', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(19, '2010-10-08', 1, 1, 'temporibus', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'officiis', '4 weeks', 'inactive', 'Rachel Okuneva', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(20, '1998-09-08', 1, 2, 'voluptatem', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'exercitationem', '1 week', 'inactive', 'Zachary Sawayn PhD', '2024-05-12 17:17:51', '2024-05-12 17:17:51'),
(21, '2024-05-13', 2, 1, 'Deserunt itaque dict', '[\"afternoon\",\"evening\"]', 'before', 'Fugiat velit et en', '59', 'inactive', NULL, '2024-05-13 15:48:40', '2024-05-13 16:17:18'),
(22, '2024-05-13', 2, 1, 'Consectetur do qui', '[\"afternoon\",\"evening\"]', 'after', 'Quis impedit except', '88', 'inactive', NULL, '2024-05-13 15:57:52', '2024-05-13 16:17:18'),
(23, '2024-05-13', 2, 1, 'Repellendus Aliquid', '[\"morning\",\"evening\"]', 'after', '5 ml', '30', 'inactive', NULL, '2024-05-13 16:22:44', '2024-05-22 16:37:27'),
(24, '2024-05-13', 2, 1, 'Neque aute ad ullam', '[\"morning\"]', 'before', '1 piece', '71', 'inactive', NULL, '2024-05-13 16:22:44', '2024-05-13 16:23:13'),
(25, '2024-05-26', 1, 1, 'Aliqua Dolores eaqu', '[\"morning\",\"evening\"]', 'after', '1 sp', '7', 'inactive', NULL, '2024-05-26 06:50:08', '2024-06-29 16:09:43'),
(26, '1970-03-20', 1, 2, 'eum', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'ut', '3 weeks', 'active', 'Rebekah Yost MD', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(27, '2020-11-29', 2, 1, 'est', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'cum', '1 week', 'inactive', 'Golden Bashirian', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(28, '1995-02-26', 1, 2, 'nam', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'sed', '2 weeks', 'inactive', 'Jonathon Nienow', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(29, '2008-08-30', 2, 2, 'sit', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'praesentium', '3 weeks', 'active', 'Dr. Marjolaine Tremblay Sr.', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(30, '1990-01-25', 1, 2, 'sed', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'commodi', '1 week', 'active', 'Bartholome Hagenes', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(31, '2022-06-03', 1, 1, 'harum', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'expedita', '4 weeks', 'inactive', 'Greta Cartwright', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(32, '2017-09-17', 1, 2, 'distinctio', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'a', '3 weeks', 'inactive', 'Prof. Darrel Langworth', '2024-06-08 08:42:14', '2024-06-29 16:09:43'),
(33, '2002-12-17', 1, 1, 'nostrum', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'culpa', '4 weeks', 'inactive', 'Rosendo Leannon', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(34, '2021-12-14', 2, 1, 'dolorem', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'et', '3 weeks', 'active', 'Jay Nicolas IV', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(35, '2003-10-17', 2, 2, 'est', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'quo', '4 weeks', 'inactive', 'Leanna Swift', '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(36, '1978-05-21', 2, 2, 'dolor', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'dolorum', '2 weeks', 'inactive', 'Ms. Roslyn Schiller Jr.', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(37, '1976-01-26', 2, 2, 'aliquid', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'illum', '2 weeks', 'inactive', 'Prof. Brycen Wilkinson PhD', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(38, '1973-10-29', 2, 1, 'error', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'ipsum', '4 weeks', 'inactive', 'Norbert Crooks', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(39, '1972-11-13', 1, 1, 'eos', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'harum', '3 weeks', 'active', 'Larissa Smith II', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(40, '1988-02-25', 1, 1, 'incidunt', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'consequatur', '3 weeks', 'inactive', 'Catalina Schowalter', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(41, '1987-03-01', 2, 2, 'et', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'ea', '1 week', 'inactive', 'Mr. Jeff Watsica', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(42, '1972-04-10', 1, 2, 'nostrum', '[\"morning\",\"afternoon\",\"evening\"]', 'before', 'ratione', '1 week', 'active', 'Prof. Preston Wunsch', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(43, '2013-11-10', 2, 1, 'saepe', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'doloremque', '4 weeks', 'active', 'Ms. Kenna Senger DDS', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(44, '1985-07-25', 2, 2, 'aliquid', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'odit', '1 week', 'active', 'Miss Marisa Harris', '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(45, '2018-07-19', 2, 1, 'praesentium', '[\"morning\",\"afternoon\",\"evening\"]', 'after', 'cum', '2 weeks', 'inactive', 'Dr. Gregg Stiedemann I', '2024-06-08 08:42:45', '2024-06-08 08:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `patient_statuses`
--

CREATE TABLE `patient_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pulse_rate` int(11) NOT NULL,
  `blood_pressure` int(11) NOT NULL,
  `temperature` int(11) NOT NULL,
  `oxygen_level` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_statuses`
--

INSERT INTO `patient_statuses` (`id`, `patient_id`, `user_id`, `pulse_rate`, `blood_pressure`, `temperature`, `oxygen_level`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 3, 7, 8, 4, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(2, 2, 1, 7, 6, 2, 7, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(3, 2, 2, 2, 2, 4, 5, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(4, 1, 2, 3, 1, 8, 6, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(5, 2, 2, 3, 1, 1, 4, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(6, 1, 1, 5, 1, 4, 9, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(7, 1, 2, 9, 4, 1, 1, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(8, 1, 2, 9, 5, 7, 2, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(9, 2, 2, 5, 6, 2, 5, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(10, 2, 2, 6, 7, 3, 4, '2024-06-08 08:42:14', '2024-06-08 08:42:14'),
(11, 2, 1, 9, 8, 9, 1, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(12, 1, 2, 7, 8, 1, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(13, 2, 1, 5, 3, 8, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(14, 1, 2, 5, 2, 8, 5, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(15, 2, 2, 4, 5, 3, 8, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(16, 1, 2, 5, 4, 3, 9, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(17, 1, 2, 3, 3, 8, 9, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(18, 2, 1, 5, 3, 8, 2, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(19, 2, 1, 1, 8, 5, 9, '2024-06-08 08:42:45', '2024-06-08 08:42:45'),
(20, 2, 2, 4, 7, 4, 8, '2024-06-08 08:42:45', '2024-06-08 08:42:45');

-- --------------------------------------------------------

--
-- Table structure for table `previous_histories`
--

CREATE TABLE `previous_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `condition` varchar(255) NOT NULL,
  `treatment` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `previous_histories`
--

INSERT INTO `previous_histories` (`id`, `patient_id`, `doctor_name`, `condition`, `treatment`, `date`, `created_at`, `updated_at`) VALUES
(1, 2, 'Dr John Doe', 'Similique sint odio', 'Qui velit similiqueQui velit similiqueQui velit similiqueQui velit similiqueQui velit similiqueQui velit similiqueQui velit similiqueQui velit similique', '0000-00-00', '2024-05-09 16:57:17', '2024-05-09 16:57:17'),
(2, 2, 'Dr John Doe', 'Porro laborum Culpa', 'Deleniti molestias l', '2001-08-26', '2024-05-09 16:57:48', '2024-05-09 16:57:48'),
(3, 2, 'Dr John Doe', 'Nostrud exercitation', 'Qui veniam eos eaqu', '2024-05-09', '2024-05-09 16:59:05', '2024-05-09 16:59:05'),
(4, 2, 'Dr John Doe', 'Modi rem assumenda a', 'Dolorem quo occaecat', '2024-05-08', '2024-05-09 16:59:15', '2024-05-09 16:59:15'),
(10, 2, 'Dr John Doe', 'Temporibus rerum sit', 'Non ut est sunt com', '1985-05-15', '2024-05-13 14:59:06', '2024-05-13 14:59:06'),
(12, 2, 'Dr John Doe', 'Rerum ut fugiat sit', 'Molestiae ex et accu', '2023-08-02', '2024-05-25 08:53:42', '2024-05-25 08:53:42'),
(13, 2, 'Dr John Doe', 'Et impedit eiusmod', 'Excepturi dolor eum', '2005-04-28', '2024-05-25 08:53:50', '2024-05-25 08:53:50'),
(16, 2, 'Xyla Kelly', 'Consequatur velit s', 'Maiores impedit omn', '1977-12-11', '2024-05-25 08:55:57', '2024-05-25 08:55:57'),
(17, 2, 'Xyla Kelly', 'Eveniet mollitia do', 'Quo fugiat illum f', '1987-07-07', '2024-05-25 08:56:01', '2024-05-25 08:56:01'),
(18, 1, 'Jain Doe', 'Debitis amet commod', 'Tempore iusto sed e', '1978-11-11', '2024-05-26 06:51:37', '2024-05-26 06:51:37');

-- --------------------------------------------------------

--
-- Table structure for table `p_o_w_patients`
--

CREATE TABLE `p_o_w_patients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `operation_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` bigint(20) UNSIGNED NOT NULL,
  `isReadyForWard` tinyint(1) NOT NULL DEFAULT 0,
  `bed_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `p_o_w_patients`
--

INSERT INTO `p_o_w_patients` (`id`, `operation_id`, `doctor_id`, `isReadyForWard`, `bed_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 0, 3, '2024-07-26 21:01:32', '2024-07-26 21:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `store_departments`
--

CREATE TABLE `store_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_departments`
--

INSERT INTO `store_departments` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Medicine', '2024-07-26 21:02:30', '2024-07-26 21:02:30'),
(2, 'Furniture', '2024-07-26 21:02:37', '2024-07-26 21:02:37'),
(3, 'Food', '2024-07-26 21:02:42', '2024-07-26 21:02:42');

-- --------------------------------------------------------

--
-- Table structure for table `store_inventories`
--

CREATE TABLE `store_inventories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_inventories`
--

INSERT INTO `store_inventories` (`id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 300, '2024-07-26 21:03:52', '2024-07-26 21:03:52'),
(2, 2, 100, '2024-07-26 21:04:12', '2024-07-26 21:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `store_inventory_update_logs`
--

CREATE TABLE `store_inventory_update_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `added_quantity` int(11) NOT NULL,
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_invoices`
--

CREATE TABLE `store_invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `products` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`products`)),
  `total_bill` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store_item_types`
--

CREATE TABLE `store_item_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_item_types`
--

INSERT INTO `store_item_types` (`id`, `department_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'Basic', '2024-07-26 21:02:52', '2024-07-26 21:02:52'),
(2, 1, 'Premiumm', '2024-07-26 21:03:01', '2024-07-26 21:03:01'),
(3, 2, 'WoodWork', '2024-07-26 21:03:08', '2024-07-26 21:03:08'),
(4, 2, 'Plastic', '2024-07-26 21:03:15', '2024-07-26 21:03:15'),
(5, 3, 'Fast Food', '2024-07-26 21:03:20', '2024-07-26 21:03:20'),
(6, 3, 'Drinks', '2024-07-26 21:03:26', '2024-07-26 21:03:26'),
(7, 3, 'Lunch', '2024-07-26 21:03:33', '2024-07-26 21:03:33');

-- --------------------------------------------------------

--
-- Table structure for table `store_material_requests`
--

CREATE TABLE `store_material_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `requested_from` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `updated_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_material_requests`
--

INSERT INTO `store_material_requests` (`id`, `product_id`, `requested_from`, `quantity`, `status`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'CTA', 10, 'pending', 2, '2024-07-26 21:05:00', '2024-07-26 21:05:00'),
(2, 1, 'CTA', 500, 'pending', 2, '2024-07-26 21:05:15', '2024-07-26 21:05:15'),
(3, 2, 'CTA', 10, 'pending', 2, '2024-07-26 21:05:34', '2024-07-26 21:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `item_type_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `store_products`
--

INSERT INTO `store_products` (`id`, `department_id`, `item_type_id`, `name`, `image`, `price`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 3, 6, 'Coca-Cola', NULL, 30.00, 'PR00001', '2024-07-26 21:03:52', '2024-07-26 21:03:52'),
(2, 1, 2, 'Med', NULL, 5.00, 'PR00002', '2024-07-26 21:04:12', '2024-07-26 21:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_staff_info`
--

CREATE TABLE `teacher_staff_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `hr_type` char(255) NOT NULL COMMENT 'Teacher,Staff',
  `serial` char(255) NOT NULL,
  `hr_id` char(255) NOT NULL,
  `hr_name` char(255) NOT NULL,
  `designation` char(255) NOT NULL COMMENT 'Head Teacher,Asst. Head Teacher,Teacher,Asst. Teacher,Office Staff,Peon',
  `gender` char(255) NOT NULL COMMENT 'Male,Female,Others',
  `date_of_birth` date NOT NULL,
  `religion` char(255) NOT NULL COMMENT 'Muslim,Hindu,Buddhist,Christian,Others',
  `mobile_no` char(255) NOT NULL,
  `email` char(255) NOT NULL,
  `blood_group` char(255) DEFAULT NULL COMMENT 'A+, A-,B+,B-,AB+,AB-,O+,O-',
  `joining_date` date NOT NULL,
  `previous_institute` text DEFAULT NULL,
  `pressent_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `hr_father_name` char(180) DEFAULT NULL,
  `hr_mother_name` char(180) DEFAULT NULL,
  `basic_salary` varchar(255) NOT NULL,
  `provident_fund` varchar(255) NOT NULL,
  `coaching` varchar(255) DEFAULT NULL,
  `hr_photo` varchar(255) DEFAULT NULL,
  `hr_sign` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = inactive,1= active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `test_list`
--

CREATE TABLE `test_list` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `delivery_days` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `test_list`
--

INSERT INTO `test_list` (`id`, `name`, `delivery_days`, `amount`, `created_at`, `updated_at`) VALUES
(1, 'MRI', '2', '1000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tubes`
--

CREATE TABLE `tubes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pathologys_id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` bigint(20) UNSIGNED NOT NULL,
  `test_list_id` int(11) NOT NULL,
  `test_list_name` varchar(255) NOT NULL,
  `tube_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tubes`
--

INSERT INTO `tubes` (`id`, `pathologys_id`, `patient_id`, `test_list_id`, `test_list_name`, `tube_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 1, 'MRI', 'T531673', '2023-12-22 12:54:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=inactive, 1=active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `user_type`, `status`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Shahina', 'shahina@gmail.com', NULL, '$2y$10$VQ7kOI7m2ddZvn614.mo2.Zgp.MOsEZyFcRbcXSi.L33VVAn0OzgS', NULL, 'admin', 1, '2022-02-05 23:05:34', NULL, '1694203150jtbmfaQ.png'),
(2, 'Tamzid', 'test@mail.com', NULL, '$2y$10$KXEesBuE.O3fk4U.tmWF2eNuqC9psZylaAUWAxHes8sKg9BkFaLT2', 'MFyaFvMR9fqAwgNxojbxO7r2y2hKaGGi7jaifumpYJuBJILTfkK2eSgEhahY', 'admin', 1, NULL, NULL, NULL),
(55, 'Admin', 'admin@gmail.com', NULL, '$2y$10$c3B61VDdATX/R10HxbDyauoYjTSoR40U9/YkhYWi.HFnc8o5w/vi.', NULL, 'admin', 1, '2022-11-07 01:28:34', '2022-11-07 01:28:34', '1700251722HPOvgOH.png'),
(56, 'Musfiq Musfiq', 'musfiq@gmail.com', NULL, '$2y$10$c3B61VDdATX/R10HxbDyauoYjTSoR40U9/YkhYWi.HFnc8o5w/vi.', NULL, 'user', 1, '2022-11-07 23:11:43', '2022-11-07 23:12:22', '1667884303zLQdTZ4.jpg'),
(57, 'Shahina123 01534552', 'shahina123@gmail.com', NULL, '$2y$10$c3B61VDdATX/R10HxbDyauoYjTSoR40U9/YkhYWi.HFnc8o5w/vi.', NULL, 'user', 0, '2022-11-09 03:42:12', '2022-11-09 03:42:12', '16679869311cyHQoe.jpg'),
(58, 'emon', 'sohaghosenemon@gmail.com', NULL, '$2y$10$c3B61VDdATX/R10HxbDyauoYjTSoR40U9/YkhYWi.HFnc8o5w/vi.', NULL, 'admin', 1, '2023-09-09 00:02:14', '2023-09-09 00:02:14', '1694239334fmIgL6L.jpg'),
(59, 'Alec Morissette', 'maxine.mayer@example.org', '2024-06-08 08:41:53', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'HdYy1Bh8Wd', '', 0, '2024-06-08 08:41:53', '2024-06-08 08:41:53', NULL),
(60, 'Bridgette Armstrong', 'qquitzon@example.org', '2024-06-08 08:42:14', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'rd8zaNUxAF', '', 0, '2024-06-08 08:42:14', '2024-06-08 08:42:14', NULL),
(61, 'Christa Paucek', 'christiansen.willa@example.com', '2024-06-08 08:42:45', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '6Sr8pld2D8', '', 0, '2024-06-08 08:42:45', '2024-06-08 08:42:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wards`
--

CREATE TABLE `wards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `total_beds` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wards`
--

INSERT INTO `wards` (`id`, `name`, `type`, `location`, `total_beds`, `created_at`, `updated_at`) VALUES
(1, 'ICU Ward', 'test', 'ICU', 210, '2024-07-26 20:46:16', '2024-07-26 20:46:16'),
(2, 'POW Ward', 'test', 'POW', 150, '2024-07-26 20:46:31', '2024-07-26 20:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `zkteco_devices`
--

CREATE TABLE `zkteco_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip` varchar(45) NOT NULL,
  `port` varchar(10) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendances_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `beds`
--
ALTER TABLE `beds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beds_ward_id_foreign` (`ward_id`),
  ADD KEY `beds_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `cavin_wards`
--
ALTER TABLE `cavin_wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctors_department_id_foreign` (`department_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_leaves_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `emp_histories`
--
ALTER TABLE `emp_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `in_out_logs`
--
ALTER TABLE `in_out_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `i_c_u_patients`
--
ALTER TABLE `i_c_u_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_c_u_patients_patient_id_foreign` (`patient_id`),
  ADD KEY `i_c_u_patients_bed_id_foreign` (`bed_id`),
  ADD KEY `i_c_u_patients_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operations_patient_id_foreign` (`patient_id`),
  ADD KEY `operations_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `o_p_d_medicines`
--
ALTER TABLE `o_p_d_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `o_p_d_medicines_opd_prescription_id_foreign` (`opd_prescription_id`);

--
-- Indexes for table `o_p_d_patients`
--
ALTER TABLE `o_p_d_patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `o_p_d_patients_patient_id_unique` (`patient_id`);

--
-- Indexes for table `o_p_d_patient_serials`
--
ALTER TABLE `o_p_d_patient_serials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `o_p_d_patient_serials_opd_patient_id_foreign` (`opd_patient_id`),
  ADD KEY `o_p_d_patient_serials_doctor_id_foreign` (`doctor_id`),
  ADD KEY `o_p_d_patient_serials_department_id_foreign` (`department_id`);

--
-- Indexes for table `o_p_d_prescriptions`
--
ALTER TABLE `o_p_d_prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `o_p_d_prescriptions_opd_patient_id_foreign` (`opd_patient_id`),
  ADD KEY `o_p_d_prescriptions_opd_patient_serial_id_foreign` (`opd_patient_serial_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pathologys`
--
ALTER TABLE `pathologys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pathologys_patient_id_foreign` (`patient_id`),
  ADD KEY `pathologys_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_doctor_id_foreign` (`doctor_id`),
  ADD KEY `patients_cavin_ward_id_foreign` (`cavin_ward_id`);

--
-- Indexes for table `patient_daily_summaries`
--
ALTER TABLE `patient_daily_summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient_doctor_assignments`
--
ALTER TABLE `patient_doctor_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_doctor_assignments_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_doctor_assignments_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `patient_medicines`
--
ALTER TABLE `patient_medicines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_medicines_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_medicines_doctor_id_foreign` (`doctor_id`);

--
-- Indexes for table `patient_statuses`
--
ALTER TABLE `patient_statuses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_statuses_patient_id_foreign` (`patient_id`),
  ADD KEY `patient_statuses_user_id_foreign` (`user_id`);

--
-- Indexes for table `previous_histories`
--
ALTER TABLE `previous_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `previous_histories_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `p_o_w_patients`
--
ALTER TABLE `p_o_w_patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `p_o_w_patients_operation_id_foreign` (`operation_id`),
  ADD KEY `p_o_w_patients_doctor_id_foreign` (`doctor_id`),
  ADD KEY `p_o_w_patients_bed_id_foreign` (`bed_id`);

--
-- Indexes for table `store_departments`
--
ALTER TABLE `store_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store_inventories`
--
ALTER TABLE `store_inventories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_inventories_product_id_foreign` (`product_id`);

--
-- Indexes for table `store_inventory_update_logs`
--
ALTER TABLE `store_inventory_update_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_inventory_update_logs_product_id_foreign` (`product_id`),
  ADD KEY `store_inventory_update_logs_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `store_invoices`
--
ALTER TABLE `store_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_invoices_product_id_foreign` (`product_id`),
  ADD KEY `store_invoices_created_by_foreign` (`created_by`);

--
-- Indexes for table `store_item_types`
--
ALTER TABLE `store_item_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_item_types_department_id_foreign` (`department_id`);

--
-- Indexes for table `store_material_requests`
--
ALTER TABLE `store_material_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_material_requests_product_id_foreign` (`product_id`),
  ADD KEY `store_material_requests_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `store_products_department_id_foreign` (`department_id`),
  ADD KEY `store_products_item_type_id_foreign` (`item_type_id`);

--
-- Indexes for table `teacher_staff_info`
--
ALTER TABLE `teacher_staff_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_list`
--
ALTER TABLE `test_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tubes`
--
ALTER TABLE `tubes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tubes_pathologys_id_foreign` (`pathologys_id`),
  ADD KEY `tubes_patient_id_foreign` (`patient_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wards`
--
ALTER TABLE `wards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `beds`
--
ALTER TABLE `beds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cavin_wards`
--
ALTER TABLE `cavin_wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `emp_histories`
--
ALTER TABLE `emp_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_out_logs`
--
ALTER TABLE `in_out_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_c_u_patients`
--
ALTER TABLE `i_c_u_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `operations`
--
ALTER TABLE `operations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `o_p_d_medicines`
--
ALTER TABLE `o_p_d_medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_p_d_patients`
--
ALTER TABLE `o_p_d_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `o_p_d_patient_serials`
--
ALTER TABLE `o_p_d_patient_serials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `o_p_d_prescriptions`
--
ALTER TABLE `o_p_d_prescriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pathologys`
--
ALTER TABLE `pathologys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_daily_summaries`
--
ALTER TABLE `patient_daily_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `patient_doctor_assignments`
--
ALTER TABLE `patient_doctor_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patient_medicines`
--
ALTER TABLE `patient_medicines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `patient_statuses`
--
ALTER TABLE `patient_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `previous_histories`
--
ALTER TABLE `previous_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `p_o_w_patients`
--
ALTER TABLE `p_o_w_patients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `store_departments`
--
ALTER TABLE `store_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_inventories`
--
ALTER TABLE `store_inventories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `store_inventory_update_logs`
--
ALTER TABLE `store_inventory_update_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_invoices`
--
ALTER TABLE `store_invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store_item_types`
--
ALTER TABLE `store_item_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `store_material_requests`
--
ALTER TABLE `store_material_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teacher_staff_info`
--
ALTER TABLE `teacher_staff_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_list`
--
ALTER TABLE `test_list`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tubes`
--
ALTER TABLE `tubes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `wards`
--
ALTER TABLE `wards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zkteco_devices`
--
ALTER TABLE `zkteco_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beds`
--
ALTER TABLE `beds`
  ADD CONSTRAINT `beds_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beds_ward_id_foreign` FOREIGN KEY (`ward_id`) REFERENCES `wards` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_leaves`
--
ALTER TABLE `employee_leaves`
  ADD CONSTRAINT `employee_leaves_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `i_c_u_patients`
--
ALTER TABLE `i_c_u_patients`
  ADD CONSTRAINT `i_c_u_patients_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `i_c_u_patients_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `i_c_u_patients_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `operations_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `operations_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `o_p_d_medicines`
--
ALTER TABLE `o_p_d_medicines`
  ADD CONSTRAINT `o_p_d_medicines_opd_prescription_id_foreign` FOREIGN KEY (`opd_prescription_id`) REFERENCES `o_p_d_prescriptions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `o_p_d_patient_serials`
--
ALTER TABLE `o_p_d_patient_serials`
  ADD CONSTRAINT `o_p_d_patient_serials_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `o_p_d_patient_serials_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `o_p_d_patient_serials_opd_patient_id_foreign` FOREIGN KEY (`opd_patient_id`) REFERENCES `o_p_d_patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `o_p_d_prescriptions`
--
ALTER TABLE `o_p_d_prescriptions`
  ADD CONSTRAINT `o_p_d_prescriptions_opd_patient_id_foreign` FOREIGN KEY (`opd_patient_id`) REFERENCES `o_p_d_patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `o_p_d_prescriptions_opd_patient_serial_id_foreign` FOREIGN KEY (`opd_patient_serial_id`) REFERENCES `o_p_d_patient_serials` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pathologys`
--
ALTER TABLE `pathologys`
  ADD CONSTRAINT `pathologys_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `pathologys_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_cavin_ward_id_foreign` FOREIGN KEY (`cavin_ward_id`) REFERENCES `cavin_wards` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patients_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_doctor_assignments`
--
ALTER TABLE `patient_doctor_assignments`
  ADD CONSTRAINT `patient_doctor_assignments_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_doctor_assignments_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_medicines`
--
ALTER TABLE `patient_medicines`
  ADD CONSTRAINT `patient_medicines_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `patient_medicines_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_statuses`
--
ALTER TABLE `patient_statuses`
  ADD CONSTRAINT `patient_statuses_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_statuses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `previous_histories`
--
ALTER TABLE `previous_histories`
  ADD CONSTRAINT `previous_histories_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `p_o_w_patients`
--
ALTER TABLE `p_o_w_patients`
  ADD CONSTRAINT `p_o_w_patients_bed_id_foreign` FOREIGN KEY (`bed_id`) REFERENCES `beds` (`id`),
  ADD CONSTRAINT `p_o_w_patients_doctor_id_foreign` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `p_o_w_patients_operation_id_foreign` FOREIGN KEY (`operation_id`) REFERENCES `operations` (`id`);

--
-- Constraints for table `store_inventories`
--
ALTER TABLE `store_inventories`
  ADD CONSTRAINT `store_inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `store_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_inventory_update_logs`
--
ALTER TABLE `store_inventory_update_logs`
  ADD CONSTRAINT `store_inventory_update_logs_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `store_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_inventory_update_logs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_invoices`
--
ALTER TABLE `store_invoices`
  ADD CONSTRAINT `store_invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_invoices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `store_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_item_types`
--
ALTER TABLE `store_item_types`
  ADD CONSTRAINT `store_item_types_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `store_departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_material_requests`
--
ALTER TABLE `store_material_requests`
  ADD CONSTRAINT `store_material_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `store_products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `store_material_requests_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `store_products`
--
ALTER TABLE `store_products`
  ADD CONSTRAINT `store_products_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `store_departments` (`id`),
  ADD CONSTRAINT `store_products_item_type_id_foreign` FOREIGN KEY (`item_type_id`) REFERENCES `store_item_types` (`id`);

--
-- Constraints for table `tubes`
--
ALTER TABLE `tubes`
  ADD CONSTRAINT `tubes_pathologys_id_foreign` FOREIGN KEY (`pathologys_id`) REFERENCES `pathologys` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tubes_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
