<!-- Edit Button -->
<div class="card">
    <div class="card-header bg-sky-500 text-white d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">
            <i class="fas fa-id-card me-2"></i>Personal Information
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-signature me-2 text-primary"></i>
                        <strong>Name:</strong> 
                        <?php echo htmlspecialchars($resident_info['lastname']) ?>, 
                        <?php echo htmlspecialchars($resident_info['firstname']) ?> 
                        <?php echo htmlspecialchars($resident_info['middlename']) ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-birthday-cake me-2 text-primary"></i>
                        <strong>Date of Birth:</strong> <?php echo htmlspecialchars($resident_info['date_of_birth']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-heart me-2 text-primary"></i>
                        <strong>Civil Status:</strong> <?php echo htmlspecialchars($resident_info['civil_status']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-graduation-cap me-2 text-primary"></i>
                        <strong>Education:</strong> <?php echo htmlspecialchars($resident_info['educational_attainment']); ?>
                    </p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-briefcase me-2 text-primary"></i>
                        <strong>Occupation:</strong> <?php echo htmlspecialchars($resident_info['occupation']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-pray me-2 text-primary"></i>
                        <strong>Religion:</strong> <?php echo htmlspecialchars($resident_info['religion']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-globe me-2 text-primary"></i>
                        <strong>Citizenship:</strong> <?php echo htmlspecialchars($resident_info['citizenship']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-venus-mars me-2 text-primary"></i>
                        <strong>Sex:</strong> <?php echo htmlspecialchars($resident_info['sex']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-phone me-2 text-primary"></i>
                        <strong>Phone:</strong> <?php echo htmlspecialchars($resident_info['phone_number']); ?>
                    </p>
                </div>
                <div class="info-item mb-3">
                    <p class="mb-1">
                        <i class="fas fa-envelope me-2 text-primary"></i>
                        <strong>Email:</strong> <?php echo htmlspecialchars($resident_info['email']); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>