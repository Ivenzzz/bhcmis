<!-- Modal -->
<div class="modal fade" id="setAppointmentModal" tabindex="-1" aria-labelledby="setAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setAppointmentModalLabel">Set Immunization Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="setAppointmentForm">
                    <div class="mb-3">
                        <label for="childSelect" class="form-label">Select Child</label>
                        <select class="form-select" id="childSelect" name="child_id" required>
                            <option value="">Select a Child</option>
                            <?php foreach ($children as $child): ?>
                                <option value="<?= $child['resident_id']; ?>">
                                    <?= htmlspecialchars($child['firstname']) . ' ' . strtoupper(substr($child['middlename'], 0, 1)) . '. ' . htmlspecialchars($child['lastname']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="scheduleSelect" class="form-label">Select Immunization Schedule</label>
                        <select class="form-select" id="scheduleSelect" name="schedule_id" required>
                            <option value="">Select a Schedule</option>
                            <?php foreach ($immunization_schedules as $schedule): ?>
                                <option value="<?= $schedule['schedule_id']; ?>">
                                    <?= (new DateTime($schedule['schedule_date']))->format('F d, Y h:i A'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Set Appointment</button>
                </form>
            </div>
        </div>
    </div>
</div>