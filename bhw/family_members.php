<?php

session_start();

$title = 'Family Members';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';

$user = getCurrentUser($conn);
$assigned_area = getAssignedArea($conn);
$household_id = $_GET['household_id'];
$family_id = $_GET['family_id'];
$family_members = getFamilyMembersByFamilyId($conn, $family_id);

$hasHusband = false;
$hasWife = false;

foreach ($family_members as $member) {
    if ($member['role'] === 'husband') {
        $hasHusband = true;
    } elseif ($member['role'] === 'wife') {
        $hasWife = true;
    }
}

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

            <div class="row mb-3">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="household_records.php">Households of <?php echo $assigned_area['assigned_area_name']?></a></li>
                            <li class="breadcrumb-item"><a href="families.php?household_id=<?php echo $household_id; ?>">Families</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Members</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <h4 class="poppins-bold text-center">Family <?php echo $family_id?></h4>
                </div>
            </div>

            <div class="row px-5">
                <?php if (!empty($family_members)): ?>
                    <?php 
                    $head = null;
                    $wife = null;
                    $children = [];
                    foreach ($family_members as $member) {
                        if ($member['role'] === 'husband') {
                            $head = $member;
                        } elseif ($member['role'] === 'wife') {
                            $wife = $member;
                        } elseif ($member['role'] === 'child') {
                            $children[] = $member;
                        }
                    }
                    ?>

                    <!-- Display the head of the family -->
                    <?php if ($head): ?>
                        <?php
                            require 'partials/card_head_of_family.php';
                            require 'partials/modal_view_head_of_family_info.php';
                            require 'partials/modal_update_head_of_family.php';   
                        ?>
                    <?php endif; ?>


                    <!-- Display the wife -->
                    <?php if ($wife): ?>
                        <?php
                            require 'partials/card_wife.php';
                            require 'partials/modal_view_wife.php';
                            require 'partials/modal_update_wife.php';   
                        ?>
                    <?php endif; ?>

                    <!-- Display children -->
                    <?php if (!empty($children)): ?>
                        <div class="col-md-12 shadow p-3">
                            <h4 class="poppins-light text-center">Children</h4>
                            <?php foreach ($children as $child): ?>
                                <?php
                                    require 'partials/card_child.php';
                                    require 'partials/modal_view_child.php';
                                    require 'partials/modal_update_child.php';   
                                ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p class="text-danger">No family members found for this family.</p>
                        </div>
                    <?php endif; ?>
            </div>

            <div class="row p-5">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add Member</button>
                </div>
            </div>

        </div>
  </div>

    <!-- Add Member Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="addMemberForm" action="../controllers/bhw_add_family_member.php" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMemberModalLabel">Add New Family Member</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename">
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role in Family</label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="husband" <?php echo $hasHusband ? 'disabled' : ''; ?>>Husband</option>
                                <option value="wife" <?php echo $hasWife ? 'disabled' : ''; ?>>Wife</option>
                                <option value="child">Child</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select class="form-select" id="civil_status" name="civil_status" required>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Legally Separated">Legally Separated</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="educational_attainment" class="form-label">Educational Attainment</label>
                            <select class="form-select" id="educational_attainment" name="educational_attainment">
                                <option value="Elementary Graduate">Elementary Graduate</option>
                                <option value="Elementary Undergraduate">Elementary Undergraduate</option>
                                <option value="Highschool Graduate">Highschool Graduate</option>
                                <option value="Highschool Undergraduate">Highschool Undergraduate</option>
                                <option value="College Graduate">College Graduate</option>
                                <option value="College Undergraduate">College Undergraduate</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="occupation" name="occupation">
                        </div>
                        <div class="mb-3">
                            <label for="religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="religion" name="religion">
                        </div>
                        <div class="mb-3">
                            <label for="citizenship" class="form-label">Citizenship</label>
                            <input type="text" class="form-control" id="citizenship" name="citizenship">
                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-select" id="sex" name="sex" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <input type="hidden" name="family_id" value="<?php echo $family_id; ?>">
                        <input type="hidden" name="household_id" value="<?php echo $household_id; ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/bhw_family_members.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addMemberForm = document.getElementById('addMemberForm');
            const addMemberModal = new bootstrap.Modal(document.getElementById('addMemberModal'));

            addMemberForm.addEventListener('submit', function (e) {
                e.preventDefault();  // Prevent the default form submission

                // Create a FormData object to easily collect all form data
                const formData = new FormData(addMemberForm);

                // Use Fetch API to send the form data to the server
                fetch('../controllers/bhw_add_family_member.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())  // Parse JSON response
                .then(data => {
                    // Check the response and show appropriate SweetAlert
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonText: 'Close',
                            didClose: () => {
                                location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                })
                .catch(error => {
                    // Handle unexpected errors (e.g., network issues)
                    Swal.fire({
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                    console.error('Error:', error);
                });
            });
        });

    </script>
</body>
</html>
