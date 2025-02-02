<?php
require '../partials/global_db_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $stmt = $conn->prepare("
            INSERT INTO referral_requests 
            (resident_id, isEmergency, purpose, referring_to_facility, 
            chief_complaint_brief_history, diagnosis, action_taken, consultation_id, referring_physician, request_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        // Assign POST values to variables
        $residentId = $_POST['resident_id'];
        $isEmergency = isset($_POST['isEmergency']) ? 1 : 0;
        $purpose = $_POST['purpose'] ?? null;
        $referringToFacility = $_POST['referring_to_facility'] ?? 'Barangay Punta Mesa Health Center';
        $chiefComplaintBriefHistory = $_POST['chief_complaint_brief_history'];
        $diagnosis = $_POST['diagnosis'];
        $actionTaken = $_POST['action_taken'];
        $consultationId = $_POST['consultation_id'];
        $referringPhysician = 'Midwife ' . ($_POST['midwife_name'] ?? '');
        $requestDate = date('Y-m-d'); // Current date in 'YYYY-MM-DD' format

        // Bind parameters
        $stmt->bind_param(
            'iissssssss',
            $residentId,
            $isEmergency,
            $purpose,
            $referringToFacility,
            $chiefComplaintBriefHistory,
            $diagnosis,
            $actionTaken,
            $consultationId,
            $referringPhysician,
            $requestDate
        );

        $stmt->execute();
        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
