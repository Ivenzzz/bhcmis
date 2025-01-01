<?php

session_start();

$title = 'Appointment List';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/consultations.php';

$user = getCurrentUser($conn);
$consultation_schedule_id = $_GET['con_sched_id'];
$appointments = getAppointmentsBySchedule($conn, $consultation_schedule_id);
$residents = getAllResidents($conn);

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

            <div class="row mb-4">
                <div class="col-12">
                    <a href="consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">Without Appointments</a>
                    <a href="appointed_consultation_details.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-secondary btn-sm">With Appointments</a>
                    <a href="appointments.php?con_sched_id=<?= $consultation_schedule_id ?>" class="btn btn-primary btn-sm">Appointments</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 mb-3 shadow p-4">
                    <?php if (!empty($appointments)): ?>
                        <table id="appointmentsTable" class="display text-center text-sm">
                            <thead>
                                <tr>
                                    <th>Priority Number</th>
                                    <th>Tracking Code</th>
                                    <th>Resident Name</th>
                                    <th>Schedule</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($appointment['priority_number']); ?></td>
                                        <td><?= htmlspecialchars($appointment['tracking_code']); ?></td>
                                        <td><?= htmlspecialchars($appointment['resident_name']); ?></td>
                                        <td><?= htmlspecialchars(date('F j, Y | g:i A', strtotime($appointment['appointment_schedule_date']))); ?></td>
                                        <td class="<?= 
                                            $appointment['status'] === 'Cancelled' ? 'text-red-500' : 
                                            ($appointment['status'] === 'Completed' ? 'text-green-500' : 
                                            ($appointment['status'] === 'Scheduled' ? 'text-amber-500' : '')); ?>">
                                            <?= htmlspecialchars($appointment['status']); ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars(date('F j, Y | g:i A', strtotime($appointment['created_at']))); ?>
                                        </td>
                                        <td class="d-flex">
                                            <?php if ($appointment['status'] !== 'Completed' && $appointment['status'] !== 'Cancelled'): ?>
                                                <button class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target="#markCompletedModal<?= $appointment['appointment_id']; ?>">
                                                    Mark as Completed
                                                </button>
                                            <?php elseif ($appointment['status'] === 'Completed'): ?>
                                                <!-- Display View Consultation button if status is Completed -->
                                                <a href="appointed_consultation_details.php?con_sched_id=<?= $consultation_schedule_id; ?>&search=<?= $appointment['tracking_code']; ?>" class="btn btn-info btn-sm me-2">
                                                    View Consultation
                                                </a>
                                            <?php endif; ?>

                                            
                                            <?php if ($appointment['status'] === 'Scheduled'): ?>
                                                <form action="../controllers/midwife_update_appointment_status.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to mark this appointment as Cancelled?')">
                                                    <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id']; ?>">
                                                    <input type="hidden" name="status" value="Cancelled">
                                                    <input type="hidden" name="con_sched_id" value="<?= $consultation_schedule_id; ?>">
                                                    <button type="submit" class="btn btn-warning btn-sm me-2">
                                                        Mark as Cancelled
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <!-- Delete Button Form -->
                                            <form action="../controllers/midwife_delete_appointment.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this appointment?')">
                                                <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id']; ?>">
                                                <input type="hidden" name="con_sched_id" value="<?= $consultation_schedule_id; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>

                                    <?php require 'partials/modal_add_consultation_to_appointment.php'; ?>

                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    <?php else: ?>
                        <p class="text-center text-muted">No appointments found for this schedule.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">Add Appointment</button>
                </div>
            </div>
        </div>
    </div>

    <?php require 'partials/modal_add_appointment.php';?>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/midwife_consultation_details.js"></script>
</body>
</html>
