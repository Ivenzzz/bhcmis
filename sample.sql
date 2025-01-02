CREATE TABLE `pregnancy` (
  `pregnancy_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `expected_due_date` date NOT NULL,
  `pregnancy_status` enum('Ongoing','Completed','Terminated') NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;   

CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

CREATE TABLE `prenatal_schedules` (
  `sched_id` int(10) NOT NULL,
  `sched_date` datetime(6) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `resident_prenatal_schedules` (
  `resident_ps_id` int(10) NOT NULL,
  `pregnancy_id` int(10) NOT NULL,
  `sched_id` int(10) NOT NULL,
  `status` enum('completed','cancelled','incoming') NOT NULL DEFAULT 'incoming',
  `notes` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `accounts` (
  `account_id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','midwife','bhw','residents') NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `isValid` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `otp_verification` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `otp` varchar(6) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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

INSERT INTO `personal_information` (`personal_info_id`, `lastname`, `firstname`, `middlename`, `date_of_birth`, `civil_status`, `educational_attainment`, `occupation`, `religion`, `citizenship`, `address_id`, `sex`, `phone_number`, `email`, `id_picture`, `isTransferred`, `isDeceased`, `isRegisteredVoter`, `deceased_date`, `created_at`, `updated_at`) VALUES (NULL, 'Loro', 'Iven', 'Balad-on', '2002-03-06', 'Single', 'College Graduate', 'Programmer', 'Roman Catholic', 'Filipino', '10', 'male', '09308309627', 'ivenloro@gmail.com', NULL, '0', '0', '1', NULL, current_timestamp(), current_timestamp());