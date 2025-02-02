<?php
session_start();
require '../partials/global_db_config.php';

// Check if the required POST data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $appointmentId = isset($_POST['appointmentId']) ? (int)$_POST['appointmentId'] : 0;
    $route = isset($_POST['route']) ? $_POST['route'] : 'intramuscular';
    $administeredBy = isset($_POST['administeredBy']) ? $_POST['administeredBy'] : '';
    $doseNumber = isset($_POST['doseNumber']) ? (int)$_POST['doseNumber'] : 0;
    $nextDoseDue = isset($_POST['nextDoseDue']) && $_POST['nextDoseDue'] !== "NULL" ? (int)$_POST['nextDoseDue'] : null;
    $adverseReaction = isset($_POST['adverseReaction']) ? $_POST['adverseReaction'] : '';
    $vaccineId = isset($_POST['vaccine_id']) ? (int)$_POST['vaccine_id'] : 0;  // Add vaccineId field

    // Validate the input
    if ($appointmentId <= 0 || empty($administeredBy) || $vaccineId <= 0) {
        echo json_encode(['success' => false, 'message' => 'Please fill all the required fields.']);
        exit;
    }

    // Prepare the SQL query to insert the immunization record into the database
    $query = "INSERT INTO immunizations (appointment_id, route, administered_by, dose_number, next_dose_due, adverse_reaction)
              VALUES (?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        if ($nextDoseDue === null) {
            // Handle null value for nextDoseDue
            $stmt->bind_param("issdss", $appointmentId, $route, $administeredBy, $doseNumber, $nextDoseDue, $adverseReaction);
        } else {
            $stmt->bind_param("issdis", $appointmentId, $route, $administeredBy, $doseNumber, $nextDoseDue, $adverseReaction);
        }

        if ($stmt->execute()) {
            // Update the appointment status to 'Completed'
            $updateQuery = "UPDATE immunization_appointments SET status = 'Completed', updated_at = NOW() WHERE appointment_id = ?";
            if ($updateStmt = $conn->prepare($updateQuery)) {
                $updateStmt->bind_param("i", $appointmentId);
                $updateStmt->execute();
            }

            // Subtract one from the vaccine stock
            $updateVaccineStockQuery = "UPDATE vaccines SET stocks = stocks - 1 WHERE vaccine_id = ?";
            if ($updateVaccineStmt = $conn->prepare($updateVaccineStockQuery)) {
                $updateVaccineStmt->bind_param("i", $vaccineId);
                $updateVaccineStmt->execute();
            }

            echo json_encode(['success' => true, 'message' => 'Immunization record has been saved successfully. Vaccine stock has been reduced by 1']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to save immunization record. Please try again.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error. Please try again later.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
