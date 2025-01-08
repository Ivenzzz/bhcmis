<?php if ($appointments && count($appointments) > 0): ?>
    <div class="row mb-4">
        <?php foreach ($appointments as $appointment): ?>
            <div class="col-12 col-md-6 p-2 appointment-card p-4" data-status="<?= htmlspecialchars($appointment['status']); ?>">
                <div class="card h-100 bg-sky-100 shadow">
                    <div class="card-body">
                        <div class="row">
                            <!-- Date Section -->
                            <div class="col-12 col-md-4 mb-4">
                                <h5 class="card-title mb-0">
                                    <?php
                                    $date = new DateTime($appointment['schedule_date'] ?? 'now'); // Use schedule_date from the DB
                                    echo $date->format('F');
                                    ?>
                                </h5>
                                <h2 class="text-primary mb-0"><?= $date->format('d'); ?></h2>
                                <h6 class="card-text mb-0"><?= $date->format('Y'); ?></h6>
                                <p class="card-text poppins-light"><?= $date->format('D'); ?></p>
                            </div>
                            
                            <!-- Appointment Details -->
                            <div class="col-12 col-md-8 d-flex flex-column">
                                <h6 class="card-subtitle mb-2 text-muted text-wrap">
                                    Tracking Code: <?= htmlspecialchars($appointment['tracking_code'] ?? 'N/A'); ?>
                                </h6>
                                <p class="mb-1">Time: <?= $date->format('h:i A'); ?></p>
                                <p class="mb-1">Priority Number: <?= htmlspecialchars($appointment['priority_number'] ?? 'N/A'); ?></p>
                                <p class="mb-1">
                                    Status: 
                                    <span class="badge 
                                        <?= htmlspecialchars($appointment['status'] === 'Cancelled' ? 'bg-danger' : ''); ?>
                                        <?= htmlspecialchars($appointment['status'] === 'Scheduled' ? 'bg-warning' : ''); ?>
                                        <?= htmlspecialchars($appointment['status'] === 'Completed' ? 'bg-success' : ''); ?>
                                        <?= htmlspecialchars($appointment['status'] === 'Missed' ? 'bg-danger' : ''); ?>">
                                        <?= htmlspecialchars($appointment['status'] ?? 'Unknown'); ?>
                                    </span>
                                </p>
                                
                                <!-- Status Buttons -->
                                <?php if ($appointment['status'] === 'Scheduled'): ?>
                                    <button 
                                        class="btn btn-sm btn-danger mt-2 cancel-appointment-btn" 
                                        data-status="<?= htmlspecialchars($appointment['status']); ?>" 
                                        data-appointment-id="<?= htmlspecialchars($appointment['appointment_id']); ?>"
                                        data-tracking-code="<?= htmlspecialchars($appointment['tracking_code']); ?>">
                                        Cancel Appointment
                                    </button>
                                <?php elseif ($appointment['status'] === 'Cancelled'): ?>
                                    <button class="btn btn-sm btn-secondary mt-2" disabled>Cancelled</button>
                                <?php elseif ($appointment['status'] === 'Completed'): ?>
                                    <button class="btn btn-sm btn-success mt-2" disabled>Completed</button>
                                    <a href="immunization_details.php?appointment_id=<?= htmlspecialchars($appointment['appointment_id']); ?>" class="btn btn-sm btn-primary mt-2">View Immunization Result</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p class="text-center">No appointments found.</p>
<?php endif; ?>