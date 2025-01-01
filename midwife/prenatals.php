<?php

session_start();

$title = 'Prenatals';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/pregnancies.php';

$user = getCurrentUser($conn);
$pregnant_residents = getPregnantResidents($conn);
$prenatal_schedules = getPrenatalSchedules($conn);

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
                            <li class="breadcrumb-item active" aria-current="page">Prenatal Schedules</li>
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
                    <table id="prenatalSchedulesTable" class="display text-xs text-center">
                        <thead>
                            <tr>
                                <th class="text-center">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($prenatal_schedules as $schedule): ?>
                                <tr>
                                    <td><?= htmlspecialchars(date('F j, Y, g:i A', strtotime($schedule['sched_date']))) ?></td>
                                    <td>
                                        <a href="prenatals_list.php?sched_id=<?= urlencode($schedule['sched_id']) ?>" class="btn btn-info btn-sm">
                                            View Prenatals
                                        </a>
                                        <form action="../controllers/midwife_delete_prenatal_schedule.php" method="POST" style="display:inline;">
                                            <input type="hidden" name="sched_id" value="<?= $schedule['sched_id'] ?>">
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                                        </form>
                                    </td>
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
