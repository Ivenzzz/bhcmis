<!-- Add Consultation Modal -->
<div class="modal fade" id="addConsultationModal" tabindex="-1" aria-labelledby="addConsultationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="../controllers/midwife_add_resident_consultation.php" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="addConsultationModalLabel">Add Consultation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="sched_id" value="<?= htmlspecialchars($_GET['con_sched_id']) ?>">

                    <div class="mb-3">
                        <label for="resident_id" class="form-label">Resident</label>
                        <select name="resident_id" id="resident_id" class="form-select" required>
                            <option value="">Select Resident</option>
                            <?php foreach ($residents as $resident) : ?>
                                <option value="<?= htmlspecialchars($resident['resident_id']) ?>">
                                    <?= htmlspecialchars($resident['firstname'] . ' ' . $resident['lastname']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="reason_for_visit" class="form-label">Reason for Visit</label>
                        <input type="text" class="form-control" id="reason_for_visit" name="reason_for_visit" placeholder="E.g., Fever, Check-up" required>
                    </div>
                    <div class="mb-3">
                        <label for="symptoms" class="form-label">Symptoms</label>
                        <input type="text" class="form-control" id="symptoms" name="symptoms" placeholder="E.g., Cough, Headache">
                    </div>
                    <div class="mb-3">
                        <label for="weight_kg" class="form-label">Weight (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="weight_kg" name="weight_kg" placeholder="E.g., 65.50">
                    </div>
                    <div class="mb-3">
                        <label for="temperature" class="form-label">Temperature</label>
                        <input type="text" class="form-control" id="temperature" name="temperature" placeholder="E.g., 37.5°C">
                    </div>
                    <div class="mb-3">
                        <label for="heart_rate" class="form-label">Heart Rate</label>
                        <input type="text" class="form-control" id="heart_rate" name="heart_rate" placeholder="E.g., 72 bpm">
                    </div>
                    <div class="mb-3">
                        <label for="respiratory_rate" class="form-label">Respiratory Rate</label>
                        <input type="text" class="form-control" id="respiratory_rate" name="respiratory_rate" placeholder="E.g., 16 breaths/min">
                    </div>
                    <div class="mb-3">
                        <label for="blood_pressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="E.g., 120/80 mmHg">
                    </div>
                    <div class="mb-3">
                        <label for="cholesterol_level" class="form-label">Cholesterol Level</label>
                        <input type="text" class="form-control" id="cholesterol_level" name="cholesterol_level" placeholder="E.g., 190 mg/dL">
                    </div>
                    <div class="mb-3">
                        <label for="physical_findings" class="form-label">Physical Findings</label>
                        <textarea class="form-control" id="physical_findings" name="physical_findings" placeholder="E.g., Swelling on left knee, Rash on right arm"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="refer_to" class="form-label">Refer To</label>
                        <input type="text" class="form-control" id="refer_to" name="refer_to" placeholder="E.g., Specialist, Hospital">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Consultation</button>
                </div>
            </form>
        </div>
    </div>
</div>
