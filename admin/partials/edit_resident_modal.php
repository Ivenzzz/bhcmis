<?php foreach ($residents_data as $index => $resident): ?>
    <div class="modal fade" id="editResidentPersonalModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="editResidentPersonalModalLabel<?php echo $index; ?>" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title gradient-text" id="editResidentPersonalModalLabel<?php echo $index; ?>"><i class='bx bx-edit'></i> Edit Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editResidentPersonalForm<?php echo $index; ?>" onsubmit="submitEditForm(event, <?php echo $index; ?>)">
                        <input type="hidden" name="resident_id" value="<?php echo $resident['resident_id']; ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editLastname<?php echo $index; ?>" name="lastname" value="<?php echo $resident['lastname']?>" placeholder=" ">
                                <label for="editLastname<?php echo $index; ?>" class="form-label">Lastname</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editFirstname<?php echo $index; ?>" name="firstname" value="<?php echo $resident['firstname']?>" placeholder=" ">
                                <label for="editFirstname<?php echo $index; ?>" class="form-label">Firstname</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editMiddlename<?php echo $index; ?>" name="middlename" value="<?php echo $resident['middlename']?>" placeholder=" ">
                                <label for="editMiddlename<?php echo $index; ?>" class="form-label">Middlename</label>
                            </div>
                        </div>
            
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="date" class="form-control" id="editDateOfBirth<?php echo $index; ?>" name="date_of_birth" value="<?php echo $resident['date_of_birth']?>" placeholder=" ">
                                <label for="editDateOfBirth<?php echo $index; ?>" class="form-label">Date of Birth</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editOccupation<?php echo $index; ?>" name="occupation" value="<?php echo $resident['occupation']?>" placeholder=" ">
                                <label for="editOccupation<?php echo $index; ?>" class="form-label">Occupation</label>
                            </div>
                            <div class="col-md-4">
                                <select class="form-select" id="editCivilStatus<?php echo $index; ?>" name="civil_status">
                                    <option value="" disabled selected>Select Civil Status</option>
                                    <option value="Single" <?php echo $resident['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                                    <option value="Married" <?php echo $resident['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                                    <option value="Widowed" <?php echo $resident['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                    <option value="Legally Separated" <?php echo $resident['civil_status'] == 'Legally Separated' ? 'selected' : ''; ?>>Legally Separated</option>
                                </select>
                                <label for="editCivilStatus<?php echo $index; ?>" class="form-label">Civil Status</label>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <input type="tel" class="form-control" id="editPhoneNumber<?php echo $index; ?>" name="phone_number" value="<?php echo $resident['phone_number']?>" placeholder=" ">
                                <label for="editPhoneNumber<?php echo $index; ?>" class="form-label">Phone Number(N/A if none)</label>
                            </div>
                            <div class="col-md-4">
                                <input type="email" class="form-control" id="editEmail<?php echo $index; ?>" name="email" value="<?php echo $resident['email']?>" placeholder=" ">
                                <label for="editEmail<?php echo $index; ?>" class="form-label">Email(N/A if none)</label>
                            </div>
                            <div class="col-md-4">
                                <div>
                                    <select class="form-select" id="editSex<?php echo $index; ?>" name="sex">
                                        <option value="Male" <?php echo $resident['sex'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo $resident['sex'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                </div>
                                <label for="editSex<?php echo $index; ?>" class="form-label">Sex</label>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <select class="form-select" id="editAddressName<?php echo $index; ?>" name="address_id">
                                    <option value="" disabled selected>Select Address</option>
                                    <?php foreach ($addresses as $address): ?>
                                        <option value="<?php echo $address['address_id']; ?>" 
                                        <?php echo (isset($resident['address_id']) && $resident['address_id'] == $address['address_id']) ? 'selected' : ''; ?>>
                                        <?php echo $address['address_name']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="editAddressName<?php echo $index; ?>" class="form-label">Address</label>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <select class="form-control" id="editEducation<?php echo $index; ?>" name="educational_attainment">
                                    <option value="" disabled selected>Select Education Level</option>
                                    <option value="Elementary Graduate" <?php echo $resident['educational_attainment'] == 'Elementary Graduate' ? 'selected' : ''; ?>>Elementary Graduate</option>
                                    <option value="Elementary Undergraduate" <?php echo $resident['educational_attainment'] == 'Elementary Undergraduate' ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                    <option value="Highschool Graduate" <?php echo $resident['educational_attainment'] == 'Highschool Graduate' ? 'selected' : ''; ?>>Highschool Graduate</option>
                                    <option value="Highschool Undergraduate" <?php echo $resident['educational_attainment'] == 'Highschool Undergraduate' ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                    <option value="College Graduate" <?php echo $resident['educational_attainment'] == 'College Graduate' ? 'selected' : ''; ?>>College Graduate</option>
                                    <option value="College Undergraduate" <?php echo $resident['educational_attainment'] == 'College Undergraduate' ? 'selected' : ''; ?>>College Undergraduate</option>
                                </select>
                                <label for="editEducation<?php echo $index; ?>" class="form-label">Educational Attainment</label>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editReligion<?php echo $index; ?>" name="religion" value="<?php echo $resident['religion']?>" placeholder=" ">
                                <label for="editReligion<?php echo $index; ?>" class="form-label">Religion</label>
                            </div>

                            <div class="col-md-4">
                                <input type="text" class="form-control" id="editCitizenship<?php echo $index; ?>" name="citizenship" value="<?php echo $resident['citizenship']?>" placeholder=" ">
                                <label for="editCitizenship<?php echo $index; ?>" class="form-label">Citizenship</label>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="editResidentPersonalForm<?php echo $index; ?>">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
