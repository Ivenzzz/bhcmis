<?php 

function getPregnantResidents($conn) {
    // SQL query to retrieve all pregnant residents with ongoing pregnancies
    $query = "
        SELECT 
            pi.personal_info_id,
            pi.firstname,
            pi.middlename,
            pi.lastname,
            pi.date_of_birth,
            pi.sex,
            p.expected_due_date,
            p.pregnancy_status
        FROM pregnancy p
        INNER JOIN residents r ON p.resident_id = r.resident_id
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE p.pregnancy_status = 'Ongoing' 
          AND p.isArchived = 0
          AND r.isArchived = 0;
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if query execution was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Fetch and return results as an array
    $pregnantResidents = [];
    while ($row = $result->fetch_assoc()) {
        $pregnantResidents[] = $row;
    }

    return $pregnantResidents;
}

function getPrenatalSchedules($conn) {
    // SQL query to retrieve all prenatal schedules
    $sql = "
        SELECT 
            sched_id, 
            sched_date, 
            isArchived, 
            created_at, 
            updated_at
        FROM 
            prenatal_schedules
        WHERE 
            isArchived = 0  -- Only retrieve schedules that are not archived
        ORDER BY 
            sched_date DESC  -- Order schedules by date
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $schedules = [];
        while ($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }

        // Return the array of prenatal schedules
        return $schedules;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}

function getPrenatalsByScheduleId($conn, $sched_id) {
    // SQL query to retrieve prenatal details based on the schedule ID
    $sql = "
        SELECT 
            p.prenatal_id, 
            p.tracking_code, 
            p.weight, 
            p.blood_pressure, 
            p.heart_lungs_condition, 
            p.abdominal_exam, 
            p.fetal_heart_rate, 
            p.fundal_height, 
            p.fetal_movement, 
            p.checkup_notes, 
            p.refer_to, 
            pr.pregnancy_id, 
            pr.expected_due_date, 
            pr.pregnancy_status, 
            r.resident_id, 
            pi.lastname, 
            pi.firstname, 
            pi.middlename, 
            pi.date_of_birth,
            a.address_name, 
            a.address_type,
            -- Compute Age from date_of_birth
            TIMESTAMPDIFF(YEAR, pi.date_of_birth, CURDATE()) AS age
        FROM 
            prenatals p
        INNER JOIN pregnancy pr ON p.pregnancy_id = pr.pregnancy_id
        INNER JOIN residents r ON pr.resident_id = r.resident_id
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        INNER JOIN address a ON pi.address_id = a.address_id
        WHERE 
            p.sched_id = ? AND p.isArchived = 0 AND pr.isArchived = 0 AND r.isArchived = 0
        ORDER BY lastname
    ";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the schedule ID to the query
        $stmt->bind_param('i', $sched_id);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if there are any records
        if ($result->num_rows > 0) {
            // Fetch the results as an associative array
            $prenatalData = $result->fetch_all(MYSQLI_ASSOC);
            return $prenatalData;  // Return the retrieved prenatal data
        } else {
            return null;  // No records found
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        // Handle query preparation error
        echo "Error preparing the query.";
        return null;
    }
}




?>

