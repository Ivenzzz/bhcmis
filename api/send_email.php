<?php
// Load PHPMailer autoload
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include the PHPMailer files
require '../vendor/autoload.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';        // Specify SMTP server (e.g., Gmail)
    $mail->SMTPAuth = true;               // Enable SMTP authentication
    $mail->Username = 'ivenloro@gmail.com'; // SMTP username
    $mail->Password = 'mrxdlzfmqrczgrsg'; // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587;                    // TCP port to connect to

    // Recipients
    $mail->setFrom('ivenloro@gmail.com', 'Iven Loro'); // Sender email and name
    $mail->addAddress('iven.loro@csav.edu.ph', 'Iven Loro'); // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = 'This is a <b>test email</b> sent using PHPMailer!';
    $mail->AltBody = 'This is a test email sent using PHPMailer (plain text version).';

    // Send the email
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
