<!-- Modal Structure -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="addAppointmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentModalLabel">Add Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/midwife_add_resident_appointment.php" method="POST">
                    <input type="hidden" name="con_sched_id" value="<?= htmlspecialchars($consultation_schedule_id); ?>">

                    <div class="mb-3">
                        <label for="resident" class="form-label">Resident</label>
                        <select class="form-select" id="resident" name="resident_id" required>
                            <option value="" disabled selected>Select Resident</option>
                            <?php foreach ($residents as $resident): ?>
                                <option value="<?= $resident['resident_id']; ?>">
                                    <?= htmlspecialchars($resident['lastname']) . ' ' . htmlspecialchars($resident['firstname']) . ' ' . htmlspecialchars($resident['middlename']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Appointment</button>
                </form>
            </div>
        </div>
    </div>
</div>