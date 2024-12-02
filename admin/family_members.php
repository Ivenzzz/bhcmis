<?php

session_start();

$title = 'Family Members';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/households.php';

$user = getCurrentUser($conn);

if (isset($_GET['family_id'])) {
    $family_id = $_GET['family_id'];
    $family_members = getFamilyMembersByFamilyId($conn, $family_id);
    $family_name = !empty($family_members) ? $family_members[0]['family_name'] : 'Unknown Family';
} else {
    echo "Family ID is missing!";
    $family_members = [];
}

$household_id = $_GET['household_id'];


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
                            <li class="breadcrumb-item"><a href="households.php">Households</a></li>
                            <li class="breadcrumb-item"><a href="families.php?household_id=<?php echo $family_id;?>">Families</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Members</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4 shadow p-2">
                <div class="col-md-12">
                    <h2 class="poppins-light text-center"><?php echo htmlspecialchars($family_name); ?></h2>
                </div>
            </div>

            <div class="row mb-4">
                <?php if (!empty($family_members)): ?>
                    <?php 
                    // Separate members by roles
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
                        <div class="col-md-4 mx-auto">
                            <div class="card text-center border-primary">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">Head of Family</h5>
                                    <div class="card-text">
                                        <p class="poppins-medium"><?php echo htmlspecialchars($head['firstname'] . ' ' . $head['lastname']); ?></p>
                                        <p>Age: <?php echo htmlspecialchars($head['age']); ?></p>
                                        <p>Occupation: <span class="text-muted"><?php echo htmlspecialchars($head['occupation'] ?? 'None'); ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Display the wife -->
                    <?php if ($wife): ?>
                        <div class="col-md-4 mx-auto">
                            <div class="card text-center border-warning">
                                <div class="card-body">
                                    <h5 class="card-title text-warning">Wife</h5>
                                    <div class="card-text">
                                        <p class="poppins-medium"><?php echo htmlspecialchars($wife['firstname'] . ' ' . $wife['lastname']); ?></p>
                                        <p>Age: <?php echo htmlspecialchars($wife['age']);?></p>
                                        <p>Occupation: <span class="text-muted"><?php echo htmlspecialchars($wife['occupation'] ?? 'None'); ?></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Display children -->
                    <?php if (!empty($children)): ?>
                        <div class="col-12 text-center">
                            <h4 class="mt-4">Children</h4>
                        </div>
                        <?php foreach ($children as $child): ?>
                            <div class="col-md-3 mx-auto">
                                <div class="card text-center border-info">
                                    <div class="card-body">
                                        <h5 class="card-title text-info">Child</h5>
                                        <div class="card-text">
                                            <p class="fw-bold"><?php echo htmlspecialchars($child['firstname'] . ' ' . $child['lastname']); ?></p>
                                            <p>Age: <span class="text-muted"><?php echo htmlspecialchars($child['age'] ?? 'Unknown'); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
</body>
</html>
