<?php

function getBhwData($conn) {
    // SQL query to get all BHW data including both personal and assigned area addresses
    $sql = "SELECT 
            bhw.bhw_id AS bhw_id, 
            bhw.account_id AS account_id, 
            bhw.personal_info_id AS personal_info_id, 
            bhw.assigned_area AS assigned_area, 
            bhw.date_started AS date_started, 
            bhw.employment_status AS employment_status, 
            personal_information.lastname AS lastname, 
            personal_information.firstname AS firstname, 
            personal_information.middlename AS middlename,
            personal_information.date_of_birth AS date_of_birth,
            TIMESTAMPDIFF(YEAR, personal_information.date_of_birth, CURDATE()) AS age, 
            personal_information.civil_status AS civil_status, 
            personal_information.educational_attainment AS educational_attainment, 
            personal_information.occupation AS occupation, 
            personal_information.religion AS religion, 
            personal_information.citizenship AS citizenship, 
            personal_information.sex AS sex, 
            personal_information.phone_number AS phone_number, 
            personal_information.email AS email, 
            personal_information.created_at AS created_at, 
            personal_information.updated_at AS updated_at, 
            accounts.username AS username, 
            accounts.profile_picture AS profile_picture,
            accounts.isArchived AS isArchived,
            personal_address.address_name AS personal_address_name,  -- Personal address
            assigned_address.address_name AS assigned_area_name      -- Assigned area address
            FROM bhw
            INNER JOIN personal_information ON bhw.personal_info_id = personal_information.personal_info_id
            INNER JOIN accounts ON bhw.account_id = accounts.account_id
            INNER JOIN address AS personal_address ON personal_information.address_id = personal_address.address_id  -- Join for personal address
            INNER JOIN address AS assigned_address ON bhw.assigned_area = assigned_address.address_id
            WHERE accounts.isArchived = 0";  // Filter out archived residents
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Initialize an empty array to store the data
    $bhw_data = [];

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bhw_data[] = $row;
        }
    }

    // Return the data array
    return $bhw_data;
}

// Example usage
$bhw_data = getBhwData($conn);

?>
