<?php

require '../partials/global_db_config.php';
require '../models/get_current_user.php';

$user = getCurrentUser($conn);
$admin = getAdminInformation($conn, $user['admin_id']);

// Check if the form is submitted with the required data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $certificate_id = $_POST['certificate_id'];
    $diagnosis = $_POST['diagnosis'];
    $remarks = $_POST['remarks'];

    // Get the current date for the issue_date
    $issue_date = date('Y-m-d H:i:s');  // Current date and time

    $admin_full_name = 'Brgy. Secretary ' . $admin['firstname'] . ' ' . $admin['lastname']; 

    // Update the medical certificate record in the database
    $sql = "UPDATE medical_certificates
            SET issue_date = ?, issued_by = ?, diagnosis = ?, status = 'Approved', remarks = ?, updated_at = ?
            WHERE certificate_id = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("sssssi", $issue_date, $admin_full_name, $diagnosis, $remarks, $issue_date, $certificate_id);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to generate the document using header() function
            header("Location: ../admin/generate_medical_certificate.php?medical_certificate_id=$certificate_id");
            exit(); // Always call exit() after header redirection to stop further script execution
        } else {
            echo "Error updating the medical certificate: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error preparing the SQL statement: " . $conn->error;
    }
} else {
    // Handle case when the form is not submitted
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
