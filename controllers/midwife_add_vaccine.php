<?php
// Include database connection
require '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $vaccine_name = $_POST['vaccine_name'];
    $lot_number = $_POST['lot_number'] ?? null;
    $expiration_date = $_POST['expiration_date'] ?? null;
    $stocks = $_POST['stocks'];

    // Validate required fields
    if (empty($vaccine_name) || empty($stocks)) {
        echo json_encode(['success' => false, 'message' => 'Vaccine name and stock are required.']);
        exit;
    }

    // Prepare SQL query to insert vaccine data into the vaccines table
    $query = "INSERT INTO vaccines (vaccine_name, lot_number, expiration_date, stocks) 
              VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        // Bind parameters
        $stmt->bind_param("sssi", $vaccine_name, $lot_number, $expiration_date, $stocks);

        // Execute query
        if ($stmt->execute()) {
            // Successfully added vaccine, return success message
            echo json_encode(['success' => true, 'message' => 'Vaccine added successfully.']);
        } else {
            // Database error
            echo json_encode(['success' => false, 'message' => 'Failed to add vaccine. Please try again.']);
        }
        $stmt->close();
    } else {
        // Prepare statement failed
        echo json_encode(['success' => false, 'message' => 'Database error. Please try again later.']);
    }
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
