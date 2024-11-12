<?php

require './../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $account_id = $_POST['account_id'];
    $personal_info_id = $_POST['personal_info_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $phone_number = $_POST['phone_number'];
    $employment_status = $_POST['employment_status'];
    $employment_date = $_POST['employment_date'];
    $license_number = $_POST['license_number'];
    
    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profile_picture = $_FILES['profile_picture']['name'];
        
        // Absolute path to the root directory + relative path to the uploads folder
        $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/bhcmis/storage/uploads/";
        $target_file = $target_dir . basename($profile_picture);

        // Move the uploaded file to the server
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            // Successfully uploaded
            // Store the relative path to the uploaded file in the database
            $profile_picture = "/bhcmis/storage/uploads/" . basename($profile_picture);
        } else {
            // Failed to upload
            $profile_picture = null;
        }
    } else {
        // Keep the existing profile picture
        $profile_picture = $_POST['existing_profile_picture'];
    }


    // Start a transaction
    $conn->begin_transaction();

    try {
        // Update the `accounts` table
        $updateAccountSQL = "UPDATE accounts 
                             SET username = ?, profile_picture = ? 
                             WHERE account_id = ?";
        $stmt = $conn->prepare($updateAccountSQL);
        $stmt->bind_param("ssi", $username, $profile_picture, $account_id);
        $stmt->execute();
        
        // Update the `personal_information` table
        $updatePersonalInfoSQL = "UPDATE personal_information 
                                  SET lastname = ?, firstname = ?, middlename = ?, 
                                      date_of_birth = ?, civil_status = ?, 
                                      educational_attainment = ?, occupation = ?, 
                                      religion = ?, citizenship = ?, phone_number = ?, email = ? 
                                  WHERE personal_info_id = ?";
        $stmt = $conn->prepare($updatePersonalInfoSQL);
        $stmt->bind_param("sssssssssssi", $lastname, $firstname, $middlename, $date_of_birth, 
                          $civil_status, $educational_attainment, $occupation, $religion, 
                          $citizenship, $phone_number, $email, $personal_info_id);
        $stmt->execute();

        // Update the `midwife` table
        $updateMidwifeSQL = "UPDATE midwife 
                             SET employment_status = ?, employment_date = ?, license_number = ? 
                             WHERE account_id = ?";
        $stmt = $conn->prepare($updateMidwifeSQL);
        $stmt->bind_param("sssi", $employment_status, $employment_date, $license_number, $account_id);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect with success parameter
        header('Location: /bhcmis/admin-midwife?status=success');
        exit();
        
    } catch (Exception $e) {
        // Rollback the transaction in case of an error
        $conn->rollback();
        
        // Redirect with error parameter
        header('Location: /bhcmis/admin-midwife?status=error');
        exit();
    }
}

