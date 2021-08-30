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
ini_set('display_errors',1);
error_reporting(E_ALL);

/*
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "web2021";
*/

$serverName = "localhost";
$userName = "athinaf";
$password = "12345#";
$databaseName = 'har_proj';

$redir = 0;

$connection = mysqli_connect($serverName, $userName, $password, $databaseName);
/*
if(isset($_POST['submit'])){
  $filename       = $_FILES['myfile']['name'];  
  $temp_name  = $_FILES['myfile']['tmp_name'];  
  if(isset($filename) and !empty($filename)){
    $location = "../server_folder/";      
      if(move_uploaded_file($temp_name, $location.$filename)){
          echo 'File uploaded successfully';
      }else{
        echo 'UPLOADING FILE FAILED ';
      }
  } else {
      echo 'You should select a file to upload !!';
  }
}

$filename       = $_FILES['myfile']['name'];
$location = "../server_folder/";
$filepath = "../server_folder/".$filename;
*/
$filename =  $_FILES['myfile']['name'];
/*echo file_get_contents("test.txt");
echo file_get_contents($filename);*/

$location = "../server_folder/".$filename;

if (move_uploaded_file($_FILES['myfile']['tmp_name'], $location)){
  echo '<p> File uploaded successfully</p>';
}
else{
  echo '<b> Error uploading file.</b>';
}


$isp = $_POST['isp'];
$city = $_POST['city'];
$lon = $_POST['lon'];
$lat = $_POST['lat'];


echo $isp;
echo $city;
echo $lon;
echo $lat;
/*ADD THE CITY AND THE COORDINATES*/
require_once 'vendor/autoload.php';

 use \JsonMachine\JsonMachine;
 use JsonMachine\JsonDecoder\PassThruDecoder;

 $req_head_name = array();
 $req_head_value = array();
 $res_head_name = array();
 $res_head_value = array();
 global $entry_id, $har_id, $method, $startedDateTime, $url, $status, $statusText, $wait, $serverIPAddress;

 
 
 $insertRecordQuery = "INSERT INTO har_file  VALUES(null,'".$_SESSION['user_id']."','".$isp."','".$city."',".$lon.",".$lat." );";
 if(mysqli_query($connection, $insertRecordQuery)){
  //echo "success";
}
else{
  echo "error:".mysqli_error($connection);
}

 $result = $connection->query("SELECT MAX(id_har) FROM har_file WHERE user_email = '".$_SESSION['user_id']."'");


  while($row = $result->fetch_assoc()) {
   $har_id = $row["MAX(id_har)"];

  }
 
 

