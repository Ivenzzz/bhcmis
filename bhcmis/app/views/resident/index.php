<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_user.php';
require './app/models/get_resident_appointments.php';

$title = 'Residents Dashboard';
$user = getCurrentUser($conn);
$appointments = getResidentAppointmentsWithSchedule($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/resident.css">
</head>
<body id="body-pd">
    <?php include 'partials/top_navigation.php'; ?>
    <?php include 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <div class="row">
            <div class="col-md-12">
                <h4 class="my-4 text-center">My Appointments</h4>
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
        <div class="row mb-4 shadow">
            <div class="col-md-12 px-5">
                <?php require 'partials/appointments_cards.php';?>
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

        <?php require 'partials/add_appointment_modal.php'; ?>

    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
    <script src="./public/js/resident/appointments.js"></script>
</body>
</html>
