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
        $status = 'success'; // Append success status
    } else {
        $status = 'error'; // Append error status
    }

    // Redirect with household_id and status as URL parameters
    header("Location: ../bhw/families.php?household_id=" . urlencode($household_id) . "&update_family=" . $status);
    
    // Close the statement
    $stmt->close();
} else {
    // Redirect if accessed without POST
    header("Location: ../bhw/families.php");
}

// Close the MySQLi connection
$conn->close();
?>

