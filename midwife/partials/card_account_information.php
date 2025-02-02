<div class="card">
    <div class="card-header bg-sky-500 text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="fas fa-user-cog me-2"></i>Account Information
        </h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#editAccountModal">
            <i class="fas fa-edit me-1"></i>Edit Profile
        </button>
    </div>
    <div class="card-body">

        <div class="row mb-4">
            <div class="col-md-12">
                <!-- Profile Picture Section -->
                <div class="profile-picture-container mb-4 text-center">
                    <?php if(!empty($user['profile_picture'])): ?>
                        <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" 
                             class="img-thumbnail rounded-circle" 
                             alt="Profile Picture"
                             style="width: 150px; height: 150px; object-fit: cover;"
                             onerror="this.onerror=null; this.classList.add('bg-secondary'); this.innerHTML='<i class=\'fas fa-user-circle fa-3x text-light\'></i>'">
                    <?php else: ?>
                        <div class="d-inline-block bg-secondary rounded-circle p-3">
                            <i class="fas fa-user-circle fa-3x text-light"></i>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-user me-2 text-primary"></i>
                        <strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?>
                    </p>
                </div>
                <!-- Modified Password Section -->
                <div class="info-item mb-3">
                    <div class="d-flex align-items-center mb-1">
                        <i class="fas fa-lock me-2 text-primary"></i>
                        <strong class="me-2">Password:</strong>
                        <div class="security-message text-muted text-xs">
                            <i class="fas fa-shield-alt me-1"></i>
                            Securely hashed using bcrypt (cannot be viewed)
                        </div>
                    </div>
                    <button class="btn btn-outline-primary btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                        <i class="fas fa-sync me-1"></i>Change Password
                    </button>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-calendar-plus me-2 text-primary"></i>
                        <strong>Created At:</strong> 
                        <?php 
                            $created_at = new DateTime($user['created_at']);
                            echo htmlspecialchars($created_at->format('F j, Y | g:i A'));
                        ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-calendar-check me-2 text-primary"></i>
                        <strong>Last Updated:</strong> 
                        <?php 
                            $updated_at = new DateTime($user['updated_at']);
                            echo htmlspecialchars($updated_at->format('F j, Y | g:i A'));
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>