<?php
// Start session
session_start();

require '../partials/global_db_config.php'; // Assuming database connection is in this file

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and retrieve form inputs
    $household_id = intval($_POST['household_id']);
    $parent_family = isset($_POST['parent_family']) && $_POST['parent_family'] !== '' ? intval($_POST['parent_family']) : null;
    $fourPsMember = isset($_POST['4PsMember']) ? 1 : 0;  // Checkbox value: 1 if checked, 0 if not

    // Step 1: Insert into the 'families' table
    $stmt = $conn->prepare(
        "INSERT INTO families (parent_family_id, 4PsMember) 
        VALUES (?, ?)"
    );

    // Bind parameters to the SQL statement
    $stmt->bind_param('ii', $parent_family, $fourPsMember);

    // Execute the SQL statement
    if ($stmt->execute()) {
        // Get the last inserted family_id
        $family_id = $stmt->insert_id;

        // Step 2: Insert into the 'household_members' table
        $stmt2 = $conn->prepare(
            "INSERT INTO household_members (household_id, family_id) 
            VALUES (?, ?)"
        );

        // Bind parameters to the second SQL statement
        $stmt2->bind_param('ii', $household_id, $family_id);

        // Execute the second SQL statement
        if ($stmt2->execute()) {
            // If both inserts are successful, redirect with success message
            header("Location: ../bhw/families.php?household_id=" . urlencode($household_id) . "&status=success");
        } else {
            // Handle error in household_members insertion
            header("Location: ../bhw/families.php?household_id=" . urlencode($household_id) . "&status=error");
        }

        // Close the second statement
        $stmt2->close();
    } else {
        // Handle error in families insertion
        header("Location: ../bhw/families.php?household_id=" . urlencode($household_id) . "&status=error");
    }

    // Close the first statement
    $stmt->close();
} else {
    // Redirect if accessed without POST
    header("Location: ../bhw/families.php");
}

// Close the MySQLi connection
$conn->close();
?>
