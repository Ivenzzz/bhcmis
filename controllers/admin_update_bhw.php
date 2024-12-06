<?php

require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $bhw_id = isset($_POST['bhw_id']) ? intval($_POST['bhw_id']) : null;
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : null;
    $middlename = isset($_POST['middlename']) ? trim($_POST['middlename']) : null;
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : null;
    $assigned_area = isset($_POST['assigned_area']) ? intval($_POST['assigned_area']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : null;
    $employment_status = isset($_POST['employment_status']) ? trim($_POST['employment_status']) : null;
    $date_started = isset($_POST['date_started']) ? trim($_POST['date_started']) : null;

    // Validate required fields
    if (!$bhw_id || !$firstname || !$lastname || !$assigned_area || !$employment_status || !$date_started) {
        header('Location: ../admin/bhws.php?error=All required fields must be filled out.');
        exit;
    }

    // Begin database transaction
    $conn->begin_transaction();

    try {
        // Update personal information
        $updatePersonalInfoQuery = "UPDATE personal_information SET 
            firstname = ?, 
            middlename = ?, 
            lastname = ?, 
            email = ?, 
            phone_number = ? 
            WHERE personal_info_id = (SELECT personal_info_id FROM bhw WHERE bhw_id = ?);";

        $stmtPersonalInfo = $conn->prepare($updatePersonalInfoQuery);
        if (!$stmtPersonalInfo) {
            throw new Exception('Error preparing personal info query: ' . $conn->error);
        }

        $stmtPersonalInfo->bind_param('sssssi', $firstname, $middlename, $lastname, $email, $phone_number, $bhw_id);
        $stmtPersonalInfo->execute();

        // Update BHW information
        $updateBHWQuery = "UPDATE bhw SET 
            assigned_area = ?, 
            employment_status = ?, 
            date_started = ? 
            WHERE bhw_id = ?;";

        $stmtBHW = $conn->prepare($updateBHWQuery);
        if (!$stmtBHW) {
            throw new Exception('Error preparing BHW query: ' . $conn->error);
        }

        $stmtBHW->bind_param('issi', $assigned_area, $employment_status, $date_started, $bhw_id);
        $stmtBHW->execute();

        // Commit the transaction
        $conn->commit();
        header('Location: ../admin/bhws.php?success=Barangay Health Worker updated successfully.');

    } catch (Exception $e) {
        // Roll back the transaction on error
        $conn->rollback();
        header('Location: ../admin/bhws.php?error=Failed to update Barangay Health Worker: ' . $e->getMessage());
    } finally {
        if (isset($stmtPersonalInfo)) {
            $stmtPersonalInfo->close();
        }
        if (isset($stmtBHW)) {
            $stmtBHW->close();
        }
    }
} else {
    header('Location: ../admin/bhws.php?error=Invalid request method.');
    exit;
}
