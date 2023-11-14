<?php
$token = $_GET["token"];

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
echo "Token is Valid";

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    

    <div class="main">
        <div class="navbar">
                    <!-- this is logo area -->
            <div class="icon">
                <h2 class="logo">Jay</h2>
            </div>
                   <!-- this is navigtion area -->
            <div class="menu">
                <ul> 
                    <li> <a href="#">Home</a> </li>
                    <li> <a href="#">About</a></li>
                    <li> <a href="#">Services</a></li>
                    <li> <a href="#">Designs</a></li>
                    <li> <a href="#">Connect</a></li>
                </ul>
                
            </div>
           
                       <!-- this is search bar area -->
            <div class="search">
                <input class="search-it" type="search" name="" placeholder="Search for anything">
               <a href="#">  <button class="search-btn">Search</button> </a>

            </div>
            
        </div>


        <div class="content">

            <h1>Reset Your <span>Password</span></h1>
            <form action="process-reset-password.php" method="post">
                <input type="hidden" name="token" value="<?=htmlspecialchars($token) ?>" >  <br/>
                <label for="password" >New Password</label>   <br/>
                <input id="password" type="password" name="password">     <br/>

                <label for="password_confirmation" >Repeat Password</label>    <br/>
                <input id="password_confirmation" type="password" name="password_confirmation"> 

                <button>Send</button>
            </form>

        </div>


    </div>

</body>
</html>