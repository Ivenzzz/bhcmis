<!-- Modal for extra information -->
<div class="modal fade" id="bhwModal<?= $bhw['bhw_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="bhwModalLabel<?= $bhw['bhw_id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bhwModalLabel<?= $bhw['bhw_id']; ?>">More Information about <?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> <?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['middlename'] . ' ' . $bhw['lastname']); ?></p>
                <p><strong>Age:</strong> <?= htmlspecialchars($bhw['age']); ?></p>
                <p><strong>Date of Birth:</strong> <?= htmlspecialchars($bhw['date_of_birth']); ?></p>
                <p><strong>Civil Status:</strong> <?= htmlspecialchars($bhw['civil_status']); ?></p>
                <p><strong>Educational Attainment:</strong> <?= htmlspecialchars($bhw['educational_attainment']); ?></p>
                <p><strong>Occupation:</strong> <?= htmlspecialchars($bhw['occupation']); ?></p>
                <p><strong>Religion:</strong> <?= htmlspecialchars($bhw['religion']); ?></p>
                <p><strong>Citizenship:</strong> <?= htmlspecialchars($bhw['citizenship']); ?></p>
                <p><strong>Phone Number:</strong> <?= htmlspecialchars($bhw['phone_number']); ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($bhw['email']); ?></p>
                <p><strong>Phone Number:</strong> <?= htmlspecialchars($bhw['phone_number']); ?></p>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>