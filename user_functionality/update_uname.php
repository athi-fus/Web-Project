<?php
// You'd put this code at the top of any "protected" page you create

// Always start this first
session_start();

if ( isset( $_SESSION['user_id'] ) ) {
    // Grab user data from the database using the user_id
    // Let them access the "logged in only" pages
} 
else {
    // Redirect them to the login page
    header("Location: login.html");
}


include 'dbc.php';

$uname =  $_POST['unamen'];
$email = $_SESSION['user_id'];
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "UPDATE user
SET username='$uname'
WHERE email='$email';";


if (mysqli_query($conn, $sql)) {
  echo "Record updated successfully";
  $_SESSION['uname']=$uname;
} else {
  echo "Error: " , $sql , "<br>" , mysqli_error($conn);
}
mysqli_close($conn);

?>