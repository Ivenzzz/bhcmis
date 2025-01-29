<?php

session_start();

$title = 'My Profile';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';

$user = getCurrentUser($conn);
$bhw_info = getBhwInformation($conn, $user['bhw_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">
        <?php require 'partials/header.php'; ?>        
        <div class="container mt-4 px-5">

            <!-- Bootstrap Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Overview</a></li>
                    <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                </ol>
            </nav>

            <div class="row mb-4">
                <!-- Account Information Card with Edit Button -->
                <div class="col-md-12 mb-4">
                    <?php require 'partials/card_account_information.php'; ?>
                </div>

                <!-- Personal Information Card -->
                <div class="col-md-12 mb-4">
                    <?php require 'partials/card_personal_information.php'; ?>
                </div>
            </div>

        </div>
    </div>

    

    <?php 
        require 'partials/modal_change_password.php';
        require 'partials/modal_edit_account.php';    
    ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_profile.js"></script>
</body>
</html>