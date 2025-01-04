<table id="prenatalSchedulesTable" class="display text-xs text-center">
    <thead>
        <tr>
            <th class="text-center">Date</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($prenatal_schedules as $schedule): ?>
            <tr>
                <td><?= htmlspecialchars(date('F j, Y, g:i A', strtotime($schedule['sched_date']))) ?></td>
                <td>
                    <a href="prenatals_list.php?sched_id=<?= urlencode($schedule['sched_id']) ?>" class="btn btn-info btn-sm">
                        View Prenatals
                    </a>
                    <form action="../controllers/midwife_delete_prenatal_schedule.php" method="POST" style="display:inline;">
                        <input type="hidden" name="sched_id" value="<?= $schedule['sched_id'] ?>">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this schedule?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>