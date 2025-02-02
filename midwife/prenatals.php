<?php

session_start();

$title = 'Prenatals & Pregnancies';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/pregnancies.php';

$user = getCurrentUser($conn);
$pregnant_residents = getPregnantResidents($conn);
$prenatal_schedules = getPrenatalSchedules($conn);
$incoming_prenatals = getThisWeeksIncomingPrenatals($conn);

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
                            <li class="breadcrumb-item active" aria-current="page">Prenatals & Pregnancies</li>
                        </ol>
                    </nav>
                </div>
            </div>


            <div class="row mb-4 p-4 shadow">
                <div class="col-md-6 p-2 shadow">
                    <div id="prenatalCalendar"></div>
                </div>
                <div class="col-md-6 p-3 text-xs">
                    <div class="mb-3 d-flex justify-content-end">
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                            Add Schedule <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>                    
                    <?php require 'partials/table_prenatal_schedules.php'; ?>
                </div>
            </div>

            <div class="row mb-4 shadow p-4">
                <div class="col-md-6 shadow p-4">
                    <h4 class="poppins-light mb-4">Incoming Prenatals</h4>
                    <?php require 'partials/table_incoming_prenatals.php'; ?>
                </div>
                <div class="col-md-6 p-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="poppins-light">Pregnancies</h4>
                        <button class="btn btn-primary btn-sm">Add Pregnancy Record</button>
                    </div>
                    <table class="table table-bordered text-xs text-center" id="pregnanciesTable">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Due Date</th>
                                <th class="text-center"># of Prenatals Done</th>
                            </tr>
                        </thead>
                        <tbody class="table-primary">
                            <?php foreach ($pregnant_residents as $resident): ?>
                                <tr>
                                    <td><?= htmlspecialchars($resident['lastname'] . ', ' . $resident['firstname'] . ' ' . $resident['middlename']) ?></td>
                                    <td><?= htmlspecialchars($resident['address_name']) ?></td>
                                    <td><?= htmlspecialchars($resident['expected_due_date']) ?></td>
                                    <td><?= htmlspecialchars($resident['prenatal_count']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
  </div>

    <?php require 'partials/modal_add_prenatal_schedule.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_prenatals.js"></script>
</body>
</html>
