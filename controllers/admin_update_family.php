<?php
// Start session
session_start();

require '../partials/global_db_config.php';

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $family_id = intval($_POST['family_id']);
    $household_id = intval($_POST['household_id']);  // Get the household_id from the POST request
    $fourPsMember = isset($_POST['4PsMember']) ? 1 : 0;  // Checkbox value: 1 if checked, 0 if not

    // Prepare an SQL statement to update the 4Ps status
    $stmt = $conn->prepare(
        "UPDATE families SET 4PsMember = ? WHERE family_id = ?"
    );

    // Bind parameters to the SQL statement
    $stmt->bind_param('ii', $fourPsMember, $family_id);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Redirect with a success message and append household_id to the URL
        $_SESSION['success'] = "4Ps status updated successfully.";
        header("Location: ../admin/families.php?household_id=" . urlencode($household_id)); // Redirect with household_id as a URL parameter
    } else {
        // Log or handle error
        $_SESSION['error'] = "Error updating 4Ps status: " . $stmt->error;
        header("Location: ../admin/families.php?household_id=" . urlencode($household_id)); // Redirect with household_id on error
    }

    // Close the statement
    $stmt->close();
} else {
    // Redirect if accessed without POST
    header("Location: ../admin/families.php");
}

// Close the MySQLi connection
$conn->close();
?>
