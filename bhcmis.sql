-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 06:38 PM
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
  `isValid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`account_id`, `username`, `password`, `role`, `profile_picture`, `isArchived`, `isValid`) VALUES
(1, 'admin', '$2y$10$wSO7df3nhx9QF06QISRIT.1YNjfANjoIqR3q4X8GWKXT897uTeVly', 'admin', '/bhcmis/storage/uploads/avatar-admin.png', 0, 1),
(2, 'BHW1', '$2y$10$Fp06K.3nimzVrtsC.VQMs.mkYrm0vpq5rYhDvktMiIY7SZbWbkozW', 'bhw', '/bhcmis/storage/uploads/avatar-girl1.png', 0, 1),
(6, 'BHW2', '$2y$10$jo2g7gXKJXysuLCE.WEMo.ZdWhAjO6/ORu4kcGZ75HlMkyfWau4OS', 'bhw', '/bhcmis/storage/uploads/avatar-woman1.png', 0, 1),
(7, 'BHW3', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/avatar-woman2.png', 0, 1),
(8, 'BHW4', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/avatar-woman3.png', 0, 1),
(9, 'BHW5', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/avatar-woman4.png', 0, 1),
(10, 'BHW6', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/avatar-woman2.png', 0, 1),
(11, 'BHW7', '$2y$10$R4JsPDggEqrbXeMxjdwFNOQOM2t.AhDm4mkX8auBE2jnHrI8z0B9a', 'bhw', '/bhcmis/storage/uploads/avatar-woman1.png', 0, 1),
(12, 'Midwife1', '$2y$10$mHv3MxPW3CnlJ0m0Fp//LeShjQqYgttV40fklrqpW.3MEBweZChqi', 'midwife', '/bhcmis/storage/uploads/midwife-1.jpg', 0, 1),
(13, 'Resident1', '$2y$10$PhtFVyI7r3nW3J3KRIaxLuwPT5GDuqKt1lahofGd0VeCEOk8tMDIW', 'residents', '/bhcmis/storage/uploads/avatar-woman2.png', 0, 1),
(14, 'Resident2', '$2y$10$PhtFVyI7r3nW3J3KRIaxLuwPT5GDuqKt1lahofGd0VeCEOk8tMDIW', 'residents', '/bhcmis/storage/uploads/avatar-woman2.png', 0, 1),
(50, 'Resident3', '$2y$10$PhtFVyI7r3nW3J3KRIaxLuwPT5GDuqKt1lahofGd0VeCEOk8tMDIW', 'residents', NULL, 0, 1);

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
  `personal_information_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `account_id`, `personal_information_id`) VALUES
