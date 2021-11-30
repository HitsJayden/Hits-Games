<?php
if(!isset($_SESSION)) 
{ 
  session_start(); 
} 
require 'scripts/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = '';                 // SMTP username
$mail->Password = '';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to=$_SESSION['email'];
$mail->setFrom('', 'Mailer');
$mail->addAddress($to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Account Confirmation Message';
$mail->Body = "
 
Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
------------------------<br><br><br><br>
Username:" .$_SESSION['username']."<br>
Password:" .$_SESSION['password']."<br><br><br><br>
------------------------
 
Please click this link to activate your account:----------------------<br><br><br><br>
http://localhost/UserLogin/verify.php?email=".$_SESSION['email']."&activation_code=".$_SESSION['activation_code']."  "; // Our message above including the link

$mail->send();

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} 
?>




