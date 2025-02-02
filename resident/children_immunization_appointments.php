<?php

session_start();

$title = 'Immunization Appointments for Children';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/resident_immunizations.php';

$user = getCurrentUser($conn);
$resident_id = $user['resident_id'];
$children_ids = getChildrenIds($conn, $resident_id);
$children_appointments = getAppointmentsByResidentIds($conn, $children_ids);
$children = getChildrenInfoByResidentIds($conn, $children_ids);
$immunization_schedules = getImmunizationSchedules($conn);

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

            <div class="row mb-4 p-4 shadow">
                <div class="col-12 d-flex justify-content-end">
                    <a href="scheduled_immunization_appointments.php" class="btn btn-secondary btn-sm">Own Immunizations</a>
                    <a href="children_immunization_appointments.php" class="btn btn-primary btn-sm">My Children's Immunizations</a>
                </div>
            </div>

            <div class="row mb-2 p-4 gx-3">
                <div class="col-md-8">
                    <img src="../public/images/kid_with_syringe.png" class="w-100" alt="Kid with a Syringe">
                </div>
                <div class="col-md-4 d-flex align-items-center ">
                    <button class="btn btn-warning p-6 btn-lg btn-block" data-bs-toggle="modal" data-bs-target="#setAppointmentModal">
                        Set my Child Appointment <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
            
            <?php require 'partials/cards_children_immunization_appointments.php'; ?>

        </div>
  </div>

    
    <?php require 'partials/modal_add_children_immunization_appointment.php'; ?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/resident_child_immunizations.js"></script>
</body>
</html>
