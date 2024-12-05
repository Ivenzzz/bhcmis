<?php
function getMidwives($conn) {
    // Define the SQL query to get active midwife first, followed by inactive ones
    $query = "
        SELECT 
            m.midwife_id,
            m.account_id,
            m.personal_info_id,
            m.employment_status,
            m.employment_date,
            m.license_number,
            p.lastname,
            p.firstname,
            p.middlename,
            p.date_of_birth,
            p.civil_status,
            p.educational_attainment,
            p.occupation,
            p.religion,
            p.citizenship,
            p.sex,
            p.phone_number,
            p.email
        FROM 
            midwife m
        INNER JOIN 
            personal_information p 
        ON 
            m.personal_info_id = p.personal_info_id
        ORDER BY 
            m.employment_status DESC, -- 'active' comes before 'inactive'
            m.employment_date ASC; -- Oldest employment date first
    ";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch all rows
        $midwives = [];
        while ($row = $result->fetch_assoc()) {
            $midwives[] = $row;
        }

        // Close the statement
        $stmt->close();

        return $midwives;
    } else {
        // If the query fails
        throw new Exception("Error preparing SQL statement: " . $conn->error);
    }
}
