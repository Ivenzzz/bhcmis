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
        // Query to get immunization appointments based on sched_id
        $query = "SELECT 
                      ia.appointment_id, 
                      ia.tracking_code, 
                      ia.resident_id, 
                      ia.sched_id, 
                      ia.priority_number, 
                      ia.status, 
                      ia.isArchived, 
                      ia.created_at, 
                      ia.updated_at
                  FROM immunization_appointments ia
                  WHERE ia.sched_id = ? AND ia.isArchived = 0
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


?>