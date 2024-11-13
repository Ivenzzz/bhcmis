<?php

session_start();

require './config/db_config.php';
require './app/models/get_current_midwife.php';
require './app/models/get_midwife_analytics.php';
require './app/models/get_appointment_functions.php';

$title = 'Appointments List';
$user = getCurrentMidwife($conn);
$schedule_id = isset($_GET['sched_id']) ? intval($_GET['sched_id']) : null;
$appointments = getAppointmentsByScheduleId($conn, $schedule_id);

$schedule_date = getScheduleDateById($conn, $schedule_id);
$formatted_schedule_date = $schedule_date ? date("F j, Y", strtotime($schedule_date)) : 'Unknown Date';

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

        <div class="row mb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="midwife">Home</a></li>
                        <li class="breadcrumb-item"><a href="midwife-appointments">Appointments</a></li>
                        <li class="breadcrumb-item active" aria-current="page">/ List for <?php echo $formatted_schedule_date; ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mb-4 shadow p-2">
            <div class="col-md-12">
                <h4 class="text-center mb-3"><?php echo $formatted_schedule_date; ?> appointments</h4>
                <?php if (is_array($appointments) && count($appointments) > 0): ?>
                    <table id="appointmentsTable" class="table table-bordered text-center my-4 shadow p-2">
                        <thead class="thead-dark">
                            <tr>
                                <th>Priority Number</th>
                                <th>Tracking Code</th>
                                <th>Resident Name</th>
                                <th>Contact Number</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo $appointment['priority_number']; ?></td>
                                <td><?php echo $appointment['tracking_code']; ?></td>
                                <td><?php echo $appointment['firstname'] . ' ' . $appointment['lastname']; ?></td>
                                <td><?php echo $appointment['phone_number']; ?></td>
                                <td>
                                    <span class="badge-pill p-1 rounded 
                                        <?php 
                                            if ($appointment['status'] === 'Cancelled') {
                                                echo 'bg-danger text-white';
                                            } elseif ($appointment['status'] === 'Scheduled') {
                                                echo 'bg-warning';
                                            } elseif ($appointment['status'] === 'Completed') {
                                                echo 'bg-success text-white';
                                            }
                                        ?>">
                                        <?php echo htmlspecialchars($appointment['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editStatusModal<?php echo $appointment['appointment_id']; ?>">
                                        <i class='bx bxs-edit-alt'></i>
                                    </button>
                                    <button class="btn-edit btn-print" data-appointment-id="<?php echo $appointment['appointment_id']; ?>">
                                        <i class='bx bx-printer'></i>
                                    </button>
                                </td>

                            </tr>

                            <!-- Hidden div for receipt content -->
                            <div id="receiptContent<?php echo $appointment['appointment_id']; ?>" style="display:none;">
                                <p>Tracking Code: <?php echo $appointment['tracking_code']; ?></p>
                                <p>Priority Number: <?php echo $appointment['priority_number']; ?></p>
                                <p>Resident Name: <?php echo $appointment['firstname'] . ' ' . $appointment['lastname']; ?></p>
                                <p>Contact Number: <?php echo $appointment['phone_number']; ?></p>
                                <p>Status: <?php echo htmlspecialchars($appointment['status']); ?></p>
                                <p>Date: <?php echo $formatted_schedule_date; ?></p>
                            </div>

                            <!-- Modal for Editing Status -->
                            <div class="modal fade" id="editStatusModal<?php echo $appointment['appointment_id']; ?>" tabindex="-1" aria-labelledby="editStatusModalLabel<?php echo $appointment['appointment_id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStatusModalLabel<?php echo $appointment['appointment_id']; ?>">Edit Appointment Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form id="editStatusForm<?php echo $appointment['appointment_id']; ?>" method="POST" action="./app/controllers/midwife-appointments/update_appointments.php">
                                                <input type="hidden" id="appointmentId" name="appointmentId" value="<?php echo $appointment['appointment_id']; ?>">
                                                <input type="hidden" id="schedId" name="schedId" value="<?php echo $schedule_id; ?>"> <!-- Include schedule ID -->
                                                <div class="form-group">
                                                    <label for="appointmentStatus">Status</label>
                                                    <select class="form-select" id="appointmentStatus<?php echo $appointment['appointment_id']; ?>" name="status">
                                                        <option value="Scheduled" <?php echo $appointment['status'] == 'Scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                                                        <option value="Cancelled" <?php echo $appointment['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                                        <option value="Completed" <?php echo $appointment['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>

                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No appointments found for this schedule.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="d-flex justify-content-end">
                    <button class="btn btn-success btn-sm me-2" id="exportPdfBtn">Export as PDF</button>
                    <button class="btn btn-danger btn-sm">Delete this Schedule</button>
                </div>
            </div>
        </div>

    </div>

    <?php include './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/logout.js"></script>
    <script src="./public/js/midwife/appointment_list.js"></script>
</body>
</html>
