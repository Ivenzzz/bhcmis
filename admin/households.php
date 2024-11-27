<?php

session_start();

$title = 'Households';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';

$user = getCurrentUser($conn);
$households = getAllHouseholds($conn);

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

        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Households</li>
                    </ol>
                </nav>
            </div>
        </div>


            <div class="row mb-4">
                <div class="col-md-12 shadow">
                    <table id="householdsTable" class="table table-striped table-bordered text-center text-sm align-middle">
                        <thead>
                            <tr>
                                <th>Household Number</th>
                                <th>Address</th>
                                <th>Year Resided</th>
                                <th>Housing Type</th>
                                <th>Water Source</th>
                                <th>Toilet Facility</th>
                                <th>Number of Families</th>
                                <th>Recorded By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($households)): ?>
                                <?php foreach ($households as $household): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($household['household_id']); ?></td>
                                        <td><?php echo htmlspecialchars($household['address_name']); ?></td>
                                        <td><?php echo htmlspecialchars($household['year_resided']); ?></td>
                                        <td><?php echo htmlspecialchars($household['housing_type']); ?></td>
                                        <td><?php echo htmlspecialchars($household['water_source']); ?></td>
                                        <td><?php echo htmlspecialchars($household['toilet_facility']); ?></td>
                                        <td><?php echo htmlspecialchars($household['number_of_families']); ?></td>
                                        <td>BHW <?php echo htmlspecialchars($household['bhw_name']); ?></td>
                                        <td>
                                            <a href="families.php?household_id=<?php echo urlencode($household['household_id']); ?>" class="btn btn-success">View Families</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No households found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function () {
            $('#householdsTable').DataTable();
        });
    </script>
</body>
</html>
