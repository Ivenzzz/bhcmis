<?php

session_start();

$title = 'Cancelled Immunization Appointments';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_immunizations.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$appointments = getCancelledImmunizationAppointmentsByResident($conn, $resident_id);


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
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container">
                            <a class="navbar-brand" href="#">Appointments</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <div class="ms-auto">
                                    <a href="index.php" class="btn btn-secondary me-2">Consultation Appointment</a>
                                    <a href="scheduled_immunization_appointments.php" class="btn btn-primary">Immunization Appointment</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="row mb-3 shadow p-4 gy-2">
                <div class="col-md-6">
                    <a href="scheduled_immunization_appointments.php" class="btn btn-secondary btn-sm">Scheduled</a>
                    <a href="completed_immunization_appointments.php" class="btn btn-secondary btn-sm">Completed</a>
                    <a href="cancelled_immunization_appointments.php" class="btn btn-success btn-sm">Canceled</a>
                    <a href="missed_immunization_appointments.php" class="btn btn-secondary btn-sm">Missed</a>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <a href="scheduled_immunization_appointments.php" class="btn btn-primary btn-sm">Own Immunizations</a>
                    <a href="children_immunization_appointments.php" class="btn btn-secondary btn-sm">My Children's Immunizations</a>
                </div>
            </div>

            <?php require 'partials/cards_scheduled_immunization_appointments.php'; ?>
        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
