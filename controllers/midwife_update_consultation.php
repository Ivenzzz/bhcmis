<?php

require "../partials/global_db_config.php"; 

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form values
    $consultation_id = $_POST['consultation_id'];
    $reason_for_visit = $_POST['reason_for_visit'];
    $symptoms = $_POST['symptoms'];
    $weight_kg = $_POST['weight_kg'];
    $temperature = $_POST['temperature'];
    $heart_rate = $_POST['heart_rate'];
    $respiratory_rate = $_POST['respiratory_rate'];
    $blood_pressure = $_POST['blood_pressure'];
    $cholesterol_level = $_POST['cholesterol_level'];
    $physical_findings = $_POST['physical_findings'];
    $refer_to = $_POST['refer_to'];
    $con_sched_id = $_POST['con_sched_id'];

    // Check if any required field is empty
    if (empty($consultation_id) || empty($reason_for_visit)) {
        // Redirect back with error message
        header('Location: ../views/consultation.php?error=Please+fill+in+the+required+fields!');
        exit;
    }

    // Prepare an SQL statement to update the consultation record
    $sql = "UPDATE consultations SET
                reason_for_visit = ?,
                symptoms = ?,
                weight_kg = ?,
                temperature = ?,
                heart_rate = ?,
                respiratory_rate = ?,
                blood_pressure = ?,
                cholesterol_level = ?,
                physical_findings = ?,
                refer_to = ?
            WHERE consultation_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters to the prepared statement
        $stmt->bind_param(
            'ssssssssssi', 
            $reason_for_visit, 
            $symptoms, 
            $weight_kg, 
            $temperature, 
            $heart_rate, 
            $respiratory_rate, 
            $blood_pressure, 
            $cholesterol_level, 
            $physical_findings, 
            $refer_to, 
            $consultation_id
        );

        // Execute the statement
        if ($stmt->execute()) {
            // On success, redirect to the consultation details page with con_sched_id as a URL parameter
            header("Location: ../midwife/consultation_details.php?con_sched_id={$con_sched_id}&success=Consultation+updated+successfully!");
        } else {
            // If something goes wrong, show an error message
            header("Location: ../midwife/consultation_details.php?con_sched_id={$con_sched_id}&error=Failed+to+update+consultation.+Please+try+again.");
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // If prepared statement fails
        header("Location: ../midwife/consultation_details.php?con_sched_id={$con_sched_id}&error=Database+error!+Please+try+again+later.");
    }

    // Close the database connection
    $conn->close();
} else {
    // If the form is not submitted correctly, redirect back to consultation page
    header("Location: ../midwife/consultation_details.php?con_sched_id={$con_sched_id}&error=Invalid+request.");
}
?>
