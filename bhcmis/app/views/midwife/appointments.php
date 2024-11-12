<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_midwife.php';
require './app/models/get_midwife_analytics.php';
require './app/models/get_consultation_schedules.php';

$title = 'Appointments';
$user = getCurrentMidwife($conn);
$totalAppointments = getTotalAppointments($conn);
$totalScheduledAppointments = getScheduledAppointments($conn);
$appointmentStats = getAppointmentStats($conn);
$consultation_schedules = getConsultationSchedules($conn);

$consultation_schedules_json = json_encode($consultation_schedules);


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
    
    <div class="container-fluid height-100 main-content mb-4">

        <div class="row mb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="midwife">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Appointments</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-4">
            <!-- Card for Total Appointments -->
            <div class="col-md-3 mb-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2 class="card-text"><?= $totalAppointments ?></h2>
                        <p class="text-muted">All appointments</p>
                    </div>
                </div>
            </div>

            <!-- Card for Scheduled Appointments -->
            <div class="col-md-3 mb-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2 class="card-text"><?= $appointmentStats['Scheduled'] ?></h2>
                        <p class="text-muted">Upcoming</p>
                    </div>
                </div>
            </div>

            <!-- Card for Completed Appointments -->
            <div class="col-md-3 mb-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2 class="card-text"><?= $appointmentStats['Completed'] ?></h2>
                        <p class="text-muted">Finished</p>
                    </div>
                </div>
            </div>

            <!-- Card for Cancelled Appointments -->
            <div class="col-md-3 mb-4">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <h2 class="card-text"><?= $appointmentStats['Cancelled'] ?></h2>
                        <p class="text-muted">Cancelled</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row shadow p-2 mb-4">
            <div class="col-md-6 shadow p-3">
                <h6 class="text-center mb-3">Schedule of Consultations</h6>
                <div id="calendar" data-schedules='<?= $consultation_schedules_json; ?>'></div>
            </div>
        </div>

        <!-- Modal for Adding a Consultation Schedule -->
        <div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addConsultationModalLabel">Add Consultation Schedule</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addConsultationForm" action="./app/controllers/midwife-appointments/save_consultation_schedule.php" method="POST">
                            <div class="mb-3">
                                <label for="consultationDate" class="form-label">Consultation Date</label>
                                <input type="text" class="form-control" id="consultationDate" name="consultationDate" readonly>
                            </div>  
                            <div class="mb-3">
                                <label for="consultationTime" class="form-label">Consultation Time</label>
                                <!-- Default value set to 08:00 for 8:00 AM -->
                                <input type="time" class="form-control" id="consultationTime" name="consultationTime" value="08:00" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Consultation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
    <script src="./public/js/midwife/consultations.js"></script>
</body>
</html>
