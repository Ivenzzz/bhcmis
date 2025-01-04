<?php
// Include the database connection file
require_once '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if an existing condition is selected or a new condition is entered
    $existing_condition = isset($_POST['existing_condition']) ? $_POST['existing_condition'] : null;
    $new_condition = isset($_POST['new_condition']) ? $_POST['new_condition'] : null;
    $diagnosed_date = isset($_POST['diagnosed_date']) ? $_POST['diagnosed_date'] : null;

    // Check if a valid diagnosed date is provided
    if (!$diagnosed_date) {
        die("Diagnosed date is required.");
    }
    // Process the medical condition
    if ($existing_condition) {
        // Use the selected existing condition
        $condition_id = $existing_condition;
    } elseif ($new_condition) {
        // If the new condition is provided, insert it into the medical_conditions table
        $stmt = $conn->prepare("INSERT INTO medical_conditions (condition_name) VALUES (?)");
        $stmt->bind_param("s", $new_condition);
        $stmt->execute();

        // Get the ID of the newly inserted condition
        $condition_id = $stmt->insert_id;
    } else {
        die("No condition selected or entered.");
    }

    // Retrieve the resident_id from POST data
    if (!isset($_POST['resident_id']) || empty($_POST['resident_id'])) {
        die("Resident ID is required.");
    }
    $resident_id = $_POST['resident_id'];

    // Now, insert the relationship between the resident and the medical condition into the residents_medical_condition table
    $stmt = $conn->prepare("INSERT INTO residents_medical_condition (resident_id, medical_conditions_id, diagnosed_date) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $resident_id, $condition_id, $diagnosed_date);
    $stmt->execute();

    // Redirect to a success page or show a success message
    header('Location: ../admin/resident_details.php?resident_id=' . urlencode($resident_id)); // Redirect to success page after insertion
    exit();
}
?>
