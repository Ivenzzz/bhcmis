<?php
require_once '../partials/global_db_config.php'; // Include database configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the vaccine_id is set
    if (isset($_POST['vaccine_id'])) {
        $vaccine_id = (int)$_POST['vaccine_id']; // Sanitize input

        // Prepare the SQL query to delete the vaccine
        $query = "DELETE FROM vaccines WHERE vaccine_id = ?";

        if ($stmt = $conn->prepare($query)) {
            // Bind the vaccine_id parameter
            $stmt->bind_param("i", $vaccine_id);

            // Execute the query
            if ($stmt->execute()) {
                // Redirect back to the vaccine list page with success message
                header("Location: ../midwife/immunizations.php?message=Vaccine deleted successfully");
            } else {
                // Redirect with error message if the deletion fails
                header("Location: ../midwife/immunizations.php?error=Failed to delete vaccine");
            }
            $stmt->close();
        } else {
            // If query preparation fails
            header("Location: ../midwife/immunizations.php?error=Database error");
        }
    } else {
        // If vaccine_id is not set
        header("Location: ../midwife/immunizations.php?error=Invalid vaccine");
    }
}
?>
