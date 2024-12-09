<?php

session_start();

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';
require '../models/addresses.php';

$current_bhw_id = $_SESSION['bhw_id'];
$user = getCurrentUser($conn);
$assigned_area = getAssignedArea($conn);
$households = getHouseholdsByBhwId($conn, $current_bhw_id);
$addresses = getAllAddresses($conn);
$title = 'Household Records of ' . $assigned_area['assigned_area_name'];

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
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Households of <?php echo $assigned_area['assigned_area_name']?></li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12 shadow p-4">
                    <table id="householdsTable" class="display table-sm text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Household No.</th>
                                <th class="text-center">Year Resided</th>
                                <th class="text-center">Number of Families</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($households as $household): ?>
                                <tr>
                                    <td><?= htmlspecialchars($household['household_id']) ?></td>
                                    <td><?= htmlspecialchars($household['year_resided']) ?></td>
                                    <td><?= htmlspecialchars($household['number_of_families']) ?></td>
                                    <td class="d-flex justify-content-center">
                                        <a href="families.php?household_id=<?= urlencode($household['household_id']) ?>" class="btn btn-info btn-sm me-2">Families</a>
                                        <button class="btn btn-transparent btn-sm me-2" data-bs-toggle="modal" data-bs-target="#infoHouseholdModal<?php echo htmlspecialchars($household['household_id']); ?>">
                                            <i class="fa-solid fa-circle-info text-slate-700"></i>
                                        </button>
                                        <button class="btn btn-transparent btn-sm me-2" data-bs-toggle="modal" data-bs-target="#editHouseholdModal<?php echo htmlspecialchars($household['household_id']); ?>"><i class="fa-solid fa-pen text-amber-500"></i></button>
                                        <button class="btn btn-transparent btn-sm me-2 delete-btn" data-id="<?= htmlspecialchars($household['household_id']); ?>">
                                            <i class="fa-regular fa-trash-can text-red-500"></i>
                                        </button>
                                    </td>
                                </tr>

                                <?php require 'partials/update_household_modal.php'; ?>
                                <?php require 'partials/household_info_modal.php'; ?>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHouseholdModal">Add Household</button>
                </div>
            </div>

        </div>
  </div>

    <?php require 'partials/add_household_modal.php'; ?>
    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/bhw_household_records.js"></script>
</body>
</html>
