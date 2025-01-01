<?php
// midwife_add_prenatal_schedule.php

session_start();
require '../partials/global_db_config.php';

// Check if the form was submitted with the schedule date
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['sched_date'])) {
        $sched_date = $_POST['sched_date'];  // Capture the schedule date from the form

        // Prepare SQL to insert the new schedule
        $sql = "INSERT INTO prenatal_schedules (sched_date, isArchived, created_at, updated_at) 
                VALUES (?, 0, NOW(), NOW())";  // Set isArchived to 0 (not archived)

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param('s', $sched_date);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect back to the page with success message
                header('Location: ../midwife/prenatals.php?result=Prenatal_schedule_added_successfully');
                exit;
            } else {
                echo "Error adding schedule.";
            }

            $stmt->close();
        } else {
            echo "Error preparing the query.";
        }
    } else {
        echo "No schedule date provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
