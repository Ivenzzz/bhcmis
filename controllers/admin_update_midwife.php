<?php
// Include database connection file
require_once '../partials/global_db_config.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $midwife_id = $_POST['midwife_id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $employment_status = $_POST['employment_status'];
    $employment_date = $_POST['employment_date'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $civil_status = $_POST['civil_status'];

    try {
        // Start transaction
        $conn->begin_transaction();

        // Update personal_information table
        $updatePersonalInfoSQL = "
            UPDATE personal_information
            SET 
                firstname = ?, 
                middlename = ?, 
                lastname = ?, 
                phone_number = ?, 
                email = ?, 
                civil_status = ?, 
                updated_at = NOW()
            WHERE personal_info_id = (
                SELECT personal_info_id FROM midwife WHERE midwife_id = ?
            )
        ";
        
        $stmtPersonalInfo = $conn->prepare($updatePersonalInfoSQL);
        $stmtPersonalInfo->bind_param(
            'ssssssi',
            $firstname,
            $middlename,
            $lastname,
            $phone_number,
            $email,
            $civil_status,
            $midwife_id
        );
        $stmtPersonalInfo->execute();
        $stmtPersonalInfo->close();

        // Update midwife table
        $updateMidwifeSQL = "
            UPDATE midwife
            SET 
                employment_status = ?, 
                employment_date = ?
            WHERE midwife_id = ?
        ";

        $stmtMidwife = $conn->prepare($updateMidwifeSQL);
        $stmtMidwife->bind_param(
            'ssi',
            $employment_status,
            $employment_date,
            $midwife_id
        );
        $stmtMidwife->execute();
        $stmtMidwife->close();

        // Commit transaction
        $conn->commit();

        // Redirect back with success message
        header('Location: ../admin/midwife.php?update=success');
        exit();
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        error_log("Update Error: " . $e->getMessage());

        // Redirect back with error message
        header('Location: ../admin/midwife.php?update=error');
        exit();
    }
} else {
    // Redirect back if accessed without POST
    header('Location: ../admin/midwife.php');
    exit();
}
