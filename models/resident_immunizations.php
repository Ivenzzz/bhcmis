<?php 

function getScheduledImmunizationAppointmentsByResident($conn, $resident_id) {
    // SQL query to retrieve only scheduled immunization appointments for a specific resident
    $query = "
        SELECT 
            a.appointment_id,
            a.tracking_code,
            a.resident_id,
            a.sched_id,
            a.priority_number,
            a.status,
            a.isArchived,
            a.created_at AS appointment_created_at,
            a.updated_at AS appointment_updated_at,
            s.schedule_id,
            s.schedule_date,
            s.isArchived AS schedule_isArchived,
            s.created_at AS schedule_created_at,
            s.updated_at AS schedule_updated_at
        FROM 
            immunization_appointments AS a
        INNER JOIN 
            immunization_schedules AS s
        ON 
            a.sched_id = s.schedule_id
        WHERE 
            a.resident_id = ? 
            AND a.isArchived = 0 
            AND s.isArchived = 0 
            AND a.status = 'Scheduled'
        ORDER BY 
            s.schedule_date ASC, a.priority_number ASC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $resident_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $appointments;
}

function getCompletedImmunizationAppointmentsByResident($conn, $resident_id) {
    // SQL query to retrieve only completed immunization appointments for a specific resident
    $query = "
        SELECT 
            a.appointment_id,
            a.tracking_code,
            a.resident_id,
            a.sched_id,
            a.priority_number,
            a.status,
            a.isArchived,
            a.created_at AS appointment_created_at,
            a.updated_at AS appointment_updated_at,
            s.schedule_id,
            s.schedule_date,
            s.isArchived AS schedule_isArchived,
            s.created_at AS schedule_created_at,
            s.updated_at AS schedule_updated_at
        FROM 
            immunization_appointments AS a
        INNER JOIN 
            immunization_schedules AS s
        ON 
            a.sched_id = s.schedule_id
        WHERE 
            a.resident_id = ? 
            AND a.isArchived = 0 
            AND s.isArchived = 0 
            AND a.status = 'Completed'
        ORDER BY 
            s.schedule_date ASC, a.priority_number ASC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $resident_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $appointments;
}

function getCancelledImmunizationAppointmentsByResident($conn, $resident_id) {
    // SQL query to retrieve only cancelled immunization appointments for a specific resident
    $query = "
        SELECT 
            a.appointment_id,
            a.tracking_code,
            a.resident_id,
            a.sched_id,
            a.priority_number,
            a.status,
            a.isArchived,
            a.created_at AS appointment_created_at,
            a.updated_at AS appointment_updated_at,
            s.schedule_id,
            s.schedule_date,
            s.isArchived AS schedule_isArchived,
            s.created_at AS schedule_created_at,
            s.updated_at AS schedule_updated_at
        FROM 
            immunization_appointments AS a
        INNER JOIN 
            immunization_schedules AS s
        ON 
            a.sched_id = s.schedule_id
        WHERE 
            a.resident_id = ? 
            AND a.isArchived = 0 
            AND s.isArchived = 0 
            AND a.status = 'Cancelled'
        ORDER BY 
            s.schedule_date ASC, a.priority_number ASC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $resident_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $appointments;
}

function getMissedImmunizationAppointmentsByResident($conn, $resident_id) {
    // SQL query to retrieve only cancelled immunization appointments for a specific resident
    $query = "
        SELECT 
            a.appointment_id,
            a.tracking_code,
            a.resident_id,
            a.sched_id,
            a.priority_number,
            a.status,
            a.isArchived,
            a.created_at AS appointment_created_at,
            a.updated_at AS appointment_updated_at,
            s.schedule_id,
            s.schedule_date,
            s.isArchived AS schedule_isArchived,
            s.created_at AS schedule_created_at,
            s.updated_at AS schedule_updated_at
        FROM 
            immunization_appointments AS a
        INNER JOIN 
            immunization_schedules AS s
        ON 
            a.sched_id = s.schedule_id
        WHERE 
            a.resident_id = ? 
            AND a.isArchived = 0 
            AND s.isArchived = 0 
            AND a.status = 'Missed'
        ORDER BY 
            s.schedule_date ASC, a.priority_number ASC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $resident_id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $appointments;
}

