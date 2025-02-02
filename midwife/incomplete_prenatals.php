<?php

session_start();

$title = 'Incomplete Prenatals';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/pregnancies.php';

$user = getCurrentUser($conn);
$sched_id = $_GET['sched_id'];
$incomplete_prenatals = getCancelledAppointments($conn, $sched_id);

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
                            <li class="breadcrumb-item"><a href="prenatals.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Incomplete Prenatals</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <a href="prenatals_list.php?sched_id=<?= $sched_id ?>" class="btn btn-secondary btn-sm">Completed Prenatals</a>
                    <a href="scheduled_prenatals.php?sched_id=<?= $sched_id ?>" class="btn btn-secondary btn-sm">Scheduled Prenatals</a>
                    <a href="incomplete_prenatals.php?sched_id=<?= $sched_id ?>" class="btn btn-primary btn-sm">Incomplete Prenatals</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="incompletePrenatalsTable" class="display text-sm text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Priority Number</th>
                                <th class="text-center">Resident Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Notes</th>
                                <th class="text-center">Date Cancelled</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($incomplete_prenatals as $prenatal): ?>
                                <tr>
                                    <td><?= htmlspecialchars($prenatal['priority_number']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['lastname'] . ', ' . $prenatal['firstname'] . ' ' . $prenatal['middlename']); ?></td>
                                    <td class="text-danger"><?= ucfirst(htmlspecialchars($prenatal['status'])) ?></td>
                                    <td><?= htmlspecialchars($prenatal['notes']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['updated_at']) ?></td>
                                </tr>
                            <?php endforeach; ?>
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
            $('#incompletePrenatalsTable').DataTable();
        });
    </script>
</body>
</html>
