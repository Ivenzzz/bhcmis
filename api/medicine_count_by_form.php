<?php
header('Content-Type: application/json'); // Response will be in JSON format

require '../partials/global_db_config.php';

// Check for connection errors
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit;
}

try {
    // Query to count medicines grouped by 'form', excluding archived medicines
    $query = "SELECT form, COUNT(*) AS count 
              FROM medicines 
              WHERE isArchived = 0 
              GROUP BY form";

    // Execute the query
    $result = $conn->query($query);

    // Check if query execution is successful
    if ($result) {
        $data = [];

        // Fetch the result rows
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'form' => $row['form'],
                'count' => (int)$row['count'] // Cast count to integer
            ];
        }

        // Return the JSON response with success
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        // Handle query failure
        echo json_encode(['success' => false, 'message' => 'Failed to fetch medicine count.']);
    }
} catch (Exception $e) {
    // Handle unexpected errors
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}

// Close the database connection
$conn->close();
?>
