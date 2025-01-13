<?php
// Include necessary files and establish database connection
require '../partials/global_db_config.php';

// Check if the required POST parameters are set
if (isset($_POST['resident_id'], $_POST['purpose'])) {
    // Retrieve POST data
    $resident_id = $_POST['resident_id'];
    $purpose = $_POST['purpose'];

    // Prepare the SQL query to insert the new referral request
    $sql = "INSERT INTO referral_requests (resident_id, purpose) 
            VALUES (?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the query
        $stmt->bind_param("is", $resident_id, $purpose);

        // Execute the query
        if ($stmt->execute()) {
            // Return success message
            echo json_encode(['success' => true, 'message' => 'Referral request submitted successfully.']);
        } else {
            // If query execution fails, return error message
            echo json_encode(['success' => false, 'message' => 'Failed to insert referral request.']);
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If query preparation fails, return error message
        echo json_encode(['success' => false, 'message' => 'Failed to prepare SQL statement.']);
    }
} else {
    // If required POST parameters are missing, return error message
    echo json_encode(['success' => false, 'message' => 'Missing required fields.']);
}

// Close the database connection
$conn->close();
?>
