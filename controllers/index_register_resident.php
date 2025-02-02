<?php

header('Content-Type: application/json');
require '../partials/global_db_config.php'; // Include your database connection.

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data.
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $date_of_birth = $_POST['date_of_birth'];
    $address_id = $_POST['address'];
    $email = $_POST['email'];
    $id_picture = $_FILES['id_picture']['name'];

<<<<<<< HEAD
    try {
        $conn->begin_transaction();

        // Check if personal information already exists
        $query = "SELECT personal_info_id FROM personal_information WHERE lastname = ? AND firstname = ? AND middlename = ? AND date_of_birth = ? AND address_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $lastname, $firstname, $middlename, $date_of_birth, $address_id);
=======
    // Upload ID picture with the specified path.
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/bhcmis/storage/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = 'id-resident-' . time() . '.' . pathinfo($id_picture, PATHINFO_EXTENSION);
    $upload_path = $upload_dir . $file_name;

    if (!move_uploaded_file($_FILES['id_picture']['tmp_name'], $upload_path)) {
        $response['success'] = false;
        $response['message'] = 'Error uploading file.';
        echo json_encode($response);
        exit;
    }
    $id_picture_path = '/bhcmis/storage/uploads/' . $file_name;

    try {
        $conn->begin_transaction();

        // Check if personal information exists.
        $query = "SELECT personal_info_id, id_picture, date_of_birth, email, address_id FROM personal_information WHERE lastname = ? AND firstname = ? AND middlename = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sss', $lastname, $firstname, $middlename);
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $personal_info = $result->fetch_assoc();
<<<<<<< HEAD
            $personal_info_id = $personal_info['personal_info_id'];

            // Create an account for the resident
=======

            // Validate additional fields (date of birth, email, and address)
            if (
                $personal_info['date_of_birth'] !== $date_of_birth ||
                $personal_info['email'] !== $email ||
                $personal_info['address_id'] != $address_id
            ) {
                $response['success'] = false;
                $response['message'] = 'The information you provided does not match our records. Please ensure all details are correct.';
                echo json_encode($response);
                exit;
            }

            // Update id_picture if a new one is uploaded
            if ($id_picture) {
                $old_picture_path = $_SERVER['DOCUMENT_ROOT'] . $personal_info['id_picture'];
                if (file_exists($old_picture_path) && is_file($old_picture_path)) {
                    unlink($old_picture_path); // Delete the old picture file
                }

                $query = "UPDATE personal_information SET id_picture = ? WHERE personal_info_id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('si', $id_picture_path, $personal_info['personal_info_id']);
                $stmt->execute();
            }

            // Create account with 'isValid' column set to 0
            $query = "INSERT INTO accounts (username, password, role, isValid) VALUES (?, ?, 'residents', 0)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $account_id = $conn->insert_id;

            // Link account to resident.
            $query = "INSERT INTO residents (account_id, personal_info_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $account_id, $personal_info['personal_info_id']);
            $stmt->execute();
        } else {
            // New resident.

            $query = "INSERT INTO personal_information (lastname, firstname, middlename, date_of_birth, address_id, email, id_picture) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('sssssss', $lastname, $firstname, $middlename, $date_of_birth, $address_id, $email, $id_picture_path);
            $stmt->execute();
            $personal_info_id = $conn->insert_id;

>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
            $query = "INSERT INTO accounts (username, password, role, isValid) VALUES (?, ?, 'residents', 0)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $account_id = $conn->insert_id;

<<<<<<< HEAD
            // Link the account to the existing personal_information record
=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
            $query = "INSERT INTO residents (account_id, personal_info_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $account_id, $personal_info_id);
            $stmt->execute();
<<<<<<< HEAD

            $conn->commit();
            $response['success'] = true;
            $response['message'] = 'You have been sucessfully registered.';
        } else {
            // No match found, do not insert new personal information
            $response['success'] = false;
            $response['message'] = 'No matching records. Only the bonafide residents of Barangay Punta Mesa can register.';
            $conn->rollback();
        }
=======
        }

        // Commit transaction.
        $conn->commit();
        $response['success'] = true;
        $response['message'] = 'Congratulations! Your registration was successful. Ready for login.';
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    } catch (Exception $e) {
        $conn->rollback();
        $response['success'] = false;
        $response['message'] = 'Error: ' . $e->getMessage();
    }

    echo json_encode($response);
}
<<<<<<< HEAD
=======

>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
?>
