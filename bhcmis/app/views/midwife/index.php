<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_midwife.php';
require './app/models/get_midwife_analytics.php';

$title = 'Midwife Dashboard';
$user = getCurrentMidwife($conn);
$totalAppointments = getTotalAppointments($conn);
$totalConsultations = getTotalConsultations($conn);
$totalScheduledAppointments = getScheduledAppointments($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/midwife.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="container-fluid height-100 main-content">
        <div class="row mb-4 shadow p-2">
            <div class="col-md-10 d-flex flex-column">
                <h5>Welcome Midwife <?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h5>
                <p><small>Have a nice day at work!</small></p>
            </div>
            <div class="col-md-2 py-2 h-50 d-flex justify-content-end">
                <?php echo date('F j, Y'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 p-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <p class="card-text">
                            <i class="fas fa-calendar-check fa-3x"></i>
                        </p>
                        <h5 class="card-title"><?php echo $totalAppointments; ?> Appointments</h5>
                        <div>
                            <a href="/bhcmis/midwife-appointments" class="btn btn-sm mt-2">
                                View More <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <p class="card-text">
                            <i class="fa-solid fa-hospital-user fa-3x"></i>
                        </p>
                        <h5 class="card-title"><?php echo $totalConsultations ?> Consultations</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4 p-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <p class="card-text">
                            <i class="fa-regular fa-hourglass fa-3x"></i>
                        </p>
                        <h5 class="card-title"><?php echo $totalScheduledAppointments ?> Pending</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
