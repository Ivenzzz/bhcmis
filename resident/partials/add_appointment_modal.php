<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">Add New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAppointmentForm" method="POST" action="./app/controllers/residents/add_appointment.php">
                    <div class="mb-3">
                        <label for="schedule" class="form-label">Select Schedule</label>
                        <select class="form-select" id="schedule" name="schedule_id" required>
                            <option value="">Choose a schedule</option>
                            <?php
                            // Fetch available schedules from the database
                            $query_schedules = "SELECT * FROM consultation_schedules ORDER BY con_sched_date ASC";
                            $result_schedules = $conn->query($query_schedules);

                            if ($result_schedules->num_rows > 0) {
                                while ($row = $result_schedules->fetch_assoc()) {
                                    $formatted_date = (new DateTime($row['con_sched_date']))->format('F j, Y | h:i A');
                                    echo "<option value=\"{$row['con_sched_id']}\">{$formatted_date}</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="resident_id" value="<?= htmlspecialchars($user['resident_id']); ?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>