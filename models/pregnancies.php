<?php 

function getPregnantResidents($conn) {
    // SQL query to retrieve all pregnant residents with ongoing pregnancies, address, and prenatal visit count
    $query = "
        SELECT 
            pi.personal_info_id,
            pi.firstname,
            pi.middlename,
            pi.lastname,
            pi.date_of_birth,
            pi.sex,
            a.*,
            p.*,
            COUNT(pr.prenatal_id) AS prenatal_count
        FROM pregnancy p
        INNER JOIN residents r ON p.resident_id = r.resident_id
        INNER JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        LEFT JOIN address a ON pi.address_id = a.address_id
        LEFT JOIN prenatals pr ON p.pregnancy_id = pr.pregnancy_id AND pr.isArchived = 0
        WHERE p.pregnancy_status = 'Ongoing' 
          AND p.isArchived = 0
          AND r.isArchived = 0
        GROUP BY pi.personal_info_id, p.pregnancy_id, pi.address_id;
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

function getPrenatalsBySchedId($conn, $sched_id) {
    // SQL query to join tables and retrieve the required data
    $sql = "
        SELECT 
            prenatals.prenatal_id,
            prenatals.tracking_code,
            personal_information.lastname,
            personal_information.firstname,
            personal_information.middlename,
            residents.resident_id,
            pregnancy.expected_due_date,
            pregnancy.pregnancy_status
        FROM prenatals
        INNER JOIN pregnancy ON prenatals.pregnancy_id = pregnancy.pregnancy_id
        INNER JOIN residents ON pregnancy.resident_id = residents.resident_id
        INNER JOIN personal_information ON residents.personal_info_id = personal_information.personal_info_id
        WHERE prenatals.sched_id = ? AND prenatals.isArchived = 0
        ORDER BY personal_information.lastname, personal_information.firstname
    ";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the sched_id parameter to the query
        $stmt->bind_param('i', $sched_id);

        // Execute the query
        $stmt->execute();

        // Store the result
        $result = $stmt->get_result();

        // Fetch all records
        $prenatals = [];
        while ($row = $result->fetch_assoc()) {
            $prenatals[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the result
        return $prenatals;
    } else {
        // In case of an error preparing the statement
        return null;
    }
}

function getScheduledPrenatals($conn, $sched_id) {
    // SQL query to join the necessary tables and retrieve the required data
    $query = "
        SELECT 
            rps.*,
            p.*,
            pi.lastname,
            pi.firstname,
            pi.middlename
        FROM 
            resident_prenatal_schedules rps
        INNER JOIN 
            pregnancy p ON rps.pregnancy_id = p.pregnancy_id
        INNER JOIN 
            residents r ON p.resident_id = r.resident_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            rps.sched_id = ? AND rps.status = 'incoming'
        ORDER BY rps.priority_number;
    ";

    // Prepare the SQL query
    if ($stmt = $conn->prepare($query)) {
        // Bind the parameter (sched_id) to the query
        $stmt->bind_param("i", $sched_id);
        
        // Execute the statement
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Initialize an array to hold the result
        $scheduled_prenatals = [];
        
        // Fetch the data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $scheduled_prenatals[] = $row; // Add the whole row to the $scheduled_prenatals array
        }
        
        // Close the statement
        $stmt->close();
        
        return $scheduled_prenatals;
    } else {
        // Error in query preparation
        return null;
    }
}

function getCancelledAppointments($conn, $sched_id) {
    // Initialize the SQL query
    $query = "
        SELECT 
            rps.*,
            p.*,
            pi.lastname,
            pi.firstname,
            pi.middlename
        FROM 
            resident_prenatal_schedules rps
        INNER JOIN 
            pregnancy p ON rps.pregnancy_id = p.pregnancy_id
        INNER JOIN 
            residents r ON p.resident_id = r.resident_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            rps.status = 'cancelled' AND rps.sched_id = ?
    ";

    // Prepare the SQL statement
    if ($stmt = $conn->prepare($query)) {
        // Bind the sched_id parameter
        $stmt->bind_param("i", $sched_id);

        // Execute the query
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Initialize an array to hold the cancelled appointments
        $cancelledAppointments = [];

        // Fetch rows and populate the array
        while ($row = $result->fetch_assoc()) {
            $cancelledAppointments[] = $row;
        }

        // Close the statement
        $stmt->close();

        return $cancelledAppointments;
    } else {
        // Handle query preparation errors
        return null;
    }
}

function getThisWeeksIncomingPrenatals($conn) {
    // SQL query to retrieve incoming prenatals for this week
    $query = "
        SELECT 
            rps.*,
            p.expected_due_date,
            p.pregnancy_status,
            ps.sched_date,
            pi.lastname,
            pi.firstname,
            pi.middlename
        FROM 
            resident_prenatal_schedules rps
        INNER JOIN 
            pregnancy p ON rps.pregnancy_id = p.pregnancy_id
        INNER JOIN 
            prenatal_schedules ps ON rps.sched_id = ps.sched_id
        INNER JOIN 
            residents r ON p.resident_id = r.resident_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            rps.status = 'incoming' 
            AND ps.sched_date >= CURDATE()
            AND ps.sched_date < DATE_ADD(CURDATE(), INTERVAL 7 DAY)
        ORDER BY 
            ps.sched_date ASC;
        ";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($query)) {
        // Execute the query
        $stmt->execute();
        
        // Get the result set
        $result = $stmt->get_result();
        
        // Initialize an array to hold the incoming prenatals
        $incomingPrenatals = [];
        
        // Fetch rows and populate the array
        while ($row = $result->fetch_assoc()) {
            $incomingPrenatals[] = $row;
        }
        
        // Close the statement
        $stmt->close();
        
        return $incomingPrenatals;
    } else {
        // Handle query preparation errors
        return null;
    }
}








?>

