<?php

session_start();

$title = 'Immunizations';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';
<<<<<<< HEAD
require '../models/vaccines.php';
=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf

$user = getCurrentUser($conn);
$immunization_appointments = getImmunizationAppointments($conn);
$immunization_schedules = getImmunizationSchedules($conn);
<<<<<<< HEAD
$vaccines = getVaccines($conn);

// Set the default date and time to the current timestamp in the format "YYYY-MM-DDTHH:MM"
date_default_timezone_set('Asia/Manila'); // Set timezone to your region
$currentDateTime = date('Y-m-d\TH:i');
$vaccine_list = getAllVaccines($conn);

=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf

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
<<<<<<< HEAD
                <div class="col-md-12 d-flex justify-content-end mb-2">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                        Add Schedule
                    </button>
                </div>
                <div class="col-md-6 shadow p-4">
=======
                <div class="col-md-6">
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
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
<<<<<<< HEAD

            <div class="row mb-4 p-4 shadow">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addVaccineModal">Add Vaccine</button>
                </div>
                <div class="col-md-12">
                    <h6>Vaccines</h6>
                    <table id="vaccinesTable" class="display text-xs">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vaccine Name</th>
                                <th>Lot Number</th>
                                <th>Stocks</th>
                                <th>Expiration Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($vaccine_list) && !empty($vaccine_list)): ?>
                                <?php foreach ($vaccine_list as $vaccine): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($vaccine['vaccine_id']); ?></td>
                                        <td><?php echo htmlspecialchars($vaccine['vaccine_name']); ?></td>
                                        <td><?php echo htmlspecialchars($vaccine['lot_number']) ?: 'None'; ?></td>
                                        <td><?php echo htmlspecialchars($vaccine['stocks']) ?: 'None'; ?></td>
                                        <td><?php echo htmlspecialchars($vaccine['expiration_date']) ?: 'None'; ?></td>
                                        <td><?php echo htmlspecialchars($vaccine['status']); ?></td>
                                        <td>
                                            <!-- Delete Button inside Form -->
                                            <form action="../controllers/midwife_delete_vaccine.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this vaccine?');">
                                                <input type="hidden" name="vaccine_id" value="<?php echo $vaccine['vaccine_id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" class="text-center">No vaccines available.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
  </div>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Prenatal Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addScheduleForm">
                        <div class="mb-3">
                            <label for="scheduleDateTime" class="form-label">Select Date & Time</label>
                            <input type="datetime-local" class="form-control" id="scheduleDateTime" name="scheduleDateTime" value="<?= date('Y-m-d\TH:i') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="vaccineSelect" class="form-label">Select Vaccine</label>
                            <select class="form-select" id="vaccineSelect" name="vaccineSelect" required>
                                <option value="" disabled selected>Select a vaccine</option>
                                <?php foreach ($vaccines as $vaccine): ?>
                                    <option value="<?= $vaccine['vaccine_id'] ?>">
                                        <?= $vaccine['vaccine_name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Vaccine Modal -->
    <div class="modal fade" id="addVaccineModal" tabindex="-1" aria-labelledby="addVaccineModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVaccineModalLabel">Add New Vaccine</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVaccineForm" method="POST" action="../controllers/midwife_add_vaccine.php">
                        <div class="mb-3">
                            <label for="vaccine_name" class="form-label">Vaccine Name</label>
                            <input type="text" class="form-control" id="vaccine_name" name="vaccine_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="lot_number" class="form-label">Lot Number</label>
                            <input type="text" class="form-control" id="lot_number" name="lot_number">
                        </div>
                        <div class="mb-3">
                            <label for="expiration_date" class="form-label">Expiration Date</label>
                            <input type="date" class="form-control" id="expiration_date" name="expiration_date">
                        </div>
                        <div class="mb-3">
                            <label for="stocks" class="form-label">Stocks</label>
                            <input type="number" class="form-control" id="stocks" name="stocks" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Vaccine</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

=======
        </div>
  </div>

>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        // Initialize DataTable
        $(document).ready(function() {
<<<<<<< HEAD
            $('#appointmentsTable').DataTable({
                responsive: true,
                pageLength: 10,
                stateSave: true
            });
=======
            $('#appointmentsTable').DataTable();
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
        });
    </script>
   <script>
        $(document).ready(function () {
            $('#immunizationTable').DataTable({
                responsive: true,
<<<<<<< HEAD
                pageLength: 10,
                stateSave: true
=======
                pageLength: 10
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
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
<<<<<<< HEAD
    <script>
        document.getElementById("addScheduleForm").addEventListener("submit", async function (e) {
            e.preventDefault(); // Prevent default form submission

            const formData = new FormData(this);

            try {
                const response = await fetch("../controllers/midwife_add_immunization_schedule.php", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json(); // Parse JSON response

                if (result.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: result.message,
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        document.getElementById("addScheduleModal").classList.remove("show");
                        document.body.classList.remove("modal-open");
                        document.querySelector(".modal-backdrop").remove(); // Close modal
                        document.getElementById("addScheduleForm").reset(); // Reset form
                        location.reload(); // Reload page (optional)
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: result.message
                    });
                }
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "An error occurred. Please try again."
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#vaccinesTable').DataTable({
                responsive: true, // Optional: if you want the table to be responsive
                paging: true,     // Enable pagination
                searching: true,  // Enable search functionality
                ordering: true,   // Enable sorting functionality
                info: true,
                stateSave: true,  // Save table state on page reload
                pageLength: 5,    // Minimum rows to display (on page load)
                lengthMenu: [5, 10, 15, 20],  // Add 5 as an option in the paging dropdown
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission using fetch
            document.getElementById('addVaccineForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = new FormData(this);

                // Send the form data to midwife_add_vaccine.php using fetch
                fetch('../controllers/midwife_add_vaccine.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json()) // Parse the JSON response
                .then(result => {
                    if (result.success) {
                        // Show success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Vaccine Added!',
                            text: result.message || 'The vaccine has been added successfully.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Close the modal
                            $('#addVaccineModal').modal('hide');
                            // Reload the vaccine list
                            location.reload();
                        });
                    } else {
                        // Show error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message || 'Something went wrong. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show general error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error occurred while adding the vaccine. Please try again.',
                        confirmButtonText: 'OK'
                    });
                });
            });
        });
    </script>
=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
</body>
</html>
