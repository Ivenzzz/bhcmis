<?php 

function getTotalResidents($conn) {
    $sql = "SELECT COUNT(*) AS total_residents 
            FROM personal_information 
            WHERE isArchived = 0 AND isTransferred = 0 AND isAlive = 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_residents'];
    } else {
        return 0;
    }
}

function getTotalHouseholds($conn) {
    $sql = "SELECT COUNT(*) AS total_households FROM household";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_households'];
    } else {
        return 0;
    }
}

function getTotalFamilies($conn) {
    $sql = "SELECT COUNT(*) AS total_families FROM families";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['total_families'];
    } else {
        return 0;
    }
}

function getTotalTransferredResidents($conn) {
    // SQL query to count residents who are transferred
    $sql = "SELECT COUNT(*) AS total_transferred
            FROM personal_information
            WHERE isTransferred = 1";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of transferred residents
        return $row['total_transferred'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

function getTotalDeceasedResidents($conn) {
    // SQL query to count residents who are not alive
    $sql = "SELECT COUNT(*) AS total_deceased
            FROM personal_information
            WHERE isAlive = 0";

    // Execute the query
    $result = $conn->query($sql);

    // Check if the query was successful
    if ($result && $row = $result->fetch_assoc()) {
        // Return the count of deceased residents
        return $row['total_deceased'];
    } else {
        // Return 0 if query failed or no data found
        return 0;
    }
}

?>