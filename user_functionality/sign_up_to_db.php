<?php
// Always start this first
session_start();

include 'dbc.php';

// Taking all 5 values from the form data(input)
$uname =  $_POST['uname'];

if($_POST['gender']==''){
  $gender=null;
}
else{
  $gender =  $_POST['gender'];
}

$pass = $_POST['pwd'];
$email = $_POST['email'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

/*$sql = "INSERT INTO user (email, username, pwd, gender)
VALUES ('alex@gmail.com', 'alexMonkey', 'm@rdy8um', 'male');";
*/
$sql = "INSERT INTO user (email, username, pwd, gender)
VALUES ('$email','$uname','$pass','$gender')";


if (mysqli_query($conn, $sql)) {
  //echo "New record created successfully";
  $_SESSION['user_id'] = $email;
  $_SESSION['uname'] = $uname;
  $_SESSION['pwd'] = $pass;
  header("Location: main_user.php");
  exit();
} else {
  session_destroy();
  echo "Error: " , $sql , "<br>" , mysqli_error($conn);
}
mysqli_close($conn);
?>