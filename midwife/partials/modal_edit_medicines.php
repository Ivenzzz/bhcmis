<!-- Edit Medicine Modal -->
<div class="modal fade" id="editMedicineModal<?= $medicine['medicine_id'] ?>" tabindex="-1" aria-labelledby="editMedicineModalLabel<?= $medicine['medicine_id'] ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMedicineModalLabel<?= $medicine['medicine_id'] ?>">Edit Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="../controllers/midwife_update_medicine.php">
                <div class="modal-body">
                    <input type="hidden" name="medicine_id" value="<?= $medicine['medicine_id'] ?>">

                    <div class="mb-3">
                        <label for="batch_number<?= $medicine['medicine_id'] ?>" class="form-label">Batch Number</label>
                        <input type="text" class="form-control" id="batch_number<?= $medicine['medicine_id'] ?>" name="batch_number" value="<?= htmlspecialchars($medicine['batch_number']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name<?= $medicine['medicine_id'] ?>" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name<?= $medicine['medicine_id'] ?>" name="name" value="<?= htmlspecialchars($medicine['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="generic_name<?= $medicine['medicine_id'] ?>" class="form-label">Generic Name</label>
                        <input type="text" class="form-control" id="generic_name<?= $medicine['medicine_id'] ?>" name="generic_name" value="<?= htmlspecialchars($medicine['generic_name']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dosage<?= $medicine['medicine_id'] ?>" class="form-label">Dosage</label>
                        <input type="text" class="form-control" id="dosage<?= $medicine['medicine_id'] ?>" name="dosage" value="<?= htmlspecialchars($medicine['dosage']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="form<?= $medicine['medicine_id'] ?>" class="form-label">Form</label>
                        <input type="text" class="form-control" id="form<?= $medicine['medicine_id'] ?>" name="form" value="<?= htmlspecialchars($medicine['form']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date<?= $medicine['medicine_id'] ?>" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="expiry_date<?= $medicine['medicine_id'] ?>" name="expiry_date" value="<?= htmlspecialchars($medicine['expiry_date']) ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantity_in_stock<?= $medicine['medicine_id'] ?>" class="form-label">Quantity in Stock</label>
                        <input type="number" class="form-control" id="quantity_in_stock<?= $medicine['medicine_id'] ?>" name="quantity_in_stock" value="<?= htmlspecialchars($medicine['quantity_in_stock']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description<?= $medicine['medicine_id'] ?>" class="form-label">Description</label>
                        <textarea class="form-control" id="description<?= $medicine['medicine_id'] ?>" name="description"><?= htmlspecialchars($medicine['description']) ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>