<?php
// Start session to manage access control if needed
session_start();

// Include database connection and other necessary files
require '../partials/global_db_config.php';

// Check if the request is made with the schedule ID to delete
if (isset($_POST['sched_id'])) {
    $sched_id = intval($_POST['sched_id']);   // Ensure it's an integer

    // Prepare SQL query to set isArchived to 1 (archive the schedule)
    $sql = "UPDATE prenatal_schedules SET isArchived = 1 WHERE sched_id = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $sched_id);
        
        // Execute the query and check if it's successful
        if ($stmt->execute()) {
            // Redirect to the page with success message or status
            header('Location: ../midwife/prenatals.php?result=Prenatal_schedule_archived_successfully');
            exit;
        } else {
            echo "Error archiving schedule.";
        }
        
        $stmt->close();
    } else {
        echo "Error preparing the query.";
    }
} else {
    echo "No schedule ID provided.";
}
?>
