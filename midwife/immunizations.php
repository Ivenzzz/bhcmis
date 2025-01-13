<?php

session_start();

$title = 'Immunizations';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';

$user = getCurrentUser($conn);
$immunization_appointments = getImmunizationAppointments($conn);

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
                <div class="col-md-12">
                    <div id="immunizationSchedulescalendar"></div>
                </div>
            </div>

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12">
                    <table id="appointmentsTable" class="display text-center text-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Tracking Code</th>
                                <th>Priority Number</th>
                                <th>Vaccine Name</th>
                                <th>Status</th>
                                <th>Schedule Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (is_array($immunization_appointments)) :
                                foreach ($immunization_appointments as $appointment) :    
                            ?>
                            <tr>
                                <td><?= $appointment['lastname'] . ', ' . $appointment['firstname'] . ' ' .$appointment['middlename'] ?></td>
                                <td><?= $appointment['tracking_code'] ?></td>
                                <td><?= $appointment['priority_number'] ?></td>
                                <td><?= $appointment['vaccine_name'] ?></td>
                                <td>
                                    <?php if ($appointment['status'] === 'Cancelled'): ?>
                                        <span class="badge bg-danger">Cancelled</span>
                                    <?php elseif ($appointment['status'] === 'Scheduled'): ?>
                                        <span class="badge bg-warning text-dark">Scheduled</span>
                                    <?php elseif ($appointment['status'] === 'Completed'): ?>
                                        <span class="badge bg-success">Completed</span>
                                    <?php elseif ($appointment['status'] === 'Missed'): ?>
                                        <span class="badge bg-danger">Missed</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars((new DateTime($appointment['schedule_date']))->format('F j, Y | h:i A')) ?></td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-warning btn-sm">Mark as Completed</button>
                                    <button class="btn btn-info btn-sm">View Result</button>
                                </td>
                            </tr>
                            <?php
                                endforeach;
                            else :
                            ?>
                            <tr>
                                <td colspan="8">No appointments found.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
