<?php

require '../../../config/db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input data
    $batch_number = htmlspecialchars(trim($_POST['batch_number']));
    $name = htmlspecialchars(trim($_POST['name']));
    $generic_name = isset($_POST['generic_name']) ? htmlspecialchars(trim($_POST['generic_name'])) : null;
    $dosage = htmlspecialchars(trim($_POST['dosage']));
    $form = htmlspecialchars(trim($_POST['form']));
    $expiry_date = !empty($_POST['expiry_date']) ? htmlspecialchars(trim($_POST['expiry_date'])) : null;
    $quantity_in_stock = htmlspecialchars(trim($_POST['quantity_in_stock']));
    $description = isset($_POST['description']) ? htmlspecialchars(trim($_POST['description'])) : null;

    // SQL query to insert a new medicine record
    $sql = "INSERT INTO medicines (batch_number, name, generic_name, dosage, form, expiry_date, quantity_in_stock, description) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare and execute the query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param(
            "ssssssis", 
            $batch_number, 
            $name, 
            $generic_name, 
            $dosage, 
            $form, 
            $expiry_date, 
            $quantity_in_stock, 
            $description
        );

        if ($stmt->execute()) {
            // Redirect with success message
            header("Location: /bhcmis/midwife-medicines?add_medicine_status=success");
            exit();
        } else {
            // Redirect with error message
            header("Location: /bhcmis/midwife-medicines?add_medicine_status=error");
            exit();
        }

        // Close statement
        $stmt->close();
    } else {
        // Redirect with error message for query preparation failure
        header("Location: /bhcmis/midwife-medicines?add_medicine_status=error");
        exit();
    }
}

// Close the database connection
$conn->close();
