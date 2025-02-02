<!-- Modal for adding a new medicine -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="addMedicineModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMedicineModalLabel">Add New Medicine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new medicine -->
                <form method="POST" action="../controllers/midwife_add_medicine.php">
                    <div class="mb-3">
                        <label for="batchNumber" class="form-label">Batch Number</label>
                        <input type="text" class="form-control" id="batchNumber" name="batch_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="medicineName" class="form-label">Medicine Name</label>
                        <input type="text" class="form-control" id="medicineName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="genericName" class="form-label">Generic Name</label>
                        <input type="text" class="form-control" id="genericName" name="generic_name">
                    </div>
                    <div class="mb-3">
                        <label for="dosage" class="form-label">Dosage</label>
                        <input type="text" class="form-control" id="dosage" name="dosage" required>
                    </div>
                    <div class="mb-3">
                        <label for="form" class="form-label">Form</label>
                        <select class="form-select" id="form" name="form" required>
                            <option value="Tablet">Tablet</option>
                            <option value="Capsule">Capsule</option>
                            <option value="Syrup">Syrup</option>
                            <option value="Injection">Injection</option>
                            <option value="Cream">Cream</option>
                            <option value="Ointment">Ointment</option>
                            <option value="Lotion">Lotion</option>
                            <option value="Gel">Gel</option>
                            <option value="Drops">Drops</option>
                            <option value="Powder">Powder</option>
                            <option value="Granules">Granules</option>
                            <option value="Inhaler">Inhaler</option>
                            <option value="Suppository">Suppository</option>
                            <option value="Patch">Patch</option>
                            <option value="Spray">Spray</option>
                            <option value="Solution">Solution</option>
                            <option value="Suspension">Suspension</option>
                            <option value="Emulsion">Emulsion</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="date" class="form-control" id="expiryDate" name="expiry_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantityInStock" class="form-label">Quantity in Stock</label>
                        <input type="number" class="form-control" id="quantityInStock" name="quantity_in_stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" name="add_medicine" class="btn btn-primary">Save Medicine</button>
                </form>
            </div>
        </div>
    </div>
</div>