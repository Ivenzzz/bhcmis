<?php

session_start();

$title = 'Midwife';

require './config/db_config.php';
require './app/models/get_midwife.php';
require './app/models/get_current_user.php';

$user = getCurrentUser($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require './app/views/globals/head.php'; ?>
    <link rel="stylesheet" href="./public/css/admin.css">
</head>
<body id="body-pd">
    <?php require 'partials/top_navigation.php'; ?>
    <?php require 'partials/sidebar.php'; ?>
    
    <div class="height-100 main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 mb-5 p-4 shadow midwife-form ">
                    <h2 class="mb-4 text-center">Midwife Information</h2>
                    <?php foreach ($midwife_data as $midwife): ?>
                        <form action="./app/controllers/admin-midwife/update_midwife.php" method="post" enctype="multipart/form-data" class="row g-4">
                            <input type="hidden" name="account_id" value="<?= $midwife['account_id']; ?>">
                            <input type="hidden" name="personal_info_id" value="<?= $midwife['personal_info_id']; ?>">
                            <input type="hidden" name="existing_profile_picture" value="<?= $midwife['profile_picture']; ?>">
        
                            <div class="col-md-12 text-center mt-4">
                                <label for="profile_picture" class="form-label d-block">Profile Picture</label>
        
                                <!-- Profile picture container with file input inside -->
                                <div class="position-relative d-inline-block">
                                    <!-- Display the current profile picture -->
                                    <img src="<?= $midwife['profile_picture']; ?>" alt="Profile Picture" 
                                        class="rounded-circle img-thumbnail mb-3" style="width: 150px; height: 150px; object-fit: cover;">
        
                                    <!-- Invisible file input overlaying the image -->
                                    <input type="file" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0" 
                                        id="profile_picture" name="profile_picture" accept="image/*">
                                </div>
                            </div>
        
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?= $midwife['username']; ?>" required>
                            </div>
        
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $midwife['email']; ?>" required>
                            </div>
        
                            <div class="col-md-4">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $midwife['firstname']; ?>" required>
                            </div>
        
                            <div class="col-md-4">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $midwife['lastname']; ?>" required>
                            </div>
        
                            <div class="col-md-4">
                                <label for="middlename" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middlename" name="middlename" value="<?= $midwife['middlename']; ?>">
                            </div>
        
                            <div class="col-md-12">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $midwife['date_of_birth']; ?>" required>
                            </div>
        
                            <div class="col-md-4">
                                <label for="civil_status" class="form-label">Civil Status</label>
                                <select class="form-select" id="civil_status" name="civil_status" required>
                                    <option value="Single" <?= $midwife['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                                    <option value="Married" <?= $midwife['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                                    <option value="Widowed" <?= $midwife['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                    <option value="Legally Separated" <?= $midwife['civil_status'] == 'Legally Separated' ? 'selected' : ''; ?>>Legally Separated</option>
                                </select>
                            </div>
        
                            <div class="col-md-4">
                                <label for="educational_attainment" class="form-label">Educational Attainment</label>
                                <select class="form-select" id="educational_attainment" name="educational_attainment" required>
                                    <option value="Elementary Graduate" <?= $midwife['educational_attainment'] == 'Elementary Graduate' ? 'selected' : ''; ?>>Elementary Graduate</option>
                                    <option value="Elementary Undergraduate" <?= $midwife['educational_attainment'] == 'Elementary Undergraduate' ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                    <option value="Highschool Graduate" <?= $midwife['educational_attainment'] == 'Highschool Graduate' ? 'selected' : ''; ?>>Highschool Graduate</option>
                                    <option value="Highschool Undergraduate" <?= $midwife['educational_attainment'] == 'Highschool Undergraduate' ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                    <option value="College Graduate" <?= $midwife['educational_attainment'] == 'College Graduate' ? 'selected' : ''; ?>>College Graduate</option>
                                    <option value="College Undergraduate" <?= $midwife['educational_attainment'] == 'College Undergraduate' ? 'selected' : ''; ?>>College Undergraduate</option>
                                </select>
                            </div>
        
                            <div class="col-md-4">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $midwife['occupation']; ?>">
                            </div>
        
                            <div class="col-md-4">
                                <label for="religion" class="form-label">Religion</label>
                                <input type="text" class="form-control" id="religion" name="religion" value="<?= $midwife['religion']; ?>">
                            </div>
        
                            <div class="col-md-4">
                                <label for="citizenship" class="form-label">Citizenship</label>
                                <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?= $midwife['citizenship']; ?>">
                            </div>
        
                            <div class="col-md-4">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= $midwife['phone_number']; ?>" required>
                            </div>
        
                            <div class="col-md-6">
                                <label for="employment_status" class="form-label">Employment Status</label>
                                <select class="form-select" id="employment_status" name="employment_status" required>
                                    <option value="active" <?= $midwife['employment_status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?= $midwife['employment_status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
        
                            <div class="col-md-6">
                                <label for="employment_date" class="form-label">Employment Date</label>
                                <input type="date" class="form-control" id="employment_date" name="employment_date" value="<?= $midwife['employment_date']; ?>" required>
                            </div>
        
                            <div class="col-md-12">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control" id="license_number" name="license_number" value="<?= $midwife['license_number']; ?>">
                            </div>
        
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Update Midwife</button>
                            </div>
                        </form>
                        <hr class="my-4">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <?php require './app/views/globals/javascripts.php'; ?>
    <script src="./public/js/admin/admin-midwife.js" type="module"></script>
    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
