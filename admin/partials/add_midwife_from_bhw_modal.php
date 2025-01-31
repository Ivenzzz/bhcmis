<!-- Modal to appoint a new midwife from BHWs -->
<div class="modal fade" id="appointFromBHWModal" tabindex="-1" aria-labelledby="appointFromBHWModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointFromBHWModalLabel">Appoint Midwife from BHW</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/admin_add_midwife_from_bhw.php" method="POST">
                    <!-- Hidden input for current midwife's ID -->
                    <input type="hidden" name="current_midwife_id" value="<?= $current_midwife['midwife_id'] ?>">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="bhw_id" class="form-label">Select BHW</label>
                            <select class="form-select" name="bhw_id" id="bhw_id" required>
                                <option value="" disabled selected>Select a BHW</option>
                                <?php foreach ($bhws as $bhw): ?>
                                    <option value="<?= $bhw['bhw_id'] ?>">
                                        <?= $bhw['firstname'] . ' ' . $bhw['middlename'] . ' ' . $bhw['lastname'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="employment_status" class="form-label">Employment Status</label>
                            <select class="form-select" name="employment_status" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employment_date" class="form-label">Employment Date</label>
                            <input type="date" class="form-control" name="employment_date" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Appoint Midwife</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>