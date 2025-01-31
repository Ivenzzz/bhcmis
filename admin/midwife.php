<?php

session_start();

$title = 'Midwife';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/midwife.php';
require '../models/get_all_bhws.php';


$midwives = getMidwives($conn);
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
        
        <div class="container mt-4 px-5">

            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Midwife</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 shadow">
                <table id="midwivesTable" class="display text-center table-sm text-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Employment Status</th>
                            <th>Employment Date</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($midwives as $midwife): ?>
                        <tr>
                            <td><?= htmlspecialchars($midwife['firstname'] . ' ' . $midwife['middlename'] . ' ' . $midwife['lastname']) ?></td>
                            <td class="<?= $midwife['employment_status'] === 'active' ? 'text-green-500' : 'text-red-500'; ?>">
                                <?= htmlspecialchars($midwife['employment_status']) ?>
                            </td>
                            <td><?= htmlspecialchars($midwife['employment_date']) ?></td>
                            <td><?= htmlspecialchars($midwife['email']) ?></td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal<?= $midwife['midwife_id'] ?>">
                                    Update
                                </button>
                            </td>
                        </tr>
                    
                        <?php require 'partials/update_midwife_modal.php'; ?>

                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-12 d-flex justify-content-end">
                    <button class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#appointFromBHWModal">Appoint from BHWs</button>
                    <button class="btn btn-primary btn-sm me-2" id="openModalBtn">Appoint from Residents</button>
                </div>
            </div>
    
        </div>
  </div>

    
    <?php require 'partials/add_midwife_from_bhw_modal.php'; ?>

    <!-- Modal -->
    <div class="modal fade" id="residentModal" tabindex="-1" aria-labelledby="residentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="residentModalLabel">Select a Resident</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Search Input -->
                    <input type="text" id="searchResident" class="form-control mb-3" placeholder="Search resident by name...">
                    
                    <!-- Resident List -->
                    <div class="list-group" id="residentList">
                        <p class="text-center">Loading residents...</p>
                    </div>

                    <!-- Midwife Username and Password -->
                    <div class="mt-3">
                        <div class="mb-3">
                            <label for="midwifeUsername" class="form-label">Midwife Username</label>
                            <input type="text" id="midwifeUsername" class="form-control" placeholder="Enter midwife username">
                        </div>
                        <div class="mb-3">
                            <label for="midwifePassword" class="form-label">Midwife Password</label>
                            <input type="password" id="midwifePassword" class="form-control" placeholder="Enter midwife password">
                        </div>
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
        // Initialize Datatables
        $(document).ready(function () {
            $('#midwivesTable').DataTable({
                "pageLength": 10, // Default number of rows
                "order": [[1, "desc"]] // Default sorting: by Employment Status
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = new bootstrap.Modal(document.getElementById("residentModal"));
            const openModalBtn = document.getElementById("openModalBtn");
            const residentList = document.getElementById("residentList");
            const searchInput = document.getElementById("searchResident");
            const saveResidentBtn = document.getElementById("saveResidentBtn");
            const selectedResidentDisplay = document.getElementById("selectedResident");
            const midwifeUsernameInput = document.getElementById("midwifeUsername");
            const midwifePasswordInput = document.getElementById("midwifePassword");

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
                if (!selectedResident) return;

                // Create form data to send
                const formData = new FormData();
                formData.append("resident_id", selectedResident.id);
                formData.append("resident_name", selectedResident.name);
                formData.append("personal_info_id", selectedResident.personalInfoId);
                formData.append("midwife_username", midwifeUsernameInput.value);
                formData.append("midwife_password", midwifePasswordInput.value);

                // Send data to backend
                fetch("../controllers/admin_appoint_midwife_from_residents.php", {
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
                            text: 'Resident successfully appointed as midwife.',
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
            openModalBtn.addEventListener("click", function () {
                modal.show();
                fetchResidents();
                selectedResident = null;  // Reset selection
                selectedResidentDisplay.innerText = "No resident selected.";
                saveResidentBtn.setAttribute("disabled", "true");
                midwifeUsernameInput.value = "";  // Reset username and password fields
                midwifePasswordInput.value = "";
            });
        });

    </script>
</body>
</html>
