<?php

require '../partials/global_db_config.php';

// Function to sanitize input data
function sanitizeInput($data) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($data));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $scheduleDateTime = sanitizeInput($_POST['scheduleDateTime']);
    $vaccineId = sanitizeInput($_POST['vaccineSelect']);

    // Validate inputs
    if (empty($scheduleDateTime) || empty($vaccineId)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    // Prepare the SQL query to insert the new schedule
    $sql = "INSERT INTO immunization_schedules (schedule_date, vaccine_id, isArchived) 
            VALUES ('$scheduleDateTime', '$vaccineId', 0)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'Immunization schedule added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }

    // Close connection
    $conn->close();
}
?>
