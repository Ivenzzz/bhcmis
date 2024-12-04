<?php

session_start();

$title = 'Resident Details';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/residents.php';
require '../models/medical_conditions.php';

$resident_id = isset($_GET['resident_id']) ? intval($_GET['resident_id']) : 0;
$resident_details = getResidentDetails($conn, $resident_id);
$medical_conditions = getMedicalConditions($conn);
$user = getCurrentUser($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>
        
        <div class="container mt-4 px-5">

            <div class="row mb-4">
                <div class="col-md-12 p-2">
                    <!-- Breadcrumb Structure -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="residents.php">Residents List</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Resident Details</li> <!-- Current page -->
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 p-2">
                    <h2 class="text-center poppins-light text-slate-700">--- <?php echo $resident_details['firstname'] . ' ' . $resident_details['lastname'];?> ---</h2>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="shadow p-4 mb-2">
                        <h5 class="poppins-light">Household Number</h5>
                        <p class="poppins-semibold text-green-500"><?php echo $resident_details['household_id']; ?></p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="shadow p-4 mb-2">
                        <h5 class="poppins-light">Family Number</h5>
                        <p class="poppins-semibold text-amber-500"><?php echo $resident_details['household_id']; ?></p>
                    </div>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow p-4">
                    <h4 class="poppins-light mb-4 text-center">Personal Information</h4>
                    <form class="form" method="POST" action="../controllers/admin_update_resident_personal_information.php">
                        <input type="hidden" name="resident_id" value="<?= htmlspecialchars($resident_details['resident_id']); ?>">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="firstname" value="<?php echo htmlspecialchars($resident_details['firstname']); ?>" placeholder="First Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Middle Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="middlename" value="<?php echo htmlspecialchars($resident_details['middlename']); ?>" placeholder="Middle Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="lastname" value="<?php echo htmlspecialchars($resident_details['lastname']); ?>" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Date of Birth</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="date_of_birth" value="<?php echo htmlspecialchars($resident_details['date_of_birth']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Civil Status</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="civil_status">
                                    <option value="Single" <?php echo ($resident_details['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
                                    <option value="Married" <?php echo ($resident_details['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
                                    <option value="Widowed" <?php echo ($resident_details['civil_status'] == 'Widowed') ? 'selected' : ''; ?>>Widowed</option>
                                    <option value="Legally Separated" <?php echo ($resident_details['civil_status'] == 'Legally Separated') ? 'selected' : ''; ?>>Legally Separated</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Educational Attainment</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="educational_attainment">
                                    <option value="Elementary Graduate" <?php echo ($resident_details['educational_attainment'] == 'Elementary Graduate') ? 'selected' : ''; ?>>Elementary Graduate</option>
                                    <option value="Elementary Undergraduate" <?php echo ($resident_details['educational_attainment'] == 'Elementary Undergraduate') ? 'selected' : ''; ?>>Elementary Undergraduate</option>
                                    <option value="Highschool Graduate" <?php echo ($resident_details['educational_attainment'] == 'Highschool Graduate') ? 'selected' : ''; ?>>Highschool Graduate</option>
                                    <option value="Highschool Undergraduate" <?php echo ($resident_details['educational_attainment'] == 'Highschool Undergraduate') ? 'selected' : ''; ?>>Highschool Undergraduate</option>
                                    <option value="College Graduate" <?php echo ($resident_details['educational_attainment'] == 'College Graduate') ? 'selected' : ''; ?>>College Graduate</option>
                                    <option value="College Undergraduate" <?php echo ($resident_details['educational_attainment'] == 'College Undergraduate') ? 'selected' : ''; ?>>College Undergraduate</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Occupation</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="occupation" value="<?php echo htmlspecialchars($resident_details['occupation']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Religion</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="religion" value="<?php echo htmlspecialchars($resident_details['religion']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Citizenship</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="citizenship" value="<?php echo htmlspecialchars($resident_details['citizenship']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Sex</label>
                            <div class="col-sm-9">
                                <select class="form-select" name="sex">
                                    <option value="male" <?php echo ($resident_details['sex'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="female" <?php echo ($resident_details['sex'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone Number</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="phone_number" value="<?php echo htmlspecialchars($resident_details['phone_number']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($resident_details['email']); ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Registered Voter</label>
                            <div class="col-sm-9">
                                <input type="checkbox" class="form-check-input" name="isRegisteredVoter" value="1" <?php echo ($resident_details['isRegisteredVoter']) ? 'checked' : ''; ?>>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Deceased</label>
                            <div class="col-sm-9">
                                <input type="checkbox" class="form-check-input" name="isDeceased" value="1" <?php echo ($resident_details['isDeceased']) ? 'checked' : ''; ?>>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Death Date (if deceased)</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="deceased_date" 
                                    value="<?php echo isset($resident_details['deceased_date']) ? htmlspecialchars($resident_details['deceased_date']) : ''; ?>">
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Account Status</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="isTransferred">
                                    <option value="1" <?php echo ($resident_details['isTransferred'] == 1) ? 'selected' : ''; ?>>Transferred</option>
                                    <option value="0" <?php echo ($resident_details['isTransferred'] == 0) ? 'selected' : ''; ?>>Active</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12 text-center d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row mb-4 shadow p-3">
                <div class="col-md-12 mb-3">
                    <h2 class="poppins-light text-center">Medical Conditions</h2>
                </div>
                <div class="col-md-12 mb-3 p-4 px-5 shadow">
                    <?php if ($resident_details): ?>

                        <?php if (!empty($resident_details['medical_conditions'])): ?>
                            <table class="table text-center" id="medicalConditionsTable">
                                <thead>
                                    <tr>
                                        <th>Condition</th>
                                        <th>Diagnosed On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($resident_details['medical_conditions'] as $condition): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($condition['condition_name']) ?></td>
                                            <td>
                                                <?php 
                                                    // Check if the diagnosed_date is valid
                                                    echo !empty($condition['diagnosed_date']) ? date('F j, Y', strtotime($condition['diagnosed_date'])) : 'Unknown';
                                                ?>
                                            </td>
                                            <td><?= htmlspecialchars($condition['status']) ?></td>
                                            <td>
                                                <!-- Trashbin Button for Deletion -->
                                                <form action="../controllers/admin_delete_medical_condition.php" method="POST">
                                                    <input type="hidden" name="rmc_id" value="<?= $condition['rmc_id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> <!-- Using Font Awesome trashbin icon -->
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No medical conditions found for this resident.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>Resident not found.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-12">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addConditionModal">Add Condition</button>
                    </div>
                </div>
            </div>

            <!-- Modal Structure -->
            <div class="modal fade" id="addConditionModal" tabindex="-1" aria-labelledby="addConditionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addConditionModalLabel">Add New Medical Condition</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form to add a new condition -->
                            <form action="../controllers/admin_add_resident_medical_condition.php" method="POST">
                                <!-- Hidden input for resident_id -->
                                <input type="hidden" name="resident_id" value="<?= htmlspecialchars($resident_id) ?>">

                                <!-- Dropdown for Existing Medical Conditions -->
                                <div class="mb-3">
                                    <label for="existing_condition" class="form-label">Select Medical Condition</label>
                                    <select class="form-select" id="existing_condition" name="existing_condition">
                                        <option value="">Select a condition</option>
                                        <?php
                                        // Loop through the $medical_conditions array to populate the dropdown
                                        foreach ($medical_conditions as $condition) {
                                            echo "<option value='" . $condition['medical_conditions_id'] . "'>" . htmlspecialchars($condition['condition_name']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Text Input for New Medical Condition -->
                                <div class="mb-3">
                                    <label for="new_condition" class="form-label">New Condition (if not listed)</label>
                                    <input type="text" class="form-control" id="new_condition" name="new_condition" placeholder="Enter new condition (if not listed)">
                                </div>

                                <!-- Diagnosed Date Input -->
                                <div class="mb-3">
                                    <label for="diagnosed_date" class="form-label">Diagnosed On</label>
                                    <input type="date" class="form-control" id="diagnosed_date" name="diagnosed_date" required>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-primary">Add Condition</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
  </div>


    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function() {
            $('#medicalConditionsTable').DataTable({
                "paging": true,         // Enable pagination
                "searching": true,      // Enable search functionality
                "ordering": true,       // Enable sorting functionality
                "info": true,           // Show information about the table
                "lengthMenu": [5, 10, 25, 50],  // Set the page length options
            });
        });
    </script>
</body>
</html>