(1, 1, 1);

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
(47, 'HC919870150989PH', 4, 12, 1, 'Scheduled', 0, '2025-01-07 07:03:46', '2025-01-07 07:03:46'),
(48, 'HC689854855513PH', 4, 13, 1, 'Cancelled', 0, '2025-01-07 07:09:18', '2025-01-07 07:09:18');

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
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bhw`
--

INSERT INTO `bhw` (`bhw_id`, `account_id`, `personal_info_id`, `assigned_area`, `date_started`, `employment_status`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 2, 4, 6, '2024-08-07', 'on_leave', 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(2, 6, 6, 1, '2024-09-16', 'active', 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(3, 7, 8, 3, '2024-09-16', 'active', 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16'),
(4, 8, 10, 4, '2024-09-16', 'active', 0, '2024-12-14 11:13:16', '2024-12-14 11:13:16');

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
(22, 4, NULL, 'nabuno ka lapis', 9, 'headache, fever, vomiting', 58.00, '48', '120', 'None', '120/80', 'Normal', 'Patient\'s vital signs are normal; continue with current health regimen and routine check-ups.', 'Victorias Health Center', 0, '2024-07-25 08:42:04', '2024-07-25 08:42:04'),
(29, 4, 43, 'nabuno ka lapis', 9, 'fever, sneeze', 55.00, '36', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2024-12-29 14:14:44', '2024-12-29 14:14:44');

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
(8, 22, 34, 5, '3X a day', 0, '2024-12-24 18:57:15', '2024-12-24 18:57:15');

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
(21, '2024-12-28 12:00:00', 0, '2024-12-28 16:45:50', '2024-12-28 16:45:50');

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
(1002, 1001, 1, 0, '2024-12-14 11:21:49', '2024-12-14 11:21:49');

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `fmember_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `role` enum('husband','wife','child') NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`fmember_id`, `family_id`, `resident_id`, `role`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 1001, 4, 'husband', 0, '2024-12-14 11:23:02', '2024-12-14 22:48:06'),
(2, 1001, 5, 'wife', 0, '2024-12-14 11:23:02', '2024-12-14 23:17:49'),
(56, 1001, 99, 'child', 0, '2024-12-14 11:23:02', '2024-12-14 23:28:03'),
(58, 1002, 99, 'husband', 0, '2024-12-14 11:23:02', '2024-12-14 11:23:02');

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
(2, 5, 'B', 0, '2024-07-25 08:37:06', '2024-12-14 11:23:29'),
(5, 5, 'B', 0, '2024-07-25 08:37:06', '2024-12-14 11:23:29'),
(8, 4, 'B', 0, '2024-07-25 08:43:19', '2024-12-14 11:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalizations`
--

CREATE TABLE `hospitalizations` (
  `hospitalization_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `admission_date` date NOT NULL,
  `discharge_date` date NOT NULL,
  `reason_for_admission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hospitalizations`
--

INSERT INTO `hospitalizations` (`hospitalization_id`, `resident_id`, `hospital_name`, `admission_date`, `discharge_date`, `reason_for_admission`) VALUES
(1, 4, 'Corazon Montelibano Memorial Hospital', '2024-02-15', '2024-02-20', 'Appendicitis Surgery'),
(2, 4, 'Dr. Ramon B. Gustillo Hospital', '2023-10-05', '2023-10-12', 'Pneumonia Treatment'),
(3, 4, 'Teresita Lopez Jalandoni Provincial Hospital', '2023-07-01', '2023-07-10', 'Fractured Leg'),
(4, 5, 'Cadiz District Hospital', '2024-01-10', '2024-01-15', 'Severe Asthma Attack'),
(5, 5, 'Riverside Medical Center', '2023-09-20', '2023-09-25', 'Food Poisoning');

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
(1001, 6, '2002', 'Owned', 'strong', 'electricity', 'Point Source', 'Pointflush type', 1, 0, '2024-12-02 10:31:14', '2024-12-02 10:31:39'),
(1002, 6, '2015', 'Rented', 'strong', 'electricity', 'Individual Connection', 'Pointflush type', 1, 0, '2024-12-02 10:31:14', '2024-12-02 10:31:39');

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
(2, 1001, 1002, 0, '2024-12-14 11:25:24', '2024-12-14 11:25:24');

-- --------------------------------------------------------

--
-- Table structure for table `immunizations`
--

CREATE TABLE `immunizations` (
  `immunization_id` int(10) NOT NULL,
  `appointment_id` int(10) NOT NULL,
  `vaccine_id` int(10) NOT NULL,
  `dose_number` tinyint(3) NOT NULL,
  `next_dose_due` int(10) NOT NULL,
  `adverse_reaction` text DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `immunizations`
--

INSERT INTO `immunizations` (`immunization_id`, `appointment_id`, `vaccine_id`, `dose_number`, `next_dose_due`, `adverse_reaction`, `isArchived`, `created_at`, `updated_at`) VALUES
(12, 1, 10, 1, 2, NULL, 0, '2025-01-08 01:37:14', '2025-01-08 01:37:14');

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
(1, '6479673D4C3C3C49\r\n', 4, 1, 1, 'Scheduled', 0, '2025-01-07 17:21:57', '2025-01-07 17:21:57');

-- --------------------------------------------------------

--
-- Table structure for table `immunization_schedules`
--

CREATE TABLE `immunization_schedules` (
  `schedule_id` int(10) NOT NULL,
  `schedule_date` datetime NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `immunization_schedules`
--

INSERT INTO `immunization_schedules` (`schedule_id`, `schedule_date`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, '2025-02-12 08:00:00', 0, '2025-01-07 14:33:51', '2025-01-07 14:33:51'),
(2, '2025-02-17 10:00:00', 0, '2025-01-07 14:34:55', '2025-01-07 14:34:55'),
(3, '2025-03-05 08:00:00', 0, '2025-01-08 01:35:45', '2025-01-08 01:35:45');

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
(36, 'T1U2V3', 'Neozep Forte', 'Phenylephrine HCl, Chlorphenamine Maleate, Paracetamol', '10mg/2mg/500mg', 'Tablet', '2024-09-15', 90, 'For colds, allergies, and headache relief.', 0, '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
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
  `license_number` varchar(100) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `midwife`
--

INSERT INTO `midwife` (`midwife_id`, `account_id`, `personal_info_id`, `employment_status`, `employment_date`, `license_number`, `isArchived`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 'active', '2024-03-05', '12345', 0, '2024-12-14 11:27:58', '2024-12-14 11:27:58');

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
  `address_id` int(10) NOT NULL,
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
(1, 'Victorino', 'Amiel Jose', 'Lakobalo', '2002-04-09', 'Single', 'College Graduate', 'Brgy. Secretary', 'Roman Catholic', 'Filipino', 6, 'male', '09171234567', 'amieljosevictorino@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(2, 'Singua', 'Reyna Jane', 'Gasparillo', '1994-03-09', 'Married', 'College Graduate', 'Brgy. Midwife', 'Roman Catholic', 'Filipino', 6, 'female', '09851354580', 'reynasorilla@puntamesa.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-12-07 01:53:39'),
(3, 'Gonzales', 'Ann', 'Ramos', '1978-11-15', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 3, 'male', '09331234567', 'anngonzales@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 12:56:54'),
(4, 'Perez', 'Grace', 'Santos', '1985-07-16', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 4, 'female', '09441234500', 'graceperez@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 14:08:19'),
(5, 'Mendoza', 'May', 'Alvarez', '1996-12-04', 'Single', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 5, 'male', '09551234567', 'carlos.mendoza@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(6, 'Aquino', 'Laura', 'Gonzalez', '1992-09-18', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 6, 'female', '09661234567', 'laura.aquino@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-27 13:40:16'),
(7, 'Santos', 'Isabel', 'Navarro', '1983-06-25', 'Legally Separated', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 7, 'female', '09771234567', 'isabel.santos@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(8, 'Cruz', 'Annie', 'Castro', '1973-01-10', 'Married', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 8, 'male', '09881234567', 'annie.cruz@gmail.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 14:07:55'),
(9, 'Morales', 'Elena', 'Garcia', '1999-04-20', 'Single', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 9, 'male', '09991234567', 'elena.morales@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-07 08:42:29'),
(10, 'Reyes', 'Gabriela', 'Santos', '1981-08-14', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 10, 'male', '09182345678', 'gabriel.delosreyes@example.com', NULL, 0, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-10 10:44:05'),
(13, 'Araneta', 'Roy Marjohn', 'Catapang', '2000-04-13', 'Single', 'Highschool Graduate', 'Drug Lord', 'Iglesia ni Cristo', 'Filipinos', 6, 'female', '09308309599', 'roymarjohnaraneta@gmail.com', NULL, 0, 0, 1, NULL, '2024-07-16 11:07:25', '2024-12-14 23:17:37'),
(14, 'Angcona', 'Rovie', 'Singua', '2002-03-04', 'Married', 'College Undergraduate', 'Businesswoman', 'Baptist', 'Filipino', 6, 'female', '09586789012', 'rovieangcona@gmail.com', NULL, 0, 0, 1, NULL, '2024-07-16 11:07:25', '2024-12-14 23:17:20'),
(67, 'Araneta Jr.', 'Roy Marjohn', 'Lakobalo', '2015-08-05', 'Single', 'Elementary Graduate', 'Student', 'Filipino', 'Roman Catholic', 6, 'male', '', '', NULL, 0, 0, 0, NULL, '2024-07-17 11:07:25', '2024-12-14 23:40:34');

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
(13, 'C183E0468CFCD4BB', 1, 7, 60.00, '119/18', 'Normal', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-01-03 16:07:19', '2025-01-03 16:07:19');

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
(5, '2024-11-28 13:00:00.000000', 1, '2024-12-14 11:30:22', '2024-12-14 11:30:22'),
(6, '2025-01-10 08:00:00.000000', 1, '2025-01-01 15:05:12', '2025-01-01 15:05:12'),
(7, '2025-01-11 07:30:00.000000', 0, '2025-01-01 15:44:51', '2025-01-01 15:44:51'),
(8, '2025-01-04 13:54:00.000000', 1, '2025-01-04 11:55:00', '2025-01-04 11:55:00'),
(9, '2025-02-04 13:00:00.000000', 0, '2025-01-04 11:56:36', '2025-01-04 11:56:36'),
(10, '2025-01-07 08:00:00.000000', 0, '2025-01-05 01:38:41', '2025-01-05 01:38:41');

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
(99, 50, 67, 0, '2024-12-14 11:31:22', '2024-12-14 11:31:22');

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
(2, 1, 7, 1, 'incoming', 'fdfdfdf', '2025-01-04 00:30:17', '2025-01-04 00:30:17'),
(3, 1, 7, 2, 'cancelled', 'fdfdfd', '2025-01-04 00:30:40', '2025-01-04 00:30:40'),
(4, 1, 10, 1, 'incoming', 'dfswerer', '2025-01-05 01:40:28', '2025-01-05 01:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vaccine_id` int(10) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`vaccine_id`, `vaccine_name`, `created_at`) VALUES
(1, 'Bacillus Calmette-Guérin (BCG) Vaccine', '2024-12-14 11:33:40'),
(2, 'Hepatitis B Vaccine', '2024-12-14 11:33:40'),
(3, 'Diphtheria, Tetanus, and Pertussis (DTaP) Vaccine', '2024-12-14 11:33:40'),
(4, 'Polio Vaccine (IPV)', '2024-12-14 11:33:40'),
(5, 'Measles, Mumps, and Rubella (MMR) Vaccine', '2024-12-14 11:33:40'),
(6, 'Hepatitis A Vaccine', '2024-12-14 11:33:40'),
(7, 'Influenza Vaccine (Flu Shot)', '2024-12-14 11:33:40'),
(8, 'Typhoid Vaccine', '2024-12-14 11:33:40'),
(9, 'Japanese Encephalitis Vaccine', '2024-12-14 11:33:40'),
(10, 'Rabies Vaccine', '2024-12-14 11:33:40'),
(11, 'Human Papillomavirus (HPV) Vaccine', '2024-12-14 11:33:40'),
(12, 'Pneumococcal Conjugate Vaccine (PCV)', '2024-12-14 11:33:40'),
(13, 'Varicella (Chickenpox) Vaccine', '2024-12-14 11:33:40'),
(14, 'Tetanus, Diphtheria, and Pertussis (Tdap) Booster', '2024-12-14 11:33:40'),
(15, 'Meningococcal Vaccine', '2024-12-14 11:33:40'),
(16, 'Pfizer-BioNTech COVID-19 Vaccine', '2024-12-14 11:33:40'),
(17, 'Moderna COVID-19 Vaccine', '2024-12-14 11:33:40'),
(18, 'AstraZeneca COVID-19 Vaccine', '2024-12-14 11:33:40'),
(19, 'Sinovac-CoronaVac COVID-19 Vaccine', '2024-12-14 11:33:40'),
(20, 'Johnson & Johnson COVID-19 Vaccine', '2024-12-14 11:33:40');

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
  ADD KEY `fk_adminPersonalInfoId` (`personal_information_id`);

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
  ADD KEY `resident_id` (`resident_id`) USING BTREE;

--
-- Indexes for table `health_information`
--
ALTER TABLE `health_information`
  ADD PRIMARY KEY (`health_information_id`),
  ADD KEY `fk_HealthInfoResidentId` (`resident_id`);

--
-- Indexes for table `hospitalizations`
--
ALTER TABLE `hospitalizations`
  ADD PRIMARY KEY (`hospitalization_id`),
  ADD KEY `fk_hospitalizationResId` (`resident_id`);

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
  ADD KEY `fk_vaccinationVaccineId` (`vaccine_id`),
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
  ADD PRIMARY KEY (`schedule_id`);

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
  ADD KEY `fk_midwifePersonalInfoId` (`personal_info_id`);

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
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `bhw`
--
ALTER TABLE `bhw`
  MODIFY `bhw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `consultation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `consultations_prescriptions`
--
ALTER TABLE `consultations_prescriptions`
  MODIFY `medication_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `consultation_schedules`
--
ALTER TABLE `consultation_schedules`
  MODIFY `con_sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1027;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `fmember_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `health_information`
--
ALTER TABLE `health_information`
  MODIFY `health_information_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hospitalizations`
--
ALTER TABLE `hospitalizations`
  MODIFY `hospitalization_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `household_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1024;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `hm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `immunizations`
--
ALTER TABLE `immunizations`
  MODIFY `immunization_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `immunization_appointments`
--
ALTER TABLE `immunization_appointments`
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `immunization_schedules`
--
ALTER TABLE `immunization_schedules`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `midwife_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `personal_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `pregnancy`
--
ALTER TABLE `pregnancy`
  MODIFY `pregnancy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prenatals`
--
ALTER TABLE `prenatals`
  MODIFY `prenatal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `prenatal_schedules`
--
ALTER TABLE `prenatal_schedules`
  MODIFY `sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

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
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `vaccine_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_adminAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_adminPersonalInfoId` FOREIGN KEY (`personal_information_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_memberResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `health_information`
--
ALTER TABLE `health_information`
  ADD CONSTRAINT `fk_HealthInfoResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospitalizations`
--
ALTER TABLE `hospitalizations`
  ADD CONSTRAINT `fk_hospitalizationResId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_imNextDoseId` FOREIGN KEY (`next_dose_due`) REFERENCES `immunization_schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_imVaccineId` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `immunization_appointments`
--
ALTER TABLE `immunization_appointments`
  ADD CONSTRAINT `fk_iaResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_iaSchedId` FOREIGN KEY (`sched_id`) REFERENCES `immunization_schedules` (`schedule_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `midwife`
--
ALTER TABLE `midwife`
  ADD CONSTRAINT `fk_midwifeAccountId` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_midwifePersonalInfoId` FOREIGN KEY (`personal_info_id`) REFERENCES `personal_information` (`personal_info_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
