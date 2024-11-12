<?php
require '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $assigned_area = $_POST['assigned_area']; // The selected address ID
    $date_of_birth = $_POST['date_of_birth'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $occupation = $_POST['occupation'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];
    $sex = $_POST['sex'];
    $date_started = $_POST['date_started'];
    $employment_status = $_POST['employment_status'];
    $username = strtolower($firstname) . strtolower($lastname);
    $password = password_hash('defaultpassword', PASSWORD_DEFAULT); // Using PASSWORD_DEFAULT

    // Insert into personal_information table
    $insert_personal_info = "INSERT INTO personal_information (firstname, lastname, middlename, phone_number, email, date_of_birth, civil_status, educational_attainment, occupation, religion, citizenship, sex, address_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_personal_info);
    $stmt->bind_param('ssssssssssssi', $firstname, $lastname, $middlename, $phone_number, $email, $date_of_birth, $civil_status, $educational_attainment, $occupation, $religion, $citizenship, $sex, $assigned_area);
    
    if ($stmt->execute()) {
        $personal_info_id = $stmt->insert_id;
        
        // Insert into accounts table
        $insert_account = "INSERT INTO accounts (username, password, role) VALUES (?, ?, 'bhw')";
        $stmt = $conn->prepare($insert_account);
        $stmt->bind_param('ss', $username, $password);
        
        if ($stmt->execute()) {
            $account_id = $stmt->insert_id;
            
            // Insert into bhw table
            $insert_bhw = "INSERT INTO bhw (account_id, personal_info_id, assigned_area, date_started, employment_status) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_bhw);
            $stmt->bind_param('iisss', $account_id, $personal_info_id, $assigned_area, $date_started, $employment_status);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header('Location: ../../admin_bhw.php?message=success');
            } else {
                header('Location: ../../admin_bhw.php?message=error');
            }
        } else {
            header('Location: ../../admin_bhw.php?message=error_account');
        }
    } else {
        header('Location: ../../admin_bhw.php?message=error_personal_info');
    }
}
?>
