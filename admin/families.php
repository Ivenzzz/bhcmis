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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <style>
        .family-member {
      margin-left: 20px;
    }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Families</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <h2 class="text-center mb-4 p-2 shadow poppins-light">Families of Household <?php echo $household_id; ?></h2>
                <div class="col-md-12 shadow p-2">
                    <?php require 'partials/table_families.php';?>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow p-3">
                    <h4>Families Hierarchy</h4>
                    <div data-household-id="<?php echo $household_id; ?>"></div>
                    <div id="family-hierarchy"></div>
                </div>
            </div>
            
        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
    $(document).ready(function () {
        $('#familiesTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false
        });
    });

    async function fetchAndRenderFamilyHierarchy(household_id) {
        try {
            const response = await fetch(`../api/family_tree_by_household_id.php?household_id=${household_id}`);
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            
            const data = await response.json();
            const container = document.getElementById('family-hierarchy');
            container.innerHTML = '';

            if (data.message) {
                container.textContent = data.message;
            } else {
                // Track processed family IDs to prevent duplicates
                const processedFamilies = new Set();

                // First pass: collect all family IDs
                const allFamilies = data.reduce((acc, family) => {
                    acc[family.family_id] = family;
                    return acc;
                }, {});

                // Second pass: find root families (not referenced as child families)
                const rootFamilies = data.filter(family => 
                    !data.some(f => 
                        Object.values(f.members).some(member => 
                            member.child_family?.family_id === family.family_id
                        )
                    )
                );

                // Process root families
                rootFamilies.forEach(family => {
                    if (!processedFamilies.has(family.family_id)) {
                        container.appendChild(createFamilyTree(family, allFamilies, processedFamilies));
                        processedFamilies.add(family.family_id);
                    }
                });
            }
        } catch (error) {
            console.error('Fetch error:', error);
            document.getElementById('family-hierarchy').textContent = 
                'Error loading family tree. Check console for details.';
        }
    }

    function createFamilyTree(family, allFamilies, processedFamilies) {
        const ul = document.createElement('ul');
        ul.classList.add('family-tree');

        const members = convertMembersToArray(family.members);
        
        members.forEach(member => {
            const li = document.createElement('li');
            // Create display name with fallback to Resident ID
            const firstName = member.firstname || '';
            const lastName = member.lastname || '';
            const fullName = `${firstName} ${lastName}`.trim();
            const displayName = fullName ? fullName : `Resident ${member.resident_id}`;
            
            li.innerHTML = `<span class="member">${capitalize(member.role)}: ${displayName}</span>`;

            if (member.child_family?.family_id) {
                const childFamilyId = member.child_family.family_id;
                if (allFamilies[childFamilyId] && !processedFamilies.has(childFamilyId)) {
                    const childFamily = {
                        ...allFamilies[childFamilyId],
                        members: convertMembersToArray(allFamilies[childFamilyId].members)
                    };
                    const childTree = createFamilyTree(childFamily, allFamilies, processedFamilies);
                    childTree.classList.add('nested-family');
                    li.appendChild(childTree);
                    processedFamilies.add(childFamilyId);
                }
            }

            ul.appendChild(li);
        });

        return ul;
    }

    function convertMembersToArray(members) {
        // Convert object to array if needed
        return Array.isArray(members) ? members : Object.values(members);
    }

    function capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }

    // Add CSS for hierarchical visualization
    const style = document.createElement('style');
    style.textContent = `
        .family-tree {
            list-style-type: disc;
            padding-left: 20px;
            margin: 10px 0;
        }
        .nested-family {
            margin-left: 30px;
            border-left: 2px solid #ddd;
            padding-left: 15px;
        }
        .member {
            display: inline-block;
            padding: 3px 8px;
            margin: 2px 0;
            background: #f5f5f5;
            border-radius: 3px;
        }
    `;
    document.head.appendChild(style);

    // Get household_id safely
    const householdIdElement = document.querySelector('[data-household-id]');
    const household_id = householdIdElement?.dataset.householdId || 0;
    
    if (household_id > 0) {
        fetchAndRenderFamilyHierarchy(household_id);
    } else {
        document.getElementById('family-hierarchy').textContent = 
            'Invalid household ID provided';
    }
</script>
</body>
</html>
