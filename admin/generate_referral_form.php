<?php

session_start();

$title = 'Generate Referral Form';

require '../partials/global_db_config.php';
require '../models/get_current_user.php';
require '../models/referrals.php';

$user = getCurrentUser($conn);
$referral_id = $_GET['referral_id'];
$referral_info = getReferralByReferralId($conn, $referral_id);
$admin_info = getAdminInformation($conn, $user['admin_id']);
$brgy_captain = getBrgyCaptainDetails($conn, 1);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require '../partials/global_head.php'; ?>
    <link rel="stylesheet" href="../public/css/main.css">
    <!-- CSS Styles -->
<style>
    .underline {
        display: block;
        position: relative;
        padding-bottom: 3px;
        width: 100%;
    }

    .underline::after {
        content: '';
        display: block;
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 1.5px;
        background-color: black;
    }

    .underlined-input {
        border: none;
        border-bottom: 1px solid #000;
        border-radius: 0;
        padding: 0;
        background-color: transparent;
        width: 100%;
        outline: none;
    }

    .underlined-input:focus {
        border-bottom: 2px solid #000;
    }

    @media print {
        body {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }

    #referralDocument {
        background-color: white;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
</style>

</head>
<body class="poppins-regular">
    <?php require 'partials/sidebar.php'; ?>

    <div class="flex-grow-1 bg-slate-100">

        <?php require 'partials/header.php'; ?>        
        <div class="container mt-4 px-5" id="referralDocument">
            <div id="referralID" data-referral-id="<?= htmlspecialchars($referral_id) ?>"></div>
                <div class="row mb-4 open-sans-regular shadow p-5">
                    <div class="col-md-12 mb-4 d-flex justify-content-center align-items-center">
                        <img src="../public/images/punta_mesa_logo.png" 
                            alt="Municipality Logo" 
                            class="mw-rm-4 me-5">
                        <div class="text-center">
                            <p class="mb-1">Republic of the Philippines</p>
                            <p class="mb-1">MUNICIPALITY OF MANAPLA</p>
                            <p>Barangay Punta Mesa Health Center</p>
                        </div>
                        <img src="../public/images/manapla_logo.png" class="mw-rm-4 ms-5" alt="">
                    </div>
                    <div class="col-md-12 mb-4">
                        <form id="referralForm" class="p-4">
                        <input type="hidden" name="consultation_id" value="<?= $consultation_id ?>">
                        <input type="hidden" name="resident_id" value="<?= $referral_info['resident_id'] ?>">
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
                                <span class="underline"><?= htmlspecialchars($referral_info['refer_to'] ?? '') ?></span>
                                <label class="form-label">Referred To</label>
                            </div>
                            <div class="col-md-4 mb-4">
                                <span class="underline">Barangay Punta Mesa Health Center</span>
                                <label class="form-label">Referred From</label>
                            </div>
                            <div class="col-md-4 mb-4">
                                <span class="underline"><?= htmlspecialchars(date('M d, Y')) ?></span>
                                <label class="form-label">Date</label>
                            </div>
                            <div class="col-md-8 mb-4">
                                <span class="underline">
                                    <?= htmlspecialchars(
                                        ($referral_info['firstname'] ?? '') . 
                                        (!empty($referral_info['middlename']) ? ' ' . substr($referral_info['middlename'], 0, 1) . '.' : '') . 
                                        ' ' . ($referral_info['lastname'] ?? '')
                                        ) ?>
                                </span>
                                <label class="form-label">Name of Patient</label>
                            </div>
                            <div class="col-md-2 mb-4">
                                <span class="underline"><?= htmlspecialchars($referral_info['age'] ?? '') ?></span>
                                <label class="form-label">Age</label>
                            </div>
                            <div class="col-md-2 mb-4">
                                <span class="underline"><?= htmlspecialchars($referral_info['date_of_birth'] ?? '') ?></span>
                                <label class="form-label">Date of Birth</label>
                            </div>
                            <div class="col-md-5 mb-4">
                                <input type="text" class="underlined-input" value="<?= htmlspecialchars($referral_info['civil_status'] ?? '') ?>" readonly>
                                <label class="form-label">Civil Status</label>
                            </div>
                            <div class="col-md-7 mb-4">
                                <input type="text" class="underlined-input" value="<?= htmlspecialchars(ucfirst(strtolower($referral_info['sex'] ?? ''))) ?>" readonly>
                                <label class="form-label">Sex</label>
                            </div>
                            <div class="col-md-6 mb-4">
                                <input type="text" class="underlined-input" 
                                value="<?= htmlspecialchars($referral_info['religion'] ?? '') ?>">
                                <label class="form-label">Religion</label>
                            </div>
                            <div class="col-md-6 mb-5">
                                <input type="text" class="underlined-input" 
                                value="<?= htmlspecialchars($referral_info['occupation'] ?? '') ?>">
                                <label class="form-label">Occupation</label>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="chief_complaint_brief_history" class="form-label">Chief Complaint/Brief History *</label>
                                <textarea class="underlined-input" id="chief_complaint_brief_history" 
                                        rows="1" required><?= htmlspecialchars($referral_info['chief_complaint_brief_history'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-3">
                                <p>Patient Examination Findings: </p>
                            </div>
                            
                            <div class="col-md-2 mb-4">
                                <div class="input-group-underline">
                                    <input type="number" step="0.1" 
                                        class="underlined-input" 
                                        id="weight_kg" 
                                        name="weight_kg" 
                                        value="<?= htmlspecialchars($referral_info['weight_kg'] ?? '') ?>">
                                    <label for="weight_kg">Weight (kg)</label>
                                </div>
                            </div>

                            <!-- Temperature Input -->
                            <div class="col-md-2 mb-4">
                                <div class="input-group-underline">
                                    <input type="text" 
                                        class="underlined-input" 
                                        id="temperature" 
                                        name="temperature"
                                        value="<?= htmlspecialchars($referral_info['temperature'] ?? '') ?>">
                                    <label for="temperature">Temperature (°C)</label>
                                </div>
                            </div>

                            <!-- Heart Rate Input -->
                            <div class="col-md-2 mb-4">
                                <div class="input-group-underline">
                                    <input type="text" 
                                        class="underlined-input" 
                                        id="heart_rate" 
                                        name="heart_rate"
                                        value="<?= htmlspecialchars($referral_info['heart_rate'] ?? '') ?>">
                                    <label for="heart_rate">Heart Rate (bpm)</label>
                                </div>
                            </div>

                            <!-- Blood Pressure Input -->
                            <div class="col-md-2 mb-4">
                                <div class="input-group-underline">
                                    <input type="text" 
                                        class="underlined-input" 
                                        id="blood_pressure" 
                                        name="blood_pressure"
                                        value="<?= htmlspecialchars($referral_info['blood_pressure'] ?? '') ?>">
                                    <label for="blood_pressure">Blood Pressure</label>
                                </div>
                            </div>

                            <div class="col-md-12 mb-4">
                                <label for="diagnosis" class="form-label">Impression/Diagnosis *</label>
                                <textarea class="underlined-input" id="diagnosis" 
                                        required rows="1"><?= htmlspecialchars($referral_info['diagnosis'] ?? '') ?></textarea>
                            </div>
                            <div class="col-md-12 mb-4">
                                <label for="action_taken" class="form-label">Action Taken/Treatment Given</label>
                                <textarea class="underlined-input" id="action_taken" name="action_taken" rows="1" required><?php echo htmlspecialchars($referral_info['action_taken'] ?? ''); ?></textarea>
                            </div>
                        </div>
                        
                        <?php $selected_purpose = $referral_info['purpose'] ?? ''; ?>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Reason for Referral</label>

                                <?php 
                                $purposes = [
                                    "Further Evaluation and Management",
                                    "For Work-up",
                                    "Per Patient Request",
                                    "Medico-Legal",
                                    "No Doctor Available"
                                ];

                                foreach ($purposes as $index => $purpose) : 
                                    $isChecked = ($selected_purpose === $purpose) ? 'checked' : '';
                                ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="purpose<?= $index + 1; ?>" 
                                            name="purpose" value="<?= $purpose; ?>" <?= $isChecked; ?> required>
                                        <label class="form-check-label" for="purpose<?= $index + 1; ?>"><?= $purpose; ?></label>
                                    </div>
                                <?php endforeach; ?>

                                <!-- "Others" Input Field -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="purpose6" 
                                        name="purpose" value="Others" <?= ($selected_purpose !== '' && !in_array($selected_purpose, $purposes)) ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="purpose6">Others</label>
                                    <input type="text" class="underlined-input mt-2 <?= ($selected_purpose !== '' && !in_array($selected_purpose, $purposes)) ? '' : 'd-none'; ?>" 
                                        id="purpose_others" name="purpose_others" 
                                        placeholder="Please specify" 
                                        value="<?= (!in_array($selected_purpose, $purposes)) ? htmlspecialchars($selected_purpose) : ''; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-2"><p>Referred By: </p></div>
                            <div class="col-md-10">
                                <p class=""><span class="underline"><?= htmlspecialchars($referral_info['referring_physician'] ?? '') ?></span></p>
                            </div>
                        </div>

                        <!-- Admin Signature Section -->
                        <div class="row mb-4">
                            <label class="form-label">Signed:</label>
                            <div class="col-md-6 d-flex align-items-center flex-column justify-content-center">    
                                <!-- Display the Barangay Captain's signature -->
                                <?php if ($brgy_captain && $brgy_captain['signature_path']): ?>
                                    <img id="punongBarangayPreview" src="<?= htmlspecialchars($brgy_captain['signature_path']) ?>" alt="Barangay Captain's signature" style="max-width: 200px;">
                                <?php else: ?>
                                    <p>No signature available</p>
                                <?php endif; ?>

                                <!-- Punong Barangay Text -->
                                <p class="mt-2 text-center underline"><strong>Barangay Captain Ernesto Victorino</strong></p>
                                <p>(PRINTED NAME & SIGNATURE)</p>
                            </div>
                        </div>



                        <div class="row mb-4">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="button" id="generateReferral" class="btn btn-primary">Generate Referral</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        </div>
  </div>

    <?php require '../partials/global_javascript_links.php'; ?>
    <script src="../public/js/global_logout.js"></script>
    <script src="../public/js/admin_generate_referral_form.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const generateBtn = document.getElementById('generateReferral');
            const referralIDElement = document.getElementById('referralID');
            const referralId = referralIDElement.dataset.referralId;

            generateBtn.addEventListener('click', function() {
                const element = document.getElementById('referralDocument');
                const originalBtnStyle = generateBtn.style.cssText;
                
                // Hide the button before capturing
                generateBtn.style.display = 'none';

                html2canvas(element, {
                    scale: 2,
                    useCORS: true,
                    logging: true,
                }).then(canvas => {
                    const { jsPDF } = window.jspdf;
                    const pdf = new jsPDF('p', 'mm', 'a4');
                    const imgWidth = 210;
                    const imgHeight = (canvas.height * imgWidth) / canvas.width;
                    
                    pdf.addImage(canvas, 'PNG', 0, 0, imgWidth, imgHeight);
                    
                    // Convert PDF to Base64 string
                    const pdfData = pdf.output('datauristring');
                    const base64Data = pdfData.split(',')[1];

                    // Send PDF data to server
                    fetch('../controllers/admin_update_referral.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            pdf: base64Data,
                            referral_id: referralId,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Referral form saved successfully!',
                                showConfirmButton: true
                            }).then(() => {
                                window.location.href = 'document_requests.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: data.error || 'Error saving referral form'
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Connection Error',
                            text: 'Failed to save referral form'
                        });
                    });
                }).catch(error => {
                    console.error('Error generating PDF:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'PDF Generation Failed',
                        text: 'Error generating PDF. Please check the console for details.'
                    });
                }).finally(() => {
                    // Restore button visibility after processing
                    generateBtn.style.cssText = originalBtnStyle;
                });
            });

            // Handle "Others" radio button interaction
            document.querySelectorAll('input[name="purpose"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const othersInput = document.getElementById('purpose_others');
                    othersInput.classList.toggle('d-none', this.value !== 'Others');
                    if (this.value !== 'Others') othersInput.value = '';
                });
            });
        });
    </script>
</body>
</html>
