<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel"><i class="fas fa-lock me-2"></i>Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <!-- Hidden Account ID Field -->
                    <input type="hidden" id="account_id" name="account_id" 
                        value="<?php echo htmlspecialchars($user['account_id'] ?? ''); ?>">
                    
                    <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword" required>
                            <button type="button" class="btn btn-primary password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" required>
                            <button type="button" class="btn btn-primary password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" required>
                            <button type="button" class="btn btn-primary password-toggle">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>