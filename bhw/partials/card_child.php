<div class="col-md-4 mx-auto">
    <div class="card text-center shadow bg-green-100 position-relative member-card">
        <div class="card-body">
            <h5 class="card-title text-info">Child</h5>
            <div class="card-text">
                <p class="fw-bold"><?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></p>
                <p>Age: <span class="text-muted"><?php echo htmlspecialchars($child['age'] ?? 'Unknown'); ?></span></p>
                <p>Sex: <span class="text-muted"><?php echo htmlspecialchars($child['sex'] ?? 'Unknown'); ?></span></p>
            </div>
        </div>
        <div class="card-actions position-absolute d-none">
            <button class="btn btn-sm btn-warning mb-2" data-bs-toggle="modal" data-bs-target="#updateChildModal">Update</button>
            <button class="btn btn-sm btn-danger mb-2 delete-member-btn" data-id="<?php echo htmlspecialchars($child['fmember_id']); ?>">Delete</button>
            <button class="btn btn-sm btn-info mb-2" data-bs-toggle="modal" data-bs-target="#childInfoModal<?php echo $child['fmember_id']; ?>">View Info</button>
            <?php if ($child['child_family_id']): ?>
                <a href="family_members.php?family_id=<?php echo htmlspecialchars($child['child_family_id']); ?>&household_id=<?php echo htmlspecialchars($household_id); ?>" class="btn btn-sm btn-info mb-2">Own Family</a>
            <?php endif; ?>
        </div>
    </div>
</div>