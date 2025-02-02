<!-- Edit Account Modal -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAccountModalLabel"><i class="fas fa-edit me-2"></i>Edit Account Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editProfileForm" enctype="multipart/form-data">
                    <input type="hidden" name="account_id" value="<?php echo htmlspecialchars($user['account_id']); ?>">
                    
                    <!-- Profile Picture Upload -->
                    <div class="mb-4 text-center">
                        <div class="profile-picture-preview mb-3">
                            <?php if(!empty($user['profile_picture'])): ?>
                                <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" 
                                    class="img-thumbnail rounded-circle preview-image" 
                                    alt="Current Profile Picture"
                                    style="width: 150px; height: 150px; object-fit: cover;">
                            <?php else: ?>
                                <div class="preview-image default-preview d-inline-block bg-secondary rounded-circle p-3">
                                    <i class="fas fa-user-circle fa-3x text-light"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="input-group">
                            <input type="file" 
                                class="form-control" 
                                id="profilePicture" 
                                name="profile_picture" 
                                accept="image/*"
                                onchange="previewImage(this)">
                            <label class="input-group-text btn btn-primary" for="profilePicture">
                                <i class="fas fa-upload me-1"></i>Upload
                            </label>
                        </div>
                        <small class="form-text text-muted">Max file size: 2MB (JPEG, PNG, GIF)</small>
                    </div>

                    <!-- Username Field -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" 
                            class="form-control" 
                            id="username" 
                            name="username" 
                            value="<?php echo htmlspecialchars($user['username']); ?>"
                            required>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" 
                            class="form-control" 
                            id="email" 
                            value="<?php echo htmlspecialchars($resident_info['email']); ?>" 
                            disabled>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>