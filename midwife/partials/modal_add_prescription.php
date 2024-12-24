<div class="modal fade" id="addPrescriptionModal" tabindex="-1" aria-labelledby="addPrescriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPrescriptionModalLabel">Add Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPrescriptionForm" method="POST" action="../controllers/midwife_add_prescription.php">
                    <!-- Hidden fields for consultation_id and con_sched_id -->
                    <input type="hidden" name="consultation_id" id="consultation_id" value="<?php echo $consultation_id; ?>">
                    <input type="hidden" name="con_sched_id" id="con_sched_id" value="<?php echo $consultation_schedule_id; ?>">

                    <div class="mb-3">
                        <label for="medicineDropdown" class="form-label">Select Medicine</label>
                        <select class="form-select" id="medicineDropdown" name="medicine_id" required>
                            <option value="" disabled selected>Select Medicine</option>
                            <?php foreach ($medicines as $medicine): ?>
                                <option value="<?php echo htmlspecialchars($medicine['medicine_id']); ?>">
                                    <?php echo htmlspecialchars($medicine['name']); ?> (Stock: <?php echo htmlspecialchars($medicine['quantity_in_stock']); ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="instructions" class="form-label">Instructions</label>
                        <textarea class="form-control" id="instructions" name="instructions" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Prescription</button>
                </form>
            </div>
        </div>
    </div>
</div>