/*$entries = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);*/
 $entries = JsonMachine::fromFile($location,'/log/entries', new PassThruDecoder);
 foreach ($entries as $entry){
  $x = 1;
   foreach (JsonMachine::fromString($entry, "") as $data){
    if($x === 2){ //startedDateTime
      
      $date = new DateTime($data);
      $startedDateTime = date_format($date,'Y-m-d H:i:s');
      //echo $startedDateTime."<br>";
    }
    if($x === 3){//request
      $y = 1;
      foreach ($data as &$value) {
        if($y === 2){ //method
          $method = $value;
          //echo $method."<br>";
          
        }
        if($y === 3){ //url
          $url = parse_url($value, PHP_URL_HOST);
          //echo $url."<br>";
          
        }
        if ($y === 5){ //headers
          foreach ($value as &$in) {
            $z = 1;
          
            foreach ($in as &$inn) {
              if($z === 1){ //name
                if(strcasecmp($inn, 'host') == 0 or strcasecmp($inn, 'content-type') == 0 or strcasecmp($inn, 'cache-control') == 0 or strcasecmp($inn, 'pragma') == 0 or strcasecmp($inn, 'expires') == 0 or strcasecmp($inn, 'age') == 0 or strcasecmp($inn, 'last-modified') == 0){
                //echo "name:".$inn."<br>";
                array_push($req_head_name, $inn); 
                }
                else{
                  break;
                }
              }
              if($z === 2){ //value
                //echo "value:".$inn."<br>";
                array_push($req_head_value, $inn); 
              }
              $z++;
          }
        }
        }
        $y++;
      }
    }
    if($x === 4){//response
      $y = 1;
      foreach($data as $value){
        if($y === 1){ //status
          $status = $value;
          //echo $status."<br>";
          
        }
        if($y === 2){ //statusText
          $statusText = $value;
          //echo $statusText."<br>";
          
        }
        if ($y === 4){ //headers
          foreach ($value as &$in) {
            $z = 1;
            foreach ($in as &$inn) {
              if($z === 1){ //name
                if(strcasecmp($inn, 'host') == 0 or strcasecmp($inn, 'content-type') == 0 or strcasecmp($inn, 'cache-control') == 0 or strcasecmp($inn, 'pragma') == 0 or strcasecmp($inn, 'expires') == 0 or strcasecmp($inn, 'age') == 0 or strcasecmp($inn, 'last-modified') == 0){
                //echo "name:".$inn."<br>";
                array_push($res_head_name, $inn);
                }
                else{
                  break;
                }
              }
              if($z === 2){ //value
                //echo "value:".$inn."<br>";
                array_push($res_head_value, $inn);
              }
              $z++;
          }
        }
        }
        $y++;
      }
    }
    if($x === 6){ //timings
      $y = 1;
      foreach($data as &$inside){
        if($y === 6){ //wait
          $wait = $inside;
          //echo $wait."<br>";
        }
        
        $y++;
      }
      
      
    }
    if($x === 9){//serverIPAddress
      $serverIPAddress = $data;
      //echo $serverIPAddress."<br>"; 
    }
    
    $x++;
   //print_r($startedDateTime);
    //$date = new DateTime($data);
    //$new_data = date_format($date,'Y-m-d H:i:s');
    /*
    $insertRecordQuery = "INSERT INTO entries VALUES('".$new_data."')";
    if(mysqli_query($connection, $insertRecordQuery)){
       echo "success";
    }
    else{
       echo "error:".mysqli_error($connection);
    }
    */
  }
  
  $insertRecordQuery = "INSERT INTO entries VALUES('".$har_id."',null,'".$startedDateTime."','".$wait."','".$serverIPAddress."','".$method."','".$url."','".$status."','".$statusText."')";
  if(mysqli_query($connection, $insertRecordQuery)){
    //echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
 }

  $result = $connection->query("SELECT MAX(id_entry) FROM entries WHERE id_har = '".$har_id."';");

 
  while($row = $result->fetch_assoc()) {
   $entry_id = $row["MAX(id_entry)"];
   echo $entry_id;
  }
 
 
 for ($i = 0; $i <= sizeof($req_head_name)-1; $i++) {
  $insertRecordQuery = "INSERT INTO header VALUES('".$entry_id."',null , '".$req_head_name[$i]."','".$req_head_value[$i]."', 'request')";
  if(mysqli_query($connection, $insertRecordQuery)){
    //echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
 }
  
}

for ($i = 0; $i <= sizeof($res_head_name)-1; $i++) {
  $insertRecordQuery = "INSERT INTO header VALUES('".$entry_id."',null , '".$res_head_name[$i]."','".$res_head_value[$i]."', 'response')";
  if(mysqli_query($connection, $insertRecordQuery)){
    //echo "success";
    $redir = 1;
 }
 else{
    echo "error:".mysqli_error($connection);
    $redir = 0;
 }
}

/*
  print_r($req_head_name);
  print_r($req_head_value);
  print_r($res_head_name);
  print_r($res_head_value);
*/
  $req_head_name = array();
  $req_head_value = array();
  $res_head_name = array();
  $res_head_value = array();


 }

 
 if ($redir == 1) {
  header("Location: ../user_functionality/main_user.php");
exit;
}
?>