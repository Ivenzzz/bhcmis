<?php

session_start();

$title = 'Immunizations';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';

$user = getCurrentUser($conn);
$immunization_appointments = getImmunizationAppointments($conn);
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
        
        <div class="container mt-4 px-4">

            <div class="row mb-4">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Immunizations</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-6">
                    <div id="immunizationSchedulescalendar"></div>
                </div>
                <div class="col-md-6">
                    <div class="display text-xs">
                        <table id="immunizationTable" class="display text-center">
                            <thead>
                                <tr>
                                    <th>Schedule Date</th>
                                    <th>Vaccine</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($immunization_schedules)): ?>
                                    <?php foreach ($immunization_schedules as $schedule): ?>
                                        <tr>
                                            <td><?php echo date("F j, Y | g:i A", strtotime($schedule['schedule_date'])); ?></td>
                                            <td><?php echo htmlspecialchars($schedule['vaccine_name']); ?></td>
                                            <td>
                                                <a href="immunization_appointments.php?schedule_id=<?php echo $schedule['schedule_id']; ?>" class="btn btn-primary btn-sm">View Appointments</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No schedules found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
            $('#appointmentsTable').DataTable();
        });
    </script>
   <script>
        $(document).ready(function () {
            $('#immunizationTable').DataTable({
                responsive: true,
                pageLength: 10
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('immunizationSchedulescalendar');

            // Initialize FullCalendar
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth', // Default view
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: {
                    url: '../api/immunization_schedules.php', // API endpoint
                    method: 'GET',
                    failure: function () {
                        alert('There was an error while fetching events.');
                    }
                }
            });

            calendar.render();
        });
    </script>
</body>
</html>
