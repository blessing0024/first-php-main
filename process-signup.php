<?php
//this is to create a required field
if(empty($_POST["name"])){
    die("Name is required");
}

//this is email validation, for correct email
if(! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
    die("email is required");
}

// if(empty($_POST["phone_number"])){
//     die("phone number is required");
// }

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

$mysqli = require __DIR__ . "/database.php";
//this helps us to insert data into
$sql = "INSERT INTO users (name, email, /*phone_number,*/ password_hash)
/*  ? this is used as placeholder   */
            VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

if(!  $stmt->prepare($sql)){
    die("SQL ERROR: " . $mysqli->error);
}
//binding parameter
$stmt->bind_param("sss",
                    $_POST["name"],
                    $_POST["email"],
                    // $_POST["phone_number"],
                    $password_hash); /*use password_hash to hide password */
//if successful
    if ($stmt->execute()){
        header("location: success.html");

        exit;
    } else {
        die("Email already taken");
    }
        // if ($mysqli->errno === 1062){
        //     die("Email is taken");
        // }else{
        //     die($mysqli->error . " " . $mysqli->errno);
        // }






// echo "Registered Successfully.";

// var_dump($password_hash);
// print_r($_POST);