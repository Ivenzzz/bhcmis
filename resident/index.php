<?php

session_start();

$title = 'Appointments';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_appointments.php';

$user = getCurrentUser($conn);
$appointments = getResidentAppointmentsWithSchedule($conn);

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
        
        <div class="container mt-4 px-4">

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
                                    <a href="index.php" class="btn btn-primary me-2">Consultation Appointment</a>
                                    <a href="immunization_appointments.php" class="btn btn-secondary">Immunization Appointment</a>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            
            <!-- Status Filter Dropdown -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <label for="statusFilter" class="me-2">Filter by Status:</label>
                        <select id="statusFilter" class="form-select" style="width: 200px;">
                            <option value="all">All</option>
                            <option value="Scheduled">Scheduled</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Appointments Cards Section -->
            <div class="row mb-4">
                <div class="col-md-12 px-5">
                    <?php require 'partials/appointment_cards.php';?>
                </div>
            </div>

            <!-- Add Appointment Button -->
            <div class="row mb-4">  
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">Add Appointment</button>
                    </div>
                </div>
            </div>

        </div>
  </div>

    <?php require 'partials/modal_add_appointment.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_appointments.js"></script>
</body>
</html>
