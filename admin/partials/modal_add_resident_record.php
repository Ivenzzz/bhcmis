<div class="modal fade" id="createResidentModal" tabindex="-1" aria-labelledby="createResidentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createResidentModalLabel">Create New Resident</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="createResidentForm">
                <div class="modal-body">
                    <div class="alert alert-warning alert-sm" role="alert">
                        <strong>Note:</strong> Fill in all required fields. For optional fields, leave them blank if the information is unknown.
                    </div>
                    <!-- Form Fields -->
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="lastname" class="form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="firstname" class="form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="middlename" class="form-label">Middle Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="family_id" class="form-label">Family No. <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="family_id" name="family_id" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="family_role" class="form-label">Family Role <span class="text-danger">*</span></label>
                            <select class="form-select" id="family_role" name="family_role">
                                <option value="husband">Head of the Family</option>
                                <option value="wife">Wife</option>
                                <option value="child">Child</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select class="form-select" id="civil_status" name="civil_status">
                                <option value="">Select Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Legally Separated">Legally Separated</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="educational_attainment" class="form-label">Educational Attainment</label>
                            <select class="form-select" id="educational_attainment" name="educational_attainment">
                                <option value="">Select Education</option>
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                                <option value="Highschool Graduate">Highschool Graduate</option>
                                <option value="Highschool Undergraduate">Highschool Undergraduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="College Undergraduate">College Undergraduate</option>
                            </select>
                        </div>
                        <!-- Additional fields here -->
                        <div class="col-md-4 mb-4">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="religion" name="religion">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="citizenship" class="form-label">Citizenship</label>
                            <input type="text" class="form-control" id="citizenship" name="citizenship">
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <label for="sex" class="form-label">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>                        
                        <div class="col-md-4 mb-4">
                            <label for="isRegisteredVoter" class="form-label">Registered Voter? <span class="text-danger">*</span></label>
                            <select class="form-control" id="isRegisteredVoter" name="isRegisteredVoter">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

