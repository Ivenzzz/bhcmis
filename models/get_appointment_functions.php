<?php

function getAppointmentsByScheduleId($conn, $schedule_id) {
    $query = "
        SELECT 
            a.*,
            r.resident_id, 
            pi.firstname, 
            pi.lastname,
            pi.phone_number
        FROM 
            appointments a
        JOIN 
            residents r ON a.resident_id = r.resident_id
        JOIN 
            personal_information pi ON r.personal_info_id = pi.personal_info_id
        WHERE 
            a.sched_id = ?
        ORDER BY 
            a.created_at ASC
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $appointments = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $appointments;
    } else {
        return "Error: Could not retrieve appointments.";
    }
}

function getScheduleDateById($conn, $schedule_id) {
    $query = "
        SELECT con_sched_date
        FROM consultation_schedules
        WHERE con_sched_id = ?
    ";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("i", $schedule_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $schedule = $result->fetch_assoc();
        $stmt->close();
        return $schedule ? $schedule['con_sched_date'] : null;
    } else {
        return "Error: Could not retrieve schedule date.";
    }
}


?>