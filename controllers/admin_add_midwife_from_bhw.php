<?php
// Include database connection file
require_once '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $bhw_id = $_POST['bhw_id'];
    $current_midwife_id = $_POST['current_midwife_id']; // Get the current midwife ID from POST
    $employment_status = $_POST['employment_status'];  // "active" for the new midwife
    $employment_date = $_POST['employment_date'];

    // Fetch BHW's personal info ID and account ID
    $getBHWInfoSQL = "
        SELECT personal_info_id, account_id
        FROM bhw
        WHERE bhw_id = ?
    ";

    $stmt = $conn->prepare($getBHWInfoSQL);
    $stmt->bind_param('i', $bhw_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bhw = $result->fetch_assoc();

    if ($bhw) {
        $personal_info_id = $bhw['personal_info_id'];
        $account_id = $bhw['account_id'];

        // Update the current midwife's employment status to 'inactive'
        $updateOldMidwifeStatusSQL = "
            UPDATE midwife
            SET employment_status = 'inactive'
            WHERE midwife_id = ?
        ";

        $stmt = $conn->prepare($updateOldMidwifeStatusSQL);
        $stmt->bind_param('i', $current_midwife_id);
        $stmt->execute();

        // Insert new midwife record
        $insertMidwifeSQL = "
            INSERT INTO midwife (account_id, personal_info_id, employment_status, employment_date)
            VALUES (?, ?, ?, ?)
        ";

        $stmt = $conn->prepare($insertMidwifeSQL);
        $stmt->bind_param('isss', $account_id, $personal_info_id, $employment_status, $employment_date);
        $stmt->execute();

        // Redirect or show success message
        header('Location: ../admin/midwife.php?appoint=success');
        exit();
    } else {
        // Handle error if BHW is not found
        header('Location: ../admin/midwife.php?appoint=error');
        exit();
    }
} else {
    // Redirect back if accessed without POST
    header('Location: ../admin/midwife.php');
    exit();
}
