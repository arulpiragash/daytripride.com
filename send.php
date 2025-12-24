<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Form data
$firstName = htmlspecialchars($_POST['firstName']);
$lastName  = htmlspecialchars($_POST['lastName']);
$email     = htmlspecialchars($_POST['email']);
$phone     = htmlspecialchars($_POST['phone']);
$subject   = htmlspecialchars($_POST['subject']);
$message   = nl2br(htmlspecialchars($_POST['message']));

$mail = new PHPMailer(true);

try {
    // SMTP settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'yourmail@gmail.com'; // 🔴 change
    $mail->Password   = 'APP_PASSWORD_HERE';  // 🔴 change
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Email settings
    $mail->setFrom('yourmail@gmail.com', 'Website Contact');
    $mail->addAddress('yourmail@gmail.com'); // where you receive

    $mail->addReplyTo($email, $firstName);

    $mail->isHTML(true);
    $mail->Subject = "Contact Form: $subject";

    $mail->Body = "
        <h3>New Message Received</h3>
        <p><b>Name:</b> $firstName $lastName</p>
        <p><b>Email:</b> $email</p>
        <p><b>Phone:</b> $phone</p>
        <p><b>Message:</b><br>$message</p>
    ";

    $mail->send();
    echo "<script>alert('Message sent successfully');window.history.back();</script>";

} catch (Exception $e) {
    echo "Mail Error: {$mail->ErrorInfo}";
}
?>
