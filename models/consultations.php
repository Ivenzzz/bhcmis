<?php

function getConsultationSchedules($conn) {
    // SQL query to retrieve all consultation schedules ordered by con_sched_date in descending order
    $sql = "
        SELECT 
            con_sched_id, 
            con_sched_date, 
            isArchived, 
            created_at, 
            updated_at
        FROM 
            consultation_schedules
        ORDER BY 
            con_sched_date DESC
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $schedules = [];
        while ($row = $result->fetch_assoc()) {
            $schedules[] = $row;
        }

        // Return the array of consultation schedules
        return $schedules;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}

function getAppointmentsBySchedule($con_sched_id, $conn) {
    try {
        // SQL query to fetch data from appointments, residents, personal_information, and consultation_schedules tables
        $stmtAppointments = $conn->prepare(
            "SELECT a.*, r.resident_id, 
                    CONCAT(pi.lastname, ', ', pi.firstname, ' ', pi.middlename) AS resident_name,
                    cs.con_sched_date AS appointment_schedule_date
            FROM appointments a
            JOIN residents r ON a.resident_id = r.resident_id
            JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            JOIN consultation_schedules cs ON a.sched_id = cs.con_sched_id
            WHERE a.sched_id = ? AND a.isArchived = 0"
        );
        $stmtAppointments->bind_param("i", $con_sched_id); // "i" stands for integer
        $stmtAppointments->execute();
        $resultAppointments = $stmtAppointments->get_result();
        $appointments = $resultAppointments->fetch_all(MYSQLI_ASSOC);

        // Return the appointments data
        return $appointments;
    } catch (mysqli_sql_exception $e) {
        // Handle errors
        return [
            'error' => $e->getMessage()
        ];
    }
}

function getConsultationsBySchedule($con_sched_id, $conn) {
    try {
        // SQL query to fetch data from consultations, residents, personal_information, and consultation_schedules tables
        $stmtConsultations = $conn->prepare(
            "SELECT c.*, r.resident_id, 
                    CONCAT(pi.lastname, ', ', pi.firstname, ' ', pi.middlename) AS resident_name,
                    cs.con_sched_date AS consultation_schedule_date,
                    cs.con_sched_id
            FROM consultations c
            JOIN residents r ON c.resident_id = r.resident_id
            JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            JOIN consultation_schedules cs ON c.sched_id = cs.con_sched_id
            WHERE c.sched_id = ?"
        );
        
        $stmtConsultations->bind_param("i", $con_sched_id);
        $stmtConsultations->execute();
        $resultConsultations = $stmtConsultations->get_result();
        $consultations = $resultConsultations->fetch_all(MYSQLI_ASSOC);

        // Return the consultations data
        return $consultations;
    } catch (mysqli_sql_exception $e) {
        // Handle errors
        return [
            'error' => $e->getMessage()
        ];
    }
}

function getPrescriptionsByConsultationId($consultation_id, $conn) {
    // Prepare the SQL query
    $sql = "SELECT 
                cp.medication_id, 
                cp.medicine_id, 
                cp.quantity, 
                cp.instructions, 
                m.name AS medicine_name,
                m.dosage, 
                m.form,
                IF(DATE(cp.created_at) = CURDATE(), 'new', '') AS is_new
            FROM consultations_prescriptions cp
            INNER JOIN medicines m ON cp.medicine_id = m.medicine_id
            WHERE cp.consultation_id = ? 
              AND cp.isArchived = 0 
              AND m.isArchived = 0
            ORDER BY cp.medication_id DESC";  // Only get non-archived prescriptions and medicines

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        // If query preparation failed, return an error
        return "Error preparing the query: " . $conn->error;
    }

    // Bind the consultation_id parameter
    $stmt->bind_param("i", $consultation_id);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch the prescriptions
    $prescriptions = [];
    while ($row = $result->fetch_assoc()) {
        $prescriptions[] = $row;
    }
    
    // Close the statement
    $stmt->close();
    
    // Return the prescriptions
    return $prescriptions;
}










?>