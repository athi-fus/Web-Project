<?php

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "webdb";

$connection = mysqli_connect($serverName, $userName, $password, $databaseName);

require_once 'vendor/autoload.php';

 use \JsonMachine\JsonMachine;
 use JsonMachine\JsonDecoder\PassThruDecoder;

 $req_head_name = array();
 $req_head_value = array();
 $res_head_name = array();
 $res_head_value = array();
 global $entry_id, $har_id, $method, $startedDateTime, $url, $status, $statusText, $wait, $serverIPAddress;

 
 
 $insertRecordQuery = "INSERT INTO har_file VALUES(null,'user1@email.com','cosmote')";
 if(mysqli_query($connection, $insertRecordQuery)){
  echo "success";
}
else{
  echo "error:".mysqli_error($connection);
}

 $result = $connection->query("SELECT MAX(id_har) FROM har_file WHERE user_email = 'user1@email.com';");


  while($row = $result->fetch_assoc()) {
   $har_id = $row["MAX(id_har)"];

  }
 
 




 $entries = JsonMachine::fromFile("techsetupgear.wordpress.com_Archive-21-07-23-21-24-35.har",'/log/entries', new PassThruDecoder);
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
    echo "success";
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
    echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
 }
  
}

for ($i = 0; $i <= sizeof($res_head_name)-1; $i++) {
  $insertRecordQuery = "INSERT INTO header VALUES('".$entry_id."',null , '".$res_head_name[$i]."','".$res_head_value[$i]."', 'response')";
  if(mysqli_query($connection, $insertRecordQuery)){
    echo "success";
 }
 else{
    echo "error:".mysqli_error($connection);
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

?>