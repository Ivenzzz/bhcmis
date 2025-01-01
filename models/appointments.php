<?php

function getTodaysAppointments($conn) {
    // Get today's date for comparison
    $today = date('Y-m-d'); // Format as 'YYYY-MM-DD'

    // SQL query to retrieve today's appointments with resident names
    $query = "
        SELECT 
            a.appointment_id, 
            a.tracking_code, 
            a.priority_number, 
            a.status, 
            a.created_at AS appointment_created_at, 
            CONCAT(p.firstname, ' ', p.lastname) AS resident_name, 
            cs.con_sched_date 
        FROM 
            appointments a
        JOIN 
            consultation_schedules cs ON a.sched_id = cs.con_sched_id
        JOIN 
            residents r ON a.resident_id = r.resident_id
        JOIN 
            personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE 
            cs.con_sched_date LIKE ? 
            AND a.isArchived = 0 
            AND r.isArchived = 0 
            AND p.isDeceased = 0
        ORDER BY 
            a.priority_number
    ";

    // Prepare the statement
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error);
    }

    // Bind the parameter (use % for LIKE to get all appointments today)
    $todayWithWildcards = $today . '%';
    $stmt->bind_param('s', $todayWithWildcards);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are any appointments
    if ($result->num_rows > 0) {
        $appointments = [];
        while ($row = $result->fetch_assoc()) {
            $appointments[] = $row;
        }

        // Return the list of today's appointments
        return $appointments;
    } else {
        return null; // No appointments found
    }
}

function getTotalAppointmentsToday($conn) {
    $today = date('Y-m-d'); // Get the current date in 'YYYY-MM-DD' format

    $sql = "
        SELECT COUNT(a.appointment_id) AS total_appointments
        FROM appointments AS a
        INNER JOIN consultation_schedules AS cs
        ON a.sched_id = cs.con_sched_id
        WHERE DATE(cs.con_sched_date) = ? 
        AND a.isArchived = 0
        AND cs.isArchived = 0
    ";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $today); // Bind today's date
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();

        // Return the total number of appointments
        return $row['total_appointments'] ?? 0;
    } else {
        // Handle potential errors
        die("Query failed: " . $conn->error);
    }
}

function getTotalCompletedAppointments($conn) {
    $sql = "
        SELECT COUNT(appointment_id) AS total_completed
        FROM appointments
        WHERE status = 'Completed'
        AND isArchived = 0
    ";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        // Return the total number of completed appointments
        return $row['total_completed'] ?? 0;
    } else {
        // Handle potential errors
        die("Query failed: " . $conn->error);
    }
}

function getTotalCancelledAppointments($conn) {
    $sql = "
        SELECT COUNT(appointment_id) AS total_cancelled
        FROM appointments
        WHERE status = 'Cancelled'
        AND isArchived = 0
    ";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        // Return the total number of cancelled appointments
        return $row['total_cancelled'] ?? 0;
    } else {
        // Handle potential errors
        die("Query failed: " . $conn->error);
    }
}

function getTotalScheduledAppointments($conn) {
    $sql = "
        SELECT COUNT(appointment_id) AS total_scheduled
        FROM appointments
        WHERE status = 'Scheduled'
        AND isArchived = 0
    ";

    if ($result = $conn->query($sql)) {
        $row = $result->fetch_assoc();
        // Return the total number of scheduled appointments
        return $row['total_scheduled'] ?? 0;
    } else {
        // Handle potential errors
        die("Query failed: " . $conn->error);
    }
}






?>
