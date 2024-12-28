<?php

// Start session
session_start();

// Include database configuration and functions
require '../partials/global_db_config.php';

// Get the form data
$resident_id = $_POST['resident_id'];
$consultation_schedule_id = $_POST['con_sched_id'];

// Fetch the latest priority number for the given consultation schedule
$query = "SELECT MAX(priority_number) AS latest_priority_number FROM appointments WHERE sched_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $consultation_schedule_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$latest_priority_number = $row['latest_priority_number'];

// Calculate the next priority number
$next_priority_number = $latest_priority_number + 1;

// Generate a 16-character alphanumeric tracking code
$tracking_code = strtoupper(bin2hex(random_bytes(8))); // Generates 16 alphanumeric characters

// Set default status as 'Completed'
$status = 'Scheduled';

// Insert the new appointment into the database
$insert_query = "INSERT INTO appointments (tracking_code, resident_id, sched_id, priority_number, status) 
                 VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($insert_query);
$stmt->bind_param("siiss", $tracking_code, $resident_id, $consultation_schedule_id, $next_priority_number, $status);

if ($stmt->execute()) {
    // Redirect back to the appointments page or wherever you want
    header('Location: ../midwife/appointments.php?con_sched_id=' . $consultation_schedule_id);
    exit();
} else {
    // Handle error if insertion fails
    echo "Error: " . $stmt->error;
}

?>
