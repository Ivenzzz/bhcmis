<?php
// Start session
session_start();

require '../partials/global_db_config.php'; // Database connection file

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve inputs
    $family_id = intval($_POST['family_id']);
    $household_id = intval($_POST['household_id']);

    // Prepare the SQL query to update the 'isArchived' column
    $stmt = $conn->prepare(
        "UPDATE families SET isArchived = 1 WHERE family_id = ?"
    );

    // Bind the family_id parameter
    $stmt->bind_param('i', $family_id);

    // Execute the query and check the result
    if ($stmt->execute()) {
        // If successful, return a JSON response
        echo json_encode(['success' => true]);
    } else {
        // If there is an error, return a JSON error message
        echo json_encode(['success' => false, 'message' => 'Failed to archive the family.']);
    }

    // Close the statement
    $stmt->close();
} else {
    // If not accessed via POST, return an error
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the database connection
$conn->close();
?>
