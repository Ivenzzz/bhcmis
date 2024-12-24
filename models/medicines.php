<?php 

function getMedicines($conn) {
    // SQL query to retrieve all medicines with expiry status
    $query = "
        SELECT 
            medicine_id,
            batch_number,
            name,
            generic_name,
            dosage,
            form,
            expiry_date,
            quantity_in_stock,
            description,
            isArchived,
            created_at,
            updated_at,
            CASE 
                WHEN expiry_date <= CURDATE() THEN 'Expired'
                WHEN expiry_date <= DATE_ADD(CURDATE(), INTERVAL 1 MONTH) THEN 'Expiring'
                ELSE 'Valid'
            END AS expiry_status
        FROM 
            medicines
        WHERE 
            isArchived = 0
        ORDER BY 
            created_at DESC
    ";

    // Execute the query
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch all results as an associative array
        $medicines = [];
        while ($row = $result->fetch_assoc()) {
            $medicines[] = $row;
        }
        return $medicines;
    } else {
        return []; // Return an empty array if no medicines are found
    }
}

?>
