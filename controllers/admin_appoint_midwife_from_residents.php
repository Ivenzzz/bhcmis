<?php
header("Content-Type: application/json");

require '../partials/global_db_config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from the POST request
    $residentId = $_POST["resident_id"] ?? null;
    $residentName = $_POST["resident_name"] ?? null;
    $personalInfoId = $_POST["personal_info_id"] ?? null;
    $midwifeUsername = $_POST["midwife_username"] ?? null;
    $midwifePassword = $_POST["midwife_password"] ?? null;

    if (!$residentId || !$residentName || !$personalInfoId || !$midwifeUsername || !$midwifePassword) {
        echo json_encode(["success" => false, "error" => "Missing required fields."]);
        exit;
    }

    // Start transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // 1. Insert into the accounts table for midwife role
        $hashedPassword = password_hash($midwifePassword, PASSWORD_DEFAULT);
        $insertAccountQuery = "
            INSERT INTO accounts (username, password, role)
            VALUES (?, ?, 'midwife')
        ";
        $stmt = $conn->prepare($insertAccountQuery);
        $stmt->bind_param("ss", $midwifeUsername, $hashedPassword);
        $stmt->execute();

        // Get the inserted account's ID
        $accountId = $stmt->insert_id;
        $stmt->close();

        // 2. Insert into the midwife table
        $insertMidwifeQuery = "
            INSERT INTO midwife (account_id, personal_info_id, employment_status)
            VALUES (?, ?, 'active')
        ";
        $stmt = $conn->prepare($insertMidwifeQuery);
        $stmt->bind_param("ii", $accountId, $personalInfoId);
        $stmt->execute();
        $midwifeId = $stmt->insert_id; // Get midwife ID
        $stmt->close();

        // Commit the transaction
        $conn->commit();

        // Return success response
        echo json_encode(["success" => true, "midwife_id" => $midwifeId]);

    } catch (Exception $e) {
        // Rollback transaction in case of any error
        $conn->rollback();
        echo json_encode(["success" => false, "error" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method."]);
}

// Close connection
$conn->close();
?>
