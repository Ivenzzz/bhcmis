<?php
session_start();

header('Content-Type: application/json'); // Response will be in JSON format

require '../partials/global_db_config.php'; // Include database configuration

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if 'medicine_id' is provided
    if (isset($_POST['medicine_id']) && !empty($_POST['medicine_id'])) {
        $medicine_id = intval($_POST['medicine_id']); // Sanitize the ID as integer

        // Prepare the query to set isArchived = 1
        $query = "UPDATE medicines SET isArchived = 1 WHERE medicine_id = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // Bind the parameter
            $stmt->bind_param("i", $medicine_id); // 'i' indicates an integer parameter

            // Execute the query
            if ($stmt->execute()) {
                // Check if any row was updated
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['success' => true, 'message' => 'Medicine archived successfully.']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'No matching medicine found or already archived.']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to archive the medicine.']);
            }
            $stmt->close();
        } else {
            // If statement preparation fails
            echo json_encode(['success' => false, 'message' => 'Failed to prepare the query.']);
        }
    } else {
        // If medicine_id is missing
        echo json_encode(['success' => false, 'message' => 'Medicine ID is required.']);
    }
} else {
    // If the request method is not POST
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

$conn->close(); // Close the database connection
?>

