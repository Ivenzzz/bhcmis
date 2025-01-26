<table id="familiesTable" class="display text-center align-middle">
    <thead>
        <tr class="text-center">
            <th>Family No.</th>
            <th>Family Name</th>
            <th>Head of Family</th>
            <th>Parent Family</th>
            <th>Number of Members</th>
            <th>4Ps Member</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($families)): ?>
            <?php foreach ($families as $family): ?>
                <tr>
                    <td><?php echo htmlspecialchars($family['family_id'] ?? 'None'); ?></td>
                    <td><?php echo htmlspecialchars($family['family_name'] ?? 'None'); ?></td>
                    <td><?php echo htmlspecialchars($family['head_of_family'] ?? 'None'); ?></td>
                    <td><?php echo htmlspecialchars($family['parent_family'] ?? 'None'); ?></td>
                    <td><?php echo htmlspecialchars($family['number_of_members'] ?? 'None'); ?></td>
                    <td>
                        <?php 
                            if (isset($family['4PsMember'])) {
                                echo $family['4PsMember'] 
                                    ? '<i class="fas fa-check text-green-500"></i>'  // Green check
                                    : '<i class="fas fa-times text-red-500"></i>';  // Red X
                            } else {
                                echo 'None';
                            }
                        ?>
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="family_members.php?family_id=<?php echo htmlspecialchars($family['family_id']); ?>&household_id=<?php echo htmlspecialchars($household_id); ?>" 
                            class="btn btn-success btn-sm me-2">
                            View Members <i class="fa-solid fa-user"></i>
                        </a>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                            data-bs-target="#updateFamilyModal<?php echo htmlspecialchars($family['family_id']); ?>">
                            Update Status <i class="fa-solid fa-edit"></i>
                        </button>
                    </td>
                </tr>

                <?php require 'partials/update_family_modal.php'; ?>

            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No families found for this household.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>