<?php
function getResidentAllergies($conn, $resident_id) {
    // SQL query to get the resident's allergies
    $sql = "
        SELECT *
        FROM allergies
        WHERE resident_id = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind the resident_id parameter
    $stmt->bind_param("i", $resident_id);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch all rows as an associative array
    $allergies = $result->fetch_all(MYSQLI_ASSOC);

    // Return the allergies data
    return $allergies;
}
?>
