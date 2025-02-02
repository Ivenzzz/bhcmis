<!-- Edit Modal -->
<div class="modal fade" id="editModal<?= $consultation['consultation_id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $consultation['consultation_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel<?= $consultation['consultation_id'] ?>">Edit Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/midwife_update_consultation.php" method="POST">
                <div class="modal-body">
                    <!-- Reason for Visit -->
                    <div class="form-group mb-3">
                        <label for="reason_for_visit<?= $consultation['consultation_id'] ?>">Reason for Visit</label>
                        <input type="text" class="form-control" id="reason_for_visit<?= $consultation['consultation_id'] ?>" name="reason_for_visit" value="<?= !empty($consultation['reason_for_visit']) ? $consultation['reason_for_visit'] : 'None' ?>" required>
                    </div>
                    <!-- Symptoms -->
                    <div class="form-group mb-3">
                        <label for="symptoms<?= $consultation['consultation_id'] ?>">Symptoms</label>
                        <textarea class="form-control" id="symptoms<?= $consultation['consultation_id'] ?>" name="symptoms"><?= !empty($consultation['symptoms']) ? $consultation['symptoms'] : 'None' ?></textarea>
                    </div>
                    <!-- Weight (kg) -->
                    <div class="form-group mb-3">
                        <label for="weight_kg<?= $consultation['consultation_id'] ?>">Weight (kg)</label>
                        <input type="number" class="form-control" id="weight_kg<?= $consultation['consultation_id'] ?>" name="weight_kg" value="<?= !empty($consultation['weight_kg']) ? $consultation['weight_kg'] : 'None' ?>" step="0.01">
                    </div>
                    <!-- Temperature -->
                    <div class="form-group mb-3">
                        <label for="temperature<?= $consultation['consultation_id'] ?>">Temperature</label>
                        <input type="text" class="form-control" id="temperature<?= $consultation['consultation_id'] ?>" name="temperature" value="<?= !empty($consultation['temperature']) ? $consultation['temperature'] : 'None' ?>">
                    </div>
                    <!-- Heart Rate -->
                    <div class="form-group mb-3">
                        <label for="heart_rate<?= $consultation['consultation_id'] ?>">Heart Rate</label>
                        <input type="text" class="form-control" id="heart_rate<?= $consultation['consultation_id'] ?>" name="heart_rate" value="<?= !empty($consultation['heart_rate']) ? $consultation['heart_rate'] : 'None' ?>">
                    </div>
                    <!-- Respiratory Rate -->
                    <div class="form-group mb-3">
                        <label for="respiratory_rate<?= $consultation['consultation_id'] ?>">Respiratory Rate</label>
                        <input type="text" class="form-control" id="respiratory_rate<?= $consultation['consultation_id'] ?>" name="respiratory_rate" value="<?= !empty($consultation['respiratory_rate']) ? $consultation['respiratory_rate'] : 'None' ?>">
                    </div>
                    <!-- Blood Pressure -->
                    <div class="form-group mb-3">
                        <label for="blood_pressure<?= $consultation['consultation_id'] ?>">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure<?= $consultation['consultation_id'] ?>" name="blood_pressure" value="<?= !empty($consultation['blood_pressure']) ? $consultation['blood_pressure'] : 'None' ?>">
                    </div>
                    <!-- Cholesterol Level -->
                    <div class="form-group mb-3">
                        <label for="cholesterol_level<?= $consultation['consultation_id'] ?>">Cholesterol Level</label>
                        <input type="text" class="form-control" id="cholesterol_level<?= $consultation['consultation_id'] ?>" name="cholesterol_level" value="<?= !empty($consultation['cholesterol_level']) ? $consultation['cholesterol_level'] : 'None' ?>">
                    </div>
                    <!-- Physical Findings -->
                    <div class="form-group mb-3">
                        <label for="physical_findings<?= $consultation['consultation_id'] ?>">Physical Findings</label>
                        <textarea class="form-control" id="physical_findings<?= $consultation['consultation_id'] ?>" name="physical_findings"><?= !empty($consultation['physical_findings']) ? $consultation['physical_findings'] : 'None' ?></textarea>
                    </div>
                    <!-- Refer To -->
                    <div class="form-group mb-3">
                        <label for="refer_to<?= $consultation['consultation_id'] ?>">Refer To</label>
                        <input type="text" class="form-control" id="refer_to<?= $consultation['consultation_id'] ?>" name="refer_to" value="<?= !empty($consultation['refer_to']) ? $consultation['refer_to'] : 'None' ?>">
                    </div>
                    <!-- Consultation ID (Hidden) -->
                    <input type="hidden" name="consultation_id" value="<?= $consultation['consultation_id'] ?>">
                    <!-- Con Sched ID (Hidden) -->
                    <input type="hidden" name="con_sched_id" value="<?= $consultation['con_sched_id'] ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>