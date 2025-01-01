<?php

session_start();

$title = 'Midwife Dashboard';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/midwife.php';
require '../models/appointments.php';
require '../models/consultations.php';

$user = getCurrentUser($conn);
$midwife = getCurrentMidwife($conn);
$todays_appointments = getTodaysAppointments($conn);
$total_todays_appointments = getTotalAppointmentsToday($conn);
$total_completed_appointments = getTotalCompletedAppointments($conn);
$total_cancelled_appointments = getTotalCancelledAppointments($conn);
$total_consultations = getTotalConsultations($conn);

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

            <div class="row mb-4 shadow">
                <div class="col-md-9 d-flex flex-column p-4">
                    <h5 class="poppins-semibold">Welcome Midwife <?php echo $midwife['firstname'] . ' ' . $midwife['lastname']; ?></h5>
                    <p><small>Have a nice day at work!</small></p>
                </div>
                <div class="col-md-3 py-2 h-100 d-flex justify-content-end">
                    <?php echo date('F j, Y'); ?>
                </div>
            </div>

            <div class="row mb-4 shadow">
                <div class="col-md-3 mb-3">
                    <div class="card bg-orange-500 text-white shadow-sm p-2">
                        <div class="card-body text-center">
                            <h5 class="card-title wrap">Total Consultations</h5>
                            <p class="card-text fs-4"><?php echo $total_consultations; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-sky-500 text-white shadow-sm p-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Today's Appointments</h5>
                            <p class="card-text fs-4"><?php echo $total_todays_appointments; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-green-700 text-white shadow-sm p-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Completed Appointments</h5>
                            <p class="card-text fs-4"><?php echo $total_completed_appointments; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card bg-red-600 text-white shadow-sm p-2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Cancelled Appointments</h5>
                            <p class="card-text fs-4"><?php echo $total_cancelled_appointments; ?></p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mb-4 shadow">
                <div class="col-md-12 p-4">
                    <!-- Container for today's appointments -->
                    <h5 class="mb-3">Today's Appointments</h5>
                    <?php if ($todays_appointments && count($todays_appointments) > 0): ?>
                        <table class="table text-center text-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Tracking Code</th>
                                    <th>Resident Name</th>
                                    <th>Priority Number</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-secondary">
                                <?php foreach ($todays_appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($appointment['tracking_code']); ?></td>
                                        <td><?php echo htmlspecialchars($appointment['resident_name']); ?></td>
                                        <td><?php echo htmlspecialchars($appointment['priority_number']); ?></td>
                                        <td class="
                                            <?php echo $appointment['status'] === 'Cancelled' ? 'text-danger' : 
                                                   ($appointment['status'] === 'Completed' ? 'text-success' : 'text-warning'); ?>">
                                            <?php echo htmlspecialchars($appointment['status']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars(date('F j, Y | g:i A', strtotime($appointment['appointment_created_at']))); ?></td>
                                        <td>
                                            <button class="btn btn-info btn-sm">View Info</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p class="text-center text-muted">No appointments for today.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
</body>
</html>
