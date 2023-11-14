<?php
//email from forgotten password
$email = $_POST["email"];
//binding random byte
$token = bin2hex(random_bytes(16));
//hash the token to hide it, just like password hash
$token_hash = hash("sha256", $token);
//create timing for token to expire
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);
//link to the db
$mysqli = require __DIR__ . "/database.php";
//update users to be able to reset password
$sql = "UPDATE users
        SET reset_token_hash = ?,
        reset_token_expires_at = ?
        WHERE email = ?";

 //prepare the db       
$stmt = $mysqli->prepare($sql);
//binding the strings token hash, expiry time and email
$stmt->bind_param("sss", $token_hash, $expiry, $email);
//execute
$stmt->execute();


//conditional statement
if ($mysqli->affected_rows){

    $mail = require __DIR__ ."/mailer.php";

    $mail->setFrom("ladytech35@gmail.com");//this is to be the email of the company where the email or token will be sent from
    $mail->addAddress($email);//this is the email of the person who is resetting the password, that will receive the token sent to be able to reset password
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/first-php-main/reset-password.php?token=$token" >Here</a>

    END;

    try{
        $mail->send();
    }catch (Exception $e){
        echo "Your message could not be sent, Mailer error: {$mail->ErrorInfo}";
    }
}
    echo "Message sent successfully. Pleases, check your inbox";