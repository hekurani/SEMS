<?php

include ("../../php-mailer/PHPMailer.php");
include("../../php-mailer/SMTP.php");
include("../../php-mailer/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail( $email, $message, $subject,$name){
$mail = new PHPMailer(true); // Enable exceptions
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        //Enable less security apps in email
        //Replace your student email and password in here
        $mail->Username = 'hekuran.kokolli@student.uni-pr.edu';
        $mail->Password = 'hekurankokolli123';
        $mail->Port = 587;

        $mail->setFrom('hekuran.kokolli@student.uni-pr.edu', $name);
        $mail->addReplyTo($email);
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    }
?>