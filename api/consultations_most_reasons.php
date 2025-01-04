<?php
// most_common_reasons.php

require '../partials/global_db_config.php';

// Set header to return JSON response
header('Content-Type: application/json');

// SQL query to fetch the most common reasons for visit
$query = "
    SELECT reason_for_visit, COUNT(*) AS reason_count
    FROM consultations
    WHERE isArchived = 0
    GROUP BY reason_for_visit
    ORDER BY reason_count DESC
    LIMIT 10;
";

// Execute the query
$result = $conn->query($query);

// Check if the query was successful
if ($result) {
    $reasons = [];
    // Fetch data and store it in an array
    while ($row = $result->fetch_assoc()) {
        $reasons[] = $row;
    }

    // Return the results as a JSON response
    echo json_encode($reasons);
} else {
    // Return an error message if the query failed
    echo json_encode(['error' => 'Failed to fetch reasons']);
}

// Close the database connection
$conn->close();
?>
