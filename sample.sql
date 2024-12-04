CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL
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

CREATE TABLE `medical_conditions` (
  `medical_conditions_id` int(10) NOT NULL,
  `condition_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `residents_medical_condition` (
  `rmc_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `medical_conditions_id` int(10) NOT NULL,
  `diagnosed_date` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


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
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `household_members` (
  `hm_id` int(10) NOT NULL,
  `household_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `families` (
  `family_id` int(10) NOT NULL,
  `parent_family_id` int(10) DEFAULT NULL,
  `4PsMember` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `family_members` (
  `fmember_id` int(10) NOT NULL,
  `family_id` int(10) NOT NULL,
  `resident_id` int(10) NOT NULL,
  `role` enum('husband','wife','child') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `annual_population` (
  `population_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `total_population` int(11) NOT NULL,
  `total_males` int(11) NOT NULL,
  `total_females` int(11) NOT NULL,
  `deceased_count` int(11) DEFAULT 0,
  `transferred_count` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;