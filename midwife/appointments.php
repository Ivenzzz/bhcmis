<?php

session_start();

$title = 'Appointment List';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/consultations.php';

$user = getCurrentUser($conn);
$consultation_schedule_id = $_GET['con_sched_id'];

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

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="consultations.php">Calendar</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <a href="consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">Without Appointments</a>
                    <a href="appointed_consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">With Appointments</a>
                    <a href="appointments.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-primary btn-sm">Appointments</a>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_consultation_details.js"></script>
</body>
</html>
