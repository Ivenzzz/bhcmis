<?php
// Include database connection (replace with your actual connection file)
include('../partials/global_db_config.php');

// Check if household_id is provided
if (isset($_POST['household_id'])) {
    $householdId = $_POST['household_id'];

    // Prepare the SQL query to update the isArchived field
    $query = "UPDATE household SET isArchived = 1 WHERE household_id = ?";

    if ($stmt = $conn->prepare($query)) {
        // Bind the household_id parameter to the SQL query
        $stmt->bind_param("i", $householdId);

        // Execute the query
        if ($stmt->execute()) {
            // Return success response
            echo json_encode(['success' => true, 'message' => 'Household archived successfully.']);
        } else {
            // Return error response if the query fails
            echo json_encode(['success' => false, 'message' => 'Failed to archive household.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Return error if the statement could not be prepared
        echo json_encode(['success' => false, 'message' => 'Database error.']);
    }

    // Close the database connection
    $conn->close();
} else {
    // Return error if household_id is not set
    echo json_encode(['success' => false, 'message' => 'Household ID not provided.']);
}
?>
