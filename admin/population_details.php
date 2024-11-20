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

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card text-center p-3 shadow">
                        <div class="card-body">
                            <i class="fa-solid fa-users fa-2x mb-3 text-sky-500"></i>
                            <h5 class="card-title display-6"><?= $totalResidents; ?></h5>
                            <p class="card-text poppins-light">Current Residents</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3 shadow">
                        <div class="card-body">
                            <i class="fa-solid fa-person-walking-luggage fa-2x mb-3 text-orange-500"></i>
                            <h5 class="card-title display-6"><?= $transferredResidents; ?></h5>
                            <p class="card-text poppins-light">Transferred</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center p-3 shadow">
                        <div class="card-body">
                            <i class="fa-regular fa-face-dizzy fa-2x mb-3 text-red-500"></i>
                            <h5 class="card-title display-6"><?= $deceasedResidents; ?></h5>
                            <p class="card-text poppins-light">Deceased</p> 
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <h3 class="text-center mb-4 poppins-extralight">Population Growth Rate</h3>
                <div class="col-md-8 shadow">
                    <canvas id="populationChart"></canvas>
                </div>
                <div class="col-md-4">
                    <div id="growthDetails" class="h-100 d-flex justify-content-center align-items-center rounded-circle bg-amber-500">
                        <p id="growthRateLabel" class="text-slate-800"></p>
                    </div>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <h3 class="text-center mb-3 poppins-extralight">Population Trend Per Year</h3>
                <div class="col-md-12 p-2">
                    <canvas id="populationLineChart" class="shadow"></canvas>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/population_details_charts.js"></script>
    <script>

</script>
</body>
</html>
