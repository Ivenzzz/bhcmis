<?php

session_start();

$title = 'Immunization Appointments';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/immunizations.php';

$user = getCurrentUser($conn);
$sched_id = $_GET['schedule_id'];
$immunization_appointments = getImmunizationAppointmentsBySchedId($conn, $sched_id);
$schedules = getImmunizationSchedules($conn);

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
                    <table id="immunizationAppointmentsTable" class="display text-xs text-center open-sans-regular" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Priority Number</th>
                                <th class="text-center">Tracking Code</th>
                                <th class="text-center">Resident Name</th>
                                <th class="text-center">Vaccine</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($immunization_appointments)): ?>
                                <?php foreach ($immunization_appointments as $appointment): ?>
                                    <tr>
                                        <td><?php echo $appointment['priority_number']; ?></td>
                                        <td><?php echo htmlspecialchars($appointment['tracking_code']) ?: 'None'; ?></td>
                                        <td><?php echo $appointment['full_name'] ?: 'None'; ?></td>
                                        <td><?php echo $appointment['vaccine_name'] ?: 'None'; ?></td>
                                        <td><?php echo $appointment['status'] ?: 'None'; ?></td>
                                        <td>
                                            <?php if ($appointment['status'] == 'Completed'): ?>
                                                <a href="immunization_result.php?appointment_id=<?php echo $appointment['appointment_id']; ?>&schedule_id=<?php echo $appointment['sched_id']; ?>" class="btn btn-info btn-sm">
                                                    View Result
                                                </a>
                                            <?php elseif ($appointment['status'] == 'Scheduled'): ?>
                                                <!-- Button to open the modal -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#immunizationModal" data-appointment-id="<?php echo $appointment['appointment_id']; ?>">Mark as Completed</button>
                                            <?php else: ?>
                                                <button class="btn btn-secondary btn-sm" disabled>Not Allowed</button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>

                                <!-- Modal for each appointment -->
                                <div class="modal fade" id="immunizationModal_<?php echo $appointment['appointment_id']; ?>" tabindex="-1" aria-labelledby="immunizationModalLabel_<?php echo $appointment['appointment_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="immunizationModalLabel_<?php echo $appointment['appointment_id']; ?>">Add Immunization Record</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="immunizationForm_<?php echo $appointment['appointment_id']; ?>" data-appointment-id="<?php echo $appointment['appointment_id']; ?>">
                                                    <input type="hidden" name="appointmentId" value="<?php echo $appointment['appointment_id']; ?>">
                                                    <input type="hidden" name="vaccine_id" value="<?php echo $appointment['vaccine_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="route_<?php echo $appointment['appointment_id']; ?>" class="form-label">Route</label>
                                                        <select id="route_<?php echo $appointment['appointment_id']; ?>" name="route" class="form-select" required>
                                                            <option value="intramuscular">Intramuscular</option>
                                                            <option value="oral">Oral</option>
                                                            <option value="intradermal">Intradermal</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="administeredBy_<?php echo $appointment['appointment_id']; ?>" class="form-label">Administered By</label>
                                                        <input type="text" class="form-control" id="administeredBy_<?php echo $appointment['appointment_id']; ?>" name="administeredBy" placeholder="BHW or Midwife name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="doseNumber_<?php echo $appointment['appointment_id']; ?>" class="form-label">Dose Number</label>
                                                        <input type="number" class="form-control" id="doseNumber_<?php echo $appointment['appointment_id']; ?>" name="doseNumber" min="1" max="10" required placeholder="Enter Dose Number">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="nextDoseDue_<?php echo $appointment['appointment_id']; ?>" class="form-label">Next Dose Due (Select Schedule)</label>
                                                        <select class="form-select" id="nextDoseDue_<?php echo $appointment['appointment_id']; ?>" name="nextDoseDue" required>
                                                            <option value="NULL">None</option> <!-- This is the "None" option with value null -->
                                                            <?php if (!empty($schedules)): ?>
                                                                <?php foreach ($schedules as $schedule): ?>
                                                                    <?php 
                                                                        // Assuming 'schedule_date' is stored in a standard datetime format (e.g., 'YYYY-MM-DD HH:MM:SS')
                                                                        $formattedDate = new DateTime($schedule['schedule_date']);
                                                                        $formattedDateString = $formattedDate->format('F j, Y | g:i A');  // Format: 'March 15, 2025 | 12:00 AM'
                                                                    ?>
                                                                    <option value="<?php echo $schedule['schedule_id']; ?>"><?php echo htmlspecialchars($formattedDateString); ?></option>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <option value="" disabled>No available schedules</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="adverseReaction_<?php echo $appointment['appointment_id']; ?>" class="form-label">Adverse Reaction</label>
                                                        <textarea class="form-control" id="adverseReaction_<?php echo $appointment['appointment_id']; ?>" name="adverseReaction"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save Immunization</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/midwife_immunization_appointments.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable with state saving
            $('#immunizationAppointmentsTable').DataTable({
                responsive: true, // Optional: if you want the table to be responsive
                paging: true,     // Enable pagination
                searching: true,  // Enable search functionality
                ordering: true,   // Enable sorting functionality
                info: true,       // Show information about the table
                language: {
                    emptyTable: "No appointments available." // Custom message when the table is empty
                },
                stateSave: true   // Save the table state on page reload
            });
        });
    </script>
</body>
</html>

