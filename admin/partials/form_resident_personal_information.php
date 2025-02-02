<form class="form" id="updateResidentPersonalInformationForm">
    <input type="hidden" name="resident_id" value="<?= htmlspecialchars($resident_details['resident_id']); ?>">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">First Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="firstname" value="<?php echo !empty($resident_details['firstname']) ? htmlspecialchars($resident_details['firstname']) : ''; ?>" placeholder="First Name">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Middle Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="middlename" value="<?php echo !empty($resident_details['middlename']) ? htmlspecialchars($resident_details['middlename']) : ''; ?>" placeholder="Middle Name">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="lastname" value="<?php echo !empty($resident_details['lastname']) ? htmlspecialchars($resident_details['lastname']) : ''; ?>" placeholder="Last Name">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Date of Birth</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" name="date_of_birth" value="<?php echo !empty($resident_details['date_of_birth']) ? htmlspecialchars($resident_details['date_of_birth']) : ''; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Civil Status</label>
        <div class="col-sm-9">
            <select class="form-select" name="civil_status">
                <option value="Single" <?php echo (!empty($resident_details['civil_status']) && $resident_details['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                <option value="Married" <?php echo (!empty($resident_details['civil_status']) && $resident_details['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                <option value="Widowed" <?php echo (!empty($resident_details['civil_status']) && $resident_details['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                <option value="Legally Separated" <?php echo (!empty($resident_details['civil_status']) && $resident_details['civil_status'] == 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
            </select>
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Educational Attainment</label>
        <div class="col-sm-9">
            <select class="form-select" name="educational_attainment">
                <option value="Elementary Graduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'Elementary Graduate') ? 'selected' : ''; ?>>Elementary Graduate</option>
                <option value="Elementary Undergraduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'Elementary Undergraduate') ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                <option value="Highschool Graduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'Highschool Graduate') ? 'selected' : ''; ?>>Highschool Graduate</option>
                <option value="Highschool Undergraduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'Highschool Undergraduate') ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                <option value="College Graduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'College Graduate') ? 'selected' : ''; ?>>College Graduate</option>
                <option value="College Undergraduate" <?php echo (!empty($resident_details['educational_attainment']) && $resident_details['educational_attainment'] == 'College Undergraduate') ? 'selected' : ''; ?>>College Undergraduate</option>
            </select>
        </div>
    </div>

    <!-- Occupation -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Occupation</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="occupation" value="<?php echo !empty($resident_details['occupation']) ? htmlspecialchars($resident_details['occupation']) : ''; ?>">
        </div>
    </div>

    <!-- Religion -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Religion</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="religion" value="<?php echo !empty($resident_details['religion']) ? htmlspecialchars($resident_details['religion']) : ''; ?>">
        </div>
    </div>

    <!-- Citizenship -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Citizenship</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="citizenship" value="<?php echo !empty($resident_details['citizenship']) ? htmlspecialchars($resident_details['citizenship']) : ''; ?>">
        </div>
    </div>

    <!-- Sex -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Sex</label>
        <div class="col-sm-9">
            <select class="form-select" name="sex">
                <option value="male" <?php echo (!empty($resident_details['sex']) && $resident_details['sex'] == 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (!empty($resident_details['sex']) && $resident_details['sex'] == 'female') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
    </div>

    <!-- Phone Number -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Phone Number</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="phone_number" value="<?php echo !empty($resident_details['phone_number']) ? htmlspecialchars($resident_details['phone_number']) : ''; ?>">
        </div>
    </div>

    <!-- Email -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" name="email" value="<?php echo !empty($resident_details['email']) ? htmlspecialchars($resident_details['email']) : ''; ?>">
        </div>
    </div>

    <!-- Registered Voter -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Registered Voter</label>
        <div class="col-sm-9">
            <input type="checkbox" class="form-check-input" name="isRegisteredVoter" value="1" <?php echo (!empty($resident_details['isRegisteredVoter']) && $resident_details['isRegisteredVoter']) ? 'checked' : ''; ?>>
        </div>
    </div>

    <!-- Deceased -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Deceased</label>
        <div class="col-sm-9">
            <input type="checkbox" class="form-check-input" name="isDeceased" value="1" <?php echo (!empty($resident_details['isDeceased']) && $resident_details['isDeceased']) ? 'checked' : ''; ?>>
        </div>
    </div>

    <!-- Death Date -->
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Death Date (if deceased)</label>
        <div class="col-sm-9">
            <input type="date" class="form-control" name="deceased_date" 
                value="<?php echo !empty($resident_details['deceased_date']) ? htmlspecialchars($resident_details['deceased_date']) : ''; ?>">
        </div>
    </div>

<<<<<<< HEAD
    <!-- Account Status --> 
=======
    <!-- Account Status -->
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Account Status</label>
        <div class="col-sm-9">
            <select class="form-control" name="isTransferred">
<<<<<<< HEAD
                <option value="1" <?php echo (isset($resident_details['isTransferred']) && $resident_details['isTransferred'] == 1) ? 'selected' : ''; ?>>Transferred</option>
                <option value="0" <?php echo (isset($resident_details['isTransferred']) && $resident_details['isTransferred'] == 0) ? 'selected' : ''; ?>>Active</option>
=======
                <option value="1" <?php echo (!empty($resident_details['isTransferred']) && $resident_details['isTransferred'] == 1) ? 'selected' : ''; ?>>Transferred</option>
                <option value="0" <?php echo (!empty($resident_details['isTransferred']) && $resident_details['isTransferred'] == 0) ? 'selected' : ''; ?>>Active</option>
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
            </select>
        </div>
    </div>

<<<<<<< HEAD


=======
>>>>>>> ddb9a718c904a6bd1cb504c747ddb13d799775bf
    <!-- Save Changes -->
    <div class="row mb-3">
        <div class="col-sm-12 text-center d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </div>
</form>