<?php
// Database configuration
require '../partials/global_db_config.php';

// Get the input data from the POST request
$inputData = json_decode(file_get_contents('php://input'), true);
$consultationDate = $inputData['date']; // The consultation date
$consultationDetails = $inputData['details']; // The consultation details

// Ensure that the received data is valid
if (empty($consultationDate) || empty($consultationDetails)) {
    echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    exit;
}

// Prepare the SQL query to insert the new consultation schedule
$stmt = $conn->prepare("INSERT INTO consultation_schedules (con_sched_date, isArchived, created_at, updated_at) VALUES (?, 0, CURRENT_TIMESTAMP(), CURRENT_TIMESTAMP())");
$stmt->bind_param("s", $consultationDate); // "s" means the type is string (for datetime)

if ($stmt->execute()) {
    // Successfully inserted the new consultation schedule
    $response = ['success' => true, 'message' => 'Consultation scheduled successfully'];
} else {
    // Failed to insert the new consultation schedule
    $response = ['success' => false, 'message' => 'Error scheduling consultation'];
}

// Close the database connection
$stmt->close();
$conn->close();

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
