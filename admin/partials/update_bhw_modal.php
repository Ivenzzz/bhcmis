<!-- Update BHW Modal -->
<div class="modal fade" id="editBHWModal<?= htmlspecialchars($bhw['bhw_id']); ?>" tabindex="-1" aria-labelledby="editBHWModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBHWModalLabel">Edit BHW - <?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../controllers/admin_update_bhw.php" method="POST">
                    <input type="hidden" name="bhw_id" value="<?= htmlspecialchars($bhw['bhw_id']); ?>">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstname<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname<?= htmlspecialchars($bhw['bhw_id']); ?>" name="firstname" value="<?= htmlspecialchars($bhw['firstname']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="middlename<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename<?= htmlspecialchars($bhw['bhw_id']); ?>" name="middlename" value="<?= htmlspecialchars($bhw['middlename']); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="lastname<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname<?= htmlspecialchars($bhw['bhw_id']); ?>" name="lastname" value="<?= htmlspecialchars($bhw['lastname']); ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="assigned_area" class="form-label">Assigned Area</label>
                            <select name="assigned_area" class="form-select" required>
                                <?php foreach ($addresses as $address): ?>
                                    <option value="<?= htmlspecialchars($address['address_id']); ?>" <?= $address['address_id'] == $bhw['assigned_area'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($address['address_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email<?= htmlspecialchars($bhw['bhw_id']); ?>" name="email" value="<?= htmlspecialchars($bhw['email']); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number<?= htmlspecialchars($bhw['bhw_id']); ?>" name="phone_number" value="<?= htmlspecialchars($bhw['phone_number']); ?>">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="employment_status<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Employment Status</label>
                            <select class="form-select" id="employment_status<?= htmlspecialchars($bhw['bhw_id']); ?>" name="employment_status">
                                <option value="active" <?= $bhw['employment_status'] === 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $bhw['employment_status'] === 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="on_leave" <?= $bhw['employment_status'] === 'on_leave' ? 'selected' : ''; ?>>On Leave</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="date_started<?= htmlspecialchars($bhw['bhw_id']); ?>" class="form-label">Date Started</label>
                            <input type="date" class="form-control" id="date_started<?= htmlspecialchars($bhw['bhw_id']); ?>" name="date_started" value="<?= htmlspecialchars($bhw['date_started']); ?>" required>
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
</div>