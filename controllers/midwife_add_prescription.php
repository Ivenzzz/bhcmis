<?php
// add_prescription.php

require '../partials/global_db_config.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $consultation_id = $_POST['consultation_id'];
    $con_sched_id = $_POST['con_sched_id']; 
    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];
    $instructions = $_POST['instructions'];

    // Check current stock of the medicine
    $sql = "SELECT quantity_in_stock FROM medicines WHERE medicine_id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $medicine_id);
        $stmt->execute();
        $stmt->bind_result($current_stock);
        $stmt->fetch();
        $stmt->close();

        // Check if there is enough stock
        if ($current_stock >= $quantity) {
            // Proceed to insert prescription into the consultations_prescriptions table
            $sql = "INSERT INTO consultations_prescriptions (consultation_id, medicine_id, quantity, instructions) 
                    VALUES (?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                // Bind the parameters to the query
                $stmt->bind_param("iiis", $consultation_id, $medicine_id, $quantity, $instructions);

                // Execute the query
                if ($stmt->execute()) {
                    // Update the stock in the medicines table
                    $sql_update_stock = "UPDATE medicines SET quantity_in_stock = quantity_in_stock - ? WHERE medicine_id = ?";
                    if ($stmt_update = $conn->prepare($sql_update_stock)) {
                        $stmt_update->bind_param("ii", $quantity, $medicine_id);
                        $stmt_update->execute();
                        $stmt_update->close();
                    }

                    // Redirect to the prescriptions page with success message and consultation_id, con_sched_id as URL params
                    header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=success&message=Prescription%20added%20successfully!");
                    exit;
                } else {
                    // Redirect with error message if the insert fails
                    header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Error adding prescription: " . $stmt->error));
                    exit;
                }

                $stmt->close();
            } else {
                // Redirect with error message if the query preparation fails
                header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Error preparing the query: " . $conn->error));
                exit;
            }
        } else {
            // Not enough stock available
            header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Not enough stock available for this medicine"));
            exit;
        }
    } else {
        // Redirect with error message if fetching stock fails
        header("Location: ../midwife/prescriptions.php?consultation_id=" . $consultation_id . "&con_sched_id=" . $con_sched_id . "&status=error&message=" . urlencode("Error fetching medicine stock: " . $conn->error));
        exit;
    }
}
?>
