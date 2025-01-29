<?php

require '../partials/global_db_config.php';

// API to retrieve account and personal information by email
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Prepared statement to prevent SQL injection
    $stmt = $conn->prepare("
        SELECT 
            a.account_id, 
            a.username, 
            a.role, 
            a.profile_picture, 
            r.resident_id, 
            r.created_at AS resident_created_at,
            p.lastname, 
            p.firstname, 
            p.middlename, 
            p.date_of_birth, 
            p.civil_status, 
            p.educational_attainment, 
            p.occupation, 
            p.religion, 
            p.citizenship, 
            p.sex, 
            p.phone_number, 
            p.email, 
            p.id_picture, 
            p.isDeceased, 
            p.deceased_date 
        FROM accounts a
        LEFT JOIN residents r ON a.account_id = r.account_id
        LEFT JOIN personal_information p ON r.personal_info_id = p.personal_info_id
        WHERE a.isArchived = 0 
        AND a.isValid = 1 
        AND p.email = ?");
    
    // Bind parameters to prevent SQL injection
    $stmt->bind_param('s', $email);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Fetch the data
        $userInfo = $result->fetch_assoc();

        // Response format
        $response = [
            'success' => true,
            'account' => [
                'account_id' => $userInfo['account_id'],
                'username' => $userInfo['username'],
                'role' => $userInfo['role'],
                'profile_picture' => $userInfo['profile_picture'],
            ],
            'personal_information' => [
                'resident_id' => $userInfo['resident_id'],
                'lastname' => $userInfo['lastname'],
                'firstname' => $userInfo['firstname'],
                'middlename' => $userInfo['middlename'],
                'date_of_birth' => $userInfo['date_of_birth'],
                'civil_status' => $userInfo['civil_status'],
                'educational_attainment' => $userInfo['educational_attainment'],
                'occupation' => $userInfo['occupation'],
                'religion' => $userInfo['religion'],
                'citizenship' => $userInfo['citizenship'],
                'sex' => $userInfo['sex'],
                'phone_number' => $userInfo['phone_number'],
                'email' => $userInfo['email'],
                'id_picture' => $userInfo['id_picture'],
                'isDeceased' => $userInfo['isDeceased'],
                'deceased_date' => $userInfo['deceased_date'],
                'created_at' => $userInfo['resident_created_at'],
            ]
        ];

        // Return response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);

    } else {
        // User not found
        header('HTTP/1.1 404 Not Found');
        echo json_encode([
            'success' => false,
            'message' => 'User not found'
        ]);
    }

    // Close the statement
    $stmt->close();
} else {
    // Invalid request
    header('HTTP/1.1 400 Bad Request');
    echo json_encode([
        'success' => false,
        'error' => 'Email is required'
    ]);
}

// Close the connection
$conn->close();
?>
