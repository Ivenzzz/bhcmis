<?php

// Function to retrieve all medicines
function getAllMedicines($conn) {

    // SQL query to retrieve all medicines
    $sql = "SELECT * FROM medicines ORDER BY medicine_id DESC";
    $result = mysqli_query($conn, $sql);

    // Check if there are results
    if (mysqli_num_rows($result) > 0) {
        // Fetch all results as an associative array
        $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        // If no records found, return an empty array
        $medicines = [];
    }

    // Return the medicines array
    return $medicines;
}

?>