<?php

function getMedicineCount($conn) {
    $query = "SELECT COUNT(*) AS total_medicines FROM medicines";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total_medicines'];
    } else {
        // Handle error
        return 0; // Return 0 if there's an error
    }
}

function getMedicineCountByForm($conn) {
    // SQL query to count medicines grouped by form
    $query = "SELECT form, COUNT(*) AS total FROM medicines GROUP BY form";

    // Execute the query
    $result = mysqli_query($conn, $query);

    // Initialize an array to hold the counts
    $medicineCounts = [];

    // Check if the query was successful
    if ($result) {
        // Fetch the results as an associative array
        while ($row = mysqli_fetch_assoc($result)) {
            $medicineCounts[$row['form']] = $row['total'];
        }
    } else {
        // Handle query error
        die("Error executing query: " . mysqli_error($conn));
    }

    return $medicineCounts;
}


?>