-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 11:52 AM
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
-- Database: `bhcmis`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','midwife','bhw','residents') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `isRejected` tinyint(1) NOT NULL DEFAULT 0,
  `isValid` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `role`, `profile_picture`, `isArchived`, `isRejected`, `isValid`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '$2y$10$nHxsF.YcSQ59AyCImzYSHeinz6BJ9w0MfHDWKhgItsLRf4xM1Vo52', 'admin', '/bhcmis/storage/uploads/679694e6da868.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-27 04:32:07'),
(2, 'BHW1', '$2y$10$Fp06K.3nimzVrtsC.VQMs.mkYrm0vpq5rYhDvktMiIY7SZbWbkozW', 'bhw', '/bhcmis/storage/uploads/679cc5f63594f.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-31 20:45:42'),
(6, 'BHW2', '$2y$10$jo2g7gXKJXysuLCE.WEMo.ZdWhAjO6/ORu4kcGZ75HlMkyfWau4OS', 'bhw', '/bhcmis/storage/uploads/679ccb9e4f95d.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-31 21:09:50'),
(7, 'BHW3', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/679ccc819ff1d.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-31 21:13:37'),
(8, 'BHW4', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/679ccd1915c1c.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-31 21:16:09'),
(12, 'Midwife1', '$2y$10$mHv3MxPW3CnlJ0m0Fp//LeShjQqYgttV40fklrqpW.3MEBweZChqi', 'midwife', '/bhcmis/storage/uploads/midwife-1.jpg', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-27 03:31:19'),
(13, 'Resident1', '$2y$10$L5zbHhrEzP4vmM3QifbNwu.qXLWC6wLHW34U31RsarhOn0jW.CHe2', 'residents', '/bhcmis/storage/uploads/6796a3a6e253c.jpg', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-27 05:05:42'),
(14, 'Resident2', '$2y$10$PhtFVyI7r3nW3J3KRIaxLuwPT5GDuqKt1lahofGd0VeCEOk8tMDIW', 'residents', '/bhcmis/storage/uploads/avatar-woman2.png', 0, 0, 1, '2025-01-27 03:30:52', '2025-01-27 03:31:19'),
(50, 'Resident3', '$2y$10$PhtFVyI7r3nW3J3KRIaxLuwPT5GDuqKt1lahofGd0VeCEOk8tMDIW', 'residents', NULL, 0, 0, 1, '2025-01-27 03:30:52', '2025-01-27 03:31:19'),
(59, 'Ron99', '$2y$10$xYf5TpGP9FkslO0JfhoP8eLI22yv5QkSWNE/JnaINiEKS5VXwTvdG', 'residents', '/bhcmis/storage/uploads/679afb46e4571.png', 0, 0, 1, '2025-01-30 11:41:58', '2025-01-30 12:08:52'),
(64, 'Midwife2', '$2y$10$37HD57rLxAb6feShtxt0b.WcT3/Ewn0PO7yjDEUFdtBMKdY1RZc7a', 'midwife', NULL, 0, 0, 1, '2025-01-31 04:01:16', '2025-01-31 04:01:16'),
(66, 'BHW15', '$2y$10$eh3AjSH8Ka.TZ9A/UB.hzesc8pyvriHJ2wHrFQkiiT37bqcS88TAW', 'bhw', NULL, 0, 0, 1, '2025-01-31 04:42:59', '2025-01-31 04:42:59'),
(67, 'bhw5', '$2y$10$KD4nqI79wX.Y.EMtAnEaY.NGaltCiDHDdsUyItbWPHVfWpOw8eFHG', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:24:40', '2025-01-31 21:24:40'),
(68, 'bhw6', '$2y$10$AQfAEpqoYJ5qphV5KCShbedd3vKD7Fn8czdZIq9afoFsD51FtqTqy', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:31:00', '2025-01-31 21:31:00'),
(69, 'bhw7', '$2y$10$y3O/.Z4EyD4kdvCF6JZnVO5LpjE5PNA5C1YcFIHHp3bViO0HKGi7S', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:35:56', '2025-01-31 21:35:56'),
(70, 'bhw8', '$2y$10$e3hLhlJVh56WkUIflTvwb.pnZsXNxUO2eV7jqDsXWp9zjO0CGs2VG', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:36:42', '2025-01-31 21:36:42'),
(71, 'bhw9', '$2y$10$XZxn5ErpzGO4va0rpSG39.v/UaBwhkpXjMSx55puX4JmRJtcZ6.ri', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:37:05', '2025-01-31 21:37:05'),
(72, 'bhw10', '$2y$10$k9fmS3n813aaiovqWIMq0uTIv/nweHLfnnBjbMdMG0mCjP7j.edKC', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:39:52', '2025-01-31 21:39:52'),
(73, 'bhw11', '$2y$10$u4l82gU7D65gTRFP25naourJVzljYJ1v374XMGOO/Br3lW0W/oe/u', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:47:12', '2025-01-31 21:47:12'),
(74, 'bhw12', '$2y$10$RgWabRxxVsrP6R1sNfHiXewDCwX8plTjlPkm1K3.Fx4adGijBHiWK', 'bhw', NULL, 0, 0, 1, '2025-01-31 21:48:17', '2025-01-31 21:48:17'),
(75, 'rey ', '$2y$10$ChtTlA1GB.LvHBGOSzyo7uiJPwErMwTj0hDPPtmro7YXbypY/7GPS', 'residents', NULL, 0, 1, 0, '2025-01-31 22:53:32', '2025-01-31 22:53:32'),
(76, 'maria', '$2y$10$zIN2Yi4hUOZJYFBpXhqS/eFh0OfGIibCJugVzxBQWaDWJjg7G0UJm', 'residents', NULL, 0, 0, 0, '2025-01-31 22:56:18', '2025-01-31 22:56:18'),
(77, 'rolino', '$2y$10$PnY01kevoWevfcknyBPXRON2kkI64xScRnDNiU1372bukb5LpAj0m', 'residents', '/bhcmis/storage/uploads/679d710776689.jpg', 0, 0, 1, '2025-02-01 08:52:25', '2025-02-01 08:55:35'),
(78, 'bhw001', '$2y$10$DapczYfB.C9oxhPrewVhK.cqGSMr2UlIOWGAqKu0jBq41YiyOzGf.', 'bhw', NULL, 0, 0, 1, '2025-02-01 10:02:34', '2025-02-01 10:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(10) NOT NULL,
  `address_name` varchar(255) NOT NULL,
  `address_type` enum('hda','sitio') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_name`, `address_type`, `created_at`, `updated_at`) VALUES
(1, 'Hda. Sta. Rosalia', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(2, 'Sto. Juancho', 'sitio', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(3, 'Sto. Cogon', 'sitio', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(4, 'GK Village', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(5, 'Sto. Gutusan', 'sitio', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(6, 'Punta Mesa Proper', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(7, 'Sitio Banquerohan', 'sitio', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(8, 'Hda. Busay', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(9, 'Hda. Bilbao', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(10, 'Hda. Lumayagan', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(11, 'Hda. Lourdes', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48'),
(12, 'Hda. Cuaycong', 'hda', '2024-12-14 11:14:48', '2024-12-14 11:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) NOT NULL,
  `account_id` int(10) NOT NULL,
  `personal_information_id` int(10) NOT NULL,
  `signature_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `account_id`, `personal_information_id`, `signature_id`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `allergies`
--

CREATE TABLE `allergies` (
  `allergy_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `allergy_type` varchar(255) NOT NULL,
  `allergen` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`allergy_id`, `resident_id`, `allergy_type`, `allergen`, `created_at`, `updated_at`) VALUES
(1, 4, 'Food', 'Peanuts', '2024-12-14 11:15:34', '2024-12-14 11:15:34'),
(2, 4, 'Drug', 'Penicillin', '2024-12-14 11:15:34', '2024-12-14 11:15:34'),
(3, 4, 'Environmental', 'Pollen', '2024-12-14 11:15:34', '2024-12-14 11:15:34'),
(4, 5, 'Food', 'Seafood', '2024-12-14 11:15:34', '2024-12-14 11:15:34'),
(5, 5, 'Insect', 'Bee Sting', '2024-12-14 11:15:34', '2024-12-14 11:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `annual_population`
--

CREATE TABLE `annual_population` (
  `population_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `total_population` int(11) NOT NULL,
  `growth_rate` decimal(10,2) NOT NULL,
  `total_males` int(11) NOT NULL,
  `total_females` int(11) NOT NULL,
  `deceased_count` int(11) DEFAULT 0,
  `transferred_count` int(11) DEFAULT 0,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annual_population`
--

INSERT INTO `annual_population` (`population_id`, `year`, `total_population`, `growth_rate`, `total_males`, `total_females`, `deceased_count`, `transferred_count`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, '2023', 10, 15.00, 6, 4, 0, 0, 0, '2024-11-20 14:56:49', '2024-11-22 02:01:30'),
(2, '2024', 13, 30.00, 8, 5, 0, 0, 0, '2024-11-20 16:20:46', '2024-11-22 02:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(10) NOT NULL,
  `tracking_code` varchar(100) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `priority_number` int(10) NOT NULL,
  `status` enum('Scheduled','Cancelled','Completed') NOT NULL DEFAULT 'Scheduled',
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `tracking_code`, `resident_id`, `sched_id`, `priority_number`, `status`, `isArchived`, `created_at`, `updated_at`) VALUES
(42, '0D020BC13797077E', 4, 21, 1, 'Cancelled', 0, '2024-12-28 08:45:58', '2024-12-28 08:45:58'),
(43, '6479673D4C3C3C53', 4, 9, 1, 'Completed', 0, '2024-12-29 14:14:17', '2024-12-29 14:14:17'),
(46, 'HC426030764786PH', 4, 16, 1, 'Cancelled', 0, '2025-01-07 06:57:42', '2025-01-07 06:57:42'),
(47, 'HC919870150989PH', 4, 12, 1, 'Completed', 0, '2025-01-07 07:03:46', '2025-01-07 07:03:46'),
(48, 'HC689854855513PH', 4, 13, 1, 'Cancelled', 0, '2025-01-07 07:09:18', '2025-01-07 07:09:18'),
(49, 'HC966037477876PH', 163, 22, 1, 'Completed', 0, '2025-01-30 18:56:27', '2025-01-30 18:56:27'),
(51, 'CC5110AD018CB2AD', 166, 23, 1, 'Scheduled', 0, '2025-01-31 15:22:22', '2025-01-31 15:22:22'),
(52, 'HC441294780762PH', 4, 22, 2, 'Completed', 0, '2025-01-31 23:08:16', '2025-01-31 23:08:16'),
(53, 'HC572153444548PH', 187, 23, 2, 'Scheduled', 0, '2025-02-01 00:56:55', '2025-02-01 00:56:55'),
(54, 'HC212041983853PH', 5, 22, 3, 'Completed', 0, '2025-02-01 01:15:53', '2025-02-01 01:15:53');

-- --------------------------------------------------------

--
-- Table structure for table `bhw`
--

CREATE TABLE `bhw` (
  `bhw_id` int(10) NOT NULL,
  `account_id` int(10) NOT NULL,
  `personal_info_id` int(10) NOT NULL,
  `assigned_area` int(10) NOT NULL,
  `date_started` date NOT NULL DEFAULT current_timestamp(),
  `employment_status` enum('active','inactive','on_leave') NOT NULL DEFAULT 'active',
  `signature_id` int(10) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bhw`
--

INSERT INTO `bhw` (`bhw_id`, `account_id`, `personal_info_id`, `assigned_area`, `date_started`, `employment_status`, `signature_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 6, '2018-07-10', 'active', NULL, 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(2, 6, 6, 10, '2019-06-18', 'active', NULL, 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(3, 7, 8, 1, '2018-09-10', 'active', NULL, 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(4, 8, 10, 4, '2015-04-21', 'active', NULL, 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(15, 67, 141, 2, '2018-07-28', 'active', NULL, 0, '2025-01-31 21:24:40', '2025-01-31 21:24:40'),
(16, 68, 142, 3, '2018-06-21', 'active', NULL, 0, '2025-01-31 21:31:00', '2025-01-31 21:31:00'),
(17, 69, 149, 8, '2018-12-11', 'active', NULL, 0, '2025-01-31 21:35:56', '2025-01-31 21:35:56'),
(18, 70, 143, 12, '2018-05-17', 'active', NULL, 0, '2025-01-31 21:36:42', '2025-01-31 21:36:42'),
(19, 71, 144, 11, '2020-03-10', 'active', NULL, 0, '2025-01-31 21:37:05', '2025-01-31 21:37:05'),
(20, 72, 145, 7, '2016-11-07', 'active', NULL, 0, '2025-01-31 21:39:52', '2025-01-31 21:39:52'),
(21, 73, 146, 5, '2019-06-10', 'active', NULL, 0, '2025-01-31 21:47:12', '2025-01-31 21:47:12'),
(22, 74, 147, 9, '2018-10-09', 'active', NULL, 0, '2025-01-31 21:48:17', '2025-01-31 21:48:17'),
(23, 78, 13, 6, '2025-02-01', 'active', NULL, 0, '2025-02-01 10:02:34', '2025-02-01 10:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `brgy_captain`
--

CREATE TABLE `brgy_captain` (
  `brgy_captain_id` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `signature_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `brgy_captain`
--

INSERT INTO `brgy_captain` (`brgy_captain_id`, `full_name`, `signature_id`) VALUES
(1, 'Ernesto Victorino', 5);

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `consultation_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `appointment_id` int(10) DEFAULT NULL,
  `reason_for_visit` varchar(100) NOT NULL,
  `sched_id` int(10) DEFAULT NULL,
  `symptoms` varchar(255) DEFAULT NULL,
  `weight_kg` decimal(5,2) DEFAULT NULL,
  `temperature` varchar(100) DEFAULT NULL,
  `heart_rate` varchar(100) DEFAULT NULL,
  `respiratory_rate` varchar(100) DEFAULT NULL,
  `blood_pressure` varchar(100) DEFAULT NULL,
  `cholesterol_level` varchar(100) DEFAULT NULL,
  `physical_findings` text DEFAULT NULL,
  `refer_to` varchar(255) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`consultation_id`, `resident_id`, `appointment_id`, `reason_for_visit`, `sched_id`, `symptoms`, `weight_kg`, `temperature`, `heart_rate`, `respiratory_rate`, `blood_pressure`, `cholesterol_level`, `physical_findings`, `refer_to`, `isArchived`, `created_at`, `updated_at`) VALUES
(22, 4, NULL, 'Fever', 9, 'headache, fever, vomiting', 58.00, '48', '120', 'None', '120/80', 'Normal', 'Patient\'s vital signs are normal; continue with current health regimen and routine check-ups.', 'Victorias Health Center', 0, '2024-07-25 08:42:04', '2024-07-25 08:42:04'),
(29, 4, 43, 'nabuno ka lapis', 9, 'fever, sneeze', 55.00, '36', NULL, NULL, '120/60', NULL, NULL, NULL, 0, '2024-12-29 14:14:44', '2024-12-29 14:14:44'),
(30, 163, 49, 'Check-up', 22, 'Cough', 32.00, '34', '60', NULL, '120/60', '180', 'Phlegm ', 'Doctor Bins', 0, '2025-01-31 09:25:03', '2025-01-31 09:25:03'),
(31, 4, 52, 'Kagat ka ido', 22, 'fever, headache', 55.00, '36', '120', NULL, '119/18', '180', 'Need to inject anti rabies', 'None', 0, '2025-01-31 23:10:22', '2025-01-31 23:10:22'),
(32, 4, 47, 'natunok ka lansang', 12, 'fever, pain in feet', 40.00, '34', '120', 'None', '116/91', 'Normal', 'Minor injuries in feet', 'None', 0, '2025-02-01 01:06:57', '2025-02-01 01:06:57'),
(33, 5, 54, 'checkup', 22, 'cough, high temperature', 56.00, '34', '110', NULL, '117/78', 'Normal', 'No abnormal findings', '', 0, '2025-02-01 01:18:34', '2025-02-01 01:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `consultations_prescriptions`
--

CREATE TABLE `consultations_prescriptions` (
  `medication_id` int(10) NOT NULL,
  `consultation_id` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `instructions` text DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultations_prescriptions`
--

INSERT INTO `consultations_prescriptions` (`medication_id`, `consultation_id`, `medicine_id`, `quantity`, `instructions`, `isArchived`, `created_at`, `updated_at`) VALUES
(7, 22, 27, 1, 'Before dinner', 0, '2024-12-22 21:32:52', '2024-12-22 21:32:52'),
(8, 22, 34, 5, '3X a day', 0, '2024-12-24 18:57:15', '2024-12-24 18:57:15'),
(15, 30, 36, 3, '3 times a day', 0, '2025-01-31 09:26:04', '2025-01-31 09:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_schedules`
--

CREATE TABLE `consultation_schedules` (
  `con_sched_id` int(10) NOT NULL,
  `con_sched_date` datetime NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultation_schedules`
--

INSERT INTO `consultation_schedules` (`con_sched_id`, `con_sched_date`, `isArchived`, `created_at`, `updated_at`) VALUES
(9, '2024-12-23 12:00:00', 0, '2024-12-19 22:59:53', '2024-12-19 22:59:53'),
(10, '2025-01-07 12:00:00', 0, '2024-12-19 23:19:57', '2024-12-19 23:19:57'),
(11, '2025-01-07 12:00:00', 1, '2024-12-19 23:20:05', '2024-12-23 02:26:08'),
(12, '2025-01-09 12:00:00', 0, '2024-12-19 23:21:00', '2024-12-19 23:21:00'),
(13, '2025-01-08 12:00:00', 0, '2024-12-19 23:22:16', '2024-12-19 23:22:16'),
(14, '2024-12-12 12:00:00', 1, '2024-12-19 23:23:51', '2024-12-25 04:07:31'),
(15, '2024-12-10 12:00:00', 0, '2024-12-19 23:25:49', '2024-12-19 23:25:49'),
(16, '2024-12-04 12:00:00', 1, '2024-12-19 23:29:36', '2024-12-25 04:05:10'),
(18, '2024-12-05 08:00:00', 1, '2024-12-23 02:15:58', '2024-12-23 02:25:05'),
(19, '2024-12-14 07:31:00', 1, '2024-12-23 03:44:48', '2024-12-23 03:44:56'),
(20, '2024-12-25 08:00:00', 0, '2024-12-25 04:05:29', '2024-12-25 04:05:29'),
(21, '2024-12-28 12:00:00', 0, '2024-12-28 16:45:50', '2024-12-28 16:45:50'),
(22, '2025-02-01 08:00:00', 0, '2025-01-31 02:55:33', '2025-01-31 02:55:33'),
(23, '2025-02-05 12:00:00', 0, '2025-01-31 18:11:46', '2025-01-31 18:11:46'),
(24, '2025-01-31 12:00:00', 0, '2025-01-31 21:50:58', '2025-01-31 21:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` int(10) NOT NULL,
  `parent_family_id` int(10) DEFAULT NULL,
  `4PsMember` tinyint(1) NOT NULL DEFAULT 0,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `parent_family_id`, `4PsMember`, `isArchived`, `created_at`, `updated_at`) VALUES
(1001, NULL, 1, 0, '2024-12-14 11:21:49', '2024-12-14 11:21:49'),
(1002, 1001, 1, 0, '2024-12-14 11:21:49', '2024-12-14 11:21:49'),
(1027, NULL, 0, 0, '2025-01-30 11:16:07', '2025-01-30 11:16:07'),
(1028, 1027, 0, 0, '2025-01-30 11:22:10', '2025-01-30 11:22:10'),
(1029, NULL, 0, 0, '2025-01-31 15:59:07', '2025-01-31 15:59:07'),
(1030, NULL, 1, 0, '2025-01-31 17:36:54', '2025-01-31 17:36:54'),
(1031, NULL, 0, 0, '2025-01-31 20:09:17', '2025-01-31 20:09:17'),
(1032, NULL, 0, 0, '2025-01-31 21:23:14', '2025-01-31 21:23:14'),
(1033, NULL, 0, 0, '2025-01-31 22:14:17', '2025-01-31 22:14:17'),
(1034, NULL, 0, 0, '2025-02-01 08:49:19', '2025-02-01 08:49:19'),
(1035, NULL, 0, 0, '2025-02-01 09:26:24', '2025-02-01 09:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `fmember_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `role` enum('husband','wife','child') NOT NULL,
  `own_family_id` int(10) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`fmember_id`, `family_id`, `resident_id`, `role`, `own_family_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 1001, 4, 'husband', NULL, 0, '2024-12-14 11:23:02', '2024-12-14 22:48:06'),
(2, 1001, 5, 'wife', NULL, 0, '2024-12-14 11:23:02', '2024-12-14 23:17:49'),
(56, 1001, 99, 'child', 1002, 0, '2024-12-14 11:23:02', '2024-12-14 23:28:03'),
(58, 1002, 99, 'husband', NULL, 0, '2024-12-14 11:23:02', '2024-12-14 11:23:02'),
(59, 1001, 157, 'child', NULL, 0, '2025-01-09 02:09:15', '2025-01-09 02:09:15'),
(64, 1027, 162, 'husband', NULL, 0, '2025-01-30 11:19:37', '2025-01-30 11:19:37'),
(65, 1029, 164, 'husband', NULL, 0, '2025-01-31 15:59:57', '2025-01-31 16:32:07'),
(66, 1029, 165, 'wife', NULL, 0, '2025-01-31 16:29:24', '2025-01-31 16:29:24'),
(67, 1030, 166, 'husband', NULL, 0, '2025-01-31 17:38:30', '2025-01-31 17:40:02'),
(68, 1030, 167, 'wife', NULL, 0, '2025-01-31 17:39:46', '2025-01-31 17:39:46'),
(69, 1031, 168, 'husband', NULL, 0, '2025-01-31 20:10:13', '2025-01-31 20:10:13'),
(70, 1031, 169, 'wife', NULL, 0, '2025-01-31 20:11:32', '2025-01-31 20:11:32'),
(71, 1031, 170, 'child', NULL, 0, '2025-01-31 20:16:05', '2025-01-31 20:16:05'),
(72, 1027, 171, 'wife', NULL, 0, '2025-01-31 20:44:28', '2025-01-31 20:44:28'),
(73, 1027, 172, 'child', NULL, 0, '2025-01-31 20:47:16', '2025-01-31 20:47:16'),
(74, 1028, 173, 'husband', NULL, 0, '2025-01-31 20:54:17', '2025-01-31 20:54:17'),
(75, 1028, 174, 'wife', NULL, 0, '2025-01-31 20:55:20', '2025-01-31 20:55:20'),
(76, 1032, 175, 'wife', NULL, 0, '2025-01-31 21:24:09', '2025-01-31 21:24:09'),
(77, 1032, 176, 'child', NULL, 0, '2025-01-31 21:30:30', '2025-01-31 21:30:30'),
(78, 1032, 177, 'child', NULL, 0, '2025-01-31 21:33:36', '2025-01-31 21:33:36'),
(79, 1032, 178, 'child', NULL, 0, '2025-01-31 21:34:14', '2025-01-31 21:34:14'),
(80, 1032, 179, 'husband', NULL, 0, '2025-01-31 21:35:15', '2025-01-31 21:35:15'),
(81, 1032, 180, 'child', NULL, 0, '2025-01-31 21:46:03', '2025-01-31 21:46:03'),
(82, 1032, 181, 'child', NULL, 0, '2025-01-31 21:46:44', '2025-01-31 21:46:44'),
(83, 1033, 182, 'husband', NULL, 0, '2025-01-31 22:15:06', '2025-01-31 22:15:06'),
(84, 1032, 183, 'child', NULL, 0, '2025-01-31 22:35:37', '2025-01-31 22:35:37'),
(85, 1034, 186, 'husband', NULL, 0, '2025-02-01 08:50:34', '2025-02-01 08:50:34'),
(86, 1030, 188, 'child', NULL, 0, '2025-02-01 09:25:36', '2025-02-01 09:25:36'),
(87, 1035, 189, 'husband', NULL, 0, '2025-02-01 09:27:21', '2025-02-01 09:27:21'),
(88, 1035, 190, 'wife', NULL, 0, '2025-02-01 09:28:32', '2025-02-01 09:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `health_information`
--

CREATE TABLE `health_information` (
  `health_information_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `blood_type` enum('A','B','AB','O') DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `health_information`
--

INSERT INTO `health_information` (`health_information_id`, `resident_id`, `blood_type`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 4, 'B', 0, '2024-07-25 08:37:06', '2024-12-14 11:23:29'),
(2, 5, 'B', 0, '2024-07-25 08:37:06', '2024-12-14 11:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `household_id` int(10) NOT NULL,
  `address_id` int(10) NOT NULL,
  `year_resided` year(4) DEFAULT NULL,
  `housing_type` enum('Owned','Rented','Other') NOT NULL,
  `construction_materials` enum('light','strong') NOT NULL,
  `lighting_facilities` enum('electricity','kerosene') NOT NULL,
  `water_source` enum('Point Source','Communal Faucet','Individual Connection','OTHERS') NOT NULL,
  `toilet_facility` enum('Pointflush type','Ventilated Pit','Overhung Latrine','Without toilet') NOT NULL,
  `recorded_by` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `address_id`, `year_resided`, `housing_type`, `construction_materials`, `lighting_facilities`, `water_source`, `toilet_facility`, `recorded_by`, `isArchived`, `created_at`, `updated_at`) VALUES
(1001, 10, '2002', 'Owned', 'strong', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2024-12-02 10:31:14', '2024-12-02 10:31:39'),
(1002, 6, '2015', 'Rented', 'strong', 'electricity', 'Individual Connection', 'Pointflush type', 1, 0, '2024-12-02 10:31:14', '2024-12-02 10:31:39'),
(1024, 6, '2021', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2025-01-30 11:15:36', '2025-01-30 11:15:36'),
(1025, 1, '1909', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 2, 0, '2025-01-31 17:34:24', '2025-01-31 17:34:24'),
(1026, 6, '1992', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 2, 0, '2025-01-31 17:34:36', '2025-01-31 17:34:36'),
(1029, 6, '2005', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2025-01-31 21:22:27', '2025-01-31 21:22:27'),
(1030, 3, '2007', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2025-01-31 21:26:55', '2025-01-31 21:26:55'),
(1031, 6, '2001', 'Owned', 'light', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2025-01-31 21:27:14', '2025-01-31 21:27:14'),
(1032, 4, '2023', 'Owned', 'strong', 'electricity', 'Point Source', 'Pointflush type', 4, 0, '2025-02-01 09:26:11', '2025-02-01 09:26:11');

-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `hm_id` int(10) NOT NULL,
  `household_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `household_members`
--

INSERT INTO `household_members` (`hm_id`, `household_id`, `family_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 1001, 1001, 0, '2024-12-14 11:25:24', '2024-12-14 11:25:24'),
(2, 1001, 1002, 0, '2024-12-14 11:25:24', '2024-12-14 11:25:24'),
(48, 1024, 1027, 0, '2025-01-30 11:16:07', '2025-01-30 11:16:07'),
(49, 1024, 1028, 0, '2025-01-30 11:22:10', '2025-01-30 11:22:10'),
(50, 1002, 1029, 0, '2025-01-31 15:59:07', '2025-01-31 15:59:07'),
(51, 1025, 1030, 0, '2025-01-31 17:36:54', '2025-01-31 17:36:54'),
(52, 1026, 1031, 0, '2025-01-31 20:09:17', '2025-01-31 20:09:17'),
(53, 1029, 1032, 0, '2025-01-31 21:23:14', '2025-01-31 21:23:14'),
(54, 1031, 1033, 0, '2025-01-31 22:14:17', '2025-01-31 22:14:17'),
(55, 1002, 1034, 0, '2025-02-01 08:49:19', '2025-02-01 08:49:19'),
(56, 1032, 1035, 0, '2025-02-01 09:26:24', '2025-02-01 09:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `immunization_id` int(10) NOT NULL,
  `appointment_id` int(10) NOT NULL,
  `route` enum('intramuscular','oral','intradermal') NOT NULL DEFAULT 'intramuscular',
  `administered_by` varchar(100) NOT NULL,
  `dose_number` tinyint(3) NOT NULL,
  `next_dose_due` int(10) DEFAULT NULL,
  `adverse_reaction` text DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`immunization_id`, `appointment_id`, `route`, `administered_by`, `dose_number`, `next_dose_due`, `adverse_reaction`, `isArchived`, `created_at`, `updated_at`) VALUES
(13, 9, 'intramuscular', 'Midwife Reyna Singua', 1, NULL, 'None', 0, '2025-02-01 06:51:36', '2025-02-01 06:51:36');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_appointments`
--

CREATE TABLE `immunization_appointments` (
  `appointment_id` int(10) NOT NULL,
  `tracking_code` varchar(100) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `priority_number` int(100) NOT NULL,
  `status` enum('Scheduled','Completed','Missed','Cancelled') NOT NULL DEFAULT 'Scheduled',
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `immunization_appointments`
--

INSERT INTO `immunization_appointments` (`appointment_id`, `tracking_code`, `resident_id`, `sched_id`, `priority_number`, `status`, `isArchived`, `created_at`, `updated_at`) VALUES
(9, '36C1470009F8BFD2', 4, 5, 1, 'Completed', 0, '2025-01-31 09:08:23', '2025-01-31 22:51:36'),
(10, 'F365C99DDC0DFC5F', 99, 5, 2, 'Scheduled', 0, '2025-01-31 09:08:36', '2025-01-31 09:08:36'),
(11, '1665AF27A6405D89', 163, 5, 3, 'Scheduled', 0, '2025-01-31 14:41:13', '2025-01-31 14:41:13'),
(12, 'FBB2CC12EAB2A6A1', 4, 6, 1, 'Scheduled', 0, '2025-01-31 23:08:26', '2025-01-31 23:08:26');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_schedules`
--

CREATE TABLE `immunization_schedules` (
  `schedule_id` int(10) NOT NULL,
  `schedule_date` datetime NOT NULL,
  `vaccine_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `immunization_schedules`
--

INSERT INTO `immunization_schedules` (`schedule_id`, `schedule_date`, `vaccine_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(5, '2025-01-31 17:08:01', 16, 0, '2025-01-31 17:08:17', '2025-01-31 17:08:17'),
(6, '2025-02-03 08:00:00', 25, 0, '2025-02-01 06:48:53', '2025-02-01 06:48:53'),
(7, '2025-02-04 07:30:00', 18, 0, '2025-02-01 06:49:15', '2025-02-01 06:49:15');

-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions`
--

CREATE TABLE `medical_conditions` (
  `medical_conditions_id` int(10) NOT NULL,
  `condition_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medical_conditions`
--

INSERT INTO `medical_conditions` (`medical_conditions_id`, `condition_name`, `created_at`) VALUES
(1, 'Arthritis', '2024-12-14 11:26:18'),
(2, 'Asthma', '2024-12-14 11:26:18'),
(3, 'Cancer', '2024-12-14 11:26:18'),
(4, 'Heart Disease', '2024-12-14 11:26:18'),
(9, 'Alzheimer\'s Disease', '2024-12-14 11:26:18'),
(10, 'Anxiety', '2024-12-14 11:26:18'),
(11, 'Appendicitis', '2024-12-14 11:26:18'),
(12, 'Bipolar Disorder', '2024-12-14 11:26:18'),
(13, 'Bone Cancer', '2024-12-14 11:26:18'),
(14, 'Breast Cancer', '2024-12-14 11:26:18'),
(15, 'Brain Tumor', '2024-12-14 11:26:18'),
(16, 'Bronchitis', '2024-12-14 11:26:18'),
(17, 'Cerebral Palsy', '2024-12-14 11:26:18'),
(18, 'Current Wound/Skin Problems', '2024-12-14 11:26:18'),
(19, 'Stroke', '2024-12-14 11:26:18'),
(20, 'Bone/Joint Problems', '2024-12-14 11:26:18'),
(21, 'Bowel/Bladder Problems', '2024-12-14 11:26:18'),
(22, 'History of heavy alcohol use', '2024-12-14 11:26:18'),
(23, 'Drug use', '2024-12-14 11:26:18'),
(24, 'Smoking habits', '2024-12-14 11:26:18'),
(26, 'Kidney Problems', '2024-12-14 11:26:18'),
(27, 'Sleeping Problems', '2024-12-14 11:26:18'),
(28, 'Autism', '2024-12-14 11:26:18'),
(29, 'Acne', '2024-12-14 11:26:18'),
(30, 'Tuberculosis', '2024-12-14 11:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `medicine_id` int(10) NOT NULL,
  `batch_number` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `generic_name` varchar(255) DEFAULT NULL,
  `dosage` varchar(50) NOT NULL,
  `form` varchar(50) NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `quantity_in_stock` int(10) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `batch_number`, `name`, `generic_name`, `dosage`, `form`, `expiry_date`, `quantity_in_stock`, `description`, `isArchived`, `created_at`, `updated_at`) VALUES
(21, 'A1B2C3', 'Paracetamol', 'Paracetamol', '500 mg', 'Tablet', '2025-12-31', 200, 'Pain reliever and fever reducer', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(22, 'D4E5F6', 'Ibuprofen', 'Ibuprofen', '400 mg', 'Tablet', '2024-11-30', 150, 'Anti-inflammatory and pain relief', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(23, 'G7H8I9', 'Amoxicillin', 'Amoxicillin', '500 mg', 'Capsule', '2024-08-31', 100, 'Antibiotic used to treat infections', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(24, 'J1K2L9', 'Aspirin', 'Acetylsalicylic Acid', '100 mg', 'Tablet', '2025-03-15', 250, 'Pain relief and anti-inflammatory', 0, '2024-07-25 01:23:05', '2024-12-17 21:52:29'),
(25, 'M4N5O6', 'Loperamide', 'Loperamide', '2 mg', 'Capsule', '2024-10-01', 80, 'Anti-diarrheal', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(26, 'P7Q8R9', 'Cetirizine', 'Cetirizine', '10 mg', 'Tablet', '2025-05-20', 180, 'Antihistamine for allergies', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(27, 'S1T2U3', 'Metformin', 'Metformin', '500 mg', 'Tablet', '2024-12-31', 120, 'Medication for type 2 diabetes', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(28, 'V4W5X6', 'Cough Syrup', 'Dextromethorphan', '100 ml', 'Syrup', '2024-07-15', 90, 'Relieves cough and throat irritation', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(29, 'Y7Z8A9', 'Salbutamol', 'Salbutamol', '100 mcg', 'Inhaler', '2025-09-30', 70, 'Bronchodilator for asthma', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(30, 'B1C2D3', 'Omeprazole', 'Omeprazole', '20 mg', 'Capsule', '2025-01-10', 110, 'Reduces stomach acid production', 0, '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(31, 'E4F5G6', 'Biogesic', 'Paracetamol', '500mg', 'Tablet', '2025-12-31', 24, 'For fever and mild to moderate pain relief.', 0, '2024-09-22 12:15:55', '2024-12-28 01:57:46'),
(32, 'H7I8J9', 'Alaxan FR', 'Ibuprofen + Paracetamol', '200mg + 325mg', 'Tablet', '2026-06-30', 80, 'For pain and inflammation relief.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(33, 'K1L2M3', 'Amoxicillin', 'Amoxicillin', '500mg', 'Capsule', '2024-11-15', 50, 'Antibiotic for bacterial infections.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(34, 'N4O5P6', 'Ascof Lagundi', 'Vitex Negundo', '300mg', 'Syrup', '2025-03-20', 30, 'Herbal cough remedy.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(35, 'Q7R8S9', 'Bioflu', 'Phenylephrine HCl, Chlorphenamine Maleate, Paracetamol', '10mg/2mg/500mg', 'Tablet', '2025-07-12', 115, 'For flu and common cold symptoms.', 0, '2024-09-22 12:15:55', '2024-12-28 08:26:15'),
(36, 'T1U2V3', 'Neozep Forte', 'Phenylephrine HCl, Chlorphenamine Maleate, Paracetamol', '10mg/2mg/500mg', 'Tablet', '2024-09-15', 87, 'For colds, allergies, and headache relief.', 0, '2024-09-22 12:15:55', '2025-01-31 09:26:04'),
(37, 'W4X5Y9', 'Kremil-S', 'Aluminum Hydroxide + Magnesium Hydroxide + Simethicone', '178mg/233mg/30mg', 'Tablet', '2025-04-09', 60, 'For hyperacidity and indigestion.', 0, '2024-09-22 12:15:55', '2024-12-16 15:39:23'),
(38, 'Z7A8B0', 'Mefenamic Acid', 'Mefenamic Acid', '500mg', 'Tablet', '2026-08-10', 70, 'For pain relief such as headaches and dysmenorrhea.', 0, '2024-09-22 12:15:55', '2024-12-17 21:54:37'),
(39, 'C1D2E3', 'Cefalexin', 'Cefalexin', '500mg', 'Capsule', '2025-05-25', 40, 'Antibiotic for bacterial infections.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(40, 'F4G5H6', 'Salbutamol', 'Salbutamol', '2mg/5ml', 'Syrup', '2024-12-20', 45, 'For asthma and bronchospasm relief.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55');

-- --------------------------------------------------------

--
-- Table structure for table `midwife`
--

CREATE TABLE `midwife` (
  `midwife_id` int(10) NOT NULL,
  `account_id` int(10) NOT NULL,
  `personal_info_id` int(10) NOT NULL,
  `employment_status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `employment_date` date NOT NULL DEFAULT current_timestamp(),
  `signature_id` int(10) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `midwife`
--

INSERT INTO `midwife` (`midwife_id`, `account_id`, `personal_info_id`, `employment_status`, `employment_date`, `signature_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 'active', '2016-07-12', 3, 0, '2024-12-14 11:27:58', '2024-12-14 11:27:58');

-- --------------------------------------------------------

--
-- Table structure for table `personal_information`
--

CREATE TABLE `personal_information` (
  `personal_info_id` int(10) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `civil_status` enum('Single','Married','Widowed','Legally Separated') DEFAULT NULL,
  `educational_attainment` enum('Elementary Graduate','Elementary Undergraduate','Highschool Graduate','Highschool Undergraduate','College Graduate','College Undergraduate') DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `citizenship` varchar(100) DEFAULT NULL,
  `address_id` int(10) DEFAULT NULL,
  `sex` enum('male','female') NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `id_picture` varchar(255) DEFAULT NULL,
  `isTransferred` tinyint(1) NOT NULL DEFAULT 0,
  `isDeceased` tinyint(1) NOT NULL DEFAULT 0,
  `isRegisteredVoter` tinyint(1) NOT NULL DEFAULT 1,
  `deceased_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`personal_info_id`, `lastname`, `firstname`, `middlename`, `date_of_birth`, `civil_status`, `educational_attainment`, `occupation`, `religion`, `citizenship`, `address_id`, `sex`, `phone_number`, `email`, `id_picture`, `isTransferred`, `isDeceased`, `isRegisteredVoter`, `deceased_date`, `created_at`, `updated_at`) VALUES
(1, 'Victorino', 'Amiel Jose', 'Lacsi', '2002-03-06', 'Married', 'College Graduate', 'Brgy. Secretary', 'Stairway to Heaven', 'Filipino', 6, 'male', '09308309699', 'amieljosevictorino@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2025-01-27 04:29:22'),
(2, 'Alto', 'Liza', 'C', '1994-03-09', 'Married', 'College Graduate', 'Brgy. Midwife', 'Roman Catholic', 'Filipino', 6, 'female', '09851354580', 'lizaalto@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2025-01-31 23:12:45'),
(3, 'Gonzales', 'Ann', 'Ramos', '1978-11-15', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 3, 'male', '09331234567', 'anngonzales@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 12:56:54'),
(4, 'Bagolcol', 'Myvel', '', '1985-07-16', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 4, 'female', '09441234500', 'myvelbagolcol@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 14:08:19'),
(5, 'Mendoza', 'May', 'Alvarez', '1996-12-04', 'Single', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 5, 'male', '09551234567', 'carlos.mendoza@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(6, 'Batolina', 'Evelyn', '', '1987-07-05', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 6, 'female', '09661234567', 'evelynbatolina@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2025-01-31 21:07:34'),
(7, 'Santos', 'Isabel', 'Navarro', '1983-06-25', 'Legally Separated', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 7, 'female', '09771234567', 'isabel.santos@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(8, 'Batolina', 'Roselle', '', '1973-01-10', 'Married', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 8, 'female', '09881234567', 'rosellebatolina@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2025-01-31 21:13:50'),
(9, 'Morales', 'Elena', 'Garcia', '1999-04-20', 'Single', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 9, 'male', '09991234567', 'elena.morales@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-07 08:42:29'),
(10, 'ParreÃ±as', 'Liza', '', '1981-08-14', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 10, 'male', '09182345678', 'lizaparrenas@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-10 10:44:05'),
(13, 'Araneta', 'Roy Marjohn', 'Catapang', '2000-04-13', 'Single', 'Highschool Graduate', 'Businessman', 'Iglesia ni Cristo', 'Filipinos', 6, 'male', '09308309599', 'iven.loro@csav.edu.ph', NULL, 0, 0, 1, NULL, '2024-07-16 11:07:25', '2025-01-31 16:39:01'),
(14, 'Angcona', 'Rovie', 'Singua', '2002-03-04', 'Married', 'College Undergraduate', 'Businesswoman', 'Baptist', 'Filipino', 6, 'female', '09586789012', 'rovieangcona@gmail.com', NULL, 0, 0, 1, NULL, '2024-07-16 11:07:25', '2025-01-31 23:09:23'),
(67, 'Araneta Jr.', 'Roy Marjohn', 'Perez', '2015-08-05', 'Single', 'Elementary Graduate', 'Student', 'Filipino', 'Roman Catholic', 6, 'male', '', '', NULL, 0, 0, 0, NULL, '2024-07-17 11:07:25', '2024-12-14 23:40:34'),
(124, 'Araneta', 'Jay-v', 'Madoles', '2015-01-08', 'Single', NULL, NULL, NULL, NULL, 1, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-01-09 02:08:26', '2025-01-09 02:08:26'),
(129, 'Catapang', 'Ron Christopher', 'Sta Ana', '1979-07-16', 'Married', 'College Graduate', 'Businessman', 'Roman Catholic', 'Filipino', 6, 'male', '09519685225', 'catapangron18@gmail.com', '/bhcmis/storage/uploads/id-resident-1738208518.png', 0, 0, 1, NULL, '2025-01-30 11:19:36', '2025-01-31 20:50:04'),
(130, 'Victorino', 'Amiel Jose', 'Desalisa', '1987-03-16', 'Married', 'College Graduate', 'Farmer', 'Iglesia ni Cristo', 'Filipino', NULL, 'male', '09785962175', 'amieljose@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 15:59:57', '2025-01-31 20:29:58'),
(131, 'Victorino', 'Reyna Jane', 'Gasparillo', '1994-06-05', 'Married', 'College Graduate', 'Student', 'Iglesia ni Cristo', 'Filipino', NULL, 'female', '09308309599', 'reynajane@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 16:29:24', '2025-01-31 20:06:36'),
(132, 'Loro', 'Iven', 'B', '2003-03-12', 'Married', 'College Graduate', 'IT Programmer', 'Roman Catholic', 'Filipino', NULL, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-01-31 17:38:30', '2025-01-31 17:38:30'),
(133, 'Loro', 'Gelli', 'B', '2003-06-19', 'Married', 'College Graduate', 'Botanist', 'Roman Catholic', 'Filipino', NULL, 'female', '09308309530', 'lorogelli@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 17:39:46', '2025-01-31 20:13:44'),
(134, 'Desalisa ', 'Vince', 'Sorilla', '1997-07-07', 'Married', 'College Undergraduate', 'Farmer', 'Catholic', 'Filipino', NULL, 'male', NULL, NULL, NULL, 0, 1, 1, '2025-01-15', '2025-01-31 20:10:13', '2025-01-31 22:02:42'),
(135, 'Desalisa', 'Pewert Jane', 'Cugon', '1998-04-16', 'Married', 'College Graduate', 'Teacher', 'Catholic', 'Filipino', NULL, 'female', NULL, NULL, NULL, 1, 0, 1, NULL, '2025-01-31 20:11:32', '2025-01-31 21:58:31'),
(136, 'Desalisa', 'Ben', 'Cugon', '2022-06-20', 'Single', 'Elementary Undergraduate', NULL, 'Catholic', 'Filipino', NULL, 'male', NULL, NULL, NULL, 0, 0, 0, NULL, '2025-01-31 20:16:05', '2025-01-31 20:17:12'),
(137, 'Catapang ', 'Angel', 'Cruz', '1984-07-15', 'Married', 'College Graduate', 'Teacher', 'Catholic', 'Filipino', NULL, 'female', '', '', NULL, 0, 0, 1, NULL, '2025-01-31 20:44:28', '2025-01-31 20:50:33'),
(138, 'Catapang', 'Nathan', 'Cruz', '1996-07-15', 'Married', 'College Graduate', 'Teacher', 'Catholic', 'Filipino', NULL, 'male', '09308309530', 'nathancatapang@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 20:47:16', '2025-01-31 20:51:02'),
(139, 'Catapang', 'Nathan', 'Cruz', '1996-07-15', 'Married', 'College Graduate', 'Teacher', 'Catholic', 'Filipino', NULL, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-01-31 20:54:17', '2025-01-31 20:54:17'),
(140, 'Catapang', 'Mary Jane', 'Dalto', '1999-08-18', 'Married', 'College Graduate', 'Teacher', 'Catholic', 'Filipino', NULL, 'female', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-01-31 20:55:20', '2025-01-31 20:55:20'),
(141, 'EÃ±osa', 'Melanie', '', '1985-02-13', 'Single', 'Elementary Graduate', '', '', '', NULL, 'female', '09853297521', 'melanieenosa@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:24:09', '2025-01-31 21:26:28'),
(142, 'Matulac', 'Felicidad', '', '1980-01-14', 'Single', 'Highschool Graduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', '09658922711', 'felicidadmatulac@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:30:30', '2025-01-31 22:29:15'),
(143, 'Leganipa', 'Lilibeth', '', '1991-11-12', 'Single', 'Highschool Undergraduate', 'BHW', 'c', 'Filipino', NULL, 'female', '0912582921', 'lilibethleganipa@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:33:36', '2025-01-31 21:33:36'),
(144, 'Astorga', 'Arly', '', '1996-06-11', 'Single', 'Highschool Graduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', '09787621952', 'arlyastorga@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:34:14', '2025-01-31 21:34:14'),
(145, 'Custodio', 'Maria Cecelia', '', '1976-09-15', 'Single', 'Highschool Graduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', '0932769210', 'mccustodio@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:35:15', '2025-01-31 21:35:15'),
(146, 'Domogho', 'Ludyline', '', '1990-05-08', 'Single', 'Highschool Undergraduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', '09428219562', 'ludylinedomogho@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:46:03', '2025-01-31 21:46:03'),
(147, 'Huevos', 'Gelyn', '', '1992-05-15', 'Single', 'College Graduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', '09893271561', 'gelynhuevos@gmail.com', NULL, 0, 0, 1, NULL, '2025-01-31 21:46:44', '2025-01-31 21:46:44'),
(148, 'Cruz', 'Rey', 'Rosalia', '1992-06-07', 'Single', 'College Graduate', 'Marine', 'Catholic', 'Filipino', NULL, 'male', NULL, NULL, NULL, 1, 0, 1, NULL, '2025-01-31 22:15:06', '2025-01-31 22:15:40'),
(149, 'Repaso', 'Marjorie', '', '1980-02-05', 'Single', 'Highschool Graduate', 'BHW', 'Catholic', 'Filipino', NULL, 'female', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-01-31 22:35:37', '2025-01-31 22:35:37'),
(150, 'Cruz', 'Rey', 'Tarrosa', '2007-06-11', NULL, NULL, NULL, NULL, NULL, 6, 'male', NULL, 'catapangron18@gmail.com', '/bhcmis/storage/uploads/id-resident-1738335212.png', 0, 0, 1, NULL, '2025-01-31 22:53:32', '2025-01-31 22:53:32'),
(151, 'Rosales', 'Maria Faith', '', '2006-06-14', NULL, NULL, NULL, NULL, NULL, 4, 'male', NULL, 'dexiedeluxe@gmail.com', '/bhcmis/storage/uploads/id-resident-1738335378.PNG', 0, 0, 1, NULL, '2025-01-31 22:56:18', '2025-01-31 22:56:18'),
(152, 'Araneta', 'Rolino', 'Labos', '1968-11-14', 'Married', 'College Graduate', 'Farmer', 'Catholic', 'Filipino', 6, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-02-01 08:50:33', '2025-02-01 08:50:33'),
(153, 'Loro', 'Gelven', 'Bayona', '2019-06-06', 'Single', 'Elementary Undergraduate', 'Student', 'Roman Catholic', 'Filipino', 1, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-02-01 09:25:36', '2025-02-01 09:25:36'),
(154, 'Bingua', 'Renato', 'Castro', '2002-05-22', 'Married', 'College Graduate', 'Businessman', 'Roman Catholic', 'Filipino', 4, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-02-01 09:27:21', '2025-02-01 09:27:21'),
(155, 'Bingua', 'Ren', 'Castro', '2000-07-05', 'Single', 'College Graduate', 'Office Accountant', 'Roman Catholic', 'Filipino', 4, 'male', NULL, NULL, NULL, 0, 0, 1, NULL, '2025-02-01 09:28:32', '2025-02-01 09:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy`
--

CREATE TABLE `pregnancy` (
  `pregnancy_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `expected_due_date` date NOT NULL,
  `pregnancy_status` enum('Ongoing','Completed','Terminated') NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pregnancy`
--

INSERT INTO `pregnancy` (`pregnancy_id`, `resident_id`, `expected_due_date`, `pregnancy_status`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 5, '2024-12-15', 'Ongoing', 0, '2024-07-25 09:49:51', '2024-10-11 07:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `prenatals`
--

CREATE TABLE `prenatals` (
  `prenatal_id` int(10) NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `pregnancy_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `heart_lungs_condition` varchar(255) DEFAULT NULL,
  `abdominal_exam` varchar(255) DEFAULT NULL,
  `fetal_heart_rate` varchar(255) DEFAULT NULL,
  `fundal_height` varchar(255) DEFAULT NULL,
  `fetal_movement` varchar(255) DEFAULT NULL,
  `checkup_notes` text DEFAULT NULL,
  `refer_to` varchar(255) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenatals`
--

INSERT INTO `prenatals` (`prenatal_id`, `tracking_code`, `pregnancy_id`, `sched_id`, `weight`, `blood_pressure`, `heart_lungs_condition`, `abdominal_exam`, `fetal_heart_rate`, `fundal_height`, `fetal_movement`, `checkup_notes`, `refer_to`, `isArchived`, `created_at`, `updated_at`) VALUES
(11, 'LASJFLJSDLFJLDJF', 1, 7, 50.00, '120/50', 'Normal', 'No problem detected', '135 bpm', '20cm', 'Active', 'Follow up in 1 week', NULL, 0, '2025-01-01 08:04:17', '2025-01-02 23:19:39'),
(12, 'D3CE951E9C764CBE', 1, 7, 57.00, '120/70', '', '', '', '', '', 'All Normal', '', 0, '2025-01-03 16:02:19', '2025-01-03 16:02:19'),
(13, 'C183E0468CFCD4BB', 1, 7, 60.00, '119/18', 'Normal', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-03 16:07:19', '2025-01-03 16:07:19'),
(15, '0001F2359DE9489B', 1, 7, 38.00, '120/50', 'Normal', 'No problems detected', '135 bpm', '20cm', 'Active', 'SDFLKDJLJFERE', 'None', 0, '2025-01-31 22:58:04', '2025-01-31 22:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_schedules`
--

CREATE TABLE `prenatal_schedules` (
  `sched_id` int(10) NOT NULL,
  `sched_date` datetime(6) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenatal_schedules`
--

INSERT INTO `prenatal_schedules` (`sched_id`, `sched_date`, `isArchived`, `created_at`, `updated_at`) VALUES
(5, '2024-11-28 13:00:00.000000', 0, '2024-12-14 11:30:22', '2024-12-14 11:30:22'),
(6, '2025-01-10 08:00:00.000000', 0, '2025-01-01 15:05:12', '2025-01-01 15:05:12'),
(7, '2025-01-11 07:30:00.000000', 0, '2025-01-01 15:44:51', '2025-01-01 15:44:51'),
(8, '2025-01-04 13:54:00.000000', 0, '2025-01-04 11:55:00', '2025-01-04 11:55:00'),
(9, '2025-02-04 13:00:00.000000', 0, '2025-01-04 11:56:36', '2025-01-04 11:56:36'),
(10, '2025-01-07 08:00:00.000000', 0, '2025-01-05 01:38:41', '2025-01-05 01:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `referral_requests`
--

CREATE TABLE `referral_requests` (
  `referral_id` int(1) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `isEmergency` tinyint(1) NOT NULL DEFAULT 0,
  `purpose` varchar(100) DEFAULT NULL,
  `child_id` int(10) DEFAULT NULL,
  `referring_physician` varchar(100) DEFAULT NULL,
  `referring_to_facility` varchar(100) DEFAULT NULL,
  `chief_complaint_brief_history` text DEFAULT NULL,
  `diagnosis` varchar(100) DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `request_date` datetime NOT NULL DEFAULT current_timestamp(),
  `resolved_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Denied') DEFAULT 'Pending',
  `document_path` varchar(100) DEFAULT NULL,
  `consultation_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `referral_requests`
--

INSERT INTO `referral_requests` (`referral_id`, `resident_id`, `isEmergency`, `purpose`, `child_id`, `referring_physician`, `referring_to_facility`, `chief_complaint_brief_history`, `diagnosis`, `action_taken`, `request_date`, `resolved_date`, `status`, `document_path`, `consultation_id`, `created_at`, `updated_at`) VALUES
(6, 4, 0, 'Further Evaluation and Management', NULL, 'Midwife Reyna Jane Gasparillo Singua', 'Barangay Punta Mesa Health Center', 'fffffffffffffff', 'fffffffffffffff', 'fffffffffffffffff', '2025-01-28 00:00:00', '2025-01-31', 'Approved', '../storage/referral_forms/referral_6_20250131_161719.pdf', 22, '2025-01-28 16:58:57', '2025-01-28 16:58:57'),
(7, 4, 1, 'For Work-up', NULL, 'Midwife Reyna Jane Gasparillo Singua', 'Victorias Health Center', 'ccccccccccccccc', 'cccccccccccccc', 'cccccccccccccc', '2025-01-28 00:00:00', NULL, 'Pending', NULL, 22, '2025-01-28 17:11:20', '2025-01-28 17:11:20'),
(8, 4, 0, 'Consultation in Bacolod', NULL, NULL, NULL, NULL, NULL, NULL, '2025-01-31 17:15:12', NULL, 'Pending', NULL, NULL, '2025-01-31 09:15:12', '2025-01-31 09:15:12'),
(9, 163, 0, NULL, NULL, 'Midwife Reyna Jane Gasparillo Singua', 'Doctor Bins', '', '', '', '2025-01-31 00:00:00', '2025-01-31', 'Approved', '../storage/referral_forms/referral_9_20250131_103044.pdf', 30, '2025-01-31 09:29:26', '2025-01-31 09:29:26');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `account_id`, `personal_info_id`, `isArchived`, `created_at`, `updated_at`) VALUES
(4, 13, 13, 0, '2024-12-14 11:31:22', '2024-12-14 11:31:22'),
(5, 14, 14, 0, '2024-12-14 11:31:22', '2024-12-14 11:31:22'),
(99, 50, 67, 0, '2024-12-14 11:31:22', '2024-12-14 11:31:22'),
(157, NULL, 124, 0, '2025-01-09 02:08:49', '2025-01-09 02:08:49'),
(162, NULL, 129, 0, '2025-01-30 11:19:37', '2025-01-30 11:19:37'),
(163, 59, 129, 0, '2025-01-30 11:41:58', '2025-01-30 11:41:58'),
(164, NULL, 130, 0, '2025-01-31 15:59:57', '2025-01-31 15:59:57'),
(165, NULL, 131, 0, '2025-01-31 16:29:24', '2025-01-31 16:29:24'),
(166, NULL, 132, 0, '2025-01-31 17:38:30', '2025-01-31 17:38:30'),
(167, NULL, 133, 0, '2025-01-31 17:39:46', '2025-01-31 17:39:46'),
(168, NULL, 134, 0, '2025-01-31 20:10:13', '2025-01-31 20:10:13'),
(169, NULL, 135, 0, '2025-01-31 20:11:32', '2025-01-31 20:11:32'),
(170, NULL, 136, 0, '2025-01-31 20:16:05', '2025-01-31 20:16:05'),
(171, NULL, 137, 0, '2025-01-31 20:44:28', '2025-01-31 20:44:28'),
(172, NULL, 138, 0, '2025-01-31 20:47:16', '2025-01-31 20:47:16'),
(173, NULL, 139, 0, '2025-01-31 20:54:17', '2025-01-31 20:54:17'),
(174, NULL, 140, 0, '2025-01-31 20:55:20', '2025-01-31 20:55:20'),
(175, NULL, 141, 0, '2025-01-31 21:24:09', '2025-01-31 21:24:09'),
(176, NULL, 142, 0, '2025-01-31 21:30:30', '2025-01-31 21:30:30'),
(177, NULL, 143, 0, '2025-01-31 21:33:36', '2025-01-31 21:33:36'),
(178, NULL, 144, 0, '2025-01-31 21:34:14', '2025-01-31 21:34:14'),
(179, NULL, 145, 0, '2025-01-31 21:35:15', '2025-01-31 21:35:15'),
(180, NULL, 146, 0, '2025-01-31 21:46:03', '2025-01-31 21:46:03'),
(181, NULL, 147, 0, '2025-01-31 21:46:44', '2025-01-31 21:46:44'),
(182, NULL, 148, 0, '2025-01-31 22:15:06', '2025-01-31 22:15:06'),
(183, NULL, 149, 0, '2025-01-31 22:35:37', '2025-01-31 22:35:37'),
(184, 75, 150, 0, '2025-01-31 22:53:32', '2025-01-31 22:53:32'),
(185, 76, 151, 0, '2025-01-31 22:56:18', '2025-01-31 22:56:18'),
(186, NULL, 152, 0, '2025-02-01 08:50:34', '2025-02-01 08:50:34'),
(187, 77, 152, 0, '2025-02-01 08:52:25', '2025-02-01 08:52:25'),
(188, NULL, 153, 0, '2025-02-01 09:25:36', '2025-02-01 09:25:36'),
(189, NULL, 154, 0, '2025-02-01 09:27:21', '2025-02-01 09:27:21'),
(190, NULL, 155, 0, '2025-02-01 09:28:32', '2025-02-01 09:28:32');

-- --------------------------------------------------------

--
-- Table structure for table `residents_medical_condition`
--

CREATE TABLE `residents_medical_condition` (
  `rmc_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `medical_conditions_id` int(10) NOT NULL,
  `diagnosed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Ongoing','Cured') NOT NULL DEFAULT 'Ongoing',
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `residents_medical_condition`
--

INSERT INTO `residents_medical_condition` (`rmc_id`, `resident_id`, `medical_conditions_id`, `diagnosed_date`, `status`, `isArchived`, `created_at`, `updated_at`) VALUES
(18, 4, 2, '2024-09-30 11:40:54', 'Ongoing', 0, '2024-09-30 11:40:54', '2024-12-14 11:31:55'),
(20, 5, 2, '2024-11-27 12:33:45', 'Ongoing', 0, '2024-11-27 12:33:45', '2024-12-14 11:31:55'),
(21, 99, 24, '2024-11-27 12:33:45', 'Ongoing', 0, '2024-11-27 12:33:45', '2024-12-14 11:31:55'),
(23, 4, 1, '2024-12-04 00:00:00', 'Ongoing', 0, '2024-12-04 16:41:55', '2024-12-14 11:31:55'),
(26, 4, 30, '2024-12-12 00:00:00', 'Ongoing', 0, '2024-12-04 16:50:13', '2024-12-14 11:31:55');

-- --------------------------------------------------------

--
-- Table structure for table `resident_prenatal_schedules`
--

CREATE TABLE `resident_prenatal_schedules` (
  `resident_ps_id` int(10) NOT NULL,
  `pregnancy_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `priority_number` int(100) NOT NULL,
  `status` enum('completed','cancelled','incoming') NOT NULL DEFAULT 'incoming',
  `notes` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `resident_prenatal_schedules`
--

INSERT INTO `resident_prenatal_schedules` (`resident_ps_id`, `pregnancy_id`, `sched_id`, `priority_number`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 1, 'completed', 'fdfdfdf', '2025-01-04 00:30:17', '2025-01-04 00:30:17'),
(3, 1, 7, 2, 'cancelled', 'fdfdfd', '2025-01-04 00:30:40', '2025-01-04 00:30:40'),
(4, 1, 10, 1, 'incoming', 'dfswerer', '2025-01-05 01:40:28', '2025-01-05 01:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `signature_id` int(10) NOT NULL,
  `signature_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`signature_id`, `signature_path`) VALUES
(1, '/bhcmis/storage/signatures/sg1.png'),
(2, '/bhcmis/storage/signatures/sg2.png'),
(3, '/bhcmis/storage/signatures/sg3.png'),
(4, '/bhcmis/storage/signatures/sg4.png'),
(5, '/bhcmis/storage/signatures/sg5.png'),
(6, '/bhcmis/storage/signatures/sg6.png');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vaccine_id` int(10) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `lot_number` varchar(100) DEFAULT NULL,
  `stocks` int(100) NOT NULL DEFAULT 100,
  `expiration_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`vaccine_id`, `vaccine_name`, `lot_number`, `stocks`, `expiration_date`, `created_at`) VALUES
(16, 'BCG (Tuberculosis)', 'BCG-2026A', 99, '2026-08-31', '2025-01-28 10:47:05'),
(17, 'Pentavalent (DPT-HepB-Hib)', 'PENTA-2026B', 100, '2026-09-30', '2025-01-28 10:47:05'),
(18, 'Oral Polio Vaccine (OPV)', 'OPV-2026C', 100, '2026-10-31', '2025-01-28 10:47:05'),
(19, 'Measles-Mumps-Rubella (MMR)', 'MMR-2026D', 100, '2026-01-31', '2025-01-28 10:47:05'),
(20, 'Tetanus Toxoid (TT)', 'TT-2026E', 100, '2026-12-31', '2025-01-28 10:47:05'),
(21, 'Hepatitis B Birth Dose', 'HEPB-BIRTH-2026F', 100, '2026-07-31', '2025-01-28 10:47:05'),
(22, 'COVID-19 Pfizer-BioNTech', 'PFIZER-2026G', 100, '2026-06-30', '2025-01-28 10:47:05'),
(23, 'Influenza 2026', 'FLU-2026H', 100, '2026-03-31', '2025-01-28 10:47:05'),
(24, 'Pneumococcal Conjugate (PCV13)', 'PCV13-2026I', 100, '2026-02-28', '2025-01-28 10:47:05'),
(25, 'Japanese Encephalitis', 'JE-2026J', 100, '2026-11-30', '2025-01-28 10:47:05'),
(26, 'BCG (Tuberculosis)', 'EXP-BCG-2022', 100, '2023-03-31', '2025-01-28 10:47:05'),
(27, 'Pentavalent (DPT-HepB-Hib)', 'EXP-PENTA-2022A', 100, '2023-05-31', '2025-01-28 10:47:05'),
(28, 'Oral Polio Vaccine (OPV)', 'EXP-OPV-2022B', 100, '2023-02-28', '2025-01-28 10:47:05'),
(29, 'Rotavirus (Rotarix)', 'ROTA-2024K', 100, '2024-04-30', '2025-01-28 10:47:05'),
(30, 'Vitamin A Supplement', 'VITA-2025L', 100, '2025-10-31', '2025-01-28 10:47:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `fk_adminAccountId` (`account_id`),
  ADD KEY `fk_adminPersonalInfoId` (`personal_information_id`),
  ADD KEY `fk_signatureId` (`signature_id`);

--
-- Indexes for table `allergies`
--
ALTER TABLE `allergies`
  ADD PRIMARY KEY (`allergy_id`),
  ADD KEY `fk_allergiesResId` (`resident_id`);

--
-- Indexes for table `annual_population`
--
ALTER TABLE `annual_population`
  ADD PRIMARY KEY (`population_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_apResidentId` (`resident_id`),
  ADD KEY `fk_apSchedId` (`sched_id`);

--
-- Indexes for table `bhw`
--
ALTER TABLE `bhw`
  ADD PRIMARY KEY (`bhw_id`),
  ADD KEY `fk_bhwAccountId` (`account_id`),
  ADD KEY `fk_bhwPersonalInfoId` (`personal_info_id`),
  ADD KEY `fk_bhwAssignedAreaId` (`assigned_area`);

--
-- Indexes for table `brgy_captain`
--
ALTER TABLE `brgy_captain`
  ADD PRIMARY KEY (`brgy_captain_id`),
  ADD KEY `fk_captainSignatureId` (`signature_id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`consultation_id`),
  ADD KEY `fk_consultationAppointmentId` (`appointment_id`),
  ADD KEY `fk_consultationResidentId` (`resident_id`),
  ADD KEY `fk_consultationSchedId` (`sched_id`);

--
-- Indexes for table `consultations_prescriptions`
--
ALTER TABLE `consultations_prescriptions`
  ADD PRIMARY KEY (`medication_id`),
  ADD KEY `fk_rmConsultationId` (`consultation_id`),
  ADD KEY `fk_rmMedicineId` (`medicine_id`);

--
-- Indexes for table `consultation_schedules`
--
ALTER TABLE `consultation_schedules`
  ADD PRIMARY KEY (`con_sched_id`);

--
-- Indexes for table `families`
--
ALTER TABLE `families`
  ADD PRIMARY KEY (`family_id`),
  ADD KEY `fk_fParentFamilyId` (`parent_family_id`);

--
-- Indexes for table `family_members`
--
ALTER TABLE `family_members`
  ADD PRIMARY KEY (`fmember_id`),
  ADD KEY `fk_memberFamilyId` (`family_id`),
  ADD KEY `resident_id` (`resident_id`) USING BTREE,
  ADD KEY `fk_ownFamilyID` (`own_family_id`);

--
-- Indexes for table `health_information`
--
ALTER TABLE `health_information`
  ADD PRIMARY KEY (`health_information_id`),
  ADD KEY `fk_HealthInfoResidentId` (`resident_id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`household_id`),
  ADD KEY `fk_householdAddressId` (`address_id`),
  ADD KEY `fk_recordedByBHWId` (`recorded_by`);

--
-- Indexes for table `household_members`
--
ALTER TABLE `household_members`
  ADD PRIMARY KEY (`hm_id`),
  ADD UNIQUE KEY `family_id` (`family_id`),
  ADD KEY `fk_hmHouseholdId` (`household_id`);

--
-- Indexes for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD PRIMARY KEY (`immunization_id`),
  ADD KEY `fk_imNextDoseId` (`next_dose_due`),
  ADD KEY `fk_imAppointmentId` (`appointment_id`);

--
-- Indexes for table `immunization_appointments`
--
ALTER TABLE `immunization_appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `fk_iaResidentId` (`resident_id`),
  ADD KEY `fk_iaSchedId` (`sched_id`);

--
-- Indexes for table `immunization_schedules`
--
ALTER TABLE `immunization_schedules`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `ibfk_vaccine_id` (`vaccine_id`);

--
-- Indexes for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  ADD PRIMARY KEY (`medical_conditions_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`medicine_id`);

--
-- Indexes for table `midwife`
--
ALTER TABLE `midwife`
  ADD PRIMARY KEY (`midwife_id`),
  ADD KEY `fk_midwifeAccountId` (`account_id`),
  ADD KEY `fk_midwifePersonalInfoId` (`personal_info_id`),
  ADD KEY `fk_midwife_signature` (`signature_id`);

--
-- Indexes for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD PRIMARY KEY (`personal_info_id`),
  ADD KEY `fk_personalInfoAddressId` (`address_id`);

--
-- Indexes for table `pregnancy`
--
ALTER TABLE `pregnancy`
  ADD PRIMARY KEY (`pregnancy_id`),
  ADD KEY `fk_pregnancyResidentId` (`resident_id`);

--
-- Indexes for table `prenatals`
--
ALTER TABLE `prenatals`
  ADD PRIMARY KEY (`prenatal_id`),
  ADD KEY `fk_prenatalsPregnancyId` (`pregnancy_id`),
  ADD KEY `fk_prenatalsSchedId` (`sched_id`);

--
-- Indexes for table `prenatal_schedules`
--
ALTER TABLE `prenatal_schedules`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `referral_requests`
--
ALTER TABLE `referral_requests`
  ADD PRIMARY KEY (`referral_id`),
  ADD KEY `fk_referralResidentId` (`resident_id`),
  ADD KEY `fk_referralChildId` (`child_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`resident_id`),
  ADD KEY `fk_residentsAccountId` (`account_id`),
  ADD KEY `fk_residentsPersonaInfoId` (`personal_info_id`);

--
-- Indexes for table `residents_medical_condition`
--
ALTER TABLE `residents_medical_condition`
  ADD PRIMARY KEY (`rmc_id`),
  ADD KEY `fk_rmcResidentId` (`resident_id`),
  ADD KEY `fk_rmcConditionsId` (`medical_conditions_id`);

--
-- Indexes for table `resident_prenatal_schedules`
--
ALTER TABLE `resident_prenatal_schedules`
  ADD PRIMARY KEY (`resident_ps_id`),
  ADD KEY `fk_pSchedulePregnancyId` (`pregnancy_id`),
  ADD KEY `fk_pScheduleSchedId` (`sched_id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`signature_id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`vaccine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `allergies`
--
ALTER TABLE `allergies`
  MODIFY `allergy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `annual_population`
--
ALTER TABLE `annual_population`
  MODIFY `population_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `bhw`
--
ALTER TABLE `bhw`
  MODIFY `bhw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `brgy_captain`
--
ALTER TABLE `brgy_captain`
  MODIFY `brgy_captain_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `consultation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `consultations_prescriptions`
--
ALTER TABLE `consultations_prescriptions`
  MODIFY `medication_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `consultation_schedules`
--
ALTER TABLE `consultation_schedules`
  MODIFY `con_sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1036;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `fmember_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `health_information`
--
ALTER TABLE `health_information`
  MODIFY `health_information_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1033;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `hm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `immunization_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `immunization_appointments`
--
ALTER TABLE `immunization_appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `immunization_schedules`
--
ALTER TABLE `immunization_schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  MODIFY `medical_conditions_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `midwife`
--
ALTER TABLE `midwife`
  MODIFY `midwife_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `personal_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `pregnancy`
--
ALTER TABLE `pregnancy`
  MODIFY `pregnancy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prenatals`
--
ALTER TABLE `prenatals`
  MODIFY `prenatal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `prenatal_schedules`
--
ALTER TABLE `prenatal_schedules`
  MODIFY `sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `referral_requests`
--
ALTER TABLE `referral_requests`
  MODIFY `referral_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `residents_medical_condition`
--
ALTER TABLE `residents_medical_condition`
  MODIFY `rmc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `resident_prenatal_schedules`
--
ALTER TABLE `resident_prenatal_schedules`
  MODIFY `resident_ps_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `signature_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `vaccine_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_adminPersonalInfoId` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_signatureId` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`signature_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `allergies`
--
ALTER TABLE `allergies`
  ADD CONSTRAINT `fk_allergiesResId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_apResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_apSchedId` FOREIGN KEY (`sched_id`) REFERENCES `consultation_schedules` (`con_sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bhw`
--
ALTER TABLE `bhw`
  ADD CONSTRAINT `fk_bhwAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bhwAssignedAreaId` FOREIGN KEY (`assigned_area`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bhwPersonalInfoId` FOREIGN KEY (`personal_info_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `brgy_captain`
--
ALTER TABLE `brgy_captain`
  ADD CONSTRAINT `fk_captainSignatureId` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`signature_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `fk_consultationAppointmentId` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultationResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultationSchedId` FOREIGN KEY (`sched_id`) REFERENCES `consultation_schedules` (`con_sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consultations_prescriptions`
--
ALTER TABLE `consultations_prescriptions`
  ADD CONSTRAINT `fk_rmConsultationId` FOREIGN KEY (`consultation_id`) REFERENCES `consultations` (`consultation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rmMedicineId` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `families`
--
ALTER TABLE `families`
  ADD CONSTRAINT `fk_fParentFamilyId` FOREIGN KEY (`parent_family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `family_members`
--
ALTER TABLE `family_members`
  ADD CONSTRAINT `fk_memberFamilyId` FOREIGN KEY (`family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_memberResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ownFamilyID` FOREIGN KEY (`own_family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_information`
--
ALTER TABLE `health_information`
  ADD CONSTRAINT `fk_HealthInfoResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `household`
--
ALTER TABLE `household`
  ADD CONSTRAINT `fk_householdAddressId` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_recordedByBHWId` FOREIGN KEY (`recorded_by`) REFERENCES `bhw` (`bhw_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `household_members`
--
ALTER TABLE `household_members`
  ADD CONSTRAINT `fk_hmFamId` FOREIGN KEY (`family_id`) REFERENCES `families` (`family_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_hmHouseholdId` FOREIGN KEY (`household_id`) REFERENCES `household` (`household_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunizations`
--
ALTER TABLE `immunizations`
  ADD CONSTRAINT `fk_imAppointmentId` FOREIGN KEY (`appointment_id`) REFERENCES `immunization_appointments` (`appointment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_imNextDoseId` FOREIGN KEY (`next_dose_due`) REFERENCES `immunization_schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunization_appointments`
--
ALTER TABLE `immunization_appointments`
  ADD CONSTRAINT `fk_iaResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iaSchedId` FOREIGN KEY (`sched_id`) REFERENCES `immunization_schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunization_schedules`
--
ALTER TABLE `immunization_schedules`
  ADD CONSTRAINT `ibfk_vaccine_id` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `midwife`
--
ALTER TABLE `midwife`
  ADD CONSTRAINT `fk_midwifeAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_midwifePersonalInfoId` FOREIGN KEY (`personal_info_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_midwife_signature` FOREIGN KEY (`signature_id`) REFERENCES `signatures` (`signature_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personal_information`
--
ALTER TABLE `personal_information`
  ADD CONSTRAINT `fk_personalInfoAddressId` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pregnancy`
--
ALTER TABLE `pregnancy`
  ADD CONSTRAINT `fk_pregnancyResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prenatals`
--
ALTER TABLE `prenatals`
  ADD CONSTRAINT `fk_prenatalsPregnancyId` FOREIGN KEY (`pregnancy_id`) REFERENCES `pregnancy` (`pregnancy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prenatalsSchedId` FOREIGN KEY (`sched_id`) REFERENCES `prenatal_schedules` (`sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `referral_requests`
--
ALTER TABLE `referral_requests`
  ADD CONSTRAINT `fk_referralChildId` FOREIGN KEY (`child_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_referralResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residents`
--
ALTER TABLE `residents`
  ADD CONSTRAINT `fk_residentsAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_residentsPersonaInfoId` FOREIGN KEY (`personal_info_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `residents_medical_condition`
--
ALTER TABLE `residents_medical_condition`
  ADD CONSTRAINT `fk_rmcConditionsId` FOREIGN KEY (`medical_conditions_id`) REFERENCES `medical_conditions` (`medical_conditions_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_rmcResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resident_prenatal_schedules`
--
ALTER TABLE `resident_prenatal_schedules`
  ADD CONSTRAINT `fk_pSchedulePregnancyId` FOREIGN KEY (`pregnancy_id`) REFERENCES `pregnancy` (`pregnancy_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pScheduleSchedId` FOREIGN KEY (`sched_id`) REFERENCES `prenatal_schedules` (`sched_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
