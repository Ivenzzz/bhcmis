<div class="modal fade" id="approveModal<?= $resident['resident_id'] ?>" tabindex="-1" aria-labelledby="approveModalLabel<?= $resident['resident_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel<?= $resident['resident_id'] ?>">Approve Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="mb-3">Personal Information</h5>
                <p><strong>Full Name:</strong> <?= htmlspecialchars($resident['firstname'] . ' ' . $resident['middlename'] . ' ' . $resident['lastname']) ?></p>
                <p><strong>Date of Birth:</strong> <?= htmlspecialchars($resident['date_of_birth'] ?? 'N/A') ?></p>
                <p><strong>Sex:</strong> <?= htmlspecialchars($resident['sex'] ?? 'N/A') ?></p>
                <p><strong>Civil Status:</strong> <?= htmlspecialchars($resident['civil_status'] ?? 'N/A') ?></p>
                <p><strong>Educational Attainment:</strong> <?= htmlspecialchars($resident['educational_attainment'] ?? 'N/A') ?></p>
                <p><strong>Occupation:</strong> <?= htmlspecialchars($resident['occupation'] ?? 'N/A') ?></p>
                <p><strong>Religion:</strong> <?= htmlspecialchars($resident['religion'] ?? 'N/A') ?></p>
                <p><strong>Citizenship:</strong> <?= htmlspecialchars($resident['citizenship'] ?? 'N/A') ?></p>
                <p><strong>Phone Number:</strong> <?= htmlspecialchars($resident['phone_number'] ?? 'N/A') ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($resident['email'] ?? 'N/A') ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($resident['address_name'] ?? 'N/A') ?></p>
                <p><strong>ID Picture:</strong></p>

                <?php if (!empty($resident['id_picture'])): ?>
                    <img src="<?= htmlspecialchars($resident['id_picture']) ?>" alt="ID Picture" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                <?php else: ?>
                    <p>N/A</p>
                <?php endif; ?>

                <hr>

                <h5 class="mb-3">Account Information</h5>
                <p><strong>Username:</strong> <?= htmlspecialchars($resident['username'] ?? 'N/A') ?></p>
                <p><strong>Role:</strong> <?= htmlspecialchars($resident['role'] ?? 'N/A') ?></p>
                <p><strong>Profile Picture:</strong></p>

                <?php if (!empty($resident['profile_picture'])): ?>
                    <img src="<?= htmlspecialchars($resident['profile_picture']) ?>" alt="Profile Picture" style="max-width: 100%; height: auto; border: 1px solid #ccc; padding: 5px;">
                <?php else: ?>
                    <p>N/A</p>
                <?php endif; ?>

                <p><strong>Account Archived:</strong> <?= $resident['isArchived'] ? 'Yes' : 'No' ?></p>
                <p><strong>Account Valid:</strong> <?= $resident['isValid'] ? 'Yes' : 'No' ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary approve-btn" data-account-id="<?= $resident['account_id'] ?>">Confirm Information and Approve</button>
            </div>
        </div>
    </div>
</div>