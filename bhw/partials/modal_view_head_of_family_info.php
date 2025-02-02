<!-- Modal for Head of Family (View Info) -->
<div class="modal fade" id="headInfoModal" tabindex="-1" aria-labelledby="headInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="headInfoModalLabel">Head of Family - <?php echo htmlspecialchars($head['firstname'] . ' ' . $head['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($head['firstname'] . ' ' . $head['middlename'] . ' ' . $head['lastname']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($head['age']); ?></p>
                <p><strong>Sex:</strong> <?php echo htmlspecialchars($head['sex']); ?></p>
                <p><strong>Occupation:</strong> <?php echo htmlspecialchars($head['occupation'] ?? 'None'); ?></p>
                <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($head['civil_status']); ?></p>
                <p><strong>Educational Attainment:</strong> <?php echo htmlspecialchars($head['educational_attainment']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($head['date_of_birth']); ?></p>
                <p><strong>Religion:</strong> <?php echo htmlspecialchars($head['religion'] ?? 'None'); ?></p>
                <p><strong>Citizenship:</strong> <?php echo htmlspecialchars($head['citizenship'] ?? 'None'); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($head['phone_number'] ?? 'None'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($head['email'] ?? 'None'); ?></p>
                <p><strong>ID Picture:</strong> 
                    <?php if ($head['id_picture']): ?>
                        <img src="<?php echo htmlspecialchars($head['id_picture']); ?>" alt="ID Picture" class="img-thumbnail" style="max-width: 150px;">
                    <?php else: ?>
                        No ID Picture available.
                    <?php endif; ?>
                </p>
                <p><strong>Voter Status:</strong> <?php echo ($head['isRegisteredVoter'] ? 'Registered Voter' : 'Not Registered'); ?></p>
                <p><strong>Deceased:</strong> <?php echo ($head['isDeceased'] ? 'Yes (Deceased on ' . htmlspecialchars($head['deceased_date']) . ')' : 'No'); ?></p>
                <p><strong>Transferred:</strong> <?php echo ($head['isTransferred'] ? 'Yes' : 'No'); ?></p>
            </div>
        </div>
    </div>
</div>
