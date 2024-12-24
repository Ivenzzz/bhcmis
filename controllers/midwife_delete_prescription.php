<?php
require '../partials/global_db_config.php';

// Check if the form was submitted and medication_id is provided
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['medication_id'])) {
    $medication_id = $_POST['medication_id'];
    $consultation_id = $_POST['consultation_id'];
    $con_sched_id = $_POST['con_sched_id'];

    // Prepare SQL query to delete the prescription
    $sql = "DELETE FROM consultations_prescriptions WHERE medication_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind the medication_id parameter to the query
        $stmt->bind_param("i", $medication_id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect back to the prescriptions page with success message
            header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=success&message=Prescription%20deleted%20successfully!");
            exit;
        } else {
            // Redirect with error message if the deletion fails
            header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Error deleting prescription: " . $stmt->error));
            exit;
        }

        $stmt->close();
    } else {
        // Redirect with error message if the query preparation fails
        header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Error preparing the query: " . $conn->error));
        exit;
    }
}
?>
