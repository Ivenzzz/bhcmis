<?php
require '../../../config/db_config.php';

if (isset($_POST['resident_ids'])) {
    $resident_ids_string = $_POST['resident_ids']; 
    
    // Convert the comma-separated string to an array
    $resident_ids_array = explode(',', $resident_ids_string);
    
    // Map each element to an integer
    $resident_ids = array_map('intval', $resident_ids_array);

    // Create placeholders for the prepared statement
    $resident_ids_placeholder = implode(',', array_fill(0, count($resident_ids), '?'));

    // Prepare the SQL querys
    $sql = "
        UPDATE accounts ac
        JOIN residents r ON ac.account_id = r.account_id
        SET ac.isArchived = 1
        WHERE r.resident_id IN ($resident_ids_placeholder)
    ";

    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically to the query
    $stmt->bind_param(str_repeat('i', count($resident_ids)), ...$resident_ids);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error archiving residents']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No resident IDs provided']);
}
?>

