<?php
session_start();
require '../partials/global_db_config.php';
require '../models/get_account_by_username.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $rememberMe = isset($_POST['remember']) && $_POST['remember'] === 'true';
    
    $result = getAccountByUsername($conn, $username);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            // Store user session data
            $_SESSION['username'] = $username;
            $_SESSION['account_id'] = $user['account_id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['logged_in'] = true;

            // Set specific role-related IDs in session
            $_SESSION['bhw_id'] = $user['bhw_id'] ?? null;
            $_SESSION['midwife_id'] = $user['midwife_id'] ?? null;
            $_SESSION['admin_id'] = $user['admin_id'] ?? null;
            $_SESSION['resident_id'] = $user['resident_id'] ?? null;

            // Set cookies only if Remember Me is checked
            if ($rememberMe) {
                setcookie('username', $username, time() + (86400 * 30), "/"); 
                setcookie('password', $password, time() + (86400 * 30), "/"); 
            } else {
                // If "Remember Me" is unchecked, ensure cookies are cleared
                setcookie('username', '', time() - 3600, "/"); // Expire the cookie
                setcookie('password', '', time() - 3600, "/"); // Expire the cookie
            }
            
            $response = ['status' => 'success', 'role' => $user['role']];
            echo json_encode($response);
        } else {
            $response = ['status' => 'error', 'message' => 'Invalid username or password.'];
            echo json_encode($response);
        }
    } else {
        $response = ['status' => 'error', 'message' => 'No user found with that username.'];
        echo json_encode($response);
    }
} else {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
}
