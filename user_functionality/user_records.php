<?php
// Always start this first
session_start();

$servername = "localhost";
$username = "athinaf";
$password = "12345#";
$dbname = 'har_proj';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$users = array();
$sql = "SELECT COUNT(id_har)AS numOfRecords, MAX(date_of_upload) as LastUpload FROM `har_file` WHERE user_email ='". $_SESSION['user_id']."' ";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $users[] =  $row;
    }
}else{
    echo 'There are no users!';
}
echo json_encode($users);
$conn->close();
?>