<?php

session_start();

// Include the database connection file
require_once '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the rmc_id from the POST data (hidden input in the form)
    if (isset($_POST['rmc_id'])) {
        $rmc_id = intval($_POST['rmc_id']); // Ensure it's an integer

        try {
            // Begin a database transaction
            $conn->begin_transaction();

            // Query to delete the entry from the 'residents_medical_condition' table
            $delete_query = "DELETE FROM residents_medical_condition WHERE rmc_id = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $rmc_id); // Bind the rmc_id parameter

            // Execute the deletion query
            if (!$stmt->execute()) {
                throw new Exception('Failed to delete medical condition.');
            }

            // Commit the transaction
            $conn->commit();

            // Redirect to the previous page or success page
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&deleted=1');
            exit();
        } catch (Exception $e) {
            // Rollback the transaction in case of any error
            $conn->rollback();

            // Redirect with an error message
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=' . urlencode($e->getMessage()));
            exit();
        }
    } else {
        // If no rmc_id is provided, redirect with an error
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '&error=No condition selected.');
        exit();
    }
} else {
    // If the request is not POST, redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>