function getImmunizationSchedules($conn) {
    // SQL query to retrieve immunization schedules
    $query = "
        SELECT 
            schedule_id,
            schedule_date,
            isArchived,
            created_at,
            updated_at
        FROM 
            immunization_schedules
        WHERE 
            isArchived = 0
        ORDER BY 
            schedule_date DESC
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the results as an associative array
    $schedules = [];
    while ($row = $result->fetch_assoc()) {
        $schedules[] = $row;
    }

    // Close the statement
    $stmt->close();

    return $schedules;
}

function getAppointmentsByResidentIds($conn, $residentIds) {
    // Ensure the input is an array
    if (!is_array($residentIds)) {
        return "Error: Input must be an array of resident IDs.";
    }

    // Sanitize the array to prevent SQL injection
    $sanitizedResidentIds = array_map('intval', $residentIds);
    $residentIdsString = implode(',', $sanitizedResidentIds);

    // SQL query to retrieve appointments along with resident names, calculated age, and schedule date
    $query = "
        SELECT 
            ia.appointment_id, 
            ia.tracking_code, 
            ia.resident_id, 
            ia.sched_id, 
            ia.priority_number, 
            ia.status, 
            ia.isArchived AS appointment_isArchived, 
            ia.created_at AS appointment_created_at, 
            ia.updated_at AS appointment_updated_at,
            pi.lastname, 
            pi.firstname, 
            pi.middlename,
            -- Calculate age based on date_of_birth
            FLOOR(DATEDIFF(CURDATE(), pi.date_of_birth) / 365.25) AS age,
            isch.schedule_date  -- Added schedule_date from immunization_schedules
        FROM immunization_appointments ia
        JOIN residents r ON ia.resident_id = r.resident_id
        JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
        JOIN immunization_schedules isch ON ia.sched_id = isch.schedule_id  -- Joining with immunization_schedules
        WHERE ia.resident_id IN ($residentIdsString) 
        AND ia.isArchived = 0 
        AND r.isArchived = 0
        ORDER BY isch.schedule_date DESC
    ";

    // Execute the query
    $result = $conn->query($query);

    // Check if query was successful
    if ($result === false) {
        return "Error executing query: " . $conn->error;
    }

    // Fetch the results
    $appointments = [];
    while ($row = $result->fetch_assoc()) {
        $appointments[] = $row;
    }

    // Return the retrieved appointments with resident names, age, and schedule date
    return $appointments;
}

function getImmunizationDetailsByAppointmentId($conn, $appointment_id) {
    // Validate the appointment_id input
    if (empty($appointment_id) || !is_numeric($appointment_id)) {
        return "Error: Invalid appointment ID.";
    }

    // SQL query to retrieve immunization details based on appointment_id
    $query = "
        SELECT 
            ia.appointment_id,
            ia.tracking_code,
            ia.resident_id,
            ia.sched_id,
            ia.priority_number,
            ia.status,
            ia.isArchived AS appointment_isArchived,
            isch.schedule_date,
            i.immunization_id,
            i.vaccine_id,
            v.vaccine_name,  -- Add vaccine name here
            i.dose_number,
            i.adverse_reaction,
            i.isArchived AS immunization_isArchived,
            i.created_at AS immunization_created_at,
            i.updated_at AS immunization_updated_at,
            next_isch.schedule_date AS next_dose_schedule_date  -- Add next dose schedule date
        FROM immunization_appointments ia
        JOIN immunization_schedules isch ON ia.sched_id = isch.schedule_id
        LEFT JOIN immunizations i ON ia.appointment_id = i.appointment_id
        LEFT JOIN vaccines v ON i.vaccine_id = v.vaccine_id
        LEFT JOIN immunization_schedules next_isch ON i.next_dose_due = next_isch.schedule_id  -- Join again for the next dose schedule
        WHERE ia.appointment_id = ? AND ia.isArchived = 0 AND isch.isArchived = 0
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $appointment_id);

    // Execute the query
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        // Check if results are found
        if ($result->num_rows > 0) {
            // Fetch the results as an associative array
            $immunization_details = $result->fetch_all(MYSQLI_ASSOC);
            return $immunization_details;
        } else {
            return "No immunization details found for the specified appointment ID.";
        }
    } else {
        return "Error executing query: " . $conn->error;
    }
}




?>
