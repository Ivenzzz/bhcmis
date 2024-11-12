<?php
session_start();
require '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tracking_code'])) {
    $trackingCode = $_POST['tracking_code'];

    // Prepare and execute the SQL statement to update the appointment status
    $stmt = $conn->prepare("UPDATE appointments SET status = 'Cancelled', updated_at = NOW() WHERE tracking_code = ?");

    // Bind the parameters
    $stmt->bind_param("s", $trackingCode);

    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Successfully cancelled the appointment
            header("Location: /bhcmis/r-appointments?message=Appointment cancelled successfully"); // Redirect back with success message
            exit();
        } else {
            // No rows affected, tracking code might be invalid
            header("Location: /bhcmis/r-appointments?message=Invalid tracking code or appointment not found");
            exit();
        }
    } else {
        // Error executing the statement
        header("Location: /bhcmis/r-appointments?message=Error cancelling appointment. Please try again.");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    // No tracking code provided or invalid request method
    header("Location: /bhcmis/r-appointments?message=No tracking code provided or invalid request method.");
    exit();
}
?>
