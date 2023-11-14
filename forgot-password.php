<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgotten Password</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    
    <h1>Forgot Password</h1>
    <p>Enter your registered email to reset your password.</p>
    <form action="send-password-reset.php" method="post">
        <label for="email">Email</label> <br>
        <input type="email" name="email" id="email">

        <button>Send</button>
    </form>

</body>
</html>