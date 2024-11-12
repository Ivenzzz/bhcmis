<?php

session_start();

require '../partials/global_db_config.php';

$title = 'Admin Dashboard';

require '../models/get_admin_analytics.php';
require '../models/get_current_user.php';

$total_residents = getTotalResidents($conn); 
$total_households = getTotalHouseholds($conn); 
$total_pregnancies = getTotalPregnancies($conn);
$total_families = getFamilyCount($conn);
$user = getCurrentUser($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/admin.css">
</head>
<body id="body-pd">
    <?php require 'partials/top_navigation.php'; ?>
    <?php require 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="/bhcmis/admin">Statistics</a></li>
            </ol>
        </nav>

        <div class="row justify-content-center">

            <!-- Card for Total Number of Residents -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                <div class="card w-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                    <div class="card-content">
                        <img src="../public/images/person-team.svg" alt="" width="50" height="50" class="mb-2">
                        <div class="card-info">
                            <h2 class="text-center mb-1"><?= $total_residents ?></h2>
                            <h5 class="text-center fw-light">Population</h5>
                        </div>
                        <a href="/bhcmis/population-breakdown" class="btn btn-sm mt-2">
                            View More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card for Total Number of Households -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                <div class="card w-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                    <div class="card-content">
                        <img src="../public/images/house-solid.svg" alt="" width="50" height="50" class="mb-2">
                        <div class="card-info">
                            <h2 class="text-center mb-1"><?= $total_households ?></h2>
                            <h5 class="text-center fw-light">Total Households</h5>
                        </div>
                        <a href="households-statistics.php" class="btn btn-sm mt-2">
                            View More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card for Total Number of Families -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 p-3">
                <div class="card w-100 d-flex justify-content-center align-items-center text-center p-3 shadow">
                    <div class="card-content">
                        <img src="../public/images/family.svg" alt="" width="50" height="50" class="mb-2">
                        <div class="card-info">
                            <h2 class="text-center mb-1"><?= $total_families ?></h2>
                            <h5 class="text-center fw-light">Families</h5>
                        </div>
                        <a href="families-statistics.php" class="btn btn-sm mt-2">
                            View More <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>

