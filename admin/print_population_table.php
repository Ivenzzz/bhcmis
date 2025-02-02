<?php

session_start();

date_default_timezone_set('Asia/Manila');

$title = 'Population ' . date('F d, Y');

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$area_stats = getPerAreaStats($conn);
$admin = getAdminInformation($conn, $_SESSION['admin_id']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
        /* Custom styles for the header */
        .header-container {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .header-logo {
            width: 80px; /* Adjust the width of the logo */
            height: auto;
            margin-right: 20px;
        }
        .header-text {
            flex: 1;
        }
        .header-text h4 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header-text p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body class="open-sans-regular">

    <div class="row mb-2 mx-auto p-5">
        <div class="col-md-12 mb-4">
            <div class="header-container">
                <!-- Logo on the left -->
                <img src="../public/images/punta_mesa_logo.png" alt="Logo" class="header-logo">
        
                <!-- Addresses on the right -->
                <div class="header-text">
                    <h4>Barangay Punta Mesa</h4>
                    <p>Municipality of Manapla, 6120</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <h4 class="poppins-bold text-center mb-4">Population as of <?= date('F d, Y') ?></h4>
            <?php require 'partials/table_population.php'; ?>
        </div>
        <div class="col-md-12">
            <p>Prepared by: Barangay Sec. <?php 
                echo $admin['firstname'] . ' ' . 
                    (!empty($admin['middlename']) ? substr($admin['middlename'], 0, 1) . '.' : '') . ' ' . 
                    $admin['lastname']; 
            ?></p>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>

    <!-- Automatically trigger print preview on page load and close on cancel -->
    <script>
        window.onload = function () {
            window.print(); // Open print preview
        };

        // Listen for the afterprint event
        window.onafterprint = function () {
            window.close(); // Close the page after printing or canceling
        };
    </script>
</body>
</html>