<?php
// Include the PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

// Include database connection (update the path if necessary)
require '../partials/global_db_config.php';

// Read input data
$data = json_decode(file_get_contents('php://input'), true);
$email = $data['email'] ?? null;

// Check if email is provided
if (!$email) {
    echo json_encode(['success' => false, 'message' => 'Email is required.']);
    exit;
}

// Generate a random 6-digit OTP
$otp = mt_rand(100000, 999999);

// Set OTP expiration time (e.g., 5 minutes from now)
$expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                           // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through (change to your SMTP server)
    $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
    $mail->Username   = 'ivenloro@gmail.com';                // SMTP username
    $mail->Password   = 'mrxdlzfmqrczgrsg';                    // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption
    $mail->Port       = 587;                                     // TCP port to connect to

    // Recipients
    $mail->setFrom('no-reply@example.com', 'BHCMIS-Punta-Mesa');
    $mail->addAddress($email);                                    // Add a recipient

    // Content
    $mail->isHTML(true);                                          // Set email format to HTML
    $mail->Subject = 'Your OTP Code for BHCMIS';
    $mail->Body    = "Your OTP Code is: <b>$otp</b><br><br> This will expire in 5 minutes.";

    // Send the email
    if ($mail->send()) {
        echo json_encode(['success' => true, 'message' => 'OTP sent to your email.', 'otp' => $otp]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send OTP email.']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
}
?>