<?php if ($appointments && count($appointments) > 0): ?>
    <div class="row">
        <?php foreach ($appointments as $appointment): ?>
            <div class="col-md-6 mb-3 p-2 appointment-card" data-status="<?= htmlspecialchars($appointment['status']); ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 text-center">
                                <h5 class="card-title mb-0">
                                    <?php
                                    $date = new DateTime($appointment['con_sched_date'] ?? 'now');
                                    echo $date->format('F');
                                    ?>
                                </h5>
                                <h2 class="text-primary">
                                    <?= $date->format('d'); ?>
                                </h2>
                                <p class="card-text"><?= $date->format('D'); ?></p>
                            </div>
                            <div class="col-1 text-center">
                                <div class="vertical-divider"></div> <!-- Vertical Divider -->
                            </div>
                            <div class="col-8">
                                <h6 class="card-subtitle mb-2 text-muted">
                                    Tracking Code: <?= htmlspecialchars($appointment['tracking_code'] ?? 'N/A'); ?>
                                </h6>
                                <p class="mb-1">Time: <?= $date->format('h:i A'); ?></p>
                                <p class="mb-1">Priority Number: <?= htmlspecialchars($appointment['priority_number'] ?? 'N/A'); ?></p>
                                <p class="mb-1">
                                    Status: 
                                    <span class="badge 
                                        <?= htmlspecialchars($appointment['status'] === 'Cancelled' ? 'bg-danger' : ''); ?>
                                        <?= htmlspecialchars($appointment['status'] === 'Scheduled' ? 'bg-warning' : ''); ?>
                                        <?= htmlspecialchars($appointment['status'] === 'Completed' ? 'bg-success' : ''); ?>">
                                        <?= htmlspecialchars($appointment['status'] ?? 'Unknown'); ?>
                                    </span>
                                </p>
                                <?php if ($appointment['status'] === 'Scheduled'): ?>
                                    <form action="./app/controllers/residents/cancel_appointment.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="tracking_code" value="<?= htmlspecialchars($appointment['tracking_code']); ?>">
                                        <button type="submit" class="btn btn-sm btn-danger mt-2">Cancel Appointment</button>
                                    </form>
                                <?php elseif ($appointment['status'] === 'Cancelled'): ?>
                                    <button class="btn btn-sm btn-secondary mt-2" disabled>Cancelled</button>
                                <?php elseif ($appointment['status'] === 'Completed'): ?>
                                    <button class="btn btn-sm btn-success mt-2" disabled>Completed</button>
                                    <a href="r-consultations?appointment_id=<?= htmlspecialchars($appointment['appointment_id']); ?>" class="btn btn-sm btn-primary mt-2">View Consultation Result</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No appointments found.</p>
<?php endif; ?>


