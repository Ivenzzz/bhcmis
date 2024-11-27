-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 08:54 AM
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
  `address_type` enum('hda','sitio') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address_name`, `address_type`) VALUES
(1, 'Hda. Sta. Rosalia', 'hda'),
(2, 'Sto. Juancho', 'sitio'),
(3, 'Sto. Cogon', 'sitio'),
(4, 'GK Village', 'hda'),
(5, 'Sto. Gutusan', 'sitio'),
(6, 'Punta Mesa Proper', 'hda'),
(7, 'Sitio Banquerohan', 'sitio'),
(8, 'Hda. Busay', 'hda'),
(9, 'Hda. Bilbao', 'hda'),
(10, 'Hda. Lumayagan', 'hda'),
(11, 'Hda. Lourdes', 'hda'),
(12, 'Hda. Cuaycong', 'hda');

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
  `allergen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `allergies`
--

INSERT INTO `allergies` (`allergy_id`, `resident_id`, `allergy_type`, `allergen`) VALUES
(1, 4, 'Food', 'Peanuts'),
(2, 4, 'Drug', 'Penicillin'),
(3, 4, 'Environmental', 'Pollen'),
(4, 5, 'Food', 'Seafood'),
(5, 5, 'Insect', 'Bee Sting');

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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `annual_population`
--

INSERT INTO `annual_population` (`population_id`, `year`, `total_population`, `growth_rate`, `total_males`, `total_females`, `deceased_count`, `transferred_count`, `created_at`, `updated_at`) VALUES
(1, '2023', 10, 15.00, 6, 4, 0, 0, '2024-11-20 14:56:49', '2024-11-22 02:01:30'),
(2, '2024', 13, 30.00, 8, 5, 0, 0, '2024-11-20 16:20:46', '2024-11-22 02:01:31');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `tracking_code`, `resident_id`, `sched_id`, `priority_number`, `status`, `created_at`, `updated_at`) VALUES
(1, 'HC467245364359PH', 4, 1, 1, 'Cancelled', '2024-07-25 03:51:10', '2024-10-09 00:00:24'),
(2, 'HC191823420527PH', 5, 1, 2, 'Scheduled', '2024-07-25 03:51:10', '2024-10-07 06:01:33'),
(33, 'HC813792096667PH', 4, 7, 1, 'Completed', '2024-10-09 06:43:13', '2024-10-09 06:47:51'),
(34, 'HC736135777798PH', 4, 2, 3, 'Scheduled', '2024-10-09 06:47:04', '2024-10-09 06:47:04'),
(35, 'HC882902703689PH', 4, 6, 1, 'Cancelled', '2024-10-10 04:12:17', '2024-10-10 04:12:44');

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
  `employment_status` enum('active','inactive','on_leave') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bhw`
--

INSERT INTO `bhw` (`bhw_id`, `account_id`, `personal_info_id`, `assigned_area`, `date_started`, `employment_status`) VALUES
(1, 2, 4, 9, '2024-09-16', 'active'),
(2, 6, 6, 1, '2024-09-16', 'active'),
(3, 7, 8, 3, '2024-09-16', 'active'),
(4, 8, 10, 4, '2024-09-16', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `conditions_prescriptions`
--

CREATE TABLE `conditions_prescriptions` (
  `prescription_id` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `resident_condition_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `conditions_prescriptions`
--

