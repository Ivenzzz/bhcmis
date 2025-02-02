<!-- Edit Button -->
<div class="card">
    <div class="card-header bg-sky-500 text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="fas fa-id-card me-2"></i>Personal Information
        </h5>
        <button type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#editPersonalInfo">
            <i class="fas fa-edit me-2"></i>Edit Personal Info
        </button>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-signature me-2 text-primary"></i>
                        <strong>Name:</strong> 
                        <?php echo htmlspecialchars($bhw_info['lastname']) ?>, 
                        <?php echo htmlspecialchars($bhw_info['firstname']) ?> 
                        <?php echo htmlspecialchars($bhw_info['middlename']) ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-birthday-cake me-2 text-primary"></i>
                        <strong>Date of Birth:</strong> <?php echo htmlspecialchars($bhw_info['date_of_birth']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-heart me-2 text-primary"></i>
                        <strong>Civil Status:</strong> <?php echo htmlspecialchars($bhw_info['civil_status']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                        <strong>Education:</strong> <?php echo htmlspecialchars($bhw_info['educational_attainment']); ?>
                    </p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-briefcase me-2 text-primary"></i>
                        <strong>Occupation:</strong> <?php echo htmlspecialchars($bhw_info['occupation']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-pray me-2 text-primary"></i>
                        <strong>Religion:</strong> <?php echo htmlspecialchars($bhw_info['religion']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-globe me-2 text-primary"></i>
                        <strong>Citizenship:</strong> <?php echo htmlspecialchars($bhw_info['citizenship']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-venus-mars me-2 text-primary"></i>
                        <strong>Sex:</strong> <?php echo htmlspecialchars($bhw_info['sex']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <strong>Phone:</strong> <?php echo htmlspecialchars($bhw_info['phone_number']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <strong>Email:</strong> <?php echo htmlspecialchars($bhw_info['email']); ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Signature Display Section -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="info-item">
                    <p class="mb-2">
                        <i class="fas fa-signature me-2 text-primary"></i>
                        <strong>Digital Signature:</strong>
                    </p>
                    <?php if (!empty($bhw_info['signature_path'])): ?>
                        <div class="signature-container border p-3 rounded bg-light" style="max-width: 400px;">
                            <img src="<?php echo htmlspecialchars($bhw_info['signature_path']); ?>" 
                                 alt="Midwife Signature" 
                                 class="img-fluid"
                                 style="max-height: 150px; width: auto;">
                        </div>
                    <?php else: ?>
                        <div class="text-muted fst-italic p-2">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            No digital signature available
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editPersonalInfo" tabindex="-1" aria-labelledby="editPersonalInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-sky-500 text-white">
                <h5 class="modal-title" id="editPersonalInfoLabel"><i class="fas fa-edit me-2"></i>Edit Personal Information</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update_personal_info.php" method="POST">
                <div class="modal-body"> 
                    <input type="hidden" name="personal_info_id" value="<?php echo htmlspecialchars($bhw_info['personal_info_id']); ?>">
                    
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastname" 
                                   value="<?php echo htmlspecialchars($bhw_info['lastname']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" 
                                   value="<?php echo htmlspecialchars($bhw_info['firstname']); ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" 
                                   value="<?php echo htmlspecialchars($bhw_info['middlename']); ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" 
                                   value="<?php echo htmlspecialchars($bhw_info['date_of_birth']); ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Civil Status</label>
                            <select class="form-select" name="civil_status">
                                <option value="Single" <?php echo ($bhw_info['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?php echo ($bhw_info['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                <option value="Widowed" <?php echo ($bhw_info['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                <option value="Legally Separated" <?php echo ($bhw_info['civil_status'] == 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Educational Attainment</label>
                            <select class="form-select" name="educational_attainment">
                                <option value="Elementary Graduate" <?php echo ($bhw_info['educational_attainment'] == 'Elementary Graduate') ? 'selected' : ''; ?>>Elementary Graduate</option>
                                <option value="Elementary Undergraduate" <?php echo ($bhw_info['educational_attainment'] == 'Elementary Undergraduate') ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                <option value="Highschool Graduate" <?php echo ($bhw_info['educational_attainment'] == 'Highschool Graduate') ? 'selected' : ''; ?>>Highschool Graduate</option>
                                <option value="Highschool Undergraduate" <?php echo ($bhw_info['educational_attainment'] == 'Highschool Undergraduate') ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                <option value="College Graduate" <?php echo ($bhw_info['educational_attainment'] == 'College Graduate') ? 'selected' : ''; ?>>College Graduate</option>
                                <option value="College Undergraduate" <?php echo ($bhw_info['educational_attainment'] == 'College Undergraduate') ? 'selected' : ''; ?>>College Undergraduate</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Occupation</label>
                            <input type="text" class="form-control" name="occupation" 
                                   value="<?php echo htmlspecialchars($bhw_info['occupation']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Religion</label>
                            <input type="text" class="form-control" name="religion" 
                                   value="<?php echo htmlspecialchars($bhw_info['religion']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Citizenship</label>
                            <input type="text" class="form-control" name="citizenship" 
                                   value="<?php echo htmlspecialchars($bhw_info['citizenship']); ?>">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Sex</label>
                            <select class="form-select" name="sex">
                                <option value="male" <?php echo ($bhw_info['sex'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo ($bhw_info['sex'] == 'female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" name="phone_number" 
                                   value="<?php echo htmlspecialchars($bhw_info['phone_number']); ?>" 
                                   pattern="[0-9]{11}">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" 
                                   value="<?php echo htmlspecialchars($bhw_info['email']); ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sky-500">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>