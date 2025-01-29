<?php
session_start();
$title = 'Create Referral Form';
require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/referrals.php';


$user = getCurrentUser($conn);
$consultation_id = $_GET['consultation_id'];
$consultation_details = getConsultationDetails($consultation_id);
$midwife = getMidwifeInformation($conn, $user['midwife_id']);
$midwife_name = $midwife['firstname'] . (!empty($midwife['middlename']) ? ' ' . $midwife['middlename'] : '') . ' ' . $midwife['lastname'];



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
                <div class="col-md-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="consultations.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Referral Form</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row mb-4 shadow">
                <div class="col-md-12">
                    <form id="referralForm" class="p-4">
                        <input type="hidden" name="consultation_id" value="<?= $consultation_id ?>">
                        <input type="hidden" name="resident_id" value="<?= $consultation_details['resident_id'] ?>">
                        <input type="hidden" name="midwife_name" value="<?= htmlspecialchars($midwife_name) ?>">

                        <div class="row mb-4">
                            <div class="col-md-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="isEmergency" name="isEmergency" value="1">
                                    <label class="form-check-label" for="isEmergency">
                                        Priority/Emergency Referral
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Referred To</label>
                                <input type="text" class="form-control" name="referring_to_facility" value="<?= htmlspecialchars($consultation_details['refer_to'] ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Referred From</label>
                                <input type="text" class="form-control" value="Barangay Punta Mesa Health Center" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label">Date</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars(date('M d, Y')) ?>" readonly>
                            </div>
                            <div class="col-md-8 mb-4">
                                <label class="form-label">Name of Patient</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars(
                                    ($consultation_details['firstname'] ?? '') . 
                                    (!empty($consultation_details['middlename']) ? ' ' . substr($consultation_details['middlename'], 0, 1) . '.' : '') . 
                                    ' ' . ($consultation_details['lastname'] ?? '')
                                ) ?>" readonly>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label class="form-label">Age</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($consultation_details['age'] ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-2 mb-4">
                                <label class="form-label">Date of Birth</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($consultation_details['date_of_birth'] ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-5 mb-4">
                                <label class="form-label">Civil Status</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($consultation_details['civil_status'] ?? '') ?>" readonly>
                            </div>
                            <div class="col-md-7 mb-4">
                                <label class="form-label">Sex</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars(ucfirst(strtolower($consultation_details['sex'] ?? ''))) ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Religion</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($consultation_details['religion'] ?? '') ?>">
                            </div>
                            <div class="col-md-6 mb-5">
                                <label class="form-label">Occupation</label>
                                <input type="text" class="form-control" value="<?= htmlspecialchars($consultation_details['occupation'] ?? '') ?>">
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="chief_complaint_brief_history" class="form-label">Chief Complaint/Brief History *</label>
                                <textarea class="form-control" id="chief_complaint_brief_history" name="chief_complaint_brief_history" rows="3" required></textarea>
                            </div>

                            <div class="col-md-3">
                                <p>Patient Examination Findings: </p>
                            </div>
                            
                            <div class="col-md-2 mb-4">
                                <input type="number" step="0.1" class="form-control" id="weight_kg" name="weight_kg" 
                                value="<?= htmlspecialchars($consultation_details['weight_kg'] ?? '') ?>">
                                <label for="weight_kg" class="form-label">Weight (kg)</label>
                            </div>
                            <div class="col-md-2 mb-4">
                                <input type="text" class="form-control" id="temperature" name="temperature"
                                value="<?= htmlspecialchars($consultation_details['temperature'] ?? '') ?>">
                                <label for="temperature" class="form-label">Temperature (°C)</label>
                            </div>
                            <div class="col-md-2 mb-4">
                                <input type="text" class="form-control" id="heart_rate" name="heart_rate"
                                value="<?= htmlspecialchars($consultation_details['heart_rate'] ?? '') ?>">
                                <label for="heart_rate" class="form-label">Heart Rate (bpm)</label>
                            </div>
                            <div class="col-md-2 mb-4">
                                <input type="text" class="form-control" id="blood_pressure" name="blood_pressure"
                                value="<?= htmlspecialchars($consultation_details['blood_pressure'] ?? '') ?>">
                                <label for="blood_pressure" class="form-label">Blood Pressure</label>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="diagnosis" class="form-label">Impression/Diagnosis *</label>
                                <textarea class="form-control" id="diagnosis" name="diagnosis" required maxlength="100" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="action_taken" class="form-label">Action Taken/Treatment Given</label>
                                <textarea class="form-control" id="action_taken" name="action_taken" rows="3" required></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Reason for Referral</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose1" name="purpose" value="Further Evaluation and Management" required>
                                    <label class="form-check-label" for="purpose1">Further Evaluation and Management</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose2" name="purpose" value="For Work-up">
                                    <label class="form-check-label" for="purpose2">For Work-up</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose3" name="purpose" value="Per Patient Request">
                                    <label class="form-check-label" for="purpose3">Per Patient Request</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose4" name="purpose" value="Medico-Legal">
                                    <label class="form-check-label" for="purpose4">Medico-Legal</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose5" name="purpose" value="No Doctor Available">
                                    <label class="form-check-label" for="purpose5">No Doctor Available</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose6" name="purpose" value="Others">
                                    <label class="form-check-label" for="purpose6">Others</label>
                                    <input type="text" class="form-control mt-2 d-none" id="purpose_others" name="purpose_others" maxlength="100" placeholder="Please specify">
                                </div>
                            </div>  
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="button" id="submitReferral" class="btn btn-primary">Submit Referral</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script>
        document.getElementById('submitReferral').addEventListener('click', async () => {
            const form = document.getElementById('referralForm');
            const formData = new FormData(form);

            // Handle 'Others' purpose text field
            const othersRadio = document.getElementById('purpose6');
            if (othersRadio.checked) {
                formData.append('purpose_others', document.getElementById('purpose_others').value);
            }

            // Prepare and send the POST request
            try {
                const response = await fetch('../controllers/midwife_save_referral_info.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error('Failed to submit referral. Please try again.');
                }

                const result = await response.json();
                if (result.success) {
                    await Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Referral submitted successfully to the Brgy. Secretary!',
                        confirmButtonText: 'OK',
                    });
                    window.location.href = 'consultations.php'; // Redirect or handle success
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: result.message || 'Unknown error occurred.',
                        confirmButtonText: 'OK',
                    });
                }
            } catch (error) {
                console.error(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                    confirmButtonText: 'OK',
                });
            }
        });

        // Toggle "Others" input field visibility
        document.getElementById('purpose6').addEventListener('change', function () {
            const othersInput = document.getElementById('purpose_others');
            othersInput.classList.toggle('d-none', !this.checked);
            if (this.checked) othersInput.focus();
        });

        document.querySelectorAll('input[name="purpose"]').forEach(radio => {
            radio.addEventListener('change', function () {
                if (this.value !== 'Others') {
                    document.getElementById('purpose_others').value = '';
                }
            });
        });
    </script>

</body>
</html>