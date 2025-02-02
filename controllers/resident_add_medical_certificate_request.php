<?php
// Include database connection and other necessary files
require '../partials/global_db_config.php'; // Include database connection

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Get the resident's ID (this should come from the session or user context)
$resident_id = isset($data['resident_id']) ? $data['resident_id'] : null; // Assuming resident_id is passed

// Get the 'other_receiver' data
$other_receiver = isset($data['other_receiver']) && !empty($data['other_receiver']) ? $data['other_receiver'] : NULL;

// Get the purpose
$purpose = isset($data['purpose']) ? $data['purpose'] : '';

// Ensure that resident_id is provided (otherwise exit or handle as needed)
if (is_null($resident_id)) {
    echo json_encode(['message' => 'Resident ID is missing.']);
    exit; // Stop execution if resident_id is not provided
}

// SQL query to insert the medical certificate request
$sql = "INSERT INTO medical_certificates (resident_id, other_receivers, purpose) 
        VALUES (?, ?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind the parameters
// Bind 'resident_id' as integer, 'other_receiver' as integer (which could be NULL), and 'purpose' as string
$stmt->bind_param("iis", $resident_id, $other_receiver, $purpose);

// Execute the query
if ($stmt->execute()) {
    // Respond with a success message
    echo json_encode(['message' => 'Medical certificate request submitted successfully. Please wait 24 hours for the health workers to issue the document.']);
} else {
    // Respond with an error message
    echo json_encode(['message' => 'Failed to submit the request. Please try again later.']);
}

// Close the statement and the database connection
$stmt->close();
$conn->close();
?>
