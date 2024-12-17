<?php
header('Content-Type: application/json'); // Response will be in JSON format

require '../partials/global_db_config.php'; // Include database configuration

try {
    // Query to count medicines grouped by expiry status, excluding archived medicines
    $query = "SELECT 
                  CASE
                      WHEN expiry_date <= CURDATE() THEN 'Expired'
                      WHEN expiry_date <= DATE_ADD(CURDATE(), INTERVAL 1 MONTH) THEN 'Expiring'
                      ELSE 'Valid'
                  END AS expiry_status,
                  COUNT(*) AS count
              FROM medicines
              WHERE isArchived = 0
              GROUP BY expiry_status";

    $result = $conn->query($query);

    if ($result) {
        $data = [];

        // Fetch results into an associative array
        while ($row = $result->fetch_assoc()) {
            $data[] = [
                'expiry_status' => $row['expiry_status'],
                'count' => (int)$row['count'] // Cast count to integer
            ];
        }

        // Send a successful JSON response
        echo json_encode(['success' => true, 'data' => $data]);
    } else {
        // Send an error response if the query fails
        echo json_encode(['success' => false, 'message' => 'Failed to fetch medicine count by expiry status.']);
    }
} catch (Exception $e) {
    // Handle unexpected exceptions
    echo json_encode(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()]);
}

$conn->close(); // Close the database connection
?>
