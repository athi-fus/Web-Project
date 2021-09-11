<?php
// Always start this first
session_start();

$servername = "localhost";
$username = "athinaf";
$password = "12345#";
$dbname = 'har_proj';

//echo $_SESSION['user_id'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$coordinates = array();
//$sql = "SELECT COUNT(id_har)AS numOfRecords, isProvider AS isp FROM `har_file` WHERE user_email = '". $_SESSION['user_id']."' ";
$sql = "Select entries.lon as lng, entries.lat as lat, count(*) as count from entries inner join header on entries.id_entry = header.id_entry INNER JOIN har_file ON entries.id_har = har_file.id_har where header.name = 'content-type' and value in ('text/javascript','application/javascript', 'text/html; charset=utf-8')AND har_file.user_email = '". $_SESSION['user_id']."' GROUP BY entries.lon,entries.lat";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $coordinates[] =  $row;
    }

}else{
    echo 'There are no coordinates!';
}
echo json_encode($coordinates) ;//. "<br>";
//echo json_encode($coordinates[0]);
$conn->close();
?>