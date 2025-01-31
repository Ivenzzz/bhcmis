<?php
// Include database connection (adjust the path as necessary)
require_once '../partials/global_db_config.php';

header('Content-Type: application/json');

// Get data from the form
$resident_id = $_POST['resident_id'];
$resident_name = $_POST['resident_name'];
$personal_info_id = $_POST['personal_info_id'];
$bhw_username = $_POST['bhw_username'];
$bhw_password = $_POST['bhw_password'];
$assigned_area = $_POST['assigned_area'];

$response = [];

try {
    // Start transaction to ensure both inserts are successful
    $conn->begin_transaction();

    // Insert new account for the BHW (Barangay Health Worker)
    $password_hash = password_hash($bhw_password, PASSWORD_BCRYPT);  // Hash the password

    $sql_account = "INSERT INTO accounts (username, password, role) VALUES (?, ?, 'bhw')";
    $stmt_account = $conn->prepare($sql_account);
    $stmt_account->bind_param('ss', $bhw_username, $password_hash);

    if ($stmt_account->execute()) {
        // Get the account_id of the newly inserted account
        $account_id = $conn->insert_id;
    } else {
        throw new Exception('Error inserting into accounts table.');
    }

    // Insert into the bhw table
    $sql_bhw = "INSERT INTO bhw (account_id, personal_info_id, assigned_area) VALUES (?, ?, ?)";
    $stmt_bhw = $conn->prepare($sql_bhw);
    $stmt_bhw->bind_param('iii', $account_id, $personal_info_id, $assigned_area);

    if ($stmt_bhw->execute()) {
        // Commit the transaction
        $conn->commit();

        // Return success response
        $response = [
            'success' => true,
            'message' => 'Barangay Health Worker successfully appointed.',
        ];
    } else {
        throw new Exception('Error inserting into bhw table.');
    }
} catch (Exception $e) {
    // Rollback transaction if something went wrong
    $conn->rollback();

    // Return error response
    $response = [
        'success' => false,
        'error' => $e->getMessage(),
    ];
}

// Return the JSON response
echo json_encode($response);
?>
