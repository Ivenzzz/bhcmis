<?php 

function getImmunizationAppointments($conn) {
    $query = "
        SELECT 
            ia.*,
            isch.schedule_id,
            isch.schedule_date,
            isch.vaccine_id,
            v.vaccine_name,
            r.resident_id,
            pi.lastname,
            pi.firstname,
            pi.middlename
        FROM 
            immunization_appointments ia
        INNER JOIN 
            immunization_schedules isch ON ia.sched_id = isch.schedule_id
        INNER JOIN 
            vaccines v ON isch.vaccine_id = v.vaccine_id
        INNER JOIN 
            residents r ON ia.resident_id = r.resident_id
        INNER JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            ia.isArchived = 0 AND isch.isArchived = 0
        ORDER BY 
            isch.schedule_date, ia.priority_number;
    ";

    // Execute the query
    $result = $conn->query($query);

    if ($result) {
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        return $appointments;
    } else {
        return "Error: " . $conn->error;
    }
}

function getImmunizationSchedules($conn) {
    try {
        // Query to get immunization schedules with vaccine details
        $query = "SELECT 
                      `is`.schedule_id, 
                      `is`.schedule_date, 
                      `is`.vaccine_id, 
                      v.vaccine_name, 
                      v.lot_number, 
                      v.expiration_date, 
                      `is`.isArchived, 
                      `is`.created_at, 
                      `is`.updated_at
                  FROM immunization_schedules `is`
                  JOIN vaccines v ON `is`.vaccine_id = v.vaccine_id
                  WHERE `is`.isArchived = 0
                  ORDER BY `is`.schedule_date DESC";
        
        $result = $conn->query($query);
        
        // Check if query execution is successful
        if (!$result) {
            throw new Exception("Query failed: " . $conn->error);
        }
        
        $schedules = [];
        
        // Fetch and store results
        while ($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }
        
        return $schedules;
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}

function getImmunizationAppointmentsBySchedId($conn, $sched_id) {
    try {
<<<<<<< HEAD
        // Query to get immunization appointments and join with residents, personal_information, immunization_schedules, and vaccines to get full name and vaccine details
=======
        // Query to get immunization appointments based on sched_id
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        $query = "SELECT 
                      ia.appointment_id, 
                      ia.tracking_code, 
                      ia.resident_id, 
                      ia.sched_id, 
                      ia.priority_number, 
                      ia.status, 
                      ia.isArchived, 
                      ia.created_at, 
<<<<<<< HEAD
                      ia.updated_at,
                      CONCAT(pi.lastname, ', ', pi.firstname, ' ', pi.middlename) AS full_name,
                      isch.schedule_date,
                      v.vaccine_id, 
                      v.vaccine_name, 
                      v.lot_number, 
                      v.expiration_date
                  FROM immunization_appointments ia
                  JOIN residents r ON ia.resident_id = r.resident_id
                  JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
                  JOIN immunization_schedules isch ON ia.sched_id = isch.schedule_id
                  JOIN vaccines v ON isch.vaccine_id = v.vaccine_id
                  WHERE ia.sched_id = ? AND ia.isArchived = 0 AND r.isArchived = 0
=======
                      ia.updated_at
                  FROM immunization_appointments ia
                  WHERE ia.sched_id = ? AND ia.isArchived = 0
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
                  ORDER BY ia.priority_number ASC";
        
        // Prepare the query
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        
        // Bind the sched_id parameter to the query
        $stmt->bind_param("i", $sched_id);
        
        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }
        
        // Get the result
        $result = $stmt->get_result();
        
        // Check if any appointments are found
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }
        
        // Close the statement
        $stmt->close();
        
        return $appointments;
    } catch (Exception $e) {
        return ["error" => $e->getMessage()];
    }
}


<<<<<<< HEAD
function getVaccines($conn) {
    // Get the current date
    $currentDate = date('Y-m-d');

    // Modify the query to exclude expired vaccines
    $sql = "SELECT vaccine_id, vaccine_name, stocks, lot_number, expiration_date, created_at 
            FROM vaccines 
            WHERE expiration_date >= '$currentDate'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        $vaccines = [];
        while ($row = $result->fetch_assoc()) {
            $vaccines[] = $row;
        }
        return $vaccines;
    } else {
        return [];
    }
}

// Function to retrieve immunization details based on appointment_id
function getImmunizationDetails($conn, $appointment_id) {
    // SQL query to fetch immunization details and the actual date for next_dose_due
    $sql = "
        SELECT 
            immunizations.immunization_id,
            immunizations.route,
            immunizations.administered_by,
            immunizations.dose_number,
            next_schedule.schedule_date AS next_dose_due,  -- Get the schedule date for the next dose
            immunizations.adverse_reaction,
            immunization_appointments.tracking_code,
            immunization_appointments.status,
            immunization_schedules.schedule_date
        FROM immunizations
        INNER JOIN immunization_appointments ON immunizations.appointment_id = immunization_appointments.appointment_id
        INNER JOIN immunization_schedules ON immunization_appointments.sched_id = immunization_schedules.schedule_id
        LEFT JOIN immunization_schedules AS next_schedule ON immunizations.next_dose_due = next_schedule.schedule_id  -- Join again for next_dose_due
        WHERE immunization_appointments.appointment_id = ?
        AND immunizations.isArchived = 0
        AND immunization_appointments.isArchived = 0
    ";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("i", $appointment_id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Check if any record was found
        if ($result->num_rows > 0) {
            // Fetch the result as an associative array
            $immunization_details = $result->fetch_assoc();
            // Return the result
            return $immunization_details;
        } else {
            return null; // No data found
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle errors with the query preparation
        return "Error: " . $conn->error;
    }
}





=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
?>