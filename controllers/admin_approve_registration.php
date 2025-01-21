<?php
header('Content-Type: application/json');

require '../partials/global_db_config.php';

$response = [
    'success' => false,
    'message' => 'An error occurred.',
];

try {
    // Ensure the request is POST and contains JSON
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    // Get the raw POST data and decode JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Validate the data
    if (empty($data['account_id']) || !is_numeric($data['account_id'])) {
        throw new Exception('Invalid or missing account ID.');
    }

    $accountId = (int)$data['account_id'];

    // Update the accounts table to set isValid to 1 for the given account ID
    $stmt = $conn->prepare("UPDATE accounts SET isValid = 1 WHERE account_id = ? AND isValid = 0");
    $stmt->bind_param("i", $accountId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $response['success'] = true;
        $response['message'] = 'Account approved successfully.';
    } else {
        $response['message'] = 'No changes made. The account might already be valid, rejected, or does not exist.';
    }

    $stmt->close();
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>
