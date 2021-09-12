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
ini_set('max_execution_time', '600');
error_reporting(E_ALL);

 $serverName = "localhost";
 $userName = "root";
 $password = "";
 $databaseName = "webdb";


/*
$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = 'web2021final';
*/


$redir = 0;


$connection = mysqli_connect($serverName, $userName, $password, $databaseName);


$filename =  $_FILES['myfile']['name'];

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
 use JsonMachine\JsonDecoder\ExtJsonDecoder;

 //initialization of variables
 $req_head_name = array();
 $req_head_value = array();
 $res_head_name = array();
 $res_head_value = array();
 global $entry_id, $har_id, $method, $startedDateTime, $url, $status, $statusText, $wait, $serverIPAddress,$server_lon, $server_lat;

 
 //stream for cleaning the file
 $objects = JsonMachine::fromFile($location, '/log/entries', new ExtJsonDecoder);
 foreach($objects as $object){
     foreach ($object as $key => $value) {
             if ($key == "pageref") {
                 unset($object->{$key});
             }
             if ($key == "request") {
                 foreach($value as $val => $thi){
                     if($val == "bodySize"){
                         unset($object->$key->$val);
                     }
                     if($val == "url"){
                         $object->$key->$val =  parse_url($thi, PHP_URL_HOST);
                     }
                     if($val == "httpVersion"){
                         unset($object->$key->$val);
                     }
                     if($val == "headers"){
                         $x = 0;
                         foreach($thi as $valu => $inn){
                             if(strcasecmp($inn->{"name"}, 'Host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                                 $x++;
                                 continue;
                                 
                             }
                             else{
                                 unset($object->$key->$val[$x]);
                                 $x++;
                             }
                
                         }
                         
                     }
                     if($val == "cookies"){
                         unset($object->$key->$val);
                     }
                     if($val == "queryString"){
                         unset($object->$key->$val);
                     }
                     if($val == "headersSize"){
                         unset($object->$key->$val);
                     }
                 }
             }
             if ($key == "response") {
                 foreach($value as $val => $thi){
                     if($val == "httpVersion"){
                         unset($object->$key->$val);
                     }
                     if($val == "headers"){
                      $object->$key->$val = explode(",", $val);
                         foreach($thi as $valu => $inn){
                             if(strcasecmp($inn->{"name"}, 'Host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                                
                                 continue;
                                 
                             }
                             else{
                                 unset($object->$key->$val->$inn);
                                 
                             }
                
                         }
                     }
                     if($val == "cookies"){
                         unset($object->$key->$val);
                     }
                     if($val == "content"){
                         unset($object->$key->$val);
                     }
                     if($val == "redirectURL"){
                         unset($object->$key->$val);
                     }
                     if($val == "headersSize"){
                         unset($object->$key->$val);
                     }
                     if($val == "bodySize"){
                         unset($object->$key->$val);
                     }
                 }
             }
             if ($key == "cache") {
                 unset($object->{$key});
             }
             if ($key == "timings") {
                 foreach($value as $val => $thi){
                     if($val != "wait"){
                         unset($object->$key->$val);
                     }
                 }
             }
             if ($key == "time") {
                 unset($object->{$key});
             }
             if ($key == "_securityState") {
                 unset($object->{$key});
             }
             if ($key == "connection") {
                 unset($object->{$key});
             }
 
 
     
 }
 }
 
 //insert har_file in db
 $insertRecordQuery = "INSERT INTO har_file  VALUES(null,'".$_SESSION['user_id']."','".$isp."','".$city."',".$lon.",".$lat.", cast(NOW() as Date) );";
 
 if(mysqli_query($connection, $insertRecordQuery)){
  //echo "success";
}
else{
  echo "error:".mysqli_error($connection);
}

//get id of inserted file
 $result = $connection->query("SELECT MAX(id_har) FROM har_file WHERE user_email = '".$_SESSION['user_id']."'");


  while($row = $result->fetch_assoc()) {
   $har_id = $row["MAX(id_har)"];

  }

//iteration of cleaned file for insertion in db
 foreach($objects as $object){
  foreach ($object as $key => $value) {
    if ($key == "startedDateTime") {
      $date = new DateTime($value);
      $startedDateTime = date_format($date,'Y-m-d H:i:s');
    }
    if ($key == "request") {
      foreach($value as $val => $thi){
        if($val == "method"){
          $method = $thi;
        }
        if($val == "url"){
          $url = parse_url($thi, PHP_URL_HOST);
        }
        if($val == "headers"){

          foreach($thi as $valu => $inn){
            if(strcasecmp($inn->{"name"}, 'host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                
            array_push($req_head_name, $inn->{"name"}); 
            array_push($req_head_value, $inn->{"value"});
            }
          }
        }
      }
    }
    if ($key == "timings") {
      foreach($value as $val => $thi){
        if($val == "wait"){
          $wait = $thi;
        }
    }
    }
    if ($key == "serverIPAddress") {
      $serverIPAddress = $value;
      $api_access_key = '15f55544c4b6c69056311af5e3f3ee49';
      $ch = curl_init('http://api.ipstack.com/'.$serverIPAddress.'?access_key=15f55544c4b6c69056311af5e3f3ee49');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response_data = curl_exec($ch);
      curl_close($ch);
      $result_data = json_decode($response_data, true);
      $server_lat = $result_data['latitude'];
      $server_lon = $result_data['longitude'];
    }

    if ($key == "response") {
      foreach($value as $val => $thi){
        if($val == "status"){
          $status = $thi;
        }
        if($val == "statusText"){
          $statusText = $thi;
        }
        if($val == "headers"){

          foreach($thi as $valu => $inn){
            if(strcasecmp($inn->{"name"}, 'host') == 0 or strcasecmp($inn->{"name"}, 'content-type') == 0 or strcasecmp($inn->{"name"}, 'cache-control') == 0 or strcasecmp($inn->{"name"}, 'pragma') == 0 or strcasecmp($inn->{"name"}, 'expires') == 0 or strcasecmp($inn->{"name"}, 'age') == 0 or strcasecmp($inn->{"name"}, 'last-modified') == 0){
                
            array_push($res_head_name, $inn->{"name"}); 
            array_push($res_head_value, $inn->{"value"});
            }
          }
        }
      }
    }
  }
  //insert entry of har file
  $insertRecordQuery = "INSERT INTO entries VALUES('".$har_id."',null,'".$startedDateTime."','".$wait."','".$serverIPAddress."',".$server_lon.",".$server_lat.",'".$method."','".$url."','".$status."','".$statusText."');";
  if(mysqli_query($connection, $insertRecordQuery)){
    //echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
 }

 //get id of inserted entry
 $result = $connection->query("SELECT MAX(id_entry) FROM entries WHERE id_har = '".$har_id."';");

 while($row = $result->fetch_assoc()) {
  $entry_id = $row["MAX(id_entry)"];
  echo $entry_id;
 }

 //insertion of request headers
 for ($i = 0; $i <= sizeof($req_head_name)-1; $i++) {
  $insertRecordQuery = "INSERT INTO header VALUES('".$entry_id."',null , '".$req_head_name[$i]."','".$req_head_value[$i]."', 'request')";
  if(mysqli_query($connection, $insertRecordQuery)){
    //echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
 }
  
}
//insertion of response headers
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

//empty temporary arrays 
  $req_head_name = array();
  $req_head_value = array();
  $res_head_name = array();
  $res_head_value = array();

}
 
 //empty the server file that holds the har files while processing
 $files = glob('../server_folder/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file)) {
    unlink($file); // delete file
  }
}


 if ($redir == 1) {
  header("Location: ../user_functionality/main_user.php");
exit;
}

 ?>