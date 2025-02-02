<?php
// Include database configuration file
require_once '../partials/global_db_config.php'; // Make sure to configure the connection to the database

// Set header for JSON response
header('Content-Type: application/json');

// Create a function to fetch consultation count by month
function getConsultationCountByMonth($conn) {
    // SQL query to get the count of consultations by month
    $sql = "
        SELECT 
            YEAR(created_at) AS year,
            MONTH(created_at) AS month,
            COUNT(*) AS consultation_count
        FROM consultations
        WHERE isArchived = 0
        GROUP BY YEAR(created_at), MONTH(created_at)
        ORDER BY year ASC, month ASC;
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result) {
        $consultationCounts = [];
        while ($row = $result->fetch_assoc()) {
            $consultationCounts[] = $row;
        }
        return $consultationCounts;
    } else {
        return ['error' => 'Query failed: ' . $conn->error];
    }
}


// Call the function to get the consultation count by month
$consultationCounts = getConsultationCountByMonth($conn);

// Close the database connection
$conn->close();

// Output the results as JSON
echo json_encode($consultationCounts);
?>
