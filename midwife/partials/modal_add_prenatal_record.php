<div class="modal fade" id="addPrenatalRecordModal" tabindex="-1" aria-labelledby="addPrenatalRecordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="../controllers/midwife_add_prenatal.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPrenatalRecordModalLabel">Add New Prenatal Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Pregnant Resident Dropdown -->
                    <div class="mb-3">
                        <label for="pregnantResident" class="form-label">Pregnant Resident</label>
                        <select class="form-select" id="pregnantResident" name="pregnancy_id" required>
                            <option value="" disabled selected>Select a resident</option>
                            <?php foreach ($pregnant_residents as $resident): ?>
                                <option value="<?= htmlspecialchars($resident['pregnancy_id']) ?>">
                                    <?= htmlspecialchars($resident['lastname'] . ' ' . $resident['firstname'] . ', ' . $resident['middlename']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Weight -->
                    <div class="mb-3">
                        <label for="weight" class="form-label">Weight</label>
                        <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
                    </div>

                    <!-- Blood Pressure -->
                    <div class="mb-3">
                        <label for="bloodPressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="bloodPressure" name="blood_pressure">
                    </div>

                    <!-- Heart and Lungs Condition -->
                    <div class="mb-3">
                        <label for="heartLungsCondition" class="form-label">Heart/Lungs Condition</label>
                        <input type="text" class="form-control" id="heartLungsCondition" name="heart_lungs_condition">
                    </div>

                    <!-- Abdominal Exam -->
                    <div class="mb-3">
                        <label for="abdominalExam" class="form-label">Abdominal Exam</label>
                        <input type="text" class="form-control" id="abdominalExam" name="abdominal_exam">
                    </div>

                    <!-- Fetal Heart Rate -->
                    <div class="mb-3">
                        <label for="fetalHeartRate" class="form-label">Fetal Heart Rate</label>
                        <input type="text" class="form-control" id="fetalHeartRate" name="fetal_heart_rate">
                    </div>

                    <!-- Fundal Height -->
                    <div class="mb-3">
                        <label for="fundalHeight" class="form-label">Fundal Height</label>
                        <input type="text" class="form-control" id="fundalHeight" name="fundal_height">
                    </div>

                    <!-- Fetal Movement -->
                    <div class="mb-3">
                        <label for="fetalMovement" class="form-label">Fetal Movement</label>
                        <input type="text" class="form-control" id="fetalMovement" name="fetal_movement">
                    </div>

                    <!-- Checkup Notes -->
                    <div class="mb-3">
                        <label for="checkupNotes" class="form-label">Checkup Notes</label>
                        <textarea class="form-control" id="checkupNotes" name="checkup_notes" rows="3"></textarea>
                    </div>

                    <!-- Refer To -->
                    <div class="mb-3">
                        <label for="referTo" class="form-label">Refer To</label>
                        <input type="text" class="form-control" id="referTo" name="refer_to">
                    </div>

                    <!-- Hidden Field for Schedule ID -->
                    <input type="hidden" name="sched_id" value="<?= htmlspecialchars($sched_id) ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Record</button>
                </div>
            </form>
        </div>
    </div>
</div>