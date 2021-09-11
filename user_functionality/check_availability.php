<?php
# create database connection
include 'dbc.php';

$connect = mysqli_connect($servername, $username, $password, $dbname);

if(!empty($_POST["email"])) {
  $query = "SELECT * FROM user WHERE email='" . $_POST["email"] . "'";
  $result = mysqli_query($connect,$query);
  $count = mysqli_num_rows($result);
  if($count>0) {
    echo "<span style='color:red'> Sorry email already exists .</span>";
    echo "<script>$('#submit').prop('disabled',true);</script>";
  }else{
    echo "<span style='color:green'> Email available for Registration .</span>";
    echo "<script>$('#submit').prop('disabled',false);</script>";
  }
}
?>