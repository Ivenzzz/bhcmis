<?php

session_start();

date_default_timezone_set('Asia/Manila');

$title = 'Population ' . date('F d, Y');

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$area_stats = getPerAreaStats($conn);

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
                    <li class="breadcrumb-item active" aria-current="page">Population Table</li>
                </ol>
            </nav> 
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <a href="index.php" class="btn btn-sm btn-secondary">Overview</a>
                    <a href="index_table_view.php" class="btn btn-sm btn-primary">Population Table</a>
                    <a href="clinical_info.php" class="btn btn-sm btn-secondary">Clinical Info</a>
                </div>
            </div>
                
            <div class="row mb-4">
                <div class="col-md-12 shadow p-4">
                    <h4 class="poppins-bold text-center mb-4">Population as of <?= date('F d, Y') ?></h4>
                    <?php require 'partials/table_population.php'; ?>
                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_index_table_view.js"></script>
</body>
</html>
