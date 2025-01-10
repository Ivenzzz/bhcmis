CREATE TABLE `residents` (
  `resident_id` int(10) NOT NULL,
  `account_id` int(10) DEFAULT NULL,
  `personal_info_id` int(10) NOT NULL,
  `isArchived` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

