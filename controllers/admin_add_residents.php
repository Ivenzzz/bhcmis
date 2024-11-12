<?php

require '../../../config/db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $occupation = $_POST['occupation'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $sex = $_POST['sex'];
    $address_id = $_POST['address_id'];
    $civil_status = $_POST['civil_status'];
    $educational_attainment = $_POST['educational_attainment'];
    $religion = $_POST['religion'];
    $citizenship = $_POST['citizenship'];

    // Account data
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password with PASSWORD_DEFAULT
    $role = 'residents';

    // Insert into accounts table
    $stmt = $conn->prepare("INSERT INTO accounts (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    if ($stmt->execute()) {
        $account_id = $stmt->insert_id; // Get inserted account ID

        // Insert into personal_information table
        $stmt = $conn->prepare("INSERT INTO personal_information (lastname, firstname, middlename, date_of_birth, occupation, phone_number, email, sex, address_id, civil_status, educational_attainment, religion, citizenship) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $lastname, $firstname, $middlename, $date_of_birth, $occupation, $phone_number, $email, $sex, $address_id, $civil_status, $educational_attainment, $religion, $citizenship);

        if ($stmt->execute()) {
            $personal_info_id = $stmt->insert_id; // Get inserted personal info ID

            // Insert into residents table
            $stmt = $conn->prepare("INSERT INTO residents (account_id, personal_info_id, isValidResident) VALUES (?, ?, 1)");
            $stmt->bind_param("ii", $account_id, $personal_info_id);
            if ($stmt->execute()) {
                $resident_id = $stmt->insert_id; // Get the inserted resident ID

                // Fetch the newly added resident data
                $stmt = $conn->prepare("
                    SELECT 
                    r.resident_id, 
                    pi.lastname, 
                    pi.firstname, 
                    pi.middlename, 
                    pi.date_of_birth, 
                    YEAR(CURDATE()) - YEAR(pi.date_of_birth) - (DATE_FORMAT(CURDATE(), '%m%d') < DATE_FORMAT(pi.date_of_birth, '%m%d')) AS age,
                    pi.civil_status, 
                    pi.educational_attainment, 
                    pi.occupation, 
                    pi.religion, 
                    pi.citizenship, 
                    a.address_name, 
                    pi.sex, 
                    pi.phone_number, 
                    pi.email,
                    acc.username
                    FROM residents r 
                    JOIN personal_information pi ON r.personal_info_id = pi.personal_info_id 
                    JOIN address a ON pi.address_id = a.address_id 
                    JOIN accounts acc ON r.account_id = acc.account_id
                    WHERE r.resident_id = ?");
                $stmt->bind_param("i", $resident_id);
                $stmt->execute();
                $resident_data = $stmt->get_result()->fetch_assoc();

                echo json_encode([
                    'success' => true,
                    'message' => 'Resident added successfully',
                    'resident' => $resident_data // Include resident data in the response
                ]);
                exit;
            }
        }
    }
    echo json_encode(['success' => false, 'message' => 'Error inserting resident']);
}
