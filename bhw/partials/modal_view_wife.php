<!-- Modal for Head of Family (View Info) -->
<div class="modal fade" id="wifeInfoModal" tabindex="-1" aria-labelledby="headInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="wifeInfoModalLabel">Wife of Family - <?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['middlename'] . ' ' . $wife['lastname']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($wife['age']); ?></p>
                <p><strong>Sex:</strong> <?php echo htmlspecialchars($wife['sex']); ?></p>
                <p><strong>Occupation:</strong> <?php echo htmlspecialchars($wife['occupation'] ?? 'None'); ?></p>
                <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($wife['civil_status']); ?></p>
                <p><strong>Educational Attainment:</strong> <?php echo htmlspecialchars($wife['educational_attainment']); ?></p>
                <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($wife['date_of_birth']); ?></p>
                <p><strong>Religion:</strong> <?php echo htmlspecialchars($wife['religion'] ?? 'None'); ?></p>
                <p><strong>Citizenship:</strong> <?php echo htmlspecialchars($wife['citizenship'] ?? 'None'); ?></p>
                <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($wife['phone_number'] ?? 'None'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($wife['email'] ?? 'None'); ?></p>
                <p><strong>ID Picture:</strong> 
                    <?php if ($wife['id_picture']): ?>
                        <img src="<?php echo htmlspecialchars($wife['id_picture']); ?>" alt="ID Picture" class="img-thumbnail" style="max-width: 150px;">
                    <?php else: ?>
                        No ID Picture available.
                    <?php endif; ?>
                </p>
                <p><strong>Voter Status:</strong> <?php echo ($wife['isRegisteredVoter'] ? 'Registered Voter' : 'Not Registered'); ?></p>
                <p><strong>Deceased:</strong> <?php echo ($wife['isDeceased'] ? 'Yes (Deceased on ' . htmlspecialchars($wife['deceased_date']) . ')' : 'No'); ?></p>
                <p><strong>Transferred:</strong> <?php echo ($wife['isTransferred'] ? 'Yes' : 'No'); ?></p>
            </div>
        </div>
    </div>
</div>
