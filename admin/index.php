<?php
session_start();

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$title = 'Admin Dashboard';
$user = getCurrentUser($conn);
$totalResidents = getTotalResidents($conn);
$totalHouseholds = getTotalHouseholds($conn);
$totalFamilies = getTotalFamilies($conn);

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
                </ol>
            </nav>    

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card text-center p-3 shadow bg-sky-100">
                        <div class="card-body">
                            <i class="fa-solid fa-users fa-2x mb-3 text-sky-500"></i>
                            <h5 class="card-title display-6"><?= $totalResidents; ?></h5>
                            <p class="card-text poppins-light">Population</p>
                            <a href="population_details.php" class="btn btn-outline-primary mt-3">
                                See Details <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center p-3 shadow bg-green-100">
                        <div class="card-body">
                            <i class="fa-solid fa-house-chimney-user fa-2x mb-3 text-green-500"></i>
                            <h5 class="card-title display-6"><?= $totalHouseholds; ?></h5>
                            <p class="card-text poppins-light">Total Households</p>
                            <a href="household_details.php" class="btn btn-outline-success mt-3">
                                See Details <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card text-center p-3 shadow bg-indigo-100">
                        <div class="card-body">
                            <i class="fa-solid fa-people-roof fa-2x mb-3 text-indigo-500"></i>
                            <h5 class="card-title display-6"><?= $totalFamilies; ?></h5>
                            <p class="card-text poppins-light">Total Families</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                        
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
