<?php

require './../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get values from the POST request
    $bhw_id = $_POST['bhw_id'];
    $account_id = $_POST['account_id'];
    $personal_info_id = $_POST['personal_info_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $sex = $_POST['sex'];
    $assigned_area = $_POST['assigned_area'];
    $employment_status = $_POST['employment_status'];
    $date_started = $_POST['date_started'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];

    // Check if the assigned area is already taken by another BHW
    $sql_check_area = "SELECT bhw_id FROM bhw WHERE assigned_area = ? AND bhw_id != ?";
    $stmt_check_area = $conn->prepare($sql_check_area);
    $stmt_check_area->bind_param('ii', $assigned_area, $bhw_id);
    $stmt_check_area->execute();
    $stmt_check_area->store_result();

    // If a BHW with the same area is found, return an error
    if ($stmt_check_area->num_rows > 0) {
        // Redirect with error message
        header("Location: /bhcmis/admin-bhws?error=assigned_area_taken");
        exit();
    }

    // Update `personal_information` table
    $sql_personal_info = "UPDATE personal_information 
                          SET firstname = ?, lastname = ?, middlename = ?, date_of_birth = ?, civil_status = ?, 
                              educational_attainment = ?, occupation = ?, religion = ?, citizenship = ?, 
                              sex = ?, phone_number = ?, email = ?, updated_at = NOW()
                          WHERE personal_info_id = ?";

    $stmt_personal_info = $conn->prepare($sql_personal_info);
    $stmt_personal_info->bind_param('ssssssssssssi', $firstname, $lastname, $middlename, $date_of_birth, $civil_status,
                                     $educational_attainment, $occupation, $religion, $citizenship, $sex,
                                     $phone_number, $email, $personal_info_id);

    if ($stmt_personal_info->execute()) {
        // Update `bhw` table with assigned area and employment information
        $sql_bhw = "UPDATE bhw SET assigned_area = ?, employment_status = ?, date_started = ? WHERE bhw_id = ?";
        $stmt_bhw = $conn->prepare($sql_bhw);
        $stmt_bhw->bind_param('issi', $assigned_area, $employment_status, $date_started, $bhw_id);

        if ($stmt_bhw->execute()) {
            // Redirect with success message
            header("Location: /bhcmis/admin-bhws?update_success=true");
            exit();
        } else {
            // Redirect with error related to the BHW area update
            header("Location: /bhcmis/admin-bhws?error=bhw_area_update_failed");
            exit();
        }
    } else {
        // Redirect with error related to personal information update
        header("Location: /bhcmis/admin-bhws?error=personal_info_update_failed");
        exit();
    }
}
?>
