<!-- Modal for each prenatal record -->
<div class="modal fade" id="prenatalModal<?= $prenatal['prenatal_id'] ?>" tabindex="-1" aria-labelledby="prenatalModalLabel<?= $prenatal['prenatal_id'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prenatalModalLabel<?= $prenatal['prenatal_id'] ?>">Prenatal Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Prenatal details -->
                <p><strong>Tracking Code:</strong> <?= htmlspecialchars($prenatal['tracking_code'] ?? 'None') ?></p>
                <p><strong>Resident Name:</strong> <?= htmlspecialchars($prenatal['firstname'] . ' ' . $prenatal['middlename'] . ' ' . $prenatal['lastname'] ?? 'None') ?></p>
                <p><strong>Age:</strong> <?= htmlspecialchars($prenatal['age'] ?? 'None') ?></p>
                <p><strong>Address:</strong> <?= htmlspecialchars($prenatal['address_name'] ?? 'None') ?> (<?= htmlspecialchars($prenatal['address_type'] ?? 'None') ?>)</p>
                <p><strong>Due Date:</strong> <?= htmlspecialchars(date('F j, Y', strtotime($prenatal['expected_due_date'] ?? 'None'))) ?></p>
                <p><strong>Pregnancy Status:</strong> <?= htmlspecialchars($prenatal['pregnancy_status'] ?? 'None') ?></p>
                <p><strong>Weight:</strong> <?= htmlspecialchars($prenatal['weight'] ?? 'None') ?></p>
                <p><strong>Blood Pressure:</strong> <?= htmlspecialchars($prenatal['blood_pressure'] ?? 'None') ?></p>
                <p><strong>Heart & Lungs Condition:</strong> <?= htmlspecialchars($prenatal['heart_lungs_condition'] ?? 'None') ?></p>
                <p><strong>Abdominal Exam:</strong> <?= htmlspecialchars($prenatal['abdominal_exam'] ?? 'None') ?></p>
                <p><strong>Fetal Heart Rate:</strong> <?= htmlspecialchars($prenatal['fetal_heart_rate'] ?? 'None') ?></p>
                <p><strong>Fundal Height:</strong> <?= htmlspecialchars($prenatal['fundal_height'] ?? 'None') ?></p>
                <p><strong>Fetal Movement:</strong> <?= htmlspecialchars($prenatal['fetal_movement'] ?? 'None') ?></p>
                <p><strong>Checkup Notes:</strong> <?= htmlspecialchars($prenatal['checkup_notes'] ?? 'None') ?></p>
                <p><strong>Refer To:</strong> <?= htmlspecialchars($prenatal['refer_to'] ?? 'None') ?></p>
            </div>
        </div>
    </div>
</div>