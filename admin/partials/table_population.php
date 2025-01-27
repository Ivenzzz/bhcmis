<table id="populationTable" class="table text-center text-xs table-primary open-sans-regular">
    <thead class="table-dark">
        <tr>
            <th>Hacienda/Sitio</th>
            <th>Total Households</th>
            <th>Total Families</th>
            <th>Total Residents</th>
            <th>Total Females</th>
            <th>Total Males</th>
            <th>Total Seniors (60+)</th>
            <th>Total Children (12-)</th>
            <th>Total Transferred</th>
            <th>Total Deceased</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        // Initialize variables for totals
        $total_households = 0;
        $total_families = 0;
        $total_residents = 0;
        $total_females = 0;
        $total_males = 0;
        $total_seniors = 0;
        $total_children = 0;
        $total_transferred = 0;
        $total_deceased = 0;
        ?>

        <?php if (!empty($area_stats)): ?>
            <?php foreach ($area_stats as $stat): 
                // Accumulate totals
                $total_households += $stat['total_households'];
                $total_families += $stat['total_families'];
                $total_residents += $stat['total_residents'];
                $total_females += $stat['total_females'];
                $total_males += $stat['total_males'];
                $total_seniors += $stat['total_seniors'];
                $total_children += $stat['total_children'];
                $total_transferred += $stat['total_transferred'];
                $total_deceased += $stat['total_deceased'];
            ?>
                <tr>
                    <td><?= htmlspecialchars($stat['address_name']) ?></td>
                    <td><?= htmlspecialchars($stat['total_households']) ?></td>
                    <td><?= htmlspecialchars($stat['total_families']) ?></td>
                    <td><?= htmlspecialchars($stat['total_residents']) ?></td>
                    <td><?= htmlspecialchars($stat['total_females']) ?></td>
                    <td><?= htmlspecialchars($stat['total_males']) ?></td>
                    <td><?= htmlspecialchars($stat['total_seniors']) ?></td>
                    <td><?= htmlspecialchars($stat['total_children']) ?></td>
                    <td><?= htmlspecialchars($stat['total_transferred']) ?></td>
                    <td><?= htmlspecialchars($stat['total_deceased']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10" class="text-center">No data available</td>
            </tr>
        <?php endif; ?>
    </tbody>
    <tfoot class="table-dark">
        <tr class="text-center">
            <th class="text-center">Total</th>
            <th class="text-center"><?= $total_households ?></th>
            <th class="text-center"><?= $total_families ?></th>
            <th class="text-center"><?= $total_residents ?></th>
            <th class="text-center"><?= $total_females ?></th>
            <th class="text-center"><?= $total_males ?></th>
            <th class="text-center"><?= $total_seniors ?></th>
            <th class="text-center"><?= $total_children ?></th>
            <th class="text-center"><?= $total_transferred ?></th>
            <th class="text-center"><?= $total_deceased ?></th>
        </tr>
    </tfoot>
</table>