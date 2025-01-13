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


?>