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

    try {
        $conn->begin_transaction();

        // Check if personal information already exists
        $query = "SELECT personal_info_id FROM personal_information WHERE lastname = ? AND firstname = ? AND middlename = ? AND date_of_birth = ? AND address_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssss', $lastname, $firstname, $middlename, $date_of_birth, $address_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $personal_info = $result->fetch_assoc();
            $personal_info_id = $personal_info['personal_info_id'];

            // Create an account for the resident
            $query = "INSERT INTO accounts (username, password, role, isValid) VALUES (?, ?, 'residents', 0)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ss', $username, $password);
            $stmt->execute();
            $account_id = $conn->insert_id;

            // Link the account to the existing personal_information record
            $query = "INSERT INTO residents (account_id, personal_info_id) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('ii', $account_id, $personal_info_id);
            $stmt->execute();

            $conn->commit();
            $response['success'] = true;
            $response['message'] = 'You have been sucessfully registered.';
        } else {
            // No match found, do not insert new personal information
            $response['success'] = false;
            $response['message'] = 'No matching records. Only the bonafide residents of Barangay Punta Mesa can register.';
            $conn->rollback();
        }
    } catch (Exception $e) {
        $conn->rollback();
        $response['success'] = false;
        $response['message'] = 'Error: ' . $e->getMessage();
    }

    echo json_encode($response);
}
?>
