<?php

session_start();

$title = 'Prenatal List';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/pregnancies.php';

$user = getCurrentUser($conn);
$sched_id = $_GET['sched_id'];
$prenatals = getPrenatalsByScheduleId($conn, $sched_id);

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
                            <li class="breadcrumb-item"><a href="prenatals.php">Schedules</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Prenatal List</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 p-4 shadow">
                    <table id="prenatalTable" class="display text-xs text-center">
                        <thead>
                            <tr>
                                <th>Tracking Code</th>
                                <th>Resident Name</th>
                                <th>Age</th>
                                <th>Address</th>
                                <th>Due Date</th>
                                <th>Pregnancy Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($prenatals): ?>
                                <?php foreach ($prenatals as $prenatal): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prenatal['tracking_code']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['lastname'] . ' ' . $prenatal['firstname'] . ', ' . $prenatal['middlename']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['age']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['address_name']) ?> (<?= htmlspecialchars($prenatal['address_type']) ?>)</td>
                                    <td><?= htmlspecialchars(date('F j, Y', strtotime($prenatal['expected_due_date']))) ?></td>
                                    <td><?= htmlspecialchars($prenatal['pregnancy_status']) ?></td>
                                    <td>
                                        <!-- View Details Button -->
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#prenatalModal<?= $prenatal['prenatal_id'] ?>">View Details</button>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPrenatalModal<?= $prenatal['prenatal_id'] ?>">Edit</button>
                                    </td>
                                </tr>

                                <?php require 'partials/modal_view_prenatal_record.php'; ?>
                                <?php require 'partials/modal_update_prenatal_record.php'; ?>

                            <?php endforeach; ?>

                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No prenatal records found for this schedule.</td>
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
        $(document).ready(function() {
            $('#prenatalTable').DataTable();
        });
    </script>
</body>
</html>
