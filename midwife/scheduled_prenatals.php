<?php

session_start();

$title = 'Scheduled Prenatals';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/pregnancies.php';

$user = getCurrentUser($conn);
$sched_id = $_GET['sched_id'];
$prenatals = getPrenatalsByScheduleId($conn, $sched_id);
$pregnant_residents = getPregnantResidents($conn);
$scheduled_prenatals = getScheduledPrenatals($conn, $sched_id);

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
                            <li class="breadcrumb-item active" aria-current="page">Scheduled Prenatals</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <a href="prenatals_list.php?sched_id=<?= $sched_id ?>" class="btn btn-secondary btn-sm">Completed Prenatals</a>
                    <a href="scheduled_prenatals.php?sched_id=<?= $sched_id ?>" class="btn btn-primary btn-sm">Scheduled Prenatals</a>
                    <a href="incomplete_prenatals.php?sched_id=<?= $sched_id ?>" class="btn btn-secondary btn-sm">Incomplete Prenatals</a>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <table id="scheduledPrenatalsTable" class="display text-sm text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Priority Number</th>
                                <th class="text-center">Resident Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Notes</th>
                                <th class="text-center">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($scheduled_prenatals as $prenatal): ?>
                                <tr>
                                    <td><?= $prenatal['priority_number'] ?></td>
                                    <td><?= $prenatal['lastname'] . ', ' . $prenatal['firstname'] . ' ' . $prenatal['middlename']; ?></td>
                                    <td class="text-amber-500"><?= ucfirst($prenatal['status']) ?></td>
                                    <td><?= htmlspecialchars($prenatal['notes']) ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addPrenatalModal<?= $prenatal['resident_ps_id'] ?>">
                                            Set as Completed
                                        </button>
                                        <form action="../controllers/midwife_update_scheduled_prenatal_to_cancelled.php" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to mark this prenatal as incomplete?');">
                                            <input type="hidden" name="resident_ps_id" value="<?= $prenatal['resident_ps_id'] ?>">
                                            <input type="hidden" name="sched_id" value="<?= $sched_id ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Mark Incomplete</button>
                                        </form>
                                    </td>
                                </tr>

                                <?php require 'partials/modal_add_prenatal_on_scheduled.php'; ?>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_scheduled_prenatals.js"></script>
</body>
</html>
