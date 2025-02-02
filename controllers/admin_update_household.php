<?php
// Start session
session_start();

require '../partials/global_db_config.php';

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $household_id = intval($_POST['household_id']);
    $address_id = intval($_POST['address_id']);
    $year_resided = intval($_POST['year_resided']);
    $housing_type = $conn->real_escape_string($_POST['housing_type']);
    $water_source = $conn->real_escape_string($_POST['water_source']);
    $toilet_facility = $conn->real_escape_string($_POST['toilet_facility']);

    // Prepare an SQL statement
    $stmt = $conn->prepare(
        "UPDATE household 
        SET address_id = ?, year_resided = ?, housing_type = ?, 
            water_source = ?, toilet_facility = ?
        WHERE household_id = ?"
    );

    // Bind parameters to the SQL statement
    $stmt->bind_param(
        'iisssi',
        $address_id,
        $year_resided,
        $housing_type,
        $water_source,
        $toilet_facility,
        $household_id
    );

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect with a success message
        $_SESSION['success'] = "Household updated successfully.";
        header("Location: ../admin/households.php");
    } else {
        // Log or handle error
        $_SESSION['error'] = "Error updating household: " . $stmt->error;
        header("Location: ../admin/households.php");
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect if accessed without POST
    header("Location: ../admin/households.php");
}

// Close the MySQLi connection
$conn->close();
?>
