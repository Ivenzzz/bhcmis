<?php

require '../partials/global_db_config.php';

// Check if the consultation_id and con_sched_id are passed through POST
if (isset($_POST['consultation_id']) && isset($_POST['con_sched_id'])) {
    // Retrieve consultation_id and con_sched_id
    $consultation_id = $conn->real_escape_string($_POST['consultation_id']);
    $con_sched_id = $conn->real_escape_string($_POST['con_sched_id']);

    // Update query to set isArchived = 1
    $sql = "UPDATE consultations SET isArchived = 1 WHERE consultation_id = '$consultation_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the consultation details page with a success message
        header("Location: ../midwife/consultation_details.php?con_sched_id=" . urlencode($con_sched_id) . "&status=" . urlencode('Consultation archived successfully.'));
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>

