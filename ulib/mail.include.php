<?php
// Include PHPMailer to enable the following functions
require 'PHPMailer/PHPMailerAutoload.php' ;
$mail = new PHPMailer;
$mail->isSMTP();    // Use SMTP protocol to send the email

$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='booklibseat@gmail.com';
$mail->Password='Bls114514';

$mail->setFrom('confirm@booklibseat.org','Book Lib Seat');
// $mail->addCC('1155109544@link.cuhk.edu.hk');

$mail->isHTML(true);    //Set the email message to be HTML type
$mail->Subject='Book Lib Seat Confirmation';
$mail->Body='<h1 align=center>Hello<h1>';
