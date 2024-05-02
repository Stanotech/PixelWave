<?php
/**
 * This PHP script sends an email using PHPMailer.
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/Exception.php';
require './PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {

  // Gather data from the form
  $formName = $_POST['name']; // Get the name from the form
  $formEmail = $_POST['email']; // Get the email from the form
  $formSubject = $_POST['subject']; // Get the subject from the form
  $formMessage = $_POST['message']; // Get the message from the form

  //Server settings
  $mail->isSMTP(TRUE); // Send using SMTP
  $mail->Host = 'madmesis.home.pl'; // Set the SMTP server to send through
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = 'mateusz@krzyk.pl'; // SMTP username
  $mail->Password = 'MinisterJeBanany^M'; // SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
  $mail->Port = 587; // TCP port to connect to

  //Recipients
  $mail->setFrom($formEmail, $formName); // Add a sender
  $mail->addAddress('office@pixelum.com', 'Pixelum'); // Add a recipient

  // Content
  $mail->isHTML(false); // Set email format to HTML (true) or plain text (false)
  $mail->Subject = $formSubject; // Email subject
  $mail->Body = $formMessage; // Message body
  $mail->AltBody = $formMessage; // Plain text body

  $mail->send(); // Send email

  echo 'OK'; // Return response when message sent successfully
}
catch (Exception $e) {
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Return error message
}
