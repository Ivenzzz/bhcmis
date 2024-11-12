<?php

function getResidentById($conn, $residentId) {
    $sql = "SELECT 
                a.*, 
                r.*, 
                pi.*
            FROM 
                residents r
            JOIN 
                personal_information pi ON r.personal_info_id = pi.personal_info_id
            JOIN 
                accounts a ON r.account_id = a.account_id
            WHERE 
                r.resident_id = ?";
    
    // Prepare the SQL statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the resident ID to the prepared statement
        $stmt->bind_param("i", $residentId);
        
        // Execute the query
        $stmt->execute();
        
        // Get the result
        $result = $stmt->get_result();
        
        // Fetch the resident details as an associative array
        $residentDetails = $result->fetch_assoc();
        
        // Return the result
        return $residentDetails;
    } else {
        // Handle error in preparing statement
        return null;
    }
}
?>
