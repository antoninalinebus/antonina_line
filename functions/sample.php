<?php
$name = 'asd';
$age = '24';
$ticket = '0992962612';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'antoninalinebus@gmail.com';                     //SMTP username
    $mail->Password   = 'egtdclhcvhnnsmwq';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('antonina_line@noreply.com', 'Antonina Line Bus System');
    $mail->addAddress('nhojhenrysy@gmail.com');     //Add a recipient
    
    $message = "Name".$name."/n"."Age".$age."/n"."Ticket".$ticket;
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Antonina-line Ticket';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>