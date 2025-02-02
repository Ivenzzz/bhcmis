<?php 

function getConsultationsGroupedBySchedules($conn) {
    // SQL query to count consultations grouped by schedule and appointment status
    $sql = "
        SELECT 
            cs.con_sched_id, 
            cs.con_sched_date, 
            COALESCE(a.status, 'No Appointment') AS appointment_status,
            COUNT(c.consultation_id) AS consultation_count
        FROM 
            consultation_schedules cs
        LEFT JOIN 
            consultations c ON cs.con_sched_id = c.sched_id
        LEFT JOIN 
            appointments a ON c.appointment_id = a.appointment_id
        GROUP BY 
            cs.con_sched_id, cs.con_sched_date, a.status
        ORDER BY 
            cs.con_sched_date DESC;
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    // Fetch the results as an associative array
    $consultationsBySchedule = [];
    while ($row = $result->fetch_assoc()) {
        $consultationsBySchedule[] = $row;
    }

    // Count the number of Cancelled, Completed, Scheduled, and No Appointment consultations
    $statusCounts = [
        'Cancelled' => 0,
        'Completed' => 0,
        'Scheduled' => 0,
        'No Appointment' => 0
    ];

    foreach ($consultationsBySchedule as $consultation) {
        $status = $consultation['appointment_status'];
        if (array_key_exists($status, $statusCounts)) {
            $statusCounts[$status] += $consultation['consultation_count'];
        }
    }

    return [
        'consultations' => $consultationsBySchedule,
        'status_counts' => $statusCounts
    ];
}

function getImmunizationsBySchedule($conn) {
    // SQL query to count immunization appointments by schedule and status
    $sql = "
        SELECT 
            isch.schedule_id,
            isch.schedule_date,
            COUNT(ia.appointment_id) AS total_immunizations,
            SUM(CASE WHEN ia.status = 'Scheduled' THEN 1 ELSE 0 END) AS scheduled,
            SUM(CASE WHEN ia.status = 'Completed' THEN 1 ELSE 0 END) AS completed,
            SUM(CASE WHEN ia.status = 'Cancelled' THEN 1 ELSE 0 END) AS cancelled,
            SUM(CASE WHEN ia.status = 'Missed' THEN 1 ELSE 0 END) AS missed
        FROM 
            immunization_schedules isch
        LEFT JOIN 
            immunization_appointments ia ON isch.schedule_id = ia.sched_id
        WHERE 
            isch.isArchived = 0
        GROUP BY 
            isch.schedule_id, isch.schedule_date
        ORDER BY 
            isch.schedule_date DESC;
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    // Fetch the results as an associative array
    $immunizationsBySchedule = [];
    while ($row = $result->fetch_assoc()) {
        // Ensure counts are not null
        $row['total_immunizations'] = $row['total_immunizations'] ?? 0;
        $row['scheduled'] = $row['scheduled'] ?? 0;
        $row['completed'] = $row['completed'] ?? 0;
        $row['cancelled'] = $row['cancelled'] ?? 0;
        $row['missed'] = $row['missed'] ?? 0;

        $immunizationsBySchedule[] = $row;
    }

    return $immunizationsBySchedule;
}

function getPrenatalSchedulesWithCounts($conn) {
    // SQL query to retrieve prenatal schedules and their corresponding total number of prenatals
    $sql = "
        SELECT 
            ps.sched_id,
            ps.sched_date,
            COUNT(p.prenatal_id) AS total_prenatals
        FROM 
            prenatal_schedules ps
        LEFT JOIN 
            prenatals p ON ps.sched_id = p.sched_id
        WHERE 
            ps.isArchived = 0
        GROUP BY 
            ps.sched_id, ps.sched_date
        ORDER BY 
            ps.sched_date DESC;
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    // Fetch the results as an associative array
    $prenatalSchedules = [];
    while ($row = $result->fetch_assoc()) {
        // Ensure counts are not null
        $row['total_prenatals'] = $row['total_prenatals'] ?? 0;
        $prenatalSchedules[] = $row;
    }

    return $prenatalSchedules;
}

?>