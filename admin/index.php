<?php

session_start();

$title = 'Admin Dashboard';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$totalResidents = getTotalResidents($conn);
$totalHouseholds = getTotalHouseholds($conn);
$totalFamilies = getTotalFamilies($conn);
$transferredResidents = getTotalTransferredResidents($conn);
$deceasedResidents = getTotalDeceasedResidents($conn);
$yearly_population = getYearlyPopulationInfo($conn);

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
                    <li class="breadcrumb-item active" aria-current="page">Overview</li>
                </ol>
            </nav>    

            <div class="row">
                <div class="col-md-4 mb-2">
                    <div class="card text-center p-3 shadow bg-sky-100">
                        <div class="card-body">
                            <i class="fa-solid fa-users fa-2x mb-3 text-sky-500"></i>
                            <h5 class="card-title display-6"><?= $totalResidents; ?></h5>
                            <p class="card-text poppins-light">Population</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card text-center p-3 shadow bg-green-100">
                        <div class="card-body">
                            <i class="fa-solid fa-house-chimney-user fa-2x mb-3 text-green-500"></i>
                            <h5 class="card-title display-6"><?= $totalHouseholds; ?></h5>
                            <p class="card-text poppins-light">Total Households</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="card text-center p-3 shadow bg-indigo-100">
                        <div class="card-body">
                            <i class="fa-solid fa-people-roof fa-2x mb-3 text-indigo-500"></i>
                            <h5 class="card-title display-6"><?= $totalFamilies; ?></h5>
                            <p class="card-text poppins-light">Total Families</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 p-4">
                <div class="col-md-6 mb-2">
                    <div class="card text-center p-3 shadow">
                        <div class="card-body">
                            <i class="fa-solid fa-person-walking-luggage fa-2x mb-3 text-orange-500"></i>
                            <h5 class="card-title display-6"><?= $transferredResidents; ?></h5>
                            <p class="card-text poppins-light">Transferred</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
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
                <div class="col-md-5 p-2">
                    <h5 class="text-center mb-3 poppins-extralight">Population Per Year</h5>
                    <canvas id="populationLineChart"></canvas>
                </div>
                <div class="col-md-7 p-2 shadow">
                    <h5 class="text-center mb-3 poppins-extralight">
                        Population per Area ( <?php echo date("Y"); ?> )
                    </h5>
                    <canvas id="populationPerAreaChart"></canvas>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-12 p-2">
                    <h5 class="text-center mb-4 poppins-extralight">Yearly Population</h5>
                    <table id="yearlyPopulationTable" class="table table-bordered table-striped table-sm text-center">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Total Population</th>
                                <th>Total Males</th>
                                <th>Total Females</th>
                                <th>Deceased Count</th>
                                <th>Transferred Count</th>
                                <th>Growth Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($yearly_population)): ?>
                                <?php foreach ($yearly_population as $record): ?>
                                    <tr>
                                        <td><?php echo $record['year']; ?></td>
                                        <td><?php echo number_format($record['total_population']); ?></td>
                                        <td><?php echo number_format($record['total_males']); ?></td>
                                        <td><?php echo number_format($record['total_females']); ?></td>
                                        <td><?php echo number_format($record['deceased_count']); ?></td>
                                        <td><?php echo number_format($record['transferred_count']); ?></td>
                                        <td><?php echo number_format($record['growth_rate'], 2) . '%'; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">No population records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-5 p-2 shadow">
                    <h5 class="text-center poppins-extralight">Age Distribution</h5>
                    <canvas id="ageDistributionChart"></canvas>
                </div>
                <div class="col-md-7 p-2">
                    <h5 class="text-center poppins-extralight">Gender Distribution</h5>
                    <canvas id="genderDistributionChart"></canvas>
                </div>
            </div>

            <div class="row mb-4 d-flex justify-content-center">
                <div class="col-md-6 p-3 shadow">
                    <h5 class="text-center poppins-extralight">Top 5 Diseases/Medical Conditions</h5>
                    <canvas id="diseasesChart"></canvas>
                </div>
            </div>


            <div class="row mb-4 p-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary me-2">Save</button>
                    <a href="print_population_details.php" target="_blank"><button class="btn btn-success">Print Population Info</button></a>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_population_analytics.js"></script>
    <script>
    
</script>

</body>
</html>