INSERT INTO `conditions_prescriptions` (`prescription_id`, `medicine_id`, `resident_condition_id`) VALUES
(1, 31, 17),
(2, 33, 17);

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`consultation_id`, `resident_id`, `appointment_id`, `reason_for_visit`, `sched_id`, `symptoms`, `weight_kg`, `temperature`, `heart_rate`, `respiratory_rate`, `blood_pressure`, `cholesterol_level`, `physical_findings`, `refer_to`, `created_at`, `updated_at`) VALUES
(1, 4, 33, 'not feeling well', 1, 'diarrhea', 70.00, NULL, NULL, NULL, '120/80', 'Normal', 'Patient exhibits normal vital signs and overall health is satisfactory; no immediate concerns.', '', '2024-07-24 19:54:36', '2024-07-24 19:54:36'),
(2, 5, NULL, 'not feeling well', NULL, 'sore throat, fever', 65.00, NULL, NULL, NULL, '110/70', 'Normal', 'Patient shows signs of mild hypertension; recommend lifestyle modifications and follow-up visit in 3 months', '', '2024-07-24 19:54:36', '2024-07-24 19:54:36'),
(21, 4, NULL, 'not feeling well', NULL, 'fever, cough', 55.00, NULL, NULL, NULL, '120/70', 'Normal', 'Patient has a fever; initiate dietary adjustments.', '', '2024-07-25 08:39:43', '2024-07-25 08:39:43'),
(22, 4, NULL, 'not feeling well', NULL, 'fatigue, weakness, fever', 58.00, NULL, NULL, NULL, '120/80', 'Normal', 'Patient\'s vital signs are normal; continue with current health regimen and routine check-ups.', '', '2024-07-25 08:42:04', '2024-07-25 08:42:04'),
(23, 4, NULL, 'not feeling well', NULL, 'headache, sneeze, cough', 55.00, NULL, NULL, NULL, '120/70', 'Normal', 'Patient\'s health is stable with no new concerns; maintain current health plan and schedule next routine visit.', '', '2024-07-25 08:43:19', '2024-07-25 08:43:19');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultations_prescriptions`
--

INSERT INTO `consultations_prescriptions` (`medication_id`, `consultation_id`, `medicine_id`, `quantity`, `instructions`, `created_at`, `updated_at`) VALUES
(6, 2, 39, 2, '1 tablet after breakfast and 1 after dinner', '2024-10-01 13:18:06', '2024-10-01 13:18:06');

-- --------------------------------------------------------

--
-- Table structure for table `consultation_schedules`
--

CREATE TABLE `consultation_schedules` (
  `con_sched_id` int(10) NOT NULL,
  `con_sched_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultation_schedules`
--

INSERT INTO `consultation_schedules` (`con_sched_id`, `con_sched_date`) VALUES
(1, '2024-10-05 08:00:00'),
(2, '2024-10-06 09:00:00'),
(3, '2024-10-16 09:00:00'),
(6, '2024-11-07 08:00:00'),
(7, '2024-10-03 08:00:00'),
(8, '2024-10-11 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `families`
--

CREATE TABLE `families` (
  `family_id` int(10) NOT NULL,
  `parent_family_id` int(10) DEFAULT NULL,
  `4PsMember` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `families`
--

INSERT INTO `families` (`family_id`, `parent_family_id`, `4PsMember`) VALUES
(1001, NULL, 1),
(1002, 1001, 1);

-- --------------------------------------------------------

--
-- Table structure for table `family_members`
--

CREATE TABLE `family_members` (
  `fmember_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `role` enum('husband','wife','child') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `family_members`
--

INSERT INTO `family_members` (`fmember_id`, `family_id`, `resident_id`, `role`) VALUES
(1, 1001, 4, 'husband'),
(2, 1001, 5, 'wife');

-- --------------------------------------------------------

--
-- Table structure for table `health_information`
--

