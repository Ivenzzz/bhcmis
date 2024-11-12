<!-- Edit BHW Modal -->
<div class="modal fade" id="editBhwModal<?= $bhw['bhw_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editBhwModalLabel<?= $bhw['bhw_id']; ?>" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBhwModalLabel<?= $bhw['bhw_id']; ?>">Edit Information for <?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['lastname']); ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./app/controllers/admin-bhw/update_bhw.php" method="POST">
                    <input type="hidden" name="bhw_id" value="<?= $bhw['bhw_id']; ?>">
                    <input type="hidden" name="account_id" value="<?= $bhw['account_id']; ?>">
                    <input type="hidden" name="personal_info_id" value="<?= $bhw['personal_info_id']; ?>">

                    <!-- BHW Information: Name, Date of Birth, etc. -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($bhw['firstname']); ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="lastname" value="<?= htmlspecialchars($bhw['lastname']); ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="middlename" value="<?= htmlspecialchars($bhw['middlename']); ?>">
                        </div>
                    </div>

                    <!-- Date of Birth and Age -->
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="date_of_birth" value="<?= htmlspecialchars($bhw['date_of_birth']); ?>">
                        </div>
                    </div>

                    <!-- Civil Status, Educational Attainment, and Occupation -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select name="civil_status" class="form-select" required>
                                <option value="" disabled>Select civil status</option>
                                <option value="Single" <?= $bhw['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                                <option value="Married" <?= $bhw['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                                <option value="Widowed" <?= $bhw['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                <option value="Legally Separated" <?= $bhw['civil_status'] == 'Legally Separated' ? 'selected' : ''; ?>>Legally Separated</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="educational_attainment" class="form-label">Educational Attainment</label>
                            <select name="educational_attainment" class="form-select">
                                <option value="" disabled>Select education level</option>
                                <option value="Elementary Graduate" <?= $bhw['educational_attainment'] == 'Elementary Graduate' ? 'selected' : ''; ?>>Elementary Graduate</option>
                                <option value="Elementary Undergraduate" <?= $bhw['educational_attainment'] == 'Elementary Undergraduate' ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                <option value="Highschool Graduate" <?= $bhw['educational_attainment'] == 'Highschool Graduate' ? 'selected' : ''; ?>>Highschool Graduate</option>
                                <option value="Highschool Undergraduate" <?= $bhw['educational_attainment'] == 'Highschool Undergraduate' ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                <option value="College Graduate" <?= $bhw['educational_attainment'] == 'College Graduate' ? 'selected' : ''; ?>>College Graduate</option>
                                <option value="College Undergraduate" <?= $bhw['educational_attainment'] == 'College Undergraduate' ? 'selected' : ''; ?>>College Undergraduate</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" name="occupation" value="<?= htmlspecialchars($bhw['occupation']); ?>">
                        </div>
                    </div>

                    <!-- Additional Information: Religion, Citizenship, Sex -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" name="religion" value="<?= htmlspecialchars($bhw['religion']); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="citizenship" class="form-label">Citizenship</label>
                            <input type="text" class="form-control" name="citizenship" value="<?= htmlspecialchars($bhw['citizenship']); ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select name="sex" class="form-select" required>
                                <option value="male" <?= $bhw['sex'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?= $bhw['sex'] == 'female' ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- BHW Information: Assigned Area, Employment Status, and Assigned Date -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="assigned_area" class="form-label">Assigned Area</label>
                            <select name="assigned_area" class="form-select" required>
                                <option value="" disabled>Select assigned area</option>
                                <?php foreach ($addresses as $address): ?>
                                    <option value="<?= $address['address_id']; ?>" <?= $address['address_id'] == $bhw['assigned_area'] ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($address['address_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="employment_status" class="form-label">Employment Status</label>
                            <select name="employment_status" class="form-select" required>
                                <option value="active" <?= $bhw['employment_status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                <option value="inactive" <?= $bhw['employment_status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                <option value="on_leave" <?= $bhw['employment_status'] == 'on_leave' ? 'selected' : ''; ?>>On Leave</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="date_started" class="form-label">Date Started</label>
                            <input type="date" class="form-control" name="date_started" value="<?= htmlspecialchars($bhw['date_started']); ?>" required>
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phone_number" value="<?= htmlspecialchars($bhw['phone_number']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($bhw['email']); ?>" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update BHW</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
