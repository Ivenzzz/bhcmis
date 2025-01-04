<!-- Modal for Adding Prenatal Record -->
<div class="modal fade" id="addPrenatalModal<?= $prenatal['resident_ps_id'] ?>" tabindex="-1" aria-labelledby="addPrenatalModalLabel<?= $prenatal['resident_ps_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="../controllers/midwife_add_prenatal_from_scheduled.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPrenatalModalLabel<?= $prenatal['resident_ps_id'] ?>">Add Prenatal Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="resident_ps_id" value="<?= $prenatal['resident_ps_id'] ?>">
                    <input type="hidden" name="pregnancy_id" value="<?= $prenatal['pregnancy_id'] ?>">
                    <input type="hidden" name="sched_id" value="<?= $sched_id ?>">

                    <div class="mb-3">
                        <label for="weight<?= $prenatal['resident_ps_id'] ?>" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="weight<?= $prenatal['resident_ps_id'] ?>" name="weight" required>
                    </div>
                    <div class="mb-3">
                        <label for="blood_pressure<?= $prenatal['resident_ps_id'] ?>" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure<?= $prenatal['resident_ps_id'] ?>" name="blood_pressure" required>
                    </div>
                    <div class="mb-3">
                        <label for="heart_lungs_condition<?= $prenatal['resident_ps_id'] ?>" class="form-label">Heart/Lungs Condition</label>
                        <input type="text" class="form-control" id="heart_lungs_condition<?= $prenatal['resident_ps_id'] ?>" name="heart_lungs_condition">
                    </div>
                    <div class="mb-3">
                        <label for="abdominal_exam<?= $prenatal['resident_ps_id'] ?>" class="form-label">Abdominal Exam</label>
                        <input type="text" class="form-control" id="abdominal_exam<?= $prenatal['resident_ps_id'] ?>" name="abdominal_exam">
                    </div>
                    <div class="mb-3">
                        <label for="fetal_heart_rate<?= $prenatal['resident_ps_id'] ?>" class="form-label">Fetal Heart Rate</label>
                        <input type="text" class="form-control" id="fetal_heart_rate<?= $prenatal['resident_ps_id'] ?>" name="fetal_heart_rate">
                    </div>
                    <div class="mb-3">
                        <label for="fundal_height<?= $prenatal['resident_ps_id'] ?>" class="form-label">Fundal Height</label>
                        <input type="text" class="form-control" id="fundal_height<?= $prenatal['resident_ps_id'] ?>" name="fundal_height">
                    </div>
                    <div class="mb-3">
                        <label for="fetal_movement<?= $prenatal['resident_ps_id'] ?>" class="form-label">Fetal Movement</label>
                        <input type="text" class="form-control" id="fetal_movement<?= $prenatal['resident_ps_id'] ?>" name="fetal_movement">
                    </div>
                    <div class="mb-3">
                        <label for="checkup_notes<?= $prenatal['resident_ps_id'] ?>" class="form-label">Checkup Notes</label>
                        <textarea class="form-control" id="checkup_notes<?= $prenatal['resident_ps_id'] ?>" name="checkup_notes" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="refer_to<?= $prenatal['resident_ps_id'] ?>" class="form-label">Refer To</label>
                        <input type="text" class="form-control" id="refer_to<?= $prenatal['resident_ps_id'] ?>" name="refer_to">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Prenatal Record</button>
                </div>
            </div>
        </form>
    </div>
</div>