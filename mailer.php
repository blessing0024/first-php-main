<?php

use PHPMailer\PHPMailer\PHPMailer;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';
    
$mail = new PHPMailer(true);

$mail->isSMTP();    //this is the smtp method
$mail->SMTPAuth = true;//this is the smtp auth property

//smtp server configuration
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "tls";
$mail->Port = '587';
//authentication information
$mail->Username = 'ladytech35@gmail.com';//email where the token will be sent from
$mail->Password = 'kgfrrxxptoxgvvje';


$mail->isHTML(true);

return $mail;