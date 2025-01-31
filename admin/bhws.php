<?php

session_start();

$title = 'Barangay Health Workers';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/bhws.php';
require '../models/addresses.php';

$addresses = getAllAddresses($conn);
$bhws = getBHWs($conn);
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
        
        <div class="container mt-4 px-4">

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Barangay Health Workers</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 d-flex justify-content-end">
                    <button id="openBhwModalBtn" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#residentModal">
                        Add Barangay Health Worker <i class="fas fa-plus me-1"></i>
                    </button>
                </div>
            </div>

            <div class="row p-4">
                <div class="col-md-12 shadow p-4">
                    <table id="bhwsTable" class="display text-center text-sm">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Age</th>
                                <th class="text-center">Assigned Area</th>
                                <th class="text-center">Date Started</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($bhws as $index => $bhw): ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($bhw['firstname'] . ' ' . $bhw['middlename'] . ' ' . $bhw['lastname']); ?></td>
                                <td><?= htmlspecialchars($bhw['age']); ?></td>
                                <td><?= htmlspecialchars($bhw['assigned_area_name']); ?></td>
                                <td><?= htmlspecialchars($bhw['date_started']); ?></td>
                                <td class="<?= $bhw['employment_status'] === 'active' ? 'text-green-500' : ($bhw['employment_status'] === 'on_leave' ? 'text-amber-500' : 'text-red-500'); ?>">
                                    <?= htmlspecialchars($bhw['employment_status']); ?>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" 
                                        data-bs-target="#editBHWModal<?php echo htmlspecialchars($bhw['bhw_id']); ?>">
                                        Edit <i class="fa-solid fa-edit"></i>
                                    </button>
                                </td>
                            </tr>

                            <?php require 'partials/update_bhw_modal.php'; ?>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
  </div>

    <!-- Modal for searching residents and adding BHW -->
    <div class="modal fade" id="residentModal" tabindex="-1" aria-labelledby="residentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="residentModalLabel">Select a Resident for BHW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Search Input -->
                    <input type="text" id="searchResident" class="form-control mb-3" placeholder="Search resident by name...">
                    
                    <!-- Resident List -->
                    <div class="list-group" id="residentList">
                        <p class="text-center">Loading residents...</p>
                    </div>

                    <!-- BHW Username and Password Inputs -->
                    <div class="mt-3">
                        <label for="bhwUsername" class="form-label">BHW Username</label>
                        <input type="text" id="bhwUsername" class="form-control" placeholder="Enter BHW username">

                        <label for="bhwPassword" class="form-label mt-2">BHW Password</label>
                        <input type="password" id="bhwPassword" class="form-control" placeholder="Enter BHW password">
                    </div>

                    <!-- Address Dropdown for Assigned Area -->
                    <div class="mt-3">
                        <label for="assignedArea" class="form-label">Assign Area</label>
                        <select id="assignedArea" class="form-select">
                            <option value="" disabled selected>Select assigned area</option>
                            <?php

                            // Check if there are addresses to display
                            if (!empty($addresses)) {
                                foreach ($addresses as $address) {
                                    echo '<option value="' . $address['address_id'] . '">' . htmlspecialchars($address['address_name']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No addresses found.</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="selectedResident" class="me-auto text-muted">No resident selected.</span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveResidentBtn" class="btn btn-primary" disabled>Save</button>
                </div>
            </div>
        </div>
    </div>




    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        $(document).ready(function() {
            $('#bhwsTable').DataTable();
        });
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
    const modal = new bootstrap.Modal(document.getElementById("residentModal"));
    const residentList = document.getElementById("residentList");
    const searchInput = document.getElementById("searchResident");
    const saveResidentBtn = document.getElementById("saveResidentBtn");
    const selectedResidentDisplay = document.getElementById("selectedResident");
    const bhwUsernameInput = document.getElementById("bhwUsername");
    const bhwPasswordInput = document.getElementById("bhwPassword");
    const assignedAreaSelect = document.getElementById("assignedArea");  // Get assigned area dropdown

    let residents = [];
    let selectedResident = null;

    // Fetch residents from API
    function fetchResidents() {
        fetch("../api/get_residents.php")
            .then(response => response.json())
            .then(data => {
                residents = data;
                renderResidents(residents);
            })
            .catch(error => {
                residentList.innerHTML = `<p class="text-danger text-center">Error loading residents.</p>`;
                console.error("Error fetching residents:", error);
            });
    }

    // Render resident list
    function renderResidents(residentData) {
        if (residentData.length === 0) {
            residentList.innerHTML = `<p class="text-center">No residents found.</p>`;
            return;
        }

        residentList.innerHTML = residentData.map(resident => `
            <button class="list-group-item list-group-item-action resident-item" data-id="${resident.resident_id}" data-name="${resident.full_name}" data-personal-info-id="${resident.personal_info_id}">
                <strong>${resident.full_name}</strong>
            </button>
        `).join("");

        // Add click event to select resident
        document.querySelectorAll(".resident-item").forEach(item => {
            item.addEventListener("click", function () {
                selectedResident = {
                    id: this.getAttribute("data-id"),
                    name: this.getAttribute("data-name"),
                    personalInfoId: this.getAttribute("data-personal-info-id")
                };

                // Update UI
                selectedResidentDisplay.innerText = `Selected: ${selectedResident.name}`;
                saveResidentBtn.removeAttribute("disabled");
            });
        });
    }

    // Filter residents based on search input
    searchInput.addEventListener("input", function () {
        const searchTerm = searchInput.value.toLowerCase();
        const filteredResidents = residents.filter(resident =>
            resident.full_name.toLowerCase().includes(searchTerm)
        );
        renderResidents(filteredResidents);
    });

    // Handle Save button click
    saveResidentBtn.addEventListener("click", function () {
        if (!selectedResident || !assignedAreaSelect.value) return;  // Ensure assigned area is selected

        // Create form data to send
        const formData = new FormData();
        formData.append("resident_id", selectedResident.id);
        formData.append("resident_name", selectedResident.name);
        formData.append("personal_info_id", selectedResident.personalInfoId);
        formData.append("bhw_username", bhwUsernameInput.value);
        formData.append("bhw_password", bhwPasswordInput.value);
        formData.append("assigned_area", assignedAreaSelect.value);  // Add selected assigned area

        // Send data to backend
        fetch("../controllers/admin_appoint_bhw_from_residents.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show SweetAlert success modal
                Swal.fire({
                    icon: 'success',
                    title: 'Appointment Successful!',
                    text: 'Resident successfully appointed as BHW.',
                    confirmButtonText: 'Okay'
                }).then(() => {
                    // Reload the page after success
                    location.reload();
                });
            } else {
                // Show SweetAlert error modal
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.error || 'An error occurred while processing.',
                    confirmButtonText: 'Close'
                });
            }
        })
        .catch(error => {
            console.error("Error:", error);
            // Show SweetAlert error modal for failed request
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while processing.',
                confirmButtonText: 'Close'
            });
        });
    });

    // Open modal and fetch residents
    const openModalBtn = document.getElementById("openBhwModalBtn"); // Assuming button has this ID
    openModalBtn.addEventListener("click", function () {
        modal.show();
        fetchResidents();
        selectedResident = null;  // Reset selection
        selectedResidentDisplay.innerText = "No resident selected.";
        saveResidentBtn.setAttribute("disabled", "true");
        bhwUsernameInput.value = "";  // Reset username and password fields
        bhwPasswordInput.value = "";
    });
});

</script>

</body>
</html>
