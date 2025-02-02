<?php 

function getAllAddresses($conn) {
    // SQL query to retrieve all addresses
    $sql = "
        SELECT 
            a.address_id, 
            a.address_name, 
            a.address_type 
        FROM 
            address a
    ";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful and return data
    if ($result && $result->num_rows > 0) {
        $addresses = [];
        while ($row = $result->fetch_assoc()) {
            // Add the address to the addresses array
            $addresses[] = $row;
        }

        // Return the array of addresses
        return $addresses;
    } else {
        // Return an empty array if no results are found or query failed
        return [];
    }
}
?>
