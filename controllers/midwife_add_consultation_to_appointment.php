<?php
session_start();

require '../partials/global_db_config.php';

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $appointment_id = $_POST['appointment_id'];
    $resident_id = $_POST['resident_id'];
    $con_sched_id = $_POST['con_sched_id'];
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

    // Insert the consultation into the database
    $sql = "INSERT INTO consultations 
            (resident_id, appointment_id, reason_for_visit, sched_id, symptoms, weight_kg, temperature, heart_rate, 
            respiratory_rate, blood_pressure, cholesterol_level, physical_findings, refer_to)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssssssssss", $resident_id, $appointment_id, $reason_for_visit, $con_sched_id, 
        $symptoms, $weight_kg, $temperature, $heart_rate, $respiratory_rate, $blood_pressure, $cholesterol_level, 
        $physical_findings, $refer_to);
    
    if ($stmt->execute()) {
        // If the consultation was added successfully, update the appointment status to 'Completed'
        $update_sql = "UPDATE appointments SET status = 'Completed' WHERE appointment_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("i", $appointment_id);
        $update_stmt->execute();

        // Redirect or show success message
        header("Location: ../midwife/appointments.php?con_sched_id=" . $con_sched_id); // Redirect to the appointment list page
        exit();
    } else {
        // Error inserting consultation
        echo "Error: " . $stmt->error;
    }
}
?>
