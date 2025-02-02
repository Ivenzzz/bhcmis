<?php
function getAllVaccines($conn) {
    try {
        // Query to fetch all vaccines with an added condition to check expiration status
        $query = "
            SELECT 
                vaccine_id, 
                vaccine_name, 
                lot_number, 
                stocks,
                expiration_date,
                CASE 
                    WHEN expiration_date < CURDATE() THEN 'Expired' 
                    ELSE 'Valid' 
                END AS status
            FROM vaccines
            ORDER BY vaccine_id DESC
        ";

        // Prepare the query
        $stmt = $conn->prepare($query);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        // Execute the query
        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // Get the result
        $result = $stmt->get_result();

        // Fetch all rows
        $vaccines = [];
        while ($row = $result->fetch_assoc()) {
            $vaccines[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Return the list of vaccines
        return $vaccines;

    } catch (Exception $e) {
        // Return error message if there's an issue
        return ["error" => $e->getMessage()];
    }
}
?>
