<?php  

$is_invalid = false;


//this is to know the method used, post or get. to post is to put in with button
if($_SERVER["REQUEST_METHOD"] === "POST"){
    //this is to locate the directory of the database
    $mysqli = require __DIR__ . "/database.php";

    //this help select info from the table you've created in the db
    $sql = sprintf("SELECT * FROM users
            WHERE email = '%s'",        /*this means empty email*/
            $mysqli->real_escape_string($_POST["email"])); /*this is the user typed in email*/

            $result = $mysqli->query($sql); /*the search has been done here using sql query*/
            $user = $result->fetch_assoc(); /*this gets the actual email for the login*/

            if($user){
                //this confirms the input password with the hash_password, if correct, then login
               if(password_verify($_POST["password"], $user["password_hash"])){
               
                    session_start();

                    $_SESSION["user_id"] = $user["id"];
                    header("Location: index.php"); 
                    exit;
               }

            }
            $is_invalid = true;
}



?>












<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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


        <div class="content" >
            

            <h2>Login <span>Here</span></h2>

            <!-- this is php code for invalid login -->
            <?php if($is_invalid): ?>
                <em>Your Login is Invalid</em>
            <?php endif; ?>


            <form class="form" method="post" >
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= htmlspecialchars($_POST["email"] ?? "")?>" > <br>
                <input type="password" name="password" id="password" placeholder="Enter your password" >
                

                <button class="login-btn"> 
                    Login
                </button>


                
                <p class="login"> Don't have an account? <br>
                    <a href="signup.html"> Register </a>here</a>
                </p>

                <p>
                    <a href="password_reset.php" >Forgotten Password?</a>
                </p>

                <p class="socials"> Login with:</p>

                <div class="icons">
                    <a href="https://facebook.com"><ion-icon name="logo-facebook"></ion-icon>  </a>
                    <a href="https://instagram.com"> <ion-icon name="logo-instagram"> </ion-icon>  </a>
                    <a href="https://twitter.com"> <ion-icon name="logo-twitter"> </ion-icon>  </a>
                    <a href="https://tiktok.com"> <ion-icon name="logo-tiktok"> </ion-icon>  </a>
                </div>

            </form>
        </div>

    </div>


</body>

</html>