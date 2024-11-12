<div class="modal fade" id="addResidentModal" tabindex="-1" aria-labelledby="addResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title gradient-text" id="addResidentModalLabel"><i class='bx bx-plus'></i> Add New Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form id="addResidentForm">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addLastname" name="lastname" placeholder=" ">
                            <label for="addLastname" class="form-label">Lastname</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addFirstname" name="firstname" placeholder=" ">
                            <label for="addFirstname" class="form-label">Firstname</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addMiddlename" name="middlename" placeholder=" ">
                            <label for="addMiddlename" class="form-label">Middlename</label>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="date" class="form-control" id="addDateOfBirth" name="date_of_birth" placeholder=" ">
                            <label for="addDateOfBirth" class="form-label">Date of Birth</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addOccupation" name="occupation" placeholder=" ">
                            <label for="addOccupation" class="form-label">Occupation</label>
                        </div>
                        <div class="col-md-4">
                            <div class="">
                                <select class="form-select" id="addCivilStatus" name="civil_status">
                                    <option value="" disabled selected>Select Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Legally Separated">Legally Separated</option>
                                </select>
                                <label for="addCivilStatus" class="form-label">Civil Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <input type="tel" class="form-control" id="addPhoneNumber" name="phone_number" placeholder=" ">
                            <label for="addPhoneNumber" class="form-label">Phone Number(N/A if none)</label>
                        </div>
                        <div class="col-md-4">
                            <input type="email" class="form-control" id="addEmail" name="email" placeholder=" ">
                            <label for="addEmail" class="form-label">Email(N/A if none)</label>
                        </div>
                        <div class="col-md-4">
                            <div>
                                <select class="form-select" id="addSex" name="sex">
                                    <option value="" disabled selected>Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <label for="addSex" class="form-label">Sex</label>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <select class="form-select" id="addAddressName" name="address_id">
                                <option value="" disabled selected>Select Address</option>
                                <?php foreach ($addresses as $address): ?>
                                    <option value="<?php echo $address['address_id']; ?>">
                                        <?php echo $address['address_name']; ?>
                                    </option>
                                    <?php endforeach; ?>
                            </select>
                            <label for="addAddressName" class="form-label">Address</label>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <select class="form-select" id="addEducation" name="educational_attainment">
                                <option value="" disabled selected>Select Education Level</option>
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                                <option value="Highschool Graduate">Highschool Graduate</option>
                                <option value="Highschool Undergraduate">Highschool Undergraduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="College Undergraduate">College Undergraduate</option>
                            </select>
                            <label for="addEducation" class="form-label">Educational Attainment</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addReligion" name="religion" placeholder=" ">
                            <label for="addReligion" class="form-label">Religion</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="addCitizenship" name="citizenship" placeholder=" ">
                            <label for="addCitizenship" class="form-label">Citizenship</label>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="addUsername" name="username" placeholder=" ">
                            <label for="addUsername" class="form-label">Username</label>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="addPassword" name="password" placeholder=" ">
                            <label for="addPassword" class="form-label">Password</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="addResidentForm">Add Resident</button>
            </div>
        </div>
    </div>
</div>
