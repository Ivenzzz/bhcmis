<?php

session_start();

$title = 'Families';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';

$user = getCurrentUser($conn);

if (isset($_GET['household_id'])) {
    $household_id = $_GET['household_id'];
    $families = getFamiliesByHouseholdId($conn, $household_id);
} else {
    echo "Household ID is missing!";
    $families = [];
}

$assigned_area = getAssignedArea($conn);


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
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="household_records.php">Households of <?php echo $assigned_area['assigned_area_name']?></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Families</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <h2 class="text-center mb-4 p-2 shadow poppins-light">Families of Household <?php echo $household_id; ?></h2>
                <div class="col-md-12 shadow p-5">
                    <table id="familiesTable" class="display text-center align-middle text-sm table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Family No.</th>
                                <th class="text-center">Family Name</th>
                                <th class="text-center">Head of Family</th>
                                <th class="text-center">Parent Family</th>
                                <th class="text-center">Number of Members</th>
                                <th class="text-center">4Ps Member</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($families)): ?>
                                <?php foreach ($families as $family): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($family['family_id'] ?? 'None'); ?></td>
                                        <td><?php echo htmlspecialchars($family['family_name'] ?? 'None'); ?></td>
                                        <td><?php echo htmlspecialchars($family['head_of_family'] ?? 'None'); ?></td>
                                        <td><?php echo htmlspecialchars($family['parent_family'] ?? 'None'); ?></td>
                                        <td><?php echo htmlspecialchars($family['number_of_members'] ?? 'None'); ?></td>
                                        <td>
                                            <?php 
                                                if (isset($family['4PsMember'])) {
                                                    echo $family['4PsMember'] 
                                                        ? '<i class="fas fa-check text-green-500"></i>'  // Green check
                                                        : '<i class="fas fa-times text-red-500"></i>';  // Red X
                                                } else {
                                                    echo 'None';
                                                }
                                            ?>
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            <a href="family_members.php?family_id=<?php echo htmlspecialchars($family['family_id']); ?>&household_id=<?php echo htmlspecialchars($household_id); ?>" 
                                                class="btn btn-success btn-sm me-2">
                                                Members <i class="fa-solid fa-people-roof"></i>
                                            </a>
                                            <button type="button" class="btn btn-transparents btn-sm text-sm" data-bs-toggle="modal" 
                                                data-bs-target="#updateFamilyModal<?php echo htmlspecialchars($family['family_id']); ?>">
                                                <i class="fa-solid fa-pen text-amber-500"></i>
                                            </button>
                                            <button type="button" class="btn btn-transparent btn-sm text-sm delete-family-btn" 
                                                data-family-id="<?php echo htmlspecialchars($family['family_id']); ?>" 
                                                data-household-id="<?php echo htmlspecialchars($household_id); ?>">
                                                <i class="fa-regular fa-trash-can text-red-500"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <?php require 'partials/update_family_modal.php'; ?>

                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">No families found for this household.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFamilyModal">Add Family</button>
                </div>
            </div>

            <?php require 'partials/add_family_modal.php'; ?>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/bhw_families.js"></script>
</body>
</html>
