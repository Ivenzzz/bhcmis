<div class="modal fade" id="updateWifeModal" tabindex="-1" aria-labelledby="updateWifeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateWifeModalLabel">Update Wife of Family - <?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../controllers/bhw_update_head_of_family.php" method="POST">
                <div class="modal-body">
                    <!-- Hidden fields -->
                    <input type="hidden" name="personal_info_id" value="<?php echo htmlspecialchars($wife['personal_info_id'] ?? ''); ?>">
                    <input type="hidden" name="household_id" value="<?php echo htmlspecialchars($household_id ?? ''); ?>">
                    <input type="hidden" name="family_id" value="<?php echo htmlspecialchars($family_id ?? ''); ?>">
                    
                    <!-- Pre-fill the form fields with the current values of the head of the family -->
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars($wife['firstname'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="middlename" class="form-label">Middle Name</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo htmlspecialchars($wife['middlename'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars($wife['lastname'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="occupation" class="form-label">Occupation</label>
                        <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($wife['occupation'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?php echo htmlspecialchars($wife['religion'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="citizenship" class="form-label">Citizenship</label>
                        <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo htmlspecialchars($wife['citizenship'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($wife['phone_number'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($wife['email'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo htmlspecialchars($wife['date_of_birth'] ?? ''); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex</label>
                        <select class="form-control" id="sex" name="sex" required>
                            <option value="male" <?php echo ($wife['sex'] === 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo ($wife['sex'] === 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="civil_status" class="form-label">Civil Status</label>
                        <select class="form-control" id="civil_status" name="civil_status" required>
                            <option value="Single" <?php echo ($wife['civil_status'] === 'Single') ? 'selected' : ''; ?>>Single</option>
                            <option value="Married" <?php echo ($wife['civil_status'] === 'Married') ? 'selected' : ''; ?>>Married</option>
                            <option value="Widowed" <?php echo ($wife['civil_status'] === 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                            <option value="Legally Separated" <?php echo ($wife['civil_status'] === 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="educational_attainment" class="form-label">Educational Attainment</label>
                        <select class="form-control" id="educational_attainment" name="educational_attainment" required>
                            <option value="Elementary Graduate" <?php echo ($wife['educational_attainment'] === 'Elementary Graduate') ? 'selected' : ''; ?>>Elementary Graduate</option>
                            <option value="Elementary Undergraduate" <?php echo ($wife['educational_attainment'] === 'Elementary Undergraduate') ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                            <option value="Highschool Graduate" <?php echo ($wife['educational_attainment'] === 'Highschool Graduate') ? 'selected' : ''; ?>>Highschool Graduate</option>
                            <option value="Highschool Undergraduate" <?php echo ($wife['educational_attainment'] === 'Highschool Undergraduate') ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                            <option value="College Graduate" <?php echo ($wife['educational_attainment'] === 'College Graduate') ? 'selected' : ''; ?>>College Graduate</option>
                            <option value="College Undergraduate" <?php echo ($wife['educational_attainment'] === 'College Undergraduate') ? 'selected' : ''; ?>>College Undergraduate</option>
                        </select>
                    </div>
                    <!-- Checkboxes for Additional Fields -->
                    <div class="mb-3">
                        <label for="isTransferred" class="form-check-label">Transferred</label>
                        <input type="checkbox" class="form-check-input" id="isTransferred" name="isTransferred" value="1" <?php echo ($wife['isTransferred'] ? 'checked' : ''); ?>>
                    </div>
                    <div class="mb-3">
                        <label for="isDeceased" class="form-check-label">Deceased</label>
                        <input type="checkbox" class="form-check-input" id="isDeceased" name="isDeceased" value="1" <?php echo ($wife['isDeceased'] ? 'checked' : ''); ?>>
                    </div>
                    <div class="mb-3" id="deceased_date_div" style="display: <?php echo ($wife['isDeceased'] ? 'block' : 'none'); ?>;">
                        <label for="deceased_date" class="form-label">Date of Death</label>
                        <input type="date" class="form-control" id="deceased_date" name="deceased_date" value="<?php echo htmlspecialchars($wife['deceased_date'] ?? ''); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="isRegisteredVoter" class="form-check-label">Registered Voter</label>
                        <input type="checkbox" class="form-check-input" id="isRegisteredVoter" name="isRegisteredVoter" value="1" <?php echo ($wife['isRegisteredVoter'] ? 'checked' : ''); ?>>
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
