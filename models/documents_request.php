<?php 

function getReferralRequestsByResidentId($conn, $resident_id) {
    // Prepare the SQL query
    $sql = "SELECT * FROM referral_requests WHERE resident_id = ? ORDER BY request_date";
    
    // Initialize an empty result
    $referralRequests = [];
    
    if ($stmt = $conn->prepare($sql)) {
        // Bind the resident_id parameter
        $stmt->bind_param("i", $resident_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Get the result set
            $result = $stmt->get_result();
            
            // Fetch all rows as an associative array
            $referralRequests = $result->fetch_all(MYSQLI_ASSOC);
        } else {
            // Log the error if query execution fails
            error_log("Error executing query: " . $stmt->error);
        }
        
        // Close the statement
        $stmt->close();
    } else {
        // Log the error if statement preparation fails
        error_log("Error preparing statement: " . $conn->error);
    }
    
    // Return the result
    return $referralRequests;
}

function getAllReferralRequests($conn) {
    // SQL query to retrieve all referral requests, joining with residents and personal_information tables
    $sql = "SELECT rr.*,
                   r.resident_id,
                   pi.lastname, pi.firstname, pi.middlename
            FROM referral_requests rr
            JOIN residents r ON rr.resident_id = r.resident_id
            JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id
            ORDER BY rr.request_date DESC"; // You can adjust the order as per your needs

    // Execute the query
    if ($result = $conn->query($sql)) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            $referralRequests = [];
            while ($row = $result->fetch_assoc()) {
                $referralRequests[] = $row; // Store each row in an array
            }
            return $referralRequests; // Return the array of referral requests
        } else {
            return []; // No records found
        }
    } else {
        // If there was an error with the query
        die("Error retrieving referral requests: " . $conn->error);
    }
}




?>