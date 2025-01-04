<div class="row mb-4 shadow">
    <div class="col-md-12 p-4">
        <!-- Container for today's appointments -->
        <h5 class="mb-3">Today's Appointments</h5>
        <?php if ($todays_appointments && count($todays_appointments) > 0): ?>
            <table class="table text-center text-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Tracking Code</th>
                        <th>Resident Name</th>
                        <th>Priority Number</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-secondary">
                    <?php foreach ($todays_appointments as $appointment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($appointment['tracking_code']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['resident_name']); ?></td>
                            <td><?php echo htmlspecialchars($appointment['priority_number']); ?></td>
                            <td class="
                                <?php echo $appointment['status'] === 'Cancelled' ? 'text-danger' : 
                                        ($appointment['status'] === 'Completed' ? 'text-success' : 'text-warning'); ?>">
                                <?php echo htmlspecialchars($appointment['status']); ?>
                            </td>
                            <td><?php echo htmlspecialchars(date('F j, Y | g:i A', strtotime($appointment['appointment_created_at']))); ?></td>
                            <td>
                                <button class="btn btn-info btn-sm">View Info</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center text-muted">No appointments for today.</p>
        <?php endif; ?>
    </div>
</div>