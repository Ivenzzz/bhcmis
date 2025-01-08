<!-- Add Appointment Modal -->
<div class="modal fade" id="addImmunizationAppointmentModal" tabindex="-1" aria-labelledby="addImmunizationAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addImmunizationAppointmentModalLabel">Add New Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addImmunizationAppointmentForm">
                    <div class="mb-3">
                        <label for="schedule" class="form-label">Select Schedule</label>
                        <select class="form-select" id="schedule" name="schedule_id" required>
                            <option value="">Choose an Immunization Schedule</option>
                            <?php foreach ($appointment_schedules as $schedule): ?>
                                <option value="<?= htmlspecialchars($schedule['schedule_id']); ?>">
                                    <?= htmlspecialchars(date('F d, Y h:i A', strtotime($schedule['schedule_date']))); ?>
                                </option>
                            <?php endforeach; ?>
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
