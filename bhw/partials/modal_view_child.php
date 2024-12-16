<!-- Modal for Child -->
<div class="modal fade" id="childInfoModal<?php echo $child['fmember_id']; ?>" tabindex="-1" aria-labelledby="childInfoModalLabel<?php echo $child['fmember_id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="childInfoModalLabel<?php echo $child['fmember_id']; ?>">Child - <?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($child['age'] ?? 'Unknown'); ?></p>
                <p><strong>Occupation:</strong> <?php echo htmlspecialchars($child['occupation'] ?? 'None'); ?></p>
                <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($child['civil_status'] ?? 'Unknown'); ?></p>
                <p><strong>Educational Attainment:</strong> <?php echo htmlspecialchars($child['educational_attainment'] ?? 'Unknown'); ?></p>
            </div>
        </div>
    </div>
</div>