<?php

function getCurrentUser($conn) {
    // Check if the session variable is set
    if (isset($_SESSION['account_id'])) {
        $account_id = $_SESSION['account_id'];

        // Prepare the SQL statement with conditional joins based on role
        $stmt = $conn->prepare("
            SELECT 
                a.account_id, 
                a.username, 
                a.role, 
                a.profile_picture, 
                a.isArchived,
                r.resident_id,
                m.midwife_id,
                b.bhw_id,
                ad.admin_id
            FROM 
                accounts a
            LEFT JOIN 
                residents r ON a.account_id = r.account_id AND a.role = 'residents'
            LEFT JOIN 
                midwife m ON a.account_id = m.account_id AND a.role = 'midwife'
            LEFT JOIN 
                bhw b ON a.account_id = b.account_id AND a.role = 'bhw'
            LEFT JOIN 
                admin ad ON a.account_id = ad.account_id AND a.role = 'admin'
            WHERE 
                a.account_id = ?
        ");

        if (!$stmt) {
            // Handle preparation error
            error_log("SQL prepare error: " . $conn->error);
            return null;
        }

        // Bind the parameter as an integer
        $stmt->bind_param("i", $account_id);

        // Execute the statement
        if (!$stmt->execute()) {
            // Handle execution error
            error_log("SQL execute error: " . $stmt->error);
            $stmt->close();
            return null;
        }

        // Get the result
        $result = $stmt->get_result();

        // Fetch the current user data
        if ($result->num_rows > 0) {
            $currentUser = $result->fetch_assoc(); // Fetch the user data
        } else {
            // Handle case when no user is found
            $currentUser = null; // No user found
        }

        // Close the statement
        $stmt->close();
        return $currentUser; // Return the current user data
    } else {
        // Handle case when session variable is not set
        return null; // User is not logged in
    }
}

?>
