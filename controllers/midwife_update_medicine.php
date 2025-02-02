<?php

require '../partials/global_db_config.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $medicine_id = intval($_POST['medicine_id']);
    $batch_number = htmlspecialchars(trim($_POST['batch_number']));
    $name = htmlspecialchars(trim($_POST['name']));
    $generic_name = htmlspecialchars(trim($_POST['generic_name']));
    $dosage = htmlspecialchars(trim($_POST['dosage']));
    $form = htmlspecialchars(trim($_POST['form']));
    $expiry_date = htmlspecialchars(trim($_POST['expiry_date']));
    $quantity_in_stock = intval($_POST['quantity_in_stock']);
    $description = htmlspecialchars(trim($_POST['description']));

    // Validate the required fields
    if (empty($medicine_id) || empty($batch_number) || empty($name) || empty($dosage) || empty($form)) {
        // Redirect with an error message as a URL parameter
        header('Location: ../midwife/medicines.php?error=Required fields are missing.');
        exit();
    }

    try {
        // Prepare the SQL statement for updating the medicine
        $sql = "UPDATE medicines
                SET batch_number = ?, name = ?, generic_name = ?, dosage = ?, form = ?, expiry_date = ?, 
                    quantity_in_stock = ?, description = ?, updated_at = NOW()
                WHERE medicine_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'ssssssisi',
            $batch_number,
            $name,
            $generic_name,
            $dosage,
            $form,
            $expiry_date,
            $quantity_in_stock,
            $description,
            $medicine_id
        );

        // Execute the query
        if ($stmt->execute()) {
            // Redirect with a success message as a URL parameter
            header('Location: ../midwife/medicines.php?success=Medicine updated successfully.');
        } else {
            // Redirect with an error message as a URL parameter
            header('Location: ../midwife/medicines.php?error=Failed to update the medicine. Please try again.');
        }
    } catch (Exception $e) {
        // Handle exceptions and redirect with an error message
        $error_message = urlencode('An error occurred: ' . $e->getMessage());
        header("Location: ../midwife/medicines.php?error=$error_message");
    }
} else {
    // If the request method is not POST, redirect with an error message
    header('Location: ../midwife/medicines.php?error=Invalid request method.');
    exit();
}
?>
