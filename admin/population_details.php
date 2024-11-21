<?php

session_start();

$title = 'Population Details';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';


$user = getCurrentUser($conn);
$totalResidents = getTotalResidents($conn);
$transferredResidents = getTotalTransferredResidents($conn);
$deceasedResidents = getTotalDeceasedResidents($conn);

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

            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Overview</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Population Details</li>
                </ol>
            </nav>

            

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/population_details_charts.js"></script>

</body>
</html>
