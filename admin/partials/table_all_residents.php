<table id="residentsTable" class="display text-center open-sans-regular mt-4 text-sm" style="width: 100%">
    <thead>
        <tr>
            <th class="text-center">Name</th>
            <th class="text-center">Address</th>
            <th class="text-center">Age</th>
            <th class="text-center">Gender</th>
            <th class="text-center">Civil Status</th>
            <th class="text-center">Registered Voter</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($residents)): ?>
            <?php foreach ($residents as $resident): ?>
                <tr>
                    <td class="position-relative">
                        <?php
                        // Check if the 'created_at' date is today
                        if (isset($resident['created_at']) && date('Y-m-d') == date('Y-m-d', strtotime($resident['created_at']))) {
                            echo '<span class="badge bg-success position-absolute top-0 start-0">New</span>';
                        }
                        ?>
                        <?= htmlspecialchars($resident['firstname'] ?? 'None') . ' ' . htmlspecialchars($resident['lastname'] ?? 'None') ?>
                    </td>
                    <td><?= htmlspecialchars($resident['address_name'] ?? 'None') ?></td>
                    <td><?= htmlspecialchars($resident['age'] ?? 'Not Provided') ?></td>
                    <td><?= htmlspecialchars($resident['sex'] ?? 'None') ?></td>
                    <td><?= htmlspecialchars($resident['civil_status'] ?? 'None') ?></td>
                    <td>
                        <?php if ($resident['isRegisteredVoter']): ?>
                            <i class="fas fa-check-circle text-green-500"></i>
                        <?php else: ?>
                            <i class="fas fa-times-circle text-red-500"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="resident_details.php?resident_id=<?= htmlspecialchars($resident['resident_id'] ?? 'None') ?>" class="btn btn-info btn-sm">View Additional Info</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <?php endif; ?>
    </tbody>
</table>