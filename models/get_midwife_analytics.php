<?php

function getTotalAppointments($conn) {
    // Prepare the SQL query to count the total number of appointments
    $sql = "SELECT COUNT(*) AS total_appointments FROM appointments";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();

        // Return the total number of appointments
        return $row['total_appointments'];
    } else {
        // Return 0 if there are no appointments or the query failed
        return 0;
    }
}

function getTotalConsultations($conn) {
    // SQL query to count the total number of consultations
    $sql = "SELECT COUNT(*) AS total_consultations FROM consultations";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the result row
        $row = $result->fetch_assoc();
        
        // Return the total number of consultations
        return $row['total_consultations'];
    } else {
        // If no results, return 0
        return 0;
    }
}

function getScheduledAppointments($conn) {
    // SQL query to count the total number of appointments with 'Scheduled' status
    $sql = "SELECT COUNT(*) AS scheduled_appointments 
            FROM appointments 
            WHERE status = 'Scheduled'";
    
    // Execute the query
    $result = $conn->query($sql);
    
    // Check if the query was successful
    if ($result && $result->num_rows > 0) {
        // Fetch the result row
        $row = $result->fetch_assoc();
        
        // Return the total number of scheduled appointments
        return $row['scheduled_appointments'];
    } else {
        // If no results, return 0
        return 0;
    }
}

function getPrenatalSchedules($conn) {
    // SQL query to retrieve all prenatal schedules
    $sql = "SELECT * FROM `prenatal_schedules`";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Execute the statement
    if ($stmt->execute()) {
        // Fetch all results as an associative array
        $result = $stmt->get_result();
        $schedules = $result->fetch_all(MYSQLI_ASSOC);
        
        // Return the array of schedules
        return $schedules;
    } else {
        // Handle error if the query fails
        return [];
    }
}

function getAppointmentStats($conn) {
    // SQL query to count appointments by their status
    $sql = "
        SELECT 
            status, COUNT(*) as count 
        FROM 
            appointments 
        GROUP BY 
            status
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Initialize an array to hold the counts for each status
    $appointmentStats = [
        'Scheduled' => 0,
        'Cancelled' => 0,
        'Completed' => 0
    ];

    // Fetch the results and assign the counts to the respective statuses
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Update the count for each status
            $appointmentStats[$row['status']] = $row['count'];
        }
    }

    // Return the array with the appointment statistics
    return $appointmentStats;
}

?>
