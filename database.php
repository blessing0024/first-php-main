<?php

$host = "localhost";
$dbname = "register_db";
$username = "root";
$password = ""; //when hosting, db needs a password

//this is the connection
$mysqli = new mysqli(hostname: $host,
                    database: $dbname,
                    username: $username,
                    password: $password);

                    
if ($mysqli->connect_errno){
    die("Connection Error: " . $mysqli->connect_error);
}
return $mysqli;