<div class="modal fade" id="updateModal<?= $midwife['midwife_id'] ?>" tabindex="-1" aria-labelledby="updateModalLabel<?= $midwife['midwife_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateModalLabel<?= $midwife['midwife_id'] ?>">Update Midwife Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/admin_update_midwife.php" method="POST">
                    <input type="hidden" name="midwife_id" value="<?= $midwife['midwife_id'] ?>">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($midwife['firstname']) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" value="<?= htmlspecialchars($midwife['middlename']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastname" value="<?= htmlspecialchars($midwife['lastname']) ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employment_status" class="form-label">Employment Status</label>
                            <select class="form-select" name="employment_status" required>
                                <option value="active" <?= $midwife['employment_status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $midwife['employment_status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="license_number" class="form-label">License Number</label>
                            <input type="text" class="form-control" name="license_number" value="<?= htmlspecialchars($midwife['license_number']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employment_date" class="form-label">Employment Date</label>
                            <input type="date" class="form-control" name="employment_date" value="<?= htmlspecialchars($midwife['employment_date']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="<?= htmlspecialchars($midwife['phone_number']) ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($midwife['email']) ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-select" name="civil_status">
                            <option value="Single" <?= $midwife['civil_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                            <option value="Married" <?= $midwife['civil_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                            <option value="Widowed" <?= $midwife['civil_status'] === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                            <option value="Legally Separated" <?= $midwife['civil_status'] === 'Legally Separated' ? 'selected' : '' ?>>Legally Separated</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>