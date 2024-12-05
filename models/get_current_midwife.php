<?php
// Include database connection file
require_once '../partials/global_db_config.php';

function getCurrentMidwife($conn) {
    // SQL query to retrieve the active midwife
    $sql = "
        SELECT midwife.*, 
               pi.firstname, pi.middlename, pi.lastname, pi.phone_number, pi.email
        FROM midwife
        INNER JOIN personal_information AS pi ON midwife.personal_info_id = pi.personal_info_id
        WHERE midwife.employment_status = 'active'
        LIMIT 1";  // Assuming only one midwife is active at a time

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Execute the statement
    $stmt->execute();

    // Fetch the active midwife's details
    $midwife = $stmt->get_result()->fetch_assoc();

    return $midwife;
}
?>
