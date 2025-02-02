<table class="table text-center text-xs" id="incomingPrenatalsTable">
    <thead class="table-dark">
        <tr>
            <th>Resident Name</th>
            <th>Schedule Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="table-success">
        <?php if (!empty($incoming_prenatals)): ?>
            <?php foreach ($incoming_prenatals as $prenatal): ?>
                <tr>
                    <td><?= htmlspecialchars($prenatal['lastname'] . ', ' . $prenatal['firstname'] . ' ' . $prenatal['middlename']) ?></td>
                    <td><?= htmlspecialchars(date('F j, Y g:i A', strtotime($prenatal['sched_date']))) ?></td>
                    <td><?= htmlspecialchars($prenatal['pregnancy_status']) ?></td>
                    <td>
                        <a href="scheduled_prenatals.php?sched_id=<?= urlencode($prenatal['sched_id']) ?>&search=<?= urlencode($prenatal['lastname'] . ' ' . $prenatal['firstname'] . ' ' . $prenatal['middlename']) ?>" class="btn btn-info btn-sm">View in Schedules</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <?php endif; ?>
    </tbody>
</table>