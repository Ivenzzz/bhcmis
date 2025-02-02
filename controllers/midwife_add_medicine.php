<?php
// Include the database configuration file
require '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data and sanitize input
    $batch_number = $conn->real_escape_string($_POST['batch_number']);
    $name = $conn->real_escape_string($_POST['name']);
    $generic_name = $conn->real_escape_string($_POST['generic_name']);
    $dosage = $conn->real_escape_string($_POST['dosage']);
    $form = $conn->real_escape_string($_POST['form']);
    $expiry_date = $conn->real_escape_string($_POST['expiry_date']);
    $quantity_in_stock = intval($_POST['quantity_in_stock']);
    $description = $conn->real_escape_string($_POST['description']);

    try {
        // Prepare the SQL query to insert data
        $query = "INSERT INTO medicines (
                    batch_number, name, generic_name, dosage, form, expiry_date, quantity_in_stock, description
                  ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);

        // Bind parameters to the query
        $stmt->bind_param(
            'ssssssis',
            $batch_number,
            $name,
            $generic_name,
            $dosage,
            $form,
            $expiry_date,
            $quantity_in_stock,
            $description
        );

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to medicines.php with a success status
            header("Location: ../midwife/medicines.php?status=Medicine added successfully");
            exit();
        } else {
            // Redirect with an error status if the query fails
            header("Location: ../midwife/medicines.php?status=error&message=" . urlencode($stmt->error));
            exit();
        }
    } catch (Exception $e) {
        // Redirect with an error status if an exception occurs
        header("Location: ../midwife/medicines.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
