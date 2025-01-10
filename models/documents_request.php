<?php 

function getMedicalCertificatesByResidentId($conn, $resident_id) {
    // SQL query to fetch medical certificates by resident_id
    $sql = "SELECT * FROM medical_certificates WHERE resident_id = ? ORDER BY request_date DESC";

    // Prepare the statement
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Failed to prepare SQL statement: " . $conn->error); // Error handling
    }

    // Bind the resident_id parameter to the query
    $stmt->bind_param("i", $resident_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if any records are found
    if ($result->num_rows > 0) {
        // Fetch all medical certificates as an associative array
        $certificates = [];
        while ($row = $result->fetch_assoc()) {
            $certificates[] = $row;
        }
        // Return the array of certificates
        return $certificates;
    } else {
        // No records found, return an empty array
        return [];
    }

    // Close the statement
    $stmt->close();
}