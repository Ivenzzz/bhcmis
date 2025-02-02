<?php 

session_start();

$title = 'Print Population Details';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/population_analytics.php';

$user = getCurrentUser($conn);
$totalResidents = getTotalResidents($conn);
$transferredResidents = getTotalTransferredResidents($conn);
$deceasedResidents = getTotalDeceasedResidents($conn);
$populationPerArea = getPopulationPerArea($conn);
$genderDistribution = getGenderDistribution($conn);
$populationGrowthRate = getPopulationGrowthRate($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <div class="container-fluid px-5 py-3">
        <div class="row mb-4">
            <div class="col-md-12 d-flex align-items-center">
                <img src="../public/images/punta_mesa_logo.png" alt="Logo" class="mr-4 mw-px-100 print_logo">
                <div>
                    <h4 class="mb-0">Republic of the Philippines</h4>
                    <p class="mb-0 poppins-light">Barangay Punta Mesa, Municipality of Manapla</p>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Title</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Population Report for <?php echo date("Y"); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">  
            <div class="col-md-6 p-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Total Residents</strong></td>
                            <td><?php echo number_format($totalResidents); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Transferred</strong></td>
                            <td><?php echo number_format($transferredResidents); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Deceased</strong></td>
                            <td><?php echo number_format($deceasedResidents); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Male</strong></td>
                            <td><?php echo number_format($genderDistribution['male']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Total Female</strong></td>
                            <td><?php echo number_format($genderDistribution['female']); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Population Growth Rate</strong></td>
                            <td><?php echo number_format($populationGrowthRate['growth_rate'], 2) . '%'; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-6 p-4">
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Address Area</th>
                            <th>Population Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalPopulation = 0; // Variable to keep track of the total population
                        if (!empty($populationPerArea)) {
                            foreach ($populationPerArea as $area) {
                                $totalPopulation += $area['population_count']; // Add the population of the current area to the total
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($area['address_name']); ?></td>
                                <td><?php echo number_format($area['population_count']); ?></td>
                            </tr>
                        <?php 
                            }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total Population</strong></td>
                            <td><strong><?php echo number_format($totalPopulation); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>
