<?php
session_start();
require './config/db_config.php';
require './app/models/get_resident_by_id.php';
require './app/models/get_current_user.php';
require './app/models/get_addresses.php';
require './app/models/get_resident_medical_conditions.php';
require './app/models/get_resident_allergies.php';

$resident_id = isset($_GET['resident_id']) ? intval($_GET['resident_id']) : null;

if ($resident_id) {
    $resident = getResidentById($conn, $resident_id);
}

$user = getCurrentUser($conn);
$resident_details = getResidentById($conn, $resident_id);
$title = $resident_details['firstname'] . ' ' . $resident_details['lastname'] . ' Information';
$medical_conditions = getResidentMedicalConditions($conn, $resident_id);
$allergies = getResidentAllergies($conn, $resident_id);
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
        <div class="row mb-4">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin-residents">Residents</a></li>
                        <li class="breadcrumb-item" aria-current="page"><?php echo htmlspecialchars($resident_details['firstname'] . ' ' . $resident_details['lastname']); ?></li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row shadow mb-4 px-4">
            <div class="col-md-12 p-3">
                <h4 class="text-center mb-3">Personal Information</h4>
                <form action="./app/controllers/admin-residents/update_resident.php">
                    <div class="row">
                        <div class="col-md-5 p-3 d-flex justify-content-center flex-column align-items-center">
                            <?php 
                                // Check if the resident has a profile picture
                                $profilePicture = !empty($resident_details['profile_picture']) ? $resident_details['profile_picture'] : './storage/uploads/avatar-default.png';
                            ?>
                            <img src="<?php echo $profilePicture; ?>" class="w-50 rounded-circle border border-success" alt="Profile Picture">
                            <input type="file" name="profile_picture" id="profile_picture" class="form-control form-control-sm mt-2" accept="image/*">
                        </div>
                        <div class="col-md-7 p-4 shadow">

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $resident_details['lastname']; ?>" required>
                                    <label for="lastname" class="form-label">Last Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $resident_details['firstname']; ?>" required>
                                    <label for="firstname" class="form-label">First Name</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?= $resident_details['middlename']; ?>" required>
                                    <label for="middlename" class="form-label">Middle Name</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?= $resident_details['date_of_birth']; ?>" required>
                                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="sex" name="sex" required>
                                        <option value="male" <?= $resident_details['sex'] == 'male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="female" <?= $resident_details['sex'] == 'female' ? 'selected' : ''; ?>>Female</option>
                                    </select>
                                    <label for="sex" class="form-label text-center">Sex</label>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="civil_status" name="civil_status" required>
                                        <option value="Single" <?= $resident_details['civil_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                                        <option value="Married" <?= $resident_details['civil_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                                        <option value="Widowed" <?= $resident_details['civil_status'] == 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                        <option value="Legally Separated" <?= $resident_details['civil_status'] == 'Legally Separated' ? 'selected' : ''; ?>>Legally Separated</option>
                                    </select>
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select class="form-select" id="address_id" name="address_id">
                                        <option value="" disabled selected>Select Address</option>
                                        <?php foreach ($addresses as $address): ?>
                                            <option value="<?php echo $address['address_id']; ?>" 
                                            <?php echo (isset($resident['address_id']) && $resident['address_id'] == $address['address_id']) ? 'selected' : ''; ?>>
                                            <?php echo $address['address_name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="address_id" class="form-label">Address</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo $resident_details['occupation']?>" placeholder=" ">
                                    <label for="occupation" class="form-label">Occupation</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-select" id="educational_attainment" name="educational_attainment">
                                        <option value="" disabled selected>Select Education Level</option>
                                        <option value="Elementary Graduate" <?php echo $resident_details['educational_attainment'] == 'Elementary Graduate' ? 'selected' : ''; ?>>Elementary Graduate</option>
                                        <option value="Elementary Undergraduate" <?php echo $resident_details['educational_attainment'] == 'Elementary Undergraduate' ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                        <option value="Highschool Graduate" <?php echo $resident_details['educational_attainment'] == 'Highschool Graduate' ? 'selected' : ''; ?>>Highschool Graduate</option>
                                        <option value="Highschool Undergraduate" <?php echo $resident_details['educational_attainment'] == 'Highschool Undergraduate' ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                        <option value="College Graduate" <?php echo $resident_details['educational_attainment'] == 'College Graduate' ? 'selected' : ''; ?>>College Graduate</option>
                                        <option value="College Undergraduate" <?php echo $resident_details['educational_attainment'] == 'College Undergraduate' ? 'selected' : ''; ?>>College Undergraduate</option>
                                    </select>
                                    <label for="educational_attainment" class="form-label">Educational Attainment</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="religion" name="religion" value="<?php echo $resident_details['religion']?>" placeholder=" ">
                                    <label for="religion" class="form-label">Religion</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id="citizenship" name="citizenship" value="<?php echo $resident_details['citizenship']?>" placeholder=" ">
                                    <label for="citizenship" class="form-label">Citizenship</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="tel" class="form-control" id="phone_number" name="phone_number" value="<?php echo $resident_details['phone_number']?>" placeholder=" ">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $resident_details['email']?>" placeholder=" ">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $resident_details['username']?>" placeholder=" ">
                                    <label for="username" class="form-label">Account Username</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-5">
                                    <button class="btn btn-success me-2">Export as PDF</button>
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row shadow mb-4 p-4">
            <div class="col-md-6">
                <table class="table table-bordered table-hover shadow" id="conditionsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Condition Name</th>
                            <th>Diagnosed Date</th>
                            <th>Medications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($medical_conditions)) : ?>
                            <?php foreach ($medical_conditions as $index => $condition) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($condition['condition_name']); ?></td>
                                    <td><?php echo htmlspecialchars($condition['diagnosed_date']); ?></td>
                                    <td>
                                        <?php 
                                            echo !empty($condition['medicines']) ? htmlspecialchars($condition['medicines']) : 'No medications prescribed';
                                        ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No medical conditions found for this resident.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-bordered table-hover shadow" id="allergiesTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Allergen</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($allergies)) : ?>
                            <?php foreach ($allergies as $index => $allergy) : ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($allergy['allergen']); ?></td>
                                    <td><?php echo htmlspecialchars($allergy['allergy_type']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="4" class="text-center">No allergies found for this resident.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="./public/js/admin/logout.js"></script>
</body>
</html>
