<?php

// Function to retrieve the total number of residents
function getTotalResidents($conn) {
    // Query to get the total number of valid residents
    $sql = "SELECT COUNT(*) AS total_residents FROM residents";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return $data['total_residents']; // Return the total number of valid residents
    } else {
        // Handle the case where the query fails
        return 0; // Return 0 as a fallback value
    }
}


// Function to retrieve the total number of households
function getTotalHouseholds($conn) {
    // SQL query to count the total number of households
    $sql = "SELECT COUNT(*) AS total_households FROM household";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    // Check if query was successful
    if ($result) {
        // Fetch the data
        $data = mysqli_fetch_assoc($result);
        
        // Return the total number of households
        return $data['total_households'];
    } else {
        // If query fails, return 0 or handle error appropriately
        return 0;
    }
}


// Function to retrieve the total number of pregnancies
function getTotalPregnancies($conn) {
    // SQL query to count the total number of pregnancies
    $sql = "SELECT COUNT(*) AS total_pregnancies FROM pregnancy";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    // Check if the query was successful
    if ($result) {
        // Fetch the data
        $data = mysqli_fetch_assoc($result);
        
        // Return the total number of pregnancies
        return $data['total_pregnancies'];
    } else {
        // If query fails, return 0 or handle error appropriately
        return 0;
    }
}

function getFamilyCount($conn) {
    // SQL query to count the number of families
    $sql = "SELECT COUNT(*) AS family_count FROM families";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    
    // Check if query was successful
    if ($result) {
        // Fetch the result
        $row = mysqli_fetch_assoc($result);
        return $row['family_count']; // Return the family count
    } else {
        // If query fails, return false or handle the error
        return false;
    }
}


?>
