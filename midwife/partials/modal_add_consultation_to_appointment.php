<div class="modal fade" id="markCompletedModal<?= $appointment['appointment_id']; ?>" tabindex="-1" aria-labelledby="markCompletedModalLabel<?= $appointment['appointment_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="markCompletedModalLabel<?= $appointment['appointment_id']; ?>">Add Consultation for Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Consultation Form -->
                <form action="../controllers/midwife_add_consultation_to_appointment.php" method="POST">
                    <input type="hidden" name="appointment_id" value="<?= $appointment['appointment_id']; ?>">
                    <input type="hidden" name="resident_id" value="<?= $appointment['resident_id']; ?>"> <!-- Resident ID Hidden Field -->
                    <input type="hidden" name="con_sched_id" value="<?= htmlspecialchars($consultation_schedule_id); ?>">

                    <div class="mb-3">
                        <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                        <input type="text" class="form-control" name="reason_for_visit" required>
                    </div>

                    <div class="mb-3">
                        <label for="symptoms" class="form-label">Symptoms</label>
                        <textarea class="form-control" name="symptoms"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="weight_kg" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="weight_kg">
                    </div>

                    <div class="mb-3">
                        <label for="temperature" class="form-label">Temperature</label>
                        <input type="text" class="form-control" name="temperature">
                    </div>

                    <div class="mb-3">
                        <label for="heart_rate" class="form-label">Heart Rate</label>
                        <input type="text" class="form-control" name="heart_rate">
                    </div>

                    <div class="mb-3">
                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" name="blood_pressure">
                    </div>

                    <div class="mb-3">
                        <label for="cholesterol_level" class="form-label">Cholesterol Level</label>
                        <input type="text" class="form-control" name="cholesterol_level">
                    </div>

                    <div class="mb-3">
                        <label for="physical_findings" class="form-label">Physical Findings</label>
                        <textarea class="form-control" name="physical_findings"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="refer_to" class="form-label">Refer To</label>
                        <input type="text" class="form-control" name="refer_to">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Consultation</button>
                </form>
            </div>
        </div>
    </div>
</div>