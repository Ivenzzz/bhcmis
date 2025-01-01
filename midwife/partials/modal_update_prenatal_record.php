<div class="modal fade" id="editPrenatalModal<?= $prenatal['prenatal_id'] ?>" tabindex="-1" aria-labelledby="editPrenatalModalLabel<?= $prenatal['prenatal_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPrenatalModalLabel<?= $prenatal['prenatal_id'] ?>">Edit Prenatal Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/midwife_update_prenatal_record.php" method="POST">
                <div class="modal-body">
                    <!-- Hidden field for sched_id -->
                    <input type="hidden" name="sched_id" value="<?= htmlspecialchars($sched_id) ?>">

                    <div class="mb-3">
                        <label for="weight<?= $prenatal['prenatal_id'] ?>" class="form-label">Weight</label>
                        <input type="number" class="form-control" id="weight<?= $prenatal['prenatal_id'] ?>" name="weight" value="<?= htmlspecialchars($prenatal['weight'] ?? '') ?>" placeholder="e.g. 65.5" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="blood_pressure<?= $prenatal['prenatal_id'] ?>" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure<?= $prenatal['prenatal_id'] ?>" name="blood_pressure" value="<?= htmlspecialchars($prenatal['blood_pressure'] ?? '') ?>" placeholder="e.g. 120/80">
                    </div>
                    <div class="mb-3">
                        <label for="heart_lungs_condition<?= $prenatal['prenatal_id'] ?>" class="form-label">Heart & Lungs Condition</label>
                        <input type="text" class="form-control" id="heart_lungs_condition<?= $prenatal['prenatal_id'] ?>" name="heart_lungs_condition" value="<?= htmlspecialchars($prenatal['heart_lungs_condition'] ?? '') ?>" placeholder="e.g. Normal, no issues">
                    </div>
                    <div class="mb-3">
                        <label for="abdominal_exam<?= $prenatal['prenatal_id'] ?>" class="form-label">Abdominal Exam</label>
                        <input type="text" class="form-control" id="abdominal_exam<?= $prenatal['prenatal_id'] ?>" name="abdominal_exam" value="<?= htmlspecialchars($prenatal['abdominal_exam'] ?? '') ?>" placeholder="e.g. No abnormalities detected">
                    </div>
                    <div class="mb-3">
                        <label for="fetal_heart_rate<?= $prenatal['prenatal_id'] ?>" class="form-label">Fetal Heart Rate</label>
                        <input type="text" class="form-control" id="fetal_heart_rate<?= $prenatal['prenatal_id'] ?>" name="fetal_heart_rate" value="<?= htmlspecialchars($prenatal['fetal_heart_rate'] ?? '') ?>" placeholder="e.g. 140 bpm">
                    </div>
                    <div class="mb-3">
                        <label for="fundal_height<?= $prenatal['prenatal_id'] ?>" class="form-label">Fundal Height</label>
                        <input type="text" class="form-control" id="fundal_height<?= $prenatal['prenatal_id'] ?>" name="fundal_height" value="<?= htmlspecialchars($prenatal['fundal_height'] ?? '') ?>" placeholder="e.g. 25 cm">
                    </div>
                    <div class="mb-3">
                        <label for="fetal_movement<?= $prenatal['prenatal_id'] ?>" class="form-label">Fetal Movement</label>
                        <input type="text" class="form-control" id="fetal_movement<?= $prenatal['prenatal_id'] ?>" name="fetal_movement" value="<?= htmlspecialchars($prenatal['fetal_movement'] ?? '') ?>" placeholder="e.g. Active, regular movements">
                    </div>
                    <div class="mb-3">
                        <label for="checkup_notes<?= $prenatal['prenatal_id'] ?>" class="form-label">Checkup Notes</label>
                        <textarea class="form-control" id="checkup_notes<?= $prenatal['prenatal_id'] ?>" name="checkup_notes" placeholder="e.g. Follow up in 2 weeks"><?= htmlspecialchars($prenatal['checkup_notes'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="refer_to<?= $prenatal['prenatal_id'] ?>" class="form-label">Refer To</label>
                        <input type="text" class="form-control" id="refer_to<?= $prenatal['prenatal_id'] ?>" name="refer_to" value="<?= htmlspecialchars($prenatal['refer_to'] ?? '') ?>" placeholder="e.g. Victorias City Health Center, etc.">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>