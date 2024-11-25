<?php 

function getAllResidents($conn) {
    // SQL query to retrieve all residents with their personal information and address
    $sql = "
        SELECT 
            r.resident_id,  
            r.personal_info_id, 
            p.lastname, 
            p.firstname, 
            p.middlename, 
            p.date_of_birth, 
            p.address_id,
            p.civil_status,
            p.sex,
            p.registered_voter,  
            a.address_name, 
            a.address_type, 
            p.created_at, 
            p.updated_at
        FROM 
            residents r
        LEFT JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        LEFT JOIN 
            address a ON p.address_id = a.address_id
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $residents = [];
        while ($row = $result->fetch_assoc()) {
            // Calculate the age based on the date of birth
            $dateOfBirth = new DateTime($row['date_of_birth']);
            $currentDate = new DateTime(); // Get the current date
            $age = $dateOfBirth->diff($currentDate)->y; // Get the difference in years

            // Add the age to the resident data
            $row['age'] = $age;

            // Add the resident to the residents array
            $residents[] = $row;
        }

        // Return the array of residents with personal information, address, and age
        return $residents;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}
?>