CREATE TABLE `health_information` (
  `health_information_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `blood_type` enum('A','B','AB','O') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `health_information`
--

INSERT INTO `health_information` (`health_information_id`, `resident_id`, `blood_type`, `created_at`) VALUES
(1, 4, 'B', '2024-07-25 08:37:06'),
(2, 5, 'B', '2024-07-25 08:37:06'),
(5, 5, 'B', '2024-07-25 08:37:06'),
(8, 4, 'B', '2024-07-25 08:43:19');

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
  `water_source` enum('LEVEL 1 - Point Source','LEVEL 2 - Communal Faucet','LEVEL 3 - Individual Connection','OTHERS - For doubtful sources, open dug well etc.') NOT NULL,
  `toilet_facility` enum('Pointflush type connected to septic tank','Pointflush toilet connected to septic tank and to sewerage system','Ventilated Pit','Overhung Latrine','Without toilet') NOT NULL,
  `recorded_by` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`household_id`, `address_id`, `year_resided`, `housing_type`, `construction_materials`, `lighting_facilities`, `water_source`, `toilet_facility`, `recorded_by`) VALUES
(1001, 6, '2000', 'Owned', 'strong', 'electricity', 'LEVEL 1 - Point Source', 'Pointflush type connected to septic tank', 1),
(1002, 6, '2015', 'Rented', 'strong', 'electricity', 'LEVEL 1 - Point Source', 'Pointflush type connected to septic tank', 1);

-- --------------------------------------------------------

--
-- Table structure for table `household_members`
--

CREATE TABLE `household_members` (
  `hm_id` int(10) NOT NULL,
  `household_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `household_members`
--

INSERT INTO `household_members` (`hm_id`, `household_id`, `family_id`) VALUES
(1, 1001, 1001),
(2, 1001, 1002);

-- --------------------------------------------------------

--
-- Table structure for table `medical_conditions`
--

CREATE TABLE `medical_conditions` (
  `medical_conditions_id` int(10) NOT NULL,
  `condition_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medical_conditions`
--

INSERT INTO `medical_conditions` (`medical_conditions_id`, `condition_name`) VALUES
(1, 'Arthritis'),
(2, 'Asthma'),
(3, 'Cancer'),
(4, 'Heart Disease'),
(9, 'Alzheimer\'s Disease'),
(10, 'Anxiety'),
(11, 'Appendicitis'),
(12, 'Bipolar Disorder'),
(13, 'Bone Cancer'),
(14, 'Breast Cancer'),
(15, 'Brain Tumor'),
(16, 'Bronchitis'),
(17, 'Cerebral Palsy'),
(18, 'Current Wound/Skin Problems'),
(19, 'Stroke'),
(20, 'Bone/Joint Problems'),
(21, 'Bowel/Bladder Problems'),
(22, 'History of heavy alcohol use'),
(23, 'Drug use'),
(24, 'Smoking habits'),
(26, 'Kidney Problems'),
(27, 'Sleeping Problems');

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`medicine_id`, `batch_number`, `name`, `generic_name`, `dosage`, `form`, `expiry_date`, `quantity_in_stock`, `description`, `created_at`, `updated_at`) VALUES
(21, 'A1B2C3', 'Paracetamol', 'Paracetamol', '500 mg', 'Tablet', '2025-12-31', 200, 'Pain reliever and fever reducer', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(22, 'D4E5F6', 'Ibuprofen', 'Ibuprofen', '400 mg', 'Tablet', '2024-11-30', 150, 'Anti-inflammatory and pain relief', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(23, 'G7H8I9', 'Amoxicillin', 'Amoxicillin', '500 mg', 'Capsule', '2024-08-31', 100, 'Antibiotic used to treat infections', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(24, 'J1K2L3', 'Aspirin', 'Acetylsalicylic Acid', '100 mg', 'Tablet', '2025-03-15', 250, 'Pain relief and anti-inflammatory', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(25, 'M4N5O6', 'Loperamide', 'Loperamide', '2 mg', 'Capsule', '2024-10-01', 80, 'Anti-diarrheal', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(26, 'P7Q8R9', 'Cetirizine', 'Cetirizine', '10 mg', 'Tablet', '2025-05-20', 180, 'Antihistamine for allergies', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(27, 'S1T2U3', 'Metformin', 'Metformin', '500 mg', 'Tablet', '2024-12-31', 120, 'Medication for type 2 diabetes', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(28, 'V4W5X6', 'Cough Syrup', 'Dextromethorphan', '100 ml', 'Syrup', '2024-07-15', 90, 'Relieves cough and throat irritation', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(29, 'Y7Z8A9', 'Salbutamol', 'Salbutamol', '100 mcg', 'Inhaler', '2025-09-30', 70, 'Bronchodilator for asthma', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(30, 'B1C2D3', 'Omeprazole', 'Omeprazole', '20 mg', 'Capsule', '2025-01-10', 110, 'Reduces stomach acid production', '2024-07-25 01:23:05', '2024-07-25 01:23:05'),
(31, 'E4F5G6', 'Biogesic', 'Paracetamol', '500mg', 'Tablet', '2025-12-31', 100, 'For fever and mild to moderate pain relief.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(32, 'H7I8J9', 'Alaxan FR', 'Ibuprofen + Paracetamol', '200mg + 325mg', 'Tablet', '2026-06-30', 80, 'For pain and inflammation relief.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(33, 'K1L2M3', 'Amoxicillin', 'Amoxicillin', '500mg', 'Capsule', '2024-11-15', 50, 'Antibiotic for bacterial infections.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(34, 'N4O5P6', 'Ascof Lagundi', 'Vitex Negundo', '300mg', 'Syrup', '2025-03-20', 30, 'Herbal cough remedy.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(35, 'Q7R8S9', 'Bioflu', 'Phenylephrine HCl, Chlorphenamine Maleate, Paracetamol', '10mg/2mg/500mg', 'Tablet', '2025-07-12', 120, 'For flu and common cold symptoms.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(36, 'T1U2V3', 'Neozep Forte', 'Phenylephrine HCl, Chlorphenamine Maleate, Paracetamol', '10mg/2mg/500mg', 'Tablet', '2024-09-15', 90, 'For colds, allergies, and headache relief.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(37, 'W4X5Y6', 'Kremil-S', 'Aluminum Hydroxide + Magnesium Hydroxide + Simethicone', '178mg/233mg/30mg', 'Tablet', '2025-01-30', 60, 'For hyperacidity and indigestion.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(38, 'Z7A8B9', 'Mefenamic Acid', 'Mefenamic Acid', '500mg', 'Tablet', '2026-08-10', 70, 'For pain relief such as headaches and dysmenorrhea.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(39, 'C1D2E3', 'Cefalexin', 'Cefalexin', '500mg', 'Capsule', '2025-05-25', 40, 'Antibiotic for bacterial infections.', '2024-09-22 12:15:55', '2024-09-22 12:15:55'),
(40, 'F4G5H6', 'Salbutamol', 'Salbutamol', '2mg/5ml', 'Syrup', '2024-12-20', 45, 'For asthma and bronchospasm relief.', '2024-09-22 12:15:55', '2024-09-22 12:15:55');

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
  `license_number` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `midwife`
--

INSERT INTO `midwife` (`midwife_id`, `account_id`, `personal_info_id`, `employment_status`, `employment_date`, `license_number`) VALUES
(1, 12, 2, 'active', '2024-09-08', '003104');

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
  `registered_voter` tinyint(1) NOT NULL DEFAULT 1,
  `deceased_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `personal_information`
--

INSERT INTO `personal_information` (`personal_info_id`, `lastname`, `firstname`, `middlename`, `date_of_birth`, `civil_status`, `educational_attainment`, `occupation`, `religion`, `citizenship`, `address_id`, `sex`, `phone_number`, `email`, `id_picture`, `isTransferred`, `registered_voter`, `deceased_date`, `created_at`, `updated_at`) VALUES
(1, 'Victorino', 'Amiel Jose', 'Lakobalo', '2002-04-09', 'Single', 'College Graduate', 'Brgy. Secretary', 'Roman Catholic', 'Filipino', 6, 'male', '09171234567', 'amieljosevictorino@gmail.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(2, 'Singua', 'Reyna Jane', 'Lakobalo', '1994-03-09', 'Single', 'College Graduate', 'Brgy. Midwife', 'Roman Catholic', 'Filipino', 6, 'female', '09281234567', 'reynajanesingua@gmail.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(3, 'Gonzales', 'Ann', 'Ramos', '1978-11-15', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 3, 'male', '09331234567', 'anngonzales@gmail.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 12:56:54'),
(4, 'Garcia', 'Ana', 'Santos', '1985-07-16', 'Married', 'College Undergraduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 4, 'female', '09441234566', 'ana.garcia@gmail.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 14:08:19'),
(5, 'Mendoza', 'May', 'Alvarez', '1996-12-04', 'Single', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 5, 'male', '09551234567', 'carlos.mendoza@example.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(6, 'Aquino', 'Laura', 'Gonzalez', '1992-09-18', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 6, 'female', '09661234567', 'laura.aquino@example.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-27 13:40:16'),
(7, 'Santos', 'Isabel', 'Navarro', '1983-06-25', 'Legally Separated', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 7, 'female', '09771234567', 'isabel.santos@example.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-07-25 11:07:25'),
(8, 'Cruz', 'Annie', 'Castro', '1973-01-10', 'Married', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 8, 'male', '09881234567', 'annie.cruz@gmail.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-16 14:07:55'),
(9, 'Morales', 'Elena', 'Garcia', '1999-04-20', 'Single', 'Highschool Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 9, 'male', '09991234567', 'elena.morales@example.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-07 08:42:29'),
(10, 'Reyes', 'Gabriela', 'Santos', '1981-08-14', 'Married', 'College Graduate', 'Barangay Health Worker', 'Roman Catholic', 'Filipino', 10, 'male', '09182345678', 'gabriel.delosreyes@example.com', NULL, 0, 1, NULL, '2023-07-25 11:07:25', '2024-09-10 10:44:05'),
(13, 'Araneta', 'Roy Marjohn', 'Galjlfad', '2001-08-28', 'Married', 'College Graduate', 'Kingpin', 'Roman Catholic', 'Filipino', 6, 'male', '09308309624', 'roymarjohnaraneta@gmail.com', NULL, 0, 1, NULL, '2024-07-16 11:07:25', '2024-09-06 09:32:11'),
(14, 'Angcona', 'Ruvy', 'Lakobalo', '2001-11-09', 'Married', 'College Undergraduate', 'Teacher', 'Roman Catholic', 'Filipino', 6, 'female', '09586789012', 'ruvyangcona@gmail.com', NULL, 0, 1, NULL, '2024-07-16 11:07:25', '2024-09-10 03:31:46'),
(67, 'Araneta', 'Roy Marjohn Jr.', 'Lakobalo', '2018-10-03', 'Single', NULL, NULL, 'Filipino', 'Roman Catholic', 6, 'male', NULL, NULL, NULL, 0, 0, NULL, '2024-07-17 11:07:25', '2024-10-11 15:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy`
--

CREATE TABLE `pregnancy` (
  `pregnancy_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `expected_due_date` date NOT NULL,
  `pregnancy_status` enum('Ongoing','Completed','Terminated') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pregnancy`
--

INSERT INTO `pregnancy` (`pregnancy_id`, `resident_id`, `expected_due_date`, `pregnancy_status`, `created_at`, `updated_at`) VALUES
(1, 5, '2024-12-15', 'Ongoing', '2024-07-25 09:49:51', '2024-10-11 07:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `prenatals`
--

CREATE TABLE `prenatals` (
  `prenatal_id` int(10) NOT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `pregnancy_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `bhw_id` int(10) NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `heart_lungs_condition` varchar(255) DEFAULT NULL,
  `abdominal_exam` varchar(255) DEFAULT NULL,
  `fetal_heart_rate` varchar(255) DEFAULT NULL,
  `fundal_height` varchar(255) DEFAULT NULL,
  `fetal_movement` varchar(255) DEFAULT NULL,
  `checkup_notes` text DEFAULT NULL,
  `refer_to` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenatals`
--

INSERT INTO `prenatals` (`prenatal_id`, `tracking_code`, `pregnancy_id`, `sched_id`, `bhw_id`, `weight`, `blood_pressure`, `heart_lungs_condition`, `abdominal_exam`, `fetal_heart_rate`, `fundal_height`, `fetal_movement`, `checkup_notes`, `refer_to`, `created_at`, `updated_at`) VALUES
(6, 'A1B2C3D4E5F6G7H8', 1, 1, 1, 65.50, '120/80', 'Normal', 'No abnormalities', 'Strong', '20 cm', 'Felt regularly', 'First visit checkup', NULL, '2024-09-23 02:12:40', '2024-09-23 06:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `prenatal_schedules`
--

CREATE TABLE `prenatal_schedules` (
  `sched_id` int(10) NOT NULL,
  `sched_date` datetime(6) NOT NULL,
  `sched_note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `prenatal_schedules`
--

INSERT INTO `prenatal_schedules` (`sched_id`, `sched_date`, `sched_note`) VALUES
(1, '2024-11-03 10:00:00.000000', 'First prenatal checkup'),
(2, '2024-11-10 14:00:00.000000', 'Second trimester follow-up'),
(3, '2024-11-17 09:30:00.000000', 'Ultrasound appointment'),
(4, '2024-11-20 11:00:00.000000', 'Blood test and weight check'),
(5, '2024-11-28 13:00:00.000000', 'Final prenatal evaluation');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `residents`
--

INSERT INTO `residents` (`resident_id`, `account_id`, `personal_info_id`) VALUES
(4, 13, 13),
(5, 14, 14),
(99, 50, 67);

-- --------------------------------------------------------

--
-- Table structure for table `residents_medical_condition`
--

CREATE TABLE `residents_medical_condition` (
  `rmc_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `medical_conditions_id` int(10) NOT NULL,
  `diagnosed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `residents_medical_condition`
--

INSERT INTO `residents_medical_condition` (`rmc_id`, `resident_id`, `medical_conditions_id`, `diagnosed_date`, `created_at`) VALUES
(17, 4, 10, '2024-09-30 11:40:54', '2024-09-30 11:40:54'),
(18, 4, 2, '2024-09-30 11:40:54', '2024-09-30 11:40:54'),
(19, 4, 11, '2024-09-30 11:40:54', '2024-09-30 11:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `vaccinations`
--

CREATE TABLE `vaccinations` (
  `vaccination_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `vaccine_id` int(10) NOT NULL,
  `vaccination_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vaccinations`
--

INSERT INTO `vaccinations` (`vaccination_id`, `resident_id`, `vaccine_id`, `vaccination_date`) VALUES
(1, 4, 16, '2024-01-15'),
(2, 5, 16, '2024-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `vaccine_id` int(10) NOT NULL,
  `vaccine_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`vaccine_id`, `vaccine_name`) VALUES
(1, 'Bacillus Calmette-Guérin (BCG) Vaccine'),
(2, 'Hepatitis B Vaccine'),
(3, 'Diphtheria, Tetanus, and Pertussis (DTaP) Vaccine'),
(4, 'Polio Vaccine (IPV)'),
(5, 'Measles, Mumps, and Rubella (MMR) Vaccine'),
(6, 'Hepatitis A Vaccine'),
(7, 'Influenza Vaccine (Flu Shot)'),
(8, 'Typhoid Vaccine'),
(9, 'Japanese Encephalitis Vaccine'),
(10, 'Rabies Vaccine'),
(11, 'Human Papillomavirus (HPV) Vaccine'),
(12, 'Pneumococcal Conjugate Vaccine (PCV)'),
(13, 'Varicella (Chickenpox) Vaccine'),
(14, 'Tetanus, Diphtheria, and Pertussis (Tdap) Booster'),
(15, 'Meningococcal Vaccine'),
(16, 'Pfizer-BioNTech COVID-19 Vaccine'),
(17, 'Moderna COVID-19 Vaccine'),
(18, 'AstraZeneca COVID-19 Vaccine'),
(19, 'Sinovac-CoronaVac COVID-19 Vaccine'),
(20, 'Johnson & Johnson COVID-19 Vaccine');

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
-- Indexes for table `conditions_prescriptions`
--
ALTER TABLE `conditions_prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `fk_cpresMedId` (`medicine_id`),
  ADD KEY `fk_cpresRmcId` (`resident_condition_id`);

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
  ADD UNIQUE KEY `resident_id` (`resident_id`),
  ADD KEY `fk_memberFamilyId` (`family_id`);

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
  ADD KEY `fk_prenatalBhwId` (`bhw_id`),
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
-- Indexes for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD PRIMARY KEY (`vaccination_id`),
  ADD KEY `fk_vaccinationResidentId` (`resident_id`),
  ADD KEY `fk_vaccinationVaccineId` (`vaccine_id`);

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
  MODIFY `account_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

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
  MODIFY `appointment_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `bhw`
--
ALTER TABLE `bhw`
  MODIFY `bhw_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `conditions_prescriptions`
--
ALTER TABLE `conditions_prescriptions`
  MODIFY `prescription_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `consultation_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `consultations_prescriptions`
--
ALTER TABLE `consultations_prescriptions`
  MODIFY `medication_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consultation_schedules`
--
ALTER TABLE `consultation_schedules`
  MODIFY `con_sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `families`
--
ALTER TABLE `families`
  MODIFY `family_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1021;

--
-- AUTO_INCREMENT for table `family_members`
--
ALTER TABLE `family_members`
  MODIFY `fmember_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

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
  MODIFY `household_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1014;

--
-- AUTO_INCREMENT for table `household_members`
--
ALTER TABLE `household_members`
  MODIFY `hm_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `medical_conditions`
--
ALTER TABLE `medical_conditions`
  MODIFY `medical_conditions_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `medicine_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `midwife`
--
ALTER TABLE `midwife`
  MODIFY `midwife_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_information`
--
ALTER TABLE `personal_information`
  MODIFY `personal_info_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `pregnancy`
--
ALTER TABLE `pregnancy`
  MODIFY `pregnancy_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prenatals`
--
ALTER TABLE `prenatals`
  MODIFY `prenatal_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `prenatal_schedules`
--
ALTER TABLE `prenatal_schedules`
  MODIFY `sched_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `resident_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `residents_medical_condition`
--
ALTER TABLE `residents_medical_condition`
  MODIFY `rmc_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `vaccinations`
--
ALTER TABLE `vaccinations`
  MODIFY `vaccination_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
-- Constraints for table `conditions_prescriptions`
--
ALTER TABLE `conditions_prescriptions`
  ADD CONSTRAINT `fk_cpresMedId` FOREIGN KEY (`medicine_id`) REFERENCES `medicines` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cpresRmcId` FOREIGN KEY (`resident_condition_id`) REFERENCES `residents_medical_condition` (`rmc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_prenatalBhwId` FOREIGN KEY (`bhw_id`) REFERENCES `bhw` (`bhw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `vaccinations`
--
ALTER TABLE `vaccinations`
  ADD CONSTRAINT `fk_vaccinationResidentId` FOREIGN KEY (`resident_id`) REFERENCES `residents` (`resident_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_vaccinationVaccineId` FOREIGN KEY (`vaccine_id`) REFERENCES `vaccines` (`vaccine_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
