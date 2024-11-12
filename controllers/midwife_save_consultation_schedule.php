<?php
// Start the session
session_start();

// Include your database configuration file
require '../../../config/db_config.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted form data
    $consultationDate = $_POST['consultationDate'];
    $consultationTime = $_POST['consultationTime'];

    // Validate inputs
    if (!empty($consultationDate) && !empty($consultationTime)) {
        // Combine date and time into a single datetime string
        $consultationDateTime = $consultationDate . ' ' . $consultationTime;

        // Prepare an SQL statement to insert the consultation schedule into the `consultation_schedules` table
        $stmt = $conn->prepare("INSERT INTO consultation_schedules (con_sched_date) VALUES (?)");
        
        // Bind the parameter (date and time)
        $stmt->bind_param('s', $consultationDateTime);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            // Redirect to appointments page after successful insertion
            header('Location: /bhcmis/midwife-appointments');
            exit;
        } else {
            // Handle failure to insert the consultation schedule
            echo "Error: Could not save the consultation schedule.";
            header('Location: /bhcmis/midwife-appointments');
            exit;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle case where inputs are missing
        echo "Error: Consultation date and time are required!";
        exit;
    }
}

// Close the database connection
$conn->close();
?>
