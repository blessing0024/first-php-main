<?php

$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM users
            WHERE reset_token_hash = ?";
    
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null){
    die("This token is not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()){
    die("Sorry, Token Expired");
}

//setting condition for password length
if(strlen($_POST["password"] < 8)){
    die("password must be at least 8 character");
}

//setting condition for password char
if(! preg_match("/[a-z]/i", $_POST["password"])){
    die("password must contain at least one letter");
}

//setting condition for password number
if(! preg_match("/[0-9]/i", $_POST["password"])){
    die("password must contain at least one number");
}

//password must match condition
if ($_POST["password"] !== $_POST["password_confirmation"]){
    die("Sorry, your passwords did not match");
}

//password hash to hide the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

//to update the database inserting new password
$sql = "UPDATE users
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = ?";

        $stmt = $mysqli->prepare($sql);
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ss", $password_hash, $user["id"]);
        $stmt->execute();
        header("Location: login.php")

?>