<div class="modal fade" id="updateChildModal" tabindex="-1" aria-labelledby="updateHeadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateChildModalLabel">
                    Update Child of Family - <?php echo htmlspecialchars(($child['firstname'] ?? '') . ' ' . ($child['lastname'] ?? '')); ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/bhw_update_head_of_family.php" method="POST">
                <div class="modal-body">
                    <!-- Hidden fields -->
                    <input type="hidden" name="personal_info_id" value="<?php echo htmlspecialchars($child['personal_info_id'] ?? ''); ?>">
                    <input type="hidden" name="household_id" value="<?php echo htmlspecialchars($household_id ?? ''); ?>">
                    <input type="hidden" name="family_id" value="<?php echo htmlspecialchars($family_id ?? ''); ?>">
                    
                    <!-- Form fields with null-safe handling -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($child['firstname'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo htmlspecialchars($child['middlename'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($child['lastname'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($child['occupation'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($child['religion'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="citizenship" class="form-label">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo htmlspecialchars($child['citizenship'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($child['phone_number'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($child['email'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($child['date_of_birth'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-control" id="sex" name="sex" required>
                            <option value="male" <?php echo (($child['sex'] ?? '') === 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo (($child['sex'] ?? '') === 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status" required>
                            <option value="Single" <?php echo (($child['civil_status'] ?? '') === 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo (($child['civil_status'] ?? '') === 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option value="Widowed" <?php echo (($child['civil_status'] ?? '') === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            <option value="Legally Separated" <?php echo (($child['civil_status'] ?? '') === 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="educational_attainment" class="form-label">Educational Attainment</label>
                        <select class="form-control" id="educational_attainment" name="educational_attainment" required>
                            <option value="Elementary Graduate" <?php echo (($child['educational_attainment'] ?? '') === 'Elementary Graduate') ? 'selected' : ''; ?>>Elementary Graduate</option>
                            <option value="Elementary Undergraduate" <?php echo (($child['educational_attainment'] ?? '') === 'Elementary Undergraduate') ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                            <option value="Highschool Graduate" <?php echo (($child['educational_attainment'] ?? '') === 'Highschool Graduate') ? 'selected' : ''; ?>>Highschool Graduate</option>
                            <option value="Highschool Undergraduate" <?php echo (($child['educational_attainment'] ?? '') === 'Highschool Undergraduate') ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                            <option value="College Graduate" <?php echo (($child['educational_attainment'] ?? '') === 'College Graduate') ? 'selected' : ''; ?>>College Graduate</option>
                            <option value="College Undergraduate" <?php echo (($child['educational_attainment'] ?? '') === 'College Undergraduate') ? 'selected' : ''; ?>>College Undergraduate</option>
                        </select>
                    </div>
                    <!-- Checkboxes for Additional Fields -->
                    <div class="mb-3">
                        <label for="isTransferred" class="form-check-label">Transferred</label>
                        <input type="checkbox" class="form-check-input" id="isTransferred" name="isTransferred" value="1" <?php echo (($child['isTransferred'] ?? false) ? 'checked' : ''); ?>>
                    </div>
                    <div class="mb-3">
                        <label for="isDeceased" class="form-check-label">Deceased</label>
                        <input type="checkbox" class="form-check-input" id="isDeceased" name="isDeceased" value="1" <?php echo (($child['isDeceased'] ?? false) ? 'checked' : ''); ?>>
                    </div>
                    <div class="mb-3" id="deceased_date_div" style="display: <?php echo (($child['isDeceased'] ?? false) ? 'block' : 'none'); ?>;">
                        <label for="deceased_date" class="form-label">Date of Death</label>
                        <input type="date" class="form-control" id="deceased_date" name="deceased_date" value="<?php echo htmlspecialchars($child['deceased_date'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="isRegisteredVoter" class="form-check-label">Registered Voter</label>
                        <input type="checkbox" class="form-check-input" id="isRegisteredVoter" name="isRegisteredVoter" value="1" <?php echo (($child['isRegisteredVoter'] ?? false) ? 'checked' : ''); ?>>
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
