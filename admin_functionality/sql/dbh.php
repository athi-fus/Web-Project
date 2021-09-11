<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web2021final";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    die("Connections failed: " .$conn->error);
}