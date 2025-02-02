<?php

session_start();

$title = 'Immunization Result';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';

$user = getCurrentUser($conn);
$immunization_details = getImmunizationDetails($conn, $_GET['appointment_id']);
$sched_id = $_GET['schedule_id'];

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
                            <li class="breadcrumb-item"><a href="immunizations.php">Immunizations</a></li>
                            <li class="breadcrumb-item"><a href="immunization_appointments.php?schedule_id=<?php echo $sched_id?>">Appointments</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Immunization Details</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 open-sans-regular">
                <?php if ($immunization_details): ?>
                    <div class="card shadow bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Immunization Details</h5>
                            <p class="card-text"><strong>Immunization ID:</strong> <?php echo $immunization_details['immunization_id'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Route:</strong> <?php echo $immunization_details['route'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Administered By:</strong> <?php echo $immunization_details['administered_by'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Dose Number:</strong> <?php echo $immunization_details['dose_number'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Next Dose Due:</strong> <?php echo $immunization_details['next_dose_due'] ? date('F j, Y, g:i a', strtotime($immunization_details['next_dose_due'])) : 'None'; ?></p>
                            <p class="card-text"><strong>Adverse Reaction:</strong> <?php echo $immunization_details['adverse_reaction'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Tracking Code:</strong> <?php echo $immunization_details['tracking_code'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Status:</strong> <?php echo $immunization_details['status'] ?: 'None'; ?></p>
                            <p class="card-text"><strong>Schedule Date:</strong> <?php echo $immunization_details['schedule_date'] ? date('F j, Y, g:i a', strtotime($immunization_details['schedule_date'])) : 'None'; ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <p>No immunization details found for the given appointment ID.</p>
                <?php endif; ?>
                </div>
            </div>
        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
