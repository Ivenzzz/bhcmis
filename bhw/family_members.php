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
                    <button class="btn btn-primary">Add Member</button>
                </div>
            </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/bhw_family_members.js"></script>
</body>
</html>
