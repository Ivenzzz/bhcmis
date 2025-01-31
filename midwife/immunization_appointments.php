<?php

session_start();

$title = 'Immunization Appointments';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';

$user = getCurrentUser($conn);
$sched_id = $_GET['schedule_id'];
$immunization_appointments = getImmunizationAppointmentsBySchedId($conn, $sched_id);

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
                            <li class="breadcrumb-item active" aria-current="page">Appointments</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <!-- DataTable for Immunization Appointments -->
            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <table id="immunizationAppointmentsTable" class="display table table-bordered text-center" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Priority Number</th>
                                <th>Tracking Code</th>
                                <th>Resident ID</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($immunization_appointments)): ?>
                                <?php foreach ($immunization_appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo $appointment['priority_number']; ?></td>
                                        <td><?php echo htmlspecialchars($appointment['tracking_code']); ?></td>
                                        <td><?php echo $appointment['resident_id']; ?></td>
                                        <td><?php echo $appointment['status']; ?></td>
                                        <td>
                                            <a href="appointment_details.php?appointment_id=<?php echo $appointment['appointment_id']; ?>" class="btn btn-info btn-sm">View</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No appointments found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#immunizationAppointmentsTable').DataTable({
                responsive: true, // Optional: if you want the table to be responsive
                paging: true,     // Enable pagination
                searching: true,  // Enable search functionality
                ordering: true,   // Enable sorting functionality
                info: true        // Show information about the table
            });
        });
    </script>
</body>
</html>
