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

            <div class="row">
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

            <div class="row mb-4 p-5">
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
                        <div class="col-md-6 mx-auto mb-4 shadow p-3">
                            <div class="card text-center shadow bg-pink-100 position-relative member-card">
                                <div class="card-body">
                                    <h5 class="card-title text-pink-500">Wife</h5>
                                    <div class="card-text">
                                        <p class="poppins-medium"><?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></p>
                                        <p>Age: <?php echo htmlspecialchars($wife['age']);?></p>
                                        <p>Occupation: <span class="text-muted"><?php echo htmlspecialchars($wife['occupation'] ?? 'None'); ?></span></p>
                                    </div>
                                </div>
                                <div class="card-actions position-absolute d-none">
                                    <button class="btn btn-sm btn-warning mb-2">Update</button>
                                    <button class="btn btn-sm btn-danger mb-2">Delete</button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#wifeInfoModal">View Info</button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal for Wife -->
                        <div class="modal fade" id="wifeInfoModal" tabindex="-1" aria-labelledby="wifeInfoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="wifeInfoModalLabel">Wife - <?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Name:</strong> <?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></p>
                                        <p><strong>Age:</strong> <?php echo htmlspecialchars($wife['age']); ?></p>
                                        <p><strong>Occupation:</strong> <?php echo htmlspecialchars($wife['occupation'] ?? 'None'); ?></p>
                                        <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($wife['civil_status']); ?></p>
                                        <p><strong>Educational Attainment:</strong> <?php echo htmlspecialchars($wife['educational_attainment']); ?></p>
                                        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($wife['date_of_birth']); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Display children -->
                    <?php if (!empty($children)): ?>
                        <div class="col-12 text-center shadow p-3">
                            <h4 class="poppins-light">Children</h4>
                            <?php foreach ($children as $child): ?>
                                <div class="col-md-4 mx-auto">
                                    <div class="card text-center shadow bg-green-100 position-relative member-card">
                                        <div class="card-body">
                                            <h5 class="card-title text-info">Child</h5>
                                            <div class="card-text">
                                                <p class="fw-bold"><?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></p>
                                                <p>Age: <span class="text-muted"><?php echo htmlspecialchars($child['age'] ?? 'Unknown'); ?></span></p>
                                                <p>Sex: <span class="text-muted"><?php echo htmlspecialchars($child['sex'] ?? 'Unknown'); ?></span></p>
                                            </div>
                                        </div>
                                        <div class="card-actions position-absolute d-none">
                                            <button class="btn btn-sm btn-warning mb-2">Update</button>
                                            <button class="btn btn-sm btn-danger mb-2">Delete</button>
                                            <button class="btn btn-sm btn-info mb-2" data-bs-toggle="modal" data-bs-target="#childInfoModal<?php echo $child['fmember_id']; ?>">View Info</button>
                                            <?php if ($child['child_family_id']): ?>
                                                <a href="family_members.php?family_id=<?php echo htmlspecialchars($child['child_family_id']); ?>&household_id=<?php echo htmlspecialchars($household_id); ?>" class="btn btn-sm btn-info mb-2">Own Family</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Modal for Child -->
                                <div class="modal fade" id="childInfoModal<?php echo $child['fmember_id']; ?>" tabindex="-1" aria-labelledby="childInfoModalLabel<?php echo $child['fmember_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="childInfoModalLabel<?php echo $child['fmember_id']; ?>">Child - <?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Name:</strong> <?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></p>
                                                <p><strong>Age:</strong> <?php echo htmlspecialchars($child['age'] ?? 'Unknown'); ?></p>
                                                <p><strong>Occupation:</strong> <?php echo htmlspecialchars($child['occupation'] ?? 'None'); ?></p>
                                                <p><strong>Civil Status:</strong> <?php echo htmlspecialchars($child['civil_status'] ?? 'Unknown'); ?></p>
                                                <p><strong>Educational Attainment:</strong> <?php echo htmlspecialchars($child['educational_attainment'] ?? 'Unknown'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php else: ?>
                        <div class="col-12 text-center">
                            <p class="text-danger">No family members found for this family.</p>
                        </div>
                    <?php endif; ?>
            </div>

        </div>
  </div>




    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
    // JavaScript to toggle visibility of deceased date input based on the checkbox
    document.getElementById('isDeceased').addEventListener('change', function() {
        var deceasedDateDiv = document.getElementById('deceased_date_div');
        if (this.checked) {
            deceasedDateDiv.style.display = 'block';
        } else {
            deceasedDateDiv.style.display = 'none';
        }
    });
</script>
</body>
</html>
