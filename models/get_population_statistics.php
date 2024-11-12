<?php 

function getPopulationStatistics($conn) {
    // SQL query to get the required population statistics
    $sql = "
        SELECT 
            COUNT(residents.resident_id) AS total_residents,
            address.address_name,
            SUM(CASE WHEN personal_information.sex = 'male' THEN 1 ELSE 0 END) AS total_males,
            SUM(CASE WHEN personal_information.sex = 'female' THEN 1 ELSE 0 END) AS total_females,
            SUM(CASE WHEN personal_information.date_of_birth >= DATE_SUB(CURDATE(), INTERVAL 12 YEAR) THEN 1 ELSE 0 END) AS total_children,
            SUM(CASE WHEN personal_information.date_of_birth <= DATE_SUB(CURDATE(), INTERVAL 60 YEAR) THEN 1 ELSE 0 END) AS total_seniors
        FROM 
            residents
        INNER JOIN 
            personal_information ON residents.personal_info_id = personal_information.personal_info_id
        INNER JOIN 
            address ON personal_information.address_id = address.address_id
        GROUP BY 
            address.address_name;
    ";

    // Execute the query
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    // Fetch all results
    $population_statistics = [];
    while ($row = $result->fetch_assoc()) {
        $population_statistics[] = $row;
    }

    return $population_statistics;
}

?>